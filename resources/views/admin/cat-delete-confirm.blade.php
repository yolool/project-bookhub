@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">
                <div class="card-header">{{ __('Delete Category') }}</div>

                <div class="card-body">
                    <form method="POST" action="/cat-delete" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4 italic">
                                <h2>Please confirm carefully before deleting the category.</h2>
                                <h2>The following category will be deleted from the database.</h2>
                            </div>
                        </div>

                        <div class="form-group row items-center">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }}</label>

                            <div class="col-md-6">
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                <p id="name">{{ $category->name }}</p>
                            </div>
                        </div>

                        <div class="form-group row items-center">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Category Description') }}</label>

                            <div class="col-md-6">
                                <p id="description">{{ $category->description }}</p>
                            </div>
                        </div>

                        <div class="form-group row items-center">
                            <label for="last_modified" class="col-md-4 col-form-label text-md-right">{{ __('Category Last Updated At') }}</label>

                            <div class="col-md-6">
                                <p id="last_modified">{{ $category->updated_at }}</p>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Delete Category') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
