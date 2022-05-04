            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                    <img class="rounded img-fluid" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="お笑い大好き">

                    {{--誕生日--}}
                    <hr>
                    誕生日：{{$user->birthday}}<br>

                    {{--同じ誕生日--}}
                    同じ誕生日：
                    @empty($birthday)
                    @else
                        {!! link_to_route('perfomers.show', $birthday->name, [$birthday->id]) !!}
                        @if(!empty($birthday->entertainer[0]->name))
                            @if (strcmp($birthday->entertainer[0]->name, $birthday->name) == 0 )
                            @else
                                (<font size="small">{!! link_to_route('entertainers.show', $birthday->entertainer[0]->name, $birthday->entertainer[0]->id) !!}</font>)
                            @endif
                        @endif
                    @endempty
                    <br>

                    {{--出身ユーザ--}}
                    <hr>
                    出身：
                    @empty($user->pref)
                    @else                                            
                    {!! link_to_route('lists.prefList', $user->pref, ['pref' => $user->pref]) !!}<br>
                    @endempty        
                    
                    {{--出身同じ--}}
                    同郷：
                    @empty($pref)
                    @else                        
                        {!! link_to_route('perfomers.show', $pref->name, [$pref->id]) !!}
                        @if(!empty($pref->entertainer[0]->name))
                            @if (strcmp($pref->entertainer[0]->name, $pref->name) == 0 )
                            @else
                                (<font size="small">{!! link_to_route('entertainers.show', $pref->entertainer[0]->name, $pref->entertainer[0]->id) !!}</font>)
                            @endif
                        @endif
                    @endempty        
                    <br>

                    {{--年齢ユーザ--}}
                    <hr>
                    年齢：
                    @empty($age)
                    @else                        
                    {!! link_to_route('lists.age2List', $now->diffInYears($user->birthday), ['yearsOld' => $now->diffInYears($user->birthday)]) !!}歳<br>
                    @endempty        

                    {{--年齢同じ--}}
                    同年：
                    @empty($age)
                    @else                        
                        {!! link_to_route('perfomers.show', $age->name, [$age->id]) !!}
                        @if(!empty($age->entertainer[0]->name))
                            @if (strcmp($age->entertainer[0]->name, $age->name) == 0 )
                            @else
                                (<font size="small">{!! link_to_route('entertainers.show', $age->entertainer[0]->name, $age->entertainer[0]->id) !!}</font>)
                            @endif
                        @endif
                    @endempty        
                </div>
            </div>