<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class BookController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    // functions related to admin book management
    public function bookView() {
        if (request("id") && request("perform") == "edit") { //book edit view
            $book = Book::find(request("id"));
            $categories = Category::all('id','name');
        
            $covercheck = $book->covername && File::exists(public_path('covers/'.$book->covername));

            if (File::exists(public_path('books/'.$book->filename.'.pdf'))) {
                return view("admin.book-edit", ["book" => $book, "categories"=>$categories, "filecheck"=> true, "covercheck"=>$covercheck]);
            } else {
                return view("admin.book-edit", ["book" => $book, "categories"=>$categories, "filecheck"=> false, "covercheck"=>$covercheck]);
            }
        } else if (request("id") && request("perform") == "delete") { //book delete confirm view
            $book = Book::find(request("id"));
            return view("admin.book-delete-confirm", ["book" => $book]);
        } else if (request("id") && !request("perform")) { //view single book detail
            $book = Book::find(request("id"));
            return view("admin.book-view-admin", ["book" => $book]);
        } else if (!request("id") && request("perform")=="add") { //book add view
            $categories = Category::all('id','name');
            return view("admin.book-new", ["categories"=>$categories]);
        }
    }

    public function bookAdd(Request $req) {
        $this->validateRequest($req);
        $book = new Book;
        $book->name = $req->name;
        $book->category_id = $req->category;
        $book->author = $req->author;
        $book->about = $req->about;

        if ($req->file('pdf')) {
            $file = $req->file('pdf');
            $filename = time().'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            // File upload location
            $location = 'books';
            // Upload file add pdf extension
            $file->move($location, $filename.'.'.$file->getClientOriginalExtension());
            // Save the filename without extension in database
            $book->filename = $filename;

            //Check and upload thumbnail cover, please note filename with extension eg. test.jpg will be saved in database
            if($req->file('cover')) {
                $cover = $req->file('cover');
                $covername = time().'_'.pathinfo($cover->getClientOriginalName(), PATHINFO_FILENAME);
                $covername = $covername.'.'.$cover->getClientOriginalExtension();
                $cover->move('covers', $covername);
                $book->covername = $covername;
            }
            $result = $book->save();
            $this->addSessionFlash($result, "added");
            return redirect("/home?select=books");
        } else {
            $this->addSessionFlash(false, "Uploaded", "File not uploaded.");
            return redirect("/home?select=books");
        }
    }

    public function bookDelete(Request $req) {
        $book = Book::find($req->id);
        //Delete cover image
        if ($book->covername && File::exists(public_path('covers/'.$book->covername))) {
            File::delete(public_path('covers/'.$book->covername));
        }
        //Delete PDF file
        if (File::exists(public_path('books/'.$book->filename.'.pdf'))) {
            File::delete(public_path('books/'.$book->filename.'.pdf'));
        } else {
            $result = $book->delete();
            $this->addSessionFlash(false, "deleted", "PDF File does not exist. Deleted the existing record.");
            return redirect('/home?select=books');
        }
        $result = $book->delete();
        $this->addSessionFlash($result, "deleted");
        return redirect('/home?select=books');
    }

    public function bookUpdate(Request $req) {
        $this->validateRequestWithoutFile($req);
        $book = Book::find($req->id);
        $book->name = $req->name;
        $book->category_id = $req->category;
        $book->author = $req->author;
        $book->about = $req->about;

        $checkMessage = ""; // This message will be added concatenated to check if old pdf file is deleted or not
        if ($req->file('pdf')) {
            $file = $req->file('pdf');
            $filename = time().'_'.pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            // File upload location
            $location = 'books';
            // Upload file add pdf extension
            $file->move($location, $filename.'.'.$file->getClientOriginalExtension());
            // Delete the old file
            if (File::exists(public_path('books/'.$book->filename.'.pdf'))) {
                File::delete(public_path('books/'.$book->filename.'.pdf'));
                $checkMessage = " Old PDF file has been deleted.";
            } else {
                $checkMessage = " [Cannot find old PDF file]";
            }
            // Save the filename without extension in database
            $book->filename = $filename;
            $checkMessage = "New PDF file has been updated.". $checkMessage;
        } else {
            $checkMessage = " No New PDF file detected.";
        }

        //Check and upload thumbnail cover, please note filename with extension eg. test.jpg will be saved in database
        if($req->file('cover')) {
            $cover = $req->file('cover');
            $covername = time().'_'.pathinfo($cover->getClientOriginalName(), PATHINFO_FILENAME);
            $covername = $covername.'.'.$cover->getClientOriginalExtension();

            $cover->move('covers', $covername);

            // Delete old cover photo if any
            if ($book->covername && File::exists(public_path('covers/'.$book->covername))) {
                File::delete(public_path('covers/'.$book->covername));
                $checkMessage .= " Old Cover Image has been deleted.";
            } else {
                $checkMessage .= " [Old cover does not exist]";
            }
            $book->covername = $covername;
            $checkMessage .= " New cover Updated.";
        } else {
            $checkMessage .= " No new cover image detected.";
        }
        // Save the records in database
        $result = $book->save();
        $this->addSessionFlash($result, "updated", $checkMessage);
        return redirect("/book-view?id=$req->id");
    }


    //Helper function to add session variables
    private function addSessionFlash($check, $string, $error="") {
        if ($check) {
            session(['type' => 'success', 'message'=>"Book $string successfully. $error"]);
        } else {
            session(['type' => 'danger', 'message'=>"There was an error. Please try again. $error"]);
        }
    }

    //Helper functions to validate incoming request data accepts $req as input
    private function validateRequest($request) {
        $validated = $request->validate([
            'name'=>'required',
            'author'=>'required',
            'about'=>'required',
            'category'=>'required',
            'pdf' => 'required|mimes:pdf',
            'cover'=> 'mimes:jpg,jpeg,png,bmp'
        ]);
    }
    private function validateRequestWithoutFile($request) {
        $validated = $request->validate([
            'name'=>'required',
            'author'=>'required',
            'about'=>'required',
            'category'=>'required',
            'pdf' => 'mimes:pdf',
            'cover'=> 'mimes:jpg,jpeg,png,bmp'
        ]);
    }

}
