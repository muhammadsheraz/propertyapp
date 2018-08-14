@extends('frontend.layouts.front')

@section('title', app_name() . ' | '.__('navs.general.home'))
@section('meta_description', $meta_description)
@section('meta_keywords', $meta_keywords)


@section('content')
<div class="header-sec-lite">
    <div class="filter bg-white rounded position-relative">
      @include('frontend.includes.search-bar')
    </div>
</div>

<div class="view-sec">
  <div class="container">
    <div class="col-12 mt-5">
        <div class="row top-row mb-2">
          <div class="col">
            <?php if (!empty($request_input['property_purpose']) AND $request_input['property_purpose'] == 'rent') { ?>
                <h2 class="weight-light">{{ __('strings.frontend.properties_for_rent')}}</h2>
            <?php } else if (!empty($request_input['property_purpose']) AND $request_input['property_purpose'] == 'buy') { ?> 
                <h2 class="weight-light">{{ __('strings.frontend.properties_for_sale')}}</h2>
            <?php } else { ?>
                <h2 class="weight-light">{{ __('strings.frontend.properties_search_results')}}</h2>
            <?php } ?>
          </div>
          <div class="col text-right">
          {{ html()->form('GET', route('frontend.properties.list'))->open() }}
              <select name="pre_order_by" id="pre_order_by">
                  <option value="">{{ __('strings.frontend.sort_by')}}</option>
                <option value="{{config('app.cheapest')}}" <?php echo array_get($request_input, 'order_by') == config('app.cheapest') ? "selected" : ""; ?>>{{ __('strings.frontend.cheapest') }}</option>
                <option value="{{config('app.highest')}}" <?php echo array_get($request_input, 'order_by') == config('app.highest') ? "selected" : ""; ?>>{{ __('strings.frontend.highest') }}</option>
                <option value="{{config('app.newest')}}" <?php echo array_get($request_input, 'order_by') == config('app.newest') ? "selected" : ""; ?>>{{ __('strings.frontend.newest') }}</option>
                <option value="{{config('app.oldest')}}" <?php echo array_get($request_input, 'order_by') == config('app.oldest') ? "selected" : ""; ?>>{{ __('strings.frontend.oldest') }}</option>
              </select>
              {{ html()->form()->close() }}
          </div>
        </div>
      <div class="row list-row">
        <?php 
          if (!empty($properties)) {
            foreach ($properties as $property) { 
              $rent_value = '';
              if($property->property_purpose == 'rent'){
                if ($property->payment_duration == '' or $property->payment_duration == '1'){
                  $rent_value = (string) number_format($property->price , 2) . '/' . $property->duration_unit;
                }else{
                  $rent_value =  (string) number_format($property->price , 2)  . '/' . $property->payment_duration . " " . $property->duration_unit;
                }
              }else{
                $rent_value = number_format($property->price , 2)  ;
              }
            ?>
            <div class="cards list col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-4">
            <div class="card-inner">
              <a href="{{ route('frontend.properties') }}/<?php echo $property->id; ?>">
                <?php if(!empty($property->cover_image->image_url)){ ?>
                  <img class="card-img-top" src="{{ Storage::url($property->cover_image->image_url) }}" alt="List">
                <?php } ?>
              </a>
              <div class="card-body">
                <h4 class="card-title weight-black mb-1">{!! get_currency_symbol($property->currency)!!}<?php echo $rent_value; ?></h4>
                <p class="card-text weight-bold mb-1">
                  <a href="{{ route('frontend.properties') }}/<?php echo $property->id; ?>">
                      {!! str_limit(get_property_title_by_lang($property), 40,'...')  !!}
                  </a>
                </p>
                <p class="location"><i class="fa fa-map-marker"></i> <?php echo $property->city_name; ?> | <?php echo $property->district_name; ?></p>
                <p class="card-text rooms weight-bold"><?php echo $property->rooms; ?> Rooms | <?php echo get_property_types($property->property_type); ?></p>
              </div>
            </div>
          </div>
          <?php } ?>
        <?php } else { ?>
          <div class="col">
            <div class="no-results">
              <?php echo __('strings.frontend.no_properties_found'); ?>
            </div>  
          </div>  
          </div>  
        <?php } ?>     
      </div>

      <div class="top-row mb-2 text-xs-center">
        <div class="col nav-container">
            <?php if (empty($nav_links)) {
              $nav_links = '';
            }?>

          {!! $nav_links !!}
        </div>
      </div>


    </div>
    
  </div>
</div>
@endsection

@push('after-scripts')
<script>
  $(function () {
    $('#pre_order_by').on('change', function () {
      $('#order_by').val($(this).val()).change().closest('form').submit();
    });
  });
</script>
<style>
  #pre_order_by {
    background: #c5212d;
    color: #fff;
    border: none;
    font-weight: 600;
  }

.page-item.active .page-link {
    background: #c5212d !important;
    border-color: #dee2e6;
}

.header-sec-lite {
    display: none;
    padding: 0 200px;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
}  
</style>
@endpush

