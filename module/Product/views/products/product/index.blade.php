@extends('layouts.master')


@section('title', 'Products')

@section('page-header')
    <i class="fa fa-info-circle"></i> Products <span class="badge badge-info">{{ $products->total() }}</span>
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
                        @if (hasPermission('product.products.create', $slugs))
                            <a href="{{ route('product.products.create') }}" class="">
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
{{--                                            <td>--}}
{{--                                                <input type="text" name="barcode" value="{{ request('barcode') }}"--}}
{{--                                                       class="form-control input-sm" placeholder="Product Barcode">--}}
{{--                                            </td>--}}

{{--                                            <td>--}}
{{--                                                @php--}}
{{--                                                    $status = ['0' => 'Inactive', '1' => 'Active'];--}}
{{--                                                @endphp--}}
{{--                                                <select name="status" class="chosen-select form-control"--}}
{{--                                                        data-placeholder="-Select Status-">--}}
{{--                                                    <option value=""></option>--}}

{{--                                                    @foreach ($status as $key => $item)--}}
{{--                                                        <option value="{{ $key }}">--}}
{{--                                                            {{ $item }}--}}
{{--                                                        </option>--}}
{{--                                                    @endforeach--}}
{{--                                                </select>--}}
{{--                                            </td>--}}

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
                                            <th>Image</th>

                                            <th>Created At </th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        @forelse ($products as $key => $item)
                                            <tr>
                                                <td>{{ $products->firstItem() + $key }}</td>
                                                <td>{{ $item->name }}</td>
                                                <td>
                                                    @if (file_exists($item->image))
                                                        <img src="{{ asset($item->image) }}" width="100" height="100"
                                                             alt="{{ $item->name }}">
                                                    @endif
                                                </td>

                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group btn-corner">

                                                    <!-- edit -->
                                                        @if (hasPermission('product.products.edit', $slugs))
                                                            <a href="{{ route('product.products.edit', $item->id) }}"
                                                                   role="button" class="btn btn-xs btn-success" title="Edit">
                                                                <i class="fa fa-pencil-square-o"></i>
                                                            </a>
                                                        @endif
                                                    <!-- delete -->
                                                        @if (hasPermission('product.products.delete', $slugs))
                                                            <button type="button"
                                                                    onclick="delete_item(`{{ route('product.products.destroy', $item->id) }}`)"
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

                                    @include('partials._paginate', ['data' => $products])

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

