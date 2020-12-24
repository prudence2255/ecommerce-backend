<?php
namespace App\Http\QueryFilters;

abstract class QueryHolder
{
    protected $query;

    public function __construct($query)
    {
        $this->query = $query;
    }
}
