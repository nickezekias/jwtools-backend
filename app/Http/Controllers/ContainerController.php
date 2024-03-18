<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContainerStoreRequest as ObjectStoreRequest;
use App\Http\Resources\ContainerResource as ObjectResource;
use App\Models\Container as Obj;

class ContainerController extends Controller
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
    public function store(ObjectStoreRequest $request)
    {
        $obj = new Obj();
        $obj->barcode = $request->barcode;
        $obj->color = $request->color;
        $obj->description = $request->description;
        $obj->dimensions = $request->dimensions;
        $obj->images = $request->images;
        // $obj->locale = $request->get('locale', 'fr-FR');
        $obj->locale = 'fr-FR';
        $obj->material = $request->material;
        $obj->name = $request->name;
        $obj->parent = $request->parent;
        $obj->qr_code = $request->qrCode;
        $obj->sku = $request->sku;
        $obj->state = $request->state;
        $obj->tags = $request->tags;
        $obj->unit_of_measure = $request->unitOfMeasure;

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
    public function update(ObjectStoreRequest $request, string $id)
    {
        $obj = Obj::findOrFail($id);
        $obj->barcode = $request->barcode;
        $obj->color = $request->color;
        $obj->description = $request->description;
        $obj->dimensions = $request->dimensions;
        $obj->images = $request->images;
        // $obj->locale = $request->get('locale', 'fr-FR');
        $obj->locale = 'fr-FR';
        $obj->material = $request->material;
        $obj->name = $request->name;
        $obj->parent = $request->parent;
        $obj->qr_code = $request->qrCode;
        $obj->sku = $request->sku;
        $obj->state = $request->state;
        $obj->tags = $request->tags;
        $obj->unit_of_measure = $request->unitOfMeasure;

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
