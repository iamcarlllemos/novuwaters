<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PropertyType;
use App\Models\PropertyTypes;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $propertyTypes = [
            ['name' => 'residential'],
            ['name' => 'commercial'],
            ['name' => 'industrial'],
        ];

        foreach ($propertyTypes as $type) {
            PropertyTypes::updateOrCreate(['name' => $type['name']], $type);
        }
    }
}
