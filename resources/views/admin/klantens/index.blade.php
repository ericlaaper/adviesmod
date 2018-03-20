@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.klanten.title')</h3>
    @can('klanten_create')
    <p>
        <a href="{{ route('admin.klantens.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    @can('klanten_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.klantens.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.klantens.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($klantens) > 0 ? 'datatable' : '' }} @can('klanten_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('klanten_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.klanten.fields.voornaam')</th>
                        <th>@lang('quickadmin.klanten.fields.achternaam')</th>
                        <th>@lang('quickadmin.klanten.fields.email')</th>
                        <th>@lang('quickadmin.klanten.fields.password')</th>
                        <th>@lang('quickadmin.klanten.fields.naam')</th>
                        <th>@lang('quickadmin.klanten.fields.geslacht')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($klantens) > 0)
                        @foreach ($klantens as $klanten)
                            <tr data-entry-id="{{ $klanten->id }}">
                                @can('klanten_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='voornaam'>{{ $klanten->voornaam }}</td>
                                <td field-key='achternaam'>{{ $klanten->achternaam }}</td>
                                <td field-key='email'>{{ $klanten->email }}</td>
                                <td field-key='password'>{{ $klanten->password }}</td>
                                <td field-key='naam'>{{ $klanten->naam->bedrijfsnaam or '' }}</td>
                                <td field-key='geslacht'>{{ $klanten->geslacht }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('klanten_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.klantens.restore', $klanten->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('klanten_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.klantens.perma_del', $klanten->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('klanten_view')
                                    <a href="{{ route('admin.klantens.show',[$klanten->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('klanten_edit')
                                    <a href="{{ route('admin.klantens.edit',[$klanten->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('klanten_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.klantens.destroy', $klanten->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="11">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('klanten_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.klantens.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection