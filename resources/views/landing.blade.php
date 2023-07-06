<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

@php
    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'];
@endphp

<body class="bg-gray-100 flex flex-col items-center justify-center">
    <div class="container mx-auto py-8">
        <table class="w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th></th>
                    @foreach ($days as $day)
                        <th class="py-2 px-4 bg-gray-200 text-gray-700 font-medium border border-gray-200">
                            {{ $day }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @php
                    $startHour = 9;
                    $endHour = 21;
                    $intervalMinutes = 30;
                @endphp
                @for ($hour = $startHour; $hour <= $endHour; $hour++)
                    @for ($minute = 0; $minute < 60; $minute += $intervalMinutes)
                        <tr>
                            <td class="py-2 px-4 border border-gray-200">
                                @if ($minute === 0)
                                    {{ sprintf('%02d:00', $hour) }}
                                @else
                                    {{ sprintf('%02d:%02d', $hour, $minute) }}
                                @endif
                            </td>
                            @foreach ($days as $day)
                                <td class="py-2 px-4 border border-gray-200">
                                    @foreach ($appointments as $appointment)
                                        @php
                                            $startDateTime = \Carbon\Carbon::parse($appointment->start_date);
                                            $appointmentHour = $startDateTime->format('H');
                                            $appointmentMinute = $startDateTime->format('i');
                                        @endphp
                                        @if (
                                            ($appointmentHour === (string) $hour && $appointmentMinute === (string) $minute) ||
                                                ($minute === 0 && $appointmentHour === (string) $hour && $appointmentMinute === '00'))
                                            <div class="border rounded-lg p-2 mb-2">{{ $appointment->description }}</div>
                                        @endif
                                    @endforeach
                                </td>
                            @endforeach
                        </tr>
                    @endfor
                @endfor
            </tbody>
        </table>
    </div>

    <form id="appointment-form" class=" border p-10 w-[500px]">
        <h1 class="text-2xl font-bold mb-5">Book an appointment</h1>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="floating_full_name" id="floating_first_name"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="floating_full_name"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Full
                name</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="email" name="floating_email" id="floating_email"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="floating_email"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email
                address</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="password" name="floating_password" id="floating_password"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="floating_password"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="tel" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" name="floating_phone" id="floating_phone"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required />
            <label for="floating_phone"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Phone
                number</label>
        </div>
        <div class="relative z-0 w-full mb-6 group">
            <input type="text" name="floating_hour" id="floating_hour"
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none  dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                placeholder=" " required readonly />
            <label for="floating_hour"
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Hour</label>
        </div>
        <div id="hour-popup" class="hidden bg-white absolute z-10 p-4 shadow-md">
            <ul class="list-none p-0 m-0">
                <li class="cursor-pointer hover:bg-gray-100 py-2 px-4" data-value="9:00">9:00 AM</li>
                <li class="cursor-pointer hover:bg-gray-100 py-2 px-4" data-value="9:30">9:30 AM</li>
                <li class="cursor-pointer hover:bg-gray-100 py-2 px-4" data-value="10:00">10:00 AM</li>
            </ul>
        </div>
        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openFormButtons = document.querySelectorAll('.open-form-button');
            const appointmentForm = document.getElementById('appointment-form');

            openFormButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    const time = this.dataset.time;
                    appointmentForm.classList.remove('hidden');
                });
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            const hourInput = document.getElementById('floating_hour');
            const hourPopup = document.getElementById('hour-popup');

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
    </script>
</body>

</html>
