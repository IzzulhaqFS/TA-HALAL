const selectedOptionModifier = () => {
    // Get all select elements on the page
    let selectElems = document.querySelectorAll('select');

    // Loop through each select element
    selectElems.forEach(function (selectElem) {
        // Add an event listener to the select element that listens for changes to its value
        selectElem.addEventListener('change', function (event) {
            // Get the selected option
            let selectedOption = event.target.options[event.target.selectedIndex];

            // Loop through all options in the select element
            for (let i = 0; i < event.target.options.length; i++) {
                let option = event.target.options[i];

                // If the option is selected, add the 'sub-activity' class to it
                if (option === selectedOption) {
                    option.classList.add('sub-activity');
                } else {
                    // Otherwise, remove the 'sub-activity' class from it
                    option.classList.remove('sub-activity');
                }
            }
        });
    });
};

selectedOptionModifier();
