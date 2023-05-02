const processActivity = (route) => {
    alert(route);
    // Get the data from session storage
    let mainActivityData = JSON.parse(sessionStorage.getItem('main-activity'));
    let subActivityData = JSON.parse(sessionStorage.getItem('sub-activity'));

    // Construct the data to send
    let data = {
        'main-activity': mainActivityData,
        'sub-activity': subActivityData,
    };

    // Send the POST request to the Laravel route
    fetch(route, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify(data),
    }).then(response => {
        // Handle the response from the server
        console.log(response);
    }).catch(error => {
        // Handle any errors that occur during the request
        console.error(error);
    });

    // add
};