<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Database\Eloquent\Model;

use Session;

class WebPageSettingsModel extends Model
{
	use LogsActivity;
	
	public function tapActivity(Activity $activity, string $eventName)
	{
    $activity->causer_id = Session::get('loginID');
	}
	
	protected $table = 'web_page_settings';
	
	protected $fillable = [
		'default_web_settings',
        'navigation_header_title',
		'image_logo',
		'header_navigation_width',
        'header_navigation_height',
		'login_page_logo_width',
		'created_at',
		'created_by_user_idx',
		'updated_at',
		'modified_by_user_idx'
    ];
    
	protected $primaryKey = null;
	 
	protected static $logName = 'Web Page Details';
	
	protected static $logOnlyDirty = true;
	
	protected static $logAttributes = [
		'default_web_settings',
		'navigation_header_title',
		'image_logo',
		'header_navigation_width',
        'header_navigation_height',
		'login_page_logo_width',
		'created_at',
		'created_by_user_idx',
		'updated_at',
		'modified_by_user_idx'
    ];	
	
}
