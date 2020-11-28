<?php

namespace App\Http\QueryFilters;

use App\Http\QueryFilters\Filter;
use Closure;


class PriceFilter extends Filter {

    public function applyFilter($builder){
        return $builder->whereBetween('price', [request()->min_price, request()->max_price]);
    }

     public function filter_name(){
        return 'min_price';
        }

}