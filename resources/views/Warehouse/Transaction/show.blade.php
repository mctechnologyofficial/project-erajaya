@extends('layouts.app')
@section('title', 'Show Transaction')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="example1">
                            <thead>
                                <tr>
                                    <th class="wd-5p">Transaction ID</th>
                                    <th class="wd-20p">Product Name</th>
                                    <th class="wd-10p">Qty</th>
                                    <th class="wd-10p">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaction as $data)
                                    <tr>
                                        <td>{{ $data->transaction_id }}</td>
                                        <td>{{ $data->productname }}</td>
                                        <td>{{ $data->qty }}</td>
                                        <td>{{ $data->subtotal }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{ route('warehouse.transaction.update', $id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-outline-success">Accept</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
