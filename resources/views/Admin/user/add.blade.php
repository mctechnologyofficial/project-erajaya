@extends('layouts.app')
@section('title', 'Create User')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('admin.user.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="exampleInputEmail1">Full Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" />
                            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Position</label>
                            <select name="position" id="exampleInputEmail1" class="form-control">
                                <option value="" selected disabled>Choose position</option>
                                @foreach ($role as $data)
                                    <option value="{{ $data->name }}">{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                        </div>
                        <div class="form-group">
                            <label for="file-browser">Image</label>
                            <div class="input-group file-browser">
                                <input type="text" id="file-browser" class="form-control border-right-0 browse-file" placeholder="choose" readonly>
                                <label class="input-group-btn">
                                    <span class="btn btn-primary">
                                        Browse <input type="file" name="image" style="display: none;" multiple accept="image/*">
                                    </span>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
