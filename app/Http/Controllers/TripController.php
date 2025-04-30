<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OpenWeatherService;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::where('user_id', Auth::id())
            ->orWhereHas('collaborators', function ($query) {
                $query->where('user_id', Auth::id());
            })->get();

        return view('trips.index', compact('trips'));
    }

    public function create()
    {
        return view('trips.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $trip = Trip::create([
            'name' => $request->name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'user_id' => Auth::id(),
        ]);

        $trip->collaborators()->attach(Auth::id());

        return redirect()->route('trips.index')->with('success', 'Trip created successfully.');
    }

    public function show(Trip $trip, OpenWeatherService $weatherService)
    {
        $this->authorize('view', $trip);

        $destinations = $trip->destinations;
        $weatherData = [];

        foreach ($destinations as $destination) {
            $weatherData[$destination->id] = $weatherService->getWeather(
                $destination->latitude,
                $destination->longitude
            );
        }

        return view('trips.show', compact('trip', 'destinations', 'weatherData'));
    }

    public function edit(Trip $trip)
    {
        $this->authorize('update', $trip);
        return view('trips.edit', compact('trip'));
    }

    public function update(Request $request, Trip $trip)
    {
        $this->authorize('update', $trip);

        $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
        ]);

        $trip->update($request->only('name', 'start_date', 'end_date'));

        return redirect()->route('trips.index')->with('success', 'Trip updated successfully.');
    }

    public function destroy(Trip $trip)
    {
        $this->authorize('delete', $trip);

        $trip->delete();

        return redirect()->route('trips.index')->with('success', 'Trip deleted successfully.');
    }
}
