<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\LocationAlias;
use Exception;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        Location::factory(100)->create()->each(function (Location $location) {
            $location->aliases()->saveMany(LocationAlias::factory(random_int(1, 5))->create([
                'location_id' => $location->id,
            ]));
        });
    }
}
