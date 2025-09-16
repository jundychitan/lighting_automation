<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SwitchModel;
use App\Models\WebPageSettingsModel;
use Session;
use Validator;
use DataTables;
use Illuminate\Support\Facades\Storage;


class LASSwitchController extends Controller
{	
	/*Load switch Interface*/
	public function switch(){		
	
		if(Session::has('loginID')){
			
			$title = 'Switch';
			$data = array();
			
			$data = User::where('user_id', '=', Session::get('loginID'))->first();
			$WebPageSettingsdata = WebPageSettingsModel::first();
			
			return view("las.switch", compact('data', 'WebPageSettingsdata', 'title'));
			
		}
		
	}   
	
	/*Fetch Switch List using Datatable*/
	public function getSwitch(Request $request)
    {
		if(!Session()->has('loginID'))
		{
			
			/*Session Expires*/
			http_response_code(440); exit;
			
		}else{
		$sites = SwitchModel::get();
		if ($request->ajax()) {	
		$data= SwitchModel::select(
		'switch_id',
		'switch_name',
		'switch_panel_name',
        'switch_state',
        'heart_beat',
        'switch_on_time',
        'switch_off_time',
		);		

		return DataTables::of($data)
				->addIndexColumn()
                ->addColumn('action', function($row){						
					$actionBtn = '<div class="action_table_menu_switch"><a href="#" data-id="'.$row->switch_id.'" class="ri-eye-fill btn_icon_table btn_icon_table_view" id="infoSwitch"></a> <a href="#" data-id="'.$row->switch_id.'" class="ri-edit-circle-fill btn_icon_table btn_icon_table_edit" id="editSwitch"></a> <a href="#" data-id="'.$row->switch_id.'" class="ri-delete-bin-2-fill btn_icon_table btn_icon_table_delete" id="deleteSwitch"></a> <a href="#" data-id="'.$row->switch_id.'" class="ri-send-plane-fill btn_icon_table btn_icon_table_send" id="sendSwitch"></a></div>';
                    return $actionBtn;             
				})
				->addColumn('switch_state', function($row){
					$switch_state = $row->switch_state;				
					if($switch_state==1){
						 return $switch_state_input_value = '<a href="#" data-id="'.$row->switch_id.'" class="action_table_menu_switch ri-lightbulb-flash-fill btn_icon_table btn_icon_table_switch_on" id="OFFSwitch"></a>';
					}else{
						 return $switch_state_input_value = '<a href="#" data-id="'.$row->switch_id.'" class="action_table_menu_switch ri-lightbulb-line btn_icon_table btn_icon_table_switch_off" id="ONSwitch"></a>';
					}										
                })
				->addColumn('switch_status', function($row){  
					$heart_beat = $row->heart_beat;
						/*FROM LOGS as A*/
						$_heart_beat_date = strtotime($heart_beat);
						$heart_beat_date_format = date('H:i:s',$_heart_beat_date);
						/*SERVER DATETIME as B the Current Time*/
						$_server_time=date('H:i:s');
						$server_time_current = strtotime($_server_time);
						$date1=date_create("$_server_time");/*A*/
						$date2=date_create("$heart_beat_date_format");/*B*/
						$diff					= date_diff($date1,$date2);
						$days_last_active 		= $diff->format("%a");
						/*five minutes in seconds*/
						$fiveMinutes = 60 * 2;				
						if($heart_beat == "0000-00-00 00:00:00" || $heart_beat == ''){
							 return $statusBtn = '<div style="color:black; font-weight:bold; text-align:center;" title="No Heart Beat">No Heart Beat</div>';
						}
						else if(($_heart_beat_date+$fiveMinutes)>=$server_time_current){
							 return $statusBtn = '<a href="#" class="row_status_table_gateway ri-heart-pulse-fill btn_icon_table btn_icon_table_status_online" title="Last Status Update : '.$heart_beat.'"></a>';
						}else{
							 return $statusBtn = '<a href="#" class="row_status_table_gateway ri-heart-fill btn_icon_table btn_icon_table_status_offline" title="Offline Since : '.$heart_beat.'"></a>';
						}		
                })
				->rawColumns(['action','switch_state','switch_status'])
                ->make(true);
		}
		}
    }
	
