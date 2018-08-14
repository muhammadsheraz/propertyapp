<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Page;

use DB;

class PagesController extends Controller
{
    //
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(Request $request)
	{

		$sql = "SELECT * FROM pages p";
		$presql = " WHERE 1 = 1";
		$sql_params = [];

		$pages = DB::select($sql, $sql_params);

		$data['pages'] = $pages;

	    return view('backend.pages.index', $data);
	}

	public function create(Request $request)
	{
	    return view('backend.pages.add', [
	        []
	    ]);
	}

	public function edit(Request $request, $id)
	{
		$page = Page::findOrFail($id);
		$page_images = DB::table('page_images')->select('*')->where('page_id', '=', $id)->first();

		$data['page_images'] = $page_images;
		$data['model'] = $page;

	    return view('backend.pages.add', $data);
	}

	public function show(Request $request, $id)
	{
		return redirect("admin/pages/$id/edit");


		$page = Page::findOrFail($id);
	    return view('backend.pages.show', [
	        'model' => $page	    ]);
	}

	public function grid(Request $request)
	{
		$len = $_GET['length'];
		$start = $_GET['start'];

		$select = "SELECT *,1,2 ";
		$presql = " FROM pages a ";
		if($_GET['search']['value']) {	
			$presql .= " WHERE title LIKE '%".$_GET['search']['value']."%' ";
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
		// $this->validate($request, [
	    //     'title' => 'required|max:255',
	    //     'content' => 'required',
		// ]);
		
		try {
			$page = null;
			if ($request->id > 0) {$page = Page::findOrFail($request->id);} else {
				$page = new Page;
			}

			$page->id = $request->id ?: 0;
			$page->name = $request->name;
			$page->title = $request->title;
			$page->content = $request->content;

			$page->title_tr = array_get($request, 'title_tr', $request->title);
			$page->content_tr = array_get($request, 'content_tr', $request->content);
			$page->title_ar = array_get($request, 'title_ar', $request->title);
			$page->content_ar = array_get($request, 'content_ar', $request->content);
			$page->title_ru = array_get($request, 'title_ru', $request->title);
			$page->content_ru = array_get($request, 'content_ru', $request->content);
			$page->title_de = array_get($request, 'title_de', $request->title);
			$page->content_de = array_get($request, 'content_de', $request->content);

			$page->slug = $request->slug;
			//$page->image = $request->image;
			$page->meta_title = $request->meta_title;

			$page->meta_description = array_get($request, 'meta_description', $request->meta_description);
			$page->meta_keywords = array_get($request, 'meta_keywords', $request->meta_keywords);

			$page->meta_description_tr = array_get($request, 'meta_description_tr', $request->meta_description);
			$page->meta_keywords_tr = array_get($request, 'meta_keywords_tr', $request->meta_keywords);

			$page->meta_description_ar = array_get($request, 'meta_description_ar', $request->meta_description);
			$page->meta_keywords_ar = array_get($request, 'meta_keywords_ar', $request->meta_keywords);

			$page->meta_description_ru = array_get($request, 'meta_description_ru', $request->meta_description);
			$page->meta_keywords_ru = array_get($request, 'meta_keywords_ru', $request->meta_keywords);

			$page->meta_description_de = array_get($request, 'meta_description_de', $request->meta_description);
			$page->meta_keywords_de = array_get($request, 'meta_keywords_de', $request->meta_keywords);

			$page->status = isset($request->status) ? $request->status : 0;

			if (empty($page->id)) {
				$page->created_by = auth()->id();
			}

			$page->created_at = date('Y-m-d H:i:s');

			//$page->user_id = $request->user()->id;
			$page->save();

		} catch (\Exception $e) {
			echo $e->getMessage();
			die;
		}

		## Adding Images
		$file = $request->file('page_image');

		if (!empty($file)) {
			$imageName = time() . '_' . str_replace(' ','-',$file->getClientOriginalName());
			$year = date('Y');
			$month = date('m');
			$imagePath = base_path() . "/public/uploads/images/pages/$year/$month/" . $page->id . "/";
			$imageUrl = url('/') . "/uploads/images/pages/$year/$month/" . $page->id . "/";

			$file_uploaded = $file->move(
				$imagePath, $imageName
			);
			
			//$file->store('property_image');

			if ($file_uploaded) {
				DB::table('page_images')->insert([
					'page_id' => $page->id,
					'image_url' => $imageUrl . $imageName,
					'image_path' => $imagePath . $imageName,
					'image_type' => $file->getClientMimeType(),
					'is_featured' => 0,
				]);
			}
		}
		
		if($request->id > 0) {
			$response_message = __('alerts.general.page_updated');
		} else {
			$response_message = __('alerts.general.page_created');
		}		

	    return redirect('/admin/pages')->withFlashSuccess($response_message);

	}

	public function store(Request $request)
	{
		return $this->update($request);
	}

	public function destroy(Request $request, $id) {
		
		
		$page = Page::findOrFail($id);

		$page->delete();

		$image_obj = DB::table('page_images')->where('page_id', $id);

		if (!empty($image_obj->first())) {
			$image_obj->sharedLock();

			$image = $image_obj->first();

			$removed = $image_obj->delete();

			if (file_exists($image->image_path))
				unlink($image->image_path);

			$image_obj->delete();
		}

		return redirect('admin/pages')->withFlashSuccess(__('alerts.general.page_deleted'));
	    
	}

	public function delete(Request $request, $id) {
		
		$page = Page::findOrFail($id);

		$page->delete();

		$image_obj = DB::table('page_images')->where('page_id', $id);

		if (!empty($image_obj->first())) {
			$image_obj->sharedLock();

			$image = $image_obj->first();

			$removed = $image_obj->delete();

			if (file_exists($image->image_path))
				unlink($image->image_path);

			$image_obj->delete();
		}

		return redirect('admin/pages')->withFlashSuccess(__('alerts.general.page_deleted'));
	}	

	public function remove_image(Request $request) {
		$image_id = $request->input('image_id');
		$image_obj = DB::table('page_images')->where('id', $image_id);
		$image_obj->sharedLock();
		$image = $image_obj->first();

		$removed = $image_obj->delete();
		$response = [
			'status' => 'success',
			'message' => __('alerts.general.image_removed'),
		];
		
		if (file_exists($image->image_path))
			unlink($image->image_path);
		
		echo json_encode($response);
	}
}