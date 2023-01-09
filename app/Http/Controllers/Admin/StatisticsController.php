<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use App\Services\StatisticsKeytaroService;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Companies;
use Carbon\Carbon;

class StatisticsController extends AdminBaseController
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
            ->where(function ($query) use ($searchQuery) {
            if ($searchQuery) {               
                $query->orWhere('name', 'like', '%' . $searchQuery . '%');
                $query->orWhere('email', 'like', '%' . $searchQuery . '%');  
            }
        })->orderBy('created_at', 'desc')->paginate($this->perPage);

        return view('admin.statistics.index', compact('users', 'roles'));
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
            $searchFilter[] = ['short_url', 'like', '%' . $searchQuery . '%'];
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

        return view('admin.statistics.show', compact('companys', 'user'));

    }

    public function showComp(Request $request, $id)
    {      

        $company = Companies::find(intval($id));                 
        $sub = Companies::getSub();

        $users = User::get();
        return view('admin.statistics.showStat', [
            'company' => $company,
            'users' => $users, 
            'sub' => $sub, 
            'subid' => $request->sub,          
        ]);
    }

    public function showStat(Request $request, StatisticsKeytaroService $service, $id)
    {

        $company = Companies::find(intval($id));
        $users = User::get(); 
        $sub = Companies::getSub();       
        
        $utm_source = $request->utm_source;
        $utm_campaign = $request->utm_campaign;
        $utm_content = $request->utm_content;
        $utm_term = $request->utm_term;
        $utm_medium = $request->utm_medium;
        $sub2 = $request->sub2;
        $sub3 = $request->sub3;
        $sub4 = $request->sub4;
        $sub5 = $request->sub5;

        $statistik = $service->stat($company, $request);   
       
        return view('admin.statistics.showStat', [
            'company' => $company,
            'users' => $users,           
            'sub' => $sub,
            'utm_source' => $utm_source,
            'utm_campaign' => $utm_campaign,
            'utm_content' => $utm_content,
            'utm_term' => $utm_term,
            'utm_medium' => $utm_medium,
            'sub2' => $sub2,
            'sub3' => $sub3,
            'sub4' => $sub4,
            'sub5' => $sub5,
            'subid' => $statistik[3],
            'statistik' => $statistik[0],
            'date_from' =>  date('d-m-Y', strtotime($statistik[1])),
            'date_to' => date('d-m-Y', strtotime($statistik[2])),
        ]);
    }

}