<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'supplier_id',
        'name',
        'price',
        'description',
    ];


    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id', 'user_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class, 'product_id', 'product_id');
    }
}
