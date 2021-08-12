<tr>
    <td>{{$data->client}}</td>
    <td>{{$data->khesm}}</td>
    <td>{{$data->cases->invetation_num}}</td>
    <td>{{$data->cases->circle_num}}</td>
    <td>{{$data->cases->inventation_type}}</td>
    <td>{{$data->cases->court}}</td>
    <td>{{$data->session_date}}</td>
    @if ($data->printnotes ==null)
        <td>----</td>
    @else
        <td>{{$data->printnotes->note}}</td>
    @endif
</tr>
