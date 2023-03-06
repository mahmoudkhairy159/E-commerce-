<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'status', 'paymentMethod', 'paymentStatus','transactionId', 'totalPrice', 'address', 'phone', 'user_id','created_at','deliveryDate'
    ];

    protected $attributes = [
        'status' => '0',
        'paymentMethod' => '0',
        'paymentStatus' => '0',
    ];

    /*-----------------Accessors-----------------------*/
    public function getStatusAttribute($value)
    {
        if ($value == '0') {
            return 'pending';
        } elseif ($value == '1') {
            return 'confirmed';
        } elseif ($value == '2') {
            return 'shipped';
        } elseif ($value == '3') {
            return 'canceled';
        } elseif ($value == '4') {
            return 'completed';
        }
    }


    public function getPaymentMethodAttribute($value)
    {
        if ($value == '0') {
            return 'Cash';
        } elseif ($value == '1') {
            return 'VISA';
        }
    }


    public function getPaymentStatusAttribute($value)
    {
        if ($value == '0') {
            return 'pending';
        } elseif ($value == '1') {
            return 'completed';
        }
    }
    public function getDeliveryDateAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }



    //relationships
    //user to Order one to many
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //order has many products and product belongs to many orders *to*
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
