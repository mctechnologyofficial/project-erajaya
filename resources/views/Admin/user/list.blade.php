@extends('layouts.app')
@section('title', 'User')

@section('content')
    <div class="row row-sm">
        <div class="col-lg-12">
            <div class="card custom-card">
                <div class="card-header text-right">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-outline-success mb-3">+ Create New User</a>
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
                                    <th class="wd-5p">#</th>
                                    <th class="wd-20p">Name</th>
                                    <th class="wd-20p">Email</th>
                                    <th class="wd-15p">Position</th>
                                    <th class="wd-20p">Image</th>
                                    <th class="wd-15p">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $key => $data)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->roles->first()->name }}</td>
                                    <td valign="middle" align="center">
                                        <img alt="avatar" src="{{ $data->image == null ? asset('assets/img/users/1.jpg') : asset($data->image) }}" class="img-thumbnail w-75" />
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.user.edit', $data->id) }}" class="btn btn-outline-info btn-block mb-3">Edit</a>
                                        <form action="{{ route('admin.user.destroy', $data->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-outline-danger btn-block">Delete</button>
                                        </form>
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
