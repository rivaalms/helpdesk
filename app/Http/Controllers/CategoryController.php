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
        $articles = Article::where('category_id', $category->id)->get();
        $searchVal = ['<p>', '</p>', '<br>'];

        for ($i = 0; $i < count($articles); $i++) {
            $text[$i] = str_replace($searchVal, '', $articles[$i]->content);
        }

        return view('category', [
            'title' => 'category',
            'category' => $category,
            'categories' => Category::all(),
            'articles' => Article::where('category_id', $category->id)->get(),
            'text' => $text
        ]);
    }
}
