const baseRoute = 'http://127.0.0.1:8000';
const activityRoute = `${baseRoute}/activity`;
const ingredientRoute = `${baseRoute}/ingredient`;
const modelRoute = 'http://127.0.0.1:5000/get_prediction_result';

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

const getPredictionResult = async (responseData) => {
    try {
        const response = await fetch(`${modelRoute}/${responseData['ingredient-type']}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                'user-id': responseData['user-id'],
                'ingredient-id': responseData['ingredient-id'],
                'event-log': responseData['event-log'],
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

const processPredictionResult = async (csrf_token, predictionResult, ingredientId) => {
    try {
        const response = await fetch(`${ingredientRoute}/${ingredientId}/status-halal`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrf_token,
            },
            body: JSON.stringify({
                'status-halal': predictionResult['status-halal'],
            }),
        });

        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }

        const responseData = await response.json();
        window.location.href = responseData['route']
    } catch (error) {
        console.error(error);
        throw error;
    }
};


const processActivity = async (csrf_token, method = 'prediction') => {
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

        // Get the result from Flask model app 
        if (method === 'prediction') {
            const predictionResult = await getPredictionResult(responseData);
            console.log('Prediction res', predictionResult);
            await processPredictionResult(csrf_token, predictionResult, responseData['ingredient-id']);
        }
        
        // Get the result from Halal Critical Control Point (HCCP) Rule 
        // if (method === 'rule') {
        //     const ruleResult = await getRuleResult(responseData);
        //     await processRuleResult(csrf_token, predictionResult, responseData['ingredient-id']);
        // }


    } catch (error) {
        // Handle any errors that occur during the request
        console.error(error);
    }
};
