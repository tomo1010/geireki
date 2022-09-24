@extends('layouts.app')

@section('content')

<center><h1 class="mt-3 pb-0">Tagランキング</h1></center></br>

    @include('ranking.tag_tab')

    <div class="tab-content">
        
        
        {{--好き--}}
        <div id="category1" class="tab-pane active">

            @foreach($tagCounts as $category=>$tagCount)
    
                @if($category == '好き')

                    @foreach($tagCount as $tag)
                        
                        {{--@php
                        dd($tag[$loop->index]->tags[$loop->index]->name);
                        @endphp--}}


                        <h3 class="mt-5 pb-2">
                        <button class="btn btn-success btn-lg m-1">#{{$tag[0]->tags[0]->name}}</button>
                        </h3>
                        
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>芸人</th>                    
                                    <th>芸歴</th>                                        
                                    <th>数</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                {{--@php
                                    $i++;
                                    $value = 'tagCount_'.$i;
                                @endphp
                                --}}
                                @foreach ($tag as $entertainer)
                                
                                
                                    <tr>
                                        <td>
                                            @include('commons.entertainer_name')
                                        </td>
                                        <td>
                                            @include('commons.entertainer_history')
                                        </td>
                                        <td>
                                            {{$entertainer->tags_count}}
                                        </td>
                                    </tr>
                                @endforeach
                                {{--@php
                                    $i--;
                                @endphp--}}
                            </tbody>
                        </table>

                    @endforeach                    

                @endif

            @endforeach
            
        </div>
        
        

        
@endsection
