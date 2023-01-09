<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use File;
use App\Models\User;
use App\Models\Companies;

class CompanyController extends Controller
{
    protected $perPage = 15;
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

        $user = User::where('id', Auth::user()->id)->first();       
        $companys = Companies::
            where('user_id', $user->id)->
            where($whereQuery)->where(function ($query) use ($searchQuery) {
            if ($searchQuery) {               
                $query->orWhere('geo', 'like', '%' . $searchQuery . '%');
                $query->orWhere('user_id', 'like', '%' . $searchQuery . '%');                
                $query->orWhere('company_kt', 'like', '%' . $searchQuery . '%');                
            }
        })->orderBy('created_at', 'desc')->paginate($this->perPage);

        return view('user.company.index', compact('companys', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.company.create', [
            'company' => new Companies,
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
        $request->validate([ 
            'company_kt'    => 'required|integer',
            'user_id'       => 'required|integer|max:255',
            'geo'           => 'required|string|max:255',
            'options'       => 'string|max:1000',
            'short_script'  => 'required|string|max:255',
            'short_url'     => 'required|string|max:255',
            'short_script_2'=> 'required|string|max:255',
            'short_url_2'   => 'required|string|max:255',
        ]);

        $requestData = $request->all();

      
       
        $model = new Companies($requestData);
        $model->save();

        return redirect()->route('user.company.index')->with('success', __('Кампания успешно создана'));
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $company = Companies::find(intval($id));                 
           
        $users = User::get();
        return view('user.company.show', [
            'company' => $company,
            'users' => $users,            
        ]);
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
        return view('user.company.show', [
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
        $users = User::get();
        return view('user.company.edit', [
            'company' => Companies::find(intval($id)),
            'users' => $users,
        ]);
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
        
        $request->validate([ 
            'company_kt'    => 'required|integer',
            'user_id'       => 'required|integer|max:255',
            'geo'           => 'required|string|max:255',
            'options'       => 'string|max:1000',
            'short_script'  => 'required|string|max:255',
            'short_url'     => 'required|string|max:255',
            'short_script_2'=> 'required|string|max:255',
            'short_url_2'   => 'required|string|max:255',
        ]);

        $requestData = $request->all();   

        $file = File::make()->save(storage_puth('public/1.js'));

        $model = Companies::find(intval($id));
        $model->update($requestData);       

        return redirect()->route('user.company.index')->with('success', __('Кампания успешно обновлена'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Companies::find(intval($id));
        $model->delete();

        return redirect()->route('user.company.index')->with('success', __('Кампания успешно удалена'));
    }
}
