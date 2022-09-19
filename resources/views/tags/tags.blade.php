

    <ul class="list-unstyled">

        @foreach ($entertainers as $key=>$tag)

            <li class="media mb-3">

                <div class="media-body">


                    <div>
                        {{-- #タグの表示 --}}
                        <h3><span class="badge badge-success">#{{ $key }}</span></h3>
                    </div>

                    @foreach($tag as $entertainer)
                    <div>
                        {{-- タグづけした芸人 --}}
                        <p class="mb-0">                        
                        {!! link_to_route('entertainers.show', $entertainer->name, ['id' => $entertainer->id]) !!}
                		</p>
                    </div>
                    @endforeach
                
                </div>
            </li>

        @endforeach

    </ul>
