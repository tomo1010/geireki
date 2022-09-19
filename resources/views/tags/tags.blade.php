

    <ul class="list-unstyled">

        @foreach ($entertainers as $tag=>$entertainers)

            <li class="media mb-3">

                <div class="media-body">


                    <div>
                        {{-- タグの表示 --}}
                        <h3><span class="badge badge-success">#{{$tag}}..</span></h3>
                    </div>

                    @foreach($entertainers as $entertainer)
                    <div>
                        {{-- タグづけした芸人--}}
                        <p class="mb-0">                        
                        {!! link_to_route('entertainers.show', $entertainer->name, ['id' => $entertainer->id]) !!}
                		</p>

                    </div>
                    @endforeach
                
                </div>
            </li>

        @endforeach

    </ul>
