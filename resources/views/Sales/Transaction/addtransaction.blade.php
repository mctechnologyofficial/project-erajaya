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

                    <div class="form-group">
                        <label for="productid">Product</label>
                        <select id="productid" name="productid" class="form-control select2">
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
                        <label for="exampleInputEmail1">Sub Total</label>
                        <input type="text" name="subtotal" id="subtotal" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="0" readonly />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Total Price</label>
                        <input type="text" name="totalprice" id="totalprice" class="form-control" id="exampleInputEmail1" value="0" readonly />
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Input By</label>
                        <input type="text" name="inputby" id="inputby" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" readonly value="{{ Auth::user()->name }}" />
                    </div>

                    <input type="button" id="submit" class="btn btn-outline-info" value="Submit" />
                    <input type="button" id="transaction" class="btn btn-outline-primary" value="Transaction Now" />
                </div>
                <div class="card-footer">

                    <form id="dynamictransaction" action="{{ route('sales.transaction.storetransaction') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <table class="table table-bordered table-hover" id="buylist">
                            <thead>
                                <th>Product ID</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Qty</th>
                                <th>Subtotal</th>
                            </thead>
                            <tbody>
                                {{--  --}}
                            </tbody>
                        </table>
                    </form>
                    <form action="" id="showinvoice" method="GET">
                        @csrf
                        <button type="submit" class="d-none" id="btntriggerinvoice"></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function(){
            var c;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
                c = (a * b);

                var totalprice = parseInt($('#totalprice').val());
                var total = totalprice + c;
                var p = totalprice - total;

                $('#subtotal').val(c).trigger('change');
                $('#totalprice').val(total).trigger('change');

            });

            $('#totalprice').on('change', function(){
                this.oldvalue += parseInt($('#subtotal').val());
            });

            $('#submit').on('click', function(){
                var id = $('#productid').val();
                var name = $('#productid option:selected').html();
                var price = $('#price').val();
                var qty = $('#qty').val();
                var subtotal = $('#subtotal').val();

                var data = "<tr>" +
                                "<td> <input type='text' name='productid[]' class='border-0 form-control text-dark' value='" + id + "' readonly /></td>" +
                                "<td> <input type='text' name='name[]' class='border-0 form-control text-dark' value='" + name + "' readonly /></td>" +
                                "<td> <input type='text' name='price[]' class='border-0 form-control text-dark' value='" + price + "' readonly /></td>" +
                                "<td> <input type='text' name='qty[]' class='border-0 form-control text-dark' value='" + qty + "' readonly /></td>" +
                                "<td> <input type='text' name='subtotal[]' class='border-0 form-control text-dark' value='" + subtotal + "' readonly /></td>" +
                            "</tr>";

                $('#buylist tbody').append(data);

                $('#productid').val("").change();
                $('#price').val("");
                $('#qty').val("");
                $('#subtotal').val("");
                $('#price').val(0);
            });

            $('#transaction').on('click', function(){
                var totalprice = $('#totalprice').val();
                var inputby = $('#inputby').val();
                var tablelength = $('#buylist tbody tr').length;

                if(tablelength > 0){
                    $.ajax({
                        url: "{{ route('sales.transaction.storetransaction') }}",
                        method: "POST",
                        data: $('#dynamictransaction').serialize() + "&totalprice=" + totalprice + "&inputby=" + inputby,
                        type: 'json',
                        success: function(response){
                            if(response.data == "Success"){
                                Swal.fire(
                                    'Good job!',
                                    'Transaction Success!',
                                    'success'
                                ).then((result) => {
                                    if($('#showinvoice').attr('action', "{{ route('sales.invoice.index') }}")){
                                        $('#btntriggerinvoice').click();
                                        // window.location.replace("http://localhost:8000/transaction");
                                    }
                                });
                            }else{
                                Swal.fire(
                                    'Error!',
                                    'Something Beyond Expectation, Try Again!',
                                    'error'
                                )
                            }
                        }
                    });
                }else{
                    Swal.fire(
                        'Error!',
                        'You must input at least 1 data!',
                        'error'
                    );
                }
            });
        });
    </script>
@endsection
