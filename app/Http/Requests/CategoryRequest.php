<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * @var array
     */
    private static $rules = [
        self::METHOD_GET => [
            'itemsPerPage' => 'integer|min:1|max:50',
            'page' => 'integer|min:1',
            'id' => 'array|min:1',
            'id.*' => 'integer|min:1',
            'order.id' => 'string|in:asc,desc'
        ],
        self::METHOD_POST => [
            'nameOfCategory' => 'required|string|max:255',
        ],
        self::METHOD_PUT => [
            'nameOfCategory' => 'required|string|max:255',
        ],
        self::METHOD_DELETE => [
            'powod' => 'required|string',
        ],
    ];



    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return self::$rules[$this->getMethod()] ?? [];
    }

    public function messages()
    {
        return [
            'nameOfCategory.required' => 'Pole Kategoria jest wymagane',
            'nameOfCategory.string' => 'Pole Kategoria musi zawierać tekst',
            'nameOfCategory.max' => 'Pole Kategoria może zawierać maksymalnie 255 znaków',
        ];
    }
}
