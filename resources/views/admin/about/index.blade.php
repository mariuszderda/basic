@extends('admin.admin_master')

@section('admin')
    <div class="py-12">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="row">
                <h2 class="w-100">About content</h2>
                <a href="{{ route('about.create') }}" class="btn btn-primary mt-2 mb-2">Add about content</a>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            About List
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th scope="col" style="width: 15%">Title</th>
                                    <th scope="col" style="width: 35%">Short description</th>
                                    <th scope="col" style="width: 35%">Long description</th>
                                    <th scope="col" style="width: 20%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($abouts as $about)
                                    <tr>
                                        <th class="scope">{{ $loop->index + 1 }}</th>
                                        <td>{{ $about->title }}</td>
                                        <td>{{ $about->short_description }}</td>
                                        <td>{{ $about->long_description }}</td>
                                        <td class="flex">
                                            <a href="{{ route('about.edit', $about->id)}}"
                                               class="btn btn-info">Edit</a>
                                            <a href="{{ route('about.delete', $about->id)}}"
                                               class="btn btn-danger ml-2"
                                               onclick="return confirm('Are you sure?')">Delete</a>
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
    </div>
@endsection


