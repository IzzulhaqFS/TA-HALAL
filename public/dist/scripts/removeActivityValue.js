function removeActivityValue(...elements) {
    elements.forEach(function (element) {
        element.setAttribute('data-value', '');

        // Set 'data-value' property to empty string for element and child elements with 'main-activity' class
        let mainActivityElements = element.querySelectorAll('.main-activity');
        mainActivityElements.forEach(function (mainActivityElement) {
            mainActivityElement.setAttribute('data-value', '');
        });

        // Clear input values
        let inputElements = element.querySelectorAll('input');
        inputElements.forEach(function (inputElement) {
            inputElement.value = '';
        });

        // Reset selected option for select elements
        let selectElements = element.querySelectorAll('select');
        selectElements.forEach(function (selectElement) {
            selectElement.selectedIndex = 0;
            let options = selectElement.querySelectorAll('option');
            options.forEach(function (option) {
                option.classList.remove('sub-activity');
            });
        });

        // Select all input type checkboxes within the parent element
        const checkboxes = element.querySelectorAll('input[type="checkbox"]');
        // Uncheck each checkbox
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = false;
        });
    });
}