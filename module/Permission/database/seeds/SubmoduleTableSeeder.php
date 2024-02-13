<?php

namespace Module\Permission\database\seeds;

use Illuminate\Database\Seeder;
use Module\Permission\Models\Submodule;

class SubmoduleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getSubmodules() ?? [] as $submodule) {
            Submodule::updateOrCreate([
                'id'        => $submodule['id'],
            ], [
                'name'      => $submodule['name'],
                'module_id' => $submodule['module_id'],
            ]);
        }
        Submodule::whereNotIn('id', collect($this->getSubmodules())->pluck('id'))->delete();
    }

    private function getSubmodules()
    {
        return [
            ['id' => '1',  'name' => 'QR Code',                   'module_id' => '1',  'created_at' => '2019-12-25 20:45:50', 'updated_at' => '2019-12-25 23:03:11'],

            ['id' => '2',  'name' => 'Product',                   'module_id' => '2',  'created_at' => '2019-12-25 20:45:50', 'updated_at' => '2019-12-25 23:03:11'],
            ['id' => '3',  'name' => 'Unit',                      'module_id' => '2',  'created_at' => '2019-12-25 20:45:50', 'updated_at' => '2019-12-25 23:03:11'],

            ['id' => '4', 'name' => 'User',                       'module_id' => '3',  'created_at' => '2019-12-25 20:45:50', 'updated_at' => '2019-12-25 23:03:11'],

            ['id' => '5', 'name' => 'Business Setting',           'module_id' => '4',  'created_at' => '2019-12-25 20:45:50', 'updated_at' => '2019-12-25 23:03:11'],

            ['id' => '6', 'name' => 'Customer',                    'module_id' => '5',  'created_at' => '2019-12-25 20:45:50', 'updated_at' => '2019-12-25 23:03:11'],

            ['id' => '7', 'name' => 'Referral Employee',                    'module_id' => '6',  'created_at' => '2019-12-25 20:45:50', 'updated_at' => '2019-12-25 23:03:11'],

            ['id' => '8', 'name' => 'Withdraw Request',                    'module_id' => '7',  'created_at' => '2019-12-25 20:45:50', 'updated_at' => '2019-12-25 23:03:11'],

        ];
    }
}
