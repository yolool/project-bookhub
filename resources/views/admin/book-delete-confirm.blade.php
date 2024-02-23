@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">
            
            <div class="card">
                <div class="card-header">{{ __('Confirm Book Delete') }}</div>

                <div class="card-body space-y-2">

                     <form method="POST" action="/book-delete">
                        @csrf
                        <div class="row items-center">
                            <label for="name" class="col-md-6 col-form-label text-md-right text-xl">Are you sure you want to delete this book? <br/>[Warning: this action is irreversible]</label>
                            <div class="col-md-6">
                                <input type="hidden" value="{{ $book->id }}" name="id">
                                <p id="name" class="text-xl text-semibold">{{ $book->name }}</p>
                            </div>
                        </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-6">
                                    <button type="submit" class="btn btn-danger">
                                    {{ __('Delete Book') }}
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
