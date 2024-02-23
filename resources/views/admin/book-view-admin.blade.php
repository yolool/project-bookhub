@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <x-flash-message />
            <div class="card">
                <div class="card-header">{{ __('Book Details') }}</div>

                <div class="card-body space-y-2">

                        <div class="row items-center">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Book Name') }} -</label>
                            <div class="col-md-6">
                                <p id="name">{{ $book->name }}</p>
                            </div>
                        </div>

                        <div class="row items-center">
                            <label for="id" class="col-md-4 col-form-label text-md-right">{{ __('Database ID') }} -</label>
                            <div class="col-md-6">
                                <p id="id">{{ $book->id }}</p>
                            </div>
                        </div>

                        <div class="row items-center">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Category Name') }} -</label>
                            <div class="col-md-6">
                                <p id="category">{{ $book->category->name }}</p>
                            </div>
                        </div>

                        <div class="row items-center">
                            <label for="author" class="col-md-4 col-form-label text-md-right">{{ __('Author') }} -</label>
                            <div class="col-md-6">
                                <p id="author">{{ $book->author }}</p>
                            </div>
                        </div>

                        <div class="row items-center">
                            <label for="about" class="col-md-4 col-form-label text-md-right">{{ __('About') }} -</label>
                            <div class="col-md-6">
                                <p id="about">{{ $book->about }}</p>
                            </div>
                        </div>

                        <div class="row items-center">
                            <label for="filename" class="col-md-4 col-form-label text-md-right">{{ __('Filename (as PDF)') }} -</label>
                            <div class="col-md-6">
                                <p id="filename">{{ $book->filename }}</p>
                            </div>
                        </div>

                        <div class="row items-start">
                            <label for="covername" class="col-md-4 col-form-label text-md-right">{{ __('Cover Image') }} -</label>
                            <div class="col-md-6">
                                <p id="covername">{{ $book->covername ? $book->covername : 'No cover Image detected'}}</p>
                                <img src="/covers/{{ $book->covername }}" alt="cover image" onerror="this.src='/covers/placeholder.jpg'" class="h-36">
                            </div>
                        </div>

                        <div class="row items-center">
                            <label for="created_at" class="col-md-4 col-form-label text-md-right">{{ __('Created At') }} -</label>
                            <div class="col-md-6">
                                <p id="created_at">{{ $book->created_at }}</p>
                            </div>
                        </div>

                        <div class="row items-center">
                            <label for="updated_at" class="col-md-4 col-form-label text-md-right">{{ __('Last Updated At') }} -</label>
                            <div class="col-md-6">
                                <p id="updated_at">{{ $book->updated_at }}</p>
                            </div>
                        </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="/book-view?perform=edit&id={{ $book->id }}" class="btn btn-warning">
                                        {{ __('Edit Book Details') }}
                                    </a>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <a href="/book-view?perform=delete&id={{ $book->id }}" class="btn btn-danger text-white">
                                        {{ __('Delete Book') }}
                                    </a>
                                </div>
                            </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
