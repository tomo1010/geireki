@extends('layouts.app')

@section('content')


<h1>新規作成ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($entertainer, ['route' => 'entertainers.store']) !!}

                <div class="form-group">
                    {!! Form::label('name', '名前:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! Form::label('numberofpeople', '人数:') !!}
                    {!! Form::text('numberofpeople', null, ['class' => 'form-control']) !!}
                    {!! Form::label('gender', '性別:') !!}
                    {!! Form::text('gender', null, ['class' => 'form-control']) !!}
                    {!! Form::label('alias', '別名・略名:') !!}
                    {!! Form::text('alias', null, ['class' => 'form-control']) !!}
                    {!! Form::label('active', '活動時期:') !!}
                    {!! Form::text('active', null, ['class' => 'form-control']) !!}
                    {!! Form::label('activeend', '活動終了時期:') !!}
                    {!! Form::text('activeend', null, ['class' => 'form-control']) !!}
                    {!! Form::label('master', '師匠:') !!}
                    {!! Form::text('master', null, ['class' => 'form-control']) !!}
                    {!! Form::label('oldname', '旧名:') !!}
                    {!! Form::text('oldname', null, ['class' => 'form-control']) !!}
                    {!! Form::label('official', '公式URL:') !!}
                    {!! Form::text('official', null, ['class' => 'form-control']) !!}
                    {!! Form::label('youtube', 'Youtubeチャンネル:') !!}
                    {!! Form::text('youtube', null, ['class' => 'form-control']) !!}
                    {!! Form::label('office_id', '事務所id:') !!}
                    {!! Form::text('office_id', null, ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
    
@endsection