@extends('layouts.app')
@section('title', 'Create Transaction')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    @if($message = Session::get('failed'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ route('sales.transaction.storetransaction') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">Product</label>
                            <select id="exampleInputEmail1" name="productid" class="form-control select2">
                                <option value="" selected disabled>Choose product</option>
                                @foreach ($product as $data)
                                    <option value="{{ $data->id }}">{{ $data->product_name }}</option>
                                    {{-- <input type="text" name="" id="price" value="{{ $data->price }}"> --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Product Price</label>
                            <input type="text" id="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Qty</label>
                            <input type="text" name="qty" id="qty" class="form-control" id="exampleInputPassword1" autocomplete="off" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Total Price</label>
                            <input type="text" name="totalprice" id="totalprice" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Input By</label>
                            <input type="text" name="inputby" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly value="{{ Auth::user()->name }}" />
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('.select2').on('change', function(){
                var id = $(this).val();

                $.ajax({
                    url: "/transaction/getprice/" + id,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response){
                        $('#price').val(response.data);
                    }
                });
            });

            $('#qty').on('keyup', function(){
                var a = $(this).val();
                var b = $('#price').val();
                var c = (a * b);

                $('#totalprice').val(c).trigger('change');
            });
        });
    </script>
@endsection
