<?php

namespace App\Http\QueryFilters;

use Closure;

class NotOrderFilter {

    public function handle($request, Closure $next){

        $builder = $next($request);

        if(!request()->has('order')){
            return $builder->orderByDesc('updated_at');
        }

        return $builder;

    }

}
