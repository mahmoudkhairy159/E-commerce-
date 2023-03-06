<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name_ar'=>$faker->name,
        'name_en'=>$faker->name,
        'price'=>$faker->randomDigit,
        'salePrice'=>$faker->randomDigit,
        'type'=>$faker->randomElement(array ('0','1','2')),
        'description_ar'=>$faker->sentence('8'),
        'description_en'=>$faker->sentence('8'),
        'mainGallery'=>'shirt1/3.jpg',
        'gallery1'=>'shirt1/3.jpg',
        'gallery2'=>'shirt1/3.jpg',
        'gallery3'=>'shirt1/3.jpg',
        'admin_id'=>1,
    ];
});
