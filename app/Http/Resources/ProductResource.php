<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'attributes' => $this->attributes != null ? explode(',', $this->attributes) : [],
            'barcode' => $this->barcode,
            'brand' => $this->brand,
            'categories' => $this->categories,
            'color' => $this->color,
            'container' => $this->container,
            'cost' => $this->cost,
            'description' => $this->description,
            'dimensions' => $this->dimensions,
            'images' => $this->images != null ? explode(',', $this->images) : [],
            'locale' => $this->locale,
            'name' => $this->name,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'qrCode' => $this->qr_code,
            'serial' => $this->serial,
            'sku' => $this->sku,
            'slug' => $this->slug,
            'state' => $this->state,
            'status' => $this->status,
            'tags' => $this->tags != null ? explode(',', $this->tags) : [],
            'type' => $this->type,
            'unitOfMeasure' => $this->unitOfMeasure,
            'warehouse' => $this->warehouse,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at

        ];
    }
}
