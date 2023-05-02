const storeDataToSession = () => {
    document.getElementById('right-btn').addEventListener('click', function (e) {
        e.preventDefault(); // Prevent the default form submission

        let data = fillData();
        let mainActivityData = data.mainActivityData;
        let subActivityData = data.subActivityData;

        let mergedData = mergeWithExistingData(mainActivityData, subActivityData);
        console.log('mergedData: ', mergedData);

        let fixedMainActivityData = mergedData.mainActivityData;
        let fixedSubActivityData = mergedData.subActivityData;

        // Store the subActivityData object in session storage with the key 'data-log'
        sessionStorage.setItem('main-activity', JSON.stringify(fixedMainActivityData));
        sessionStorage.setItem('sub-activity', JSON.stringify(fixedSubActivityData));
    });
};

const fillData = () => {
    // Initialize an empty object to store the form data
    let mainActivityData = [];
    let subActivityData = [];

    // Fill mainActivityData
    let mainLabel = document.querySelector('.main-activity').getAttribute('data-main-label');
    let mainValue = (typeof getMainValue === 'function') ? getMainValue() : 'Syubhat';

    let mainActivityItem = {};
    mainActivityItem.label = mainLabel;
    mainActivityItem.value = mainValue;
    mainActivityItem.timestamp = getDateTime();
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

    return { mainActivityData, subActivityData };
};

const mergeWithExistingData = (mainActivityData, subActivityData) => {
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
        subActivityData = [...parsedData, ...subActivityData];
    }

    return { mainActivityData, subActivityData };
};

const getDateTime = () => {
    const now = new Date();
    const datetime = now.toISOString().slice(0, 19).replace('T', ' ');

    return datetime;
};