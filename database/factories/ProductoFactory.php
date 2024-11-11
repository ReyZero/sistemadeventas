<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Producto>
 */
class ProductoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'codigo' => $this->faker->unique()->ean13(),
            'nombre' => $this->faker->word(),
            'descripcion' => $this->faker->sentence(),
            'imagen' => $this->faker->imageUrl(640, 480, 'product', true),
            'stock' => $this->faker->numberBetween(10, 100),
            'stock_minimo' => $this->faker->numberBetween(10, 100),
            'stock_maximo' => $this->faker->numberBetween(10, 100),
            'precio_compra' => $this->faker->randomFloat(0, 10, 500),
            'precio_venta' => $this->faker->randomFloat(0, 10, 500),
            'fecha_ingreso' => $this->faker->date(),
            'categoria_id' => 4,
            'empresa_id' => 1,


            /*
            $table->string('codigo')->unique(); 
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->text('imagen')->nullable();
            $table->integer('stock');
            $table->integer('stock_minimo');
            $table->integer('stock_maximo');
            $table->decimal('precio_compra', 8, 2);
            $table->decimal('precio_venta', 8, 2);
            $table->date('fecha_ingreso');
            categoria_id
            empresa_id
            */
        ];
    }
}
