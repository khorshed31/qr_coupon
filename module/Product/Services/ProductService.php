<?php


namespace Module\Product\Services;


use App\Traits\FileSaver;
use Module\Product\Models\Product;

class ProductService
{

    use FileSaver;

    public $product;






/*
|--------------------------------------------------------------------------
| VALIDATION METHOD
|--------------------------------------------------------------------------
*/

//    public function validation($request)
//    {
//        return $request->validate([
//            'name'              => 'required',
//            'unit_id'           => 'requited',
//        ]);
//    }



    /*
     |--------------------------------------------------------------------------
     | STORE/UPDATE METHOD
     |--------------------------------------------------------------------------
    */
    public function storeOrUpdate($request, $id = null)
    {

        $this->product = Product::updateOrCreate([
            'id'    => $id,
        ], [
            'name'          => $request->name,
        ]);

        $this->upload_file($request->image, $this->product, 'image', 'products');

    }



}
