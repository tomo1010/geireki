            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                    <img class="rounded img-fluid" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="お笑い大好き">
                    <hr>
                    出身：{!! link_to_route('lists.prefList', $user->birthplace, ['pref' => $user->birthplace]) !!}<br>

                    {{--同郷：{{$pref->name}}--}}
                    同郷：{!! link_to_route('perfomers.show', $pref->name, [$pref->id]) !!}
                            @if(!empty($pref->entertainer[0]->name))
                                @if (strcmp($pref->entertainer[0]->name, $pref->name) == 0 )
                                @else
                                    (<font size="small">{!! link_to_route('entertainers.show', $pref->entertainer[0]->name, $pref->entertainer[0]->id) !!}</font>)
                                @endif
                            @endif
                    <br>
                    <hr>
                    年齢：{!! link_to_route('lists.age2List', $now->diffInYears($user->birthday), ['yearsOld' => $now->diffInYears($user->birthday)]) !!}歳<br>

                    {{--同い年、コンビ名リンク、個人と芸人が同じ場合は表示しない--}}
                    同年：{!! link_to_route('perfomers.show', $age->name, [$age->id]) !!}
                            @if(!empty($age->entertainer[0]->name))
                                @if (strcmp($age->entertainer[0]->name, $age->name) == 0 )
                                @else
                                    (<font size="small">{!! link_to_route('entertainers.show', $age->entertainer[0]->name, $age->entertainer[0]->id) !!}</font>)
                                @endif
                            @endif
                </div>
            </div>