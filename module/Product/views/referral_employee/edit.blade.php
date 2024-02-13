@extends('layouts.master')

@section('title', 'Edit Referral Employee')

@section('page-header')
    <i class="fa fa-plus-circle"></i> Edit Referral Employee
@stop


@section('css')



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
                                <i class="fa fa-list-alt"></i> Referral Employee Edit
                            </a>
                        @endif
                    </span>
                </div>



                <!-- body -->
                <div class="widget-body">
                    <div class="widget-main">

                        <form method="POST" action="{{ route('product.referral_employees.update', $employee->id) }}" class="form-horizontal"
                              enctype="multipart/form-data">
                        @csrf
                            @method('PUT')


                        <!-- Name -->
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-sm-3">
                                    Name<sup class="text-danger">*</sup> :
                                </label>
                                <div class="col-md-5 col-sm-5">
                                    <input class="form-control" type="text" name="name" autocomplete="off"
                                           value="{{ $employee->name }}" placeholder="Name" required />
                                </div>
                            </div>





                            <!-- Mobile -->
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-sm-3" for="mobile">
                                    Mobile<sup class="text-danger">*</sup> :
                                </label>
                                <div class="col-md-5 col-sm-5">
                                    <input class="form-control only-number" type="text" name="mobile"
                                           value="{{ $employee->mobile }}" placeholder="Enter Mobile" required />
                                </div>
                            </div>




                            <!-- Garage Name -->
                            <div class="form-group">
                                <label class="control-label col-sm-3 col-sm-3">Code<sup class="text-danger">*</sup>
                                    :</label>
                                <div class="col-md-5 col-sm-5">
                                    <input type="text" id="code" class="form-control" name="code"
                                           value="{{ $employee->code }}" placeholder="Enter Code" readonly required>
                                </div>
                            </div>





                            <!-- Action -->
                            <div class="form-group">
                                <label class="control-label col-md-4 col-sm-4"></label>
                                <div class="col-md-3 col-sm-3">
                                    <button type="submit" class="btn btn-primary col-md-12">
                                        <i class="fa fa-plus"></i> Update
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


    </script>

@endsection


