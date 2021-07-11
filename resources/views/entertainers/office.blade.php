@extends('layouts.app')

@section('content')



<h1 class="mt-2 pb-2"> {{ $office }} 所属の芸人一覧</h1>

    <div class="container">
        <div class="row">

            <div class="col-lg-4"><h2 class="mt-2 pb-2 display-5">ピン芸人</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>性別</th>
                            <th>活動時期</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results_1 as $value)
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}</td>
                            @include('commons.gender')                            

                            @empty($value->active)
                            <td></td>
                            @else
                            <td>{{ $value->active->format('Y年～') }}</td>
                            @endempty
                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                            <td>{{ $value->active }}</td>
                            <td>{{ $value->activeend }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>   
                </table>
            </div>
            
            
            <div class="col-lg-4"><h2 class="mt-2 pb-2 display-5">コンビ芸人</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>性別</th>
                            <th>活動時期</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($results_2 as $value)
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}</td>
                            @include('commons.gender')                            
                            @empty($value->active)
                            <td></td>
                            @else
                            <td>{{ $value->active->format('Y年～') }}</td>
                            @endempty
                            
                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                            @include('commons.gender')                            
                            <td>{{ $value->active }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>   
                </table>
            </div>
            <div class="col-lg-4"><h2 class="mt-2 pb-2 display-5">トリオ芸人</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>活動時期</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($results_3 as $value)
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}</td>
                            
                            @empty($value->active)
                            <td></td>
                            @else
                            <td>{{ $value->active->format('Y年～') }}</td>
                            @endempty
                            
                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                            <td>{{ $value->active }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>   
                </table>
            </div>
        </div>
    </div>
        

@endsection