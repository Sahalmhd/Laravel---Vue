<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return inertia(
            'Listing/Index',
            [
                'listings' => Listing::orderByDesc('created_at')->paginate(10),
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Listing::class);

        return inertia('Listing/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->user()->listings()->create($request->validate([
            'beds' => 'required|integer|min:0|max:20',
            'baths' => 'required|integer|min:0|max:20',
            'area' => 'required|integer|min:15|max:1500',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required|min:1|max:1000',
            'price' => 'required|integer|min:1|max:20000000',
        ]));

        return redirect()->route('listings.index')->with('success', 'Listing created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        Gate::authorize('view', $listing);

        return inertia(
            'Listing/Show',
            ['listing' => Listing::find($listing->id)]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return inertia(
            'Listing/Edit',
            ['listing' => Listing::find($listing->id)]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        Gate::authorize('update', $listing);

        $listing->update($request->validate([
            'beds' => 'required|integer|min:0|max:20',
            'baths' => 'required|integer|min:0|max:20',
            'area' => 'required|integer|min:15|max:1500',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required|min:1|max:1000',
            'price' => 'required|integer|min:1|max:20000000',
        ]));

        return redirect()->route('listings.index')->with('success', 'Listing updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        Gate::authorize('delete', $listing);

        $listing->delete();

        return redirect()->back()->with('success', 'Listing was deleted!');
    }
}
