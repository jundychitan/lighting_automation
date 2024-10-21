<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAccountModel;
use App\Models\WebPageSettingsModel;

use Hash;
use Session;
use Validator;
use DataTables;
use Illuminate\Support\Facades\Storage;

class LASUserListController extends Controller
{
	
	/*Load UserList Interface*/
	public function user(){
		
			
			if(Session::has('loginID')){
				
				$title = 'User List';
				$data = array();
			
				$data = User::where('user_id', '=', Session::get('loginID'))->first();
				$WebPageSettingsdata = WebPageSettingsModel::first();
				
				return view("las.user", compact('data', 'WebPageSettingsdata','title'));
			
			}
	
	}   
	
	/*Fetch Site List using Datatable*/
	public function getUserList(Request $request)
    {

		$user = UserAccountModel::get();
		if ($request->ajax()) {
		
		$data= UserAccountModel::select(
		'user_id',
		'user_name',
		'user_real_name',
		'user_type',
        'created_at',
        'updated_at',
		);		

		return DataTables::of($data)
				->addIndexColumn()
                ->addColumn('action', function($row){	
					
					$actionBtn = '
					<div class="action_table_menu_switch">
					<a href="#" data-id="'.$row->user_id.'" class="ri-edit-circle-fill btn_icon_table btn_icon_table_edit" id="editUser"></a>
					<a href="#" data-id="'.$row->user_id.'" class="ri-delete-bin-2-fill btn_icon_table btn_icon_table_delete" id="deleteUser"></a>
					</div>';
                    return $actionBtn;
                
				})
				
				->addColumn('created_at_dt_format', function($row){						
                    return $row->created_at;
				})
				
				->addColumn('updated_at_dt_format', function($row){		
				
                    if($row->updated_at=="0000-00-00 00:00:00"){
						return "$row->updated_at";
					}else{
						return "0000-00-00 00:00:00";
					}

				})
				
				->rawColumns(['action','created_at_dt_format','updated_at_dt_format'])
                ->make(true);
		}	
    }


	/*Fetch UserList Information*/
	public function user_info(Request $request){

		$UserID = $request->UserID;
		$data = UserAccountModel::find($UserID, ['user_name','user_real_name','user_type']);
		return response()->json($data);
		
	}

	/*Delete UserList Information*/
	public function delete_user_confirmed(Request $request){
		
			$userID = $request->userID;
			UserAccountModel::find($userID)->delete();
			return 'Deleted';
		
	} 

	public function create_user_post(Request $request){
		
		$request->validate([
		  'user_real_name'  => 'required|unique:user_tb,user_real_name',
		  'user_name'      	=> 'required|unique:user_tb,user_name',
		  'user_password'   => 'required|min:6|max:20',
		  'user_type'    	=> 'required',
        ], 
        [
			'user_real_name.required' => 'Name is required',
			'user_name.required' => 'User Name is Required',
			'user_password.required' => 'Password is Required',
			'user_type.required' => 'User Type is Required'
        ]
		);

					
			$UserList = new UserAccountModel();
			$UserList->user_real_name 	= $request->user_real_name;
			$UserList->user_name 		= $request->user_name;
			$UserList->user_password 	= hash::make($request->user_password);
			$UserList->user_type 		= $request->user_type;
			
			$result = $UserList->save();
			
			if($result){
				return response()->json(['success'=>'User Information Successfully Created!']);
			}
			else{
				return response()->json(['success'=>'Error on Insert User Information']);
			}
	}
	
	public function update_user_post(Request $request){
		
			if($request->user_password!=''){		
					$request->validate([
					  'user_real_name'  => 'required|unique:user_tb,user_real_name,'.$request->userID.',user_id',
					  'user_name'      	=> 'required|unique:user_tb,user_name,'.$request->userID.',user_id',
					  'user_password'   => 'required|min:6|max:20',
					  'user_type'    	=> 'required',
					], 
					[
						'user_real_name.required' => 'Name is required',
						'user_name.required' => 'User Name is Required',
						'user_password.required' => 'Password is Required',
						'user_type.required' => 'User Type is Required'
					]
					);
			}
			else{
					$request->validate([
					  'user_real_name'  => 'required|unique:user_tb,user_real_name,'.$request->userID.',user_id',
					  'user_name'      	=> 'required|unique:user_tb,user_name,'.$request->userID.',user_id',
					  'user_type'    	=> 'required',
					], 
					[
						'user_real_name.required' => 'Name is required',
						'user_name.required' => 'User Name is Required',
						'user_type.required' => 'User Type is Required'
					]
					);
			}
			
			
			$UserList = new UserAccountModel();
			$UserList = UserAccountModel::find($request->userID);
			$UserList->user_real_name 	= $request->user_real_name;
			$UserList->user_name 		= $request->user_name;
			if($request->user_password!=''){ $UserList->user_password 	= hash::make($request->user_password); }/*Kung BInago Lang Password saka ma update*/
			$UserList->user_type 		= $request->user_type;
			
			$result = $UserList->update();
			
			if($result){
				return response()->json(['success'=>'User Information Successfully Updated!']);
			}
			else{
				return response()->json(['success'=>'Error on Update User Information']);
			}
	
	}

	public function user_account_post(Request $request){
		
			if($request->user_password!=''){		
					$request->validate([
					  'user_real_name'  => 'required|unique:user_tb,user_real_name,'.$request->userID.',user_id',
					  'user_name'      	=> 'required|unique:user_tb,user_name,'.$request->userID.',user_id',
					  'user_password'   => 'required|min:6|max:20'
					], 
					[
						'user_real_name.required' => 'Name is required',
						'user_name.required' => 'User Name is Required',
						'user_password.required' => 'Password is Required'
					]
					);
			}
			else{
					$request->validate([
					  'user_real_name'  => 'required|unique:user_tb,user_real_name,'.$request->userID.',user_id',
					  'user_name'      	=> 'required|unique:user_tb,user_name,'.$request->userID.',user_id',
					], 
					[
						'user_real_name.required' => 'Name is required',
						'user_name.required' => 'User Name is Required'
					]
					);
			}

			$UserList = new UserAccountModel();
			$UserList = UserAccountModel::find($request->userID);
			$UserList->user_real_name 	= $request->user_real_name;
			$UserList->user_name 		= $request->user_name;
			if($request->user_password!=''){ $UserList->user_password 	= hash::make($request->user_password); }/*Kung BInago Lang Password saka ma update*/
			
			$result = $UserList->update();
			
			if($result){
				return response()->json(['success'=>'Account Information Successfully Updated!']);
			}
			else{
				return response()->json(['success'=>'Error on Account User Information']);
			}
	
	}

}
