<?php

namespace Database\Seeders;

use App\Http\Controllers\Modules\File\Modules;
use App\Http\Controllers\Modules\Model\Module;
use Illuminate\Database\Seeder;

class ModulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modulesList = Modules::modulesList;
        $preparedModule = [];
        foreach ($modulesList as $module) {
            $module['default_permissions'] = json_encode($module["default_permissions"]);
            $module['type'] = (isset($module['type'])) ? $module['type'] : 'Other';
            $preparedModule[] = $module;
        }
        Module::insert($preparedModule);
        print("Module Seeded Successfully");
    }
}
