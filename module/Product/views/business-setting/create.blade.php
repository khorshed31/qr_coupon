@extends('layouts.master')

@section('title', 'Business Setting')

@section('page-header')
    <i class="fa fa-plus-circle"></i> Business Setting
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

                    </span>
                </div>



                <!-- body -->
                <div class="widget-body">
                    <div class="widget-main">

                        <form method="POST" action="{{ route('product.business-settings.store') }}" class="form-horizontal"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="row mt-3">

                                <!-- Right Side -->
                                <div class="col-sm-5 col-sm-offset-1">





                                    <!-- Name -->
                                    <div class="from-group" style="margin-bottom: 50px">
                                        <label class="col-md-2">
                                            Name
                                        </label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name" required
                                                   value="{{ optional(businessInfo())->name }}" placeholder="User Name">
                                        </div>
                                    </div>

                                    @error('name')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror


                                <!-- Email -->
                                    <div class="from-group" style="margin-bottom: 100px">
                                        <label class="col-md-2">
                                            Email
                                        </label>
                                        <div class="col-md-10">
                                            <input type="email" class="form-control" name="email"
                                                   value="{{ optional(businessInfo())->email }}" placeholder="User Email">
                                        </div>
                                    </div>

                                    @error('email')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror


                                <!-- Mobile -->
                                    <div class="from-group" style="margin-bottom: 150px;">
                                        <label class="col-md-2">
                                            Mobile
                                        </label>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" name="mobile"
                                                   value="{{ optional(businessInfo())->mobile }}" placeholder="User Mobile">
                                        </div>
                                    </div>

                                    @error('email')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror


                                <!-- Code -->
                                    <div class="from-group" style="margin-bottom: 200px;">
                                        <label class="col-md-2">
                                            Code
                                        </label>
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" name="code"
                                                   value="{{ optional(businessInfo())->code }}" placeholder="User Code">
                                        </div>

                                    </div>

                                    @error('code')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror


                                <!-- Code -->
                                    <div class="from-group" style="margin-bottom: 265px;">
                                        <label class="col-md-2">
                                            Address
                                        </label>
                                        <div class="col-md-10">
                                            <textarea class="form-control" name="address">{{ optional(businessInfo())->address }}</textarea>
                                        </div>

                                    </div>

                                    @error('code')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror





                                <!-- Logo -->
                                    <div class="from-group" style="margin-bottom: 300px;">
                                        <label class="col-md-2">
                                            Logo
                                        </label>
                                        <div class="col-md-10">
                                            <input type="file" name="image" class="ace-file-upload user_logo" onchange="readURLLogo(this)" />
                                        </div>

                                    </div>
                                    @error('image')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror



                                <!-- Icon -->
                                    <div class="from-group" style="margin-bottom: 350px;">
                                        <label class="col-md-2">
                                            Favicon
                                        </label>
                                        <div class="col-md-10">
                                            <input type="file" name="icon" class="ace-file-upload user_icon" onchange="readURLIcon(this)" />
                                        </div>
                                    </div>
                                    @error('icon')
                                    <span class="text-danger">
                                            {{ $message }}
                                        </span>
                                    @enderror

                                </div>

                                <!-- Left Side -->
                                <div class="col-sm-6">






                                    <!-- Logo -->
                                    <div class="input-group">
                                        <label class="control-label col-sm-3 col-sm-3">Preview Logo :</label>
                                        <div class="col-md-9 col-sm-9">
                                            <img class="img-thumbnail" id="blah" width="220" src="{{ asset(optional(businessInfo())->logo) }}" alt="{{ optional(businessInfo())->name }}">
                                        </div>
                                    </div>

                                    <!-- Icon -->
                                    <div class="input-group">
                                        <label class="control-label col-sm-3 col-sm-3">Preview Icon :</label>
                                        <div class="col-md-9 col-sm-9">
                                            <img class="img-thumbnail" id="blah1" width="220" src="{{ asset(optional(businessInfo())->icon) }}" alt="{{ optional(businessInfo())->name }}">
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


        function readURLLogo(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURLIcon(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah1').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".user_icon").change(function() {
            readURLIcon(this);
        });
        $(".user_logo").change(function() {
            readURLLogo(this);
        });
    </script>
@endsection

