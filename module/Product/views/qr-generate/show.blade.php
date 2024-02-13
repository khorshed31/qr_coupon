@extends('layouts.master')


@section('title', 'QR Code')

@section('page-header')
    <i class="fa fa-info-circle"></i> QR Code
@stop

@section('css')

    <style>
        .qr_card {
            position: relative;
            width: 50%;
        }

        .qr_body {
            display: block;
            width: 100%;
            height: auto;
            border: 1px solid #cbc6c6;
            padding: 10px;
            background-color: #e0eaf3;
            box-shadow: 7px 6px 9px #c1c1c1;
        }

        .qr_body_used{

            display: block;
            width: 100%;
            height: auto;
            border: 1px solid #cbc6c6;
            padding: 10px;
            background-color: #f59797;
            box-shadow: 7px 6px 9px #c1c1c1;
        }

        .overlay {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .5s ease;
            background-color: rgba(31, 48, 117, 0.97);
        }

        .overlay_used {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            transition: .5s ease;
            background-color: rgba(215, 41, 50, 0.96);
        }

        .qr_card:hover .overlay {
            opacity: 1;
        }

        .qr_card:hover .overlay_used {
            opacity: 1;
        }

        .text {
            color: white;
            font-size: 20px;
            position: absolute;
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>

@endsection

@section('content')


    <div class="row">
        <div class="col-md-12">


            @include('partials._alert_message')




            <div class="widget-box">


                <!-- header -->
                <div class="widget-header">
                    <h4 class="widget-title"> @yield('page-header')</h4>
                    <span class="widget-toolbar">
                        @if (hasPermission('product.qr-generates.index', $slugs))
                            <a href="{{ route('product.qr-generates.index') }}" class="">
                            <i class="fa fa-qrcode"></i> List
                        </a>
                        @endif

                    </span>
                </div>



                <!-- body -->
                <div class="widget-body">
                    <div class="widget-main">

                        <!-- Searching -->
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <tr>
                                             <td>

                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        Status
                                                    </span>
                                                    <select name="status" id="" class="form-control chosen-select" data-placeholder="--Select one--">
                                                        <option value=""></option>
                                                        <option value="1" {{ request('status') == 1 ? 'selected' : '' }}>Used</option>
                                                        <option value="0" {{ request('status') == 0 ? 'selected' : '' }}>Not Used</option>
                                                    </select>
                                                </div>
                                            </td>

                                            <td>

                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="from"
                                                           value="{{ request('from') }}" placeholder="Enter Start Price">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-exchange"></i>
                                                    </span>
                                                    <input type="number" class="form-control" name="to"
                                                           value="{{ request('to') }}" placeholder="Enter End Price">
                                                </div>
                                            </td>


                                            <td>
                                                <div class="btn-group btn-corner">
                                                    <button type="submit" class="btn btn-sm btn-success">
                                                        <i class="fa fa-search"></i> Search
                                                    </button>
                                                    <a href="{{ request()->url() }}" class="btn btn-sm">
                                                        <i class="fa fa-refresh"></i>
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                        </tbody>
                                    </table>
                                </form>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-xs-12">

                                <div class="card-body">
                                    <div class="pos-product">
                                        <div class="row justify-content-center pt-sm-65" style="margin: 16px;">
                                            @forelse ($qr_codes as $key => $item)
                                                <div class="col-md-2 qr_card" style="margin-top:5px; width: 22%">
                                                    <div class="{{ $item->status == 1 ? 'qr_body_used' : 'qr_body' }}">
                                                        <div class="text-center">
                                                            {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(150)->generate($item->qr_code); !!}<br>
                                                            <strong style="color: black">{{ $item->qr_code }}</strong>
                                                        </div>
                                                        <div class="description text-left" style="padding: 12px;color: black">
                                                            <strong>Product Name: {{ optional($item->qr_product)->product->name }}</strong><br>

                                                            <strong>Unit: {{ optional($item->qr_product)->unit->name }}</strong><br>
                                                            <strong style="font-size: 16px; color: black">Prize Amount : <span>{{ $item->prize_amount }}</span></strong>
                                                        </div>
                                                    </div>
                                                    <div class="{{ $item->status == 1 ? 'overlay_used' : 'overlay' }}">
                                                        <div class="text">
                                                            {{ $item->customer_id ? 'This QR Code ('.$item->qr_code. ')  Was Used By ' .optional($item->customer)->name : 'Not Used Yet '.$item->qr_code }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty

                                                <img src="{{ asset('assets/images/no_result.gif') }}" alt="No Result Found" style="margin-left: 20%">

                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                                @include('partials._paginate', ['data' => $qr_codes])

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script>
        /***************/
        $('.show-details-btn').on('click', function(e) {
            e.preventDefault();
            $(this).closest('tr').next().toggleClass('open');
            $(this).find(ace.vars['.icon']).toggleClass('fa-eye').toggleClass('fa-eye-slash');
        });
        /***************/
    </script>

@stop


