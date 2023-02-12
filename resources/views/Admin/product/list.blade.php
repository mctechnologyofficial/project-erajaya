@extends('layouts.app')
@section('title', 'Product')

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
                                {{--  --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
