@extends('layouts.app')

@section('content')

    <h1>id: {{ $user->id }} の編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('name', '名前:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! Form::label('email', 'E-mail:') !!}
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    {!! Form::label('password', 'パスワード:') !!}
                    {!! Form::text('password', null, ['class' => 'form-control']) !!}                    
                    {!! Form::label('birthday', '誕生日:') !!}
                    {!! Form::text ('birthday', null, ['class' => 'form-control']) !!}
                    {!! Form::label('birthplace', '出身地:') !!}
                    {!! Form::text('birthplace', null, ['class' => 'form-control']) !!}                    

              </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
    
@endsection