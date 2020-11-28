<?php

namespace App\Http\QueryFilters;

use Closure;

abstract class Filter {

    public function handle($request, Closure $next){

        if(!request()->has($this->filter_name())){
            return $next($request);
        }

        $builder = $next($request);

       return $this->applyFilter($builder);
    }

    protected abstract function filter_name();

    protected abstract function applyFilter($builder);
}
