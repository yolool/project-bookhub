<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Book;
use App\Models\Category;

class WelcomeController extends Controller
{
    
    function index () {
        if (request("categorySearch")) {
            $books = Book::where('category_id', request('categorySearch'))->with('category')->orderBy('name')->paginate(18);
        } else {
            $books = Book::with('category')->orderBy('name')->paginate(18); //with() to prevent lazy loading of laravel
        }
        $categories = Category::all();
        return view('welcome', ["books"=>$books, "categories"=>$categories]);
    }

    function showDetails() {
        if (request("id")) {
            $book = Book::find(request("id"));
            return view('single-book', ["book"=>$book]);
        }
    }

    function download(Request $req, $filename) {
        if (File::exists(public_path('books/'.$filename.'.pdf'))) {
            return response()->download(public_path('books/'.$filename.'.pdf'));
        } else {
            $this->addSessionFlash(false, "downloaded", "File does not exist. Please report the issue. Thank you.");
            return redirect()->back();
        }
    }

    function preview(Request $req, $filename) {
        if (File::exists(public_path('books/'.$filename.'.pdf'))) {
            return view('preview', ["filename"=> $filename]);
        } else {
            $this->addSessionFlash(false, "downloaded", "File does not exist. Please report the issue. Thank you.");
            return redirect()->back();
        }
    }

    function showDonate() {
        $bookCount = Book::count();
        return view("donate", ["bookCount" => $bookCount]);
    }
    // public function download($filename){
    //     $file = public_path()."/books/".$filename.".pdf";
    //     $headers = array("Content-Type" => "application/pdf");
    //     return response()->file($file, $headers);
    //     // return response()->download($file, 'test_book_1.pdf',$headers);
    // }

        //Helper function to add session variables
    private function addSessionFlash($check, $string, $error="") {
        if ($check) {
            session(['type' => 'success', 'message'=>"Book $string successfully. $error"]);
        } else {
            session(['type' => 'danger', 'message'=>"There was an error. $error"]);
        }
    }

}
