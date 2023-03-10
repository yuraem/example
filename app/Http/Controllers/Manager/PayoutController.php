<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Companies;
use App\Models\Payout;
use Carbon\Carbon;

class PayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id =  Auth::user()->id;
        $user =  User::where('id', $id)->first();
        $payouts = Payout::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(15);
        $statistik = [];
        return view('manager.payout.show', [
            'payouts' => $payouts,
            'user' => $user,
            'statistik' => $statistik,
        ]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::get();
        return view('manager.payout.create',[            
            'user' => $user,            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request1 = array( 
            'user_id'           => 'integer',            
            'period'            => 'string',
            'amount'            => 'numeric',
            'percent'           => 'numeric',
            'balance'           => 'numeric',
            'income'            => 'string|max:255',
            'valute'            => 'string|max:3',
            'payment_system'    => 'string',
            'wallet'            => 'string|max:255',
            'description'       => 'max:255',   
            'status'            => 'max:1' 
        );


        $request->validate([ 
            'user_id'           => 'integer',            
            'period'            => 'string',
            'amount'            => 'numeric',
            'percent'           => 'numeric',
            'balance'           => 'numeric',
            'income'            => 'string|max:255',
            'valute'            => 'string|max:3',
            'payment_system'    => 'string',
            'wallet'            => 'string|max:255',
            'description'       => 'max:255',   
            'status'            => 'max:1',   
        ]);
       
        $requestData = $request->all();

        if (!$requestData) {
            dd($requestData);
            return redirect()->route('manager.payout.index')->with('success', __('????????????'));
        
        }

        $model = Payout::create($requestData);
       
        $model->save();

        return redirect()->route('manager.payout.show', $request->user_id)->with('success', '???????????? ?????????????? ????????????');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $payouts = Payout::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(15);
        $statistik = [];
       
        return view('manager.payout.show', [
            'payouts' => $payouts,
            'user' => $user,
            'statistik' => $statistik,
        ]);
    }


    public function showStat(Request $request, $id)
    {

        $company = Companies::where('user_id', $id)->get();
        $user = User::where('id', $id)->first(); 
        $payouts = Payout::where('user_id', $id)->orderBy('created_at', 'desc')->paginate(15);

        $myString = $request->period;
        $myArray = explode('/', $myString);
       
        $company1 = [];
        foreach($company as $stat){
                $company1[]  .= $stat["company_kt"];
        }

        $companys = json_encode($company1);

        $grouping = ['sub_id_2'];
        $filters = [
            ['name'=>'campaign_id','operator'=>'IN_LIST','expression'=> $company1]           
        ];  
      

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
       
       
        return view('manager.payout.show', [
            'payouts' => $payouts,
            'company' => $company,
            'user' => $user,
            'statistik' => $statistik,
            'date_from' =>  date('d-m-Y', strtotime($myArray[0])),
            'date_to' => date('d-m-Y', strtotime($myArray[1])),
        ]);
    }

    public function showBalance(Request $request, $id)
    {

        $company = Companies::where('user_id', $id)->get();
        $user = User::where('id', $id)->first(); 
        $payout = Payout::where('user_id', $id)->orderBy('created_at', 'desc')->first();

        if($company->count() == 0){
            return redirect()->route('manager.index')->with('success', '?? ???????????????????????? ?????? ???????????????? !!!');
        }
        
        if($payout == null){
            $date_to = Carbon::now()->format('d-m-Y');
            $date_from = date('d-m-Y', strtotime($date_to . ' -10 day')) ;
        }else{
            $myString = $payout->period;
            $myArray = explode('/', $myString);
            $date_from = date('d-m-Y', strtotime($myArray[1] . ' +1 day'));
            $date_to = Carbon::now()->format('d-m-Y');
        }
       
        $company1 = [];
        foreach($company as $stat){
                $company1[]  .= $stat["company_kt"];
        }


        $grouping = ['sub_id_2'];
        $filters = [
            ['name'=>'campaign_id','operator'=>'IN_LIST','expression'=> $company1]           
        ];  
      

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://185.179.190.205/admin_api/v1/report/build');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Api-Key: 0b07aa0eac72d54e5ca1a9588d042abc'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        $params = [
        'range' => [
            'interval' => 'custom_date_range',
            'timezone' => 'Asia/Yekaterinburg',
            'from' => $date_from,
            'to' => $date_to,
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
        $sale_revenue_balance = $statistik['summary']['sale_revenue'];
       
        $user->balance = $sale_revenue_balance;
        $user->save();
      
        return view('manager.main.index', [
            'user' => $user,
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payout = Payout::where('id', '=', $id)->first();
       
        if ($payout != null) {

            $user_id = $payout->user_id;       

            $payout->delete();            
        }      
       
       
        return redirect()->route('manager.payout.show', $user_id)->with('success', '?????????????? ??????????????');
   
    }
}
