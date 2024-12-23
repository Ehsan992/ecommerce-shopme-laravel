<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use DB;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');
        // $category = $request->input('category');
        $category=DB::table('categories')->orderBy('category_name','ASC')->get();

        // Implement your search logic based on the query and category here
        $products = Product::search($query)->get();

        return view('frontend.search_results', compact('products','category'));
    }
    
    public function searchAjax(Request $request)
    {
        $query = $request->input('query');
        $limit = 10; // Limit the number of results to 10

        // Fetch products whose names contain the entered keyword, limit results
        $relatedProducts = Product::where('name', 'like', "%{$query}%")->limit($limit)->get();
        
        // Return the related products as JSON response
        return response()->json($relatedProducts);
    }
    
}
