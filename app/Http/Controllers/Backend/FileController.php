<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Auth\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Helpers\JQUploadHandler;
use App\Models\Properties;
use DB;

class FileController extends Controller {

    public function __construct() {

    }

    public function index(Request $request) {
        $options = [
            'upload_dir' => storage_path('app/public/properties/'), 
            'upload_url' => \Storage::url('properties/'), 
            'script_url' => url('/admin/file'), 
            'entity_id' => $request->input('_entity_id'), 
        ];

        $upload = new JQUploadHandler($options);
    }
    
    public function store(Request $request) {        
        $entity_id = $request->input('_entity_id');
        $entity_type = $request->input('_entity_type', 'properties');

        $options = [
          'upload_dir' => storage_path('app/public/properties/'), 
          'upload_url' => \Storage::url('properties/'), 
            'script_url' => url('/admin/file'), 
            'entity_id' => $entity_id, 
            'entity_type' => $entity_type, 
        ];

        $upload = new JQUploadHandler($options);
        $response = $upload->get_response();

        ## Saving property's image data in property's images table
        try {
            if (!empty($response['files'])) {
                foreach ($response['files'] as $file) {
                    if ($entity_type == 'properties') {
                        $property = Properties::findOrFail($entity_id);

                        DB::table('property_images')->insert([
                            'property_id' => $property->id,
                            'image_url' => $entity_type . "/" . $property->id . "/" . $file->name,
                            'image_path' => $entity_type . "/" . $property->id . "/" . $file->name,
                            'image_type' => $file->type,
                            'is_featured' => 0,
                            'is_pano' => 0,
                        ]);                    
                    }
                }
            }
        } catch (\Exception $e) {
            \Log::error("Error occured while saving property images. " . $e->getMessage());
        }
    }
    
    public function destroy(Request $request, $file) {
        $entity_id = $request->input('_entity_id');
        $entity_type = $request->input('_entity_type', 'properties');

        $options = [
            'upload_dir' => storage_path('app/public/properties/'), 
            'upload_url' => \Storage::url('properties/'), 
            'script_url' => url('/admin/file'), 
            'entity_id' => $entity_id,
            'entity_type' => $entity_type,
        ];
        
        $upload = new JQUploadHandler($options);
        $response = $upload->get_response();

        ## Deleting property's image data from property's images table
        try {
            if (!empty($response['files'])) {
                foreach ($response['files'] as $file) {
                    if ($entity_type == 'properties') {
                        $property = Properties::findOrFail($entity_id);

                        DB::table('property_images')
                        ->where('property_id', $property->id)
                        ->where('image_url', $entity_type . "/" . $property->id . "/" . $file->name)
                        ->delete();                    
                    }
                }
            }
        } catch (\Exception $e) {
            \Log::error("Error occured while saving property images. " . $e->getMessage());
        }        
    }
    
    public function show($file) {
        $options = [
            'upload_dir' => storage_path('app/public/properties/'), 
            'upload_url' => \Storage::url('properties/'), 
            'script_url' => url('/admin/file'), 
            'entity_id' => $request->input('_entity_id'), 
        ];
        new JQUploadHandler($options);
    }
    

}
