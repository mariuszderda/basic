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
                 <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            Edit Category
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update.category', $categories->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="categoryName">Category Name</label>
                                    <input type="text" class="form-control" id="categoryName"
                                           aria-describedby="categoryName" name="category_name"
                                           value="{{ $categories->category_name }}">
                                    @error('category_name')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
