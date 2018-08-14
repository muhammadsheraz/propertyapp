@extends ('backend.layouts.app')

@section('content')
<form action="{{ url('/admin/properties'.( isset($model) ? "/" . $model->id : "")) }}" method="POST" enctype="multipart/form-data" class="form-horizontal">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        {{ __('labels.properties.management') }}
                        <small class="text-muted">{{ __('labels.properties.view') }}</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr />   
            <div class="row mt-4">
                <div class="col">

                    <div class="form-group row">
                        <div class="col col-md-3"><label for="title" class="form-control-label">{{ __('strings.frontend.title')}}</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="title" id="title" class="form-control" value="{{$model['title'] or ''}}" required disabled>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col col-md-3"><label for="property_image" class="form-control-label">{{ __('strings.frontend.property_image')}}</label></div>
                        <div class="col-12 col-md-9">
                            <input type="hidden" name="property_image[]" id="property_image" class="form-control" value="{{$model['property_image'] or ''}}" multiple>
                        </div>
                    </div>

                    <?php if(isset ($property_images)){?>
                    <div class="form-group row">
                        <div class="col col-md-3"></div>
                        <div class="col-12 col-md-9">
                            <div class="row property_gallery">
                                <?php if (!empty($property_images)) { ?>
                                    <?php foreach ($property_images as $property_image) { ?>
                                        <div class="col img-uploader image-container" data-responsive="<?php echo Storage::url($property_image->image_url); ?>" data-src="<?php echo Storage::url($property_image->image_url); ?>" data-sub-html="<?php echo $model->title ; ?>">
                                            <?php $class_featured = !empty($property_image->is_featured) ? 'featured-image' : '' ?>
                                            <img name="property_image_{{$property_image->id}}" src="{{Storage::url($property_image->image_url)}}" class="{{ $class_featured }} img-responsive" alt="" title="">
                                            <span class="d-none">
                                                <a href="#" 
                                                    title="Remove Image" 
                                                    class="remove-image" 
                                                    data-url="{{ url('/admin/properties/remove_image/') }}" 
                                                    data-image-id="{{$property_image->id}}">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </span>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div><!--form-group-->
                        </div>
                    </div>
                    <?php }?>

                    <div class="form-group row">
                        <div class="col col-md-3"><label for="property_image_pano" class="form-control-label">{{ __('strings.frontend.property_image_panoramic')}}</label></div>
                        <div class="col-12 col-md-9">
                            <input type="hidden" name="property_image_pano[]" id="property_image_pano" class="form-control" value="{{$model['property_image_pano'] or ''}}" multiple>
                        </div>
                    </div>

                    <?php if(isset ($property_images)){?>
                    <div class="form-group row">
                        <div class="col col-md-3"></div>
                        <div class="col-12 col-md-9">
                            <div class="row">
                                <?php if (!empty($property_images_pano)) { ?>
                                    <?php foreach ($property_images_pano as $property_image_pano) { ?>
                                        <div class="col img-uploader image-container">
                                            <img name="property_image_pano_{{$property_image_pano->id}}" src="{{Storage::url($property_image_pano->image_url)}}" class="panoramic-image" alt="" title="">
                                            <span class="d-none">
                                                <a href="#" 
                                                    title="Remove Image" 
                                                    class="remove-image" 
                                                    data-url="{{ url('/admin/properties/remove_image/') }}" 
                                                    data-image-id="{{$property_image_pano->id}}">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </span>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div><!--form-group-->
                        </div>
                    </div>
                                    <?php } ?>

                    <div class="form-group row">
                        <div class="col col-md-6"><label for="street1" class="form-control-label">{{ __('strings.frontend.street1')}}</label>
                            <input type="text" name="street1" id="street1" class="form-control" value="{{$model['street1'] or ''}}" required disabled>
                        </div>
                        <div class="col col-md-6"><label for="street2" class="form-control-label">Street 2</label>
                            <input type="text" name="street2" id="street2" class="form-control" value="{{$model['street2'] or ''}}" disabled>
                        </div>
                    </div>                    

                    <div class="form-group row">
                        <div class="col-3"><label for="state" class="form-control-label">{{ __('strings.frontend.state')}}</label>
                            <input type="text" name="state" id="state" class="form-control" value="{{$model['state'] or ''}}" required disabled>
                        </div>

                        <div class="col-3"><label for="phone" class="form-control-label">{{ __('strings.frontend.phone')}}</label>
                                <input type="text" name="phone" id="phone" class="form-control" value="{{$model['phone'] or ''}}" required disabled>
                            </div>
                        <div class="col-3"><label for="city_id" class="form-control-label"></label>
                            
                                <div class="col-12"><label for="district_id" class="form-control-label">{{ __('strings.frontend.district')}}</label></div>
                                
                                <select name="district_id" id="district_id" class="form-control select2" required disabled>
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
                                              
                        <div class="col-3">
                            <div class="row">
                                <div class="col-12"><label for="city_id" class="form-control-label">{{ __('strings.frontend.city')}}</label></div>
                            </div>
                            <select name="city_id" class="form-control select2" id="city_id" required disabled>
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

                    </div>                    

                    <div class="form-group row">

                        <div class="col-3">
                            <div class="row">
                                <div class="col-12"><label for="city_id" class="form-control-label">{{ __('strings.frontend.broker')}}</label></div>
                            </div>
                            <select name="broker_id" class="form-control select2" id="broker_id" required disabled>
                                <?php foreach ($brokers as $broker) { ?>
                                    <?php 
                                        $selected = '';
                                        if (isset($model['broker_id']) AND $broker->id == $model['broker_id']) {
                                            $selected = 'selected';
                                        }    
                                    ?> 
                                    <option value="<?php echo $broker->id; ?>" data-city-id="<?php echo $broker->city_id; ?>" {{ $selected }}><?php echo $broker->first_name; ?></option>
                                <?php } ?>
                            </select>
                        </div><!--col-->

                        <div class="col-3"><label for="price" class="form-control-label">{{ __('strings.frontend.price')}}</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{$model['price'] or ''}}" required disabled>
                        </div>

                        <div class="col-3"><label for="property_purpose" class="form-control-label">{{ __('strings.frontend.purpose')}}</label>
                            <select name="property_purpose" id="property_purpose" class="form-control" disabled>
                                <option value="buy">{!! __('strings.frontend.for_sale') !!}</option>
                                <option value="rent">{!! __('strings.frontend.for_rent') !!}
                                </option>
                            </select>
                        </div>

                        <div class="col-3"><label for="rooms" class="form-control-label">{{ __('strings.frontend.rooms')}}</label>
                            <select name="rooms" id="rooms" class="form-control" disabled>
                                <option value="1">1+1</option>
                                <option value="2">2+1</option>
                                <option value="3">3+1</option>
                                <option value="4">4+1</option>
                                <option value="5">5+1</option>
                                <option value="6">6+</option>
                            </select>
                        </div>

                        </div>                    

                    <div class="form-group row">

                        <div class="col-3"><label for="commission_type" class="form-control-label">{{ __('strings.frontend.commission_type')}}</label>
                            <?php
                                $commission_type = !empty($model['commission_type']) ? $model['commission_type'] : '';
                                $commission_types = [
                                    'percent'=>__('strings.frontend.percent'),
                                    'fixed'=>__('strings.backend.one_month_rent'),
                                ];
                                echo Form::select('commission_type', $commission_types, $commission_type, ['class' => 'form-control', 'disabled'=>'']);
                            ?>
                        </div>

                        <div class="col-3"><label for="commission_value" class="form-control-label">{{ __('strings.frontend.commission_value')}}</label>
                            <input type="number" name="commission_value" id="commission_value" class="form-control" disabled value="{{$model['commission_value'] or ''}}">
                        </div>

                        <div class="col-3">
                            <label for="ada_no" class="form-control-label">{{ __('strings.frontend.pafta_no')}}</label>
                            <input type="text" name="pafta_no" id="pafta_no" class="form-control" disabled value="{{$model['pafta_no'] or ''}}" maxlength="45" >
                        </div>

                        <div class="col-3">
                            <label for="ada_no" class="form-control-label">{{ __('strings.frontend.ada_no')}}</label>
                            <input type="text" name="ada_no" id="ada_no" class="form-control" disabled value="{{$model['ada_no'] or ''}}" maxlength="45" >
                        </div>

                        <div class="col-3">
                            <label for="parcel_no" class="form-control-label">{{ __('strings.frontend.parcel_no')}}</label>
                            <input type="text" name="parcel_no" id="parcel_no" class="form-control" disabled value="{{$model['parcel_no'] or ''}}" maxlength="75">
                        </div>
                    </div><!--form-group-->

                    <div class="form-group row d-none">                        
                        <div class="col col-md-3"><label for="payment_duration" class="form-control-label">{{ __('strings.frontend.payment_duration')}}</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="payment_duration" id="payment_duration" class="form-control" value="{{$model['payment_duration'] or ''}}" disabled>
                        </div>
                    </div>
                    
                    <div class="form-group row d-none">
                        <div class="col col-md-3"><label for="duration_unit" class="form-control-label">Duration Unit</label></div>
                        <div class="col-12 col-md-9">
                            <input type="text" name="duration_unit" id="duration_unit" class="form-control" value="{{$model['duration_unit'] or ''}}" disabled>
                        </div>
                    </div>      

                    <div class="form-group row d-none">
                        <div class="col col-md-3"><label for="location_lng" class="form-control-label">Location Lng</label></div>
                        <div class="col-12 col-md-9">
                            <input type="number" name="location_lng" id="location_lng" class="form-control" value="{{$model['location_lng'] or ''}}" disabled>
                        </div>
                    </div>

                    <div class="form-group row d-none">
                        <div class="col col-md-3"><label for="location_lat" class="form-control-label">Location Lat</label></div>
                        <div class="col-12 col-md-9">
                            <input type="number" name="location_lat" id="location_lat" class="form-control" value="{{$model['location_lat'] or ''}}" disabled>
                        </div>
                    </div>
                    <div class="form-group row">
                    <div class="col-3"><label for="property_type" class="form-control-label">{{ __('labels.general.property_type')}}</label>
                        <select name="property_type" id="property_type" class="form-control" disabled>
                                <?php foreach (get_property_types() as $property_id => $property_type) { ?>
                                    <option value="<?php echo $property_id; ?>"><?php echo $property_type; ?></option>
                                <?php } ?>
                        </select>
                        </div>

                        <div class="col-3"><label for="status" class="form-control-label">{{ __('strings.frontend.status')}}</label>
                            <select name="status" id="status" class="form-control" disabled>
                                <option value="active">{{ __('labels.general.active')}}</option>
                                <option value="pending">{{ __('labels.general.pending')}}</option>
                                <option value="cancelled">{{ __('labels.general.canceled')}}</option>
                                <option value="completed">{{ __('labels.general.completed')}}</option>
                            </select>
                        </div>

                        <div class="col-3"><label for="description" class="form-control-label">{{ __('strings.frontend.description') }}</label>
                        <div class="col-12">
                        <div class="row">
                            <a href="#" class="view-property-btn text-primary" data-target="#property-description" title="View Property Description">>{{ __('strings.frontend.view_property_description') }}</a>
                            <!-- The Modal -->
                            <div class="modal fade" id="property-description">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <div class="property-description-data">{!! $model['description'] or '' !!}</div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('labels.general.buttons.close') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>                            
                        </div>
                        </div>


                    </div>           

                    <div class="form-group row">
                    <div class="col-3"><label for="car_park" class="form-control-label">{{ __('strings.backend.options')}}</label></div>
                        <div class="col text-center">
                        <div class="col-12"><label for="car_park" class="form-control-label">{{ __('strings.frontend.car_park')}}</label></div>
                            <label class="switch switch-3d switch-primary">
                                <?php $checked = !empty($model['car_park']) ? 'checked' : ''; ?>
                                <input type="checkbox" name="car_park" id="car_park" class="switch-input" value="1" {{ $checked }} disabled>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>                            
                        </div>

                        <div class="col text-center">
                        <div class="col-12"><label for="car_park" class="form-control-label">{{ __('strings.frontend.elevator')}}</label></div>
                            <label class="switch switch-3d switch-primary">
                            <?php $checked = !empty($model['elevator']) ? 'checked' : ''; ?>
                                <input type="checkbox" name="elevator" id="elevator" class="switch-input" value="1" {{ $checked }} disabled>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>                            
                        </div>

                        <div class="col text-center">
                        <div class="col-12"><label for="car_park" class="form-control-label">{{ __('strings.frontend.security')}}</label></div>
                            <label class="switch switch-3d switch-primary">
                            <?php $checked = !empty($model['private_security']) ? 'checked' : ''; ?>
                                <input type="checkbox" name="private_security" id="private_security" class="switch-input" value="1" {{ $checked }} disabled>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>                            
                        </div>

                        <div class="col text-center">
                        <div class="col-12"><label for="car_park" class="form-control-label">{{ __('strings.frontend.garden')}}</label></div>
                            <label class="switch switch-3d switch-primary">
                                <?php $checked = !empty($model['garden']) ? 'checked' : ''; ?>
                                <input type="checkbox" name="garden" id="garden" class="switch-input" value="1" {{ $checked }} disabled>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>                            
                        </div>

                        <div class="col text-center">
                        <div class="col-12"><label for="car_park" class="form-control-label">{{ __('strings.frontend.smart_house')}}</label></div>
                            <label class="switch switch-3d switch-primary">
                            <?php $checked = !empty($model['playground']) ? 'checked' : ''; ?>
                                <input type="checkbox" name="playground" id="playground" class="switch-input" value="1" {{ $checked }} disabled>
                                <span class="switch-label"></span>
                                <span class="switch-handle"></span>
                            </label>                            
                        </div>
                    </div>           
                

                    

                    <div class="form-group row">
                        
                    </div>

                    
                                                        
                    {{ csrf_field() }}

                    @if (isset($model))
                        <input type="hidden" name="_method" value="PATCH">
                    @endif

                    <input type="hidden" name="id" id="id" value="{{$model['id'] or ''}}">

                    <div class="form-group row">
                        <div class="col-sm-offset-3 col-sm-6">
                            <a class="btn btn-default" href="{{ url('/properties') }}"><i class="glyphicon glyphicon-chevron-left"></i> {{ __('strings.backend.back')}}</a>
                        </div>
                    </div>  



                </div><!--col-->
            </div><!--row-->            

        

    </div>
</div>

</form>
@endsection

@push('after-scripts')
    <script type="text/javascript">
        $(function(){
            $('.property_gallery').lightGallery();
            
            $('.view-property-btn').on('click', function () {
                alertify.splash($($(this).attr('data-target')).find('.modal-body').html()).maximize();
            });
        });      
    </script>

    
@endpush