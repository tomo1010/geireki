@extends('layouts.app')

@section('content')

<?php
 $s_name = null;
 $s_bloodtype = null;
 $s_birthplace = null;
?>

{!! Form::open(['action' => 'SearchController@search','method' => 'get']) !!}
    名前:{!! Form::text('s_name', $s_name) !!}
    血液型:{!! Form::text('s_bloodtype', $s_bloodtype) !!}
    出身地:{!! Form::text('s_birthplace', $s_birthplace) !!}
    {!! Form::submit('検索') !!}
{!! Form::close() !!}



    <h2 class="mt-2 pb-2">芸人一覧</h1>
    
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>@sortablelink('name', '芸人')</th>
                    <th>@sortablelink('active', '活動時期')</th>
                    <th>活動終了時期</th>
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
                    <td nowrap>{!! link_to_route('entertainers.show', $entertainer->name, ['id' => $entertainer->id]) !!}</td>
                    @empty($entertainer->active)
                    <td></td>
                    @else
                    <td>{{ $entertainer->active }}</td>
                    @endempty
                    
                    <td></td>
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
                    <td nowrap>{!! link_to_route('entertainers.show', $entertainer->name, ['id' => $entertainer->id]) !!}（解散済）</td>
                    
                    @empty($entertainer->active)
                    <td></td>
                    @else                    
                    <td>{{ $entertainer->active }}</td>
                    @endempty                    
                    
                    <td>{{ $entertainer->activeend }}</td>
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




@endsection