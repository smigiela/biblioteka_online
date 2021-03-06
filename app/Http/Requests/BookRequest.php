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
            'amount' => 'required|integer|max:2147483648|gt:-1',
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
            'amount' => 'required|integer|max:2147483648|gt:-1',
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
            'author_id.integer' => 'Pole autor musi zawiera?? warto???? liczbow??',

            'category_id.required' => 'Pole gatunek jest wymagane',
            'category_id.exists' => 'Gatunek o takim ID nie istnieje',
            'category_id.integer' => 'Pole gatunek musi zawiera?? warto???? liczbow??',

            'ISBN.required' => 'Pole ISBN jest wymagane',
            'ISBN.unique' => 'Pole ISBN musi zawiera?? unikatow?? warto????',
            'ISBN.gt' => 'Pole ISBN musi zawiera?? warto???? nieujemn??',
            'ISBN.digits' => 'Pole ISBN musi zawiera?? warto???? liczbow?? 13-nasto cyfrow??',

            'title.required' => 'Pole tytu?? jest wymagane',
            'title.string' => 'Pole tytu?? musi zawiera?? tekst',
            'title.min' => 'Pole tytu?? musi sk??ada?? si?? z conajmniej 3 znak??w',
            'title.max' => 'Pole tytu?? mo??e maksymalnie zawiera?? 255 znak??w',

            'amount.required' => 'Pole ilo???? jest wymagane',
            'amount.integer' => 'Pole ilo???? musi zawiera?? warto???? liczbow??',
            'amount.max' => 'Warto???? pola ilo???? mo??e maksymalnie wynosi?? 2147483648',
            'amount.gt' => 'Pole ilo???? musi zawiera?? warto???? nieujemn??',

            'price.required' => 'Pole cena jest wymagane',
            'price.numeric' => 'Pole cena musi zawiera?? warto???? liczbow?? z separatorem "."',
            'price.regex' => 'Pole cena musi zawiera?? warto???? liczbow?? z dwoma miejscami po "."',

            'publisher.required' => 'Pole wydawca jest wymagane',
            'publisher.string' => 'Pole wydawca musi zawiera?? tekst',
            'publisher.min' => 'Pole wydawca musi sk??ada?? si?? z conajmniej 3 znak??w',
            'publisher.max' => 'Pole wydawca mo??e maksymalnie zawiera?? 255 znak??w',

            'language.required' => 'Pole j??zyk jest wymagane',
            'language.string' => 'Pole j??zyk musi zawiera?? tekst',
            'language.min' => 'Pole j??zyk musi sk??ada?? si?? z conajmniej 2 znak??w',
            'language.max' => 'Pole j??zyk mo??e maksymalnie zawiera?? 255 znak??w',

            'description.required' => 'Pole opis jest wymagane',
            'description.string' => 'Pole opis musi zawiera?? tekst',
            'description.min' => 'Pole j??zyk musi sk??ada?? si?? z conajmniej 5 znak??w',
            'description.max' => 'Pole j??zyk mo??e maksymalnie zawiera?? 65535 znak??w',
        ];
    }
}
