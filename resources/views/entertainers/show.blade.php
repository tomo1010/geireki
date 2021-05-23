@extends('layouts.app')

@section('content')

    <h1>{{ $entertainer->name }} の詳細ページ</h1>

    <table class="table table-bordered">
        <tr>
            <th>id</th>
            <td>{{ $entertainer->id }}</td>
        </tr>
        <tr>
            <th>名前</th>
            <td>{{ $entertainer->name }}</td>
        </tr>
        <tr>
            <th>人数</th>
            <td>{{ $entertainer->numberofpeople }}</td>
        </tr>
        <tr>
            <th>別名</th>
            <td>{{ $entertainer->alias }}</td>
        </tr>
        <tr>
            <th>活動時期</th>
            <td>{{ $entertainer->active }}</td>
        </tr>
        <tr>
            <th>活動終了時期</th>
            <td>{{ $entertainer->activeend }}</td>
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
            <th>公式URL</th>
            <td>{{ $entertainer->official }}</td>
        </tr>
        <tr>
            <th>Youtubeチャンネル</th>
            <td>{{ $entertainer->youtube }}</td>
        </tr>
        <tr>
            <th>芸歴</th>
            <td>{{$now->diffInYears($entertainer->active)}}年目</td>
        </tr>
    </table>
    
    
    
    <table class="table table-striped">
        <tr>
            <td>1年先輩</td>
            <td>同期芸人</td>
            <td>1年後輩</td>
        </tr>
        <tr>
            <td>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>gender</th>
                            <th>師匠</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($senior as $value)
                        <tr>
                            <td nowrap>{!! link_to_route('entertainers.show', $value->name, $value->id) !!}</td>
                            <td>{{ $value->gender }}</td>
                            <td>{{ $value->master }}</td>
                        </tr>
                        @endforeach
                    </tbody>   
                </table>
            </td>
            
            <td>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>gender</th>
                            <th>師匠</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($sync as $value)
                        <tr>
                            <td nowrap>{!! link_to_route('entertainers.show', $value->name, $value->id) !!}</td>
                            <td>{{ $value->gender }}</td>
                            <td>{{ $value->master }}</td>
                        </tr>
                        @endforeach
                    </tbody>   
                </table>    
            </td>
            
            <td>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>gender</th>
                            <th>師匠</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($junior as $value)
                        <tr>
                            <td nowrap>{!! link_to_route('entertainers.show', $value->name, $value->id) !!}</td>
                            <td>{{ $value->gender }}</td>
                            <td>{{ $value->master }}</td>

                        </tr>
                        @endforeach
                    </tbody>   
            </table>
            </td>
            
        </tr>
    </table>    
    
    
    
    
    
    
    
 
    
    
    
    
    
    
    
    

    
    
    

    {{-- 編集ページへのリンク --}}
    {!! link_to_route('entertainers.edit', 'このメッセージを編集', ['entertainer' => $entertainer->id], ['class' => 'btn btn-light']) !!}

    {{-- 削除フォーム --}}
    {!! Form::model($entertainer, ['route' => ['entertainers.destroy', $entertainer->id], 'method' => 'delete']) !!}
        {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@endsection