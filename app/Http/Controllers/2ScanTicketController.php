<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class ScanTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('operator.scan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // check if ticket is valid
        if (Ticket::where('ticket_code', $request->ticket_code)->exists()) {
            $ticket = Ticket::where('ticket_code', $request->ticket_code)->first();
            if ($ticket->status == "inactive") {
                return redirect()->back()->with('error', 'Tiket sudah digunakan');
            }
            $ticket->status = "inactive";
            $ticket->save();
            return redirect()->back()->with('success', 'Tiket berhasil divalidasi');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
