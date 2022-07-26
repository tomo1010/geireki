                    @if ($loop->index == 0) {{--好き--}}
                
                        <div class="border-bottom-white" style="padding:10px;">好き</div> <!--下ボーダー -->
                                
                    @elseif($loop->index < 5)
                    
                    @elseif($loop->index == 5) {{--直感--}}
                
                        <div class="border-bottom-white" style="padding:10px;">直感</div> <!--下ボーダー -->
                        
                    @elseif($loop->index < 8)
                                
                    @elseif($loop->index == 8) {{--面白い--}}                

                        <div class="border-bottom-white" style="padding:10px;">面白い</div> <!--下ボーダー -->
                        
                    @elseif($loop->index < 11)
                    
                    @elseif($loop->index == 11) {{--見た目--}}            

                        <div class="border-bottom-white" style="padding:10px;">見た目</div> <!--下ボーダー -->
                        
                    @elseif($loop->index < 16)
                    
                    @elseif($loop->index == 16) {{--芸人らしい--}} 

                        <div class="border-bottom-white" style="padding:10px;">芸人らしい</div> <!--下ボーダー -->
                        
                    @elseif($loop->index < 18)
                    
                    @elseif($loop->index == 18) {{--売れる売れない--}} 

                        <div class="border-bottom-white" style="padding:10px;">売れる売れない</div> <!--下ボーダー -->
                        
                    @elseif($loop->index < 24)
                    
                    @elseif($loop->index == 24) {{--ネガティブ--}} 

                        <div class="border-bottom-white" style="padding:10px;">ネガティブ</div> <!--下ボーダー -->
                        
                    @elseif($loop->index < 29)
                    
                    @endif
