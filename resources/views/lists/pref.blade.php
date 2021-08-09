@extends('layouts.app')

@section('content')

北海道：{{$prefCount[0]}}人　東北：{{$touhoku}}人　関東：{{$kantou}}人　甲信越北陸：{{$hokuriku}}人　東海：{{$toukai}}人　関西：{{$kansai}}人　中国：{{$chugoku}}人　四国：{{$shikoku}}人　九州：{{$kyuusyu}}人　沖縄：{{$prefCount[46]}}人


    <div class="col-lg-6"><h2 class="mt-2 pb-2 display-5 border-bottom">出身県別一覧</h2>
        <table class="table table-striped">
            <tbody>
                @foreach ($prefCount as $count)
                    <tr>
                        <td>
                        {{ $prefs[$loop->iteration] }}
                        </td>    
                        <td>
                        {!! link_to_route('lists.prefList', $count, ['pref' => $prefs[$loop->iteration]]) !!}人
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        
@endsection        