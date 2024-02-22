<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'attributes',
        'barcode',
        'brand',
        'categories',
        'color',
        'cost',
        'created_at',
        'description',
        'dimensions',
        'images',
        'locale',
        'name',
        'price',
        'quantity',
        'qr_code',
        'serial',
        'sku',
        'slug',
        'state',
        'status',
        'tags',
        'type',
        'unit_of_measure',
        'updated_at',
        'warehouse'
    ];
}
