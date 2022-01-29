@extends('layouts.app')

@section('content')


<h1>中間テーブル・新規作成ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($member, ['route' => 'members.store']) !!}

                <div class="form-group">
                    {!! Form::label('entertainer_id', '個人id:') !!}
                    {!! Form::text('entertainer_id', null, ['class' => 'form-control']) !!}
                    {!! Form::label('perfomer_id', '芸人id:') !!}
                    {!! Form::text('perfomer_id', null, ['class' => 'form-control']) !!}                    
                </div>

                {!! Form::submit('新規作成', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
    
@endsection