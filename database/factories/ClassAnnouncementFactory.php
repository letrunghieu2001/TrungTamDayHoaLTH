<?php

namespace Database\Factories;

use App\Models\ChemistryClass;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassAnnouncement>
 */
class ClassAnnouncementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'content' => fake()->text(),
            'created_at' => now(),
            'user_id' => User::get('id')->where('role_id',1)->random(1)->first(),
            'class_id' => ChemistryClass::get('id')->random(1)->first()
        ];
    }
}
