<tr id="userRow{{$client->id}}">
    <td id="id{{$client->id}}">{{$client->id}}</td>
    <td id="client_name{{$client->id}}">{{$client->client_Name}}</td>
    <td>
        @php
            $user_type = auth()->user()->type;
            if($user_type == 'admin'){
        @endphp
        <a class="btn btn-danger" data-client-type="{{$client->type}}" id="deleteClient"
           data-mokel-id="{{$client->id}}"><i
                class="fa fa-times fa fa-white"></i></a>
        @php
            }
        @endphp
    </td>
</tr>
