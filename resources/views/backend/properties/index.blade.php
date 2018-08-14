@extends ('backend.layouts.app')

@section('content')


<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-sm-5">
                <h4 class="card-title mb-0">
                   {{ __('strings.backend.property_management') }} <small class="text-muted">{{ __('strings.backend.active_properties') }}</small>
                </h4>
            </div><!--col-->

            <div class="col-sm-7">
                @include('backend.properties.includes.header-buttons')
            </div><!--col-->

            {{ html()->form('GET', route('admin.properties.index'))->class('col-12')->open() }}
                
                <div class="col-12">
                    <div class="first-row row my-3">
                        <div class="col-3 my-2">
                            <label for="property_purpose">{!! __('labels.general.property_purpose') !!}</label>
                            <select name="property_purpose" id="property_purpose" class="form-control">
                                <option value="buy" <?php echo array_get($request_input, 'property_purpose') == config('app.buy') ? "selected" : ""; ?>>{{ __('strings.frontend.for_sale') }}</option>
                                <option value="rent" <?php echo array_get($request_input, 'property_purpose') == config('app.rent') ? "selected" : ""; ?>>{{ __('strings.frontend.for_rent') }}</option>
                            </select>
                        </div>
                        <div class="col-3 my-2">
                            <label for="search_text">{!! __('labels.general.search') !!}</label>
                            <input type="text" name="search_text" id="search_text" value="<?php echo array_get($request_input, 'search_text', ''); ?>" class="form-control">
                        </div>
                        <div class="col-3 my-2">
                            <label for="city_id">{!! __('labels.location.city') !!}</label>
                            <select name="city_id" id="city_id" class="form-control">
                                <?php foreach ($cities as $city) { ?>
                                    <option value="<?php echo $city->id; ?>" <?php echo array_get($request_input, 'city_id') == $city->id ? "selected" : ""; ?>><?php echo $city->city_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-3 my-2">
                            <label for="district_id">{!! __('labels.location.district') !!}</label>
                            <select name="district_id" id="district_id" class="form-control">
                                <?php foreach ($districts as $district) { ?>
                                    <option value="<?php echo $district->id; ?>" <?php echo array_get($request_input, 'district_id') == $district->id ? "selected" : ""; ?>><?php echo $district->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-3 my-2 d-none">
                            <label for="property_type">{!! __('labels.general.property_type') !!}</label>
                            <select name="property_type" id="property_type" class="form-control">  
                                <option value="">{!! __('strings.frontend.select_any') !!}</option>
                                <?php foreach ($property_types as $property_type) { ?>
                                    <option value="<?php echo $property_type->id; ?>" <?php echo array_get($request_input, 'property_type') == $property_type->id ? "selected" : ""; ?>><?php echo $property_type->name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-3 my-2 d-none">
                            <label for="property_type">{!! __('labels.general.rooms') !!}</label>
                            <select name="rooms" id="rooms" class="form-control">
                                <option value="">ROOMS</option>
                                <?php foreach (get_rooms() as $key => $value) { ?>
                                    <option value="<?php echo $key; ?>" <?php echo array_get($request_input, 'rooms') == $key ? "selected" : ""; ?>><?php echo $value; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-3 my-2 d-none">
                            <?php 
                                echo Form::select('status', 
                                        get_property_status(), 
                                        array_get($request_input, 'status'), 
                                        ['id' => 'status','class' => 'form-control']
                                    );
                            ?>
                        </div>
                            <div class="col-3 my-2 d-none">
                                <select name="order_by" id="order_by" class="form-control">
                                    <option value="">SORT BY</option>
                                    <option value="{{config('app.cheapest')}}" <?php echo array_get($request_input, 'order_by') == config('app.cheapest') ? "selected" : ""; ?>>{{ucfirst(config('app.cheapest'))}}</option>
                                    <option value="{{config('app.highest')}}" <?php echo array_get($request_input, 'order_by') == config('app.highest') ? "selected" : ""; ?>>{{ucfirst(config('app.highest'))}}</option>
                                    <option value="{{config('app.newest')}}" <?php echo array_get($request_input, 'order_by') == config('app.newest') ? "selected" : ""; ?>>{{ucfirst(config('app.newest'))}}</option>
                                    <option value="{{config('app.oldest')}}" <?php echo array_get($request_input, 'order_by') == config('app.oldest') ? "selected" : ""; ?>>{{ucfirst(config('app.oldest'))}}</option>
                                </select>
                            </div>
                    </div>
                    <div class="row my-3">
                        <div class="col">
                            <input type="checkbox" name="car_park" value="1" <?php echo !empty(array_get($request_input, 'car_park')) ? "checked" : ""; ?>>
                            {{ __('strings.frontend.car_park') }}
                        </div>
                        <div class="col">
                            <input type="checkbox" name="elevator" value="1" <?php echo !empty(array_get($request_input, 'elevator')) ? "checked" : ""; ?>>
                                {{ __('strings.frontend.elevator') }}
                        </div>
                        <div class="col">
                            <input type="checkbox" name="private_security" value="1" <?php echo !empty(array_get($request_input, 'private_security')) ? "checked" : ""; ?>>
                                {{ __('strings.frontend.security') }}
                        </div>
                        <div class="col">
                            <input type="checkbox" name="garden" value="1" <?php echo !empty(array_get($request_input, 'garden')) ? "checked" : ""; ?>>
                                {{ __('strings.frontend.garden') }}
                        </div>
                        <div class="col">
                            <input type="checkbox" name="playground" value="1" <?php echo !empty(array_get($request_input, 'playground')) ? "checked" : ""; ?>>
                            {{ __('strings.frontend.playground') }}
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2"> 
                        <button name="search" value="search" type="submit" href="#" class="search-btn red-bg btn btn-success">{{ __('strings.frontend.search') }}</button> 
                    </div>
                    <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2"> 
                        <a name="reset_search" value="reset_search" href="{{ url('/admin/properties')}}" class="btn btn-secondary">{{ __('strings.frontend.reset') }}</a> 
                    </div>
                </div>
                {{ html()->form()->close() }}      

        </div><!--row-->

        <div class="row mt-4">
            <div class="col">
                <div class="table-responsive">
                <table id="propery-data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>{{ __('strings.frontend.id') }}</th>
                                <th>{{ __('strings.frontend.title') }}</th>
                                
                                <?php if(auth()->user()->hasRole('administrator')){ ?>
                                    <th>{{ __('strings.frontend.broker') }}</th>
                                    <th>{{ __('strings.frontend.city') }}</th>
                                    <th>{{ __('strings.frontend.district') }}</th>
                                <?php } ?>

                                <th>{{ __('strings.frontend.price') }}</th>
                                <th>{{ __('strings.frontend.purpose') }}</th>
                                <th>{{ __('strings.frontend.status') }}</th>
                                <th style="width:50px"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($properties as $property)
                            <tr>
                                <td>{{ $property->property_no }}</td>
                                <td><?php echo get_property_title_by_lang($property); ?></td>

                                <?php if(auth()->user()->hasRole('administrator')){ ?>
                                    <td>{{ $property->broker_name }}</td>
                                    <td>{{ $property->city_name }}</td>
                                    <td>{!! $property->district_name !!}</td>
                                <?php } ?>

                                <td>{!! $property->price !!}</td>
                                <td>
                                    <?php 
                                        switch ($property->property_purpose) {
                                            case config('app.rent'):
                                                echo ucfirst(__('strings.frontend.rent'));
                                                break;
                                            case config('app.buy'):
                                                echo ucfirst(__('strings.frontend.sale'));
                                                break;
                                            
                                            default:
                                                echo "-";
                                                break;
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($property->status == config('app.request_sold') || $property->status == config('app.request_rented')) { ?>
                                        <?php 
                                            switch ($property->status) {
                                                case config('app.request_sold'):
                                                    echo __('strings.frontend.sold_pending');

                                                    break;
                                                case config('app.request_rented'):
                                                    echo __('strings.frontend.rented_pending');
                                                    break;

                                                default:
                                                    echo ucwords(str_replace('-', ' ', $property->status));
                                                    break;
                                            }
                                        ?>
                                        
                                        <?php if(auth()->user()->hasRole('broker')){ ?>
                                            <small class="form-text text-muted">{{ __('strings.frontend.note') }} {!! __('alerts.general.request_in_progress') !!}</small>
                                        <?php } ?>

                                    <?php } else {
                                        switch ($property->status) {
                                            case config('app.active'):
                                                echo __('strings.frontend.active');

                                                break;
                                            case config('app.draft'):
                                                echo __('strings.frontend.draft');
                                                break;
                                            
                                            default:
                                                echo ucwords(str_replace('-', ' ', $property->status));
                                                break;
                                        }
                                     } ?>                                    
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Properties Actions">
                                        <a href="{{ url('/admin/properties') }}/{{$property->id}}" class="btn btn-info">
                                            <i class="fa fa-search" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.edit').'"></i>
                                        </a>
                                        
                                        <?php if (auth()->user()->hasRole('administrator')) { ?>
                                            <a href="{{ url('/admin/properties') }}/{{$property->id}}/edit" class="btn btn-primary">
                                                <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.edit').'"></i>
                                            </a>
                                            
                                            <?php if ($property->status == 'active') { ?>
                                                <?php if ($property->property_purpose == 'buy') { ?>
                                                    <a href="{{ url('/admin/properties') }}/{{$property->id}}/sold" class="btn btn-info">{{ __('strings.frontend.sold') }}</a>
                                                <?php } elseif ($property->property_purpose == 'rent') { ?>
                                                    <a href="{{ url('/admin/properties') }}/{{$property->id}}/rented" class="btn btn-success">{{ __('strings.frontend.rented') }}</a>                                            
                                                <?php } ?>
                                            <?php } ?>

                                            <a href="{{ url('/admin/properties') }}/{{$property->id}}" 
                                                data-method="delete"
                                                data-trans-button-cancel="{{__('buttons.general.cancel')}}"
                                                data-trans-button-confirm="{{__('buttons.general.delete')}}"
                                                data-trans-title="{{__('strings.general.delete_confirm')}}"
                                                class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        
                                        <?php } else { ?> 
                                            
                                            <?php if ($property->status == 'active') { ?>
                                                <?php if ($property->property_purpose == 'buy') { ?>
                                                        <a href="{{ url('/admin/properties') }}/{{$property->id}}/request_sold" class="btn btn-info">{{ __('strings.frontend.request_sold') }}</a>
                                                <?php } elseif ($property->property_purpose == 'rent') { ?>
                                                        <a href="{{ url('/admin/properties') }}/{{$property->id}}/request_rented" class="btn btn-success">{{ __('strings.frontend.request_rented') }}</a>
                                                <?php } ?>  

                                                <?php if (!empty($property->agreement_file)) { ?>
                                                    <a href="<?php echo \Storage::url($property->agreement_file); ?>" title="{{ __('strings.backend.view_agreement') }}" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i></a>    
                                                <?php } ?>

                                                <?php if (!empty($request_buyers[$property->id])) { ?>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_prop_<?php echo $property->id; ?>"><i class="fa fa-list"></i></button>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?>

                                    </div>                                
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div><!--col-->
        </div><!--row-->
    </div><!--card-body-->
</div><!--card-->

@foreach ($properties as $property)
<?php if (!empty($request_buyers[$property->id])) { ?>
    <div class="modal fade" id="modal_prop_<?php echo $property->id; ?>" tabindex="-1" role="dialog" aria-labelledby="modal_prop_<?php echo $property->id; ?>" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modal_label_prop_<?php echo $property->id; ?>">{{ __('strings.frontend.contract_list') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="card-body">
                <table class="table dtTables" id="buyers_offers_<?php echo $property->id; ?>">
                    <thead>
                        <tr>
                        <th scope="col">{{ __('strings.backend.customer_id') }}</th>
                        <th scope="col">{{ __('strings.frontend.customer') }}</th>
                        <th scope="col">{{ __('strings.backend.date_time') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($request_buyers[$property->id] as $pro_id=>$property_requests) { ?>
                        <tr>
                            <td><?php echo $property_requests->customer_no; ?></td>
                            <td>
                                <?php echo $property_requests->customer_full_name; ?>
                                <br>
                                <a href="<?php echo \Storage::url($property_requests->agreement_file); ?>" target="blank">{{ __('strings.backend.view_agreement') }}</a>
                            </td>
                            <td><?php echo strftime('%d %b, %Y %H:%M', strtotime($property_requests->created_at)); ?></td>                
                        </tr>                
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('strings.backend.close')}}</button>
        </div>
        </div>
    </div>
    </div>
    <?php } ?>
@endforeach

@endsection
@push('after-scripts')
<script type="text/javascript">
        $(function() {
            $('[data-toggle="tooltip"]').tooltip(); 
            
            $('#propery-data-table').DataTable({
                "aaSorting": [] //Disable Auto-Sorting             
            });

            $('.dtTables').DataTable({
                "aaSorting": [] //Disable Auto-Sorting               
            });
        } );
    </script>
@endpush