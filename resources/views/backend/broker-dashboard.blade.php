@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.broker-dashboard.title'))

@section('content')
<div class="content mt-3">
    <!-- <div class="col-sm-12">
      <div class="alert  alert-success alert-dismissible fade show" role="alert"> <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
    </div> -->

      <div class="col-sm-6 col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row form-group">
            <div class="col-2 search-label">
              <label for="">{{ __('strings.backend.quick_search') }} </label>
            </div>
            <div class="col-3 search-enity">
              <select name="entity" id="entity" class="form-control select2">
                <option value="">{{ __('strings.backend.search_by') }}</option>
                <option value="property">{{ __('strings.backend.property') }}</option>
                <option value="message">{{ __('strings.backend.message') }}</option>
              </select>
            </div>
            <div class="col-7 search-value search-value-property" style="display:none;">
              <select name="property_id" id="property_id" class="form-control select2">
                <option value="">{{ __('strings.backend.select_property') }}</option>
                <?php if (!empty($properties->count())) { ?>
                  <?php foreach ($properties as $property): ?>
                    <option value="{{$property->id}}" data-url="{{ url('/admin/properties') }}/{{$property->id}}/edit">{{$property->property_no}} : {{$property->title}}</option>
                  <?php endforeach; ?>
                <?php }  ?>
              </select>
            </div>
            <div class="col-7 search-value search-value-broker" style="display:none;"> 
              <select name="broker_id" id="broker_id" class="form-control select2">
                <option value="">{{ __('strings.backend.select_broker') }}</option>
                <?php if (!empty($brokers->count())) { ?>
                  <?php foreach ($brokers as $broker): ?>
                    <option value="{{$broker->id}}" data-url="{{route('admin.auth.broker.show', $broker)}}">{{$broker->broker_no}} : {{$broker->full_name}}</option>
                  <?php endforeach; ?>
                <?php } ?>
              </select>
            </div>              
            <div class="col-7 search-value search-value-message" style="display:none;"> 
              <select name="message_id" id="message_id" class="form-control select2">
                <option value="">{{ __('strings.backend.select_message') }}</option>
                <?php if (!empty($messages)) { ?>
                  <?php foreach ($messages as $message): ?>
                    <?php 
                        $message_no = 'M' . str_pad($message['id'],config('app.message_no_padding_size'),"0",STR_PAD_LEFT);
                    ?>
                    <option value="{{$message['id']}}" data-url="{{url('admin/messages/'.$message['user_id'])}}">{{$message_no}}</option>
                  <?php endforeach; ?>
                <?php } ?>
              </select>
            </div>              
          </div>        
        </div>
      </div>
      </div>

      <div class="col-4">
        <div class="card text-white bg-flat-color-1">
          <div class="card-body pb-0">
            <div class="dropdown float-right">
              <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown"> <i class="fa fa-cog"></i> </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <div class="dropdown-menu-content"> 
                  <a class="dropdown-item" href="{{url('/admin/properties/create')}}">{{ __('strings.backend.add_new') }}</a> 
                  </div>
              </div>
            </div>
            <h4 class="mb-0"> <span class="count">{{ $allcount['buy'] }}</span> </h4>
            <p class="text-light">{{ __('strings.backend.sale_properties') }}</p>
          </div>
        </div>
      </div>
      <!--/.col-->
      
      <div class="col-4">
        <div class="card text-white bg-flat-color-3">
          <div class="card-body pb-0">
            <div class="dropdown float-right">
              <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown"> <i class="fa fa-cog"></i> </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <div class="dropdown-menu-content"> 
                <a class="dropdown-item" href="{{url('/admin/properties/create')}}">{{ __('strings.backend.add_new') }}</a> 
                </div>
              </div>
            </div>
            <h4 class="mb-0"> <span class="count">{{ $allcount['rent'] }}</span> </h4>
            <p class="text-light">{{ __('strings.backend.rent_properties') }}</p>
          </div>
        </div>
      </div>
      <!--/.col-->
      
    <div class="col-4">
      <div class="card text-white bg-flat-color-4">
        <div class="card-body pb-0">
          <h4 class="mb-0"> <span class="count">{{ count($messages) }}</span> </h4>
          <p class="text-light">{{ __('strings.backend.messages') }}</p>
        </div>
      </div>
    </div>


     
    <!--/.col-->

      <div class=" col-6">
      <div class="card">
        <div class="card-header"> <strong class="card-title">{{ __('strings.backend.communication') }}</strong>
        <div class="dropdown float-right d-none">
            <button class="btn bg-transparent dropdown-toggle theme-toggle text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown"> <i class="fa fa-cog"></i> </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <div class="dropdown-menu-content"><a class="dropdown-item" href="#">{{ __('strings.backend.all_messages') }}</a></div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">{{ __('strings.frontend.customer') }}</th>
                <th scope="col">{{ __('strings.frontend.message') }}</th>
                <th scope="col">{{ __('strings.backend.date_time') }}</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
                <?php if (count($messages)) { ?>
                  <?php foreach ($messages as $message) { ?>
                    <tr>
                      <?php
                        $message_no = 'M' . str_pad($message['id'],config('app.message_no_padding_size'),"0",STR_PAD_LEFT);
                        $customer_no = $message['user_data']['customer_no'];
                      ?>
                      <td><?php echo $customer_no; ?></td>
                      <td><?php echo $message_no; ?></td>
                      <td><?php echo $message['created_at']->formatLocalized('%d %b, %Y %H:%M'); ?></td>                
                      <td><a href="<?php echo url('admin/messages/'. $message['thread_id']); ?>" class="messageLink" data-customer-id="<?php echo $message['user_id']; ?>">{{ __('strings.backend.detail') }}</a></td>
                    </tr>                
                  <?php } ?>
                <?php } else { ?>
                    <tr>
                      <th colspan="4" class="text-center">{{ __('strings.backend.no_messages') }}</th>
                    </tr> 
                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div> 

      <div class=" col-6 d-none">
      <div class="card">
        <div class="card-header"> <strong class="card-title">{{ __('strings.backend.buyers_offers') }}</strong>
        <div class="dropdown float-right d-none">
            <button class="btn bg-transparent dropdown-toggle theme-toggle text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown"> <i class="fa fa-cog"></i> </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <div class="dropdown-menu-content"><a class="dropdown-item" href="#">{{ __('strings.backend.all_messages') }}</a></div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table" id="buyers_offers">
            <thead>
              <tr>
                <th scope="col">{{ __('strings.backend.customer_id') }}</th>
                <th scope="col">{{ __('strings.backend.property_id') }}</th>
                <th scope="col">{{ __('strings.backend.agreement') }}</th>
                <th scope="col">{{ __('strings.backend.date_time') }}</th>
              </tr>
            </thead>
            <tbody>
                <?php if ($property_requests_buyers->count()) { ?>
                  <?php foreach ($property_requests_buyers->get() as $property_requests) { ?>
                    <tr>
                      <td><?php echo $property_requests->customer_no; ?></td>
                      <td><?php echo $property_requests->property_no; ?></td>
                      <td><a href="<?php echo \Storage::url($property_requests->agreement_file); ?>" target="blank">{{ __('strings.backend.view_agreement') }}</a></td>
                      <td><?php echo strftime('%d %b, %Y %H:%M', strtotime($property_requests->created_at)); ?></td>                
                    </tr>                
                  <?php } ?>
                <?php } else { ?>
                    <tr>                
                      <th colspan="4" class="text-center">{{ __('strings.backend.no_messages') }}</th>
                    </tr> 
                <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>     

    <div class="col-xl-3 col-lg-6">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-one">
            <div class="stat-icon dib"><a href="{{url('/admin/notifications')}}"><i class="fa fa-bell text-danger border-danger"></i></a></div>
            <div class="stat-content dib">
              <div class="stat-text">{{ __('strings.backend.notifications') }}</div>
              <div class="stat-digit">{{ count($notifications) }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-lg-6">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-one">
            <div class="stat-icon dib"><a href="{{url('/admin/messages')}}"><i class="ti-email text-info border-info"></i></a></div>
            <div class="stat-content dib">
              <div class="stat-text">{{ __('strings.backend.messages') }}</div>
              <div class="stat-digit">{{ count($messages) }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="col-xl-6">
      <div class="card">
            <div class="card-header">
                <strong class="card-title">{{ __('strings.backend.properties') }}</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">{{__('strings.frontend.broker')}}</th>
                      <th scope="col">{{__('strings.frontend.title')}}</th>
                      <th scope="col">{{__('strings.frontend.price')}}</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $counter = 0;
                        foreach($properties as $property) { 
                          $counter++;
                      ?>
                    <tr>
                      <th scope="row"><?php echo $property->property_no; ?></th>
                      <td>{{ $property->broker_name }}</td>
                      <td><a href="/admin/properties/{{ $property->id }}/edit">{{ $property->title }}</a></td>
                      <td>${{ number_format($property->price) }}</td>
                      <td>
                          <div class="btn-group btn-group-sm" role="group" aria-label="Properties Actions">
                            <a href="{{ url('/admin/properties') }}/{{$property->id}}/edit" class="btn btn-primary">
                                <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.edit').'"></i>
                            </a>
                          </div>   
                      </td>
                    </tr>
                    <?php 
                   
                  } 
                  ?>
                  </tbody>
                </table>
            </div>
        </div>
      <!-- /# card --> 
    </div>
  </div>
@endsection

@push('after-scripts')
    {!! script('js/lib/chart-js/Chart.bundle.js') !!}
    {!! script('js/dashboard.js') !!}
    {!! script('js/widgets.js') !!}
    {!! script('js/lib/vector-map/jquery.vmap.js') !!}
    {!! script('js/lib/vector-map/jquery.vmap.min.js') !!}
    {!! script('js/lib/vector-map/jquery.vmap.sampledata.js') !!}
    {!! script('js/lib/vector-map/country/jquery.vmap.world.js') !!}
    <script type="text/javascript">
        $.fn.dataTable.ext.errMode = 'none';
        
        $(function () {
            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );

            $('#entity').change(function () {
              $('.search-value').find('select').val('');
              $('.search-value').hide();

              if ($(this).val() != '') {
                $('.search-value-' + $(this).val()).show();
              }
            });

            $('#entity').change();

            $('.search-value').change(function (e) {
                e.preventDefault();

                if ($(this).find(":selected").attr('data-url') != '') {
                  location.href = $(this).find(":selected").attr('data-url');
                }
            });

            $('#buyers_offers').DataTable({
               "aaSorting": []
            });
        });
    </script>     
@endpush('after-scripts')