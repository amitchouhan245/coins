<?php
namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\Api\UserRequest;
use App\Http\Controllers\Api\Common\BaseController;
use App\Http\Controllers\General\VerifyController As VerifyController;
use App\Http\Resources\User as UserResource;
use App\Models\{User,Content,Enquiry,EnquiryDocument,Category,Faq, CategoryDocument, BannerImage ,Partner, Support};
use JWTAuth, Image, Cookie, config;

Class enquiryController extends BaseController {

	public function createEnquiry(UserRequest $request) {

		$mobileNumber = $request->get('mobile_number');

		$user = User::where('mobile_number',$mobileNumber)->first();

		if ((!empty($user)) && ( $request->aadhar_card != "undefined" )) {
			
			$aadhar_card = $this->uploadFile($request->aadhar_card, 'aadhar_card');

			$userUpdate = User::where('mobile_number',$mobileNumber)->update(['aadhar_card' => $aadhar_card]);
		}


		// if (!empty($user)) {

		// 	User::where('mobile_number',$mobileNumber)->update([

		// 		'first_name' => $request->get('first_name'),
		// 		'address' => $request->get('address')
		// 	]);

		// }else{

		// 	$user = User::create([
			
		// 		'first_name' 			=> $request->get('first_name'),
		// 		'country_code'  		=> '91',
		// 		'mobile_number' 		=> $request->get('mobile_number'),
		// 		'address' 				=> $request->get('address'),
		// 		'password' 				=> bcrypt($request->mobile_number),
		// 		'user_type'     		=> '2',
		// 		'is_mobile_verified' 	=> '1'
		// 	]);
		// }

		$enquiryData = [

			'user_id' => $user->id,
			'category_id' => $request->get('category_id'),
			'description' => $request->get('description') 
		];

		$enquiry = Enquiry::create($enquiryData);

		if(!empty($request->image_json)) {

			foreach ($request->image_json as $key => $value) {

	            $insert_document = [

	                'enquiry_id' => $enquiry->id,
	                'category_document_id' => $value['category_document_id'],
	                
	            ];

	            if($value['image'] != "undefined") {

	                $insert_document['document_image'] = $this->uploadFile($value['image'], 'enquiry_document');
	            }

	            if(!empty($value['enquiry_document_id'])){

	                EnquiryDocument::where('id',$value['enquiry_document_id'])->update($insert_document);
	            }else{

	                EnquiryDocument::create($insert_document);
	            }
        	}

        	return $this->sendResponse('Greate ! Enquiry has submitted successfully');
		
		}else{

			return $this->sendError('Oops ! No service documents are found');
		}
	}

	public function enquiryList(UserRequest $request){

		$user = User::whereMobileNumber($request->mobile_number)->first();
	
		$data = Enquiry::with('category:id,title,description')->whereUserId($user->id)->get(['id','user_id','category_id','description','created_at']);
		
		return $this->sendResponse("Enquiry list found",$data);
	}

	public function deleteEnquiry(UserRequest $request) {
		
		$check = Enquiry::whereId($request->enquiry_id)->first();

		if(!empty($check)) {

			$delete = Enquiry::whereId($request->enquiry_id)->delete();

			if ($delete) {	

				return $this->sendResponse("Greate ! Enquiry deleted");
				
			}else{

				return $this->sendError('Oops ! Enquiry not deleted');
			}

		} else {

			return $this->sendError('Oops ! Enquiry not found');
		}
	}

	public function enquiryDetail(UserRequest $request) {
		
		$data = Enquiry::with(

			'user:id,first_name,address,mobile_number',
			'category:id,title,charge',
			'enquiry_documents:id,enquiry_id,category_document_id,document_image'
		)
		->whereId($request->enquiry_id)
		->first(['id','user_id','description','category_id','created_at']);

		if (!empty($data)) {

			return $this->sendResponse("Greate ! Enquiry detail found", $data);
			
		}else{

			return $this->sendError('Oops ! Enquiry not found');
		}
	}

	public function documents($jsonArr,$enquiry_id){
       
		$data = array();
		
	 	foreach ($jsonArr as $value) {

			$data['enquiry_id'] = $enquiry_id;
			$data['category_document_id'] = $value['category_document_id'];
			
            if($value['document_image'] != "undefined") {

                $data['document_image'] = $value['document_image'];
            }

            EnquiryDocument::insert($data);
		}
	}

	public function CategoryList(Request $request){

        $data = Category::with('categoryDocuments')
        			->where(['status' => '1'])
        			->get(['title','description','charge','image','id']);
        
		return $this->sendResponse('Greate ! Categories are found',$data);
	}

	public function Faqs(Request $request){
		
		$data = Faq::where(['status' => '1'])->get(['id','question','answer','status']);
		return $this->sendResponse('Greate ! Faqs are found',$data);
	}

	public function Contents(Request $request) {

		$type = $request->get('type');
	
		$data = Content::where('type',$type)->first();

		return $this->sendResponse('Greate ! Faqs are found',$data);	
	}

	public function CategoryDetail(Request $request,$id){

		$data = Category::where(['id' => $id,'status' => '1'])
			
			->with(
			
				'categoryInstructions:id,category_id,title,status',
				'categoryDocuments:id,category_id,document_name,status',
				'category_attachments:id,title,image,category_id'
			)
			->first(['title','description','charge','image','id']);
			
		return $this->sendResponse('Greate ! Categories are found',$data);
	}

	public function categoryDocuments(Request $request,$id){
		
		$data = CategoryDocument::where(['category_id' => $id ,'status' => '1'])->get(['id','category_id','document_name','status']);

		if(count($data) > 0) {

			return $this->sendResponse('Greate ! Service Documents are found',$data);
		}else{

			return $this->sendError('Oops ! No service documents are found');
		}
	}

	public function bannerImages(Request $request) {
		
		$data = BannerImage::where('status','1')->get(['id','title','description','image']);
		
		if(count($data) > 0) {

			return $this->sendResponse('Greate ! Banner-Images are found',$data);
		
		}else{

			return $this->sendError('Oops ! No Banner-Images are found');
		}
	}

	public function partner(Request $request) {
		
		$data = Partner::first();

		if(!empty($data)) {

			return $this->sendResponse('Greate ! Partner info found',$data);
					
		}else{

			return $this->sendError('Oops ! No Info found');
		}
	}

	public function getUserInfo(UserRequest $request) {
		
		$mobileNumber = $request->get('mobile_number');

		$user = User::where(['mobile_number' => $mobileNumber])->first();

		if(!empty($user)) {

			return $this->sendResponse('Greate ! User info found',$user);
		
		}else{

			return $this->sendError('Oops ! No Info found');
		}
	}
	
	public function supportList(UserRequest $request) {

		$user = User::whereMobileNumber($request->mobile_number)->first();
		$admin = User::whereUserType('1')->first();

		$data['support'] = Support::where(['from_id' => $user['id']])->orWhere(['to_id' => $user['id']])->get();
		$data['user_id'] = $user->id;

		if($data) {

			return $this->sendResponse('Greate ! message has been send',$data);
		
		}else{

			return $this->sendError('Oops ! No Info found');
		}
	}

	public function supportChat(UserRequest $request) {
		
		$user = User::whereMobileNumber($request->mobile_number)->first();

		$admin = User::whereUserType('1')->first();
        
        $create = [

        	'from_id' 	=> $user->id, 
        	'to_id' 	=> $admin->id,
        	'message' 	=> $request->message
        ];
        
        $data = Support::create($create);

        if($data) {

			return $this->sendResponse('Greate ! message has been send');
		
		} else {

			return $this->sendError('Oops ! No Info found');
		}
	}
}