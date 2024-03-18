<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContainerStoreRequest extends FormRequest
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
            'barcode' => 'required|string',
            'color' => 'nullable|string',
            'description' => 'nullable|string',
            'dimensions' => 'nullable|string',
            'images' => 'nullable|string|max:255',
            'locale' => 'nullable|string',
            'material' => 'nullable|string',
            'name' => 'bail|required|string',
            'parent' => 'required|integer|min:0',
            'qrCode' => 'nullable|string',
            'sku' => 'bail|required|unique:products|max:255',
            'state' => 'required|string|max:255',
            'tags' => 'nullable|string',
            'unitOfMeasure' => 'nullable|string',
        ];
    }
}
