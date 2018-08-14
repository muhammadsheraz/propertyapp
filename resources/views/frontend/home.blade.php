@extends('frontend.layouts.front')

<?php 
    if (app()->getLocale() == 'en') { 
        $title = $page['title'];
        $content = $page['content'];
        $meta_keywords = $page['meta_keywords'];
        $meta_description = $page['meta_description'];
    } else { 
        $local_lang = app()->getLocale();

        $title = $page["title_$local_lang"];
        $content = $page["content_$local_lang"];
        $meta_keywords = $page["meta_keywords_$local_lang"];
        $meta_description = $page["meta_description_$local_lang"];
    } 
?>
@section('title', $title)
@section('meta_description', $meta_description)
@section('meta_keywords', $meta_keywords)

@section('content')

<div class="header-sec">
  <div class="container">
    <div class="intro text-center text-white">
      <h1 class="weight-black">{!! __('strings.frontend.Home_slider_heading') !!}</h1>
      <h4>{!! __('strings.frontend.Home_slider_text') !!}<br>.</h4>


    </div>
    <div class="filter bg-white rounded position-relative">
      @include('frontend.includes.search-bar')
    </div>
  </div>
</div>



<div class="view-sec">
  <div class="container">
    <!-- Recommended Properties -->
    <?php if (!empty($properties_recommended)) { ?>
      <div class="col-12 mt-5">
        <div class="top-row mb-2">
          <h2 class="weight-light">{!! __('strings.frontend.recommended_for_you') !!}</h2>
        <div class="row list-row">
          <?php 
          foreach($properties_recommended as $property){ 
            $rent_value = '';
            if($property->property_purpose == 'rent'){
              if ($property->payment_duration == '' or $property->payment_duration == '1'){
                $rent_value = (string) number_format($property->price , 2) . '/month';
              }else{
                $rent_value =  (string) number_format($property->price , 2)  . '/month';
              }
            }else{
              $rent_value = number_format($property->price , 2)  ;
            }
          ?>

          <div class="cards list col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-4">
            <div class="card-inner">
            <a href="{{ route('frontend.properties') }}/<?php echo $property->id; ?>">
            <?php if(!empty($property->property_image)){ ?>
              <img class="card-img-top" src="{{Storage::url($property->property_image) }}" alt="List">
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
                <p class="card-text rooms weight-bold"><?php echo $property->rooms; ?> {{ __('strings.frontend.rooms') }} | <?php echo get_property_types($property->property_type); ?></p>
              </div>
            </div>
          </div>
        <?php } ?>
        </div>
      </div>      
    <?php } ?>
    <!-- Rent Properties -->
    <div class="col-12 mt-5">
      <div class="top-row mb-2">
        <h2 class="weight-light">{!! __('strings.frontend.for_rent') !!}</h2>
        <a href="{{ url('/properties/list?property_purpose=rent') }}" class="view-all">{!! __('strings.frontend.view_all') !!} </a></div>
      <div class="row list-row">
        <?php 
        foreach($properties_rent as $property){ 
          $rent_value = '';
          if($property->property_purpose == 'rent'){
            if ($property->payment_duration == '' or $property->payment_duration == '1'){
              $rent_value = (string) number_format($property->price , 2) . '/' . __('strings.frontend.month');
            }else{
              $rent_value =  (string) number_format($property->price , 2)  . '/' . __('strings.frontend.month');
            }
          }else{
            $rent_value = number_format($property->price , 2)  ;
          }
        ?>

        <div class="cards list col-sm-12 col-md-12 col-lg-4 col-xl-4 mb-4">
          <div class="card-inner">
          <a href="{{ route('frontend.properties') }}/<?php echo $property->id; ?>">
          <?php if(!empty($property->property_image)){ ?>
            <img class="card-img-top" src="{{Storage::url($property->property_image) }}" alt="List">
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
              <p class="card-text rooms weight-bold"><?php echo $property->rooms; ?> {{ __('strings.frontend.rooms') }} | <?php echo get_property_types($property->property_type); ?></p>
            </div>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>

    <!-- Sale Properties -->
    <div class="col-12 mt-5">
      <div class="top-row mb-2">
        <h2 class="weight-light">{!! __('strings.frontend.for_sale') !!}</h2>
        <a href="{{ url('/properties/list?property_purpose=buy') }}" class="view-all"> {!! __('strings.frontend.view_all') !!}</a></div>
      <div class="row list-row">
        <?php 
        foreach($properties_buy as $property){ 
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
                    {!! str_limit(get_property_title_by_lang($property), 40,'...')  !!}
                </a>
              </p>
              <p class="location"><i class="fa fa-map-marker"></i> <?php echo $property->city_name; ?> | <?php echo $property->district_name; ?></p>
              <p class="card-text rooms weight-bold"><?php echo $property->rooms; ?> {{ __('strings.frontend.rooms') }} | <?php echo get_property_types($property->property_type); ?></p>
            </div>
          </div>
        </div>
      <?php } ?>
      </div>
    </div>
  </div>
</div>


<div class="col-12 red-bg redbg-sec text-white p-5">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 text-center fmi">
        <div class="mb-3 image"><img src="{{ url('/') }}/front/images/freshmarketinfo.png"></div>
        <h3 class="weight-black mb-1">{!! __('strings.frontend.fresh_market_info') !!}</h3>
        <p class="mb-0">{!! __('strings.frontend.fresh_market_info_description') !!}</p>
      </div>
      <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 text-center tc">
        <div class="mb-3 image"><img src="{{ url('/') }}/front/images/top-cities.png"></div>
        <h3 class="weight-black mb-1">{!! __('strings.frontend.top_cities') !!}</h3>
        <p class="mb-0">{!! __('strings.frontend.top_cities_description') !!}</p>
      </div>
      <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 text-center ma">
        <div class="mb-3 image "><img src="{{ url('/') }}/front/images/mobile.png"></div>
        <h3 class="weight-black mb-1">{!! __('strings.frontend.mobile_app') !!}</h3>
        <p class="mb-0">{!! __('strings.frontend.mobile_app_description') !!}</p>
      </div>
    </div>
  </div>
</div>

<div class="map-sec">
  <div class="col-12">
    <div class="row">
      <div class="container">
        <div class="row">
          <h2 class="weight-light pt-5 pb-5 mb-0 w-100 text-center">{!! __('strings.frontend.select_from_map') !!}</h2>
        </div>
      </div>
      <div id="map" style="height:500px; width: 100%">
      </div>
      </div>
  </div>
</div>

<div class="map_popup">
  
</div>
@include('frontend.includes.cta') 
@endsection

@push('after-scripts')
<script type="text/javascript">
    var locationCount, map, popup, Popup, popupDiv;

      function initMap() {
        definePopupClass();
          <?php

          if (!empty($properties_buy[0])) {
              $loc = $properties_buy[0]->street1 . ' ' .  $properties_buy[0]->street2 . ', ' . $properties_buy[0]->state . ', ' . $properties_buy[0]->city_name . '/' . $properties_buy[0]->district_name;
          } else {
              $loc = '';
          }
          ?>

          var location = 'Ankara, Turkey';

          var geocoder = new google.maps.Geocoder();

          geocoder.geocode( { 'address': location },          

            function(results, status) {

              if (status == google.maps.GeocoderStatus.OK) {
                latitude = results[0].geometry.location.lat();
                longitude = results[0].geometry.location.lng();              
                
                
                map = new google.maps.Map(document.getElementById('map'), {
                zoom: 7,
                center: new google.maps.LatLng(latitude, longitude),
              });
            }

          }); 

          var marker, i;
          var latitude = '';
          var longitude = '';

          <?php $i=0; foreach($properties_for_map as $city_str=>$counts){ $i++?>
            <?php
              $city_arr = explode('|', $city_str);  
              $city_name = $city_arr[0];
              $city_id = $city_arr[1];
            ?>
            geocoder.geocode( { 'address': '<?php echo $city_name; ?>' },          

              function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                  latitude = results[0].geometry.location.lat();
                  longitude = results[0].geometry.location.lng();
                  var innerHtml = '<a href="<?php echo url('/properties/list?city_id='. $city_id); ?>" target="_blank" class="bubble"><?php echo $counts; ?></a>';

                  $('<div/>', {
                      'id':'map_popup_<?php echo $i; ?>',
                      'html':innerHtml,
                  }).appendTo('body');
                  
                  popup = new Popup(
                            new google.maps.LatLng(latitude, longitude),
                            document.getElementById('map_popup_<?php echo $i; ?>')
                          );
                  popup.setMap(map);
                }
            });
          <?php  } ?>
      }

      /** Defines the Popup class. */
      function definePopupClass() {
        Popup = function(position, content) {
          this.position = position;

          content.classList.add('popup-bubble-content');

          var pixelOffset = document.createElement('div');
          pixelOffset.classList.add('popup-bubble-anchor');
          pixelOffset.appendChild(content);

          this.anchor = document.createElement('div');
          this.anchor.classList.add('popup-tip-anchor');
          this.anchor.appendChild(pixelOffset);

          // Optionally stop clicks, etc., from bubbling up to the map.
          this.stopEventPropagation();
        };
        // NOTE: google.maps.OverlayView is only defined once the Maps API has
        // loaded. That is why Popup is defined inside initMap().
        Popup.prototype = Object.create(google.maps.OverlayView.prototype);

        /** Called when the popup is added to the map. */
        Popup.prototype.onAdd = function() {
          this.getPanes().floatPane.appendChild(this.anchor);
        };

        /** Called when the popup is removed from the map. */
        Popup.prototype.onRemove = function() {
          if (this.anchor.parentElement) {
            this.anchor.parentElement.removeChild(this.anchor);
          }
        };

        /** Called when the popup needs to draw itself. */
        Popup.prototype.draw = function() {
          var divPosition = this.getProjection().fromLatLngToDivPixel(this.position);
          // Hide the popup when it is far out of view.
          var display =
              Math.abs(divPosition.x) < 4000 && Math.abs(divPosition.y) < 4000 ?
              'block' :
              'none';

          if (display === 'block') {
            this.anchor.style.left = divPosition.x + 'px';
            this.anchor.style.top = divPosition.y + 'px';
          }
          if (this.anchor.style.display !== display) {
            this.anchor.style.display = display;
          }
        };

        /** Stops clicks/drags from bubbling up to the map. */
        Popup.prototype.stopEventPropagation = function() {
          var anchor = this.anchor;
          anchor.style.cursor = 'auto';

          ['click', 'dblclick', 'contextmenu', 'wheel', 'mousedown', 'touchstart',
          'pointerdown']
              .forEach(function(event) {
                anchor.addEventListener(event, function(e) {
                  e.stopPropagation();
                });
              });
        };
      }    
</script>

<style type="text/css">
   .labels {
     color: red;
     background-color: white;
     font-family: "Lucida Grande", "Arial", sans-serif;
     font-size: 10px;
     font-weight: bold;
     text-align: center;
     width: 40px;     
     border: 2px solid black;
     white-space: nowrap;
   }


  /* The location pointed to by the popup tip. */
  .popup-tip-anchor {
    height: 0;
    position: absolute;
    /* The max width of the info window. */
    width: 200px;
  }
  /* The bubble is anchored above the tip. */
  .popup-bubble-anchor {
    position: absolute;
    width: 100%;
    bottom: /* TIP_HEIGHT= */ 22px;
    left: 0;
  }
  /* Draw the tip. */
  .popup-bubble-anchor::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 0;
    width: 0;
    height: 0;
    border-left: 10px solid transparent;
    border-right: 10px solid transparent;
    border-top: /* TIP_HEIGHT= */ 10px solid white;
  }
  /* The popup bubble itself. */
  .popup-bubble-content {
    position: absolute;
    top: 0;
    left: 10px;
    transform: translate(-50%, -100%);
    background-color: white;
    padding: 0px;
    border-radius: 5px;
    font-family: sans-serif;
    overflow-y: auto;
    max-height: 60px;
    box-shadow: 0px 2px 10px 1px rgba(0,0,0,0.5);
    font-size: 16px;
    font-weight: bolder;
  } 
  span.count {
    padding: 10px;
    display: inline-block;
    vertical-align: middle;
    background: #c5212d;
    color: #fff;
    margin-right: 10px;
    font-size: 20px;
}  
a.bubble {
  padding: 10px;
  display: inline-block;
  vertical-align: middle;
  background: #c5212d;
  color: #fff;
  margin: 0px;
  font-size: 20px;
}  
 </style>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeRY-hxEHaucvYIs-BodGYO4wv81roXpg&callback=initMap"></script>

@endpush
