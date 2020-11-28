<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\DB;
use App\Http\Repositories\ShowAdSubRepository;
use App\Http\Repositories\DbTransactionRepository;

class ShowRepository {

    public function show_data($data){
        $categoryType = new ShowAdSubRepository($data);
        $ad = new DbTransactionRepository();
        return $ad->transaction($data, $categoryType);
        
    }
}