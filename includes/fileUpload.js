function fileUpload () {
    const fileInput = document.getElementById('file_upload');
    const form = document.getElementById('upload_form');
    fileInput.click();
    fileInput.onchange = function () {
        if (fileInput.files.length > 0 ) {
            form.submit();
        }
    }
}