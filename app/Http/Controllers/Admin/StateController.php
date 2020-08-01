<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\Common\BaseController as BaseController;
use App\Models\{ Country,State };
use Datatables;


class StateController extends BaseController{
    
    public function index(Request $request){
            
        if ($request->ajax()) {

        $states = State::with('country')->orderBy('id', 'DESC')->get();

        return Datatables::of($states)

        ->editColumn('status', function($data){

            return view('Admin.settings.datatables.status', compact('data'));

        })
        ->addColumn('action', function ($data) {

            return view('Admin.settings.datatables.actions.state', compact('data'));
        })
        ->addColumn('bulk_delete', function($data){

            return view('Admin.datatables.actions.bulk_delete', compact('data'));     
        })
        ->rawColumns(['status','action','bulk_delete'])
        ->addIndexColumn()
        ->make(true); 
        }

        $data['title'] = "States";

        return view('Admin.settings.states.states', $data);    
    }

    public function create(){
        
        $data['title'] = "Add State";

        $data['country'] = Country::where('status','1')->get();

        return view('Admin.settings.states.add_state', $data);    
               
    }
    
    public function store(Request $request){

        $checkName = State::where('state_name' , strtolower($request->state_name) )->first();

        if(empty($checkName)){

            $data = State::insert([
             
                'state_name' => strtolower($request->state_name),
                'country_id' => (int)$request->country_id,
                'status'       => '1',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
                'deleted_at'   => null
             
            ]);

            return $this->sendResponse('The State has been added successfully');

        }else{
            
            return $this->sendError('Oops! The state name is already exists', 401);
        }
    }

    public function show($id){
       
    }

    public function edit(Request $request){

        $data['title'] = "Edit State";
        $id = $request->segment('3');
        $data['country'] = Country::where('status','1')->get();
        $data['state'] = State::where('id',$id)->first();

        return view('Admin.settings.states.edit_state', $data); 
    }

    public function update(Request $request){
          
        if(!empty($request->id)){

            $data = State::where('id',$request->id)->update([
             
                'state_name' => strtolower($request->state_name),
                'country_id' => (int)$request->country_id,
                'status'       => '1',
                'created_at'   => date('Y-m-d H:i:s'),
                'updated_at'   => date('Y-m-d H:i:s'),
                'deleted_at'   => null
             
            ]);

            return $this->sendResponse('The State has been updated successfully');
        }
    }
    
    public function destroy($type,$id){

        if (!empty($id)) {
              
            $data =  State::where('id',$id)->delete();
             
            if(!empty($data)){

               return $this->sendResponse('The State has been deleted successfully');
            
            }else{

               return $this->sendError('Oops! state not found', 401);
            }
        }
    }

    public function allStates(Request $request){

        $data = State::where(['country_id' => $request->country_id])->get();

        if (count($data) > 0) {
            
            return $this->sendResponse('Great! States found', $data);
        
        }else{

            return $this->sendError('Oops! States not found', 401);
        }
    }
}
