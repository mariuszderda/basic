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
                <div class="col-md-8 mb-4">
                    <div class="card">
                        <div class="card-header">
                            All Brands
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Brand name</th>
                                    <th scope="col">Brand image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($brands as $brand)
                                    <tr>
                                        <th class="scope">{{ $brands->firstItem() +  $loop->index }}</th>
                                        <td>{{ $brand->brand_name }}</td>
                                        <td><img src="{{ asset($brand->brand_image) }}" width="70" height="40" alt=""></td>
                                        <td>
                                            @if($brand->created_at == NULL)
                                                <span>Brak daty</span>
                                            @else
                                                {{ $brand->created_at->diffForHumans() }}
                                            @endif
                                        </td>
                                        <td class="flex">
                                            <a href="{{ route('edit.brand', $brand->id)}}" class="btn btn-info">Edit</a>
                                            <a href="{{ route('remove.brand', $brand->id)}}"
                                               class="btn btn-danger ml-2"
                                               onclick="return confirm('Are you sure?')">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div>
{{--                            {{ $brands->links() }}--}}
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Brand
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="brandName">Brand Name</label>
                                    <input type="text" class="form-control" id="brandName"
                                           aria-describedby="brandName" name="brand_name"
                                           placeholder="Brand name">
                                    @error('brand_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="brandImage">Brand Name</label>
                                    <input type="file" class="form-control" id="brandImage"
                                           aria-describedby="brandImage" name="brand_image"
                                           placeholder="Brand Image">
                                    @error('brand_image')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Add brand</button>
                            </form>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

@endsection
