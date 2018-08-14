@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<div class="content mt-3">
    <!-- <div class="col-sm-12">
      <div class="alert  alert-success alert-dismissible fade show" role="alert"> <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
      </div>
    </div> -->

    <?php if (auth()->user()->hasRole('administrator')) { ?>
      <div class="col-sm-6 col-lg-12">
      <div class="card">
        <div class="card-body">
          <div class="row form-group">
            <div class="col-2 search-label">
              <label for="">{{ __('strings.backend.quick_search') }} </label>
            </div>
            <div class="col-3 search-enity">
              <select name="entity" id="entity" class="form-control select2" style="display:none;">
                <option value="">{{ __('strings.backend.search_by') }}</option>
                <option value="property">{{ __('strings.backend.property') }}</option>
                <option value="broker">{{ __('strings.frontend.broker') }}</option>
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
          </div>        
        </div>
      </div>
      </div>
    <?php } ?>

    <?php if (auth()->user()->hasRole('administrator')) { ?>
      <div class="col-4">
        <div class="card text-white bg-flat-color-1">
          <div class="card-body pb-0">
            <div class="dropdown float-right">
              <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown"> <i class="fa fa-cog"></i> </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <div class="dropdown-menu-content"> 
                  <a class="dropdown-item" href="{{url('/admin/auth/broker/create')}}">{{ __('strings.backend.add_new') }}</a> 
                </div>
              </div>
            </div>
            <h4 class="mb-0"> <span class="count">{{ $allcount['broker'] }}</span> </h4>
            <p class="text-light">{{__('strings.backend.brokers')}}</p>
          </div>
        </div>
      </div>
      <!--/.col-->
      
      <div class="col-sm-6 col-lg-3 d-none">
        <div class="card text-white bg-flat-color-2">
          <div class="card-body pb-0">
            <div class="dropdown float-right">
              <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown"> <i class="fa fa-cog"></i> </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              </div>
            </div>
            <h4 class="mb-0"> <span class="count">{{ $allcount['sales'] }}</span> </h4>
            <p class="text-light">{{__('strings.backend.sales')}}</p>
          </div>
        </div>
      </div>
      <!--/.col-->
      
      <div class="col-4">
        <div class="card text-white bg-flat-color-3">
          <div class="card-body pb-0">

            <h4 class="mb-0"> <span class="count">{{ $allcount['customers'] }}</span> </h4>
            <p class="text-light">{{ __('strings.backend.customers') }}</p>
          </div>
        </div>
      </div>
      <!--/.col-->
      <?php } ?>
      
    <div class="col-4">
      <div class="card text-white bg-flat-color-4">
        <div class="card-body pb-0">
          <div class="dropdown float-right">
            <button class="btn bg-transparent dropdown-toggle theme-toggle text-light" type="button" id="dropdownMenuButton" data-toggle="dropdown"> <i class="fa fa-cog"></i> </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <div class="dropdown-menu-content"> 
                  <a class="dropdown-item" href="{{url('/admin/properties/create')}}">{{__('strings.backend.add_new')}}</a> 
              </div>
            </div>
          </div>
          <h4 class="mb-0"> <span class="count">{{ $allcount['properties_count'] }}</span> </h4>
          <p class="text-light">{{ __('strings.backend.properties') }}</p>
        </div>
      </div>
    </div>


     
    <!--/.col-->
    <?php if (auth()->user()->hasRole('broker')) { ?>
      <div class=" col-6">
      <div class="card">
        <div class="card-header"> <strong class="card-title">{{__('strings.backend.communication')}}</strong>
        <div class="dropdown float-right">
            <button class="btn bg-transparent dropdown-toggle theme-toggle text-dark" type="button" id="dropdownMenuButton" data-toggle="dropdown"> <i class="fa fa-cog"></i> </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <div class="dropdown-menu-content"><a class="dropdown-item" href="#">{{__('strings.backend.all_messages')}}</a></div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">{{__('strings.backend.broker')}}</th>
                <th scope="col">{{__('strings.backend.message')}}</th>
                <th scope="col">{{__('strings.backend.date_time')}}</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody></tbody>
          </table>
        </div>
      </div>
    </div>
    <?php } ?>

    <div class="col-xl-3 col-lg-6">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-one">
            <div class="stat-icon dib"><a href="/admin/cities"><i class="ti-map-alt text-success border-success"></i></a></div>
            <div class="stat-content dib">
              <div class="stat-text">{{__('strings.backend.cities')}}</div>
              <div class="stat-digit">{{ $allcount['city'] }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-lg-6">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-one">
            <div class="stat-icon dib"><a href="/admin/properties"><i class="fa fa-home text-primary border-primary"></i></a></div>
            <div class="stat-content dib">
              <div class="stat-text">{{__('strings.backend.total_sale_properties')}}</div>
              <div class="stat-digit">{{ $allcount['buy'] }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-lg-6">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-one">
            <div class="stat-icon dib"><a href="/admin/properties"><i class="ti-home text-warning border-warning"></i></a></div>
            <div class="stat-content dib">
              <div class="stat-text">{{__('strings.backend.total_rent_properties')}}</div>
              <div class="stat-digit">{{ $allcount['rent'] }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-lg-6">
      <div class="card">
        <div class="card-body">
          <div class="stat-widget-one">
            <div class="stat-icon dib"><a href="/admin/notifications"><i class="fa fa-bell text-danger border-danger"></i></a></div>
            <div class="stat-content dib">
              <div class="stat-text">{{__('strings.backend.notifications')}}</div>
              <div class="stat-digit">{{ count($notifications) }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php if (auth()->user()->hasRole('broker')) { ?>
        <div class="col-xl-3 col-lg-6">
          <div class="card">
            <div class="card-body">
              <div class="stat-widget-one">
                <div class="stat-icon dib"><a href="#"><i class="ti-email text-info border-info"></i></a></div>
                <div class="stat-content dib">
                  <div class="stat-text">{{__('strings.backend.messages')}}</div>
                  <div class="stat-digit">{{ $allcount['messages'] }}</div>
                </div>
              </div>
            </div>
          </div>
        </div>
    <?php } ?>

    <div class="col-xl-6">
      <div class="card">
            <div class="card-header">
                <strong class="card-title">{{__('strings.backend.properties')}}</strong>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">{{__('strings.backend.broker')}}</th>
                      <th scope="col">{{__('strings.backend.title')}}</th>
                      <th scope="col">{{__('strings.backend.price')}}</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $counter = 0;
                        foreach($properties as $property){ 
                        $counter++;
                      ?>
                    <tr>
                      <th scope="row"><?php echo $property->property_no; ?></th>
                      <td>{{ $property->broker_name }}</td>
                      <td><a href="/admin/properties/{{ $property->id }}/edit">{{ $property->title }}</a></td>
                      <td>${{ number_format($property->price) }}</td>
                      <td><div class="btn-group btn-group-sm" role="group" aria-label="Properties Actions">
                                     
                                        <a href="{{ url('/admin/properties') }}/{{$property->id}}/edit" class="btn btn-primary">
                                            <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="'.__('buttons.general.edit').'"></i>
                                        </a>
                                        
                                    </div>   </td>
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

            // $('.entity').change(function () {
            //   $('.search-value').find('select').val('');
            //   $('.search-value').hide();

            //   if ($(this).val() != '') {
            //     $('.search-value-' + $(this).val()).show();
            //   }
            // });

            // $('.entity').change();

            $('.search-value').change(function (e) {
                e.preventDefault();

                if ($(this).find(":selected").attr('data-url') != '') {
                  location.href = $(this).find(":selected").attr('data-url');
                }
            });
        });
    </script>     
@endpush('after-scripts')