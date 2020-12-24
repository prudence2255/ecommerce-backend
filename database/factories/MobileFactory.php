<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MobilePhone;
use App\Computer;
use App\ComputerBrand;
use App\ComputerItem;
use App\ComputerAccessory;
use Faker\Generator as Faker;
use App\MobileBrand;
use App\MobileModel;


//mobile phone
$factory->define(MobilePhone::class, function (Faker $faker) {
$brands = MobileBrand::all()->pluck('id')->all();
$brand_id = collect($brands)->random();
$models = MobileModel::where('mobile_brand_id', $brand_id)->get()->pluck('id')->all();
$model_id = collect($models)->random();

    return [
        'mobile_brand_id' => $brand_id,
        'mobile_model_id' => $model_id,
        'features' => $faker->randomElements(['4G', 'camera', 'Dual SIM', 'Expandable Memory',
                                                'Fingerprint Sensor', '3G']),
        'edition'=> $faker->randomElement(['2012', '2020', '450', '2049']),
    ];
});

//computer
$factory->define(Computer::class, function (Faker $faker) {
    $brands = ComputerBrand::all()->pluck('id')->all();
    $brand_id = collect($brands)->random();
        return [
            'computer_brand_id' => $brand_id,
            'model' => $faker->word,
            'device' => $faker->randomElement(['Desktop Computer', 'Laptop / Netbook', 'Tablet'])
        ];
    });

    //computer accessory
    $factory->define(ComputerItem::class, function (Faker $faker) {
        $brands = ComputerAccessory::all()->pluck('id')->all();
        $brand_id = collect($brands)->random();
            return [
                'computer_accessory_id' => $brand_id,
            ];
        });

        //audio
        $factory->define(App\AudioItem::class, function (Faker $faker) {
            $brands = App\AudioType::all()->pluck('id')->all();
            $brand_id = collect($brands)->random();


                return [
                    'audio_type_id' => $brand_id,
                ];
            });

            //camera
            $factory->define(App\CameraItem::class, function (Faker $faker) {
                $brands = App\CameraBrand::all()->pluck('id')->all();
                $brand_id = collect($brands)->random();
                $types = App\CameraType::all()->pluck('id')->all();
                $type_id = collect($types)->random();

                    return [
                        'camera_brand_id' => $brand_id,
                        'camera_type_id' => $type_id,
                    ];
                });
