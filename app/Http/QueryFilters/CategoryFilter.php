<?php

namespace App\Http\QueryFilters;

use App\Http\QueryFilters\Filter;
use Closure;
use App\Category;

class CategoryFilter extends Filter {

    public function applyFilter($builder){
        $category = Category::where('slug', request()->category)->first();
        if($category->parent_id === null){
            $builder->where('main_category', $category->name);
        }else{
            $builder->where('category', $category->name);
        }
        return $builder;
    }

     public function filter_name(){
        return 'category';
        }

}