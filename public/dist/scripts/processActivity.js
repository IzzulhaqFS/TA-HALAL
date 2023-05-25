const baseRoute = 'http://127.0.0.1:8000';
const activityRoute = `${baseRoute}/activity`;
const ingredientRoute = `${baseRoute}/ingredient`;
const modelRoute = 'http://127.0.0.1:5000/get_result';

const storeActivity = async (csrf_token, data) => {
    try {
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
        return responseData;
    } catch (error) {
        console.error(error);
        throw error;
    }
};

const getResult = async (userId, ingredientId, ingredientType, eventLog) => {
    try {
        const response = await fetch(`${modelRoute}/${ingredientType}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                'user-id': userId,
                'ingredient-id': ingredientId,
                'event-log': eventLog,
            }),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        return await response.json();
    } catch (error) {
        console.error(error);
        throw error;
    }
};

const processResult = async (csrf_token, getResultResponse) => {
    try {
        const response = await fetch(`${ingredientRoute}/status-halal`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf_token,
            },
            body: JSON.stringify({
                'status-halal': getResultResponse['status-halal'],
            }),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
    } catch (error) {
        console.error(error);
        throw error;
    }
};


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

        // Store the activity
        const responseData = await storeActivity(csrf_token, data);
        console.log('Response data', responseData);

        // Fetch another API
        const userId = responseData['user-id'];
        const ingredientId = responseData['ingredient-id'];
        const ingredientType = responseData['ingredient-type'];
        const eventLog = responseData['event-log'];


        // Get the result from Flask model app 
        // const getResultResponse = await getResult(userId, ingredientId, ingredientType, eventLog);
        // await processResult(csrf_token, getResultResponse);

    } catch (error) {
        // Handle any errors that occur during the request
        console.error(error);
    }
};
