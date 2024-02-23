@extends('layouts.app')
@section('content')

<style>
th, td {
    padding-left: 5px;
}
</style>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-11">

            <x-flash-message />

            <div class="card">
                <div class="card-header flex">
                    <div>
                    {{ __('Dashboard') }}
                    </div>

                @if (request("select") == "books" || !request("select"))
                    <div class="ml-auto flex space-x-4">

                        {{-- add book link  --}}
                        <div class="hover:bg-gray-300 px-2">
                            <a href="/book-view?perform=add" class="hover:text-black hover:no-underline">{{ __('Add Book') }}</a>
                        </div>

                        {{-- filter by category select form--}}
                        <form class="px-2" action="/home?select=books" method="GET">
                            <input type="hidden" name="select" value="books">
                            <select name="categorySearch" id="categorySearch" class="px-2 border border-1 border-black rounded-md" onchange="this.form.submit()">
                                <option value="">All Categories</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == request('categorySearch') ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>

                    </div>
                @endif

                @if (request("select") == "categories")
                    <div class="ml-auto flex space-x-4">
                        <div class="hover:bg-gray-300 px-2">
                            <a href="/cat?perform=add" class="hover:text-black hover:no-underline">{{ __('Add Category') }}</a>
                        </div>
                    </div>
                @endif

                </div>

                {{-- Book table --}}
                @if (request("select") == "books" || !request("select"))
                <table class="table-striped table-bordered">
                    <thead>
                    <tr class="text-center py-2 px-2">
                        <th>No.</th>
                        <th>Book Name</th>
                        <th>Category</th>
                        <th>Author</th>
                        <th>Edit or Remove</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($items as $item)
                    <tr class="">
                        <td class="text-right pr-2">{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->author }}</td>
                        <td class="text-center"><a href="/book-view?id={{ $item->id }}" class="btn btn-info">View Book Details</a></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                @endif

                {{-- Categories table --}}
                @if (request("select") == "categories")
                <table class="table-striped table-bordered">
                    <thead>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Last Modified</th>
                        <th>Edit or Remove</th>
                    </tr>
                    </thead>
                    @foreach ($items as $item)
                    <tr>
                        <td class="text-right pr-2">{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->description }}</td>
                        <td>{{ $item->created_at }}</td>
                        <td class="flex px-4 space-x-2">
                            <a class="px-2 py-1 bg-gray-300 text-black hover:bg-gray-100 hover:text-bold"
                            href="/cat?perform=edit&id={{$item->id}}">Edit</a>
                            <a class="px-2 py-1 bg-gray-300 text-black hover:bg-gray-100 hover:text-bold"
                            href="/cat?perform=delete&id={{$item->id}}">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                @endif
            </div>
            {{-- Pagination links --}}
            <div class="m-2">
                 {{ $items->links('pagination.custom-pagination', ["showInfo"=>true]) }}
            </div>
        </div>
    </div>
</div>
@endsection
