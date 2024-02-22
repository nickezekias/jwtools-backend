<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product as ObjectResource;
use App\Models\Product as Obj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $obj = Obj::firstOrCreate([
            'attributes' => $request->attributes,
            'barcode' => $request->barcode,
            'brand' => $request->brand,
            'categories' => $request->categories,
            'color' => $request->color,
            'description' => $request->description,
            'dimensions' => $request->dimension,
            'images' => $request->images,
            'locale' => $request->locale,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'qr_code' => $request->qrCode,
            'serial' => $request->serial,
            'sku' => $request->sku,
            'slug' => $request->slug,
            'state' => $request->state,
            'tags' => $request->tags,
            'type' => $request->type,
            'unit_of_measure' => $request->unitOfMeasure,
            'warehouse' => $request->warehouse
        ]);
        $obj->save();
        return new ObjectResource($obj);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
