<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCooperativeRequest;
use App\Http\Requests\UpdateCooperativeRequest;
use App\Models\Cooperative;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CooperativeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Cooperative::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('region', 'like', "%{$search}%")
                    ->orWhere('address', 'like', "%{$search}%")
                    ->orWhere('contact_person', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $cooperatives = $query->latest()->paginate(10)->withQueryString();

        return Inertia::render('cooperatives/index', [
            'cooperatives' => $cooperatives,
            'filters' => [
                'search' => $request->get('search'),
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('cooperatives/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCooperativeRequest $request)
    {
        Cooperative::create($request->validated());

        return redirect()
            ->route('cooperatives.index')
            ->with('success', 'Cooperative created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cooperative $cooperative)
    {
        return Inertia::render('cooperatives/show', [
            'cooperative' => $cooperative,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cooperative $cooperative)
    {
        return Inertia::render('cooperatives/edit', [
            'cooperative' => $cooperative,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCooperativeRequest $request, Cooperative $cooperative)
    {
        $cooperative->update($request->validated());

        return redirect()
            ->route('cooperatives.index')
            ->with('success', 'Cooperative updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cooperative $cooperative)
    {
        $cooperative->delete();

        return redirect()
            ->route('cooperatives.index')
            ->with('success', 'Cooperative deleted successfully.');
    }
}
