@extends('layouts.master')

@section('title', 'Add Referral Employee')

@section('page-header')
    <i class="fa fa-plus-circle"></i> Add Referral Employee
@stop


@section('css')

    <style>
        .rotate {
            transition: width 2s, height 2s, transform 2s;
        }

        .rotate:hover {

            transform: rotate(360deg);
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
                         @if (hasPermission('product.referral_employees.index', $slugs))
                            <a href="{{ route('product.referral_employees.index') }}" class="">
                                <i class="fa fa-list-alt"></i> Referral Employee List
                            </a>
                        @endif
                    </span>
                </div>



                <!-- body -->
                <div class="widget-body">
                    <div class="widget-main">

                        <form method="POST" action="{{ route('product.referral_employees.store') }}" class="form-horizontal"
                                  enctype="multipart/form-data">
                            @csrf


                            <!-- Name -->
                                <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-3">
                                        Name<sup class="text-danger">*</sup> :
                                    </label>
                                    <div class="col-md-5 col-sm-5">
                                        <input class="form-control" type="text" name="name" autocomplete="off"
                                               value="{{ old('name') }}" placeholder="Name" required />
                                    </div>
                                </div>





                                <!-- Mobile -->
                                <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-3" for="mobile">
                                        Mobile<sup class="text-danger">*</sup> :
                                    </label>
                                    <div class="col-md-5 col-sm-5">
                                        <input class="form-control only-number" type="text" name="mobile"
                                               value="{{ old('mobile') }}" placeholder="Enter Mobile" required />
                                    </div>
                                </div>




                                <!-- Garage Name -->
                                <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-3">Code<sup class="text-danger">*</sup>
                                        :</label>
                                    <div class="col-md-5 col-sm-5">
                                        <div class="input-group">
                                            <input type="text" id="code" class="form-control" name="code"
                                                   value="{{ old('code') }}" placeholder="Enter Code" readonly required>
                                            <span class="input-group-addon" id="code_generate" title="Generate Code">
                                                <i class="fa fa-gear rotate"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>





                            <!-- Action -->
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4"></label>
                                    <div class="col-md-3 col-sm-3">
                                        <button type="submit" class="btn btn-primary col-md-12">
                                            <i class="fa fa-plus"></i> Add New
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

    <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="{{ asset('assets/custom_js/file_upload.js') }}"></script>


    <script>

        function code_generate(length) {
            var result = '';
            var characters = '0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }

            return result;
        }
        $('#code_generate').on('click', function() {
            $('#code').val(code_generate(4));
        })


    </script>

@endsection

