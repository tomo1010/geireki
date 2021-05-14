@extends('layouts.app')

@section('content')

<form method="post" action="{{ route('entertainers.select')}}">
     @csrf
<select name="year" onchange="submit(this.form)">
@for($i = 0; $i < 70; $i++)
  <option value="{{$i}}">{{$i}}</option>
@endfor
</select>
</form>


<h1>芸人一覧</h1>

    @if (count($entertainers) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>@sortablelink('name', '芸人')</th>
                    <th>@sortablelink('active', '活動時期')</th>
                    <th>活動終了時期</th>
                    <th>師匠</th>
                    <th>旧名</th>
                    <th>公式</th>
                    <th>Youtube</th>
                    <th>@sortablelink('active', '芸歴')</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($entertainers as $entertainer)
                @if($entertainer->activeend == NULL) {{--解散済みNULLの場合はグレー文字--}}
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $entertainer->name, ['entertainer' => $entertainer->id]) !!}</td>
                    <td>{{ $entertainer->active }}</td>
                    <td>{{ $entertainer->activeend }}</td>
                    <td>{{ $entertainer->master }}</td>
                    <td>{{ $entertainer->oldname }}</td>
                    <td><a href="{{ $entertainer->official }}">公式</a></td>
                    <td><a href="{{ $entertainer->youtube }}">Youtube</a></td>
                    <td nowrap>{{$now->diffInYears($entertainer->active)}}年</td>
                </tr>
                @else

                <tr class="text-secondary">
                    <td nowrap>{!! link_to_route('entertainers.show', $entertainer->name, ['entertainer' => $entertainer->id]) !!}（解散済）</td>
                    <td>{{ $entertainer->active }}</td>
                    <td>{{ $entertainer->activeend }}</td>
                    <td>{{ $entertainer->master }}</td>
                    <td>{{ $entertainer->oldname }}</td>
                    <td><a href="{{ $entertainer->official }}">公式</a></td>
                    <td><a href="{{ $entertainer->youtube }}">Youtube</a></td>
                    <td nowrap>{{$now->diffInYears($entertainer->active)}}年</td>
                </tr>
                @endif
                
                @endforeach
            </tbody>
        </table>

    {{-- ページネーションのリンク --}}
    {{ $entertainers->appends(request()->query())->links() }}

<h2>芸歴年別一覧</h2>     
    <table>
        <tbody>
            <?php $year=0; ?>
            @foreach ($counts as $count)
                <tr>
                    <td>
                    <?php echo $year; ?>年
                    {!! link_to_route('entertainers.list', $count, ['year' => $year]) !!}人（ピン{{ $results_1[$loop->index] }}人　コンビ{{ $results_2[$loop->index] }}人　トリオ{{ $results_3[$loop->index] }}人）
                    <?php $year++; ?>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>

    
<h2>今年解散した芸人</h2>    
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>@sortablelink('name', '芸人')</th>
                    <th>@sortablelink('active', '活動時期')</th>
                    <th>活動終了時期</th>
                    <th>師匠</th>
                    <th>旧名</th>
                    <th>公式</th>
                    <th>Youtube</th>
                    <th>@sortablelink('active', '芸歴')</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($dissolutions as $dissolution)
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $dissolution->name, ['entertainer' => $dissolution->id]) !!}</td>
                    <td>{{ $dissolution->active }}</td>
                    <td>{{ $dissolution->activeend }}</td>
                    <td>{{ $dissolution->master }}</td>
                    <td>{{ $dissolution->oldname }}</td>
                    <td><a href="{{ $dissolution->official }}">公式</a></td>
                    <td><a href="{{ $dissolution->youtube }}">Youtube</a></td>
                    <td nowrap>{{$now->diffInYears($dissolution->active)}}年</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
        
    @endif
    
    {{-- 作成ページへのリンク --}}
    {!! link_to_route('entertainers.create', '新規メッセージの投稿', [], ['class' => 'btn btn-primary']) !!}

@endsection