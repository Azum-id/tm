<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\WebsiteConfig;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // if user->role is admin then show all transactions, else show only transactions that belongs to the user,set date to today
        if (auth()->user()->role == "admin") {
            $transactions = Transaction::with('user')
                ->whereDate('created_at', date('Y-m-d'))
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $transactions = Transaction::with('user')
                ->where('user_id', auth()->user()->id)
                ->whereDate('created_at', date('Y-m-d'))
                ->orderBy('created_at', 'desc')
                ->get();
        }
        // return $transactions;
        return view('operator.historyjual', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('operator.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // if nama_pengunjung is empty then use default value
        if (empty($request->nama_pengunjung)) {
            request()->nama_pengunjung = "Guest";
        }

        $request->validate([
            'jumlah_tiket' => 'required|numeric|min:1',
        ]);
        $date = $this->generateFormatedDate(date('Y-m-d'));
        $harga_tiket = WebsiteConfig::where('nama_config', 'harga_tiket')->first()->value;
        try {
            DB::beginTransaction();
            $transaction = Transaction::create([
                'trx_code' => "TRX" . $date  . $this->generateUniqueTransactionCode(),
                'customer_name' => $request->nama_pengunjung,
                'total_ticket' => $request->jumlah_tiket,
                'user_id' => auth()->user()->id,
                'ticket_price' => $harga_tiket,
                'total_price' => $harga_tiket * $request->jumlah_tiket,
            ]);
            for ($i = 0; $i < $request->jumlah_tiket; $i++) {
                Ticket::create([
                    'ticket_code' => "TM" . $date .  $this->generateUniqueTicketCode(),
                    'transaction_id' => $transaction->id,
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            Log::error('Error during transaction: ' . $th->getMessage());
            DB::rollBack();
            // api response
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat melakukan transaksi',
                'data' => $th->getMessage(),
            ], 500);
        }
        // api response
        return response()->json([
            'status' => 'success',
            'message' => 'Transaksi berhasil dilakukan',
            'data' => $transaction,
        ], 200);
    }

    private function generateFormatedDate($date)
    {
        return date('Ymd', strtotime($date));
    }

    private function generateUniqueTransactionCode($length = 8)
    {
        $date = $this->generateFormatedDate(date('Y-m-d'));
        $code = $this->generateRandomCode($length);


        while (Transaction::where('trx_code', "TRX" . $date . "" . $code)->exists()) {
            $code = $this->generateRandomCode($length);
        }

        return $code;
    }

    private function generateUniqueTicketCode($length = 8)
    {
        $date = $this->generateFormatedDate(date('Y-m-d'));
        $code = $this->generateRandomCode($length);


        while (Ticket::where('ticket_code', "TM" . $date . "" . $code)->exists()) {
            $code = $this->generateRandomCode($length);
        }

        return $code;
    }


    private function generateRandomCode($length = 8)
    {

        return strtoupper(Str::random($length));
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
