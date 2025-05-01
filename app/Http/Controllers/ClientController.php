<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    // Retrieve search filters from the request
    $search = $request->input('search');
    $gender = $request->input('gender');
    $dob = $request->input('dob');
    $id = $request->input('id'); // Retrieve the ID filter

    // Build the query
    $query = Client::query();

    if ($id) {
        // If ID is provided, filter by ID only
        $query->where('id', $id);
    } else {
        // Apply other filters if ID is not provided
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('address', 'like', '%' . $search . '%');
            });
        }

        if ($gender) {
            $query->where('gender', $gender);
        }

        if ($dob) {
            $query->whereDate('dob', $dob);
        }
    }

    // Get the filtered clients with pagination
    $clients = $query->paginate(10);

    // Pass the filters back to the view
    return view('clients.index', [
        'clients' => $clients,
        'search' => $search,
        'gender' => $gender,
        'dob' => $dob,
        'id' => $id,
    ]);
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
        ]);
    
        Client::create($request->all());
    
        return redirect()->route('clients.index')->with('success', 'Client added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'dob' => 'required|date',
        ]);
    
        $client->update($request->all());
    
        return redirect()->route('clients.index')->with('success', 'Client updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
    return redirect()->route('clients.index')->with('success', 'Client deleted successfully');
    }

    public function exportPdf(Request $request)
{
    $search = $request->input('search');
    $gender = $request->input('gender');
    $dob = $request->input('dob');
    $id = $request->input('id');

    $clients = Client::query()
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
        })
        ->when($gender, function ($query, $gender) {
            $query->where('gender', $gender);
        })
        ->when($dob, function ($query, $dob) {
            $query->where('dob', $dob);
        })
        ->when($id, function ($query, $id) {
            $query->where('id', $id);
        })
        ->orderBy('name', 'asc')
        ->get();

    $pdf = Pdf::loadView('clients.pdf', compact('clients'));

    return $pdf->download('clients.pdf');
}




}