//audio
                $factory->define(App\AudioItem::class, function (Faker $faker) {
                    $brands = App\AudioType::all()->pluck('id')->all();
                    $brand_id = collect($brands)->random();


                        return [
                            'audio_type_id' => $brand_id,
                        ];
                    });


                    $factory->define(App\Tv::class, function (Faker $faker) {
                        $brands = App\TvBrand::all()->pluck('id')->all();
                        $brand_id = collect($brands)->random();


                            return [
                                'tv_brand_id' => $brand_id,
                                'model' => $faker->word
                            ];
                        });

                $factory->define(App\TvItem::class, function (Faker $faker) {

                        return [
                                    'item_type' => $faker->randomElement(['Projector', 'Video Player', 'Other']),
                                ];
                            });
                 $factory->define(App\Beauty::class, function (Faker $faker) {

                     return [
                            'item_type' => $faker->randomElement([
                                'Cosmetics', 'Grooming / Bodycare', 'Hair Product',
                                'Perfume', 'Other'
                                            ]),
                                    ];
                                });
                                $factory->define(App\Clothing::class, function (Faker $faker) {

                            return [
                                     'gender' => $faker->randomElement(['Men', 'Women', 'Unisex']),
                              ];
                     });

                     $factory->define(App\Footwear::class, function (Faker $faker) {

                         return [
                                'gender' => $faker->randomElement(['Men', 'Women', 'Unisex'])
                        ];
                    });

                     $factory->define(App\Electricity::class, function (Faker $faker) {
                        return [
                             'item_type' => $faker->randomElement([
                                 'Bathroom / WC', 'Generator', 'Heating / Cooling / AC', 'Other'
                              ]),
                        ];
                    });

                    $factory->define(App\HomeAp::class, function (Faker $faker) {

                        return [
                            'item_type' => $faker->randomElement([
                            'Kitchen / Dining', 'Refrigerator / Freezer', 'Stove / Microwave', 'Other'
                        ]),
                            ];
                        });

                     $factory->define(App\Furniture::class, function (Faker $faker) {

                         return [
                                     'furniture_type' => $faker->randomElement([
                                    'Bed / Bedding', 'Shelf / Storage', 'Chair / Table', 'Textile / Decoration', 'Other'
                                ]),
                                ];
                             });

                     $factory->define(App\Apartment::class, function (Faker $faker) {

                         return [
                                    'beds' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8', '9', 9]),
                                    'baths' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8', '9', 9]),
                                    'landmark' => $faker->streetAddress,
                                     'size' => $faker->randomElement(['200sqm', '340sqm', '790sqm', '400sqm', '500sqm']),
                                    ];
                                 });

                     $factory->define(App\House::class, function (Faker $faker) {

                                return [
                                        'beds' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8', '9', 9]),
                                        'baths' => $faker->randomElement(['1', '2', '3', '4', '5', '6', '7', '8', '9', 9]),
                                         'landmark' => $faker->streetAddress,
                                         'size' => $faker->randomElement(['200sqm', '340sqm', '790sqm', '400sqm', '500sqm']),
                                     ];
                                });




                      $factory->define(App\Land::class, function (Faker $faker) {



                         return [
                                'land_type' =>$faker->randomElement(['Agricultural', 'Commercial', 'Residential', 'Other']),
                                 'landmark' => $faker->streetAddress,
                                 'size' => $faker->randomElement(['200sqm', '340sqm', '790sqm', '400sqm', '500sqm']),
                                  ];
                                 });


                        $factory->define(App\CommercialProp::class, function (Faker $faker) {
                        $brands = App\Property::all()->pluck('id')->all();
                        $brand_id = collect($brands)->random();


                    return [
                    'property_id' => $brand_id,
                            'landmark' => $faker->streetAddress,
                            'size' => $faker->randomElement(['200sqm', '340sqm', '790sqm', '400sqm', '500sqm']),
                        ];
                    });

            $factory->define(App\Trade::class, function (Faker $faker) {


            return [
            'service_type' => $faker->randomElement(['Building / Construction', 'Flooring', 'Roofing', 'Painting', 'Electronics & Engineering']),
            ];
            });


            $factory->define(App\Domestic::class, function (Faker $faker) {


            return [
            'service_type' => $faker->randomElement(['Home Services', 'Pest Control', 'Drying & Cleaning', 'Caretaking']),
            ];
            });


            $factory->define(App\Event::class, function (Faker $faker) {



            return [
                'service_type' => $faker->randomElement(['Event & Party Management', 'Wedding Plannars', 'Entertainment', 'Food & Catering']),
            ];
            });



            $factory->define(App\Health::class, function (Faker $faker) {



                return [
                    'service_type' => $faker->randomElement(['Wellness & Beauty', 'Fitness & training', 'Fashion & Grooming', 'Medical Services']),
                ];
            });
            $factory->define(App\Car::class, function (Faker $faker) {
                $brands = App\CarBrand::all()->pluck('id')->all();
                $brand_id = collect($brands)->random();
                $models = App\CarModel::where('car_brand_id', $brand_id)->get()->pluck('id')->all();
                $model_id = collect($models)->random();

                    return [
                        'car_brand_id' => $brand_id,
                        'car_model_id' => $model_id,
                        'model_year' => $faker->randomElement([2007, 2010, 2015, 2020, 2017, 2018]),
                        'mileage' => $faker->randomElement([20000, 35000, 10000, 200000, 1500000, 700000]),
                        'transmission' => $faker->randomElement(['Manual', 'Automatic', 'Other']),
                        'fuel_type' => $faker->randomElement(['Petrol', 'Diesel', 'CNG', 'Hybrid', 'Electric', 'Other']),
                        'edition' => $faker->word,
                        'engine_capacity' => $faker->randomElement([1, 1.2, 1.5, 2, 2.5, 3]),
                    ];
                });

                $factory->define(App\Motor::class, function (Faker $faker) {
                    $brands = App\MotorBrand::all()->pluck('id')->all();
                    $brand_id = collect($brands)->random();
                    $models = App\MotorModel::where('motor_brand_id', $brand_id)->get()->pluck('id')->all();
                    $model_id = collect($models)->random();

                        return [
                            'motor_brand_id' => $brand_id,
                            'motor_model_id' => $model_id,
                            'model_year' => $faker->randomElement([2007, 2010, 2015, 2020, 2017, 2018]),
                            'mileage' => $faker->randomElement([20000, 35000, 10000, 200000, 1500000, 700000]),

                            'edition' => $faker->word,
                            'engine_capacity' => $faker->randomElement([1, 1.2, 1.5, 2, 2.5, 3]),
                        ];
                        });

                 $factory->define(App\Part::class, function (Faker $faker) {
                $brands = App\AutoPart::all()->pluck('id')->all();
                $brand_id = collect($brands)->random();


                    return [
                        'item_type_id' => $brand_id,

                    ];
                    });
