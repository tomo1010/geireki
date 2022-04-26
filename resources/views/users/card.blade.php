            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $user->name }}</h3>
                </div>
                <div class="card-body">
                    {{-- ユーザのメールアドレスをもとにGravatarを取得して表示 --}}
                    <img class="rounded img-fluid" src="{{ Gravatar::get($user->email, ['size' => 500]) }}" alt="お笑い大好き">
                    出身：{!! link_to_route('lists.prefList', $user->birthplace, ['pref' => $user->birthplace]) !!}<br>
                    年齢：{!! link_to_route('lists.age2List', $now->diffInYears($user->birthday), ['yearsOld' => $now->diffInYears($user->birthday)]) !!}歳

                </div>
            </div>