<?php

namespace App\Http\QueryFilters;

use App\Http\QueryFilters\Filter;
use Closure;

class OrderFilter extends Filter {

    public function applyFilter($builder){
       
            if(request()->order === 'newest-on-top'){
                $builder->orderByDesc('updated_at');
            }
            if(request()->order === 'oldest-on-top'){
                $builder->orderBy('updated_at');
            }
            if(request()->order === 'low-to-high'){
                $builder->orderBy('price');
            }
            if(request()->order === 'high-to-low'){
                $builder->orderByDesc('price', 'desc');
            }
        return $builder;
    }

     public function filter_name(){
        return 'order';
        }

}