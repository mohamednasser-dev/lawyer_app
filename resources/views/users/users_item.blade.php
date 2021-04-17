<tr id="userRow{{$user->id}}">
    <td class="py-1 center">
        <p id="userId{{$user->id}}">{{$user->id}}</p>
    </td>
    <td class="hidden-xs center"><p id="userName{{$user->id}}">{{$user->name}}</p></td>
    <td class="hidden-xs center"><p id="userEmail{{$user->id}}">{{$user->email}}</p></td>
    <td class="hidden-xs center"><p id="userType{{$user->id}}">{{$user->type}}</p></td>
    <td>
        <div class="example">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <a class="btn btn-outline-primary" data-user-id="{{$user->id}}" id="editUser">
                {{trans('site_lang.public_edit_btn_text')}}
            </a>
            <a class="btn btn-outline-danger" data-user-id="{{$user->id}}" id="deleteUser">
                {{trans('site_lang.public_delete_text')}}
            </a>

            <a href="{{url('permission/'.$user->id.'/edit')}}" class="btn btn-outline-warning"
            >{{trans('site_lang.permission')}}</a>
        </div>
    </td>
</tr>
