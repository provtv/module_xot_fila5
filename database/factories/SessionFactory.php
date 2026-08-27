<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Models\Session;

<<<<<<< HEAD
/**
 * @extends Factory<Session>
 */
=======
>>>>>>> laraxot/master
class SessionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
<<<<<<< HEAD
     * @var class-string<Session>
=======
     * @var class-string<Model>
>>>>>>> laraxot/master
     */
    protected $model = Session::class;

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
            // 'id' => $this->faker->word,
        ];
    }
}
