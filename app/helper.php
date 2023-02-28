<?php

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

function formatValidationMessages($errors)
{
    return Arr::flatten($errors);
}
function getMediaUrl($path)
{
    return url('/uploads/'.$path);
}

function CheckAndDecodeJson($json)
{
    if(!isset($json) || $json == "")
        return [];

    return json_decode($json);
}

function hl_uploadFileTo($file,$path)
{
    $file_path = Storage::disk('public_images')->put($path, $file);
    return [
        'media_path' => $file_path,
        'media_url' => getMediaUrl($file_path)
    ];


}

function hl_deleteFile($file_path)
{
    return Storage::disk('public_images')->delete($file_path);
}

function calcPercentage($base,$number)
{

    if($base == 0)
        return 0;

    return intval($number * 100 / $base);
}


function formatDateAsName($date)
{
    $d    = new DateTime($date);
    return $d->format('l');
}

function GetReportDates($filter_name)
{
    if ($filter_name == "weekly")
    {
        $from_date = Carbon::yesterday()->subWeek(1);
        $to_date = Carbon::yesterday();
    }
    elseif ($filter_name == "monthly")
    {
        $from_date = Carbon::yesterday()->subMonth(1);
        $to_date = Carbon::yesterday();
    }
    elseif ($filter_name = "yesterday")
    {
        $from_date = Carbon::yesterday();
        $to_date = Carbon::today();
    }
    else
    {
        $from_date = Carbon::today();
        $to_date = Carbon::now();
    }

    return [
        'from_date' => $from_date,
        'to_date' => $to_date,
    ];
}


function getCsv($rows, $fileName = 'file.csv') {


    $columnNames = array_keys(current($rows));
    $columnNamesTrans = array_map(function($col){
        return trans('orders.'.$col);
    },$columnNames);



    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=" . $fileName,
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];



    $file = fopen($fileName, 'w');
    fputs( $file, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );
    fputcsv($file, $columnNamesTrans);
    foreach ($rows as $row) {
        if(isset($row["attributes"]))
            $row["attributes"]= formantAttributeArray($row["attributes"]);

        fputcsv($file, array_values($row));
    }
    fclose($file);



    return response()->download($fileName, 'sales-' . date('d-m-Y-H:i:s').'.csv', $headers)->deleteFileAfterSend(true);
}



function getCsvForOrders($collections, $fileName = 'file.csv') {

    $columnNames = ['رقم الطلب','تاريخ الطلب','الزبون','رقم الزبون','عنوان التوصيل','حالة الطلب','اسم المنتج','الكمية','السعر','المبلغ'];



    $headers = [
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=" . $fileName,
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];



    $file = fopen($fileName, 'w');
    fputs( $file, $bom = chr(0xEF) . chr(0xBB) . chr(0xBF) );
    fputcsv($file, $columnNames);
    $row_details=array();
    foreach ($collections as $collection) {

        foreach ($collection->details as $detail  ) {


            $row = [
                $collection->id, $collection->created_at,$collection->user->first_name . ' ' . $collection->user->last_name, $collection->user->phone, $collection->delivery_address ?? '', trans('orders.' . $collection->status)
                , $detail->product->name, $detail->quantity, $detail->paid_price, $detail->paid_price * $detail->quantity,
            ];
            fputcsv($file, array_values($row));
        }
    }
    fclose($file);

    return response()->download($fileName, 'orders-' . date('d-m-Y-H:i:s').'.csv', $headers)->deleteFileAfterSend(true);
}


function formantAttributeArray($attributes)
{
    if(!is_array($attributes))
        return;
    $result = '';
    foreach ($attributes as $attribute)
    {
        $result .= $attribute->attribute_name . ' : ' . $attribute->value . PHP_EOL;
    }

    return $result;
}


function formatNumber($number)
{
    return number_format($number);
}


function SendNotifications($notification,$tokens)
{
    $API_ACCESS_KEY = "AAAAxC8vko4:APA91bFCl0ByrMo6oGubF1sPFMHnkz_tK7bAVL8sEf1p7pCATSTjjBOKEIfWLNkTmD3KDDmAyLuoKBp6dRTpZkgiOpp41UKiogjt1_z4wT8xOvN2QPT_ULmFKeX8RlOmDDC9uQsBmizt";
    $url = 'https://fcm.googleapis.com/fcm/send';

    // prepare the message
    $fields = array(
        'registration_ids' => $tokens,
        'notification' => $notification

    );
    $headers = array(
        "Authorization: key=$API_ACCESS_KEY",
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL,$url);
    curl_setopt( $ch,CURLOPT_POST,true);
    curl_setopt( $ch,CURLOPT_HTTPHEADER,$headers);
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER,false);
    curl_setopt( $ch,CURLOPT_POSTFIELDS,json_encode($fields,true));
    $result = curl_exec($ch);
    curl_close($ch);
    return  $result;
}


function has_access ($slugs) {
    //dd(Auth::check());
    if (!Auth::user()->canDo($slugs)) {
        abort(403);
    }
    return true;
}

function invalidUserNameMessage()
{
    if(request()->has('lang') && request('lang') == "en")
        return "invalid username or password";
    if(request()->has('lang') && request('lang') == "ar")
        return "اسم المستخدم او كلمة المرور غير صحيحة";
}
function numberFromatToInteger($number)
{
    return  (int)str_replace(',','',$number);
}

function getCurrentCurrency($symbol = false)
{
    $result = 'ليرة سوري';
    if($symbol)
        $result = "SYP";
    return $result;
}
