<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::selectRaw('customers.name AS customername, transactions.*')
        ->join('customers', 'customers.id', '=', 'transactions.customer_id')
        ->get();

        return view('Cashier.Transaction.list', compact(['transaction']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = TransactionDetail::selectRaw('transactions.status, products.product_name as productname, transaction_details.*')
        ->join('transactions', 'transactions.id', '=', 'transaction_details.transaction_id')
        ->join('products', 'products.id', '=', 'transaction_details.product_id')
        ->where('transaction_id', $id)
        ->get();

        return view('Cashier.Transaction.show', compact(['transaction', 'id']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if($transaction->status == 0){
            return redirect()->route('cashier.transaction.index')->with('error', 'Product with transaction id ' . $id . ' has not arrived! Be patient please.');
        }
        else if($transaction->status == 2){
            return redirect()->route('cashier.transaction.index')->with('error', "Transaction with id " . $id . " has been completed! You can't update it anymore.");
        }
        else{
            Transaction::where('id', $id)->update([
                'status'    => 2,
            ]);

            return redirect()->route('cashier.transaction.index')->with('success', 'Transaction with id '. $id . ' has been updated successfully !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
