@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.relatiemanager.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.relatiemanager.fields.voornaam')</th>
                            <td field-key='voornaam'>{{ $relatiemanager->voornaam }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.relatiemanager.fields.achternaam')</th>
                            <td field-key='achternaam'>{{ $relatiemanager->achternaam }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.relatiemanager.fields.email')</th>
                            <td field-key='email'>{{ $relatiemanager->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.relatiemanager.fields.geslacht')</th>
                            <td field-key='geslacht'>{{ $relatiemanager->geslacht }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#bedrijf" aria-controls="bedrijf" role="tab" data-toggle="tab">Bedrijfsnaam of familienaam</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="bedrijf">
<table class="table table-bordered table-striped {{ count($bedrijfs) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.bedrijf.fields.bedrijfsnaam')</th>
                        <th>@lang('quickadmin.bedrijf.fields.achternaam')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($bedrijfs) > 0)
            @foreach ($bedrijfs as $bedrijf)
                <tr data-entry-id="{{ $bedrijf->id }}">
                    <td field-key='bedrijfsnaam'>{{ $bedrijf->bedrijfsnaam }}</td>
                                <td field-key='achternaam'>{{ $bedrijf->achternaam->achternaam or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['bedrijfs.restore', $bedrijf->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['bedrijfs.perma_del', $bedrijf->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('bedrijfs.show',[$bedrijf->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('bedrijfs.edit',[$bedrijf->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['bedrijfs.destroy', $bedrijf->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.relatiemanagers.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
