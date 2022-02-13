<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $testData = json_encode([1]);
        // $decodeData = json_decode($testData, true);
        // array_push($decodeData, 2);
        // dd($decodeData);
        Category::insert([
            [
                'name' => 'mobil',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'name' => 'motor',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);

        $getParentVehicle = Category::whereNull('parent_id')->get();
        if ($getParentVehicle->isNotEmpty())
        {
            foreach($getParentVehicle as $value) {
                if ($value->name == 'mobil') {
                    Category::insert([
                        [
                            'name' => 'mobil/toyota',
                            'parent_id' => json_encode([$value->id]),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                        [
                            'name' => 'mobil/nissan',
                            'parent_id' => json_encode([$value->id]),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                        [
                            'name' => 'mobil/daihatsu',
                            'parent_id' => json_encode([$value->id]),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]
                    ]);
                } else {
                    Category::insert([
                        [
                            'name' => 'motor/honda',
                            'parent_id' => json_encode([$value->id]),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                        [
                            'name' => 'motor/yamaha',
                            'parent_id' => json_encode([$value->id]),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                        [
                            'name' => 'motor/suzuki',
                            'parent_id' => json_encode([$value->id]),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]
                    ]);
                }
            }

            $getChildVehicle = Category::whereNotNull('parent_id')->whereRaw('JSON_LENGTH(parent_id) = 1')->get();
            foreach($getChildVehicle as $childValue) {
                if ($childValue->name == 'mobil/toyota') {
                    $decodeData = json_decode(json_encode($childValue->parent_id), true);
                    array_push($decodeData, $childValue->id);

                    Category::insert([
                        [
                            'name' => 'mobil/toyota/avanza',
                            'parent_id' => json_encode($decodeData),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                        [
                            'name' => 'mobil/toyota/inova',
                            'parent_id' => json_encode($decodeData),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                    ]);
                } else if ($childValue->name == 'mobil/daihatsu') {
                    $decodeData = json_decode(json_encode($childValue->parent_id), true);
                    array_push($decodeData, $childValue->id);

                    Category::insert([
                        [
                            'name' => 'mobil/daihatsu/xenia',
                            'parent_id' => json_encode($decodeData),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                        [
                            'name' => 'mobil/daihatsu/ayla',
                            'parent_id' => json_encode($decodeData),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                    ]);
                } else if ($childValue->name == 'mobil/nissan') {
                    $decodeData = json_decode(json_encode($childValue->parent_id), true);
                    array_push($decodeData, $childValue->id);

                    Category::insert([
                        [
                            'name' => 'mobil/nissan/juke',
                            'parent_id' => json_encode($decodeData),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                        [
                            'name' => 'mobil/nissan/livina',
                            'parent_id' => json_encode($decodeData),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                    ]);
                } else if ($childValue->name == 'motor/honda') {
                    $decodeData = json_decode(json_encode($childValue->parent_id), true);
                    array_push($decodeData, $childValue->id);

                    Category::insert([
                        [
                            'name' => 'motor/honda/vario',
                            'parent_id' => json_encode($decodeData),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                        [
                            'name' => 'motor/honda/cbr',
                            'parent_id' => json_encode($decodeData),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                    ]);
                } else if ($childValue->name == 'motor/yamaha') {
                    $decodeData = json_decode(json_encode($childValue->parent_id), true);
                    array_push($decodeData, $childValue->id);

                    Category::insert([
                        [
                            'name' => 'motor/yamaha/mio',
                            'parent_id' => json_encode($decodeData),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                        [
                            'name' => 'motor/yamaha/r15',
                            'parent_id' => json_encode($decodeData),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                    ]);
                } else {
                    $decodeData = json_decode(json_encode($childValue->parent_id), true);
                    array_push($decodeData, $childValue->id);

                    Category::insert([
                        [
                            'name' => 'motor/suzuki/spin',
                            'parent_id' => json_encode($decodeData),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                        [
                            'name' => 'motor/suzuki/satria',
                            'parent_id' => json_encode($decodeData),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        ],
                    ]);
                }
            }
        }

    }
}
