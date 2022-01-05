@extends('layouts.app')

@section('content')



<center><h1 class="mt-3 pb-0">{{ $office }} 所属の</h1><h1 class="mt-3 pb-2">芸人一覧</h1></center>
</br>
@include('commons.tab_combi')

    <div class="container">
        <div class="row">

            <div class="col-lg-4" id="1"><h2 class="mt-5 pb-2 display-5">ピン芸人</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>性別</th>
                            <th>芸歴</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($results_1 as $value)
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td nowrap>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}</td>
                            @include('commons.gender')                            

                            @empty($value->active)
                            <td></td>
                            @else
                            <td>{{$now->diffInYears($value->active)}}年目</td>
                            @endempty
                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td nowrap>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                            <td>{{ $value->active }}</td>
                            <td>{{ $value->activeend }}</td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>   
                </table>
            </div>
            
            
            <div class="col-lg-4" id="2"><h2 class="mt-5 pb-2 display-5">コンビ芸人</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>性別</th>
                            <th>芸歴</th>
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
                            <td>{{$now->diffInYears($value->active)}}年目</td>
                            @endempty
                            
                        </tr>
                        @else
                        <tr class="text-secondary">
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}（解散済）</td>
                            @include('commons.gender')                            
                            @empty($value->active)
                            <td></td>
                            @else
                            <td>{{$now->diffInYears($value->active)}}年目</td>
                            @endempty
                        </tr>
                        @endif
                        @endforeach
                    </tbody>   
                </table>
            </div>
            
            
            <div class="col-lg-4" id="3"><h2 class="mt-5 pb-2 display-5">トリオ芸人</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>
                            <th>性別</th>                            
                            <th>芸歴</th>
                        </tr>
                    </thead>
                     
                    <tbody>
                        @foreach ($results_3 as $value)
                        @if($value->activeend == NULL){{--解散済みの場合はグレー文字--}}
                        <tr>
                            <td>{!! link_to_route('entertainers.show', $value->name, [$value->id]) !!}</td>
                            @include('commons.gender')

                            @empty($value->active)
                            <td></td>
                            @else
                            <td>{{$now->diffInYears($value->active)}}年目</td>
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
        </div>
    </div>

</br>        
    @include('commons.tab_combi')

@endsection