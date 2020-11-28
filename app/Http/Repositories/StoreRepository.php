<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\DB;
use App\Http\Repositories\StoreSubAdRepository;
use App\Http\Repositories\DbTransactionRepository;

class StoreRepository {
    public function store_data($data){     
        $categoryType = new StoreSubAdRepository($data);
         $ad = new DbTransactionRepository();
        return $ad->transaction($data, $categoryType);
         
    }
}