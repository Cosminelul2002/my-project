<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
        $(function() {
            $("#datepicker").datepicker();
        });
    </script>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 flex flex-col items-center justify-center">
    <div class="container mx-auto py-8">
        <div class="flex flex-col gap-10">
            @foreach ($appointments as $date => $groupedAppointments)
                <div class="flex flex-row items-center gap-10 p-5">
                    <div class="text-2xl font-bold mb-4 w-[350px]">
                        {{ Carbon\Carbon::parse($date)->format('m/d/Y') }}
                        ({{ Carbon\Carbon::parse($date)->format('l') }})</div>
                    @foreach ($groupedAppointments as $appointment)
                        <div class="flex flex-col bg-white rounded-lg shadow-lg p-6 mb-4">
                            <div class="text-lg font-semibold mb-2">{{ $appointment->description }}</div>
                            <div class="text-gray-500 mb-2">
                                {{ Carbon\Carbon::parse($appointment->start_date)->format('h:i A') }}</div>
                            <div class="text-gray-500 mb-2">
                                {{ Carbon\Carbon::parse($appointment->end_date)->format('h:i A') }}</div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    <form method="POST" id="appointment_form" class="m-10 border p-10 w-[500px]">
        <h1 class="text-2xl font-bold mb-5">Book an appointment</h1>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="floating_description" id="floating_description"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="floating_description"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" id="datepicker" name="floating_datepicker" id="floating_datepicker"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                required readonly />
            <label for="floating_datepicker"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Date</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="floating_hour" id="floating_hour"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required readonly />
            <label for="floating_hour"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Hour</label>
        </div>
        <div id="hour_popup" class="hidden bg-white absolute z-10 p-4 shadow-md">
            <ul class="list-none p-0 m-0">
                <li class="cursor-pointer hover:bg-gray-100 py-2 px-4" data-value="9:00">9:00 AM</li>
                <li class="cursor-pointer hover:bg-gray-100 py-2 px-4" data-value="9:30">9:30 AM</li>
                <li class="cursor-pointer hover:bg-gray-100 py-2 px-4" data-value="10:16">10:15 AM</li>
            </ul>
        </div>
        <button type="submit" id="submit-button"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>
    <div class="flex flex-row items-center gap-10 p-5">
        <form method="GET" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Logout</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openFormButtons = document.querySelectorAll('.open-form-button');
            const appointmentForm = document.getElementById('appointment_form');

            openFormButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const time = this.dataset.time;
                    appointmentForm.classList.remove('hidden');
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const hourInput = document.getElementById('floating_hour');
            const hourPopup = document.getElementById('hour_popup');

            hourInput.addEventListener('focus', function() {
                hourPopup.classList.remove('hidden');
            });

            const hourItems = hourPopup.querySelectorAll('li');
            hourItems.forEach(function(item) {
                item.addEventListener('click', function() {
                    const selectedHour = this.dataset.value;
                    hourInput.value = selectedHour;
                    hourPopup.classList.add('hidden');
                });
            });
        });


        $(document).ready(function() {
            const submitButton = document.getElementById('submit-button');
            $('#appointment_form').submit(function(e) {
                const description = document.getElementById('floating_description').value;
                const date = document.getElementById('datepicker').value;
                console.log(date);
                const hour = document.getElementById('floating_hour').value;


                $.ajax({
                    type: "POST",
                    url: "{{ route('appointment.store') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        description: description,
                        start_date: date,
                        hour: hour,
                        user_id: {{ auth()->user()->id }}
                    },
                    success: function(response) {
                        let message = JSON.parse(response.responseText);
                        console.log(message.message);
                        window.location.reload();
                    },
                    error: function(response) {
                        let message = JSON.parse(response.responseText);
                        console.log(message.message);
                    }
                });
                return false;
                window.location.reload();
            });
        });
    </script>
</body>

</html>
