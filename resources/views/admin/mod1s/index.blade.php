@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.mod1.title')</h3>
    @can('mod1_create')
    <p>
        <a href="{{ route('admin.mod1s.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
        @if(!is_null(Auth::getUser()->role_id) && config('quickadmin.can_see_all_records_role_id') == Auth::getUser()->role_id)
            @if(Session::get('Mod1.filter', 'all') == 'my')
                <a href="?filter=all" class="btn btn-default">Show all records</a>
            @else
                <a href="?filter=my" class="btn btn-default">Filter my records</a>
            @endif
        @endif
    </p>
    @endcan

    @can('mod1_delete')
    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.mod1s.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('quickadmin.qa_all')</a></li> |
            <li><a href="{{ route('admin.mod1s.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('quickadmin.qa_trash')</a></li>
        </ul>
    </p>
    @endcan


    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($mod1s) > 0 ? 'datatable' : '' }} @can('mod1_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('mod1_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('quickadmin.mod1.fields.mod1vr1')</th>
                        <th>@lang('quickadmin.mod1.fields.mod1opm1')</th>
                        <th>@lang('quickadmin.mod1.fields.mod1vr2')</th>
                        <th>@lang('quickadmin.mod1.fields.mod1opm2')</th>
                        <th>@lang('quickadmin.mod1.fields.created-by')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($mod1s) > 0)
                        @foreach ($mod1s as $mod1)
                            <tr data-entry-id="{{ $mod1->id }}">
                                @can('mod1_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='mod1vr1'>{{ $mod1->mod1vr1 }}</td>
                                <td field-key='mod1opm1'>{{ $mod1->mod1opm1 }}</td>
                                <td field-key='mod1vr2'>{{ $mod1->mod1vr2 }}</td>
                                <td field-key='mod1opm2'>{{ $mod1->mod1opm2 }}</td>
                                <td field-key='created_by'>{{ $mod1->created_by->name or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('mod1_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.mod1s.restore', $mod1->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('mod1_delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.mod1s.perma_del', $mod1->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('mod1_view')
                                    <a href="{{ route('admin.mod1s.show',[$mod1->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('mod1_edit')
                                    <a href="{{ route('admin.mod1s.edit',[$mod1->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('mod1_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['admin.mod1s.destroy', $mod1->id])) !!}
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
        @can('mod1_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.mod1s.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection