@extends('frontend.layouts.front')

@section('title', app_name() . ' | '.__('navs.general.home'))

@section('content')

<div class="header-sec">
  <div class="container">
    <div class="intro text-center text-white">
      <h1 class="weight-black">{!! __('strings.frontend.the_best_way_to_find_your_home') !!}</h1>
      <h4>{!! __('strings.frontend.banner_description') !!}</h4>
    </div>
    <div class="filter bg-white rounded position-relative">
      <div class="row">
        @include('frontend.includes.search-bar')    
      </div>
    </div>
  </div>
</div>
<div class="view-sec">
  <div class="container">
    <div class="col-12 mt-5">
      <div class="row top-row mb-2">
        <h2 class="weight-light">{{__('strings.frontend.search_results')}}</h2>
      </div>

      <div class="row list-row">

        <?php 
        foreach($properties as $property){ 
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
          <div class="card-inner"><a href="{{ route('frontend.properties') }}/<?php echo $property->id; ?>">
          <?php if(!empty($property->property_image)){ ?>
          <img class="card-img-top" src="{{Storage::url($property->property_image) }}" alt="List">
          <?php } ?>
          </a>
            <div class="card-body">
              <h4 class="card-title weight-black mb-1">$<?php echo $rent_value; ?></h4>
              <p class="card-text weight-bold mb-1">
                <a href="{{ route('frontend.properties') }}/<?php echo $property->id; ?>">
                    <?php echo $property->title; ?>
                </a>
              </p>
              <p class="location"><i class="fa fa-map-marker"></i> <?php echo $property->city_name; ?> | <?php echo $property->district_name; ?></p>
              <p class="card-text rooms weight-bold"><?php echo $property->rooms; ?> __('strings.frontend.rooms') | <?php echo get_property_types($property->property_type); ?></p>
            </div>
          </div>
        </div>
      <?php } ?>

      </div>
    </div>
    
  </div>
</div>


@endsection
