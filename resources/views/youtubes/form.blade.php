{!! Form::open(['route' => 'youtubes.store']) !!}
    <div class="form-group">

        {!! Form::textarea('youtube', null, ['class' => 'form-control', 'rows' => '2']) !!}
        {!! Form::textarea('time', null, ['class' => 'form-control', 'rows' => '2']) !!}
        {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
    </div>
{!! Form::close() !!}