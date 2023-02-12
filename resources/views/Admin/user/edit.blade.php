@extends('layouts.app')
@section('title', 'Edit User')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-body">
                    <form action="{{ route('admin.user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="form-group">
                            <label for="exampleInputEmail1">Full Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $user->name }}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $user->email }}" />
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Position</label>
                            <select name="position" id="exampleInputEmail1" class="form-control">
                                <option value="" selected disabled>Choose position</option>
                                @foreach ($role as $data)
                                    <option value="{{ $data->name }}" @if($user->roles->first()->name == $data->name) selected @endif>{{ $data->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-outline-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
