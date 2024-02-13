<?php

namespace Module\Product\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\FileSaver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Module\Product\Models\Product;
use Module\Product\Models\Unit;
use Module\Product\Services\ProductService;

class ProductController extends Controller
{


    use FileSaver;

    private $service;


    /*
     |--------------------------------------------------------------------------
     | CONSTRUCTOR
     |--------------------------------------------------------------------------
    */
    public function __construct(ProductService $productService)
    {
        $this->service = $productService;
    }












    /*
     |--------------------------------------------------------------------------
     | INDEX METHOD
     |--------------------------------------------------------------------------
    */
    public function index()
    {

        $data['products']   = Product::likeSearch('name')->latest()->paginate(25);

        return view('products.product.index', $data);
    }













    /*
     |--------------------------------------------------------------------------
     | CREATE METHOD
     |--------------------------------------------------------------------------
    */
    public function create()
    {

        return view('products.product.create');
    }









    /*
     |--------------------------------------------------------------------------
     | STORE METHOD
     |--------------------------------------------------------------------------
    */
    public function store(Request $request)
    {
        try {

            $this->service->storeOrUpdate($request);

        } catch (\Throwable $th) {
            //dd($th->getMessage());
            redirectIfError($th, 1);
        }

        return redirect()->route('product.products.index')->withMessage('Product added successfully !');
    }












    /*
     |--------------------------------------------------------------------------
     | EDIT METHOD
     |--------------------------------------------------------------------------
    */
    public function edit($id)
    {
        $data['product'] = Product::query()->find($id);

        return view('products.product.edit', $data);
    }








    /*
     |--------------------------------------------------------------------------
     | UPDATE METHOD
     |--------------------------------------------------------------------------
    */
    public function update(Request $request, $id)
    {
        try {

            $this->service->storeOrUpdate($request, $id);

        } catch (\Throwable $th) {
            //dd($th->getMessage());
            redirectIfError($th, 1);
        }

        return redirect()->route('product.products.index')->withMessage('Product added successfully !');
    }








    /*
         |--------------------------------------------------------------------------
         | DELETE/DESTORY METHOD
         |--------------------------------------------------------------------------
        */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {

                $product = Product::find($id);
                $product->delete();
                if (file_exists($product->image)) {
                    unlink($product->image);
                }
            });
        } catch (\Throwable $th) {
            return redirect()->back()->withError('This product is use another table');
        }

        return redirect()->route('product.products.index')->withMessage('Product delete successfully !');
    }









}
