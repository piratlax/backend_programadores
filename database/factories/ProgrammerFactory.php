<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Programmer>
 */
class ProgrammerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $skills = ["PHP", "Node.js", "Javascript", "Rust", "React Native"];
        $randomSkills = $this->faker->randomElements($skills, rand(1, 3));
        return [
            "name" => $this->faker->name,
            "summary" => $this->faker->text(158),
            "photo" => $this->faker->image(storage_path("app/public/programmers"), 140, 240, "people", false),
            "skills" => implode(", ", $randomSkills)
        ];
    }
}
