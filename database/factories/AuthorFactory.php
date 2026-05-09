<?php
namespace Database\Factories;
use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;
class AuthorFactory extends Factory
{
 protected $model = Author::class;
 public function definition(): array
 {
 $nationalities = [
 'Bolivia', 'Argentina', 'Colombia',
 'México', 'Perú', 'Chile',
 'Ecuador', 'Venezuela', 'España',
 'Uruguay', 'Paraguay', 'Brasil',
 ];
 return [
    'first_name'  => fake()->firstName(), // Debe ser igual a la columna en la DB
    'last_name'   => fake()->lastName(),
    'nationality' => fake()->country(),
    'birth_date'  => fake()->date(),
    'biography'   => fake()->paragraph(),
];
 }
}