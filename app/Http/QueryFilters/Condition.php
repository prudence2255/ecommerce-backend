<?php
namespace App\Http\QueryFilters;
use App\Http\QueryFilters\QueryHolder;
use App\Http\QueryFilters\FilterContract;


class Condition extends QueryHolder implements FilterContract {

    public function handle($value)
    {
            $this->query->where('condition', request()->condition);
    }
}
