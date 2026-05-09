<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'isbn',
        'publisher',
        'publication_year', // Corregido para coincidir con la vista
        'pages',
        'language',
        'description',
        'cover_url',
        'total_copies',
        'available_copies',
        'status',
        'category_id',
    ];

    protected $casts = [
        'publication_year' => 'integer',
        'pages'            => 'integer',
        'total_copies'     => 'integer',
        'available_copies' => 'integer',
    ];

    /**
     * Relación: un libro tiene muchos autores.
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class)
            ->withPivot('role')
            ->withTimestamps();
    }

    /**
     * Relación: un libro pertenece a una categoría.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relación: Todos los préstamos del libro.
     */
    public function loans(): HasMany
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Relación: Préstamos que NO han sido devueltos.
     * Esta es la que soluciona el error RelationNotFoundException.
     */
    // En app/Models/Book.php

    public function activeLoans(): HasMany
    {
        // Cambiamos 'returned_at' por 'returned_date'
        return $this->hasMany(Loan::class)->whereNull('returned_date');
    }
}
