<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\{ Content,User,VehicleCategory,Taxi,TruckType,TankerCapacity,Partner,Support, BannerImage, Enquiry, Advertisement,CommonQuestion};
use Datatables,Response,Session,DB;
use App\Http\Controllers\Api\Common\BaseController as BaseController;

class ContentController extends BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request){

        if ($request->ajax()) {

            $content = Content::orderBy('id', 'DESC')->get();

            return Datatables::of($content)

            ->editColumn('status', function($data){

                return view('Admin.settings.datatables.status', compact('data'));
            })

            ->editColumn('eng_content', function($data){

                return view('Admin.settings.contents.eng_content', compact('data'));
            })
            ->editColumn('arb_content', function($data){

                return view('Admin.settings.contents.arb_content', compact('data'));
            })

            ->addColumn('action', function ($data) {

                return view('Admin.settings.datatables.actions.content', compact('data'));
            })
             
            ->rawColumns(['status','action','eng_content','arb_content' ])
            ->addIndexColumn()
            ->make(true); 
        }

        $data['title'] = "Contents";

        return view('Admin.settings.contents.contents', $data);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        $data['title'] = "Add Content";
        return view('Admin.settings.contents.add_content', $data);   
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $data = [

            'title' => strtolower($request->title), 
            'type'  => $request->type,
            'english' => $request->eng_ckeditor,
            'arabic' => $request->arb_ckeditor,
            'status'       => '1',
            'created_at'   => date('Y-m-d H:i:s')       
        ];

        $result = Content::insert($data);