	/*Fetch Switch List for User using Datatable*/
	public function getSwitch_user(Request $request)
    {
		if(!Session()->has('loginID'))
		{
			
			/*Session Expires*/
			http_response_code(440); exit;
			
		}else{
		$sites = SwitchModel::get();
		if ($request->ajax()) {
		$data= SwitchModel::select(
		'switch_id',
		'switch_name',
		'switch_panel_name',
        'switch_state',
        'heart_beat',
        'switch_on_time',
        'switch_off_time',
		);		
		return DataTables::of($data)
				->addIndexColumn()
				->addColumn('action', function($row){						
					$actionBtn = '<div class="action_table_menu_switch"><a href="#" data-id="'.$row->switch_id.'" class="ri-eye-fill btn_icon_table btn_icon_table_view" id="infoSwitch"></a> </div>';
                    return $actionBtn;             
				})
				->addColumn('switch_state', function($row){
					$switch_state = $row->switch_state;				
					if($switch_state==1){
						 return $switch_state_input_value = '<a href="#" data-id="'.$row->switch_id.'" class="action_table_menu_switch ri-lightbulb-flash-fill btn_icon_table btn_icon_table_switch_on" id="OFFSwitch"></a>';
					}else{
						 return $switch_state_input_value = '<a href="#" data-id="'.$row->switch_id.'" class="action_table_menu_switch ri-lightbulb-line btn_icon_table btn_icon_table_switch_off" id="ONSwitch"></a>';
					}										
                })
				->addColumn('switch_status', function($row){
					$heart_beat = $row->heart_beat;
						/*FROM LOGS as A*/
						$_heart_beat_date = strtotime($heart_beat);
						$heart_beat_date_format = date('H:i:s',$_heart_beat_date);					
						/*SERVER DATETIME as B the Current Time*/
						$_server_time=date('H:i:s');
						$server_time_current = strtotime($_server_time);
						$date1=date_create("$_server_time");/*A*/
						$date2=date_create("$heart_beat_date_format");/*B*/
						$diff					= date_diff($date1,$date2);
						$days_last_active 		= $diff->format("%a");
						/*five minutes in seconds*/
						$fiveMinutes = 60 * 5;				
						
						if($heart_beat == "0000-00-00 00:00:00" || $heart_beat == ''){
							 return $statusBtn = '<div style="color:black; font-weight:bold; text-align:center;" title="No Heart Beat">No Heart Beat</div>';
						}
						else if(($_heart_beat_date+$fiveMinutes)>=$server_time_current){
							 return $statusBtn = '<a href="#" class="row_status_table_gateway ri-heart-pulse-fill btn_icon_table btn_icon_table_status_online" title="Last Status Update : '.$heart_beat.'"></a>';
						}else{
							 return $statusBtn = '<a href="#" class="row_status_table_gateway ri-heart-fill btn_icon_table btn_icon_table_status_offline" title="Offline Since : '.$heart_beat.'"></a>';
						}		
                })
				->rawColumns(['action','switch_state','switch_status'])
                ->make(true);
		}	
		}
    }	

	/*SEND Switch*/
	public function SENDSwitch(Request $request){
			$data = SwitchModel::find($request->switchID, ['switch_name','switch_module_id','switch_relay_no','switch_on_time','switch_off_time']);
			if($data['switch_on_time']==''||$data['switch_on_time']==null){
				$sw_time_on  = "--:--:--";
			}
			else{
				$sw_time_on  = $data['switch_on_time'];
			}
			if($data['switch_off_time']==''||$data['switch_off_time']==null){
				$sw_time_off = "--:--:--";
			}
			else{
				$sw_time_off = $data['switch_off_time'];
			}
			/*Create File*/
			Storage::disk('local')->put('/switch_timer/'.$data['switch_module_id'].'_'.$data['switch_relay_no'], $sw_time_on.','.$sw_time_off);
			return response()->json($data['switch_name']);
	}

	/*ON Switch*/
	public function ONSwitch(Request $request){
			$switch = new SwitchModel();
			$switch = SwitchModel::find($request->switchID);
			$switch->switch_state = 1;
			$result = $switch->update();
			$data = SwitchModel::find($request->switchID, ['switch_name','switch_module_id','switch_relay_no']);
			/*Create A File*/
			Storage::disk('local')->put('/switch_state/'.$data['switch_module_id'].'_'.$data['switch_relay_no'], '1');
			if($result){
				return response()->json($data['switch_name']);
			}
			else{
				return response()->json(['success'=>'Error on Switch ON']);
			}
	}

	/*OFF Switch*/
	public function OFFSwitch(Request $request){
			$switch = new SwitchModel();
			$switch = SwitchModel::find($request->switchID);
			$switch->switch_state = 5;
			$result = $switch->update();
			$data = SwitchModel::find($request->switchID, ['switch_name','switch_module_id','switch_relay_no']);
			/*Create A File*/
			Storage::disk('local')->put('/switch_state/'.$data['switch_module_id'].'_'.$data['switch_relay_no'], '2');
			if($result){
				return response()->json($data['switch_name']);
			}
			else{
				return response()->json(['success'=>'Error on Switch OFF',$data]);
			}
	}

	/*Fetch Switch Information*/
	public function switch_info(Request $request){
		$switchID = $request->switchID;
		$data = SwitchModel::find($switchID, ['switch_name','switch_module_id','switch_relay_no','switch_on_time','switch_off_time','switch_panel_name','heart_beat','switch_state']);
		return response()->json($data);
	}

