@extends('layouts.app')

@section('content')

    <h2 class="mt-5 pb-2 border-bottom">関連Youtube</h2>        
        @if (count($youtubes) > 0)
            <ul class="list-unstyled">
                @foreach ($youtubes as $value)
                    <li class="media mb-3">
                        {{-- 投稿の所有者のメールアドレスをもとにGravatarを取得して表示 --}}
                        <img class="mr-2 rounded" src="{{ Gravatar::get($value->user->email, ['size' => 50]) }}" alt="">
                        <div class="media-body">

                            <div>
                                {{-- 投稿の所有者のユーザ詳細ページへのリンク --}}
                                {!! link_to_route('users.show', $value->user->name, ['user' => $value->user->id]) !!}
                                <span class="text-muted">posted at {{ $value->created_at }}</span>
                            </div>
 
                            <div>
                                {{-- 投稿内容 --}}
                                <p class="mb-0">{!! nl2br(e($value->youtube)) !!}</p>
                            </div>
                            
                            <div>
                                @if (Auth::id() == $value->user_id)
                                    {{-- 投稿削除ボタンのフォーム --}}
                                    {!! Form::open(['route' => ['youtubes.destroy', $value->id], 'method' => 'delete']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                @endif
                            </div>
                            
                        </div>
                    </li>
                @endforeach
            </ul>
            {{-- ページネーションのリンク --}}
            {{ $youtubes->links() }}
        @endif
        
@endsection