        if($result){

            return $this->sendResponse('The Content has been added successfully');
        
        } else{

             return $this->sendError('Oops! The Content not added', 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {

        $data['title'] = "Edit Content";
        $id = $request->segment('3');
        $data['contents'] = Content::where('id',$id)->first();

        return view('Admin.settings.contents.edit_content', $data); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {

        $content_id = $request->id;
        
        if(!empty($content_id)){

            $data = [

                'title' => strtolower($request->title), 
                'type'  => $request->type,
                'english' => $request->eng_ckeditor,
            'arabic' => $request->arb_ckeditor,
                'status'       => '1',
                'updated_at'   => date('Y-m-d H:i:s')       
            ];

             $result = Content::where('id',$content_id)->update($data);

             if($result){

                return $this->sendResponse('The Content has been updated successfully');

            } else{

                 return $this->sendError('Oops! The Content not updated', 401);
            }
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        
    }
    
    public function createPartner(Request $request ) {

        $data['title'] = "Partner";
        $data['partner_data'] = Partner::first();
        return view('Admin.settings.contents.partner', $data); 
    }

  
    public function BannerImages(Request $request) {

        $data['title'] = "Banner-Images";
        $data['images'] = BannerImage::get();

        if ($request->ajax()) {

            $table = BannerImage::orderBy('id', 'DESC')->withTrashed()->get();
  
            return Datatables::of($table)

            ->editColumn('image', function($data){

                return view('Admin.webFront.BannerImage.image', compact('data'));
            })

            ->editColumn('status', function($data){

                return view('Admin.settings.datatables.status', compact('data'));

            })

            ->addColumn('action', function ($data) {

                return view('Admin.webFront.BannerImage.action', compact('data'));
            })

            ->addColumn('bulk_delete', function($data){

               return view('Admin.datatables.actions.bulk_delete', compact('data'));     
            })

            ->rawColumns(['status','action','bulk_delete','image'])
            ->addIndexColumn()
            ->make(true); 
        }

        return view('Admin.webFront.BannerImage.BannerImageList', $data); 
    }

    public function AddBanner(Request $request) {
        
        $data['title'] = "Banner Image";
        
        return view('Admin.webFront.BannerImage.AddBanner', $data); 
    }

    public function UpdateBanner(Request $request, $type ,$id ) {

        if(!empty($id)){

            $data['bannerImages'] = BannerImage::where('id',$id)->first();

        }else{

        }
        
        $data['title'] = "Banner Image";
        
        return view('Admin.webFront.BannerImage.AddBanner', $data); 
    }

    public function StoreUpdateBanner(Request $request) {
        
        $data = [
        
            'title' => $request->get('title'),
            'description' => $request->get('description'),
        ];

        if($request->file('image') != null) {

            $data['image']  = $this->uploadFile($request->file('image'), 'banner');
        }

        if (!empty($request->get('id'))) {

            $message = "The Banner Image has been updated successfully";
            $action = BannerImage::where('id',$request->get('id'))->update($data);

        }else{

            $message = "The Banner Image has been added successfully";
            $action = BannerImage::create($data);
        }

        if($action){

            return $this->sendResponse($message);
            
        }else{

            return $this->sendError('Oops! The Banner Image not added', 401);
        }
    }

    public function searchData(Request $request){

        $response = array(
            
            'success' => 0
        );

        $search = $request->get('term');
        $response['result'] = array();
        $query = User::query();

        if ($search != "") {

            $data = $query->where('first_name', 'LIKE', '%' . $search . '%')
            ->orWhere('last_name', 'LIKE', '%' . $search . '%')
            ->orWhere('mobile_number', 'LIKE', '%' . $search . '%')->get();
            
            if (count($data) > 0) {

                $response['success'] = 1;

                foreach($data as $key => $value) {

                    if ($value->user_type == 2) {

                        $response['result'][] = ['img' => $value->profile_image, 'value' => $value->name, 'label' => url("admin/passengers/" . $value->id),'user_type' => $value->user_type ];
                    }
                     if ($value->user_type == 3){

                        $response['result'][] = ['img' => $value->profile_image, 'value' => $value->name, 'label' => url("admin/drivers/" . $value->id),'user_type' => $value->user_type ];
                    }
                }
            }
        }

        return Response::json($response['result']);
    }

    public function SupportList(Request $request) {
        
        $data['title'] = "Support";

        if ($request->ajax()) {

            $sessionArray = Session::get($request->segment(1)); 
        
            $table = Support::with('fromUser')->where('to_id',$sessionArray['id'])->orderBy('id', 'DESC')->get();
  
            return Datatables::of($table)

            ->editColumn('status', function($data){

                if ($data->status == 0 ) {
                    
                    $status = '<span class="badge bg-danger" title="Active">Pending</span>';
                    
                }else{

                    $status = '<span class="badge bg-teal" title="Active">Answered</span>';
                }

                return $status;
            })

            ->addColumn('user_name', function ($data) {

                return view('Admin.webFront.Support.userName', compact('data'));
            })

            ->addColumn('action', function ($data) {

                return view('Admin.webFront.Support.action', compact('data'));
            })
            ->addColumn('bulk_delete', function($data){

               return view('Admin.datatables.actions.bulk_delete', compact('data'));     
            })
            ->rawColumns(['status','action','bulk_delete','user_name'])
            ->addIndexColumn()
            ->make(true); 
        }

        return view('Admin.webFront.Support.support_list', $data); 
    }

    public function SupportReply(Request $request) {
        
        $data['title'] = "Support Reply";

        $id = $request->segment('3');

        $data['support'] = Support::with('fromUser:id,first_name,last_name')->where('id',$id)->first();
    //  dd( $data['support']);

    return view('Admin.webFront.Support.support_reply', $data); 

    }

    public function CreateReply(Request $request) {
        $data = [
        
            'from_id' => $request->get('user_id'),
            'to_id'   => $request->get('to_id'),
            'message' => $request->get('message'),
        ];
        $insert = Support::create($data);
        $update = Support::where('id',$request->get('id'))->update(['status'  => '1']);

        if($insert){

            return $this->sendResponse('Great! Reply send successfully');
            
        }else{

            return $this->sendError('Oops! Reply not send', 401);
        }
    }

    public function enquiryDashboad(Request $request) {
        
        $data = Enquiry::select(

            DB::raw('count(id) as enquiries'), 
            DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")

        )
        ->groupBy('months')
        ->get();

        if(count($data) > 0){

            return $this->sendResponse('Enquiry list',$data);
            
        }else{

            return $this->sendError('Data not found', 401);
        }
    } 

    public function Advertisements(Request $request) {

        if ($request->ajax()) {

            $data = Advertisement::orderBy('id','DESC')->get();
           
            return Datatables::of($data)

            ->addColumn('url', function ($data) {
                
                if (!empty($data->url)) {

                    $title = '<p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 25ch;" title="'.$data->url.'" >'.strip_tags($data->url).'</p>';
                }else{

                    $title = '-';
                }

                return $title;
            })

            ->addColumn('description', function($data){

                $title = '<p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 30ch;" title="'.$data->description.'" >'.strip_tags($data->description).'</p>';

                return $title;
            })
         
            ->editColumn('title', function($data){

                return view('Admin.settings.advertisement.advertisement_title', compact('data'));
            })

            ->addColumn('status', function ($data) {
    
                 if ($data->status == 1) {

                    $status = '<span class="badge bg-teal">Active</span>';
                }else{

                    $status = '<span class="badge bg-danger">Inactive</span>';
                }
                return $status;
            })

            ->addColumn('action', function ($data) {
    
                return view('Admin.datatables.actions.advertisement', compact('data'));
            })

            ->addColumn('bulk_delete', function($data){

                return view('Admin.datatables.actions.bulk_delete', compact('data'));     
            })

            ->rawColumns(['action','title','url','description','image','bulk_delete','status'])
            ->addIndexColumn()
            ->make(true); 
        }

        $data['title'] = "Advertisement";
        return view('Admin.settings.advertisement.advertisement_list', $data);   
    }
 
    public function CreateAdvertisements(Request $request) {

        $data['title'] = "Add Advertisement";
        return view('Admin.settings.advertisement.add_advertisement',$data);  
    }

    public function details(Request $request,$id) {
     
        $data['title'] = "Details";
        $data['Advertisement'] = 'Advertisement User Details';
        $data['info_data']= Advertisement::Where('id',$id)->first();

        return view('Admin.settings.advertisement.advertisement_detail',$data);  

    }
    
    public function storeadvertisement(Request $request){

        if (!empty($request->title)) {

            $data = [

                'title' => $request->title, 
                'url' => $request->url,
                'description' =>$request->description,
                'type' => strtolower($request->type), 

            ];

            if($request->file('image') != null) {

                $data['image']  = $this->uploadFile($request->file('image'), 'advertisement');
            }
            
            Advertisement::create($data);

            return $this->sendResponse('Great ! Advertisement has been added successfully');

        }else{

            return $this->sendError("Oops ! Failed to add Advertisement");
        }
    }
    

    public function editadvertisements(Request $request) {

        $id = $request->segment(3);  
        $data['title'] = " Edit Advertisement";
        $data['info'] = Advertisement::find($id);
   //    dd($data);
        return view('Admin.settings.advertisement.edit_advertisement',$data);
    }

    public function updateadvertisements(Request $request){

        $data = [
            
            'title'           => $request->title,
            'url'             => $request->url,
            'description'     => $request->description,
            'type' => strtolower($request->type), 

        ];
            
        if($request->file('image') != null){

            $data['image'] = $this->uploadFile($request->file('image'), 'advertisement');
        }

        $check = Advertisement::where('id',$request->adv_id)->update($data);

        if($check){

            return $this->sendResponse('Great ! Advertisement has been updated successfully');
        
        }else{

            return $this->sendError('Oops ! failed to update Advertisement type');
        }
    }
#------------------------------------------------------------------------------------------------------------------
  
public function commonQuestions(Request $request) {

    if ($request->ajax()) {

        $data = CommonQuestion::orderBy('id','DESC')->get();
        return Datatables::of($data)

        ->addColumn('status', function ($data) {

             if ($data->status == 1) {

                $status = '<span class="badge bg-teal">Active</span>';
            }else{

                $status = '<span class="badge bg-danger">Inactive</span>';
            }
            return $status;
        })

        ->addColumn('created_at', function($data){

            return dateFormat($data->created_at);
        })
        ->addColumn('action', function ($data) {

            return view('Admin.datatables.actions.question', compact('data'));
        })
        ->addColumn('bulk_delete', function($data){

            return view('Admin.datatables.actions.bulk_delete', compact('data'));     
        })
        ->rawColumns(['action','question','created_at','bulk_delete','status'])
        ->addIndexColumn()
        ->make(true); 
    }

    $data['title'] = "Common Questions";

    return view('Admin.settings.question.common_question_list', $data);   
}


public function addCommonQuestion(Request $request) {

    $id = $request->segment('3');

    if (!empty($id)) {

        $data['title'] = "Edit Question";
        $data['info'] = CommonQuestion::where('id',$id)->first();

    }else{
        
        $data['title'] = "Add Question";
    }

    return view('Admin.settings.question.add_common_question',$data);  
}
  
public function storeCommonQuestions(Request $request){

        $data = [

            'question' => $request->question, 
        ];

        if (!empty($request->question_id)) {

            $result = CommonQuestion::where('id',$request->question_id)->update($data);
            $message = 'Great ! common question has been updated successfully';

        }else{
            
            $result = CommonQuestion::create($data);            
            $message = 'Great ! common question has been added successfully';
        }

        if (!empty($result)) {

            return $this->sendResponse($message);

        }else{

            return $this->sendError("Oops ! Failed to add Common question");
        }
    }
}


