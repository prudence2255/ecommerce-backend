<?php
namespace App\Http\QueryFilters;
use App\Http\QueryFilters\QueryHolder;
use App\Http\QueryFilters\FilterContract;

use App\Category as CategoryFilter;

class Category extends QueryHolder implements FilterContract {

    public function handle($value)
    {
        $category = CategoryFilter::where('slug', request()->category)->first();
        if($category->parent_id === null){
            $this->query->where('main_category', $category->name);
        }else{
            $this->query->where('category', $category->name);
        }
    }
}
