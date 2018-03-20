@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.bedrijf.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.bedrijfs.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('bedrijfsnaam', trans('quickadmin.bedrijf.fields.bedrijfsnaam').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('bedrijfsnaam', old('bedrijfsnaam'), ['class' => 'form-control', 'placeholder' => 'maximaal 50 tekens', 'required' => '']) !!}
                    <p class="help-block">maximaal 50 tekens</p>
                    @if($errors->has('bedrijfsnaam'))
                        <p class="help-block">
                            {{ $errors->first('bedrijfsnaam') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('achternaam_id', trans('quickadmin.bedrijf.fields.achternaam').'', ['class' => 'control-label']) !!}
                    {!! Form::select('achternaam_id', $achternaams, old('achternaam_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('achternaam_id'))
                        <p class="help-block">
                            {{ $errors->first('achternaam_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

