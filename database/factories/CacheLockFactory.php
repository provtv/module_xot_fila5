<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Models\CacheLock;

<<<<<<< HEAD
/**
 * @extends Factory<CacheLock>
 */
=======
>>>>>>> laraxot/master
class CacheLockFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
<<<<<<< HEAD
     * @var class-string<CacheLock>
=======
     * @var class-string<Model>
>>>>>>> laraxot/master
     */
    protected $model = CacheLock::class;

    /**
     * Define the model's default state.
     */
<<<<<<< HEAD
    /**
     * @return array<string, mixed>
     */
=======
>>>>>>> laraxot/master
    public function definition(): array
    {
        return [
            'key' => $this->faker->word,
            'owner' => $this->faker->word,
            'expiration' => $this->faker->randomNumber(5),
        ];
    }
}
