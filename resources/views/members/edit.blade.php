@extends('layouts.app')

@section('content')

    <h1>id: {{ $member->id }} の編集ページ</h1>

    <div class="row">
        <div class="col-6">
            {!! Form::model($member, ['route' => ['members.update', $member->id], 'method' => 'put']) !!}

                <div class="form-group">
                    {!! Form::label('$member->entertainer_id', '名前:') !!}
                    {!! Form::text('$member->entertainer_id', null, ['class' => 'form-control']) !!}

                    @empty($member->perfomer_id)
                    @else
                        @foreach ($member->perfomer_id as $value)
                            {!! Form::label('perfomer_id[]', '個人id:') !!}
                            {!! Form::text('perfomer_id[]', $value->id, ['class' => 'form-control']) !!}
                        @endforeach
                    @endempty
                    
                    {!! Form::hidden('back_url', url()->previous()) !!}
                </div>

                {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
    
@endsection