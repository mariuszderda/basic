@extends('admin.admin_master')

@section('admin')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Add about</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('about.update', $about->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                               value="{{ $about->title }}">
                    </div>
                    <div class="form-group">
                        <label for="short_description">Short description</label>
                        <textarea class="form-control" name="short_description" id="short_description" rows="3">
                            {{ $about->short_description }}
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label for="long_description">Long description</label>
                        <textarea class="form-control" name="long_description" id="long_description" rows="3">
                            {{ $about->long_description }}
                        </textarea>
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
