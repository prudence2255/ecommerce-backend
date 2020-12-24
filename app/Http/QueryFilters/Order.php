<?php
namespace App\Http\QueryFilters;
use App\Http\QueryFilters\QueryHolder;
use App\Http\QueryFilters\FilterContract;



class Order extends QueryHolder implements FilterContract {

    public function handle($value)
    {
        if(request()->order === 'newest-on-top'){
            $this->query->orderByDesc('updated_at');
        }
        if(request()->order === 'oldest-on-top'){
            $this->query->orderBy('updated_at');
        }
        if(request()->order === 'low-to-high'){
            $this->query->orderBy('price');
        }
        if(request()->order === 'high-to-low'){
            $this->query->orderByDesc('price');
        }

    }
}
