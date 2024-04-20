<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Container extends Model
{
    use HasFactory;

    protected $fillable = [
        'barcode',
        'color',
        'description',
        'dimensions',
        'id',
        'images',
        'locale',
        'material',
        'name',
        'parent',
        'qr_code',
        'sku',
        'state',
        'tags',
        'unit_of_measure',
        'created_at',
        'updated_at'
    ];

    public function getProductsCountAttribute()
    {
        $productsCount = DB::table('products')->where('container', '=', $this->sku)->count();
        return $productsCount;
    }
}
