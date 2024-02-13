@extends('layouts.master')


@section('title', 'QR Code Print')



@push('style')
    <style>

        .font-25{

            font-size: 25px !important;
        }

        .font-12{

            font-size: 12px !important;
        }

        .margin-20{
                margin-bottom: 20px !important;
            }


        .qr_width{
            width: 10cm;
            height: 10cm;
            color: #525252;
            border: 0.5px solid #b1b1b1;
            padding: 10px;
        }


        @media print {


            .qr_col{

                width: 49.99%;
            }


            .margin-20{
                margin-bottom: 20px !important;
            }

            .qr_width{
                width: 9cm;
                height: 10cm;
                color: #525252;
                border: 0.5px solid #b1b1b1;
                padding: 10px;
            }

            .qr_print{
                width: 100%;
                display: flex;
                flex-wrap: wrap;
                /* page-break-inside: avoid; */
            }

            .page-break {
                page-break-after: always;
            }


            svg:not(:root) {

                width: 30% !important;
            }

            .no-print {
                display: none !important;
            }


        }

    </style>
@endpush

@section('content')
    <div class="row">

        <div class="col-xs-12">
            <div class="widget-box">
                <div class="widget-header no-print">
                    <h4 class="widget-title">
                        <i class="fa fa-plus-circle"></i> QR Code Print
                    </h4>

                    <span class="widget-toolbar">
                        <a href="javascript:void(0)" onclick="print()">
                            <i class="fa fa-print"></i> Print
                        </a>
                    </span>
                    <span class="widget-toolbar">
                        @if (hasPermission('product.qr-generates.index', $slugs))
                            <a href="{{ route('product.qr-generates.index') }}">
                            <i class="ace-icon fa fa-list-alt"></i>
                            List
                        </a>
                        @endif

                    </span>
                </div>

                <div class="widget-body">
                    <div class="widget-main">


                        <div class="row qr_print">

                            @php
                            $xmlString = file_get_contents('php://input');
                            $xmlString = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $xmlString);
                        @endphp
                            @foreach ($qr_codes as $key => $item)

                            <div class="col-md-4 text-center qr_col margin-20 page-break">
                                <div class="qr_width">
                                    <img src="{{ asset('assets/images/gulf_logo.png') }}" alt="" width="20%"><br>
                                    <strong class="font-25"><i>Congratulations!!</i></strong><br>
                                    <i style="padding-bottom: 5px">Registered Mechanics Please<br>
                                        Scan/Send the No. below<br>To <u><b>1 6 3 9</b></u></i><br>
                                        {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate($item->qr_code); !!}<br>

                                        <i>{{ $item->qr_code }}</i><br>
                                        <i style="padding-bottom: 5px">Imported & Marketed by</i><br>
                                    <strong class="font-25">Gulf Oil Bangladesh Ltd.</strong>
                                </div>
                            </div>

                            <p class="page-break"></p>

                            @endforeach


                            <br>
                            <hr>
                            <br>
                            <div id="second_copy" style="width: 100%;overflow: hidden;">
                                <!-- Load First Copy -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

<script>
    window.print()

</script>

@endsection
