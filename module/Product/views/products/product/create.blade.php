@extends('layouts.master')

@section('title', 'Add Product')

@section('page-header')
    <i class="fa fa-plus-circle"></i> Add Product
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
                        @if (hasPermission('product.products.index', $slugs))
                            <a href="{{ route('product.products.index') }}"
                               class="">
                            <i class="fa fa-list-alt"></i> Product List
                        </a>
                        @endif

                    </span>
                </div>



                <!-- body -->
                <div class="widget-body">
                    <div class="widget-main">

                        <form method="POST" action="{{ route('product.products.store') }}" class="form-horizontal"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row mt-3">

                                <!-- Right Side -->
                                <div class="col-sm-5 col-sm-offset-1">





                                    <!-- Name -->
                                    <div class="input-group" style="margin-bottom: 15px;">
                                        <span class="input-group-addon" style="padding-right: 50px">
                                            Name <sup class="text-danger">*</sup>
                                        </span>
                                        <input type="text" class="form-control" name="name" required
                                               value="{{ old('name') }}" placeholder="Product Name">
                                    </div>

                                    @error('name')
                                        <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror




                                    <!-- Image -->
                                    <div class="input-group" style="margin-bottom: 15px;">
                                        <span class="input-group-addon" style="padding-right: 50px">
                                            Image
                                        </span>
                                        <input type="file" name="image" class="ace-file-upload" onchange="readURL(this)" />
                                    </div>
                                    @error('image')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror






                                </div>

                                <!-- Left Side -->
                                <div class="col-sm-6">






                                    <!-- Image -->
                                    <div class="input-group">
                                        <label class="control-label col-sm-3 col-sm-3">Preview Image :</label>
                                        <div class="col-md-9 col-sm-9">
                                            <img class="img-thumbnail" id="blah" width="220" src="{{ asset('assets/images/default.png') }}">
                                        </div>
                                    </div>





                                </div>

                            </div>

                            <!-- Action -->
                            <div class="form-group">
                                <div class="text-center col-md-2 col-md-offset-10 mt-3">
                                    <button type="submit" class="btn btn-primary">
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
@endsection
