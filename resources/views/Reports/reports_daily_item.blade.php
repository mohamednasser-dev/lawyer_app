<tr>
    <td>{{$report->client}}</td>
    <td>{{$report->khesm}}</td>
    <td>{{$report->cases->invetation_num}}</td>
    <td>{{$report->cases->circle_num}}</td>
    <td>{{$report->cases->inventation_type}}</td>
    <td>{{$report->cases->court}}</td>
    <td>{{$report->session_date}}</td>
    @if ($report->printnotes ==null)
        <td>----</td>
    @else
        <td>{{$report->printnotes->note}}</td>
    @endif
</tr>
