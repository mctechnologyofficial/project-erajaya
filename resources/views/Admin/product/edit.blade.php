@extends('layouts.app')
@section('title', 'Edit Product')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('admin.product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="exampleInputEmail1">IMEI</label>
                            <input type="text" name="imei" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $product->imei }}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $product->product_name }}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Price</label>
                            <input type="text" name="price" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $product->price }}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Stock</label>
                            <input type="text" name="stock" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $product->stock }}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category</label>
                            <select name="category" id="exampleInputEmail1" class="form-control">
                                <option value="" selected disabled>Choose category</option>
                                <option value="Handphone" @if($product->category == "Handphone") selected @endif>Handphone</option>
                                <option value="Accessories" @if($product->category == "Accessories") selected @endif>Accessories</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
