@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.klanten.title')</h3>
    
    {!! Form::model($klanten, ['method' => 'PUT', 'route' => ['admin.klantens.update', $klanten->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('voornaam', trans('quickadmin.klanten.fields.voornaam').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('achternaam', trans('quickadmin.klanten.fields.achternaam').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('email', trans('quickadmin.klanten.fields.email').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('password', trans('quickadmin.klanten.fields.password').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('password', old('password'), ['class' => 'form-control', 'placeholder' => 'dit password wordt gebruikt on in te loggen in de app', 'required' => '']) !!}
                    <p class="help-block">dit password wordt gebruikt on in te loggen in de app</p>
                    @if($errors->has('password'))
                        <p class="help-block">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('naam_id', trans('quickadmin.klanten.fields.naam').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('naam_id', $naams, old('naam_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('naam_id'))
                        <p class="help-block">
                            {{ $errors->first('naam_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('geslacht', trans('quickadmin.klanten.fields.geslacht').'*', ['class' => 'control-label']) !!}
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

