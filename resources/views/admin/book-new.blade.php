@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
           
            <div class="card">
                <div class="card-header">{{ __('Add New Book') }}</div>

                <div class="card-body">
                    <form method="POST" action="/book-add" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <h2 class="">Please confirm the details carefully before adding a new book</h2>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Book Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Author') }}</label>
                            <div class="col-md-6">
                                <input id="author" type="text" class="form-control" name="author" value="" required autocomplete="author" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="about" class="col-md-4 col-form-label text-md-right">{{ __('About This Book') }}</label>
                            <div class="col-md-6">
                                <textarea id="about" class="form-control" name="about" required></textarea>
                            </div>
                        </div>

                        <div class="form-group row items-center">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Select Category') }}</label>
                            <div class="col-md-6">
                                <select name="category" id="category" class="border border-2 rounded-md px-1 py-1" required>
                                    <option value="">Select a Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pdf" class="col-md-4 col-form-label text-md-right">{{ __('Please upload PDF file of the Book') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="pdf" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cover" class="col-md-4 col-form-label text-md-right">{{ __('Please choose a thumbnail image (Optional)') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="cover" >
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add New Book') }}
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
