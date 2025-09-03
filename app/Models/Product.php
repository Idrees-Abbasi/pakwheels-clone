<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Primary key
    //protected $primaryKey = 'product_id';

    // Mass assignable fields
protected $fillable = [
    'category',
    'title',
    'description',
    'price',
    'image',
    'seller_id',
];


    // Seller relationship
public function seller()
{
    return $this->belongsTo(User::class, 'seller_id');
}
}
