

    <ul class="list-unstyled">

        @foreach ($tags as $tag)

            <li class="media mb-3">

                <div class="media-body">


                    <div>
                        {{-- #タグの表示 --}}
                        <h3><span class="badge badge-success">#{{ $tag->name }}</span></h3>
                    </div>

                    <div>
                        {{-- タグづけした芸人 --}}
                        <p class="mb-0">                        
                        {!! link_to_route('entertainers.show', $entertainers[$loop->index]->name, ['id' => $entertainers[$loop->index]->id]) !!}
                		</p>
                    </div>
                
                </div>
            </li>

        @endforeach

    </ul>
