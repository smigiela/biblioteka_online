<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use PhpParser\Node\Scalar\String_;

class AuthorController extends Controller
{
    /**
     * @return Collection
     */
    public function index():Collection
    {
        return Author::all();
    }

    /**
     * @param AuthorRequest $request
     *
     * @return Author
     */
    public function store(AuthorRequest $request):Author
    {
        $newItem = new Author;
        $newItem->fname = $request->get("fname");
        $newItem->lname = $request->get("lname");
        $newItem->nationality = $request->get("nationality");
        $newItem->placeOfBirth = $request->get("placeOfBirth");
        $newItem->dateOfBirth = $request->get("dateOfBirth");
        $newItem->dateOfDeath = $request->get("dateOfDeath");
        $newItem->save();

        return $newItem;
    }

    /**
     * @param Author $author
     *
     * @return Author
     */
    public function show(Author $author):Author
    {
        return Author::find($author['id']);
    }

    /**
     * @param AuthorRequest $request
     * @param Author $author
     *
     * @return Author
     */
    public function update(AuthorRequest $request, Author $author):Author
    {
        $newItem = Author::find($author['id']);
        $newItem->update($request->all());
        return $newItem;
    }

    /**
     * @param Author $author
     *
     * @return Author
     */
    public function destroy(Author $author):String
    {
        if (Author::find($author['id'])) {
            Author::destroy($author['id']);
            return "Pomyślnie usunięto autora (ID: " . $author['id'] . ")";
        } else {
            return "Author (ID: " . $author['id'] . ") nie istnieje";
        }
    }
}
