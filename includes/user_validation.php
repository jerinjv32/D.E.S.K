<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;

class ValidateUser {
    private $college_id;
    private $email_id;
    private $otp;
    public function __construct($college_id, $email_id)
    {
        $this->college_id = $college_id;
        $this->email_id = $email_id;
    }
    
    public function checkUser () {
        require_once __DIR__.'/../db.php';
        try {
            $user = $database->get('student','email',['college_id'=>$this->college_id]);
            if (!empty($user)) {
                if ($this->email_id === $user) {
                    $otpObj = new OtpManager($this->college_id);
                    $otp = $otpObj->generateOtp();
                    $otpObj->insertOtp($otp);
                    $obj = new SendEmail($this->email_id,$otp);
                    $obj->sendOverEmail();
                    exit();
                } else {
                    return "Email id is not found!";
                }
            } else {
                return "Invalid college id";
            }
        } catch (PDOException $e) {
            file_put_contents('error_log.txt',date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
            die('<h2>Database Error Occures</h2>');
        }
    } 
}

class OtpManager { 
    private $college_id;
    public function __construct($college_id)
    {
        $this->college_id = $college_id;
    }
    public function generateOtp() {
        $generator = new ComputerPasswordGenerator();
        $generator 
            ->setLowercase()
            ->setNumbers()
            ->setSymbols(false)
            ->setLength(6);
        return $generator->generatePassword();
    }
    public function insertOtp($otp) {
        include(__DIR__.'/../db.php');
        try {
            $database->insert('otp_table',['otp'=>$otp,'college_id'=>$this->college_id]);
        } catch (PDOException $e) {
            file_put_contents('error_log.txt'.date('Y-m-d H-i-s')."-".$e->getMessage().PHP_EOL,FILE_APPEND);
            die('<h2>Otp Error Occures</h2>');
        }
    }
}

class SendEmail {
    private $email_id;
    private $otp;
    public function __construct($email_id,$otp)
    {
        $this->email_id = $email_id;
        $this->otp = $otp;
    }
    public function sendOverEmail() {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      
            $mail->isSMTP();                                            
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                   
            $mail->Username   = 'deskproject144@gmail.com';                     
            $mail->Password   = 'avcp bnfn upww qwkb';                               
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
            $mail->Port       = 465;                                    
        
            //Recipients
            $mail->setFrom('deskproject144@gmail.com', 'DESK');
            $mail->addAddress($this->email_id);     
            $mail->addReplyTo('deskproject144@gmail.com', 'Information');
        
            //Content
            $mail->isHTML(true);                                  
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = 'If you requested to change password, use the code given below <br><br><p style="border:1px solid blue; padding: 10px; border-radius: 5px; background-color: blue;color:white;font-weight:bold;">'.$this->otp.'</p>';
            $mail->AltBody = 'If you didn\'t request this message please ignore this';
        
            $mail->send();
            header('Location:../update_password.php');
            exit();
        } catch (Exception $e) {    
            die("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        }
    }
}