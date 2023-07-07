<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @vite('resources/css/app.css')

    <title>Dashboard</title>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
    {{-- logout button --}}
    <div class="flex flex-row items-center gap-10 p-5">
        <form method="GET" action="{{ route('logout') }}">
            @csrf
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Logout</button>
        </form>
    </div>
</body>

</html>
