<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContainerResource extends JsonResource
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
            'barcode' => $this->barcode,
            'color' => $this->color,
            'description' => $this->description,
            'dimensions' => $this->dimensions,
            'images' => $this->images,
            'locale' => $this->locale,
            'material' => $this->material,
            'name' => $this->name,
            'parent' => $this->parent,
            'qrCode' => $this->qr_code,
            'sku' => $this->sku,
            'state' => $this->state,
            'tags' => $this->tags,
            'unitOfMeasure' => $this->unit_of_measure,
            'createdAt' => $this->created_at,
            'updatedAt' => $this->updated_at,
            'deletedAt' => $this->deleted_at
        ];
    }
}
