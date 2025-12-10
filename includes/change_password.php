<?php
require_once __DIR__.'/../db.php'; 
if (isset($_POST['change_btn'])) {
    $otpAvail = htmlspecialchars($_POST['otp_box']??'',ENT_QUOTES,'UTF-8');
    try{
        $otp = $database->get('otp_table',['otp','time_stamp','college_id'], ['otp'=>$otpAvail]);
        if (empty($otp)) {
            header('Location: ../update_password.php?check=101');
            exit();
        }
    } catch (PDOException) {
        die('<h2>Something Went Wrong</h2>');
    }
    $newPass = htmlspecialchars($_POST['new_password']??'',ENT_QUOTES,'UTF-8');
    $confirmPass = htmlspecialchars($_POST['confirm_password']??'',ENT_QUOTES,'UTF-8');
    $pass = new PasswordChange($database, $otp['college_id']);
    $pass->changePassword($newPass, $confirmPass);
}

class PasswordChange {
    private $database;
    private $college_id;
    public function __construct($database, $college_id) {
        $this->database = $database;
        $this->college_id = $college_id; 
    }

    public function changePassword ($newPass, $confirmPass) {
        if (strcmp($newPass, $confirmPass) == 0) {
            $password = password_hash($confirmPass,PASSWORD_DEFAULT);
            try {
                $this->database->update('users',['password'=>$password],['username'=>$this->college_id]);
                header('Location:../update_password.php?check=100');
                exit;
            } catch (PDOException $e) {
                die('<h2>Something Went Wrong</h2>');
            }
        } else {
            header('Location:../update_password.php?check=102');
            exit;
        }
    }
}