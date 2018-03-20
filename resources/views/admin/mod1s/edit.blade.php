@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.mod1.title')</h3>
    
    {!! Form::model($mod1, ['method' => 'PUT', 'route' => ['admin.mod1s.update', $mod1->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('mod1vr1', trans('quickadmin.mod1.fields.mod1vr1').'', ['class' => 'control-label']) !!}
                    {!! Form::number('mod1vr1', old('mod1vr1'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('mod1vr1'))
                        <p class="help-block">
                            {{ $errors->first('mod1vr1') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('mod1opm1', trans('quickadmin.mod1.fields.mod1opm1').'', ['class' => 'control-label']) !!}
                    {!! Form::text('mod1opm1', old('mod1opm1'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('mod1opm1'))
                        <p class="help-block">
                            {{ $errors->first('mod1opm1') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('mod1vr2', trans('quickadmin.mod1.fields.mod1vr2').'', ['class' => 'control-label']) !!}
                    {!! Form::number('mod1vr2', old('mod1vr2'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('mod1vr2'))
                        <p class="help-block">
                            {{ $errors->first('mod1vr2') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('mod1opm2', trans('quickadmin.mod1.fields.mod1opm2').'', ['class' => 'control-label']) !!}
                    {!! Form::text('mod1opm2', old('mod1opm2'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('mod1opm2'))
                        <p class="help-block">
                            {{ $errors->first('mod1opm2') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

