<?php

namespace Module\Permission\database\seeds;

use Module\Permission\Models\Module;
use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getModules() ?? [] as $module) {
            Module::firstOrCreate([
                'id'        => $module['id'],
            ], [
                'name'      => $module['name'],
                'status'    => $module['status'],
            ]);
        }
    }

    private function getModules()
    {
        return [
            ['id' => '1',       'status' => '1', 'name' => 'Qr Code'],
            ['id' => '2',       'status' => '1', 'name' => 'Product'],
            ['id' => '3',       'status' => '1', 'name' => 'User Management'],
            ['id' => '4',       'status' => '1', 'name' => 'Business Setting'],
            ['id' => '5',       'status' => '1', 'name' => 'Customer'],
            ['id' => '6',       'status' => '1', 'name' => 'Referral Employee'],
            ['id' => '7',       'status' => '1', 'name' => 'Withdraw Request'],

        ];
    }
}
