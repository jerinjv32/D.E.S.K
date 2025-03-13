import Swal from "sweetalert2";
import 'sweetalert2/src/sweetalert2.css'
function popAlert(check){
    if (check == 1) {
        Swal.fire ({
            title: "Completed",
            text: "Upload was successfull!",
            icon: 'success'
        })
    } else {
        Swal.fire ({
            title: "Failed",
            text: "Upload was not successfull!",
            icon: 'error'
        })   
    }
}