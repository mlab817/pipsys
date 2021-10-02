<?php

namespace Database\Seeders;

use App\Models\RefPdpIndicator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RefPdpIndicatorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table('ref_pdp_indicators')->truncate();

        $pdpIndicators = json_decode(file_get_contents(database_path('seeders/pdp_indicators.json')), true);

        foreach ($pdpIndicators as $indicator) {
            $pdpIndicator = RefPdpIndicator::create([
                'name' => $indicator['name'],
                'label' => $indicator['name'],
                'description' => $indicator['description'] ?? '',
                'parent_id' => null,
                'ref_pdp_chapter_id' => $indicator['ref_pdp_chapter_id'] ?? null,
                'level' => 1,
            ]);
            // validate parent_id

            if (isset($indicator['children'])) {
                foreach ($indicator['children'] as $indicator2) {
                    $pdpIndicator2 = RefPdpIndicator::create([
                        'name' => $indicator2['name'],
                        'label' => $indicator2['name'],
                        'description' => $indicator2['description'] ?? '',
                        'parent_id' => $pdpIndicator->id,
                        'level' => 2,
                    ]);

                    if (isset($indicator2['children'])) {
                        foreach ($indicator2['children'] as $indicator3) {
                            $pdpIndicator3 = RefPdpIndicator::create([
                                'name' => $indicator3['name'],
                                'label' => $indicator3['name'],
                                'description' => $indicator3['description'] ?? '',
                                'parent_id' => $pdpIndicator2->id,
                                'level' => 3,
                            ]);

                            if (isset($indicator3['children'])) {
                                foreach ($indicator3['children'] as $indicator4) {
                                    $pdpIndicator4 = RefPdpIndicator::create([
                                        'name' => $indicator4['name'],
                                        'label' => $indicator4['name'],
                                        'description' => $indicator4['description'] ?? '',
                                        'parent_id' => $pdpIndicator3->id,
                                        'level' => 4,
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
