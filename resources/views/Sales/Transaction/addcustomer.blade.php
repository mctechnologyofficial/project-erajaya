@extends('layouts.app')
@section('title', 'Create Customer')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-header text-right">
                    <input class="btn btn-outline-success" id="customer" type="button" value="New Customer" />
                </div>
                <div class="card-body">
                    <form action="{{ route('sales.transaction.storecustomer') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Customer</label>
                                    <select id="exampleInputEmail1" name="customerid" class="form-control select2">
                                        <option value="" selected disabled>Choose customer</option>
                                        @foreach ($customer as $data)
                                            <option value="{{ $data->id }}">{{ '('.$data->nik.') '. $data->name }}</option>
                                            {{-- <input type="text" name="" id="price" value="{{ $data->price }}"> --}}
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">NIK</label>
                                    <input type="text" name="nik" id="nik" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled  />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Full Name</label>
                                    <input type="text" name="name" id="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled  />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="email" name="email" id="email" class="form-control" id="exampleInputPassword1" disabled />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" disabled />
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address</label>
                                    <textarea name="address" id="address" class="form-control" cols="30" rows="10" disabled></textarea>
                                </div>

                                <button type="submit" class="btn btn-outline-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('#customer').on('click', function(){
                var value = $(this).val();

                if(value == "New Customer"){
                    $(this).removeClass('btn-outline-success');
                    $(this).addClass('btn-outline-secondary');
                    $(this).val('Old Customer');

                    $('.select2').prop('disabled', 'disabled');
                    $('#nik').removeAttr('disabled');
                    $('#name').removeAttr('disabled');
                    $('#email').removeAttr('disabled');
                    $('#phone').removeAttr('disabled');
                    $('#address').removeAttr('disabled');
                }else{
                    $(this).removeClass('btn-outline-secondary');
                    $(this).addClass('btn-outline-success');
                    $(this).val('New Customer');

                    $('.select2').removeAttr('disabled');
                    $('#nik').prop('disabled', 'disabled');
                    $('#name').prop('disabled', 'disabled');
                    $('#email').prop('disabled', 'disabled');
                    $('#phone').prop('disabled', 'disabled');
                    $('#address').prop('disabled', 'disabled');
                }
            });
        });
    </script>
@endsection
