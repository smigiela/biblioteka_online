<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * @return Collection
     */
    public function index():Collection
    {
        return Book::with('category')
            ->with('author')
            ->get();
    }

    /**
     * @param Request $request
     *
     * @return Book
     */
    public function store(Request $request):Book
    {
        $newItem = new Book;
        $newItem->author_id = $request->get("author_id");
        $newItem->category_id = $request->get("category_id");
        $newItem->ISBN = $request->get("ISBN");
        $newItem->title = $request->get("title");
        $newItem->price = $request->get("price");
        $newItem->publisher = $request->get("publisher");
        $newItem->language = $request->get("language");
        $newItem->description = $request->get("description");
        $newItem->save();

        return $newItem;
    }

    /**
     * @param Book $author
     *
     * @return Book
     */
    public function show(Book $book):Book
    {
        $var = Book::findOrFail($book['id'])
            ->with('category')
            ->with('author')
            ->where('id', $book['id'])
            ->first();
        return $var;
    }

    /**
     * @param Request $request
     * @param Book $author
     *
     * @return Book
     */
    public function update(Request $request, Book $book):Book
    {
        $newItem = Book::find($book['id']);
        $newItem->update($request->all());
        return $newItem;
    }

    /**
     * @param Book $author
     *
     * @return Book
     */
    public function destroy(Book $book):String
    {
        if (Book::find($book['id'])) {
            Book::destroy($book['id']);
            return "Pomyślnie usunięto autora (ID: " . $book['id'] . ")";
        } else {
            return "Author (ID: " . $book['id'] . ") nie istnieje";
        }
    }
}
