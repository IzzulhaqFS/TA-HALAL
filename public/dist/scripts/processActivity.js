const activityRoute = 'http://127.0.0.1:8000/api/activity';
const productRoute = 'http://127.0.0.1:8000/product';

const processActivity = (csrf_token) => {
    // Get the data from session storage
    let mainActivityData = JSON.parse(sessionStorage.getItem('main-activity'));
    let subActivityData = JSON.parse(sessionStorage.getItem('sub-activity'));

    // Construct the data to send
    let data = {
        'main-activity': mainActivityData,
        'sub-activity': subActivityData,
    };
    console.log('data res', data);

    // Send the POST request to the Laravel route
    fetch(activityRoute, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf_token,
        },
        body: JSON.stringify(data),
    }).then(response => {
        console.log('Response data', response);
        // Check if response was successful
        // if (response.ok) {
        //     // Redirect to productRoute
        //     window.location.href = productRoute;
        // } else {
        //     // Handle other responses
        //     console.error('Error response:', response);
        // }
    }).catch(error => {
        // Handle any errors that occur during the request
        console.error(error);
    });
};
