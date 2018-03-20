@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.mod1.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.mod1.fields.mod1vr1')</th>
                            <td field-key='mod1vr1'>{{ $mod1->mod1vr1 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.mod1.fields.mod1opm1')</th>
                            <td field-key='mod1opm1'>{{ $mod1->mod1opm1 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.mod1.fields.mod1vr2')</th>
                            <td field-key='mod1vr2'>{{ $mod1->mod1vr2 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.mod1.fields.mod1opm2')</th>
                            <td field-key='mod1opm2'>{{ $mod1->mod1opm2 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.mod1.fields.created-by')</th>
                            <td field-key='created_by'>{{ $mod1->created_by->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.mod1s.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop
