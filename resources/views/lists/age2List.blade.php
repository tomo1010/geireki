@extends('layouts.app')

@section('content')


    <center><h1 class="mt-5 pb-2">{{$yearsOld}}歳の芸人一覧</h1></center>


    <p><center>
        {!! link_to_route('lists.age2List', '<<1歳年上', ['yearsOld' => $yearsOld+1],['class' => 'btn btn-outline-success']) !!}　
        {!! link_to_route('lists.age2List', '1歳年下>>', ['yearsOld' => $yearsOld-1],['class' => 'btn btn-outline-success']) !!}
    </center></p>


    <div class="container">
        <div class="row">
            <table class="table table-striped">

                <thead>
                    <tr>
                        <th>名前</th>
                        <th>年齢</th>
                        <th>芸歴</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($perfomers as $perfomer)

                    @if($perfomer->activeend == NULL){{--解散済みの場合はグレー文字--}}

                        <tr>
                            {{--個人名表示--}}                            
                            <td nowrap>
                                @include('commons.perfomer_name')
                                </br>
                                @include('commons.perfomer_combiNameEqual')                                
                            </td>
                            
                            @include('lists.age_common')
                        
                        </tr>

                    @else

                        <tr class="text-secondary">
                            {{--個人名表示（引退済み）--}}                            
                            <td nowrap>
                                @include('commons.perfomer_name')（引退済）
                                </br>
                                @include('commons.perfomer_combiNameEqual')                                 
                            </td>
                            
                            @include('lists.age_common')
                        
                        </tr>

                    @endif

                    @endforeach
                </tbody>   

            </table>
        </div>
    </div>

    {{-- ページネーションのリンク --}}
    {{ $perfomers->appends(request()->query())->links() }}        

@endsection