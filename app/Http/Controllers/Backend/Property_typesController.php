<?php
	namespace App\Http\Controllers\Backend;

	use Illuminate\Http\Request;

	use App\Http\Requests;
	use App\Http\Controllers\Controller;

	use App\Models\Property_type;

	use DB;

class Property_typesController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(Request $request)
	{

		$data['property_types'] = Property_type::all();

	    return view('backend.property_types.index', $data);
	}

	public function create(Request $request)
	{


	    return view('backend.property_types.add');
	}

	public function edit(Request $request, $id)
	{
		$property_type = Property_type::findOrFail($id);
	    return view('backend.property_types.add', [
			'model' => $property_type
		]);
	}

	public function show(Request $request, $id)
	{
		$property_type = Property_type::findOrFail($id);
	    return view('backend.property_types.show', [
	        'model' => $property_type	    ]);
	}

	public function grid(Request $request)
	{
		$len = $_GET['length'];
		$start = $_GET['start'];

		$select = "SELECT *,1,2 ";
		$presql = " FROM property_types a ";
		if($_GET['search']['value']) {	
			$presql .= " WHERE name LIKE '%".$_GET['search']['value']."%' ";
		}
		
		$presql .= "  ";

		$sql = $select.$presql." LIMIT ".$start.",".$len;


		$qcount = DB::select("SELECT COUNT(a.id) c".$presql);
		//print_r($qcount);
		$count = $qcount[0]->c;

		$results = DB::select($sql);
		$ret = [];
		foreach ($results as $row) {
			$r = [];
			foreach ($row as $value) {
				$r[] = $value;
			}
			$ret[] = $r;
		}

		$ret['data'] = $ret;
		$ret['recordsTotal'] = $count;
		$ret['iTotalDisplayRecords'] = $count;

		$ret['recordsFiltered'] = count($ret);
		$ret['draw'] = $_GET['draw'];

		echo json_encode($ret);

	}


	public function update(Request $request) {
		$property_type = null;
		
		$request->validate([
			'name' => 'required|max:25',
		]);

		if($request->id > 0) { $property_type = Property_type::findOrFail($request->id); 
			$response_message = __('alerts.general.property_type_updated');
		}
		else { 
			$property_type = new Property_type;
			$response_message = __('alerts.general.property_type_created');
		}
	    		
		$property_type->id = $request->id?:0;
		$property_type->name = $request->name;
		$property_type->name_tr = !empty($request->name_tr) ? $request->name_tr : $request->name;
		$property_type->name_ar = !empty($request->name_ar) ? $request->name_ar : $request->name;
		$property_type->name_ru = !empty($request->name_ru) ? $request->name_ru : $request->name;
		$property_type->name_de = !empty($request->name_de) ? $request->name_de : $request->name;
	    $property_type->save();

	    return redirect('/admin/property_types')->withFlashSuccess($response_message);

	}

	public function store(Request $request)
	{
		return $this->update($request);
	}

	public function destroy(Request $request, $id) {
		
		$property_type = Property_type::findOrFail($id);

		$property_type->delete();
		
	    return redirect('/admin/property_types')->withFlashSuccess(__('alerts.general.property_deleted'));
	    
	}

	public function delete(Request $request, $id) {
		$property_type = Property_type::findOrFail($id);

		$property_type->delete();
		return redirect('/admin/property_types');
	    // return redirect()->route('backend.property_types')->withFlashSuccess(__('alerts.backend.users.deleted'));
	    
	}

	
}