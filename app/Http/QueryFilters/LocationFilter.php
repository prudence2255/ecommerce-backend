<?php

namespace App\Http\QueryFilters;

use App\Http\QueryFilters\Filter;
use Closure;
use App\Location;

class LocationFilter extends Filter {

    public function applyFilter($builder){
        $location = Location::where('slug', request()->location)->first();
        if($location->parent_id === null){
            $builder->where('main_location', $location->name);
        }else{
            $builder->where('location', $location->name);
        }
        return $builder;
    }

     public function filter_name(){
        return 'location';
        }

}