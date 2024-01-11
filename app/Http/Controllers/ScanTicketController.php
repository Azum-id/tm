<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ticket;
use App\Models\ScanTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScanTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if user->role is admin then show all transactions, else show only transactions that belongs to the user

        if (auth()->user()->role == "admin") {
            $todayDate = Carbon::today()->toDateString();
            $scanTickets = ScanTicket::with('ticket', 'user')
                ->whereDate('created_at', $todayDate)
                ->whereHas('ticket', function ($query) {
                    // Tambahkan kondisi untuk created_at tiket
                    $query->whereDate('created_at', date('Y-m-d'));
                })
                ->get();
            $todayDate = now()->toDateString();

            $oldScanTickets = ScanTicket::with('ticket', 'user')
                ->whereDate('created_at', $todayDate)
                ->whereHas('ticket', function ($query) use ($todayDate) {
                    // Tambahkan kondisi untuk created_at tiket
                    $query->whereDate('created_at', '<', $todayDate);
                })
                ->get();
        } else {

            $todayDate = Carbon::today()->toDateString();
            $scanTickets = ScanTicket::with('ticket', 'user')
                ->where('user_id', auth()->user()->id)
                ->whereDate('created_at', $todayDate)
                ->whereHas('ticket', function ($query) use ($todayDate) {
                    // Tambahkan kondisi untuk created_at tiket
                    $query->whereDate('created_at',  $todayDate);
                })
                ->get();
            $todayDate = now()->toDateString();

            $oldScanTickets = ScanTicket::with('ticket', 'user')
                ->where('user_id', auth()->user()->id)
                ->whereDate('created_at', $todayDate)
                ->whereHas('ticket', function ($query) use ($todayDate) {
                    // Tambahkan kondisi untuk created_at tiket
                    $query->whereDate('created_at', '<', $todayDate);
                })
                ->get();
        }
        $array_m = [
            'scanTickets' => $scanTickets,
            'oldScanTickets' => $oldScanTickets,
        ];
        // return $array_m;
        return view('operator.historyscan', compact('array_m'));
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
        // validate request
        $request->validate([
            'kode_tiket' => 'required|exists:tickets,ticket_code',
        ], [
            'kode_tiket.required' => 'Kolom kode tiket wajib diisi.',
            'kode_tiket.exists' => 'Kode tiket tidak valid.',
        ]);

        // check if ticket is valid
        $ticket = Ticket::with('transaction')
            ->where('ticket_code', $request->kode_tiket)
            ->first();
        if ($ticket->status == "inactive") {
            return response()->json([
                'status' => 'error',
                'message' => 'Tiket sudah tidak aktif',
                'used' => true,
                'data' => $ticket,
            ], 400);
        }
        try {
            DB::beginTransaction();
            ScanTicket::create([
                'ticket_id' => $ticket->id,
                'transaction_id' => $ticket->transaction->id,
                'user_id' => auth()->user()->id,
            ]);
            // update ticket status
            $ticket->status = "inactive";
            $ticket->save();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat melakukan scan tiket',
                'used' => false,
                'data' => $th->getMessage(),
            ], 500);
        }
        // api response
        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil melakukan scan tiket',
            'used' => false,
            'data' => $ticket,
        ], 200);
    }


    /**
     * Display the specified resource.
     */
    public function show(ScanTicket $scanTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ScanTicket $scanTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ScanTicket $scanTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ScanTicket $scanTicket)
    {
        //
    }
}
