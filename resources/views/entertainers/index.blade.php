@extends('layouts.app')

@section('content')


<h1>芸人一覧</h1>
    
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
                    <th>芸歴</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($entertainers as $entertainer)
                @if($entertainer->activeend == NULL) {{--解散済みの場合はグレー文字--}}
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $entertainer->name, ['entertainer' => $entertainer->id]) !!}</td>
                    <td>{{ $entertainer->active->format('Y年～') }}</td>
                    <td></td>
                    <td>{{ $entertainer->master }}</td>
                    <td>{{ $entertainer->oldname }}</td>

                    @empty($entertainer->official)
                    <td></td>
                    @else
                    <td><a href="{{ $entertainer->official }}">公式</a></td>
                    @endempty

                    @empty($entertainer->youtube)
                    <td></td>
                    @else
                    <td><a href="{{ $entertainer->youtube }}">Youtube</a></td>
                    @endempty
                    
                    <td nowrap>{{$now->diffInYears($entertainer->active)}}年</td>
                </tr>
                @else

                <tr class="text-secondary">
                    <td nowrap>{!! link_to_route('entertainers.show', $entertainer->name, ['entertainer' => $entertainer->id]) !!}（解散済）</td>
                    <td>{{ $entertainer->active->format('Y年～') }}</td>
                    <td>{{ $entertainer->activeend->format('Y年') }}</td>
                    <td>{{ $entertainer->master }}</td>
                    <td>{{ $entertainer->oldname }}</td>

                    @empty($entertainer->official)
                    <td></td>
                    @else
                    <td><a href="{{ $entertainer->official }}">公式</a></td>
                    @endempty

                    @empty($entertainer->youtube)
                    <td></td>
                    @else
                    <td><a href="{{ $entertainer->youtube }}">Youtube</a></td>
                    @endempty
                    
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


<h2>M1ラストイヤーの芸人</h2>    
            <table class="table table-striped">
            <thead>
                <tr>
                    <th>@sortablelink('name', '芸人')</th>
                    <th>@sortablelink('active', '活動時期')</th>
                    <th>師匠</th>
                    <th>旧名</th>
                    <th>公式</th>
                    <th>Youtube</th>
                    <th>芸歴</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($m1year as $value)
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, ['entertainer' => $value->id]) !!}</td>
                    <td>{{ $value->active->format('Y年～')}}</td>
                    <td>{{ $value->master }}</td>
                    <td>{{ $value->oldname }}</td>
                    
                    @empty($value->official)
                    <td></td>
                    @else
                    <td><a href="{{ $value->official }}">公式</a></td>
                    @endempty

                    @empty($value->youtube)
                    <td></td>
                    @else
                    <td><a href="{{ $value->youtube }}">Youtube</a></td>
                    @endempty
                    
                    <td nowrap>{{$now->diffInYears($value->active)}}年</td>
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
                    <th>芸歴</th>
                </tr>
            </thead>
            
            <tbody>
                @foreach ($dissolutions as $dissolution)
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $dissolution->name, ['entertainer' => $dissolution->id]) !!}</td>
                    <td>{{ $dissolution->active->format('Y年～')}}</td>
                    <td>{{ $dissolution->activeend->format('Y年m月d日') }}</td>
                    <td>{{ $dissolution->master }}</td>
                    <td>{{ $dissolution->oldname }}</td>
                    
                    @empty($dissolution->official)
                    <td></td>
                    @else
                    <td><a href="{{ $dissolution->official }}">公式</a></td>
                    @endempty

                    @empty($dissolution->youtube)
                    <td></td>
                    @else
                    <td><a href="{{ $dissolution->youtube }}">Youtube</a></td>
                    @endempty
                    
                    <td nowrap>{{$now->diffInYears($dissolution->active)}}年</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    
        

    
    {{-- 作成ページへのリンク --}}
    @if (Auth::check())
    {!! link_to_route('entertainers.create', '新規メッセージの投稿', [], ['class' => 'btn btn-primary']) !!}

    {{-- ユーザ登録ページへのリンク --}}
    {!! link_to_route('signup.get', 'Sign up now!', [], ['class' => 'btn btn-lg btn-primary']) !!}
    @else
    @endif

@endsection