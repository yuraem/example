<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use File;
use App\Models\User;
use App\Models\Companies;

class CompanyController extends AdminBaseController
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
        $users = User::get();
        $companys = Companies::where($whereQuery)->where(function ($query) use ($searchQuery) {
            if ($searchQuery) {               
                $query->orWhere('geo', 'like', '%' . $searchQuery . '%');
                $query->orWhere('user_id', 'like', '%' . $searchQuery . '%');                
                $query->orWhere('company_kt', 'like', '%' . $searchQuery . '%');                
            }
        })->orderBy('created_at', 'desc')->paginate($this->perPage);

        return view('admin.company.index', compact('companys', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create', [
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
            'company_kt'    => 'required|integer|unique:companies',
            'user_id'       => 'required|integer|max:255',
            'geo'           => 'required|string|max:255',
            'options'       => 'string|max:1000',
            'short_script'  => 'string|max:255',
            'short_url'     => 'required|string|max:255',
            'short_script_2'=> 'required|string|max:255',
            'short_url_2'   => 'required|string|max:255',
        ]);

        $requestData = $request->all();

               
        $thanks = "thanks.js";       
        $index = "index.js";   
        
        $dir =  base_path('public/analitiks/'.$requestData['company_kt'].'/');

        File::deleteDirectory($dir); 
        
        if(!empty($dir.$thanks)){
            File::makeDirectory($dir, $mode = 0777, true, true);
        }       
        
        if(!File::exists($dir.$index)){
            $sourceIndex = base_path('public/analitiks/'.$index);
            $destinationIndex = base_path('public/analitiks/'.$requestData['company_kt'].'/'.$index);
            \File::copy($sourceIndex,$destinationIndex);
        }
        if(!File::exists($dir.$thanks)){
            $sourceThanks = base_path('public/analitiks/'.$thanks);
            $destinationThanks = base_path('public/analitiks/'.$requestData['company_kt'].'/'.$thanks);
            \File::copy($sourceThanks,$destinationThanks);
        }       

        if(!File::exists($dir.$index)){
            File::prepend($dir.$index,'(function () { const Url =  "'.$requestData['short_url_2'].'"+subid;');              
        }
        if(!File::exists($dir.$thanks)){
            File::prepend($dir.$thanks,'const Url = "'.$requestData['short_script_2'].'";');               
        }
       
        $model = new Companies($requestData);
        $model->save();

        return redirect()->route('admin.company.index')->with('success', __('Кампания успешно создана'));
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        return view('admin.company.edit', [
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
       
        $company = Companies::findOrFail( $id ?? null); //Get role specified by id
        
        $request->validate([ 
            'company_kt'    => 'required|integer|unique:companies,company_kt,'.$company->id,
            'user_id'       => 'required|integer|max:255',
            'geo'           => 'required|string|max:255',
            'options'       => 'string|max:1000',
            'short_script'  => 'string|max:255',
            'short_url'     => 'required|string|max:255',
            'short_script_2'=> 'required|string|max:255',
            'short_url_2'   => 'required|string|max:255',
        ]);

        $requestData = $request->all();   
                
        $index = 'index.js';   
        $thanks = 'thanks.js';    

        $dir =  base_path('public/analitiks/'.$requestData['company_kt'].'/');
        $dir_old =  base_path('public/analitiks/'.$requestData['company_kt_old'].'/');
       
        File::deleteDirectory($dir); 
        File::deleteDirectory($dir_old); 
        
        if(!empty($dir.$thanks)){
            File::makeDirectory($dir, $mode = 0777, true, true);
        }       
        
        if($dir.$index){
            $sourceIndex = base_path('public/analitiks/'.$index);
            $destinationIndex = base_path('public/analitiks/'.$requestData['company_kt'].'/'.$index);
            \File::copy($sourceIndex,$destinationIndex);
        }
        if($dir.$thanks){
            $sourceThanks = base_path('public/analitiks/'.$thanks);
            $destinationThanks = base_path('public/analitiks/'.$requestData['company_kt'].'/'.$thanks);
            \File::copy($sourceThanks,$destinationThanks);
        }       

        if($dir.$index){
            File::prepend($dir.$index,'(function () { const Url =  "'.$requestData['short_url_2'].'";');              
        }
        if($dir.$thanks){
            File::prepend($dir.$thanks,'const Url = "'.$requestData['short_script_2'].'";');                
        }
        
        $model = Companies::find(intval($id));
        $model->update($requestData);       

        return redirect()->route('admin.company.index')->with('success', __('Кампания успешно обновлена'));
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

        $dir =  base_path('public/analitiks/'.$model['company_kt'].'/');
        File::deleteDirectory($dir); 

        return redirect()->route('admin.company.index')->with('success', __('Кампания успешно удалена'));
    }
}
