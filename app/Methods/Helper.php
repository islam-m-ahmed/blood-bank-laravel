<?php

namespace App\Methods;

use Illuminate\Http\JsonResponse;

trait Helper
{
    // api return method
    final public function responseJson($status, $message, $data = null): JsonResponse
    {
        $response = [
            'status' => $status,
            'message' => $message,
            'data' => $data
        ];
        return response()->json($response);
    }

    //fire base to push notifications
    function notifyByFirebase($title, $body, $tokens, $data = [], $is_notification = true)
    {
    // https://gist.github.com/rolinger/d6500d65128db95f004041c2b636753a
    // API access key from Google FCM App Console
        // env('FCM_API_ACCESS_KEY'));

    //    $singleID = 'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd';
    //    $registrationIDs = array(
    //        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
    //        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd',
    //        'eEvFbrtfRMA:APA91bFoT2XFPeM5bLQdsa8-HpVbOIllzgITD8gL9wohZBg9U.............mNYTUewd8pjBtoywd'
    //    );

    $registrationIDs = $tokens;

    // prep the bundle
    // to see all the options for FCM to/notification payload:
    // https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support

    // 'vibrate' available in GCM, but not in FCM
    // this in line 58  مش لزم ابعته عشان ببعت عن طريق داتا مش اشعار
        $fcmMsg = array(
            'body' => $body,
            'title' => $title,
            'sound' => "default",
            'color' => "#203E78"
        );
    // I haven't figured 'color' out yet.
    // On one phone 'color' was the background color behind the actual app icon.  (ie Samsung Galaxy S5)
    // On another phone, it was the color of the app icon. (ie: LG K20 Plush)

    // 'to' => $singleID ;      // expecting a single ID
    // 'registration_ids' => $registrationIDs ;     // expects an array of ids
    // 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
        $fcmFields = array(
            'registration_ids' => $registrationIDs,
            'priority' => 'high',
//            notification responsoble for run to mobile should not send
            'notification' => $fcmMsg,
            'data' => $data
        );
        if ($is_notification)
        {
            $fcmFields['notification'] = $fcmMsg;
        }

       //go to env and copy FIREBASE_API_ACCESS_KEY=
        //access key to send notifications
        $headers = array(
            'Authorization: key=' . env('FIREBASE_API_ACCESS_KEY'),
            'Content-Type: application/json'
        );

        $ch = curl_init();
        //link i will send notification with it
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        //header contain access key
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //params
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }


}








