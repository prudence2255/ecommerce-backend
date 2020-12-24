<?php
namespace App\Http\QueryFilters;
use App\Http\QueryFilters\QueryHolder;
use App\Http\QueryFilters\FilterContract;



class Min_price extends QueryHolder implements FilterContract {

    public function handle($value)
    {
        return $this->query->whereBetween('price', [request()->min_price, request()->max_price]);

    }
}
