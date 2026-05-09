<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Lista paginada de autores con conteo de libros.
     */
    public function index()
    {
        $authors = Author::withCount('books')
            ->orderBy('last_name')
            ->paginate(15);
        return view('authors.index', compact('authors'));
    }
    /**
     * Muestra la ficha del autor con sus libros.
     */
    public function show(Author $author)
    {
        $author->load('books.category');
        return view('authors.show', compact('author'));
    }
    // Métodos placeholder — se implementan en guías posteriores
    public function create()
    { /* Guía 7 */
    }
    public function store(Request $request)
    { /* Guía 7 */
    }
    public function edit(Author $author)
    { /* Guía 7 */
    }
    public function update(Request $request, Author $author)
    { /* Guía 7 */
    }
    public function destroy(Author $author)
    { /* Guía 7 */
    }
}
