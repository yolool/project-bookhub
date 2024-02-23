<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
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

    // Category links for delete and edit will be displayed inline in the table, no individual views need for each item
    public function index() {
        if (request("perform") == "add") {
            return view("admin.cat-new");
        } else if (request("perform") == "edit" && request("id")) {
            $category = Category::find(request("id"));
            return view("admin.cat-edit", ["category" => $category]);
        } else if (request("perform") == "delete" && request("id")) {
            $category = Category::find(request("id"));
            return view("admin.cat-delete-confirm", ["category" => $category]);
        }
    }

    public function catAdd(Request $req) {
        $this->validateRequest($req);
        $categories = new Category;
        $categories->name = $req->name;
        $categories->description = $req->description;
        $result = $categories->save();
        $this->addSessionFlash($result, "added");
        return redirect('/home?select=categories');
    }

    public function catUpdate(Request $req) {
        $this->validateRequest($req);
        $category = Category::find($req->id);
        $category->name = $req->name;
        $category->description = $req->description;
        $result = $category->save();
        $this->addSessionFlash($result, "updated");
        return redirect('/home?select=categories');
    }

    public function catDelete(Request $req) {
        $category = Category::find($req->id);
        $result = $category->delete();
        $this->addSessionFlash($result, "deleted");
        return redirect('/home?select=categories');
    }

    private function addSessionFlash($check, $string, $error="") {
        if ($check) {
            session(['type' => 'success', 'message'=>"Category $string successfully. $error"]);
        } else {
            session(['type' => 'danger', 'message'=>"There was an error. Please try again. $error"]);
        }
    }

    //Helper function to validate incoming request data accepts $req as input
    private function validateRequest($request) {
        $validated = $request->validate([
            'name'=>'required',
            'description' => 'required'
        ]);
    }
}
