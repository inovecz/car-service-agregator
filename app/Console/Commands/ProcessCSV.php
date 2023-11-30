<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Group;
use App\Models\GroupCategory;

class ImportGroups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from csv file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /* $csv = file_get_contents(\storage_path('app/Import_obci.csv'));
        $csvGroups = \csv_to_assoc($csv);
        $groupCategories = GroupCategory::where('type', 'region')->get();

        foreach ($csvGroups as $group) {
            $newGroup = Group::create([
                'name' => $group['name'],
                'code' => $group['city_code'],
                'administrative_district' => $group['administrative_district'],
                'description' => '',
                'status' => $group['city_type'],
                'population' => $group['total_population'],
                'area_ha' => $group['area_ha'],
                'import_row' => $group
            ]);

            foreach ($groupCategories as $groupCategory) {
                if ($groupCategory->getCode() == $group['region_code']) {
                    $newGroup->update(['region_category_id' => $groupCategory->getId()]);
                }
            }
        }
 */
        return Command::SUCCESS;
    }
}
