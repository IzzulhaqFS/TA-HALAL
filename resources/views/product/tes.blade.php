@extends('../layout/' . $layout)

@section('subhead')
    <title>Testing Page</title>
@endsection

@section('subcontent')
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto main-activity">Testing Page</h2>
    </div>
    <button id="test-btn" class="box border mt-5">TEST NOW</button>
    
    <script>
        const btn = document.querySelector('#test-btn');
        document.getElementById('test-btn').addEventListener('click', async function(e) {
            const modelRoute = 'http://127.0.0.1:5000/tes';
            try {
                const response = await fetch(`${modelRoute}`, {
                    method: 'GET',
                });

                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }

                const res = await response.json();
                console.log('Flask res', res);
            } catch (error) {
                console.error(error);
                throw error;
            }
        })
    </script>
@endsection
