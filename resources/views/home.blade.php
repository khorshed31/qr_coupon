@extends('layouts.master')
@section('css')
    <style>
        .infobox {
            /* height: fit-content !important; */
            height: 100px !important;
            /* width: fit-content !important; */
            display: inline-block;
            vertical-align: top;
            width: 60px;
            border: 3px solid !important;
            background: antiquewhite !important;
             /*padding: 15px;*/
        }

        .infobox-small {
            width: 100% !important;
        }

    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">



            <div class="widget-box">

                <!-- body -->
                <div class="widget-body">
                    <div class="widget-main">

                        <div class="row">
                            <div class="space-6"></div>
                            <div class="col-sm-12">
{{--                                <img src="{{ asset('assets/qr.gif') }}" alt="" width="13%">--}}
                                <div class="infobox infobox-green">
                                    <div class="infobox-icon infobox-dark">
                                        <i class="ace-icon fa fa-shopping-cart"></i>
                                    </div>

                                    <div class="infobox-data">
                                        <div class="infobox-content">TOTAL PRODUCT</div>
                                        <span class="infobox-data-number">{{ $total_products }}</span>
                                    </div>


                                </div>


                                <div class="infobox infobox-green">
                                    <div class="infobox-icon infobox-dark">
                                        <i class="ace-icon fa fa-users"></i>
                                    </div>

                                    <div class="infobox-data">
                                        <div class="infobox-content">TOTAL USERS</div>
                                        <span class="infobox-data-number">{{ $total_users }}</span>
                                    </div>


                                </div>


                                <div class="infobox infobox-green">
                                    <div class="infobox-icon infobox-dark">
                                        <i class="ace-icon fa fa-users"></i>
                                    </div>

                                    <div class="infobox-data">
                                        <div class="infobox-content">TOTAL CUSTOMERS</div>
                                        <span class="infobox-data-number">{{ $total_customers }}</span>
                                    </div>


                                </div>


                            </div>
                        </div>



                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <div class="widget-box transparent">
                                    <div class="widget-header">

                                </div><!-- /.widget-box -->
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>

@endsection
