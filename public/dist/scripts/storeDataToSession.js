const storeDataToSession = () => {
    document.getElementById('right-btn').addEventListener('click', function (e) {
        // Initialize an empty object to store the form data
        let mainActivityData = [];
        let subActivityData = [];

        // Fill mainActivityData
        let mainLabel = document.querySelector('.main-activity').getAttribute('data-main-label');
        let mainValue = (typeof getMainValue === 'function') ? getMainValue() : 'Syubhat';

        let mainActivityItem = {};
        mainActivityItem.label = mainLabel
        mainActivityItem.value = mainValue
        mainActivityData.push(mainActivityItem);

        // Fill subActivityData. Loop through each input element with class 'sub-activity'
        let subActivityElems = document.querySelectorAll('.sub-activity');
        subActivityElems.forEach(function (elem, index) {
            // Use an object to store the label and value of each sub-activity item
            let subActivityItem = {};
            subActivityItem.label = elem.getAttribute('data-label');
            subActivityItem.value = elem.value;

            // Push the sub-activity item object to the subActivityData array
            subActivityData.push(subActivityItem);
        });

        // Retrieve the existing main & sub activity data from session storage
        let existingMainData = sessionStorage.getItem('main-activity');
        let existingSubData = sessionStorage.getItem('sub-activity');

        // Merge the existing main activity data and the new main activity data
        if (existingMainData) {
            let parsedData = JSON.parse(existingMainData);
            mainActivityData = [...parsedData, ...mainActivityData];
        }
        if (existingSubData) {
            let parsedData = JSON.parse(existingSubData);
            subActivityData = [...subActivityData, ...parsedData];
        }

        // Store the subActivityData object in session storage with the key 'data-log'
        sessionStorage.setItem('main-activity', JSON.stringify(mainActivityData));
        sessionStorage.setItem('sub-activity', JSON.stringify(subActivityData));
    });
};
