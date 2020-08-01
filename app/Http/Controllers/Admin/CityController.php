<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Common\BaseController as BaseController;
use App\Models\{ Country,State,City };
use Datatables;

class CityController extends BaseController {

    public function index(Request $request) {
      
        if ($request->ajax()) {

            $cities = City::with('state.country')->orderBy('id', 'DESC')->withTrashed()->get();

            return Datatables::of($cities)

            ->editColumn('status', function($data){

                return view('Admin.settings.datatables.status', compact('data'));
            })
            ->addColumn('action', function ($data) {

                return view('Admin.settings.datatables.actions.city', compact('data'));
            })
            ->addColumn('bulk_delete', function($data){

               return view('Admin.datatables.actions.bulk_delete', compact('data'));     
            })
            ->rawColumns(['status','action','bulk_delete'])
            ->addIndexColumn()
            ->make(true); 
        }

        $data['title'] = "Cities";

        return view('Admin.settings.cities.cities', $data);    
    }

    public function create(){
        
        $data['title'] = "Add City";
        $data['country'] = Country::where('status','1')->get();
        return view('Admin.settings.cities.add_city', $data); 
    }

    public function store(Request $request){

        $checkName = City::where('city_name' , strtolower($request->city_name) )->first();

        if(empty($checkName)){

            $data = City::insert([

                'city_name' => strtolower($request->city_name),
                'state_id' => (int)$request->state_id,
                'status'       => '1',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
                'deleted_at'   => null

            ]);

            return $this->sendResponse('The City has been added successfully');
        }else{
            
            return $this->sendError('Oops! The City name is already exists', 401);
        }
    }

    public function show($id){
        
    }

    public function edit(Request $request){
        
        $data['title'] = "Edit City";
        $id = $request->segment('3');
        $data['country'] = Country::where('status','1')->get();
        $data['city'] = City::with('state.country')->where('id',$id)->first();

        return view('Admin.settings.cities.edit_city', $data); 
    }

    public function update(Request $request){
        
        if(!empty($request->id)) {

            $data = City::where('id',$request->id)->update([

                'city_name'    => strtolower($request->city_name),
                'state_id'     => (int)$request->state_id,
                'status'       => '1',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
                'deleted_at'   => null

            ]);

            return $this->sendResponse('The City has been updated successfully');
        }
    }

    public function destroy($type,$id) {
        
        if (!empty($id)) {
          
            $data =  City::where('id',$id)->delete();
             
            if(!empty($data)){

               return $this->sendResponse('The City has been deleted successfully');
            
            }else{

               return $this->sendError('Oops! City not found', 401);
            }
        }
    }

    public function allCities(Request $request) {

        $data = City::where(['state_id' => $request->state_id])->get();

        if (count($data) > 0) {
            
            return $this->sendResponse('Great! Cities found', $data);
        
        }else{

            return $this->sendError('Oops! Cities not found', 401);
        }
    }
}
