<?php
namespace App\Http\QueryFilters;


interface FilterContract
{
    public function handle($value);
}
