<?php

namespace Database\Seeders;

use App\Models\District;
use App\Models\Division;
use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    public function run()
    {
        $places = file_get_contents(resource_path('json/places.json'));
        $placesJson = json_decode($places, true);

        foreach ($placesJson as $division => $districts) {
            $div = Division::create([
                'name' => $division
            ]);

            foreach ($districts as $district => $areas) {
                $dist = District::create([
                    'name' => $district,
                    'division_id' => $div->id
                ]);

                foreach ($areas as $area) {
                    Area::create([
                        'name' => $area,
                        'district_id' => $dist->id
                    ]);
                }
            }
        }
    }
}
