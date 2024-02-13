@extends('layouts.master')


@section('title', 'Customers')

@section('page-header')
    <i class="fa fa-info-circle"></i> Customers <span class="badge badge-info">{{ $customers->total() }}</span>
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
                        @if (hasPermission('product.customers.store', $slugs))
                            <a href="{{ route('product.customers.create') }}" class="">
                                <i class="fa fa-plus"></i> Add New
                            </a>
                        @endif
                    </span>

                    <span class="widget-toolbar">
                        @if (hasPermission('product.customers.store', $slugs))
                            <a href="{{ route('product.customers.create', ['upload' => 'product']) }}" class="">
                                <i class="fa fa-upload"></i> Upload
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
                                                           value="{{ request('name') }}" placeholder="Customer Name">
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
                                            <th>Name</th>
                                            <th>Mobile</th>
                                            <th>Garage Name</th>
                                            <th>Garage Address</th>
                                            <th>Referred By</th>
                                            <th>Balance</th>
                                            <th>Created At </th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        @forelse ($customers as $key => $item)
                                            <tr>
                                                <td>{{ $customers->firstItem() + $key }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->mobile }}</td>
                                                <td>{{ $item->garage_name }}</td>
                                                <td>{{ $item->address }}</td>
                                                <td>{{ $item->refer_code ? optional($item->refer_employee)->name.'('.$item->refer_code.')' : ' -' }}</td>
                                                <td>{{ $item->balance }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-corner">

                                                        <!-- edit -->
                                                        @if (hasPermission('product.customers.update', $slugs))
                                                            <a href="{{ route('product.customers.edit', $item->id) }}"
                                                               role="button" class="btn btn-xs btn-success" title="Edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>
                                                        @endif

                                                        <!-- delete -->
                                                        @if (hasPermission('product.customers.delete', $slugs))
                                                            <button type="button"
                                                                    onclick="delete_item(`{{ route('product.customers.destroy', $item->id) }}`)"
                                                                    class="btn btn-xs btn-danger" title="Delete">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
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

                                    @include('partials._paginate', ['data' => $customers])

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


