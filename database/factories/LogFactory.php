<?php

declare(strict_types=1);

namespace Modules\Xot\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Modules\Xot\Models\Log;

<<<<<<< HEAD
/**
 * @extends Factory<Log>
 */
=======
>>>>>>> laraxot/master
class LogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
<<<<<<< HEAD
     * @var class-string<Log>
=======
     * @var class-string<Model>
>>>>>>> laraxot/master
     */
    protected $model = Log::class;

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
            // 'key' => $this->faker->word,
            // 'value' => $this->faker->text,
            // 'expiration' => $this->faker->randomNumber(5),
        ];
    }
}
