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
                <h2 class="w-100">Sliders</h2>
                <a href="{{ route('slider.add') }}" class="btn btn-primary mt-2 mb-2">Add slide</a>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
Slider List
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col" style="width: 5%">#</th>
                                    <th scope="col" style="width: 15%">Title</th>
                                    <th scope="col" style="width: 35%">Description</th>
                                    <th scope="col" style="width: 25%">Image</th>
                                    <th scope="col" style="width: 20%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sliders as $slider)
                                    <tr>
                                        <th class="scope">{{ $loop->index }}</th>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ $slider->description }}</td>
                                        <td>
                                            <img src="{{asset($slider->image)}}" style="width: 100%;">
                                        </td>
                                        <td class="flex">
                                            <a href="{{ route('slider.edit', $slider->id)}}"
                                               class="btn btn-info">Edit</a>
                                            <a href="{{ route('slider.remove', $slider->id)}}"
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


