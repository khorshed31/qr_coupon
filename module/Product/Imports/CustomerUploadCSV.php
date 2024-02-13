<?php


namespace Module\Product\Imports;


use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Module\Product\Models\Customer;

class CustomerUploadCSV implements ToModel, WithHeadingRow
{


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        try {
            $customer = Customer::create([
                'name'              => trim($row['name']),
                'mobile'            => trim($row['mobile']),
                'garage_name'       => trim($row['garage_name']),
                'refer_code'        => trim($row['refer_code']),
                'address'           => trim($row['address']),
            ]);

            return new User([
                'name'          => trim($row['name']),
                'mobile'        => trim($row['mobile']),
                'password'      => trim(Hash::make(12345678)),
                'type'          => trim('customer'),
                'customer_id'   => trim($customer->id),
            ]);
        } catch (\Exception $ex) {
            throw $ex;
        }
    }

}
