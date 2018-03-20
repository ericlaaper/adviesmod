@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.bedrijf.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.bedrijf.fields.bedrijfsnaam')</th>
                            <td field-key='bedrijfsnaam'>{{ $bedrijf->bedrijfsnaam }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.bedrijf.fields.achternaam')</th>
                            <td field-key='achternaam'>{{ $bedrijf->achternaam->achternaam or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.relatiemanager.fields.voornaam')</th>
                            <td field-key='voornaam'>{{ isset($bedrijf->achternaam) ? $bedrijf->achternaam->voornaam : '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#klanten" aria-controls="klanten" role="tab" data-toggle="tab">Klanten</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="klanten">
<table class="table table-bordered table-striped {{ count($klantens) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
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
                    <td field-key='voornaam'>{{ $klanten->voornaam }}</td>
                                <td field-key='achternaam'>{{ $klanten->achternaam }}</td>
                                <td field-key='email'>{{ $klanten->email }}</td>
                                <td field-key='password'>{{ $klanten->password }}</td>
                                <td field-key='naam'>{{ $klanten->naam->bedrijfsnaam or '' }}</td>
                                <td field-key='geslacht'>{{ $klanten->geslacht }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['klantens.restore', $klanten->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                    @can('delete')
                                                                        {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['klantens.perma_del', $klanten->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                @endcan
                                </td>
                                @else
                                <td>
                                    @can('view')
                                    <a href="{{ route('klantens.show',[$klanten->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('edit')
                                    <a href="{{ route('klantens.edit',[$klanten->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['klantens.destroy', $klanten->id])) !!}
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

            <p>&nbsp;</p>

            <a href="{{ route('admin.bedrijfs.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
