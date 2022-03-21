@extends('layouts.app')

@section('content')
    <div class="text-center">
        <h1>アカウントを作成</h1>
    </div>

    <div class="row">
        <div class="col-sm-6 offset-sm-3">

            {!! Form::open(['route' => 'signup.post']) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'password確認') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('birthday', 'Birthday') !!}
                    {!! Form::date('birthday', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('birthplace', 'Birthplace') !!}
                        <select name="birthplace" class="form-control">
                        <option value="" selected="selected">選択</option>
                          @foreach(config('pref') as $index=>$name)
                            <option value="{{$name}}">{{$name}}</option>
                          @endforeach
                        </select>
                </div>       
                
                
                


                {!! Form::submit('サインアップ', ['class' => 'btn btn-primary btn-block']) !!}
            {!! Form::close() !!}

        {{-- ログインページへのリンク --}}
        <p class="mt-2">
             <center>アカウントをお持ちの方は{!! link_to_route('login', 'ログイン') !!}</center>
        </p>

        </div>
    </div>
@endsection