@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
           
            <div class="card">
                <div class="card-header">{{ __('Edit Book Details') }}</div>

                <div class="card-body">
                    <form method="POST" action="/book-update" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <h2 class="">Please confirm the details carefully before editing the book</h2>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Book Name') }}</label>
                            <div class="col-md-6">
                                <input type="hidden" name="id" value="{{ $book->id }}">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $book->name }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Author') }}</label>
                            <div class="col-md-6">
                                <input id="author" type="text" class="form-control" name="author" value="{{ $book->author }}" required autocomplete="author" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="about" class="col-md-4 col-form-label text-md-right">{{ __('About This Book') }}</label>
                            <div class="col-md-6">
                                <textarea id="about" class="form-control" name="about" required>{{ $book->about }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row items-center">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Select Category') }}</label>
                            <div class="col-md-6">
                                <select name="category" id="category" class="border border-2 rounded-md px-1 py-1" required>
                                    <option value="">Select a Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $book->category_id ? 'selected' : ''}}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="pdf" class="col-md-4 col-form-label text-md-right">{{ __('Current File Name') }}</label>
                            <div class="col-md-6">
                                <p>{{ $book->filename }}</p>   
                                <div>

                                @if ($filecheck)
                                <div class="flex items-center">
                                    <p>File Present</p>
                                    <div class="pl-1">
                                        <x-tick-svg />
                                    </div>
                                </div>
                                @else 
                                <div class="flex items-center">
                                    <p>File Not Found. Please select a new file.</p>
                                    <div class="pl-1">
                                        <x-cross-svg />
                                    </div>
                                </div>
                                @endif

                                </div>
                            </div>
                        </div>

                        <div class="form-group row items-center">
                            <label for="pdf" class="col-md-4 col-form-label text-md-right">{{ __('Upload a new PDF file') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="pdf" {{ $filecheck ? '' : 'required'}} id="pdf">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cover" class="col-md-4 col-form-label text-md-right">{{ __('Current Cover Image') }}</label>
                            <div class="col-md-6">
                                <p>{{ $book->covername }}</p>
                                <img src="/covers/{{ $book->covername }}" alt="cover image" onerror="this.src='/covers/placeholder.jpg'" class="h-36">   
                                <div>

                                @if ($covercheck)
                                <div class="flex items-center">
                                    <p>Cover Image Present</p>
                                    <div class="pl-1">
                                        <x-tick-svg />
                                    </div>
                                </div>
                                @else 
                                <div class="flex items-center">
                                    <p>Cover Image Not Found. Choose a new image.</p>
                                    <div class="pl-1">
                                        <x-cross-svg />
                                    </div>
                                </div>
                                @endif

                                </div>
                            </div>
                        </div>

                        <div class="form-group row items-center">
                            <label for="cover" class="col-md-4 col-form-label text-md-right">{{ __('Upload a new cover image') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="cover" id="cover">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Book') }}
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
