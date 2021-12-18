@extends('layouts.app')

@section('content')

    <h1>id: {{ $perfomer->id }} の編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($perfomer, ['route' => ['perfomers.update', $perfomer->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('name', '名前:') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    {!! Form::label('realname', '本名:') !!}
                    {!! Form::text('realname', null, ['class' => 'form-control']) !!}
                    {!! Form::label('alias', '別名・略名:') !!}
                    {!! Form::text('alias', null, ['class' => 'form-control']) !!}
                    {!! Form::label('birthday', '誕生日:') !!}
                    {!! Form::text('birthday', null, ['class' => 'form-control']) !!}
                    {!! Form::label('deth', '没年月日:') !!}
                    {!! Form::text('deth', null, ['class' => 'form-control']) !!}  
                    {!! Form::label('birtplace', '出身地:') !!}
                    {!! Form::text('birthplace', null, ['class' => 'form-control']) !!}
                    {!! Form::label('bloodtype', '血液型:') !!}
                    {!! Form::text('bloodtype', null, ['class' => 'form-control']) !!}                    
                    {!! Form::label('height', '身長:') !!}
                    {!! Form::text('height', null, ['class' => 'form-control']) !!}
                    {!! Form::label('dialect', '方言:') !!}
                    {!! Form::text('dialect', null, ['class' => 'form-control']) !!}
                    {!! Form::label('educational', '学歴:') !!}
                    {!! Form::text('educational', null, ['class' => 'form-control']) !!}
                    {!! Form::label('master', '師匠:') !!}
                    {!! Form::text('master', null, ['class' => 'form-control']) !!}
                    {!! Form::label('school', '出身:') !!}
                    {!! Form::text('school', null, ['class' => 'form-control']) !!}                    
                    {!! Form::label('active', '活動時期:') !!}
                    {!! Form::text('active', null, ['class' => 'form-control']) !!}
                    {!! Form::label('activeend', '活動終了時期:') !!}
                    {!! Form::text('activeend', null, ['class' => 'form-control']) !!}
                    {!! Form::label('spouse', '配偶者:') !!}
                    {!! Form::text('spouse', null, ['class' => 'form-control']) !!}
                    {!! Form::label('relatives', '親族:') !!}
                    {!! Form::text('relatives', null, ['class' => 'form-control']) !!}                    
                    {!! Form::label('disciple', '弟子:') !!}
                    {!! Form::text('disciple', null, ['class' => 'form-control']) !!}                    
                    {!! Form::label('official', '公式URL:') !!}
                    {!! Form::text('official', null, ['class' => 'form-control']) !!}
                    {!! Form::label('twitter', 'Twitter:') !!}
                    {!! Form::text('twitter', null, ['class' => 'form-control']) !!}
                    {!! Form::label('instagram', 'Instagram:') !!}
                    {!! Form::text('instagram', null, ['class' => 'form-control']) !!}
                    {!! Form::label('facebook', 'Facebook:') !!}
                    {!! Form::text('facebook', null, ['class' => 'form-control']) !!}
                    {!! Form::label('blog', 'Blog:') !!}
                    {!! Form::text('blog', null, ['class' => 'form-control']) !!}                    
                    
                    {!! Form::label('office_id', '事務所id:') !!}
                    {!! Form::text('office_id', null, ['class' => 'form-control']) !!}                    
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
    
@endsection