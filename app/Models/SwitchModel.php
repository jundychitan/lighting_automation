<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Database\Eloquent\Model;

use Session;

class SwitchModel extends Model
{
	use LogsActivity;
	
	public function tapActivity(Activity $activity, string $eventName)
	{
    $activity->causer_id = Session::get('loginID');
	}
	
	protected $table = 'las_switch_tb';
	
	protected $fillable = [
        'switch_name',
		'switch_state',
		'switch_on_time',
		'switch_off_time',
        'switch_module_id',
        'switch_relay_no',
		'switch_panel_name',
		'created_at',
		'created_by_user_idx',
		'updated_at',
		'modified_by_user_idx'
    ];
    
	protected $primaryKey = 'switch_id';
	
	protected static $logName = 'Switch Details';
	
	protected static $logOnlyDirty = true;
	
	protected static $logAttributes = [
		'switch_name',
		'switch_state',
		'switch_on_time',
		'switch_off_time',
        'switch_module_id',
        'switch_relay_no',
		'switch_panel_name',
		'created_at',
		'created_by_user_idx',
		'updated_at',
		'modified_by_user_idx'
    ];	
	
}
