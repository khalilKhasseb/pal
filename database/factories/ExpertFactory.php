<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Storage;
use App\Models\Expert;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expert>
 */
class ExpertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sir_name_ar' => $this->faker->lastName . ' (AR)',
            'sir_name_en' => $this->faker->lastName,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'email' => $this->faker->unique()->safeEmail,
            'mobile_number' => $this->faker->phoneNumber,
            'city_id' => $this->faker->numberBetween(1, 50), // Assuming city IDs range from 1 to 50
            'governorate_id' => $this->faker->numberBetween(1, 10), // Assuming governorate IDs range from 1 to 10
            'date_of_birth' => $this->faker->date('Y-m-d'),
            'university' => $this->faker->company . ' University',
            'ba_major' => $this->faker->word . ' Studies',
            'graduation_year' => $this->faker->year,
            'other_degrees' => $this->faker->sentence,
            'phd_degrees' => $this->faker->sentence,
            'experience' => $this->faker->numberBetween(1, 30),
            'attachment_personal_photo' => $this->faker->imageUrl(), // Placeholder image
            'agreement_check' => true,
        ];
    }

    public function withMedia()
    {
        return $this->afterCreating(function (Expert $expert) {
            // Ensure the 'fake' directory exists
            Storage::makeDirectory('fake');

            // Generate a random image in the 'fake' directory
            $imagePath = $this->faker->image(storage_path('app/fake'));

            // Attach the image to the expert's media collection
            $expert->addMedia($imagePath)
                ->usingFileName('personal_photo.jpg')
                ->toMediaCollection('image');

            // Cleanup: Remove the temporary image file
            try {
                unlink($imagePath);
            } catch (\Exception $e) {
                \Log::error('Failed to delete temporary file: ' . $imagePath);
            }
        });

    }

}
