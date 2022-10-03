@extends('layouts.app')

@section('content')


<center><h1 class="mt-3 pb-0">{{$pref}}出身の</h1><h1 class="mt-3 pb-2">芸人一覧</h1></center>


    <div class="container">
        <div class="row">
            <table class="table table-striped">

                <thead>
                    <tr>
                        <th>名前</th>
                        <th>出身地</th>
                        <th>芸歴</th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($perfomers as $perfomer)
                        
                        @if($perfomer->activeend == NULL){{--解散済みの場合はグレー文字--}}

                            <tr>

                                <td nowrap>
                                    @include('commons.perfomer_name')
                                    </br>
                                    @include('commons.perfomer_combiNameEqual')                                    
                                </td>
                                
                                {{--出身地と芸歴--}}
                                @include('lists.pref_common')

                            </tr>

                        @else
                        
                            <tr class="text-secondary">
                            
                                <td nowrap>
                                    @include('commons.perfomer_name')（引退済）
                                    </br>
                                    @include('commons.perfomer_combiNameEqual') 
                                </td>
                                
                                {{--出身地と芸歴--}}                                
                                @include('lists.pref_common')
                            
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