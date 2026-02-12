<?php

use App\Models\Organisation;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class OrganisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
       for ($i = 0; $i < 10; $i++) {
            Organisation::create([
                'id'            => Str::uuid()->toString(),
                'name' => $faker->company,
                'description' => $faker->paragraph,
                'email' => $faker->companyEmail,
                'telephone' => $faker->phoneNumber,
                'address' => $faker->address,
                'region' => $faker->state,
                'box_number' => $faker->randomNumber(5),
                'logo' => $faker->imageUrl(200, 200, 'business'),
                'salutation' => $faker->catchPhrase,
                'updated_by' => $faker->name
            ]);
        }
    }
}