	/*Delete Switch Information*/
	public function delete_switch_confirmed(Request $request){
		$switchID = $request->switchID;
		SwitchModel::find($switchID)->delete();
		return 'Deleted';		
	} 

	public function create_switch_post(Request $request){
		/*'required|unique:las_switch_tb,switch_name',*/
		$request->validate([
		  'switch_name'      	=> 'required|unique:las_switch_tb,switch_name',
		  'switch_module_id'    => 'required|numeric',
		  'switch_relay_no'     => 'required|numeric',
		  'switch_panel_name'   => 'required'
        ], 
        [
			'switch_name.required' => 'Switch Name is required',
			'switch_module_id.required' => 'Module ID is Required',
			'switch_relay_no.required' => 'Relay Number is Required',
			'switch_panel_name.required' => 'Panel Name is Required'
        ]
		);

			$data = $request->all();
			#insert
					
			$switch = new SwitchModel();
			$switch->switch_name = $request->switch_name;
			$switch->switch_on_time = $request->switch_on_time;
			$switch->switch_off_time = $request->switch_off_time;
			$switch->switch_module_id = $request->switch_module_id;
			$switch->switch_relay_no = $request->switch_relay_no;
			$switch->switch_panel_name = $request->switch_panel_name;
			
			$result = $switch->save();
			
			if($result){
				return response()->json(['success'=>'Switch Information Successfully Created!']);
			}
			else{
				return response()->json(['success'=>'Error on Insert Switch Information']);
			}
	}

	public function update_switch_post(Request $request){
			$request->validate([
			  'switch_name'      	=> 'required|unique:las_switch_tb,switch_name,'.$request->switchID.',switch_id',
			  'switch_module_id'    => 'required|numeric',
			  'switch_relay_no'     => 'required|numeric',
			  'switch_panel_name'   => 'required'
			], 
			[
				'switch_name.required' => 'Switch Name is required',
				'switch_module_id.required' => 'Module ID is Required',
				'switch_relay_no.required' => 'Relay Number is Required',
				'switch_panel_name.required' => 'Panel Name is Required'
			]
			);
			$data = $request->all();
			$switch = new SwitchModel();
			$switch = SwitchModel::find($request->switchID);
			$switch->switch_name = $request->switch_name;
			$switch->switch_on_time = $request->switch_on_time;
			$switch->switch_off_time = $request->switch_off_time;
			$switch->switch_module_id = $request->switch_module_id;
			$switch->switch_relay_no = $request->switch_relay_no;
			$switch->switch_panel_name = $request->switch_panel_name;
			$result = $switch->update();
			if($result){
				return response()->json(['success'=>'Switch Information Successfully Updated!']);
			}
			else{
				return response()->json(['success'=>'Error on Update Switch Information']);
			}
	}

	public function toggle_all_state(Request $request){
			$switch_ids = $request->switch_ids;	
		    $switch_state = $request->switch_state;	
			if($switch_ids!=''){
			@$switch_ids_arr = explode(",", $switch_ids);
				/*LIST OF ID's*/	
				foreach ($switch_ids_arr as $switch_ids_row):
				$switch_id = $switch_ids_row;
						$switch = new SwitchModel();
						$switch = SwitchModel::find($switch_id);
						$switch->switch_state = $switch_state;
						$result = $switch->update();
						$data = SwitchModel::find($switch_id);
						/*Create A File*/
						Storage::disk('local')->put('/switch_state/'.$data['switch_module_id'].'_'.$data['switch_relay_no'], $switch_state);
				endforeach; 
				
				if($switch_state==1){
					return "ON";
				}else{
					return "OFF";
				}
			}else{
				return 'No Action Taken';
			}
			
	}

	public function toggle_all_send(Request $request){
			$switch_ids = $request->switch_ids;	
			if($switch_ids!=''){
			@$switch_ids_arr = explode(",", $switch_ids);
				/*LIST OF ID's*/	
				foreach ($switch_ids_arr as $switch_ids_row):
				$switch_id = $switch_ids_row;
						$data = SwitchModel::find($switch_id, ['switch_name','switch_module_id','switch_relay_no','switch_on_time','switch_off_time']);
						/*On Time*/
						if($data['switch_on_time']==''||$data['switch_on_time']==null){
							$sw_time_on  = "--:--:--";
						}
						else{
							$sw_time_on  = $data['switch_on_time'];
						}
						/*Off Time*/
						if($data['switch_off_time']==''||$data['switch_off_time']==null){
							$sw_time_off = "--:--:--";
						}
						else{
							$sw_time_off = $data['switch_off_time'];
						}
						/*Create A File*/
						Storage::disk('local')->put('/switch_timer/'.$data['switch_module_id'].'_'.$data['switch_relay_no'], $sw_time_on.','.$sw_time_off);						
				endforeach; 
				return "Send";
			}
	}
}
