<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\DB;
use App\Http\Repositories\UpdateSubAdRepository;
use App\Http\Repositories\DbTransactionRepository;

class UpdateRepository{

    public function update_data($ad, $data){
        $categoryType = new UpdateSubAdRepository($ad, $data);
        $ad = new DbTransactionRepository();
        return $ad->transaction($data, $categoryType);
    }
}