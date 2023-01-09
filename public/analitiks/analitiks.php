<?php



// $params = [
//   "id" => 1887,
  // "columns"=>[],
  // "metrics"=>["clicks","campaign_unique_clicks","conversions","roi_confirmed"],
  // "grouping"=>["campaign"],
  // "filters"=>[],
  // "summary"=>true,
  // "limit"=>100,
  // "offset"=>0
//  ];

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'http://185.179.190.205/admin_api/v1/campaigns/1887');
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Api-Key:31ab91a888b6e8835b4fb1bc4902c688','Accept:application/json','Content-Type: application/json'));
// // curl_setopt($ch, CURLOPT_POST, true);
// // curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// echo curl_exec($ch);
// console.log(curl_exec($ch));




$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://185.179.190.205/admin_api/v1/report/build');
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Api-Key: 31ab91a888b6e8835b4fb1bc4902c688'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// $params = [
// 'range' => [
// 'from' => '2022-10-10',
// 'to' => '2022-10-19',
// 'timezone' => 'Asia/Yekaterinburg'
// ],
// 'grouping' => ['ts', 'landing'],
// 'metrics' => ['clicks', 'bot_share', 'cr'],
// 'filters' => [
// ['name' => 'campaign_id', 'operator' => 'EQUALS', 'expression' => 1882],
// ['name' => 'stream_id', 'operator' => 'EQUALS', 'expression' => 8],
// ]
// ];
$params = [
  'range' => [
    'interval' => '7_days_ago',
    'timezone' => 'Asia/Yekaterinburg'
  ],
  'columns' => [],
  'metrics'=> [
    'clicks',
    'campaign_unique_clicks',
    'conversions',
    'revenue',
    'rejected',
    'sales',
    'cr'
  ],
  'grouping'=>[],
  'filters'=>[['name'=>'campaign_id','operator'=>'EQUALS','expression'=>1888]],
  'summary'=>true,
  'limit'=>100,
  'offset'=>0
];
// echo $params;
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
echo curl_exec($ch);




// console.log($params);


// $params = [
//   "start_date" => "2022-10-18",
//   "end_date"=> "2022-10-19",
//   "timezone"=> "UTC"
//   ];
  // $ch = curl_init();
  // curl_setopt($ch, CURLOPT_URL, 'http://birresud.ga/admin_api/v1/clicks/clean');
  // curl_setopt($ch, CURLOPT_HTTPHEADER, array('Api-Key: 31ab91a888b6e8835b4fb1bc4902c688'));
  // curl_setopt($ch, CURLOPT_POST, true);
  // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
  // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  // echo curl_exec($ch);



// $df= [
//  "range" => [
//   "interval"=>"7_days_ago",
//   "timezone"=>"Asia/Yekaterinburg"
//  ],
//  "columns"=>[],
//  "metrics"=>["clicks","campaign_unique_clicks","conversions","roi_confirmed"],
//  "grouping"=>["campaign"],
//  "filters"=>[],
//  "summary"=>true,
//  "limit"=>100,
//  "offset"=>0
// ];
// $get = [
 
//   ];
 
// $ch = curl_init('https://keitarosupport1.xyz/admin_api/v1/campaigns?' . http_build_query($get));
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Api-Key:31ab91a888b6e8835b4fb1bc4902c688'));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
// curl_setopt($ch, CURLOPT_HEADER, false);
// $html = curl_exec($ch);
// curl_close($ch);
 
// echo $html;

// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, 'http://keitarosupport1.xyz/admin_api/v1/affiliate_networks');
// curl_setopt($ch, CURLOPT_HTTPHEADER, array('Api-Key: 31ab91a888b6e8835b4fb1bc4902c688'));
// curl_setopt($ch, CURLOPT_POST, 1);
// // $params = ["name" => "test", "postback_url" => "https://focs.emsot.com/"];
// // curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// echo curl_exec($ch);
