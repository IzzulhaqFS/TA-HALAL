const activityRoute = 'http://127.0.0.1:8000/api/activity';
const productRoute = 'http://127.0.0.1:8000/product';

const processActivity = async (csrf_token) => {
    try {
        // Get the data from session storage
        let mainActivityData = JSON.parse(sessionStorage.getItem('main-activity'));
        let subActivityData = JSON.parse(sessionStorage.getItem('sub-activity'));

        // Construct the data to send
        let data = {
            'main-activity': mainActivityData,
            'sub-activity': subActivityData,
        };
        console.log('data before fetch', data);

        // Send the POST request to the Laravel route
        const response = await fetch(activityRoute, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf_token,
            },
            body: JSON.stringify(data),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const responseData = await response.json();
        console.log('Response data', responseData);
    } catch (error) {
        // Handle any errors that occur during the request
        console.error(error);
    }
};
