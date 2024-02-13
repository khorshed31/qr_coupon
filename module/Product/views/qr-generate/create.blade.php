@extends('layouts.master')

@section('title', 'QR Code Generate')

@section('page-header')
    <i class="fa fa-qrcode"></i> QR Code Generate
@stop



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
                            <a href="{{ route('product.qr-generates.index') }}"
                               class="">
                            <i class="fa fa-list-alt"></i> List
                        </a>
                        @endif

                    </span>
                </div>



                <!-- body -->
                <div class="widget-body">
                    <div class="widget-main">

                        <form method="POST" action="{{ route('product.qr-generates.store') }}" class="form-horizontal"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row mt-3" style="background: #c9c9c9;padding: 15px 10px 2px 10px;border-bottom: 4px solid #898989;">

                                <!-- Right Side -->
                                <div class="col-sm-5 col-sm-offset-1">




                                    <!-- Name -->
                                    <div class="input-group" style="margin-bottom: 15px;">
                                        <span class="input-group-addon" style="padding-right: 50px">
                                            Product Name <sup class="text-danger">*</sup>
                                        </span>
                                        <select name="product_id" id="" class="form-control chosen-select"
                                                data-placeholder="-- Select Product --" required>
                                            <option value=""></option>
                                            @foreach($products as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @error('product_id')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror


                                </div>

                                <!-- Left Side -->
                                <div class="col-sm-5">


                                    <div class="input-group" style="margin-bottom: 15px;">
                                        <span class="input-group-addon" style="padding-right: 50px">
                                            Unit <sup class="text-danger">*</sup>
                                        </span>
                                        <select name="unit_id" id="" class="form-control chosen-select"
                                                data-placeholder="-- Select Unit --" required>
                                            <option value=""></option>
                                            @foreach($units as $key => $item)
                                                <option value="{{ $key }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @error('product_id')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                            </div>


                            <div class="col-md-10 col-md-offset-1" style="margin-top: 15px">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="documentTable">
                                        <thead>
                                        <tr>
                                            <th><i class="fa fa-trophy"></i> Prize Amount</th>
                                            <th><i class="fa fa-th-list"></i> QR Quantity</th>
                                            <th><i class="ace-icon far fa-times-circle bigger-150"></i></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th>
                                                <input type="number" class="form-control" name="prize_amounts[]"
                                                       value="{{ old('prize_amount') }}" placeholder="Enter Amount">

                                                @error('prize_amount')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                                @enderror

                                            </th>
                                            <th>
                                                <input type="number" class="form-control" name="quantity[]"
                                                       value="{{ old('quantity') }}" placeholder="Enter Quantity">

                                                @error('quantity')
                                                <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                                @enderror
                                            </th>



                                            <th>
{{--                                                <button type="button" class="remove-row" title="Remove"--}}
{{--                                                        disabled=""><i class="far fa-times-circle fa-lg"></i></button>--}}
                                                <a href="javascript:void(0)" class="text-danger" disabled="disabled">
                                                    <i class="ace-icon far fa-times-circle bigger-150"></i>
                                                </a>
                                            </th>

                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="9" class="text-center">
                                                <a href="javascript:void(0)" type="button"
                                                   class="btn btn-xs btn-block btn-secondary" style="color: #050981 !important"
                                                   id="addrow">
                                                    <i class="fa fa-plus-circle"></i> <strong>ADD MORE</strong>
                                                </a>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <!-- Action -->
                            <div class="form-group">
                                <div class="text-center col-md-2 col-md-offset-10 mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Generate
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('js')


    <script src="{{ asset('assets/custom_js/file_upload.js') }}"></script>

    <script>


        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".ace-file-upload").change(function() {
            readURL(this);
        });
    </script>


    <script>
        $(document).ready(function() {

            const rowItem = `<tr>
                                <th>
                                    <input type="number" class="form-control" name="prize_amounts[]"
                                        value="{{ old('prize_amount') }}" placeholder="Enter Amount">

                                    @error('prize_amount')
                                    <span class="text-danger">
                                        {{ $message }}
                                    </span>
                                    @enderror

                                </th>
                                <th>
                                    <input type="number" class="form-control" name="quantity[]"
                                        value="{{ old('quantity') }}" placeholder="Enter Quantity">

                                        @error('quantity')
                                            <span class="text-danger">
                                            {{ $message }}
                                            </span>
                                        @enderror
                                </th>

                                <th>
                                     <a href="javascript:void(0)" class="text-danger remove-row">
                                                    <i class="ace-icon far fa-times-circle bigger-150"></i>
                                </th>

                            </tr>`;
            let i = 0

            $("#addrow").on("click", function() {
                $("#documentTable").append(rowItem);
                $('.select2').select2();
                i++
            });

            $("#documentTable").on("click", ".remove-row", function(event) {
                $(this).closest("tr").remove();
                $('.select2').select2();
                i--
            });
        });
    </script>
@endsection

