@extends('admin.admin_master')

@section('admin')
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Edit Brand
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.brand', $brand->id) }}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="old_image" value="{{ $brand->brand_image  }}">
                            <div class="form-group">
                                <label for="brandName">Brand Name</label>
                                <input type="text" class="form-control" id="brandName"
                                       aria-describedby="brandName" name="brand_name"
                                       value="{{ $brand->brand_name }}">
                                @error('brand_name')
                                <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="brandImage">Brand Image</label>

                                <input type="file" class="form-control" id="brandImage"
                                       aria-describedby="brandImage" name="brand_image"
                                       value="{{ $brand->brand_image }}">
                                @error('brand_name')
                                <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <img src="{{ asset($brand->brand_image) }}" width="200" alt="brand logo image">
                            </div>

                            <button type="submit" class="btn btn-primary">Update brand</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
