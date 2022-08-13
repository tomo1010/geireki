@extends('layouts.app')

@section('content')

    <ul class="nav nav-tabs justify-content-center">
    <li class="nav-item"><a href="#ageDiff" class="nav-link active" data-toggle="tab">コンビ年齢差</a></li>        
    <li class="nav-item"><a href="#yearDiff" class="nav-link" data-toggle="tab">芸歴と年齢差</a></li>            
    <li class="nav-item"><a href="#short" class="nav-link" data-toggle="tab">背が低い</a></li>
    <li class="nav-item"><a href="#tall" class="nav-link" data-toggle="tab">背が高い</a></li>    
    </ul>


    <div class="tab-content">

        <div id="ageDiff" class="tab-pane active">

            <div class="container">
                <div class="row">
                    <h2 class="mt-5 pb-2" >年齢差ランキング</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>名前</th>
                                <th>年の差</th>
                                <th>芸歴</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $key => $value)
                                @if($value > 5)
                                <tr>
                                    <td nowrap>{!! link_to_route('entertainers.show', $entertainers[$key]->name, [$entertainers[$key]->id]) !!}</td>
                                    <td>{{$value}}</td>
                                    <td>{!! link_to_route('lists.historyList', $now->diffInYears($entertainers[$key]->active), ['year' => $now->diffInYears($entertainers[$key]->active)]) !!}</td>
                                </tr>                            
                                @endif
                            @endforeach
                        </tbody>   
                    </table>
                </div>
            </div>

        </div>
  
        
        <div id="yearDiff" class="tab-pane">
            
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">    
                        <h2 class="mt-5 pb-2" >年齢をとってから芸人に</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>名前</th>
                                    <th>年齢</th>
                                    <th>芸歴</th>
                                    <th>差分</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($young as $key => $value)
                                    @if($value >= 30)
                                    <tr>
                                        <td nowrap>{!! link_to_route('perfomers.show', $perfomers[$key]->name, [$perfomers[$key]->id]) !!}<br>
                                        <td>{!! link_to_route('lists.age2List', $now->diffInYears($perfomers[$key]->birthday), ['yearsOld' => $now->diffInYears($perfomers[$key]->birthday)]) !!}</td>
                                        <td>{!! link_to_route('lists.historyList', $now->diffInYears($perfomers[$key]->active), ['year' => $now->diffInYears($perfomers[$key]->active)]) !!}</td>
                                        <td>{{ '$now->diffInYears($perfomers[$key]->birthday' }}</td>
                                    </tr>                            
                                    @endif
                                @endforeach
                            </tbody>   
                        </table>
                    </div>
        
        
                    <div class="col-lg-6">
                        <h2 class="mt-5 pb-2" >若い時から芸人に</h2>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>名前</th>
                                    <th>年齢</th>
                                    <th>芸歴</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($elderly as $key => $value)
                                    @if($value <= 15)
                                    <tr>
                                        <td nowrap>{!! link_to_route('perfomers.show', $perfomers[$key]->name, [$perfomers[$key]->id]) !!}</td>
                                        <td>{!! link_to_route('lists.age2List', $now->diffInYears($perfomers[$key]->birthday), ['yearsOld' => $now->diffInYears($perfomers[$key]->birthday)]) !!}</td>
                                        <td>{!! link_to_route('lists.historyList', $now->diffInYears($perfomers[$key]->active), ['year' => $now->diffInYears($perfomers[$key]->active)]) !!}</td>
                                    </tr>                            
                                    @endif
                                @endforeach
                            </tbody>   
                        </table>
                    </div>
                </div>
            </div>
       
        </div>

        
        <div id="short" class="tab-pane">
            
        <h2 class="mt-5 pb-2">背が低い芸人ランキング</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>名前</th>                    
                        <th>コンビ名など</th>                                        
                        <th>身長</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($shorts as $value)
                    @if(Empty($value->height))
                    @else
                        <tr>
                            <td>{!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}
                            <td>
                            @if(!empty($value->entertainer[0]->name))
                                {!! link_to_route('entertainers.show', $value->entertainer[0]->name, $value->entertainer[0]->id) !!}
                            @else
                            @endif    
                            </td>
                            <td>{{ $value->height }}</td>
                        </tr>
                    @endif    
                    @endforeach
                </tbody>
            </table>
        
        {{-- ページネーションのリンク --}}
        {{ $shorts->appends(request()->query())->links() }}   
        </div>


        <div id="tall" class="tab-pane">

        <h2 class="mt-5 pb-2">背が高い芸人ランキング</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>名前</th>                    
                        <th>コンビ名など</th>                                        
                        <th>身長</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($talls as $value)
                    @if(Empty($value->height))
                    @else
                        <tr>
                            <td>{!! link_to_route('perfomers.show', $value->name, ['id' => $value->id]) !!}
                            <td>
                            @if(!empty($value->entertainer[0]->name))
                                {!! link_to_route('entertainers.show', $value->entertainer[0]->name, $value->entertainer[0]->id) !!}
                            @else
                            @endif    
                            </td>
                            <td>{{ $value->height }}</td>
                        </tr>
                    @endif    
                    @endforeach
                </tbody>
            </table>
        
        {{-- ページネーションのリンク --}}
        {{ $shorts->appends(request()->query())->links() }}   
            
        </div>

    </div>
    

@endsection