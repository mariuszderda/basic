@extends('admin.admin_master')

@section('admin')
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
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sliders as $slider)
                                    <tr>
                                        <th class="scope">{{ $sliders->firstItem() +  $loop->index }}</th>
                                        <td>{{ $slider->category_name }}</td>
                                        <td>{{ $slider->user->name }}</td>
                                        <td>
                                            @if($slider->created_at == NULL)
                                                <span>Brak daty</span>
                                            @else
                                                {{ $slider->created_at->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td class="flex">
                                            <a href="{{ route('edit.category', $slider->id)}}"
                                               class="btn btn-info">Edit</a>
                                            <a href="{{ route('remove.category', $slider->id)}}"
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


@endsection
