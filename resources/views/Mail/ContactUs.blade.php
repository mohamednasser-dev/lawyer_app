<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>{{__("Reset Password")}}</title>
</head>
<body style="background-color: #f5f5f5; margin: 0; padding: 30px 0;">
<table align="center" width="600" callspacing="0" cellpadding="0" style="margin-top: 0; max-width: 600px; width: 100%;border-spacing: 0;">
    <tbody>
    <tr>
        <td style="padding: 30px 30px 0; text-align: center;">
            <img width="220px" height="120px" src="{{@asset('uploads/logo_mail.jpg')}}" alt="{{config('app.name')}}">
        </td>
    </tr>
    </tbody>
</table>
<table border="0" cellspacing="0" cellpadding="0" width="100%" style="border-spacing: 0;">
    <tr>
        <td></td>
        <td width="600">
            <table width="600" callspacing="0" cellpadding="0" style="margin-top: 30px; width: 600px; max-width: 600px; border-spacing: 0;">
                <thead>
                <tr>
                    <th align="center" colspan="2" class="top-border" style="margin:0; padding:0; background-color: #00aeef; border-radius: 30px 30px 0 0; text-align: center;" valign="top">
                        <img src="{{@asset('uploads/logo_mail.jpg')}}" alt="" width="100%">
                        <h3 class="text-large" style="color: #fff; font-family: Arial; font-size: 24px; margin-bottom: 20px; margin-top: 0;">
                            <b>Cotact message</b>
                        </h3>
                    </th>
                </tr>
                </thead>

                <tbody>
                <tr>
                    <td class="bottom-border" style="background-color: #fff;padding: 30px 30px 0;">
                         <table align="center" cellpadding="0" cellspacing="0" style="border-spacing:0; height:37px; margin-bottom:30px">

                            <tbody>
                            <tr >
                                 <td> الاسم : {{$data['name']}} </td>
                                 <td> البريد الاليكترونى : {{$data['email']}} </td>
                                 <td> رقم التلفون : {{$data['phone']}} </td>

                             </tr>
                            </tbody>
                        </table>
                      </td>
                </tr>
                <tr>
                    <td class="bottom-border">
                        <p>{!! $data['message'] !!}</p>

                    </td>
                </tr>
                <tr>
                    <td align="center" class="bottom-border" style="background-color: #fff; border-radius: 0 0 30px 30px;">
                        <img src="{{@asset('uploads/logo_mail.jpg')}}" alt="">
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
        <td></td>
    </tr>
</table>
</body>
</html>
