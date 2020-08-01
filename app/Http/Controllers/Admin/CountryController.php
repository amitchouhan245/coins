<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Common\BaseController as BaseController;
use App\Models\{ Country,Instruction };
use Datatables;

class CountryController extends BaseController{
    
    public function index(Request $request){

        if ($request->ajax()) {

            $countries = Country::orderBy('id', 'DESC')->withTrashed()->get();
  
            return Datatables::of($countries)

            ->editColumn('status', function($data){

                return view('Admin.settings.datatables.status', compact('data'));

            })
            ->addColumn('action', function ($data) {

                return view('Admin.settings.datatables.actions.country', compact('data'));
            })
            ->addColumn('bulk_delete', function($data){

               return view('Admin.datatables.actions.bulk_delete', compact('data'));     
            })
            ->rawColumns(['status','action','bulk_delete'])
            ->addIndexColumn()
            ->make(true); 
        }

        $data['title'] = "Countries";
        return view('Admin.settings.countries.countries', $data);
    }
 
    public function create() {
        
       $data['title'] = "Add-Country";
       return view('Admin.settings.countries.add_country', $data);   
    }

    public function store(Request $request){  

        $checkName = Country::where('country_name' , strtolower($request->country_name) )->first();

        if(empty($checkName)){

            $data = Country::insert([
             
                'country_name' => strtolower($request->country_name),
                'status'       => '1',
                'created_at'   => date('Y-m-d H:i:s'),
                'deleted_at'   => null
            ]);

            return $this->sendResponse('The Country has been added successfully');

        }else{
            
            return $this->sendError('Oops! The country name is already exists', 401);
        }
    }

    public function edit(Request $request){

        $data['title'] = "Edit Country";
        $id = $request->segment('3');
        $data['country'] = Country::where('id',$id)->first();

        return view('Admin.settings.countries.edit_country', $data); 
    }

    public function update(Request $request){     
        
        if(!empty($request->id)){

            $data = Country::where('id',$request->id)->update([
              
                'country_name' => strtolower($request->country_name),
                'status'       => '1',
                'updated_at'   => date('Y-m-d H:i:s'),
                'deleted_at'   => null
            ]);

            return $this->sendResponse('The Country has been updated successfully');
        }
    }
}
