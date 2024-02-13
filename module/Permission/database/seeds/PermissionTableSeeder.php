<?php

namespace Module\Permission\database\seeds;

use Illuminate\Database\Seeder;
use Module\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getDatas() ?? [] as $permission) {
            Permission::updateOrCreate([
                'slug'                  => $permission['slug'],
            ], [
                'name'                  => $permission['name'],
                'submodule_id'          => $permission['submodule_id'],
                'created_by'            => 1,
                'updated_by'            => 1,
            ]);
        }
    }

    private function getDatas()
    {
        return [
            ['id' => '1', 'name' => 'QR Code',                  'slug'  => 'product.qr-generates.index',                    'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '1', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '2', 'name' => 'Generate',                 'slug'  => 'product.qr-generates.create',                   'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '1', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '3', 'name' => 'QR Code View',             'slug'  => 'product.qr-generates.show',                     'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '1', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '4', 'name' => 'QR Code Delete',           'slug'  => 'product.qr-generates.delete',                   'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '1', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '5', 'name' => 'QR Code Print',            'slug'  => 'product.qr.pdf',                                'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '2', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],

            ['id' => '6', 'name' => 'Product List',             'slug'  => 'product.products.index',       'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '2', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '7', 'name' => 'Product Create',           'slug'  => 'product.products.create',       'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '2', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '8', 'name' => 'Product Update',           'slug'  => 'product.products.edit',         'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '2', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '9', 'name' => 'Product Delete',           'slug'  => 'product.products.delete',       'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '2', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],

            ['id' => '10', 'name' => 'Unit List',              'slug'  => 'product.units.index',           'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '3', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '11', 'name' => 'Unit Create',            'slug'  => 'product.units.store',           'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '3', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '12', 'name' => 'Unit Update',            'slug'  => 'product.units.update',          'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '3', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '13', 'name' => 'Unit Delete',            'slug'  => 'product.units.delete',          'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '3', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],


            ['id' => '14', 'name' => 'User List',              'slug'  => 'product.users.index',                   'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '4', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '15', 'name' => 'User Create',            'slug'  => 'product.users.store',                   'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '4', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '16', 'name' => 'User Update',            'slug'  => 'product.users.update',                  'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '4', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '17', 'name' => 'User Delete',            'slug'  => 'product.users.delete',                  'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '4', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],

            ['id' => '18', 'name' => 'Business Setting',       'slug'  => 'product.business-settings.index',          'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' =>  '5', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],

            ['id' => '19', 'name' => 'Customer List',                   'slug'  => 'product.customers.index',                 'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' =>  '6', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '20', 'name' => 'Customer Create',                 'slug'  => 'product.customers.store',                 'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' =>  '6', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '21', 'name' => 'Customer Update',                 'slug'  => 'product.customers.update',                'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' =>  '6', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '22', 'name' => 'Customer Delete',                 'slug'  => 'product.customers.delete',                'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' =>  '6', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],

            ['id' => '23', 'name' => 'QR Code Approved',                     'slug'  => 'product.qr.approved',                    'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '1', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '24', 'name' => 'QR Code Unapproved',                   'slug'  => 'product.qr.unapproved',                   'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '1', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],

            ['id' => '25', 'name' => 'Customer Upload',                 'slug'  => 'product.customers.delete',                'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' =>  '6', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],

            ['id' => '26', 'name' => 'Referral Employee List',                   'slug'  => 'product.referral_employees.index',                 'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' =>  '7', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '27', 'name' => 'Referral Employee Create',                 'slug'  => 'product.referral_employees.store',                 'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' =>  '7', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '28', 'name' => 'Referral Employee Update',                 'slug'  => 'product.referral_employees.update',                'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' =>  '7', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],
            ['id' => '29', 'name' => 'Referral Employee Delete',                 'slug'  => 'product.referral_employees.delete',                'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' =>  '7', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],

            ['id' => '30', 'name' => 'User Permission',            'slug'  => 'permission-access.edit',                  'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '4', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],

            ['id' => '31', 'name' => 'Withdraw Request',            'slug'  => 'product.withdraw_requests.edit',                  'description' => NULL, 'created_by' => '1', 'updated_by' => '1', 'submodule_id' => '8', 'created_at' => '2019-12-25 09:58:21', 'updated_at' => '2019-12-25 09:58:21', 'status' => '1'],



        ];
    }
}
