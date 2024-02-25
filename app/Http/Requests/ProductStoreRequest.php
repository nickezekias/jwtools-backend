<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'attribute' => 'nullable|string|max:255',
            'barcode' => 'required|string',
            'brand' => 'nullable|string|max:255',
            'categories' => 'nullable|string|max:255',
            'color' => 'nullable|string',
            'container' => 'nullable|string|max:255',
            'cost' => 'nullable|decimal:0,4',
            'description' => 'nullable|string',
            'dimensions' => 'nullable|string',
            'images' => 'nullable|string|max:255',
            'locale' => 'required|string',
            'name' => 'bail|required|string',
            'price' => 'nullable|decimal:0,4',
            'quantity' => 'required|integer|min:1',
            'qrCode' => 'nullable|string',
            'serial' => 'nullable|unique:products|string',
            'sku' => 'bail|required|unique:products|max:255',
            'slug' => 'required|max:255',
            'state' => 'required|string|max:255',
            'status' => 'required|string',
            'tags' => 'nullable|string',
            'type' => 'nullable|string',
            'unitOfMeasure' => 'nullable|string',
            'warehouse' => 'required|string',
        ];
    }
}
