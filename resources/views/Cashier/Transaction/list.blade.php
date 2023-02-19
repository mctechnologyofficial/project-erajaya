@extends('layouts.app')
@section('title', 'Transaction')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
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
                                    <th class="wd-15p">Transaction Date</th>
                                    <th class="wd-15p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->customername }}</td>
                                        <td>{{ $data->total_price }}</td>
                                        <td>{{ \Carbon\Carbon::parse($data->created_at) }}</td>
                                        <td>
                                            @if ($data->status == 0)
                                                <a href="{{ route('cashier.transaction.show', $data->id) }}" class="btn btn-outline-info btn-block">See Details</a>
                                            @else
                                                <a href="javascript:void(0)" class="btn btn-outline-danger btn-block">Already Accepted!</a>
                                            @endif
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
