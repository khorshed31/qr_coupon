@extends('layouts.master')


@section('title', 'Withdraw Request List')

@section('page-header')
    <i class="fa fa-info-circle"></i> Withdraw Request List
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">


            @include('partials._alert_message')




            <div class="widget-box">


                <!-- header -->
                <div class="widget-header">
                    <h4 class="widget-title"> @yield('page-header')</h4>
{{--                    <span class="widget-toolbar">--}}
{{--                        @if (hasPermission('product.customers.create', $slugs))--}}
{{--                            <a href="{{ route('product.customers.create') }}" class="">--}}
{{--                                <i class="fa fa-plus"></i> Add New--}}
{{--                            </a>--}}
{{--                        @endif--}}
{{--                    </span>--}}

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
                                            <th>Customer Name</th>
                                            <th>Mobile No</th>
                                            <th>Amount</th>
                                            <th>Transaction ID</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        @forelse ($withdraws as $key => $item)
                                            <tr>
                                                <td>{{ $withdraws->firstItem() + $key }}</td>
                                                <td>{{ optional($item->customer)->name }}</td>
                                                <td>{{ $item->mobile }}</td>
                                                <td>{{ $item->amount }}</td>
                                                <td>{{ $item->transaction_id }}</td>
                                                <td>
                                                    <span class="badge {{ $item->status == 1 ? 'badge-success' : 'badge-warning' }}">
                                                        {{ $item->status == 1 ? 'Success' : 'Pending' }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-corner">

                                                        <!-- edit -->
                                                        @if (hasPermission('product.withdraw_requests.edit', $slugs))
                                                            <a href="{{ route('product.withdraw_requests.edit', $item->id) }}"
                                                               role="button" class="btn btn-xs {{ $item->request_status == 1 ? 'btn-warning disabled' : 'btn-success' }}" title="Approved">
                                                                <i class="{{ $item->request_status == 1 ? 'ace-icon far fa-times-circle' : 'fa fa-check' }}"></i>
                                                            </a>
                                                        @endif

{{--                                                    <!-- delete -->--}}
{{--                                                        @if (hasPermission('product.customers.delete', $slugs))--}}
{{--                                                            <button type="button"--}}
{{--                                                                    onclick="delete_item(`{{ route('product.customers.destroy', $item->id) }}`)"--}}
{{--                                                                    class="btn btn-xs btn-danger" title="Delete">--}}
{{--                                                                <i class="fa fa-trash"></i>--}}
{{--                                                            </button>--}}
{{--                                                        @endif--}}
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

                                    @include('partials._paginate', ['data' => $withdraws])

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



