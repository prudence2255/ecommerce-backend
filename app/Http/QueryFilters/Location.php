<?php
namespace App\Http\QueryFilters;
use App\Http\QueryFilters\QueryHolder;
use App\Http\QueryFilters\FilterContract;

use App\Location as LocationFilter;

class Location extends QueryHolder implements FilterContract {

    public function handle($value)
    {
        $location = LocationFilter::where('slug', request()->location)->first();
        if($location->parent_id === null){
            $this->query->where('main_location', $location->name);
        }else{
            $this->query->where('location', $location->name);
        }
    }
}
