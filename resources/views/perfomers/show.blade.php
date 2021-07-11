@extends('layouts.app')

@section('content')

    <h1>芸歴{{$now->diffInYears($perfomer->active)}}年目 {{ $perfomer->name }} の詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>名前</th>
            <td>{{ $perfomer->name }}</td>
        </tr>
        <tr>
            <th>本名</th>
            <td>{{ $perfomer->realname }}</td>
        </tr>
        <tr>
            <th>コンビ名、グループ名</th>
            
        @empty($perfomer->entertainer)
            <td></td>
        @else
            @foreach($perfomer->entertainer as $value)
                @if($value !== NULL)
                <td nowrap>{!! link_to_route('entertainers.show', $value->name, ['id' => $value->id]) !!}</td>
                @else
                <td></td>
                @endif
            @endforeach
        @endempty

        </tr>        
        <tr>
            <th>別名</th>
            <td>{{ $perfomer->alias }}</td>
        </tr>
        <tr>
            <th>誕生日</th>
            <td>{{ $perfomer->birthday }}</td>
        </tr>
        <tr>
            <th>没年月日</th>
            <td>{{ $perfomer->deth }}</td>
        </tr>
        <tr>
            <th>出身地</th>
            <td>{{ $perfomer->birthplace }}</td>
        </tr>
        <tr>
            <th>血液型</th>
            <td>{{ $perfomer->bloodtype }}</td>
        </tr>        
        <tr>
            <th>身長</th>
            <td>{{ $perfomer->height }}</td>
        </tr>        
        <tr>
            <th>方言</th>
            <td>{{ $perfomer->dialect }}</td>
        </tr>
        <tr>
            <th>学歴</th>
            <td>{{ $perfomer->education }}</td>
        </tr>        
        <tr>
            <th>師匠</th>
            <td>{{ $perfomer->master }}</td>
        </tr>
        <tr>
            <th>出身</th>
            <td>{{ $perfomer->school }}</td>
        </tr>        
        <tr>
            <th>活動時期</th>
            <td>{{ $perfomer->active}}</td>
        </tr>
        <tr>
            <th>活動終了時期</th>
            <td>{{ $perfomer->activeend }}</td>
        </tr>
        <tr>
            <th>配偶者</th>
            <td>{{ $perfomer->spouse }}</td>
        </tr>
        <tr>
            <th>親族</th>
            <td>{{ $perfomer->relatives }}</td>
        </tr>
        <tr>
            <th>弟子</th>
            <td>{{ $perfomer->disciple }}</td>
        </tr>        
        <tr>
            <th>事務所</th>
            <td>{!! link_to_route('entertainers.office', $office->office, [$perfomer->office_id]) !!}</td>
        </tr>
            <th>公式URL</th>
            <td><a href="{{ $perfomer->official }}" target="new">{{ $perfomer->official }}</a></td>
        </tr>
        <tr>
            <th>Youtubeチャンネル</th>
            <td><a href="{{ $perfomer->youtube }}" target="new">{{ $perfomer->youtube }}</a></td>
        </tr>
            <th>芸歴</th>
            <td>{{$now->diffInYears($perfomer->active)}}年目</td>
        </tr>
        </table>
    
    
    
    {{-- 作成ページへのリンク --}}
    @if (Auth::check())
    {{-- 編集ページへのリンク --}}
    {!! link_to_route('perfomers.edit', 'このメッセージを編集', ['id' => $perfomer->id], ['class' => 'btn btn-light']) !!}

    {{-- 削除フォーム --}}
    {!! Form::model($perfomer, ['route' => ['perfomers.destroy', $perfomer->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
    @else
    @endif

@endsection