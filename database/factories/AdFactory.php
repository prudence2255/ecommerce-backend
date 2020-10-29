<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ad;
use App\Category;
use App\Location;


use Faker\Generator as Faker;


 $factory->define(Ad::class, function (Faker $faker) {

    $main_cat = Category::whereNull('parent_id')->get();

    $main_loc = Location::whereNull('parent_id')->get();
    
    
    $main_cat_i = collect($main_cat)->pluck('id')->all();
    $main_cat_id = collect($main_cat_i)->random();
    $main_cat_name = Category::where('id', $main_cat_id)->first()->name;
    
    $child_cat = Category::where('parent_id', $main_cat_id)->get();
    $child_c = collect($child_cat)->pluck('id')->all();
    $child_cat_id = collect($child_c)->random();
    $child_cat_name =  Category::where('id', $child_cat_id)->first()->name;
    
    $main_loc_i = collect($main_loc)->pluck('id')->all();
    $main_loc_id = collect($main_loc_i)->random();
    $main_loc_name = Location::where('id', $main_loc_id)->first()->name;
    $child_loc = Location::where('parent_id', $main_loc_id)->get();

    $child_loc_l = collect($child_loc)->pluck('id')->all();
    $child_loc_id = collect($child_loc_l)->random();
    $child_loc_name = Location::where('id', $child_loc_id)->first()->name;
    
    $images = [['xsmall' => "https://picsum.photos/200/300", 
                'small' => "https://picsum.photos/450/250",
                'medium' => "https://picsum.photos/640/300",
                'large' => "https://picsum.photos/1200/700",
                ]
                ];
    
    $prices = collect([2000, 11300, 400, 200, 5600, 1200, 5620, 600, 6000, 400, 450]);
    $price = $prices->random();
    $condition = collect(['New', 'Used'])->random();
    $title = $faker->unique()->sentence(4);

    $cats = [
        "Mobile Phones", "Computers & Tablets", "Tvs", "Mobile Phone Accessories",
        "Computer Accessories", "Cameras & Camcorders", "Tv & Video Accessories", 
        "Audio & Mp3", "Cars", "Motorbikes & Scooters", "Auto Parts & Accessories",
        "Electricity, AC & Bathroom",
    ];
$collection = collect($cats);
$isCondition = $collection->contains($child_cat_name);
    return [
        'title' => $title,
        'uuid' => 200003,
        'customer_id' => 1,
        'price' => $price,
        'description'=> $faker->paragraph,
        'condition' => $isCondition ? $condition : null,
        'negotiable' => $faker->randomElement(['Negotiable', 0]),
        'parent_category_id' => $main_cat_id,
        'child_category_id' => $child_cat_id,
        'parent_location_id' => $main_loc_id,
        'child_location_id' => $child_loc_id,
        'main_category' => $main_cat_name,
        'category' => $child_cat_name,
        'main_location' => $main_loc_name,
        'location' => $child_loc_name,
        'images' => $images,
    ];
});
