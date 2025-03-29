function showAlert(title, text, icon){
    Swal.fire ({
        title: title,
        text: text,
        icon: icon,
        confirmButtonText: 'Ok',
        confirmButtonColor: "#171717"
    })
}
function removeAlert() {
    const form = document.getElementById(remove_form);
    Swal.fire({
        title: "Do you want to save the changes?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Confirm",
        denyButtonText: `Don't save`
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit(); 
        } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
        }
    });
}