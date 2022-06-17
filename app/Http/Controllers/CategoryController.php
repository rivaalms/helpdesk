<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // public function index() {
    //     return view('category', [

    //     ]);
    // }

    public function category(Category $category) {
        return view('category', [
            'category' => $category,
            'categories' => Category::whereNotIn('id', array(1))->get(),
            'articles' => Article::where('category_id', $category->id)->get()
        ]);
    }
}
