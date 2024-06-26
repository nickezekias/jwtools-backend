<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductResource as ObjectResource;
use App\Models\Product as Obj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $objects = [];
        $objectsQuery = Obj::where('id', '>', 0);
        if ($request->has('sortBy')) {
            $orderByArray = explode(',', $request->sortBy);
            $orderByOrientation = explode(',', $request->sortDesc);
            for ($i = 0; $i < count($orderByArray); $i++) {
                if ($orderByOrientation[$i] === 'true') {
                    $objectsQuery->orderBy($orderByArray[$i], 'desc');
                } else {
                    $objectsQuery->orderBy($orderByArray[$i], 'asc');
                }
            }
        }

        if ($request->has('itemsPerPage')) {
            if ($request->itemsPerPage == -1) {
                $objects = $objectsQuery->get();
            } else {
                $objects = $objectsQuery->paginate($request->itemsPerPage);
            }
        } else {
            $objects = $objectsQuery->paginate();
        }

        return ObjectResource::collection($objects);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $images = $this->uploadImage($request);
        $obj = Obj::firstOrCreate([
            'attributes' => $request->productAttributes,
            'barcode' => $request->barcode,
            'brand' => $request->brand,
            'categories' => $request->categories,
            'color' => $request->color,
            'container' => $request->container,
            'cost' => $request->cost,
            'description' => $request->description,
            'dimensions' => $request->dimensions,
            'images' => $images,
            'locale' => 'fr-FR',
            'name' => $request->name,
            'price' => $request->get('price', $request->cost),
            'quantity' => $request->quantity,
            'qr_code' => $request->qrCode,
            'serial' => $request->serial,
            'sku' => $request->sku,
            'slug' => $request->slug,
            'state' => $request->state,
            'status' => $request->status,
            'tags' => $request->tags,
            'type' => $request->type,
            'unit_of_measure' => $request->unitOfMeasure,
            'warehouse' => $request->warehouse
        ]);
        return new ObjectResource($obj);
    }

    public function massStore(Request $request) {
        $objects = $request->objects;
        $successfulStoreList = [];
        $failedStoreList = [];
        // return response()->json($objects);
        for ($i = 0; $i < count($objects); $i++) {
            $obj = Obj::firstOrCreate([
                'attributes' => implode(',', $objects[$i]['productAttributes']),
                'barcode' => $objects[$i]['barcode'],
                'brand' => $objects[$i]['brand'],
                'categories' => $objects[$i]['categories'],
                'color' => $objects[$i]['color'],
                'container' => $objects[$i]['container'],
                // 'cost' => $objects[$i]['cost'],
                'description' => $objects[$i]['description'],
                'dimensions' => $objects[$i]['dimensions'],
                'images' => $objects[$i]['images'],
                'locale' => 'fr-FR',
                'name' => $objects[$i]['name'],
                // 'price' => $objects[$i]['cost'],
                'quantity' => $objects[$i]['quantity'],
                'qr_code' => $objects[$i]['qrCode'],
                'serial' => $objects[$i]['serial'],
                'sku' => $objects[$i]['sku'],
                'slug' => $objects[$i]['slug'],
                'state' => $objects[$i]['state'],
                'status' => $objects[$i]['status'],
                'tags' => implode(',', $objects[$i]['tags']),
                'type' => $objects[$i]['type'],
                'unit_of_measure' => $objects[$i]['unitOfMeasure'],
                'warehouse' => $objects[$i]['warehouse']
            ]);
            if ($obj) {
                $successfulStoreList[$i] = $obj;
            } else {
                $failedStoreList[$i] = $obj;
            }
        }

        return response()->json([
            "data" => ObjectResource::collection($successfulStoreList),
            "failed" => ObjectResource::collection($failedStoreList)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return new ObjectResource(Obj::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return response()->json($request->all());
        $obj = Obj::findOrFail($id);

        $images = $this->uploadImage($request);

        //TODO: Add code to delete old image if not used by another entity

        // return response()->json($request->all());
        $obj->attributes = $request->productAttributes;
        $obj->barcode = $request->barcode;
        $obj->brand = $request->brand;
        $obj->categories = $request->categories;
        $obj->color = $request->color;
        $obj->container = $request->container;
        $obj->cost = $request->cost;
        $obj->description = $request->description;
        $obj->dimensions = $request->dimensions;
        $obj->images = $images;
        $obj->locale = $request->locale;
        $obj->name = $request->name;
        $obj->price = $request->price;
        $obj->quantity = $request->quantity;
        $obj->qr_code = $request->qrCode;
        $obj->serial = $request->serial;
        $obj->sku = $request->sku;
        $obj->slug = $request->slug;
        $obj->state = $request->state;
        $obj->status = $request->status;
        $obj->tags = $request->tags;
        $obj->type = $request->type;
        $obj->unit_of_measure = $request->unitOfMeasure;
        $obj->warehouse = $request->warehouse;

        $obj->save();

        return new ObjectResource($obj);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $obj = Obj::findOrFail($id);
        if($obj->delete()) {
            return response()->json([ 'success' => true ]);
        } else {
            return response()->json(['success' => false], 400);
        }
    }

    public function uploadImage(Request $request) {
        if ($request->file()) {
            $resp = Storage::put('images/products', $request->file, 'public');
            // return str_replace('\\', '', env('APP_URL').$resp);
            return $resp;
        } else {
            return $request->images;
        }
    }
}
