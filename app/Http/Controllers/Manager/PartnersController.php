<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Companies;

class PartnersController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $whereQuery = [];

        $statusFilter = $request->input('filter');
        if ($statusFilter) {
            switch ($statusFilter) {
                case 'active':
                    $whereQuery[] = ['blocked', 0];
                    break;
                case 'blocked':
                    $whereQuery[] = ['blocked', 1];
                    break;
                default:
                    break;
            }
        }

        $searchQuery = $request->input('q');
        if ($searchQuery) {
            $searchFilter[] = ['name', 'like', '%' . $searchQuery . '%'];
        }

        $auth_id = Auth::user()->id;
        $roles = User::getRoles();
        $users = User::where($whereQuery)
            ->where('ref', $auth_id)
            ->where(function ($query) use ($searchQuery) {
            if ($searchQuery) {               
                $query->orWhere('name', 'like', '%' . $searchQuery . '%');
                $query->orWhere('email', 'like', '%' . $searchQuery . '%');  
            }
        })->orderBy('created_at', 'desc')->paginate($this->perPage);

        return view('manager.partners.index', compact('users', 'roles'));
    }

    public function showAjax(Request $request, $id)
    {

        $whereQuery = [];
     
        $searchQuery = $request->input('q');
        if ($searchQuery) {
            $searchFilter[] = ['name', 'like', '%' . $searchQuery . '%'];
        }

        $user = User::where('id', $id)->first();       
        $companys = Companies::
            where('user_id', $user->id)->
            where($whereQuery)->where(function ($query) use ($searchQuery) {
            if ($searchQuery) {               
                $query->orWhere('geo', 'like', '%' . $searchQuery . '%');
                $query->orWhere('user_id', 'like', '%' . $searchQuery . '%');                
                $query->orWhere('company_kt', 'like', '%' . $searchQuery . '%');                
            }
        })->orderBy('created_at', 'desc')->paginate($this->perPage);  
        return $companys;
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {

        $whereQuery = [];

        $statusFilter = $request->input('filter');
        if ($statusFilter) {
            switch ($statusFilter) {
                case 'active':
                    $whereQuery[] = ['blocked', 0];
                    break;
                case 'blocked':
                    $whereQuery[] = ['blocked', 1];
                    break;
                default:
                    break;
            }
        }

        $searchQuery = $request->input('q');
        if ($searchQuery) {
            $searchFilter[] = ['name', 'like', '%' . $searchQuery . '%'];
        }

        $user = User::where('id', $id)->first();       
        $companys = Companies::
            where('user_id', $user->id)->
            where($whereQuery)->where(function ($query) use ($searchQuery) {
            if ($searchQuery) {               
                $query->orWhere('geo', 'like', '%' . $searchQuery . '%');
                $query->orWhere('user_id', 'like', '%' . $searchQuery . '%'); 
                $query->orWhere('short_url', 'like', '%' . $searchQuery . '%');                 
                $query->orWhere('company_kt', 'like', '%' . $searchQuery . '%');                
            }
        })->orderBy('created_at', 'desc')->paginate($this->perPage);

        return view('manager.partners.show', compact('companys', 'user'));
       
    }

    public function showStat(Request $request, $id)
    {

        $company = Companies::find(intval($id));
                    
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://185.179.190.205/admin_api/v1/report/build');
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Api-Key: 0b07aa0eac72d54e5ca1a9588d042abc'));
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
                $date_from = $request->date_from;
                $date_to = $request->date_to;

            $params = [
            'range' => [
                'interval' => 'custom_date_range',
                'timezone' => 'Asia/Yekaterinburg',
                'from' => $request->date_from,
                'to' => $request->date_to,
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
            'grouping'=>['datetime'],
            'filters'=>[['name'=>'campaign_id','operator'=>'EQUALS','expression'=> $company->company_kt]],
            'summary'=>true,
            'limit'=>100,
            'offset'=>0
            ];
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            $statistik = curl_exec($ch);
            $statistik = json_decode($statistik, true);

        $users = User::get();
        return view('manager.partners.showStat', [
            'company' => $company,
            'users' => $users,
            'statistik' => $statistik,
            'date_from' => $date_from,
            'date_to' => $date_to,
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
        //
    }
}
