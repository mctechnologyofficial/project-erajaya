<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaction = Transaction::selectRaw('customers.name AS customername, products.product_name AS productname, transactions.*')
        ->join('customers', 'customers.id', '=', 'transactions.customer_id')
        ->join('products', 'products.id', '=', 'transactions.product_id')
        ->get();

        return view('Sales.Transaction.list', compact(['transaction']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCustomer()
    {
        return view('Sales.Transaction.addcustomer');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createTransaction()
    {
        $product = Product::all();

        return view('Sales.Transaction.addtransaction', compact(['product']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCustomer(Request $request)
    {
        $customer = Customer::create([
            'nik'       => $request->nik,
            'name'      => $request->name,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'   => $request->address,
        ]);

        Session::put('customerid', $customer->id);

        return redirect()->route('sales.transaction.createtransaction');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTransaction(Request $request)
    {
        $product = Product::find($request->productid);

        if($product->stock > 0){
            $transactionid = "EJ-".mt_rand(0, 999999);
            $customerid = Session::get('customerid');

            $transaction = Transaction::create([
                'id'                => $transactionid,
                'customer_id'       => $customerid,
                'product_id'        => $request->productid,
                'qty'               => $request->qty,
                'total_price'       => $request->totalprice,
                'input_by'          => $request->inputby,
            ]);
            return redirect()->route('sales.transaction.index')->with('success', 'Transaction Success !');
        }else{
            return redirect()->route('sales.transaction.createtransaction')->with('failed', 'Out of Stock !');
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getPrice($id)
    {
        $product = Product::find($id);

        $response['data'] = $product->price;

        return response()->json($response);
    }
}
