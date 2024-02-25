<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Resources\ProductResource as ObjectResource;
use App\Models\Product as Obj;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
            'images' => $request->images,
            'locale' => $request->get('locale', 'fr-FR'),
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
        $obj->save();
        return new ObjectResource($obj);
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
    public function update(ProductStoreRequest $request, string $id)
    {
        $obj = Obj::findOrFail($id);
        $obj->attributes = $request->productAttributes;
        $obj->barcode = $request->barcode;
        $obj->brand = $request->brand;
        $obj->categories = $request->categories;
        $obj->color = $request->color;
        $obj->container = $request->container;
        $obj->cost = $request->cost;
        $obj->description = $request->description;
        $obj->dimensions = $request->dimensions;
        $obj->images = $request->images;
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
}
