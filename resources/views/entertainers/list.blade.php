@extends('layouts.app')

@section('content')

<h1>芸歴 {{ $year }} 年目</h1>

    <div class="container">
        <div class="row">
            <div class="col-lg-4">ピン芸人
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>活動時期</th>
                            <th>活動終了時期</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($results_1 as $value)
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}</td>
                            <td>{{ $value->active }}</td>
                            <td></td>
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
            <div class="col-lg-4">コンビ芸人
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>活動時期</th>
                            <th>活動終了時期</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($results_2 as $value)
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}</td>
                            <td>{{ $value->active->format('Y年～') }}</td>
                            <td></td>
                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                            <td>{{ $value->active->format('Y年～') }}</td>
                            <td>{{ $value->activeend->format('Y年') }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>   
                </table>
            </div>
            <div class="col-lg-4">トリオ芸人
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>活動時期</th>
                            <th>活動終了時期</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($results_3 as $value)
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}</td>
                            <td>{{ $value->active->format('Y年～') }}</td>
                            <td></td>
                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                            <td>{{ $value->active->format('Y年～') }}</td>
                            <td>{{ $value->activeend->format('Y年') }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>   
                </table>
            </div>
        </div>
    </div>
        

@endsection