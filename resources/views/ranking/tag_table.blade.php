
                            
                            
                            
                            
                                            <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>芸人</th>                    
                            <th>芸歴</th>                                        
                            <th>数</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @php
                            $i++;
                            $value = 'tagCount_'.$i;
                        @endphp
                        @foreach ($$value as $entertainer)
                            <tr>
                                <td>
                                    @include('commons.entertainer_name')
                                </td>
                                <td>
                                    @include('commons.entertainer_history')
                                </td>
                                <td>
                                    {{$entertainer->tags_count}}
                                </td>
                            </tr>
                        @endforeach
                        @php
                            $i--;
                        @endphp
                    </tbody>
                </table>