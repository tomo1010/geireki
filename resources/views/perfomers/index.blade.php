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
                @foreach ($perfomers as $perfomer)
                @if($perfomer->activeend == NULL) {{--解散済みの場合はグレー文字--}}
                <tr>
                    <td nowrap>{!! link_to_route('perfomers.show', $perfomer->name, ['perfomer' => $perfomer->id]) !!}</td>
                    <td>{{ $perfomer->active }}</td>
                    <td></td>
                    <td>{{ $perfomer->master }}</td>
                    <td>{{ $perfomer->oldname }}</td>

                    @empty($perfomer->official)
                    <td></td>
                    @else
                    <td><a href="{{ $perfomer->official }}">公式</a></td>
                    @endempty

                    @empty($perfomer->youtube)
                    <td></td>
                    @else
                    <td><a href="{{ $perfomer->youtube }}">Youtube</a></td>
                    @endempty
                    
                    <td nowrap>{{$now->diffInYears($perfomer->active)}}年</td>
                </tr>
                @else

                <tr class="text-secondary">
                    <td nowrap>{!! link_to_route('perfomers.show', $perfomer->name, ['perfomer' => $perfomer->id]) !!}（解散済）</td>
                    <td>{{ $perfomer->active}}</td>
                    <td>{{ $perfomer->activeend }}</td>
                    <td>{{ $perfomer->master }}</td>
                    <td>{{ $perfomer->oldname }}</td>

                    @empty($perfomer->official)
                    <td></td>
                    @else
                    <td><a href="{{ $perfomer->official }}">公式</a></td>
                    @endempty

                    @empty($perfomer->youtube)
                    <td></td>
                    @else
                    <td><a href="{{ $perfomer->youtube }}">Youtube</a></td>
                    @endempty
                    
                    <td nowrap>{{$now->diffInYears($perfomer->active)}}年</td>
                </tr>
                @endif
                
                @endforeach
            </tbody>
        </table>

    {{-- ページネーションのリンク --}}
    {{ $perfomers->appends(request()->query())->links() }}
    

@endsection