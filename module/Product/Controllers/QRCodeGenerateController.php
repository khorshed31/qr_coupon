<?php

namespace Module\Product\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Module\Product\Models\Product;
use Module\Product\Models\QRCodeGenerate;
use Module\Product\Models\QRCodeGenerateDetail;
use Module\Product\Models\Unit;
use PDF;

class QRCodeGenerateController extends Controller
{






    /*
     |--------------------------------------------------------------------------
     | INDEX METHOD
     |--------------------------------------------------------------------------
    */
    public function index()
    {

        $data['qr_code_products']   = QRCodeGenerate::searchFromRelation('product','name')->with(['product','unit'])->latest()->paginate(28);

        return view('qr-generate.index', $data);
    }






    /*
     |--------------------------------------------------------------------------
     | CREATE METHOD
     |--------------------------------------------------------------------------
    */
    public function create()
    {

        $data['products'] = Product::query()->pluck('name','id');
        $data['units'] = Unit::query()->pluck('name','id');

        return view('qr-generate.create', $data);
    }










    /*
        |--------------------------------------------------------------------------
        | STORE METHOD
        |--------------------------------------------------------------------------
       */
    public function store(Request $request)
    {

        try {
            DB::transaction(function () use ($request){

                $qr_generate = QRCodeGenerate::create([

                    'product_id'            => $request->product_id,
                    'unit_id'               => $request->unit_id,
                    'total_quantity'        => array_sum($request->quantity),
                ]);

                foreach ($request->prize_amounts ?? [] as $key=>$prize_amount){
                    //dd($request->all());
                    for ($i = 0; $i < $request->quantity[$key]; $i++){

                        $qr_code = strtoupper(getRandomWord(2)).rand(1000000000,9999999999);

                        QRCodeGenerateDetail::create([

                            'qr_code_generate_id'   => $qr_generate->id,
                            'prize_amount'          => $prize_amount,
                            'qr_code'               => $qr_code,
                        ]);
                    }
                }
            });



        } catch (\Throwable $th) {
            redirectIfError($th, 1);
        }

        return redirect()->route('product.qr-generates.index')->withMessage('QR code generate successfully !');
    }












    /*
        |--------------------------------------------------------------------------
        | STORE METHOD
        |--------------------------------------------------------------------------
       */
      public function show($id)
      {
            $data['qr_codes'] = QRCodeGenerateDetail::dateFilter('prize_amount')
            ->searchByField('status')
            ->where('qr_code_generate_id', $id)
            ->with(['qr_product','customer'])
            ->paginate(28);

            return view('qr-generate.show', $data);

      }







    /*
   |--------------------------------------------------------------------------
   | APPROVED METHOD
   |--------------------------------------------------------------------------
  */
    public function approved($id)
    {
        $qr_code = QRCodeGenerate::query()->find($id);

        $qr_code->update([
            'status'        => $qr_code->status == 0 ? 1 : 0,
            'approved_by'   => $qr_code->status == 0 ? auth()->id() : null
        ]);

        return redirect()->route('product.qr-generates.index')->withMessage('Approved Success !');
    }






      /*
        |--------------------------------------------------------------------------
        | STORE METHOD
        |--------------------------------------------------------------------------
       */
//      public function print($id)
//      {
//            $data['qr_codes'] = QRCodeGenerateDetail::query()
//            ->where('qr_code_generate_id', $id)
//            ->with('qr_product')
//            ->get();
//
//            return view('qr-generate.print',$data);
//
//      }





    /*
     |--------------------------------------------------------------------------
     | DELETE/DESTORY METHOD
     |--------------------------------------------------------------------------
    */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {

                $qr_code = QRCodeGenerate::find($id);

                if ($qr_code){

                    $qr_details = QRCodeGenerateDetail::where('qr_code_generate_id',$id)->get();

                    foreach ($qr_details as $key => $item) {

                        $item->delete();
                    }
                }

                $qr_code->delete();

            });
        } catch (\Throwable $th) {

            return redirect()->route('product.qr-generates.index')->withError('This data are used another table !');
        }

        return redirect()->route('product.qr-generates.index')->withMessage('Deleted successfully !');
    }










      public function generatePDF($id)
      {

        ini_set("pcre.backtrack_limit", "5000000000000");
        ini_set('max_execution_time', 1200);
          error_reporting(0);
          $data['qr_codes'] = QRCodeGenerateDetail::query()
            ->where('qr_code_generate_id', $id)
            ->where('status', 0)
            ->with('qr_product')
            ->get();

        $qr_product = QRCodeGenerate::where('id',$id)->with(['product','unit'])->first();

        $pdf = PDF::loadView('qr-generate.qr-pdf', $data, [], [
            'margin_header'         => 10,
            'margin_footer'         => 5,
            'mode'                  => 'utf-8',
            'format'                => 'A4',

        ]);

        $pdf->getMpdf()->setFooter("{PAGENO} / {nb}");

        return $pdf->download('QR List(10x10)cm-' . optional($qr_product->product)->name.'-'.$qr_product->total_quantity. '.pdf');
//          return $pdf->stream('QR Code list' . '.pdf');
     }




    public function generateSmallPDF($id)
    {

        ini_set("pcre.backtrack_limit", "5000000000000");
        ini_set('max_execution_time', 1200);
        error_reporting(0);
        $data['qr_codes'] = QRCodeGenerateDetail::query()
            ->where('qr_code_generate_id', $id)
            ->where('status', 0)
            ->with('qr_product')
            ->get();

        $qr_product = QRCodeGenerate::where('id',$id)->with(['product','unit'])->first();

        $pdf = PDF::loadView('qr-generate.qr-pdf(5X5)', $data, [], [
            'margin_header'         => 10,
            'margin_footer'         => 5,
            'mode'                  => 'utf-8',
            'format'                => 'A4',

        ]);

        $pdf->getMpdf()->setFooter("{PAGENO} / {nb}");

//        return $pdf->stream('QR Code list' . '.pdf');

        return $pdf->download('QR List(5x5)cm-' . optional($qr_product->product)->name.'-'.$qr_product->total_quantity. '.pdf');

    }




}
