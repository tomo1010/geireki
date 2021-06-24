@extends('layouts.app')

@section('content')

    <h1 class="mt-2 pb-2">芸歴{{$now->diffInYears($entertainer->active)}}年目：{{ $entertainer->name }} </h1>

    <table class="table table-bordered">
        <tr>
            <th>名前</th>
            <td>{{ $entertainer->name }}</td>
        </tr>
        <tr>
            <th>別名</th>
            <td>{{ $entertainer->alias }}</td>
        </tr>
        <tr>
        <th>
            メンバー
        </th>
        <td>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>名前</th>
                    <th>活動時期</th>
                    <th>師匠</th>
                    <th>出身</th>
                    <th>芸歴</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($perfomer as $value)
                <tr>
                    <td nowrap>{!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}</td>
                    <td>{{ $value->active }}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->school }}</td>
                    <td nowrap>{{$now->diffInYears($value->active)}}年</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </td>
        </tr>
        <tr>
            <th>活動時期</th>
            <td>{{ $entertainer->active}}</td>
        </tr>
        <tr>
            <th>活動終了時期</th>
            <td>{{ $entertainer->activeend}}</td>
        </tr>
        <tr>
            <th>師匠</th>
            <td>{{ $entertainer->master }}</td>
        </tr>
        <tr>
            <th>旧名</th>
            <td>{{ $entertainer->oldname }}</td>
        </tr>
        <tr>
            <th>事務所</th>
            <td>{{ $office->office }}</td>
        </tr>
            <th>公式URL</th>
            <td><a href="{{ $entertainer->official }}" target="new">{{ $entertainer->official }}</a></td>
        </tr>
        <tr>
            <th>Youtubeチャンネル</th>
            <td><a href="{{ $entertainer->youtube }}" target="new">{{ $entertainer->youtube }}</a></td>
        </tr>
        <tr>
            <th>芸歴</th>
            <td>{{$now->diffInYears($entertainer->active)}}年目</td>
        </tr>
        </table>
        
    <h2 class="mt-5 pb-2">関連Youtube</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>URL</th>
                    <th>時間</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($youtube as $value)
                <tr>
                    <td>{{ $value->youtube }}</td>
                    <td>{{ $value->time }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    {{-- 投稿フォーム --}}
    {!! Form::open(['route' => 'youtubes.store']) !!}
        <div class="form-group">
            <input type="hidden" value="{{$entertainer->id}}" name="entertainer_id">
            {!! Form::textarea('youtube', null, ['class' => 'form-control', 'rows' => '2']) !!}
            {!! Form::textarea('time', null, ['class' => 'form-control', 'rows' => '2']) !!}
            {!! Form::submit('Post', ['class' => 'btn btn-primary btn-block']) !!}
        </div>
    {!! Form::close() !!} 
        
    
    <h2 class="mt-5 pb-2 border-bottom">関連芸人</h2>
    <div class="container">
        <div class="row">
                <div class="col-lg-4"><h3 class="mt-2 pb-1">1年先輩</h3>
                    <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>名前</td><td>人数</td><td>師匠</td>
                        </tr>    
                        @foreach ($senior as $value)
                        <tr>
                            <td>{!! link_to_route('entertainers.show', $value->name, $value->id) !!}</td>
                            @if($value->gender == '1')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/pinM.png" height="30"></td>
                            @elseif($value->gender == '2')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/pinM.png" height="30"></td>
                            @elseif($value->gender == '11')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/conbiM.png" height="30"></td>
                            @elseif($value->gender == '12')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/conbiM.png" height="30"></td>
                            @elseif($value->gender == '22')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/conbiM.png" height="30"></td>                                
                            @elseif($value->gender == '111')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/trioM.png" height="30"></td>
                            @elseif($value->gender == '222')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/trioM.png" height="30"></td>
                            @endif
                            <td>{{ $value->master }}</td>
                        </tr>
                        @endforeach
                    </tbody>   
                    </table>
                </div>
                <div class="col-lg-4"><h3 class="mt-2 pb-1">同期</h3>
                    <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>名前</td><td>人数</td><td>師匠</td>
                        </tr>                        
                        @foreach ($sync as $value)
                        <tr>
                            <td>{!! link_to_route('entertainers.show', $value->name, $value->id) !!}</td>
                            @if($value->gender == '1')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/pinM.png" height="30"></td>
                            @elseif($value->gender == '2')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/pinF.png" height="30"></td>
                            @elseif($value->gender == '11')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/conbiM.png" height="30"></td>
                            @elseif($value->gender == '12')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/conbiMF.png" height="30"></td>
                            @elseif($value->gender == '22')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/conbiF.png" height="30"></td>                                
                            @elseif($value->gender == '111')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/trioM.png" height="30"></td>
                            @elseif($value->gender == '222')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/trioF.png" height="30"></td>
                            @endif
                            <td>{{ $value->master }}</td>
                        </tr>
                        @endforeach
                    </tbody>   
                    </table>
                </div>    
                <div class="col-lg-4"><h3 class="mt-2 pb-1">1年後輩</h3>
                    <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td>名前</td><td>人数</td><td>師匠</td>
                        </tr>                        
                        @foreach ($junior as $value)
                        <tr>
                            <td>{!! link_to_route('entertainers.show', $value->name, $value->id) !!}</td>
                            @if($value->gender == '1')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/pinM.png" height="30"></td>
                            @elseif($value->gender == '2')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/pinM.png" height="30"></td>
                            @elseif($value->gender == '11')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/conbiM.png" height="30"></td>
                            @elseif($value->gender == '12')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/conbiM.png" height="30"></td>
                            @elseif($value->gender == '22')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/conbiM.png" height="30"></td>                                
                            @elseif($value->gender == '111')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/trioM.png" height="30"></td>
                            @elseif($value->gender == '222')
                                <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/trioM.png" height="30"></td>
                            @endif
                            <td>{{ $value->master }}</td>
                        </tr>
                        @endforeach
                    </tbody>   
                    </table>                
                </div>
        </div>
    </div>

    {{-- 作成ページへのリンク --}}
    @if (Auth::check())
    {{-- 編集ページへのリンク --}}
    {!! link_to_route('entertainers.edit', 'このメッセージを編集', ['id' => $entertainer->id], ['class' => 'btn btn-light']) !!}

    {{-- 削除フォーム --}}
    {!! Form::model($entertainer, ['route' => ['entertainers.destroy', $entertainer->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
    @else
    @endif

@endsection