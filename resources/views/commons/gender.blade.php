        @if($value->gender == '1')
            <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/pinM.png" height="30"></td>
        @elseif($value->gender == '2')
            <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/pinF.png" height="30"></td>
        @elseif($value->gender == '11')
            <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/conbiM.png" height="30"></td>
        @elseif($value->gender == '12')
            <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/conbiMF.png" height="30"></td>
        @elseif($value->gender == '22')
            <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/conbiF.png" height="30"></td>                                
        @elseif($value->gender == '111')
            <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/trioM.png" height="30"></td>
        @elseif($value->gender == '222')
            <td><img src="https://blog-imgs-147.fc2.com/6/6/0/660/trioM.png" height="30"></td>
        @endif