<!doctype html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>QR Code(5x5)</title>

    {{-- <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" /> --}}
</head>


<style>
    body {
        font-family: 'Helvetica Neue, Helvetica, Arial,sans-serif, nikosh';
        font-size: 80.25%;
    }


    @page {
        -webkit-transform: rotate(-90deg);
        -moz-transform: rotate(-90deg);
        filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
        header: page-header;

    }

    .font-10{

        font-size: 10px !important;
    }

    .font-9{

        font-size: 9px !important;
    }

    .margin-20{
        margin-bottom: 20px !important;
    }


    .qr_width{
        width: 5cm;
        height: 4cm;
        color: #1f1e1e;
        border: 0.5px solid #b1b1b1;
        padding: 10px;
    }

    .qr_col{

        width: 20% !important;
        text-align: center;
    }

    /** {*/
    /*    box-sizing: border-box;*/
    /*}*/

    .column {
        float: left;
        width: 21%;
        padding: 10px;
        /* Should be removed. Only for demonstration */
    }

    /* Clear floats after the columns */
    .row:after {
        content: "";
        display: table;
        clear: both;
    }

</style>

<body>


<div class="row">

    @foreach ($qr_codes as $key => $item)
        @php
            $qrcode = SimpleSoftwareIO\QrCode\Facades\QrCode::size(80)->generate($item->qr_code);
            $qrcode = str_replace('<?xml version="1.0" encoding="UTF-8"?>', '', $qrcode);
        @endphp
        <div class="column">
            <div class="qr_width qr_col">

                <img src="assets/images/gulf_logo.webp" alt="" width="15%"><br>
                <strong class="font-10"><i>Congratulations!!</i></strong><br>
                <i class="font-9"><b>{{ _('Please scan below') }}</b></i><br>
                {!! $qrcode !!}<br>
                <i class="font-9"><b style="color: black">{{ _('Imported & Marketed by') }}</b></i><br>
                <strong class="font-10">Gulf Oil Bangladesh Ltd.</strong>
            </div>
        </div>
{{--        <div class="column">--}}
{{--            <div class="qr_width qr_col">--}}
{{--                <img src="assets/images/gulf_logo.webp" alt="" width="20%"><br>--}}
{{--                <strong class="font-25"><i>Congratulations!!</i></strong><br>--}}
{{--                <i style="padding-bottom: 5px">Please scan below</i>--}}
{{--                    Scan/Send the No. below<br>To <u><b>{{ optional(businessInfo())->code }}</b></u></i><br>--}}
{{--                {!! $qrcode !!}<br>--}}
{{--                <i><b>{{ $item->qr_code }}</b></i><br>--}}
{{--                <i style="padding-bottom: 5px">Imported & Marketed by</i><br>--}}
{{--                <strong class="font-25">Gulf Oil Bangladesh Ltd.</strong>--}}
{{--            </div>--}}
{{--        </div>--}}

    @endforeach


    <br>
    <hr>
    <br>
    <div id="second_copy" style="width: 100%;overflow: hidden;">

    </div>
</div>



<htmlpagefooter name="page-footer">
    <div align="right" style="font-size: 12px;">
        <hr>
        <i><b>{PAGENO} / {nbpg}</b></i>
    </div>
</htmlpagefooter>
</body>

</html>

