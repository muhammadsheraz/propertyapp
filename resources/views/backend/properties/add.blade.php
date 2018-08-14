@extends ('backend.layouts.app')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.properties.management') }}
                        <small class="text-muted">{{ __('labels.properties.create') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr /> 
            <div class="row mt-4">
                <div class="smartwizard col-12">
                    <ul>
                        <li><a href="#step-1">{{ __('strings.frontend.basic')}}<br /><small>{{ __('strings.frontend.basic_information')}}</small></a></li>
                        <li><a href="#step-2">{{ __('strings.frontend.photos')}}<br /><small>{{ __('strings.frontend.property_images')}}</small></a></li>
                        <li><a href="#step-3">{{ __('strings.frontend.preview')}}<br /><small>{{ __('strings.frontend.frontend_view')}}</small></a></li>
                    </ul>

                    <div class="col-12">
                        <div id="step-1" class="">
                            <form id="propertyForm" action="{{ url('/admin/properties'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" class="form-horizontal">
                                <div id="form-step-0" role="form">
                                    <div class="col-7">  
                                        <!-- ENd Tabs -->
                                        <?php if (auth()->user()->hasRole('broker')) { ?>
                                        <div class="form-group row">
                                            <div class="col-6 my-3">
                                                <label for="property_request_id" class="form-control-label">{{ __('strings.frontend.property_requests')}}</label>
                                        
                                                <select name="property_request_id" class="form-control" id="property_request_id">
                                                    <option value="">{{ __('strings.frontend.property_requests')}}</option>
                                                    <?php foreach ($property_requests as $property_request) { ?>
                                                        <?php
                                                            $selected = '';
                                                            if (isset($model['property_request_id']) AND $property_request->property_request_id == $model['property_request_id']) {
                                                                $selected = 'selected';
                                                            }

                                                            $customer_no = 'C' . str_pad($property_request->customer_id,config('app.customer_no_padding_size'),"0",STR_PAD_LEFT);
                                                        ?>
                                                        <option value="<?php echo $property_request->id; ?>" {{ $selected }}>
                                                            <?php echo $property_request->title . " - " . $property_request->pr_no . ' - ' . $customer_no; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div><!--col-->
                                        </div><!--row-->
                                        <?php } ?>

                                        <div class="form-group row">
                                            <div class="col-6 my-3">
                                                <label for="street1" class="form-control-label">{{ __('strings.frontend.street1')}}</label>
                                                <input type="text" name="street1" id="street1" class="form-control" value="{{$model['street1'] or ''}}" required>
                                            </div>

                                            <div class="col-6 my-3">
                                                <label for="street2" class="form-control-label">{{ __('strings.frontend.street2')}}</label>
                                                <input type="text" name="street2" id="street2" class="form-control" value="{{$model['street2'] or ''}}">
                                            </div>
                                        </div>                    

                                        <div class="form-group row">
                                            <div class="col my-3">
                                                <label for="city_id" class="form-control-label">{{ __('strings.frontend.city')}}</label>
                                                <?php 
                                                $readonly = '';
                                                if (auth()->user()->hasRole('broker')) {
                                                    $readonly = 'readonly';
                                                } 
                                                ?>
                                                <select name="city_id" class="form-control" id="city_id" {{ $readonly }}>
                                                    <?php foreach ($cities as $city) { ?>
                                                        <?php
                                                            $selected = '';
                                                            if (isset($model['city_id']) AND $city->id == $model['city_id']) {
                                                                $selected = 'selected';
                                                            }
                                                        ?>
                                                        <option value="<?php echo $city->id; ?>" {{ $selected }}>
                                                            <?php echo $city->city_name; ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div><!--col-->

                                            <div class="col my-3">
                                                <label for="district_id" class="form-control-label">{{ __('strings.frontend.district')}}</label>
                                                <?php
                                                if (auth()->user()->hasRole('broker')) {
                                                    $readonly = 'readonly';
                                                } else {
                                                    $readonly = '';
                                                }
                                                ?>                            
                                                <select name="district_id" id="district_id" class="form-control" required  {{ $readonly }}>
                                                            <?php foreach ($districts as $district) { ?>
                                                                <?php
                                                                $selected = '';
                                                                if (isset($model['district_id']) AND $district->id == $model['district_id']) {
                                                                    $selected = 'selected';
                                                                }
                                                                ?>                                
                                                        <option value="<?php echo $district->id; ?>" data-city-id="<?php echo $district->city_id; ?>" {{ $selected }}><?php echo $district->name; ?></option>
                                                    <?php } ?>
                                                </select>                                
                                            </div>

                                            <div class="col my-3">
                                                <label for="price" class="form-control-label">{{ __('strings.frontend.price')}}</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <select name="currency" id="currency">
                                                                <option value="TRY" <?php echo (!empty($model['currency']) AND $model['currency'] == 'TRY') ? 'selected' : '' ?>>({!! get_currency_symbol('TRY') !!})</option>
                                                                <option value="USD" <?php echo (!empty($model['currency']) AND $model['currency'] == 'USD') ? 'selected' : '' ?>>({!! get_currency_symbol('USD') !!})</option>
                                                                <option value="GBP" <?php echo (!empty($model['currency']) AND $model['currency'] == 'GBP') ? 'selected' : '' ?>>({!! get_currency_symbol('GBP') !!})</option>
                                                                <option value="EUR" <?php echo (!empty($model['currency']) AND $model['currency'] == 'EUR') ? 'selected' : '' ?>>({!! get_currency_symbol('EUR') !!})</option>
                                                            </select>
                                                        </span>
                                                    </div>
                                                    <input type="number" name="price" id="price" class="form-control" value="{{$model['price'] or ''}}" required>
                                                </div>
                                            </div>
                                            <?php
                                                if (auth()->user()->hasRole('broker')) {
                                                    $readonly = 'readonly';
                                                } else {
                                                    $readonly = '';
                                                }
                                            ?> 
                                            <div class="col my-3 d-none">
                                                <label for="city_id" class="form-control-label">{{ __('strings.frontend.broker')}}</label>
                                                <select name="broker_id" class="form-control" id="broker_id" <?php echo $readonly; ?>>
                                                    <?php foreach ($brokers as $broker) { ?>
                                                        <?php
                                                        $selected = '';
                                                        if (isset($model['broker_id']) AND $broker->id == $model['broker_id']) {
                                                            $selected = 'selected';
                                                        }
                                                        ?> 
                                                        <option value="<?php echo $broker->id; ?>" data-district-id="<?php echo $broker->district_id; ?>" {{ $selected }}><?php echo $broker->first_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div><!--col-->

                                            <div class="col my-3 d-none">
                                                <label for="phone" class="form-control-label">{{ __('strings.frontend.phone')}}</label>
                                                <input type="text" name="phone" id="phone" class="form-control" value="{{$model['phone'] or ''}}" readonly>
                                            </div>
                                        </div> 
                                        <div class="form-group row d-none">                        
                                            <div class="col-4 my-3">
                                                <label for="payment_duration" class="form-control-label">{{ __('strings.frontend.payment_duration')}}</label>
                                                <input type="text" name="payment_duration" id="payment_duration" class="form-control" value="{{$model['payment_duration'] or ''}}">
                                                <input type="text" name="duration_unit" id="duration_unit" class="form-control" value="{{$model['duration_unit'] or ''}}">
                                                <input type="number" name="location_lng" id="location_lng" class="form-control" value="{{$model['location_lng'] or ''}}">
                                                <input type="number" name="location_lat" id="location_lat" class="form-control" value="{{$model['location_lat'] or ''}}">
                                            </div>
                                        </div>                    

                                        <div class="form-group row">
                                            <div class="col my-3 d-none">
                                                <label for="mobile" class="form-control-label">{{ __('strings.frontend.mobile')}}</label>
                                                <input type="text" name="mobile_no" id="mobile_no" class="form-control" value="{{$model['mobile_no'] or ''}}" disabled>
                                            </div>
                                            
                                        </div>

                                        <div class="form-group row">

                                            <div class="col my-3">
                                                <label for="property_purpose" class="form-control-label">{{ __('strings.frontend.purpose')}}</label>
                                                <?php
                                                $purpose = !empty($model['property_purpose']) ? $model['property_purpose'] : '';
                                                echo Form::select('property_purpose', get_property_purpose(), $purpose, ['class' => 'form-control property_purpose']);
                                                ?>
                                            </div>                                        

                                            <div class="col my-3">
                                                <label for="rooms" class="form-control-label">{{ __('strings.frontend.rooms')}}</label>
                                                <select name="rooms" id="rooms" class="form-control">
                                                    <option value="1" <?php echo $model->rooms == 1 ? 'selected' : ''; ?>>1+1</option>
                                                    <option value="2" <?php echo $model->rooms == 2 ? 'selected' : ''; ?>>2+1</option>
                                                    <option value="3" <?php echo $model->rooms == 3 ? 'selected' : ''; ?>>3+1</option>
                                                    <option value="4" <?php echo $model->rooms == 4 ? 'selected' : ''; ?>>4+1</option>
                                                    <option value="5" <?php echo $model->rooms == 5 ? 'selected' : ''; ?>>5+1</option>
                                                    <option value="6" <?php echo $model->rooms == 6 ? 'selected' : ''; ?>>6+</option>
                                                </select>
                                            </div>
                                                <div class="col my-3">
                                                    <label for="commission_type" class="form-control-label">{{ __('strings.frontend.commission_type')}}</label>
                                                    <?php
                                                        $commission_type = !empty($model['commission_type']) ? $model['commission_type'] : '';
                                                        $commission_types = [
                                                            'percent'=>__('strings.frontend.percent'),
                                                            'fixed'=>__('strings.backend.one_month_rent'),
                                                        ];

                                                        echo Form::select('commission_type', $commission_types, $commission_type, ['id' => 'commission_type','class' => 'form-control commission_type']);
                                                    ?>
                                                </div>
                                                <div class="col my-3 commission_value">
                                                    <label for="commission_value" class="form-control-label commission_value">{{ __('strings.frontend.commission_value')}}</label>
                                                    <input type="number" name="commission_value" id="commission_value" class="form-control commission_value" value="{{$model['commission_value'] or ''}}" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                            <div class="col my-3">
                                                <label for="ada_no" class="form-control-label">{{ __('strings.frontend.pafta_no')}}</label>
                                                <input type="text" name="pafta_no" id="pafta_no" class="form-control" value="{{$model['pafta_no'] or ''}}" maxlength="45" >
                                            </div>
                                            <div class="col my-3">
                                                <label for="ada_no" class="form-control-label">{{ __('strings.frontend.ada_no')}}</label>
                                                <input type="text" name="ada_no" id="ada_no" class="form-control" value="{{$model['ada_no'] or ''}}" maxlength="45" >
                                            </div>
                                            <div class="col my-3">
                                                <label for="parcel_no" class="form-control-label">{{ __('strings.frontend.parcel_no')}}</label>
                                                <input type="text" name="parcel_no" id="parcel_no" class="form-control" value="{{$model['parcel_no'] or ''}}" maxlength="75">
                                            </div>
                                        </div>

                                        <div class="form-group row  my-3">
                                            <div class="col my-3">
                                                <label for="property_type" class="form-control-label">{{ __('labels.general.property_type')}}</label>
                                                <select name="property_type" id="property_type" class="form-control">
                                                    <?php foreach (get_property_types() as $property_id => $property_type) { ?>
                                                        <option value="<?php echo $property_id; ?>"><?php echo $property_type; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row  my-3" style="background: #f9f9f9;">
                                            <div class="col-12 text-center">
                                                <label for="car_park" class="form-control-label"><strong>{{ __('strings.frontend.amenities')}}</strong></label>
                                            </div>

                                            <div class="col-4 text-center">
                                                <div class="col-12"><label for="car_park" class="form-control-label">{{ __('strings.frontend.car_park')}}</label></div>
                                                <label class="switch switch-3d switch-primary">
                                                    <?php $checked = !empty($model['car_park']) ? 'checked' : ''; ?>
                                                    <input type="checkbox" name="car_park" id="car_park" class="switch-input" value="1" {{ $checked }}>
                                                    <span class="switch-label"></span>
                                                    <span class="switch-handle"></span>
                                                </label>                            
                                            </div>

                                            <div class="col-4 text-center">
                                                <div class="col-12"><label for="car_park" class="form-control-label">{{ __('strings.frontend.elevator')}}</label></div>
                                                <label class="switch switch-3d switch-primary">
                                                    <?php $checked = !empty($model['elevator']) ? 'checked' : ''; ?>
                                                    <input type="checkbox" name="elevator" id="elevator" class="switch-input" value="1" {{ $checked }}>
                                                    <span class="switch-label"></span>
                                                    <span class="switch-handle"></span>
                                                </label>                            
                                            </div>

                                            <div class="col-4 text-center">
                                                <div class="col-12"><label for="car_park" class="form-control-label">{{ __('strings.frontend.private_security')}}</label></div>
                                                <label class="switch switch-3d switch-primary">
                                                    <?php $checked = !empty($model['private_security']) ? 'checked' : ''; ?>
                                                    <input type="checkbox" name="private_security" id="private_security" class="switch-input" value="1" {{ $checked }}>
                                                    <span class="switch-label"></span>
                                                    <span class="switch-handle"></span>
                                                </label>                            
                                            </div>

                                            <div class="col-4 text-center">
                                                <div class="col-12"><label for="car_park" class="form-control-label">{{ __('strings.frontend.garden')}}</label></div>
                                                <label class="switch switch-3d switch-primary">
                                                    <?php $checked = !empty($model['garden']) ? 'checked' : ''; ?>
                                                    <input type="checkbox" name="garden" id="garden" class="switch-input" value="1" {{ $checked }}>
                                                    <span class="switch-label"></span>
                                                    <span class="switch-handle"></span>
                                                </label>                            
                                            </div>

                                            <div class="col-4 text-center">
                                                <div class="col-12"><label for="car_park" class="form-control-label">{{ __('strings.frontend.smart_house')}}</label></div>
                                                <label class="switch switch-3d switch-primary">
                                                    <?php $checked = !empty($model['playground']) ? 'checked' : ''; ?>
                                                    <input type="checkbox" name="playground" id="playground" class="switch-input" value="1" {{ $checked }}>
                                                    <span class="switch-label"></span>
                                                    <span class="switch-handle"></span>
                                                </label>                            
                                            </div>
                                        </div>           


                                        <div class="form-group row">
                                            
                                        </div>                   

                                        <div class="form-group row d-none">
                                            <div class="col-3">
                                                <label for="status" class="form-control-label">{{ __('strings.frontend.status')}}</label>                                            
                                                <?php
                                                    if (!empty($model['status'])) {
                                                        $status = $model['status'];
                                                    } else {
                                                        $status = 'active';
                                                    }

                                                    echo Form::select('status', get_property_status(), $status, ['id' => 'status','class' => 'form-control select2']);
                                                ?>
                                            </div>
                                        </div>

                                        {{ csrf_field() }}

                                        @if (!empty($model['id']))
                                            <input type="hidden" name="_method" value="PATCH">
                                        @endif

                                        <input type="hidden" name="id" id="id" data-property-id="{{$model['id'] or ''}}" value="{{$model['id'] or ''}}">
                                        <input type="hidden" name="mode" id="mode" value="{{ $mode }}">
                                        <input type="hidden" name="step" id="step" value="">
                                    </div><!--col-->

                                    <div class="col-5 py-4" style=" background:#f9f9f9;">

                                    <ul class="nav nav-tabs d-none" id="myTab" role="tablist">
                                            <?php foreach (array_keys(config('locale.languages_omenkul')) as $lang): ?>
                                                <li class="nav-item">
                                                    <a class="nav-link" 
                                                    id="{{$lang}}-tab" 
                                                    data-toggle="tab" 
                                                    data-lang="{{$lang}}" 
                                                    href="#lang-{{$lang}}" 
                                                    role="tab" 
                                                    aria-controls="{{$lang}}" 
                                                    aria-selected="true">

                                                        <?php echo array_get(config('locale.languages_names'), $lang); ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <div class="tab-content pl-3 p-1" id="myTabContent">
                                            <?php foreach (array_keys(config('locale.languages_omenkul')) as $lang): ?>
                                                <div class="tab-pane fade show" id="lang-{{$lang}}" role="tabpanel" aria-labelledby="{{$lang}}-tab">
                                                    <?php if ($lang != 'en') { ?>
                                                        <div class="form-group row">
                                                            <div class="col-12 my-3">
                                                                <label for="title" class="form-control-label">{{ __('strings.frontend.title')}}</label>
                                                                <input type="text" name="title_{{$lang}}" id="title_{{$lang}}" class="form-control title" value="{{ $model["title_$lang"] or ''}}" maxlength="60">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-12 my-3">
                                                                <label for="description_{{$lang}}" class="form-control-label">{{ __('strings.frontend.description')}}</label>
                                                                <textarea name="description_{{$lang}}" id="description_{{$lang}}" class="form-control description" height="1500px">{{$model["description_$lang"] or ''}}</textarea>
                                                            </div>
                                                        </div>      
                                                        <div class="form-group row">
                                                            <div class="col-12 my-3">
                                                                <label for="meta_description_{{$lang}}" class="form-control-label">{{ __('strings.frontend.meta_description')}}</label>
                                                                <textarea name="meta_description_{{$lang}}" id="meta_description_{{$lang}}" class="form-control meta_description" style="height: 150px">{{$model['meta_description'] or ''}}</textarea>
                                                            </div>
                                                        </div>    

                                                        <div class="form-group row">
                                                            <div class="col-12 my-3">
                                                                <label for="meta_keywords_{{$lang}}" class="form-control-label">{{ __('strings.frontend.meta_keywords')}}</label>
                                                                <textarea name="meta_keywords_{{$lang}}" id="meta_keywords_{{$lang}}" class="form-control meta_keywords" style="height: 150px"                                                                                                                                                                      >{{$model['meta_keywords'] or ''}}</textarea>
                                                            </div>
                                                        </div>                                                                                   
                                                    <?php } else { ?>
                                                        <div class="form-group row">
                                                            <div class="col-12 my-3">
                                                                <label for="title" class="form-control-label">{{ __('strings.frontend.title')}}</label>
                                                                <input type="text" name="title" id="title" data-toggle="validator" class="form-control title" value="{{$model['title'] or ''}}" maxlength="60" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-12 my-3">
                                                                <label for="description" class="form-control-label">{{ __('strings.frontend.description')}}</label>
                                                                <textarea name="description" id="description" class="form-control description" height="1000px">{{$model['description'] or ''}}</textarea>
                                                            </div>
                                                        </div>  
                                                        <div class="form-group row">
                                                            <div class="col-12 my-3">
                                                                <label for="meta_description" class="form-control-label">{{ __('strings.frontend.meta_description')}}</label>
                                                                <textarea name="meta_description" id="meta_description" class="form-control meta_description" style="height: 150px">{{$model['meta_description'] or ''}}</textarea>
                                                            </div>
                                                        </div>    

                                                        <div class="form-group row">
                                                            <div class="col-12 my-3">
                                                                <label for="meta_keywords" class="form-control-label">{{ __('strings.frontend.meta_keywords')}}</label>
                                                                <textarea name="meta_keywords" id="meta_keywords" class="form-control meta_keywords" style="height: 150px"                                                                                                                                                                      >{{$model['meta_keywords'] or ''}}</textarea>
                                                            </div>
                                                        </div>                                                                                           
                                                    <?php } ?>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>


                                                </div>

                                </div><!--row-->
                                
                            </form>
                        </div>
                        <div id="step-2" class="">
                            <form id="fileupload" action="{{url('/admin/properties/upload_image')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
                                <div id="form-step-1" role="form" data-toggle="validator">    
                                    <!-- Redirect browsers with JavaScript disabled to the origin page -->
                                    {{ csrf_field() }}
                                    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                    <div class="row fileupload-buttonbar">
                                        <div class="col-lg-7">
                                            <!-- The fileinput-button span is used to style the file input field as button -->
                                            <span class="btn btn-success fileinput-button">
                                                <i class="glyphicon glyphicon-plus"></i>
                                                <span>{{ __('strings.frontend.add_files')}}</span>
                                                <input type="file" name="files[]" multiple>
                                            </span>
                                            <!--<button type="submit" class="btn btn-primary start">
                                                <i class="glyphicon glyphicon-upload"></i>
                                                <span>Start upload</span>
                                            </button>-->
                                            <button type="reset" class="btn btn-warning cancel">
                                                <i class="glyphicon glyphicon-ban-circle"></i>
                                                <span>{{ __('strings.frontend.cancel_upload')}}</span>
                                            </button>
                                            <button type="button" class="btn btn-danger delete">
                                                <i class="glyphicon glyphicon-trash"></i>
                                                <span>{{ __('strings.frontend.delete')}}</span>
                                            </button>
                                            <input type="checkbox" class="toggle">
                                            <!-- The global file processing state -->
                                            <span class="fileupload-process"></span>
                                        </div>
                                        <!-- The global progress state -->
                                        <div class="col-lg-5 fileupload-progress fade">
                                            <!-- The global progress bar -->
                                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                            </div>
                                            <!-- The extended global progress state -->
                                            <div class="progress-extended">&nbsp;</div>
                                        </div>
                                    </div>
                                    <!-- The table listing the files available for upload/download -->
                                    <table role="presentation" class="table table-striped">
                                        <thead>
                                            <tr id="files_trhead" class="template-download-head" style="display:none">
                                                <td></td>
                                                <td colspan="3"></td>
                                                <td class="text-center">{{ __('strings.frontend.featured')}}</td>
                                                <td class="text-center">{{ __('strings.frontend.panoramic')}}</td>
                                                <td class="text-center">{{ __('strings.frontend.actions')}}</td>
                                            </tr> 
                                        </thead>
                                        <tbody class="files"></tbody>
                                        <tfoot id="dropzone"><td class="text-center" colspan="7">{{ __('strings.backend.drop_your_files_here')}}</td></tfoot>
                                    </table>
                                </div>
                            </form>
                        </div>
                        <div id="step-3" class="">
                            <div id="form-step-2" role="form" data-toggle="validator">
                                <div class="iframeDiv">
                                    <iframe id="previewFrame" src="" width="100%" height="700">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
@endsection

@push('after-scripts')
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload">
    <td>
    <span class="preview"></span>
    </td>
    <td>
    <p class="name">{%=file.name%}</p>
    <strong class="error text-danger"></strong>
    </td>
    <td>
    <p class="size">Processing...</p>
    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
    </td>
    <td>
    {% if (!i && !o.options.autoUpload) { %}
    <button class="btn btn-primary start" disabled>
    <i class="glyphicon glyphicon-upload"></i>
    <span>Start</span>
    </button>
    {% } %}
    {% if (!i) { %}
    <button class="btn btn-warning cancel">
    <i class="glyphicon glyphicon-ban-circle"></i>
    <span><?php echo __('buttons.general.cancel'); ?></span>
    </button>
    {% } %}
    </td>
    </tr>
    {% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl"> 
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download">
        <td>
            {% if (file.deleteUrl) { %}
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } %}
        </td>        
        <td>
            <span class="preview">
            {% if (file.thumbnailUrl) { %}
            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
            {% } %}
            </span>
        </td>
        <td>
            <p class="name">
            {% if (file.url) { %}
            <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
            {% } else { %}
            <span>{%=file.name%}</span>
            {% } %}
            </p>
            {% if (file.error) { %}
            <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td class="text-center">
            <input type="radio" title="<?php echo __('strings.frontend.featured'); ?>" name="set_featured" value="{%=file.name%}" onClick="$(this).setFeaturedImage()" data-href="<?php echo url('/admin/properties')?>/set_featured_image" class="toggle set_featured_image" required>
        </td>
        <td class="text-center">
            <input type="radio" title="<?php echo __('strings.frontend.panoramic'); ?>" name="set_panoramic" value="{%=file.name%}" onClick="$(this).setPanoramicImage()" data-href="<?php echo url('/admin/properties')?>/set_panoramic_image" class="toggle set_panoramic_image" required>
        </td>
        <td class="text-center">
            {% if (file.deleteUrl) { %}
            <button class="btn btn-danger delete" title="<?php echo __('strings.frontend.delete'); ?>" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true,"_token":"<?php echo csrf_token(); ?>"}'{% } %}>
                <span><i class="fa fa-trash"></i></span>
            </button>
            {% } else { %}
            <button class="btn btn-warning cancel">
            <i class="glyphicon glyphicon-ban-circle"></i>
            <span><?php echo __('buttons.general.cancel'); ?></span>
            </button>
            {% } %}
        </td>
    </tr>
    {% } %}
</script>

<script type="text/javascript">
    $('#city_id').on("change", function (e) {
        if ($(this).val() != '') {
            $('#district_id').find('option').hide();
            var districtOption = $('#district_id').find('[data-city-id="' + $(this).val() + '"]');
            districtOption.each(function () {
                $(this).show();
            });            
            $('#district_id').val('').change();
            $('#district_id').find('option').each(function () {
                if ($(this).css('display') === 'block'){
                    $(this).prop('selected', true);
                    return;
                }
            });
            $('#district_id').change();
        }
    });

    $('#district_id').on("change", function (e) {
        if ($(this).val() != '') {
            var districtId = $(this).val();

            $('#broker_id').find('option').hide();
            var borkerOption = $('#broker_id').find('[data-district-id="' + $(this).val() + '"]');
            borkerOption.each(function () {
                $(this).show();
            });
            $('#broker_id').val('').change();

            $('#broker_id').find('option').each(function () {
                if ($(this).css('display') === 'block'){
                    $(this).prop('selected', true);
                    return;
                }
            });
            $('#broker_id').change();

            <?php if (auth()->user()->hasRole('broker')) { ?>
                if (typeof borkerOption.val() != 'undefined') {
                    borkerOption.prop('selected', true).change();
                }
            <?php } ?>
        } else {
            // $('#city_id').val('').change();
            // $('#broker_id').val('').change();
        }
    });

    $(function () {
        $('#broker_id').change(function () {
            var broker_id = $(this).val();
            var broker_json = '<?php echo!empty($brokers->toArray()) ? json_encode($brokers->toArray()) : ''; ?>';

            if (broker_json != '') {
                brokerObj = $.parseJSON(broker_json);

                $.each(brokerObj, function (k, broker) {
                    if (broker.id == broker_id) {
                        $('#phone').val(broker.phone_no);
                        $('#mobile_no').val(broker.mobile_no);

                        return false;
                    }
                });
            }
        });

        <?php if (auth()->user()->hasRole('broker')) { ?>
                $('#district_id').val('<?php echo $logged_in_broker->district_id; ?>')
                    .change()
                    .attr("style", "pointer-events: none;touch-action: none;tabindex='-1'");

                $('#city_id').attr("style", "pointer-events: none;touch-action: none;tabindex='-1'");
                $('#broker_id').val('<?php echo $logged_in_broker->id; ?>')
                    .change()
                    .attr("style", "pointer-events: none;touch-action: none;tabindex='-1'");
        <?php } else { ?>
                $('#district_id').change();
                // $('#city_id').attr("style", "pointer-events: none;touch-action: none;tabindex='-1'");
                // $('#broker_id').attr("style", "pointer-events: none;touch-action: none;tabindex='-1'");
        <?php } ?>

        <?php if (auth()->user()->hasRole('administrator')) { ?>
            $('#en-tab').addClass('active').tab('show');
        <?php } else { ?>
            $('#tr-tab').addClass('active').tab('show');
        <?php } ?>

        $('#myTab a').on('click',function (e) {
            e.preventDefault();
            var prevTab = $(this).closest('#myTab').find('a.active');
            var newTab = $(this);

            var prevLang = prevTab.attr('data-lang');
            var newLang = newTab.attr('data-lang');
            var trString = '';

            // Setting Title
            if ($('#lang-' + prevLang).find('input.title').val() !== '') {
                $('#myTabContent').find('[id^="lang-"]').not('#lang-' + prevLang).each(function () {
                    if ($(this).find('input.title').val() === '') {
                        // Getting Translated Text
                        trString = $('#lang-' + prevLang).find('input.title').val();

                        $(this).find('input.title').val(trString);
                    }
                })
            }

            // Setting Description
            if (! $('#lang-' + prevLang).find('.description').summernote('isEmpty')) {
                $('#myTabContent').find('[id^="lang-"]').not('#lang-' + prevLang).each(function () {
                    if ($(this).find('.description').summernote('isEmpty')) {
                        // Getting Translated Text
                        trString = $('#lang-' + prevLang).find('.description').summernote('code');

                        $(this).find('.description').summernote('code', trString);
                    } 
                })
            }

            // Setting Meta Description
            if ($('#lang-' + prevLang).find('.meta_description').val() !== '') {
                $('#myTabContent').find('[id^="lang-"]').not('#lang-' + prevLang).each(function () {
                    if ($(this).find('.meta_description').val() === '') {
                        // Getting Translated Text
                        trString = $('#lang-' + prevLang).find('.meta_description').val();

                        $(this).find('.meta_description').val(trString);
                    } 
                })
            }

            // Setting Meta Keywords
            if ($('#lang-' + prevLang).find('.meta_keywords').val() !== '') {
                $('#myTabContent').find('[id^="lang-"]').not('#lang-' + prevLang).each(function () {
                    if ($(this).find('.meta_keywords').val() === '') {
                        // Getting Translated Text
                        trString = $('#lang-' + prevLang).find('.meta_keywords').val();

                        $(this).find('.meta_keywords').val(trString);
                    } 
                })
            }
        });

        // Toolbar extra buttons
        <?php
            if (!empty($model['id'])) {
                $finish_button_text = __('buttons.general.save_property');
            } else {
                $finish_button_text = __('buttons.general.activate_property');
            }        
        ?>
        var btnFinish = $('<button></button>').html('<?php echo $finish_button_text; ?>')
            .addClass('btn btn-success')
            .addClass('button-done')
            .on('click', function(){
                if( !$(this).hasClass('disabled')){
                    var elmForm = $("#propertyForm");
                    $("#status").find('option[value="<?php echo config('app.active');?>"]').prop('selected',true).change();
                    $("#step").val('3');
                    elmForm.submit();
                }
            });

        var btnCancel = $('<button></button>').text('<?php echo __('buttons.general.cancel'); ?>')
            .addClass('btn btn-danger')
            .on('click', function(){
                location.href = "<?php echo url('/admin/properties')?>";
            });        

        $('.smartwizard').smartWizard({
            selected: 0,
            theme: 'dots',
            transitionEffect:'fade',
            toolbarSettings: {toolbarPosition: 'bottom',
                                toolbarExtraButtons: [btnFinish, btnCancel]
                            },
            anchorSettings: {
                    // anchorClickable: true,
                    markDoneStep: true, // add done css
                    markAllPreviousStepsAsDone: true, // When a step selected by url hash, all previous steps are marked done
                    removeDoneStepOnNavigateBack: true, // While navigate back done step after active step will be cleared
                    enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
                },
            useURLhash: false,
            showStepURLhash: false
        });

        var validator = $( "#propertyForm" ).validate();
        var jquerFileUploader = '';

        $.fn.extend({
            initializeFileUploader: function (entity_id) {
                return $('#fileupload').fileupload({
                    // Uncomment the following to send cross-domain cookies:
                    //xhrFields: {withCredentials: true},
                    url: '<?php echo url("/admin/file"); ?>?_entity_id=' + entity_id,
                    autoUpload: true,
                    formData: {
                        _entity_id: entity_id, 
                        _token: '<?php echo csrf_token(); ?>'
                    },
                    acceptFileTypes: <?php echo config('app.allowed_images'); ?>,
                    maxFileSize: <?php echo config('app.max_upload_size'); ?>,                        
                    success: function (result) {
                        if (result.files.length > 0 ) {
                            $('#files_trhead').show();
                        } else {
                            $('#files_trhead').hide();
                        }
                    },                        
                    destroy: function (e, data) {
                        if (e.isDefaultPrevented()) {
                            return false;
                        }
                        var that = $(this).data('blueimp-fileupload') ||
                                $(this).data('fileupload'),
                                removeNode = function () {
                                    that._transition(data.context).done(
                                            function () {
                                                $(this).remove();
                                                that._trigger('destroyed', e, data);
                                            }
                                    );
                                };
                        if (data.url) {
                            data.dataType = data.dataType || that.options.dataType;
                            data.data = {_entity_id: entity_id, _token: '<?php echo csrf_token(); ?>'};

                            $.ajax(data)
                            .done(removeNode)
                            .fail(function () {
                                that._trigger('destroyfailed', e, data);
                            });
                        } else {
                            removeNode();
                        }
                    }
                });
            },
            loadPropertyImages: function () {
                $('#fileupload').addClass('fileupload-processing');
                $('#fileupload').find('table').find('tbody.files').empty();
                // $('#fileupload').find('table').find('tbody.files').append('<td class="text-center">Drop Your Files here.</td>');

                $.ajax({
                    // Uncomment the following to send cross-domain cookies:
                    //xhrFields: {withCredentials: true},
                    url: $('#fileupload').fileupload('option', 'url'),
                    dataType: 'json',
                    context: $('#fileupload')[0]
                }).always(function () {
                    $(this).removeClass('fileupload-processing');
                }).done(function (result) {
                    if (result.files.length > 0 ) {
                        $('#files_trhead').show();
                    } else {
                        $('#files_trhead').hide();
                    }

                    $(this).fileupload('option', 'done')
                            .call(this, $.Event('done'), {result: result});

                    <?php if(!empty($property_image_featured->image_url)) { ?>
                        $('.set_featured_image').each(function () {
                            if ($(this).val() == '<?php echo basename($property_image_featured->image_url); ?>') {
                                $(this).prop('checked', true);
                            }
                        })
                    <?php } ?>   

                    <?php if(!empty($property_image_pano->image_url)) { ?>
                        $('.set_panoramic_image').each(function () {
                            if ($(this).val() == '<?php echo basename($property_image_pano->image_url); ?>') {
                                $(this).prop('checked', true);
                            }
                        })
                    <?php } ?>                            
                });
            },
            setFeaturedImage: function () {
                $.ajax({
                    type: 'POST',
                    data: {
                        _image_name: $(this).val(),
                        _property_id: $('[data-property-id]').val(),
                        _token: "{{ csrf_token() }}"
                    },
                    url: $(this).attr('data-href'),
                    dataType: 'json',
                    context: $(this),
                    beforeSend: function (jqXHR, settings) {
                        $.blockUI({ css: { 
                            border: 'none', 
                            padding: '15px', 
                            backgroundColor: '#000', 
                            '-webkit-border-radius': '10px', 
                            '-moz-border-radius': '10px', 
                            opacity: .5, 
                            color: '#fff' 
                        } }); 
                    }, 
                    complete: function (jqXHR, textStatus) {
                        $.unblockUI();
                    },                    
                    success: function (data, textStatus, jqXHR) {
                        alertify.notify('<?php echo __('strings.property.featured_image_set') ?>', 'success', 5);
                    }
                })
            }, 
            setPanoramicImage : function () {
                $.ajax({
                    type: 'POST',
                    data: {
                        _image_name: $(this).val(),
                        _property_id: $('[data-property-id]').val(),
                        _token: "{{ csrf_token() }}"
                    },
                    url: $(this).attr('data-href'),
                    dataType: 'json',
                    context: $(this),
                    beforeSend: function (jqXHR, settings) {
                        $.blockUI({ css: { 
                            border: 'none', 
                            padding: '15px', 
                            backgroundColor: '#000', 
                            '-webkit-border-radius': '10px', 
                            '-moz-border-radius': '10px', 
                            opacity: .5, 
                            color: '#fff' 
                        } }); 
                    }, 
                    complete: function (jqXHR, textStatus) {
                        $.unblockUI();
                    },                    
                    success: function (data, textStatus, jqXHR) {
                        alertify.notify('<?php echo __('strings.property.panoramic_image_set') ?>', 'success', 5);
                    }
                })
            }
        });  
        
        // validating file upload form using jQuery Validator
        $("#fileupload").validate({
            errorPlacement: function(error,element) {
                return true;
            },
            invalidHandler: function(event, validator) {
                // 'this' refers to the form
                var errors = validator.numberOfInvalids();
                if (errors) {
                    alertify.notify('<?php echo __('strings.property.cannot_proceed_without_image') ?>', 'error', 5);
                }
            }
        });        

        $(".smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection) {
            if (stepNumber < 2) {
                $('.button-done').hide();
            } else {
                $('.button-done').show();
            }

            switch (stepNumber) {
                case 0:
                    $('.sw-btn-next').html('<?php echo __('buttons.general.save_and_next'); ?>');
                    $('.sw-btn-next').show();
                    break;
                case 1:
                    $('.sw-btn-next').html('<?php echo __('buttons.general.next'); ?>');
                    $('.sw-btn-next').show();
                    break;                    
                case 2:
                    $('.sw-btn-next').hide();
                    break; 
                default:
                    $('.sw-btn-next').hide();
                    break;
            }
        });

        $('.property_purpose').change(function () {
            if ($(this).val() == 'rent') {
                $('.commission_value').hide();
                $('#commission_type').val('fixed').change();
            } else {
                $('.commission_value').show();
                $('#commission_type').val('percent').change();
            }
        });
        
        $(".smartwizard").on("leaveStep", function(e, anchorObject, stepNumber, stepDirection) {
            var elmForm = $("#form-step-" + stepNumber);

            if (! $("#propertyForm").valid()) {
                return false;
            }           

            if (stepNumber === 1 && stepDirection === 'forward') {
                if (! $("#fileupload").valid()) {
                    return false;
                }
            }

            if (stepNumber === 0 && stepDirection === 'forward') {
                // Saving Property data of Step 1 : Basic Property Information

                if ($('[data-property-id]').val() === '') {
                    $("#status").find('option[value="<?php echo config('app.draft');?>"]').prop('selected',true).change();
                }

                $.ajax({
                    type: 'POST',
                    data: $("#propertyForm").serialize(),
                    url: $("#propertyForm").attr('action'),
                    dataType: 'json',
                    beforeSend: function () {
                        $.blockUI({ css: { 
                            border: 'none', 
                            padding: '15px', 
                            backgroundColor: '#000', 
                            '-webkit-border-radius': '10px', 
                            '-moz-border-radius': '10px', 
                            opacity: .5, 
                            color: '#fff' 
                        } }); 
                    }, 
                    complete: function () {
                        $.unblockUI();
                    },
                    error: function (response) {
                        // console.log(response.message);
                        // alertify.notify('<?php echo __('strings.property.values_saved_success') ?>', 'success', 5);
                        return false;
                    },
                    success: function (response) {
                        $('[data-property-id]').val(response.property_id).change();

                        // Only initialize uploader widget when there's a property id
                        if ($('[data-property-id]').val() !== '') {
                            // Initialize the jQuery File Upload widget (if not previously initialized):
                            $('#fileupload').initializeFileUploader($('[data-property-id]').val());

                            // Load existing files:
                            $('#fileupload').loadPropertyImages();
                        }  

                        alertify.notify('<?php echo __('strings.property.values_saved_success') ?>', 'success', 5);
                    }
                })
            }

            if (stepNumber === 1 && stepDirection === 'forward') {
                $('#previewFrame')
                .attr("src", "<?php echo url('/properties')?>/" + $('[data-property-id]').val() + "/preview")
                .css("border", '1px Solid #ccc');
            }
            
            return true;
        });

        $('.button-done').hide();
        $('.sw-btn-prev').hide();
        $('.sw-btn-next').html('<?php echo __('buttons.general.save_and_next'); ?>');

        $('.description').summernote();

        $('.commission_type').val('<?php echo config('app.percent')?>').change();
        // $('.commission_type').attr("style", "pointer-events: none;touch-action: none;tabindex='-1'");


        $('.property_purpose').change();


        
        $('#myTab').hide();
    });  
</script>
<style>
    label.error {
        color: #ff0000;
        font-weight: bold;
    }

    .iframeDiv { background: transparent; }
    #previewFrame { z-index:-2}

    /** DropZone CSS**/
    #dropzone {
        background: #f5f5f5;
        width: 150px;
        height: 50px;
        line-height: 50px;
        text-align: center;
        font-weight: bold;
        border: 1px dashed #333;
    }
    #dropzone.in {
        width: 600px;
        height: 200px;
        line-height: 200px;
        font-size: larger;
    }
    #dropzone.hover {
        background: lawngreen;
    }
    #dropzone.fade {
        -webkit-transition: all 0.3s ease-out;
        -moz-transition: all 0.3s ease-out;
        -ms-transition: all 0.3s ease-out;
        -o-transition: all 0.3s ease-out;
        transition: all 0.3s ease-out;
        opacity: 1;
    }
    /** DropZone CSS**/
</style>
@endpush