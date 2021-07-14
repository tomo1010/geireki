@extends('layouts.app')

@section('content')

        {{--年代別一覧--}}
        <div class="col-lg-6"><h2 class="mt-2 pb-2 display-5 border-bottom">年代別一覧</h2>
            <table>
                <tbody>
                    @foreach($forty as $data)
                    <tr>
                        <td>
                        {{$data->name}}
                        </td>
                    </tr>

                @foreach ($data->entertainer as $value)
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, ['id' => $value->id]) !!}</td>
                    <td>{{ $value->active }}</td>
                    <td>{{ $value->master }}</td>
                    <td nowrap>{{$now->diffInYears($value->active)}}年</td>
                </tr>
                @endforeach
@endforeach
                </tbody>
            </table>
        </div>
        
@endsection