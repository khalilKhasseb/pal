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
            // 'phd_degrees' => $this->faker->sentence,
            'experience' => $this->faker->numberBetween(1, 30),
            'attachment_personal_photo' => $this->faker->imageUrl(), // Placeholder image
            'agreement_check' => true,
        ];
    }

    /**
     * Adds a media attachment to the Expert model after creation.
     *
     * This method ensures that a 'fake' directory exists before generating
     * a random image to be used as a personal photo. The image is attached
     * to the expert's media collection named 'image' and is cleaned up
     * afterwards. Errors during file deletion are logged.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    // public function withMedia()
    // {
    //     return $this->afterCreating(function (Expert $expert) {
    //         // Ensure the 'fake' directory exists
    //         if (!Storage::exists('fake')) {

    //             Storage::makeDirectory('fake');
    //         }

    //         // Generate a random image in the 'fake' directory
    //         $imagePath = $this->faker->image(storage_path('app/fake'));

    //         // Attach the image to the expert's media collection
    //         $expert->addMedia($imagePath)
    //             ->usingFileName('personal_photo.jpg')
    //             ->toMediaCollection('image');

    //         // Cleanup: Remove the temporary image file
    //         try {
    //             unlink($imagePath);
    //         } catch (\Exception $e) {
    //             \Log::error('Failed to delete temporary file: ' . $imagePath);
    //         }
    //     });

    // }

    public function withMedia()
    {
        return $this->afterCreating(function (Expert $expert) {
            $fakeDirectory = storage_path('app/public/fake');
            if (!is_dir($fakeDirectory)) {
                mkdir($fakeDirectory, 0755, true);
            }

            $imageFileName = $this->faker->image($fakeDirectory, 300, 300, null, false);
            $imagePath = $fakeDirectory . '/' . $imageFileName;

            try {
                if (is_file($imagePath)) {
                    $expert->addMedia($imagePath)->toMediaCollection('image');
                } else {
                    \Log::error('Generated file is not valid: ' . $imagePath);
                }
            } catch (\Exception $e) {
                \Log::error('Failed to add media: ' . $e->getMessage());
            } finally {
                if (is_file($imagePath)) {
                    try {
                        unlink($imagePath);
                    } catch (\Exception $e) {
                        \Log::error('Failed to delete temporary file: ' . $imagePath . ' Error: ' . $e->getMessage());
                    }
                } else {
                    \Log::error('Temporary file not found for deletion: ' . $imagePath);
                }
            }
        });
    }

}
