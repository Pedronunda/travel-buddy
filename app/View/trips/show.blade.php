<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">{{ $trip->name }}</h2>
                    <p><strong>Start Date:</strong> {{ $trip->start_date }}</p>
                    <p><strong>End Date:</strong> {{ $trip->end_date }}</p>
                    <div id="map" class="h-96 w-full mt-4"></div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&callback=initMap" async defer></script>
    <script>
        function initMap() {
            const map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: -8.8368, lng: 13.2343 }, // Centro em Luanda, Angola
                zoom: 8,
            });
        }
    </script>
</x-app-layout>