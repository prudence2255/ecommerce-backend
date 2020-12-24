<?php
namespace App\Http\QueryFilters;
use App\Http\QueryFilters\QueryHolder;
use App\Http\QueryFilters\FilterContract;


class Search extends QueryHolder implements FilterContract {

    public function handle($value)
    {
        request()->validate([
            'search' => 'required|min:3|string'
       ]);
       $request = request()->search;
        return $this->query->where('title', 'LIKE', "%{$request}%");
    }
}
