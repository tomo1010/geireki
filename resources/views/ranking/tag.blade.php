@extends('layouts.app')

@section('content')

<center><h1 class="mt-3 pb-0">Tagランキング</h1></center></br>

    @include('ranking.tag_tab')

    <div class="tab-content">
        

        {{--カテゴリーごとにtagCountsから芸人・tag件数を取得、tagNamesからtag名取得--}}
        
        {{--好き--}}
        <div id="category1" class="tab-pane active">

            @foreach($tagCounts as $category=>$tagCount)
    
                @if($category == '好き')

                    @foreach($tagCount as $tag)

                        <h3 class="mt-5 pb-2">
                        <button class="btn btn-success btn-lg m-1">#{{$tagNames['好き'][$loop->index]->name}}</button>
                        </h3>
                        
                        @include('ranking.tag_list')

                    @endforeach

                @endif

            @endforeach
            
        </div>


        {{--直感--}}
        <div id="category2" class="tab-pane">

            @foreach($tagCounts as $category=>$tagCount)
    
                @if($category == '直感')

                    @foreach($tagCount as $tag)

                        <h3 class="mt-5 pb-2">
                        <button class="btn btn-success btn-lg m-1">#{{$tagNames['直感'][$loop->index]->name}}</button>
                        </h3>
                        
                        @include('ranking.tag_list')

                    @endforeach

                @endif

            @endforeach
            
        </div>


        {{--面白い--}}
        <div id="category3" class="tab-pane">

            @foreach($tagCounts as $category=>$tagCount)
    
                @if($category == '面白い')

                    @foreach($tagCount as $tag)

                        <h3 class="mt-5 pb-2">
                        <button class="btn btn-success btn-lg m-1">#{{$tagNames['面白い'][$loop->index]->name}}</button>
                        </h3>
                        
                        @include('ranking.tag_list')

                    @endforeach

                @endif

            @endforeach
            
        </div>



        {{--見た目--}}
        <div id="category4" class="tab-pane">

            @foreach($tagCounts as $category=>$tagCount)
    
                @if($category == '見た目')

                    @foreach($tagCount as $tag)

                        <h3 class="mt-5 pb-2">
                        <button class="btn btn-success btn-lg m-1">#{{$tagNames['見た目'][$loop->index]->name}}</button>
                        </h3>
                        
                        @include('ranking.tag_list')

                    @endforeach

                @endif

            @endforeach
            
        </div>

        
        
        {{--芸人として--}}
        <div id="category5" class="tab-pane">

            @foreach($tagCounts as $category=>$tagCount)
    
                @if($category == '芸人として')

                    @foreach($tagCount as $tag)

                        <h3 class="mt-5 pb-2">
                        <button class="btn btn-success btn-lg m-1">#{{$tagNames['芸人として'][$loop->index]->name}}</button>
                        </h3>
                        
                        @include('ranking.tag_list')

                    @endforeach

                @endif

            @endforeach
            
        </div>        



        {{--売れる売れない--}}
        <div id="category6" class="tab-pane">

            @foreach($tagCounts as $category=>$tagCount)
    
                @if($category == '売れる売れない')

                    @foreach($tagCount as $tag)

                        <h3 class="mt-5 pb-2">
                        <button class="btn btn-success btn-lg m-1">#{{$tagNames['売れる売れない'][$loop->index]->name}}</button>
                        </h3>
                        
                        @include('ranking.tag_list')

                    @endforeach

                @endif

            @endforeach
            
        </div>


        {{--ネガティブ--}}
        <div id="category7" class="tab-pane">

            @foreach($tagCounts as $category=>$tagCount)
    
                @if($category == 'ネガティブ')

                    @foreach($tagCount as $tag)

                        <h3 class="mt-5 pb-2">
                        <button class="btn btn-success btn-lg m-1">#{{$tagNames['ネガティブ'][$loop->index]->name}}</button>
                        </h3>
                        
                        @include('ranking.tag_list')

                    @endforeach

                @endif

            @endforeach
            
        </div>

        
    </div>    

@endsection
