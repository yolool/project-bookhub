@extends('layouts.user-layout')
@section('user-content')
        <section class="container">
                <form action="/" method="GET" class="text-center lg:float-right">
                    <label for="categorySearch" class="pr-2">Filter By Category</label>
                    <select name="categorySearch" id="categorySearch" class="px-2 py-1 border border-2 border-gray-500 rounded-md" onchange="this.form.submit();">
                            <option value="">All Categories</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $category->id == request("categorySearch") ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </section>
            
        

        <section class="container lg:mt-14 mt-8">
            {{-- pagination links top  --}}
            <div class="m-4">
                 {{ $books->links('pagination.custom-pagination') }}
            </div> 

            <div class="inline-grid lg:grid-cols-3 md:grid-cols-2 gap-2">
                @foreach($books as $book)
                <a href="/book?id={{ $book->id }}" class="hover:no-underline hover:text-black">
                    <div class="grid grid-cols-12 border border-1 rounded-md hover:bg-gray-300 focus:bg-gray-300 h-full">
                        <div class="col-span-4 sm:col-span-3 p-2">
                            <img src="/covers/{{ $book->covername }}" alt="book cover" onerror="this.src='/covers/placeholder.jpg'"  class="rounded-md img-cover">
                        </div>
                        <div class="col-span-8 sm:col-span-9 p-2 relative">
                            <h2 class="font-bold text-md sm:text-lg">{{ $book->name }}</h2>
                            <p class="text-muted text-xs mt-1">Author: {{ $book->author }}</p>
                            <p class="absolute bottom-2 right-2"><small class="bg-blue-500 text-white rounded-md px-3 py-1">{{ $book->category->name }}</small></p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- pagination links bottom --}}
            <div class="m-2">
                 {{ $books->links('pagination.custom-pagination', ["showInfo"=>true]) }}
            </div>
        </section>

@endsection
