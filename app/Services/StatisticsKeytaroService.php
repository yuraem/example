<?php

namespace App\Services;


class StatisticsKeytaroService
{

  public function stat($company,$request)
  {

    $myString = $request->daterange;
    $myArray = explode('/', $myString);
    
    $date_from = $myArray[0];
    $date_to = $myArray[1];
   
    $sub1 = $request->sub1;
    $sub2 = $request->sub2;
    $sub3 = $request->sub3;
    $sub4 = $request->sub4;
    $sub5 = $request->sub5; 
    $sub_id = $request->sub;

    $utm_source = $request->utm_source;
    $utm_campaign = $request->utm_campaign;
    $utm_content = $request->utm_content;
    $utm_term = $request->utm_term;
    $utm_medium = $request->utm_medium;
 

    
    if($sub1 !== null){
      $grouping = ['day', 'sub_id_1'];
      $filters = [
        ['name'=>'campaign_id','operator'=>'EQUALS','expression'=> $company->company_kt],
        ['name'=> 'sub_id_1' ,'operator'=>'EQUALS', 'expression'=> $sub1],
      ];      
    }elseif($sub2 !== null){
      $grouping = ['day', 'sub_id_2'];
      $filters = [
        ['name'=>'campaign_id','operator'=>'EQUALS','expression'=> $company->company_kt],
        ['name'=> 'sub_id_2' ,'operator'=>'EQUALS', 'expression'=> $sub2],
      ];  
    }elseif($sub3 !== null){
      $grouping = ['day', 'sub_id_3'];
      $filters = [
        ['name'=>'campaign_id','operator'=>'EQUALS','expression'=> $company->company_kt],
        ['name'=> 'sub_id_3' ,'operator'=>'EQUALS', 'expression'=> $sub3],
      ];  
    }elseif($sub4 !== null){
      $grouping = ['day', 'sub_id_4'];
      $filters = [
        ['name'=>'campaign_id','operator'=>'EQUALS','expression'=> $company->company_kt],
        ['name'=> 'sub_id_4' ,'operator'=>'EQUALS', 'expression'=> $sub4],
      ];  
    }elseif($sub5 !== null){
      $grouping = ['day', 'sub_id_5'];
      $filters = [
        ['name'=>'campaign_id','operator'=>'EQUALS','expression'=> $company->company_kt],
        ['name'=> 'sub_id_5' ,'operator'=>'EQUALS', 'expression'=> $sub5],
      ];  
    }elseif($utm_source !== null){
      $grouping = ['day', 'sub_id_6'];
      $filters = [
        ['name'=>'campaign_id','operator'=>'EQUALS','expression'=> $company->company_kt],
        ['name'=> 'sub_id_6' ,'operator'=>'EQUALS', 'expression'=> $utm_source],
      ];  
    }elseif($utm_campaign !== null){
      $grouping = ['day', 'sub_id_7'];
      $filters = [
        ['name'=>'campaign_id','operator'=>'EQUALS','expression'=> $company->company_kt],
        ['name'=> 'sub_id_7' ,'operator'=>'EQUALS', 'expression'=> $utm_campaign],
      ];  
    }elseif($utm_content !== null){
      $grouping = ['day', 'sub_id_8'];
      $filters = [
        ['name'=>'campaign_id','operator'=>'EQUALS','expression'=> $company->company_kt],
        ['name'=> 'sub_id_8' ,'operator'=>'EQUALS', 'expression'=> $utm_content],
      ];  
    }elseif($utm_term !== null){
      $grouping = ['day', 'sub_id_9'];
      $filters = [
        ['name'=>'campaign_id','operator'=>'EQUALS','expression'=> $company->company_kt],
        ['name'=> 'sub_id_9' ,'operator'=>'EQUALS', 'expression'=> $utm_term],
      ];  
    }elseif($utm_medium !== null){
      $grouping = ['day', 'sub_id_10'];
      $filters = [
        ['name'=>'campaign_id','operator'=>'EQUALS','expression'=> $company->company_kt],
        ['name'=> 'sub_id_10' ,'operator'=>'EQUALS', 'expression'=> $utm_medium],
      ];  
    }
    else{
      $grouping = ['day'];
      $filters = [['name'=>'campaign_id','operator'=>'EQUALS','expression'=> $company->company_kt]];
    }
        
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'http://185.179.190.205/admin_api/v1/report/build');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Api-Key: 0b07aa0eac72d54e5ca1a9588d042abc'));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   
    $params = [
    'range' => [
        'interval' => 'custom_date_range',
        'timezone' => 'Asia/Yekaterinburg',
        'from' => $myArray[0],
        'to' => $myArray[1],
    ],
    'columns' => [],
    'metrics'=> [
        'clicks',
        'campaign_unique_clicks',
        'conversions',
        'approve',                
        'rejected',
        'sales',
        'cr',
        'sale_revenue',
    ],
    'grouping' => $grouping,
    'filters' => $filters,
    'summary' => true,
    'limit' => 100,
    'offset' => 0
    ];
    
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    $statistik = curl_exec($ch);
    $statistik = json_decode($statistik, true); 
    
    return [$statistik, $date_from, $date_to, $sub_id] ;
  }
}