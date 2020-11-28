<?php

namespace App\Http\QueryFilters;

use App\Http\QueryFilters\Filter;
use Closure;


class ConditionFilter extends Filter {

    public function applyFilter($builder){
        return $builder->where('condition', request()->condition);
    }
     public function filter_name(){
        return 'condition';
     }

}