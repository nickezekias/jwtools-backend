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
        return $this->isMethod('POST') ? $this->store() : $this->update();
    }

    private function store(): array
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
            'locale' => 'nullable|string',
            'name' => 'bail|required|string',
            'price' => 'nullable|decimal:0,4',
            'quantity' => 'required|integer|min:1',
            'qrCode' => 'nullable|string',
            'serial' => 'nullable|unique:products|string',
            'sku' => 'bail|required|unique:products|max:255',
            'slug' => 'required|max:255',
            'state' => 'nullable|string|max:255',
            'status' => 'nullable|string',
            'tags' => 'nullable|string',
            'type' => 'nullable|string',
            'unitOfMeasure' => 'nullable|string',
            'warehouse' => 'nullable|string',
        ];
    }

    private function update(): array
    {
        $rules = $this->store();
        $rules['locale'] = 'required|string';
        $rules['serial'] = 'nullable|string';
        $rules['sku'] = 'bail|required|max:255';
        $rules['state'] = 'required|string|max:255';
        $rules['status'] = 'required|string|max:255';
        // $rules['warehouse'] = 'required|string|max:255';
        return $rules;
    }
}
