<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookRequest extends FormRequest
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
            'title' => 'required|string|min:3|max:255',
            'ISBN' => 'required|digits:13|unique:books,ISBN|gt:0',
            'author_id' => 'required|integer|exists:authors,id',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|regex:/^\d*(\.\d{2})?$/',
            'publisher' => 'nullable|string|min:3|max:255',
            'language' => 'nullable|string|min:2|max:255',
            'description' => 'nullable|string|min:5|max:65535',
        ],
        self::METHOD_PUT => [
            'title' => 'required|string|min:3|max:255',
            'ISBN' => array('required','digits:13','gt:0'),
            'author_id' => 'required|integer|exists:authors,id',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|regex:/^\d*(\.\d{2})?$/',
            'publisher' => 'nullable|string|min:3|max:255',
            'language' => 'nullable|string|min:2|max:255',
            'description' => 'nullable|string|min:5|max:65535',
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
        $rules = self::$rules[$this->getMethod()] ?? [];
        if ('PUT' == $this->getMethod()) {
            $rules['ISBN'][] = Rule::unique('books', 'ISBN')->ignore($this->book->id);
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'author_id.required' => 'Pole autor jest wymagane',
            'author_id.exists' => 'Autor o takim ID nie istnieje',
            'author_id.integer' => 'Pole autor musi zawierać wartość liczbową',

            'category_id.required' => 'Pole gatunek jest wymagane',
            'category_id.exists' => 'Gatunek o takim ID nie istnieje',
            'category_id.integer' => 'Pole gatunek musi zawierać wartość liczbową',

            'ISBN.required' => 'Pole ISBN jest wymagane',
            'ISBN.unique' => 'Pole ISBN musi zawierać unikatową wartość',
            'ISBN.gt' => 'Pole ISBN musi zawierać wartość nieujemną',
            'ISBN.digits' => 'Pole ISBN musi zawierać wartość liczbową 13-nasto cyfrową',

            'title.required' => 'Pole tytuł jest wymagane',
            'title.string' => 'Pole tytuł musi zawierać tekst',
            'title.min' => 'Pole tytuł musi składać się z conajmniej 3 znaków',
            'title.max' => 'Pole tytuł może maksymalnie zawierać 255 znaków',

            'price.required' => 'Pole cena jest wymagane',
            'price.numeric' => 'Pole cena musi zawierać wartość liczbową z separatorem "."',
            'price.regex' => 'Pole cena musi zawierać wartość liczbową z dwoma miejscami po "."',

            'publisher.required' => 'Pole wydawca jest wymagane',
            'publisher.string' => 'Pole wydawca musi zawierać tekst',
            'publisher.min' => 'Pole wydawca musi składać się z conajmniej 3 znaków',
            'publisher.max' => 'Pole wydawca może maksymalnie zawierać 255 znaków',

            'language.required' => 'Pole język jest wymagane',
            'language.string' => 'Pole język musi zawierać tekst',
            'language.min' => 'Pole język musi składać się z conajmniej 2 znaków',
            'language.max' => 'Pole język może maksymalnie zawierać 255 znaków',

            'description.required' => 'Pole opis jest wymagane',
            'description.string' => 'Pole opis musi zawierać tekst',
            'description.min' => 'Pole język musi składać się z conajmniej 5 znaków',
            'description.max' => 'Pole język może maksymalnie zawierać 65535 znaków',
        ];
    }
}
