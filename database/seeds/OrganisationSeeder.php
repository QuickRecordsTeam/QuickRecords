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
        Organisation::create([
            'id'            => Str::uuid()->toString(),
            'name'          => "QuickRecords",
            'email'         => "support@quickrecords.com",
            'region'        => "Southwest",
            'telephone'     => "+237683404289",
            'address'       => "Buea",
            'description'   => "Streamlinning Finance Management within an Organisation, Church, Group or Business",
            'logo'          => "",
            'salutation'    => "Streamlining Finance Management with Innovative Technology",
            'box_number'    => 1523,
            'updated_by'    => "Admin"
        ]);
    }
}
