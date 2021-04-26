<?php
namespace App\Http\Controllers\API;
use App\Clients;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Session_Notes;
use App\Case_client;
use App\attachment;
use App\Permission;
use App\Sessions;
use App\Cases;
use Validator;
use App\mohdr;
use App\User;
class casesApiController extends Controller
{
    //Cases Functions
    public function index(Request $request)
    {
        $api_token = $request->header('api_token');
        $user = User::where('api_token',$api_token)->first();
        if($user != null){
            $user_id= $user->id;
            $permission = Permission::where('user_id', $user_id)->first();
            $enabled = $permission->search_case;
            if ($enabled == 'yes') {
                $cases= null;
                if ($user->parent_id !=null) {
                    $cases = Cases::select('id','invetation_num','court','to_whome','parent_id')
                            ->where( 'to_whome' , $user->cat_id )
                            ->where( 'parent_id' , $user->parent_id )
                            ->with( 'Clients_custom' )
                            ->get();
                }else{
                    $cases = Cases::select('id','invetation_num','court','parent_id')
                            ->with('Clients_custom')
                            ->where('parent_id', '=',$user->id)
                            ->get();
                }
                return sendResponse(200, trans('site_lang.data_dispaly_success') ,$cases);
            }else{
                return sendResponse(401, trans('site_lang.permission_warrning'),null);
            }
        }else{
            return sendResponse(403, trans('site_lang.loginWarning'),null);
        }
    }
    public function store(Request $request)
    {
        $input = $request->all();
        $validate = null;
        $api_token = $request->header('api_token');
        $auth_user = User::where('api_token', $api_token)->first();
        if (empty($auth_user)) {
            return sendResponse(403, 'يرجى تسجيل الدخول ', null);
        }
        if ($auth_user->type == 'User') {
            $validate = Validator::make($request->all(), [
                'invetation_num' => 'required',
                'circle_num' => 'required',
                'first_session_date' => 'required',
                'inventation_type' => 'required',
                'descion' => 'required',
                'court' => 'required',
                'mokel_Names' => 'exists:clients,id',
                'khesm_Names' => 'exists:clients,id',
            ]);
            $input['to_whome'] = $auth_user->cat_id;
            $input['parent_id'] = $auth_user->parent_id;
        } else {
            $validate = Validator::make($request->all(), [
                'invetation_num' => 'required',
                'circle_num' => 'required',
                'first_session_date' => 'required',
                'inventation_type' => 'required',
                'descion' => 'required',
                'court' => 'required',
                'mokel_Names' => 'exists:clients,id',
                'khesm_Names' => 'exists:clients,id',
            ]);
            $data['to_whome'] = $request->to_whome;
            $input['parent_id'] = $auth_user->id;
        }
        if (!is_array($validate)) {
//                $input['parent_id']= getQuery();
            if ($request->mokel_Names != null && $request->khesm_Names != null) {
                $month = date('m', strtotime($request->first_session_date));
                $year = date('Y', strtotime($request->first_session_date));
//            // saving case data

                $case = Cases::create($input);
                $case['month'] = $month;
                $case['year'] = $year;
                $case->save();
                //saving session data
                $sessions = new Sessions();
                $sessions->session_date = $request->first_session_date;
                $sessions->case_Id = $case->id;
                $sessions->month = $month;
                $sessions->year = $year;

                if ($auth_user->parent_id != null) {
                    $sessions->parent_id = $auth_user->parent_id;
                } else {
                    $sessions->parent_id = $auth_user->id;
                }
                $sessions->save();
                // saving case clients data
                $res = array_merge($request->mokel_Names, $request->khesm_Names);
                foreach ($res as $client) {
                    Case_client::create(['case_id' => $case->id, 'client_id' => $client]);
                }
                return sendResponse(200, trans('site_lang.add_success') , $case);
            } else {
                return sendResponse(401, "من فضلك قم بافراغ خانه الموكلين والخصوم واخترهم",null);
            }

        } else {
            return sendResponse(401, $validate[0], null);
        }
    }
    public function update(Request $request)
    {
        $input = $request->all();
        $validate = Validator::make($input, [
            'case_id'=>'required|exists:cases,id',
            'invetation_num' => 'required',
            'circle_num' => 'required',
            'court' => 'required',
            'inventation_type' => 'required',
            'to_whome' => ''
        ]);
        if (!is_array($validate))
        {
            $api_token = $request->header('api_token');
            $auth_user = User::where('api_token',$api_token)->first();
            $id = $request->case_id;
             unset($input['case_id']);
            if(empty($auth_user)){
                $dataOut['status'] = false ;
                return sendResponse(403, trans('site_lang.loginWarning') , $dataOut );
            }else{
                    $case = Cases::where( 'id', $id )->update( $input );
                if($case == 1){
                    $dataOut['status'] = true ;
                    return sendResponse(200, trans('site_lang.updatSuccess')  , $dataOut );
                }else{
                    $dataOut['status'] = false ;
                    return sendResponse(401, 'يجب ادخال البيانات بشكل صحيح ' , $dataOut );
                }
            }
        }else{
            return sendResponse(401, $validate[0] ,null);
        }
    }
    public function caseData(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
                $case_data = Cases::select('id','invetation_num','inventation_type','circle_num','court','first_session_date')->where('id', $id )
                    ->first();
                $numbers['sessions_number'] = Sessions::where('case_Id', $id)->get()->count();
                $numbers['attachments_number'] = attachment::where('case_Id', $id)->get()->count();

                $ids = Sessions::where('case_Id', $id)->select('id')->get()->toArray();
                $numbers['notes_number'] = Session_Notes::whereIn('session_Id', $ids)->get()->count();

                $clients = Case_client::where('case_id',$id)->with('client_data')->whereHas('client_data',function ($query) {
                    $query->where('type', 'client');
                })->get();

                $khesm = Case_client::where('case_id',$id)->with('client_data')->whereHas('client_data',function ($query) {
                    $query->where('type', 'khesm');
                })->get();


                if($case_data != null){
                    return sendResponse(200, trans('site_lang.data_dispaly_success'),array( 'case_data' => $case_data , 'numbers' => $numbers
                    ,'clients' => $clients , 'khesm'=>$khesm ));
                }else{
                    return sendResponse(401,  'يجب اختيار دعوى بشكل صحيح ... !', null);
                }
        } else {
            return sendResponse(403,  trans('site_lang.loginWarning'), null);
        }
    }
    public function getSessionNotes(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
                $session_Notes = Session_Notes::query()->where('session_Id', $id)->orderBy('id', 'desc')->get();

                if($session_Notes != null){
                    return sendResponse(200, trans('site_lang.data_dispaly_success'), $session_Notes);
                }else{
                    return sendResponse(401,  'يجب اختيار جلسة .... !', null);
                }
        } else {
            return sendResponse(403,  trans('site_lang.loginWarning'), null);
        }
    }
    public function destroy(Request $request, $id)
    {
        $api_token = $request->header('api_token');
        $user = User::where('api_token', $api_token)->first();
        if ($user != null) {
            $permission = Permission::where('user_id', $user->id)->first();
            $enabled = $permission->search_case;
            if ($enabled == 'yes') {
                Case_client::where('case_id', $id)->delete();
                $caseSessions = Sessions::where('case_id', $id)->get();
                foreach ($caseSessions as $caseSessions) {
                    $session_note = Session_Notes::where('session_Id', $caseSessions->id)->delete();
                    $caseSessions->delete();
                }
                Cases::where('id', $id)->delete();
                return sendResponse(200, 'تم حذف الدعوى  بنجاح' ,null);
            } else {
                return sendResponse(401, trans('site_lang.permission_warrning'), null);
            }
        } else {
            return sendResponse(403, trans('site_lang.loginWarning'), null);
        }
    }
    //Case Clients Functions
    public function caseClientsData(Request $request)
    {
        $rules = [
            'api_token'=>'required',
            'case_id'=>'required|exists:cases,id',
        ];
        $validator = Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return sendResponse(401, 'يرجى تسجيل الدخول ',null);
        }
        else
        {
            $api_token = $request->input('api_token');
            $user = User::where('api_token',$api_token)->first();
            if($user != null){
                $user_id= $user->id;

                $permission = Permission::where('user_id', $user_id)->first();

                $enabled = $permission->search_case;
                if ($enabled == 'yes') {
                    $case = Cases::findOrFail($request->case_id);
                    $clients = $case->clients;

                    return sendResponse(200, trans('site_lang.data_dispaly_success') ,array('clients'=>$clients));
                } else {
                    return sendResponse(401, trans('site_lang.permission_warrning'),null);
                }
            }else{
                return sendResponse(403,trans('site_lang.loginWarning') ,null);
            }
        }
    }

}
