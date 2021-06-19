@extends('layouts.app')

@section('content')


<h1>新規作成ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($perfomer, ['route' => 'perfomers.store']) !!}

                <div class="form-group">
                    {!! Form::label('name', '名前:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! Form::label('realname', '本名:') !!}
                    {!! Form::text('realname', null, ['class' => 'form-control']) !!}
                    {!! Form::label('alias', '別名・略名:') !!}
                    {!! Form::text('alias', null, ['class' => 'form-control']) !!}
                    {!! Form::label('birthday', '誕生日:') !!}
                    {!! Form::text('birthday', null, ['class' => 'form-control']) !!}
                    {!! Form::label('deth', '終了日:') !!}
                    {!! Form::text('deth', null, ['class' => 'form-control']) !!}
                    {!! Form::label('birthplace', '出身地:') !!}
                    {!! Form::text('birthplace', null, ['class' => 'form-control']) !!}
                    {!! Form::label('bloodtype', '血液型:') !!}
                    {!! Form::text('bloodtype', null, ['class' => 'form-control']) !!}                    
                    {!! Form::label('height', '身長:') !!}
                    {!! Form::text('height', null, ['class' => 'form-control']) !!}                    
                    {!! Form::label('dialect', '方言:') !!}
                    {!! Form::text('dialect', null, ['class' => 'form-control']) !!}                   
                    {!! Form::label('education', '学歴:') !!}
                    {!! Form::text('education', null, ['class' => 'form-control']) !!}                   
                    {!! Form::label('master', '師匠:') !!}
                    {!! Form::text('master', null, ['class' => 'form-control']) !!}
                    {!! Form::label('school', '出身:') !!}
                    {!! Form::text('school', null, ['class' => 'form-control']) !!}                    
                    {!! Form::label('active', '活動時期:') !!}
                    {!! Form::text('active', null, ['class' => 'form-control']) !!}
                    {!! Form::label('activeend', '活動終了時期:') !!}
                    {!! Form::text('activeend', null, ['class' => 'form-control']) !!}
                    {!! Form::label('official', '公式URL:') !!}
                    {!! Form::text('official', null, ['class' => 'form-control']) !!}
                    {!! Form::label('youtube', 'Youtubeチャンネル:') !!}
                    {!! Form::text('youtube', null, ['class' => 'form-control']) !!}
                    {!! Form::label('enteriner_id', '芸人id:') !!}
                    {!! Form::text('enteriner_id', null, ['class' => 'form-control']) !!}
                    {!! Form::label('office_id', '事務所id:') !!}
                    {!! Form::text('office_id', null, ['class' => 'form-control']) !!}                    
                </div>

                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
    
@endsection