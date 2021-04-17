// global app configuration object
var config = {
    trans: {
        cat_id: "{{trans('usersValidations.to_whome')}}",
        inventation_type: "{{trans('usersValidations.inventation_type')}}",
        session_Date: "{{trans('usersValidations.first_session_date')}}",
        court_mohdareen: "{{trans('usersValidations.court')}}",
        paper_type: "{{trans('usersValidations.paper_type')}}",
        deliver_data: "{{trans('usersValidations.deliver_data')}}",
        paper_Number: "{{trans('usersValidations.paper_Number')}}",
        notes: "{{trans('usersValidations.notes')}}",
        circle_num: "{{trans('usersValidations.circle_num')}}",
        case_number: "{{trans('usersValidations.invetation_num')}}",
        btn_add_text: "{{trans('site_lang.public_add_btn_text')}}",
        add_mohdr_modal_title: "{{trans('site_lang.mohdar_add_mohdar')}}",
        add_public_btn: "{{trans('site_lang.public_add_btn_text')}}",
        edit_public_btn: "{{trans('site_lang.public_edit_btn_text')}}",
        delete_public_btn: "{{trans('site_lang.public_delete_text')}}",
        public_continue_delete_modal_text: "{{trans('site_lang.public_continue_delete_modal_text')}}",
        edit_mohdr_modal_title: "{{trans('site_lang.mohdar_edit_mohdar')}}",
        add_mohdr_route: "{{route('mohdareen.store')}}",
        update_mohdr: "{{ route('mohdareen.update') }}",
        get_mohdareen: "{{ route('mohdareen.index') }}",
        get_mohdareen_clients: "{{route('getClients')}}",

    }
};
