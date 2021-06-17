@extends('layouts.app')

@section('content')

    <h1>個人CSVアップロード</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::open(['route' => 'csv.importPerfomer','files'=>true]) !!}

                <div class="form-group">
                    {!! Form::label('csv', 'ｃｓｖ:') !!}
                    {!! Form::file('csv', null, ['class' => 'form-control']) !!}

                </div>

@if (session('flash_message'))
    <div class="alert alert-success">
        {{ session('flash_message') }}
    </div>
@endif
                {!! Form::submit('アップロード', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
    
@endsection