@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.edit_order')</h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.welcome')}}" style="margin-left: 5px;"><li class="fa fa-dashboard"></li>@lang('site.dashboard')</a> </li>
                <li><a href="{{route('dashboard.clients.index')}}" style="margin-left: 5px;">@lang('site.clients')</a> </li>
                {{--   <li><a href="{{route('dashboard.orders')}}" style="margin-left: 5px;">@lang('site.orders')</a> </li> --}}
                <li class="active">@lang('site.edit')</li>
            </ol>

        </section>


        <section class="content">

            <div class="row">

                <div class="col-md-6">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title" style="margin-bottom: 10px">@lang('site.categories')</h3>

                        </div><!-- end of box header -->

                        <div class="box-body">

                            @foreach ($categories as $category)

                                <div class="panel-group">

                                    <div class="panel panel-info">

                                        <div class="panel-heading">

                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" href="#{{ str_replace(' ', '-', $category->name) }}">{{ $category->name }}</a>
                                            </h4>
                                        </div>

                                        <div id="{{ str_replace(' ', '-', $category->name) }}" class="panel-collapse collapse">

                                            <div class="panel-body">

                                                @if ($category->products->count() > 0)

                                                    <table class="table table-hover">
                                                        <tr>
                                                            <th>@lang('site.name')</th>
                                                            <th>@lang('site.stock')</th>
                                                            <th>@lang('site.price')</th>
                                                            <th>@lang('site.add')</th>
                                                        </tr>

                                                        @foreach ($category->products as $product)
                                                            <tr>
                                                                <td>{{ $product->name }}</td>
                                                                <td>{{ $product->stock }}</td>
                                                                <td>{{ number_format($product->sale_price, 2) }}</td>
                                                                <td>
                                                                    <a href="#" id="product-{{ $product->id }}" class="{{in_array($product->id, $order->products->pluck('id')->toArray()) ?  'btn btn-default disabled' : 'btn btn-success'}} add-product-btn btn-sm"
                                                                       id="product-{{ $product->id }}"
                                                                       data-name="{{ $product->name }}"
                                                                       data-id="{{ $product->id }}"
                                                                       data-price="{{ $product->sale_price }}"
                                                                    >
                                                                        <i class="fa fa-plus"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach

                                                    </table><!-- end of table -->

                                                @else
                                                    <h5>@lang('site.no_records')</h5>
                                                @endif

                                            </div><!-- end of panel body -->

                                        </div><!-- end of panel collapse -->

                                    </div><!-- end of panel primary -->

                                </div><!-- end of panel group -->

                            @endforeach

                        </div><!-- end of box body -->

                    </div><!-- end of box -->

                </div><!-- end of col -->

                <div class="col-md-6">

                    <div class="box box-primary">

                        <div class="box-header">

                            <h3 class="box-title">@lang('site.orders')</h3>

                        </div><!-- end of box header -->

                        <div class="box-body">

                            <form action="{{ route('dashboard.clients.orders.update',['order' => $order->id, 'client' => $client->id]) }}" method="post">

                                {{ csrf_field() }}
                                {{ method_field('put') }}

                                @include('partials._errors')

                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>@lang('site.product')</th>
                                        <th>@lang('site.quantity')</th>
                                        <th>@lang('site.price')</th>
                                    </tr>
                                    </thead>

                                    <tbody class="order-list">

                                    @foreach($order->products as $product)

                                        <tr>
                                            <td>{{$product->name}}</td>
                                            <td><input type="number"  name="products[{{$product->id}}][quantity]" data-price="{{number_format($product->sale_price, 2)}}" class="form-control input-sm product-quantity" min="1" value="{{$product->pivot->quantity}}"></td>
                                            <td class="product-price">{{number_format($product->sale_price * $product->pivot->quantity, 2)}}</td>
                                            <td>
                                                <button class="btn btn-danger btn-sm remove-product-button" id="add-order-form-btn" data-id="{{$product->id}}"><span class="fa fa-trash"></span></button>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>


                                </table><!-- end of table -->

                                <h4>@lang('site.total') : <span class="total-price">{{$order->total_price}}</span></h4>

                                <button class="btn btn-primary btn-block " id="add-order-form-btn"><i class="fa fa-plus"></i> @lang('site.edit_order')</button>

                            </form>

                        </div><!-- end of box body -->

                    </div><!-- end of box -->









                </div><!-- end of col -->

            </div><!-- end of row -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
