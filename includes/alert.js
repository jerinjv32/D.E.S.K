function showAlert(title, text, icon){
    Swal.fire ({
        title: title,
        text: text,
        icon: icon,
        backdrop: false,
        confirmButtonText: 'Ok',
        confirmButtonColor: "#171717"
    })
}
