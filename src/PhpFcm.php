<?php
/**
 * Created by PhpStorm.
 * User: Antonio
 * Date: 15/10/2019
 * Time: 01:07 PM
 */

namespace  JoalmLibrary\PhpFcm;

class PhpFcm
{   


    public function __construct(){
        
    }


    public static function Send($title, $message, $token,$sound){
        $endpoint = env('FCM_ENDPOINT');
        $fcm_key = env('FCM_KEY');
        $ch = curl_init($endpoint);
        $header = array('Content-Type: application/json',"Authorization: key=". $fcm_key);
        $notification = [];
        $notification['registration_ids'] = $token;
        $notification['notification'] = array('title' => $title,'body' => $message, 'icon' => 'farmapp_new','sound' => 'my_sound.caf');
        $notification['data'] = array('notification_foreground' => true);

        $data_for_push = array(
            'param1' => 1,
            'param2' => 8477,
            'param3' => 0
        );

        $notification['data'] = array_merge($notification['data'],$data_for_push);

        if(isset($image))
            $notification['notification'] = array_merge($notification['notification'],array('image' => $image));
        if(isset($data))
            $notification['data'] = array_merge($notification['data'],$data);

        $notification['android'] = array('notification' => array('sound' => 'my_sound', 'channel_id' => 'general'));
        $notification['apns'] = array('payload' => array('aps' => array('content-available' => 1), 'acme1' => 'bar','acme2' => 42));
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($notification,JSON_UNESCAPED_SLASHES));
        $result= curl_exec($ch);
        curl_close($ch);
        return true;
    }

    public static function SendNotification($title, $description, $tokens,$image,$data){
        $endpoint = env('FCM_ENDPOINT');
        $fcm_key = env('FCM_KEY');
        $ch = curl_init($endpoint);
        $header = array('Content-Type: application/json',"Authorization: key=". $fcm_key);
        $notification = [];
        $notification['registration_ids'] = $tokens;
        $notification['notification'] = array('title' => $title,'body' => $description, 'icon' => 'farmapp_new','sound' => 'my_sound.caf');
        $notification['data'] = array('notification_foreground' => true);
    
        if(isset($image))
            $notification['notification'] = array_merge($notification['notification'],array('image' => $image));
        if(isset($data))
            $notification['data'] = array_merge($notification['data'],$data);

        $notification['android'] = array('notification' => array('sound' => 'my_sound', 'channel_id' => 'general'));
            
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($notification,JSON_UNESCAPED_SLASHES));
        $result= curl_exec($ch);
        curl_close($ch);
        return true;
    }

    public static function SendEcho($data){
        $endpoint = env('FCM_ENDPOINT');
        $fcm_key = env('FCM_KEY');
        $ch = curl_init($endpoint);
        $header = array('Content-Type: application/json',"Authorization: key=". $fcm_key);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $result= curl_exec($ch);
        curl_close($ch);
        return true;
    }
}