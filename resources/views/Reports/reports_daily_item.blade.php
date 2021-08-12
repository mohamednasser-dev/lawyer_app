<tr>
    <td>{{$clients}}</td>
    <td>{{$khesm}}</td>
    <td>{{$result->cases->invetation_num}}</td>
    <td>{{$result->cases->circle_num}}</td>
    <td>{{$result->cases->inventation_type}}</td>
    <td>{{$result->cases->court}}</td>
    <td>{{$result->session_date}}</td>
    @if ($result->printnotes ==null)
        <td>----</td>
    @else
        <td>{{$result->printnotes->note}}</td>
    @endif
</tr>
