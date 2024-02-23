@extends('layouts.user-layout')
@section('user-content')
<div class="container mb-8">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <x-flash-message />
            <div class="card">
                <div class="card-header">{{ __('Book Details') }}</div>

                <div class="card-body sm:grid grid-cols-6 gap-2">

                    <div class="lg:col-span-1 col-span-2 mb-2">
                        <img src="/covers/{{ $book->covername }}" alt="book cover" onerror="this.src='/covers/placeholder.jpg'" class="rounded-md sm:h-auto h-48 mx-auto">
                    </div>

                    <div class="lg:col-span-5 col-span-4 sm:pl-2 relative mt-1">
                            <h2 class="text-2xl">{{ $book->name }}</h2>
                            <span class="text-muted text-sm">Author: </span><small class="font-semibold">{{ $book->author }}</small>  
                            <p class="lg:absolute top-0 right-0"><small class="border border-1 bg-blue-500 text-white rounded-md px-3 lg:py-1">{{ $book->category->name }}</small></p>

                            <p class="mt-3 p-2 border border-1 rounded-md sm:text-md text-sm text-justify">{{ $book->about }}</p>
                              
                            <div class="mt-4 font-semibold">   
                                <i class="text-muted text-xs mb-2 block text-justify pr-1">Please note that some browsers may have issues opening PDF files. For better experience, we suggest downloading the file and opening it using native applications that support PDF viewing. For Safari, directly use the download link to view the PDF.</i>  
                                <div class="mt-2 text-md-left text-center">      
                                    <a class="btn btn-success lg:w-32 w-28 m-2" href="{{ url('/download', $book->filename) }}" target="_blank">Download</a>
                                    <a class="btn btn-outline-info lg:w-32 w-28 m-2" href="{{ url('/preview', $book->filename) }}" target="_blank">Preview</a>
                                </div> 
                            </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
