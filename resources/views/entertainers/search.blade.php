@extends('layouts.app')

@section('content')



<h1 class="mt-2 pb-2">検索結果</h1>



<h2 class="mt-2 pb-2">芸人一覧</h1>
    
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
                @foreach ($search as $value)
                @if($value->activeend == NULL) {{--解散済みの場合はグレー文字--}}
                <tr>
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, ['id' => $value->id]) !!}</td>
                    @if($value->active == null)
                    <td></td>
                    @else
                    <td>{{ $value->active->format('Y年～') }}</td>
                    @endif
                    <td></td>
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
                @else

                <tr class="text-secondary">
                    <td nowrap>{!! link_to_route('entertainers.show', $value->name, ['id' => $value->id]) !!}（解散済）</td>
                    @if($value->active == null)
                    <td></td>
                    @else
                    <td>{{ $value->active->format('Y年～') }}</td>
                    @endif
                    @if($value->active == null)
                    <td></td>
                    @else
                    <td>{{ $value->activeend->format('Y年') }}</td>
                    @endif
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
                @endif
                
                @endforeach
            </tbody>
        </table>



@endsection