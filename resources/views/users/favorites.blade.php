@extends('layouts.app')

@section('content')
    <div class="row">
        <aside class="col-sm-4">
            
            {{-- タブ --}}
            @include('users.card')
        
        </aside>
        
        <div class="col-sm-8">

            {{-- タブ --}}
            @include('users.navtabs')

            {{-- 投稿一覧 --}}
            @include('youtubes.youtubes')
        
        </div>
    </div>
@endsection

