<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name_ar','name_en', 'price','salePrice','type','description_ar','description_en','mainGallery','gallery1','gallery2','gallery3','admin_id','created_at'
    ];

    //Relationships
    //admin-->product 1to*
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }


    //order has many products and product belongs to many orders *to*
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    //Mutators
    public function getTypeAttribute($value)
    {
        if ($value == '0') {
            return 'Men';
        } elseif ($value == '1') {
            return 'Women';
        } elseif ($value == '2') {
            return 'Kids';
        }
    }

}
