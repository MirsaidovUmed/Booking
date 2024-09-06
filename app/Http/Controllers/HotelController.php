<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HotelController extends Controller
{
    public function index(): View
    {
        $hotels = Hotel::paginate(10);
        return view('hotels.index', compact('hotels'));
    }
    
    public function store(Request $request): RedirectResponse
    {
        $hotel = new Hotel;
        $request->validate([
            "title" => "required|max:255",
            "description" => "required|max:255",
            "poster_url"=>"required|website",
            "address"=> "required",
        ]);
        $hotel->create($request->all());
        return back()->with('status', 'Hotel Added successfully');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $hotel = Hotel::findOrFail($id);
        $request->validate([
            "title" => "required|max:255",
            "description" => "required|max:255",
            "poster_url"=>"required|website",
            "address"=> "required",
        ]);

        $hotel->title = $request->input('title') ?? $hotel->title;
        $hotel->description = $request->input('description') ?? $hotel->description;
        $hotel->poster_url = $request->input('poster_url') ?? $hotel->poster_url;
        $hotel->address = $request->input('address') ?? $hotel->address;
        
        $hotel->update();
        return back()->with('status', 'Hotel Updated successfully');
    }

    public function destroy(int $id): RedirectResponse
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();
        return back()->with('status', 'Hotel deleted successfully');
    }
}
