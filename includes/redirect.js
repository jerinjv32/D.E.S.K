function redirect(url) {
    const baseURL = 'http://localhost:82/';
    const actURL = baseURL + url;
    console.log('Redirecting to:', actURL)
    window.location.href = actURL;
}