@extends('layouts.app')
@section('title', 'Transaction')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-header text-right">
                    <a href="{{ route('sales.transaction.createcustomer') }}" class="btn btn-outline-success mb-3">+ Create New Transaction</a>
                </div>
                <div class="card-body">
                    @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-5p">Transaction ID</th>
                                    <th class="wd-20p">Customer Name</th>
                                    <th class="wd-10p">Total Price</th>
                                    <th class="wd-15p">Input By</th>
                                    <th class="wd-15p">Transaction Date</th>
                                    <th class="wd-150">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->customername }}</td>
                                        <td>{{ $data->total_price }}</td>
                                        <td>{{ $data->input_by }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->created_at) }}</td>
                                        <td>
                                            <a href="{{ route('sales.transaction.show', $data->id) }}" class="btn btn-outline-info btn-block">See Details</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
