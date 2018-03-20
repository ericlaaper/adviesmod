@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.relatiemanager.title')</h3>
    
    {!! Form::model($relatiemanager, ['method' => 'PUT', 'route' => ['admin.relatiemanagers.update', $relatiemanager->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('voornaam', trans('quickadmin.relatiemanager.fields.voornaam').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('voornaam', old('voornaam'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('voornaam'))
                        <p class="help-block">
                            {{ $errors->first('voornaam') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('achternaam', trans('quickadmin.relatiemanager.fields.achternaam').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('achternaam', old('achternaam'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('achternaam'))
                        <p class="help-block">
                            {{ $errors->first('achternaam') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('email', trans('quickadmin.relatiemanager.fields.email').'*', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('geslacht', trans('quickadmin.relatiemanager.fields.geslacht').'*', ['class' => 'control-label']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('geslacht'))
                        <p class="help-block">
                            {{ $errors->first('geslacht') }}
                        </p>
                    @endif
                    <div>
                        <label>
                            {!! Form::radio('geslacht', 'heer', false, ['required' => '']) !!}
                            Heer
                        </label>
                    </div>
                    <div>
                        <label>
                            {!! Form::radio('geslacht', 'mevrouw', false, ['required' => '']) !!}
                            Mevrouw
                        </label>
                    </div>
                    
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

