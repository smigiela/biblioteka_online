<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class AuthorRequest extends FormRequest
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
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'placeOfBirth' => 'nullable|string|max:255',
            'dateOfBirth' => 'nullable|date',
            'dateOfDeath' => 'nullable|date',
        ],
        self::METHOD_PUT => [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'placeOfBirth' => 'nullable|string|max:255',
            'dateOfBirth' => 'nullable|date',
            'dateOfDeath' => 'nullable|date',
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
            'fname.required' => 'Pole Imię jest wymagane',
            'fname.string' => 'Pole Imię musi zawierać tekst',
            'fname.max' => 'Pole Imię może zawierać maksymalnie 255 znaków',

            'lname.required' => 'Pole Nazwisko jest wymagane',
            'lname.string' => 'Pole Nazwisko musi zawierać tekst',
            'lname.max' => 'Pole Nazwisko może zawierać maksymalnie 255 znaków',

            'nationality.string' => 'Pole Narodowość musi zawierać tekst',
            'nationality.max' => 'Pole Narodowość może maksymalnie zawierać 255 znaków',

            'placeOfBirth.string' => 'Pole Miejsce urodzenia musi zawierać tekst',
            'placeOfBirth.max' => 'Pole Miejsce urodzenia może maksymalnie zawierać 255 znaków',

            'dateOfBirth.string' => 'Pole Data urodzenia musi zawierać tekst',
            'dateOfBirth.max' => 'Pole Data urodzenia może maksymalnie zawierać 255 znaków',
            'dateOfBirth.date' => 'Pole Data urodzenia musi być formatu daty  typu: RRRR-MM-DD',

            'dateOfDeath.string' => 'Pole Data śmierci musi zawierać tekst',
            'dateOfDeath.max' => 'Pole Data śmierci może maksymalnie zawierać 255 znaków',
            'dateOfDeath.date' => 'Pole Data śmierci musi być formatu daty  typu: RRRR-MM-DD',
        ];
    }

}
