<?php

namespace App\Http\QueryFilters;

use App\Http\QueryFilters\Filter;
use Closure;


class SearchFilter extends Filter {

    public function applyFilter($builder){
        request()->validate([
            'search' => 'required|min:3|string'
       ]);
       $request = request()->search;
        return $builder->where('title', 'LIKE', "%{$request}%");
    }

     public function filter_name(){
        return 'search';
     }

}