function hideElements(...elements) {
    elements.forEach(function (element) {
        element.style.display = 'none';
    });
}

function displayElements(...elements) {
    elements.forEach(function (element) {
        element.style.display = 'block';
    });
}