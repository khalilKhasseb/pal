<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Expert;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExpertCirtificate>
 */
class ExpertCirtificateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'certificate_name' => $this->faker->word . ' Certification',
            'certifying_authority' => $this->faker->company,
            'authenticate_certificate_url' => $this->faker->url,
            'attachment_certification' => $this->faker->imageUrl(), // Placeholder for certificate file
            'certification_experience' => $this->faker->numberBetween(0, 10), // Years of experience
            'expert_id' => Expert::factory(), // Generate a related expert

        ];
    }
}
