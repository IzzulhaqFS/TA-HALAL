const storeDataToSession = () => {
    document.getElementById('right-btn').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default form submission

        // Initialize an empty object to store the form data
        let mainActivityData = {};
        let subActivityData = {};
        let mainKey = document.querySelector('.main-activity').getAttribute('data-main-label');

        (typeof getMainValue === 'function')
            ? mainActivityData[mainKey] = getMainValue()
            : mainActivityData[mainKey] = 'Syubhat';


        // Loop through each input element with class 'sub-activity'
        let subActivityElems = document.querySelectorAll('.sub-activity');
        subActivityElems.forEach(function (elem) {
            // Use the input element's 'data-label' attribute as the key in the subActivityData object,
            // and the input element's value as the value in the subActivityData object
            subActivityData[elem.getAttribute('data-label')] = elem.value;
        });

        // Store the subActivityData object in session storage with the key 'data-log'
        sessionStorage.setItem('main-activity', JSON.stringify(mainActivityData));
        sessionStorage.setItem('sub-activity', JSON.stringify(subActivityData));
    });
};
