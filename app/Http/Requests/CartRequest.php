<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'book_id' => 'required|integer|exists:books,id',
            'amount' => 'required|integer|gt:0',
            'price' => 'required|numeric|regex:/^\d*(\.\d{2})?$/',
            'totalCost' => 'numeric|regex:/^\d*(\.\d{2})?$/',
        ],
        self::METHOD_PUT => [
            'user_id' => 'required|integer|exists:users,id',
            'book_id' => 'required|integer|exists:books,id',
            'amount' => 'required|integer|gt:0',
            'price' => 'required|numeric|regex:/^\d*(\.\d{2})?$/',
            'totalCost' => 'numeric|regex:/^\d*(\.\d{2})?$/',
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
            'user_id.required' => 'Pole użytkownik jest wymagane',
            'user_id.exists' => 'Użytkownik o takim ID nie istnieje',
            'user_id.integer' => 'Pole użytkownik musi zawierać wartość liczbową',

            'book_id.required' => 'Pole książka jest wymagane',
            'book_id.exists' => 'Książka o takim ID nie istnieje',
            'book_id.integer' => 'Pole książka musi zawierać wartość liczbową',

            'amount.required' => 'Pole ilość jest wymagane',
            'amount.integer' => 'Pole ilość musi zawierać wartość liczbową',
            'amount.gt' => 'Pole ilość musi zawierać wartość nieujemną',

            'price.required' => 'Pole cena jest wymagane',
            'price.numeric' => 'Pole cena musi zawierać wartość liczbową z separatorem "."',
            'price.regex' => 'Pole cena musi zawierać wartość liczbową z dwoma miejscami po "."',

            'totalCost.numeric' => 'Pole całkowity koszt musi zawierać wartość liczbową z separatorem "."',
            'totalCost.regex' => 'Pole całkowity koszt musi zawierać wartość liczbową z dwoma miejscami po "."',
        ];
    }
}
