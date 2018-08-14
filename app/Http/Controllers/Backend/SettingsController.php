<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

use DB;

class SettingsController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(Request $request)
	{
		$application_id = 1;
		$settings = Setting::findOrFail($application_id);

		$data['model'] = $settings;

	    return view('backend.settings.index', $data);
	}

    public function update(Request $request)
	{
		$setting = null;
		if ($request->id > 0) { 
			$setting = Setting::findOrFail($request->id); 
		} else { 
			$setting = new Setting;
		}

		$setting->application_title = $request->application_title;
		$setting->currency_sign = $request->currency_sign;
		$setting->invalid_login_threshold = $request->invalid_login_threshold;
		$setting->save();

		## Processing Broker Contract File
		try {
			$file = $request->file('broker_contract_file');

			if (!empty($file)) {
				$year = date('Y');
				$month = date('m');
				$file_path = config('app.settings_broker_contracts');

				if ($file) {
					$file_location = $file->store($file_path);
					if ($file_location) {
						$setting->broker_contract_file = $file_location;
					}
				}

				$setting->save();
			}	
		} catch (\Exception $e) {
			\Log::error("Error occurred while processing broker contract file. " . $e->getMessage());
			return redirect('/admin/settings')->withFlashSuccess(__('alerts.general.settings_saved_with_file_error'));
		}	
		
		return redirect('/admin/settings');
	}

	public function store(Request $request)
	{
		return $this->update($request);
	}	
}