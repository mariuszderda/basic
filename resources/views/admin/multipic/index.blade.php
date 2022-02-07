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
                    <div class="card-group">
                        @foreach($images as $multi)
                            <div class="col-md-4 mt-5">
                                <div class="card">
                                    <img src="{{ asset($multi->image) }}" alt="">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Image
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.image') }}" method="POST"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="image">Brand Image</label>
                                    <input type="file" class="form-control" id="image"
                                           aria-describedby="image" name="image[]"
                                           multiple="">
                                    @error('image')
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
