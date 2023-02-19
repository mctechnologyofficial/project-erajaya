<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Mail\NotifyMail;
use App\Mail\NotifyMailCustomer;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

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

        return view('Sales.Transaction.list', compact(['transaction']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCustomer()
    {
        $customer = Customer::all();
        return view('Sales.Transaction.addcustomer', compact(['customer']));
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
        if($request->customerid == ""){
            $customer = Customer::create([
                'nik'       => $request->nik,
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'address'   => $request->address,
            ]);

            Session::put('customerid', $customer->id);

            return redirect()->route('sales.transaction.createtransaction');
        }else{
            Session::put('customerid', $request->customerid);

            return redirect()->route('sales.transaction.createtransaction');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeTransaction(Request $request)
    {
        $transactionid = "EJ-".mt_rand(0, 9999999999);
        $customerid = Session::get('customerid');

        $transaction = Transaction::create([
            'id'                => $transactionid,
            'customer_id'       => $customerid,
            'total_price'       => $request->totalprice,
            'input_by'          => $request->inputby,
            'status'            => 0
        ]);

        Session::put('transactionid', $transaction->id);

        foreach($request->input('productid') as $key => $value) {

            $Record = new TransactionDetail;

            $Record->transaction_id = $transaction->id;
            $Record->product_id = $request->get('productid')[$key];
            $Record->qty = $request->get('qty')[$key];
            $Record->subtotal = $request->get('subtotal')[$key];

            $Record->save();
        }

        $transactions = Transaction::find(Session::get('transactionid'));
        $customer = Customer::find(Session::get('customerid'));
        $order = Transaction::selectRaw('products.product_name, transaction_details.qty, products.id, products.price, transaction_details.subtotal, transactions.total_price')
        ->join('transaction_details', 'transaction_details.transaction_id', '=', 'transactions.id')
        ->join('products', 'transaction_details.product_id', '=', 'products.id')
        ->where('transactions.id', Session::get('transactionid'))
        ->get();

        $pdf = Pdf::loadView('layouts.invoices', compact(['transactions', 'customer', 'order']));
        set_time_limit(300);

        $content = $pdf->download()->getOriginalContent();
        Storage::put('invoice/'. $transactions->id .'_erajaya_transaction_invoice.pdf', $content);

        $mail = Mail::to('manusiacoding29@gmail.com')->send(new NotifyMail());
        Mail::to($customer->email)->send(new NotifyMailCustomer());

        if (!$mail) {
            $response['data'] = "Failed";

            return response()->json($response);
        }else{
            $response['data'] = "Success";

            return response()->json($response);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaction = TransactionDetail::selectRaw('products.product_name as productname, transaction_details.*')
        ->join('products', 'products.id', '=', 'transaction_details.product_id')
        ->where('transaction_id', $id)
        ->get();

        return view('Sales.Transaction.show', compact(['transaction']));
    }
}
