@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.relatiemanager.title')</h3>
    @can('relatiemanager_create')
    <p>
        <a href="{{ route('admin.relatiemanagers.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('relatiemanager_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.relatiemanagers.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.relatiemanagers.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($relatiemanagers) > 0 ? 'datatable' : '' }} @can('relatiemanager_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('relatiemanager_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.relatiemanager.fields.voornaam')</th>
                        <th>@lang('quickadmin.relatiemanager.fields.achternaam')</th>
                        <th>@lang('quickadmin.relatiemanager.fields.email')</th>
                        <th>@lang('quickadmin.relatiemanager.fields.geslacht')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($relatiemanagers) > 0)
                        @foreach ($relatiemanagers as $relatiemanager)
                            <tr data-entry-id="{{ $relatiemanager->id }}">
                                @can('relatiemanager_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='voornaam'>{{ $relatiemanager->voornaam }}</td>
                                <td field-key='achternaam'>{{ $relatiemanager->achternaam }}</td>
                                <td field-key='email'>{{ $relatiemanager->email }}</td>
                                <td field-key='geslacht'>{{ $relatiemanager->geslacht }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('relatiemanager_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.relatiemanagers.restore', $relatiemanager->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('relatiemanager_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.relatiemanagers.perma_del', $relatiemanager->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('relatiemanager_view')
                                    <a href="{{ route('admin.relatiemanagers.show',[$relatiemanager->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('relatiemanager_edit')
                                    <a href="{{ route('admin.relatiemanagers.edit',[$relatiemanager->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('relatiemanager_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.relatiemanagers.destroy', $relatiemanager->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('relatiemanager_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.relatiemanagers.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection