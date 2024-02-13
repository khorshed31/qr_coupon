@extends('layouts.master')

@section('title', 'Add Customer')

@section('page-header')
    <i class="fa fa-plus-circle"></i> Add Customer
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
                         @if (hasPermission('product.customers.index', $slugs))
                            <a href="{{ route('product.customers.index') }}" class="">
                                <i class="fa fa-list-alt"></i> Customer List
                            </a>
                        @endif
                    </span>
                </div>



                <!-- body -->
                <div class="widget-body">
                    <div class="widget-main">

                        <form method="POST" action="{{ route('product.customers.update', $customer->id) }}" class="form-horizontal"
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
                                               value="{{ $customer->name }}" placeholder="Name" required />
                                    </div>
                                </div>





                                <!-- Mobile -->
                                <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-3" for="mobile">
                                        Mobile<sup class="text-danger">*</sup> :
                                    </label>
                                    <div class="col-md-5 col-sm-5">
                                        <input class="form-control only-number" type="text" name="mobile"
                                               value="{{ $customer->mobile }}" placeholder="Enter Mobile" required />
                                    </div>
                                </div>





                                <!-- Garage Address -->
                                <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-3">Garage Name
                                        :</label>
                                    <div class="col-md-5 col-sm-5">
                                        <input class="form-control" type="text" value="{{ $customer->garage_name }}" name="garage_name"
                                               placeholder="Type Garage Name"/>
                                    </div>
                                </div>




                                <!-- Address -->
                                <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-3">Garage Address
                                        :</label>
                                    <div class="col-md-5 col-sm-5">
                                        <input class="form-control" type="text" name="garage_address" value="{{ $customer->address }}"
                                               placeholder="Type Address" required />
                                    </div>
                                </div>





                                <!-- Referred By -->
                                <div class="form-group">
                                    <label class="control-label col-sm-3 col-sm-3">Referred By
                                        :</label>
                                    <div class="col-md-5 col-sm-5">
                                        <select name="refer_code" id="" class="form-control chosen-select"
                                                data-placeholder="--Select Referred By--">
                                            <option value=""></option>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->code }}" {{ $employee->code == $customer->refer_code ? 'selected' : '' }}>
                                                    {{ $employee->name }} ({{ $employee->code }})
                                                </option>
                                            @endforeach
                                        </select>
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


@endsection

