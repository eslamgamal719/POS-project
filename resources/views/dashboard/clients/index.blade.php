@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.clients') </h1>

            <ol class="breadcrumb">
                <li><a href="{{route('dashboard.welcome')}}" style="margin-left: 5px;"><li class="fa fa-dashboard"></li>@lang('site.dashboard')</a> </li>
                <li>@lang('site.clients')</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-hover">
                    <h3 class="box-title" style="margin-bottom: 10px;">@lang('site.clients')<small> {{$clients->total()}}</small></h3>

                <form action="{{route('dashboard.clients.index')}}" method="get">

                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" value="{{request()->search}}" placeholder="{{__('site.search')}}"  >
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>@lang('site.search')</button>
                            @if(auth()->user()->hasPermission('create_clients'))
                                <a href="{{route('dashboard.clients.create')}}" class="btn btn-primary"><i class="fa fa-plus"></i>@lang('site.add')</a>
                            @else
                                <button class="btn btn-primary btn-sm disabled">@lang('site.add')</button>
                            @endif
                        </div>
                    </div>
                </form>


                </div>


                <div class="box-body">
                    @if($clients->count() > 0)
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>@lang('site.name')</th>
                                    <th>@lang('site.phone')</th>
                                    <th>@lang('site.address')</th>
                                    <th>@lang('site.add_order')</th>
                                    <th>@lang('site.action')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($clients as $client)
                                        <tr>
                                            <td>{{ $client -> id }}</td>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ implode($client->phone, '-') }}</td>
                                            <td>{{ $client->address }}</td>
                                            <td>

                                                @if(auth()->user()->hasPermission('create_orders'))
                                                    <a href="{{route('dashboard.clients.orders.create', $client->id)}}" class="btn btn-primary btn-sm">@lang('site.add_order')</a>
                                                @else
                                                    <a href="" class="btn btn-primary btn-sm disabled">@lang('site.add_order')</a>

                                                @endif

                                            </td>

                                            <td>{{ $client->address }}</td>
                                            <td>

                                          @if(auth()->user()->hasPermission('update_clients'))
                                                    <a href="{{route('dashboard.clients.edit', $client->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>@lang('site.edit')</a>
                                                @else
                                                    <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>@lang('site.edit')</a>
                                                @endif

                                              @if(auth()->user()->hasPermission('delete_clients'))
                                                  {{--   <a href="{{route('dashboard.clients.destroy', $client->id)}}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>@lang('site.delete')</a> --}}

                                                    <form action="{{route('dashboard.clients.destroy', $client->id)}}" method="post" style="display: inline-block">
                                                              {{csrf_field() }}
                                                              {{method_field('delete') }}
                                                              <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i>@lang('site.delete')</button>
                                                         </form>
                                              @else
                                                  <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>@lang('site.delete')</button>
                                              @endif


                                            </td>

                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>

                        {{$clients->appends(request()->query())->links()}}

                    @else
                         <h2>@lang('site.no_data_found')</h2>
                    @endif
                </div>
            </div>

        </section>
    </div>


@endsection
