<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Xot\Models\Module;

/**
<<<<<<< HEAD
 * Module Factory.
=======
 * Module Factory
>>>>>>> laraxot/master
 *
 * @extends Factory<Module>
 */
class ModuleFactory extends Factory
{
    protected $model = Module::class;

<<<<<<< HEAD
    /**
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'slug' => fake()->slug(),
            'version' => fake()->semver(),
            'description' => fake()->sentence(),
            'is_active' => fake()->boolean(80),
            'priority' => fake()->numberBetween(1, 100),
=======
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->slug(),
            'version' => $this->faker->semver(),
            'description' => $this->faker->sentence(),
            'is_active' => $this->faker->boolean(80),
            'priority' => $this->faker->numberBetween(1, 100),
>>>>>>> laraxot/master
        ];
    }

    public function active(): static
    {
<<<<<<< HEAD
        return $this->state(fn (array $_attributes): array => [
=======
        return $this->state(fn(array $_attributes): array => [
>>>>>>> laraxot/master
            'is_active' => true,
        ]);
    }

    public function inactive(): static
    {
<<<<<<< HEAD
        return $this->state(fn (array $_attributes): array => [
=======
        return $this->state(fn(array $_attributes): array => [
>>>>>>> laraxot/master
            'is_active' => false,
        ]);
    }

    public function highPriority(): static
    {
<<<<<<< HEAD
        return $this->state(fn (array $_attributes): array => [
=======
        return $this->state(fn(array $_attributes): array => [
>>>>>>> laraxot/master
            'priority' => $this->faker->numberBetween(80, 100),
        ]);
    }
}
