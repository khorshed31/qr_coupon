@extends('layouts.master')


@section('title', 'QR Code')

@section('page-header')
    <i class="fa fa-info-circle"></i> QR Code
@stop


@section('content')

    <style>
        .open>.dropdown-menu {
            background-color: aliceblue !important;
        }

    </style>

    <div class="row">
        <div class="col-md-12">


            @include('partials._alert_message')




            <div class="widget-box">


                <!-- header -->
                <div class="widget-header">
                    <h4 class="widget-title"> @yield('page-header')</h4>
                    <span class="widget-toolbar">
                        @if (hasPermission('product.qr-generates.create', $slugs))
                            <a href="{{ route('product.qr-generates.create') }}" class="">
                            <i class="fa fa-plus"></i> Add New
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
                                                        Name <sup class="text-danger">*</sup>
                                                    </span>
                                                    <input type="text" class="form-control" name="name"
                                                           value="{{ request('name') }}" placeholder="Product Name">
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

                                <div class="table-responsive" style="border: 1px #cdd9e8 solid;">

                                    <!-- Table -->
                                    <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Sl</th>
                                            <th>Date</th>
                                            <th>Product Name</th>
                                            <th>Unit Name</th>

                                            <th>Total Quantity </th>
                                            <th class="text-center" width="16%">Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        @forelse ($qr_code_products as $key => $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</td>
                                                <td>{{ optional($item->product)->name }}</td>
                                                <td>{{ optional($item->unit)->name }}</td>
                                                <td>{{ $item->total_quantity }}</td>

                                                <td class="text-center">
                                                    <div class="btn-group btn-corner" style="display: flex">

                                                        <div class="dropdown">
                                                            <button class="btn btn-xs btn-success dropdown-toggle" type="button" data-toggle="dropdown">
                                                                <i class="fa fa-download"></i>
                                                                <span class="caret"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    @if (hasPermission('product.qr.pdf', $slugs))
                                                                        <a href="{{ route('product.qr.pdf', $item->id) }}" target="_blank">
                                                                            <i class="fa fa-file-pdf-o"></i> <strong>(10x10)cm PDF</strong>
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                                <li>
                                                                    @if (hasPermission('product.qr.pdf', $slugs))
                                                                        <a href="{{ route('product.qr.pdf.small', $item->id) }}" target="_blank">
                                                                            <i class="fa fa-file-pdf-o"></i> <strong>(5x5)cm PDF</strong>
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>


                                                        <!-- edit -->
                                                        <div class="dropdown">
                                                            <button class="btn btn-xs btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                                                <i class="fa fa-eye"></i>
                                                                <span class="caret"></span></button>
                                                            <ul class="dropdown-menu">
                                                                <li>
                                                                    @if (hasPermission('product.qr-generates.show', $slugs))
                                                                        <a href="{{ route('product.qr-generates.show', $item->id) }}" title="Show All">
                                                                            <i class="fa fa-eye"></i> <strong>Show All</strong>
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                                <li>
                                                                    @if (hasPermission('product.qr-generates.show', $slugs))
                                                                        <a href="{{ route('product.qr-generates.show', $item->id) }}?status=1" title="Show Used">
                                                                            <i class="fa fa-eye"></i> <strong>Show Used QR</strong>
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </div>

                                                        @if($item->status == 0)
                                                            @if (hasPermission('product.qr.approved', $slugs))
                                                                <button type="button"
                                                                        onclick="approved_item(`{{ route('product.qr.approved', $item->id) }}`)"
                                                                        class="btn btn-xs btn-warning" title="Approved">
                                                                    <i class="fa fa-check"></i>
                                                                </button>
                                                            @endif
                                                        @else
                                                            @if (hasPermission('product.qr.unapproved', $slugs))
                                                                <button type="button"
                                                                        onclick="unapproved_item(`{{ route('product.qr.approved', $item->id) }}`)"
                                                                        class="btn btn-xs btn-danger" title="Unapproved">
                                                                    <i class="fa fa-check"></i>
                                                                </button>
                                                            @endif
                                                        @endif
                                                    <!-- delete -->
                                                        @if($item->status == 0)
                                                            @if (hasPermission('product.qr-generates.delete', $slugs))
                                                                <button type="button"
                                                                        onclick="delete_item(`{{ route('product.qr-generates.destroy', $item->id) }}`)"
                                                                        class="btn btn-xs btn-danger" title="Delete">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            @endif
                                                        @endif


                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="30" class="text-center text-danger py-3"
                                                    style="background: #eaf4fa80 !important; font-size: 18px">
                                                    <strong>No records found!</strong>
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>

                                    @include('partials._paginate', ['data' => $qr_code_products])

                                </div>

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


