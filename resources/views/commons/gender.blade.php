        @if($value->gender == '1')
            <td><img src="/icon/g_pinM.png" height="30" alt="男性ピン芸人"></td>
        @elseif($value->gender == '2')
            <td><img src="/icon/g_pinF.png" height="30" alt="女性ピン芸人"></td>
        @elseif($value->gender == '11')
            <td><img src="/icon/g_conbiM.png" height="30" alt="男性コンビ芸人"></td>
        @elseif($value->gender == '12')
            <td><img src="/icon/g_conbiMF.png" height="30" alt="男女コンビ芸人"></td>
        @elseif($value->gender == '22')
            <td><img src="/icon/g_conbiF.png" height="30" alt="女性コンビ芸人"></td>                                
        @elseif($value->gender == '111')
            <td><img src="/icon/g_trioM.png" height="30" alt="男性トリオ芸人"></td>
        @elseif($value->gender == '222')
            <td><img src="/icon/g_trioM.png" height="30" alt="女性トリオ芸人"></td>
        @endif
        