@extends('layouts.app')

@section('content')

    <h2>新規タグ作成</h2>

    <div class="row">
        <div class="col-6">
            {!! Form::model($tag, ['route' => 'tags.store']) !!}

                <div class="form-group">
                    {!! Form::label('category', 'カテゴリー:') !!}
                    {!! Form::text('category', null, ['class' => 'form-control']) !!}
                    
                    {!! Form::label('name', 'タグ:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
    
@endsection