@extends('layouts.app')

@section('content')

<center><h1 class="mt-3 pb-0">Tagランキング</h1></center></br>

    @include('ranking.tag_tab')

    <div class="tab-content">
        
        
        {{--好き--}}
        <div id="category1" class="tab-pane active">

            @for($i=0 ; $i<5 ; $i++)
            
                <h3 class="mt-5 pb-2">
                <button class="btn btn-success btn-lg m-1">#{{$tags[$i]->name}}</button>
                </h3>
                
                @include('ranking.tag_list')
            
            @endfor

        </div>
        
        
        {{--直感--}}
        <div id="category2" class="tab-pane">

            @for($i=5 ; $i<8 ; $i++)
            
                <h3 class="mt-5 pb-2">
                <button class="btn btn-success btn-lg m-1">#{{$tags[$i]->name}}</button>
                </h3>
                
                @include('ranking.tag_list')
            
            @endfor
            
        </div>    


        {{--面白い--}}
        <div id="category3" class="tab-pane">

            @for($i=8 ; $i<11 ; $i++)
            
                <h3 class="mt-5 pb-2">
                <button class="btn btn-success btn-lg m-1">#{{$tags[$i]->name}}</button>
                </h3>
                
                @include('ranking.tag_list')
            
            @endfor
            
        </div>


        {{--見た目--}}
        <div id="category4" class="tab-pane">

            @for($i=11 ; $i<16 ; $i++)
            
                <h3 class="mt-5 pb-2">
                <button class="btn btn-success btn-lg m-1">#{{$tags[$i]->name}}</button>
                </h3>
                
                @include('ranking.tag_list')
            
            @endfor
            
        </div>


        {{--芸人として--}}
        <div id="category5" class="tab-pane">

            @for($i=16 ; $i<18 ; $i++)
            
                <h3 class="mt-5 pb-2">
                <button class="btn btn-success btn-lg m-1">#{{$tags[$i]->name}}</button>
                </h3>
                
                @include('ranking.tag_list')
            
            @endfor
            
        </div>


        {{--売れる売れない--}}
        <div id="category6" class="tab-pane">

            @for($i=18 ; $i<24 ; $i++)
            
                <h3 class="mt-5 pb-2">
                <button class="btn btn-success btn-lg m-1">#{{$tags[$i]->name}}</button>
                </h3>
                
                @include('ranking.tag_list')
            
            @endfor
            
        </div>


        {{--ネガティブ--}}
        <div id="category7" class="tab-pane">

            @for($i=24 ; $i<29 ; $i++)
            
                <h3 class="mt-5 pb-2">
                <button class="btn btn-success btn-lg m-1">#{{$tags[$i]->name}}</button>
                </h3>
                
                @include('ranking.tag_list')
            
            @endfor
            
        </div>

    </div>
        
@endsection
