<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\NewCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return response()->json(['data' => $categories], 200);
    }

    public function categories(){
        $categories = Category::orderBy('updated_at', 'DESC')->get();
        return response()->json(['data' => $categories], 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewCategoryRequest $request)
    {
      $category = Category::create([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
        ]);

       if($category){
           return response()->json(['data' => $category], 200);
       } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,'.$category->id,
        ]);
       $category->slug = null;
        $category->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            ]);
        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $category,
        ],  200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category->children){
            $category->children()->delete();
        }
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully'], 200);
    }
}
