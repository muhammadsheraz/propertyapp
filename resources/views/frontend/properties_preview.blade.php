@extends('frontend.layouts.only_content')

@section('title',  get_property_title_by_lang($property) . ' | ' . app_name())

@section('meta_description', $property->meta_description)
@section('meta_keywords', $property->meta_keywords)

@section('home_url', '#')

@section('content')
  <?php
    $fimage = '';
    if (!empty($property->images)) {
      foreach ($property->images as $image):
              
        if (!$image->is_featured) { 
          $fimage = Storage::url($image->image_url);
        } else{
          $himage = Storage::url($image->image_url);
          
        }
          
      endforeach;
    } 

    $location = $property->street1 . ' ' .  $property->street2 . ', ' . $property->state . ', ' . $property->city_name . '/' . $property->district_name;

    $rent_value = '';
    if($property->property_purpose == 'rent'){            
        $rent_value =  (string) number_format($property->price , 2)  . '/' . __('strings.frontend.month');
        $purp = __('strings.frontend.for_rent');
    }else{
      $rent_value = number_format($property->price , 2)  ;
      $purp = __('strings.frontend.for_sale');
    }
  ?>
  @section('title',  get_property_title_by_lang($property) . ',' . $property->city_name . ',' . $property->district_name . ' ' . ucfirst(strtolower($purp)) . ' | ' . app_name())

  <div class="col-12 top-head">
    <div class="row">
          <?php if (!empty($property->images)) { ?>
            <?php foreach ($property->images as $image): ?>
              <?php if ($image->is_pano) { ?>
                  <?php 
                    $cover_image = url('/') . "uploads/images/default_property.jpg";
                  ?>
                      <div class="intro text-center text-white">
                        <h1 class="weight-black">({!! get_currency_symbol($property->currency)!!}) {{ $rent_value or '0.00'   }}</h1>
                        <div class="red-bar"><?php echo $purp; ?></div>
                      </div>
                      <div id="myPano" class="pano panorama-view" data-image-url="{{ Storage::url($image->image_url) }}">
                        <div class="controls">
                          <a href="javascript: void(0)" class="left"><i class="fa fa-angle-double-left"></i></a>
                          <a href="javascript: void(0)" class="right"><i class="fa fa-angle-double-right"></i></a>
                        </div>
                      </div>
              <?php } ?>
              <?php endforeach; ?>
              <?php } ?>
    </div>
  </div>
              <!-- Panorama End -->





  <div class="container">
  <div class="col-12 mt-3">
    <div id="property_gallery" class="list-unstyled row">
      <?php if (!empty($property->images)) { ?>
      <?php foreach ($property->images as $image): ?>
          <?php if (!$image->is_pano) { ?>
            <div class="col-lg-3 col-xs-12" data-responsive="<?php echo Storage::url($image->image_url); ?>" data-src="<?php echo Storage::url($image->image_url); ?>" data-sub-html="<?php echo  get_property_title_by_lang($property) ; ?>">
              <?php 
                $cover_image = url('/') . "uploads/images/default_property.jpg";
              ?>
              <img class="img-responsive" src="<?php echo Storage::url($image->image_url); ?>" style="max-width: 100%" alt="List">
            </div>
          <?php } ?>
      <?php endforeach; ?>
      <?php } ?>
    </div>
</div>
</div>

<div class="view-sec">
  <div class="container">
    <div class="row">

      <div class="col-lg-8 col-xs-12 mt-5">

        <div class="col-12">
          <h2 class="">{{ get_property_title_by_lang($property) }}</h2>
          <!-- <p><?php // echo  $property->street1 . ' ' .  $property->street2 . ', '; ?><br><?php //echo $property->state . ', ' . $property->city_name . '/' . $property->district_name; ?></p> -->
        </div>

        

        <div class="col-12">

        <div class="row">
        <div class="col-12">
          <h2 class="weight-light d-none">{{ __('strings.frontend.facts') }}</h2>
          <ul class="facts-list">
            <li>
            <span class="heading">{{__('strings.backend.property_id')}}</span><span class="detail"><?php echo $property->property_no; ?></span></li>
            </ul>
            <ul class="facts-list">
            <li><span class="heading">{{__('strings.frontend.rooms')}}</span><span class="detail"><?php echo $property->rooms; ?></span></li>
            <li><span class="heading">{{__('strings.frontend.car_park')}}</span><span class="detail">
              <?php 
                if($property->car_park){
                  echo __('labels.general.yes');
                }else{
                  echo __('labels.general.no');
                }
              ?>
            </span></li>
            <li><span class="heading">{{__('strings.frontend.elevator')}}</span><span class="detail">
              <?php 
                if($property->elevator){
                  echo __('labels.general.yes');
                }else{
                  echo __('labels.general.no');
                }
              ?>
            </span></li>
            <li class="d-none"><span class="heading">{{__('strings.frontend.facts')}}</span><span class="detail">
            <?php 
                if($property->private_security){
                  echo __('labels.general.yes');
                }else{
                  echo __('labels.general.no');
                }
              ?>
              
            </span></li>
            <li><span class="heading">{{__('strings.frontend.garden')}}</span><span class="detail">
            <?php 
                if($property->garden){
                  echo __('labels.general.yes');
                }else{
                  echo __('labels.general.no');
                }
              ?>
            </span></li>
            <li><span class="heading">{{__('strings.frontend.smart_house')}}</span><span class="detail">
              
            <?php 
                if($property->playground){
                  echo __('labels.general.yes');
                }else{
                  echo __('labels.general.no');
                }
              ?>
            </span></li>
          </ul>
        </div>
          </div>
          {!! get_property_description_by_lang($property) !!}

        </div>
      </div>

      <div class="col-lg-4 mt-5 col-xs-12"> 

      <div class="col-12 my-5">
          <h3 class="weight-light sm">{{__('strings.frontend.broker_commission')}} 
          <?php 
              if($property->property_purpose == 'rent'){ 
                $commission = __('strings.backend.one_month_rent');
              } else {
                $commission = $property->commission_value . '%'; 
              }
          ?>
          
          {{ $commission }} + {{__('strings.frontend.vat')}}</h3>
          <p>{{__('strings.frontend.commision_and_terms_text')}}</p>
        </div>
        
        <div class="col-12 my-5">
          <div id="map" style="width: 100%; height: 500px;">
          </div>
        </div>
        
      </div>
    </div>
  </div>  
</div>



@endsection

@push('after-scripts')
<script type="text/javascript">      
      function initMap() {

        var map;
        
        var location = '<?php echo $location; ?>';
        //var location = 'london';
        console.log(location);

        var geocoder = new google.maps.Geocoder();

        geocoder.geocode( { 'address': location },          

          function(results, status) {

            if (status == google.maps.GeocoderStatus.OK) {
              latitude = results[0].geometry.location.lat();
              longitude = results[0].geometry.location.lng();              
              
              
              map = new google.maps.Map(document.getElementById('map'), {
              zoom: 12,
              center: new google.maps.LatLng(latitude, longitude),
            });
          }

        }); 

        var marker, i;
        <?php 
          $propertyTitle = htmlentities(get_property_title_by_lang($property), ENT_QUOTES, 'UTF-8', false);        
        ?>
        var locations = [
          ["{!! $propertyTitle !!}", location , 1]
        ];
        console.log(locations[0][1]);

        var latitude = '';
        var longitude = '';

        for (i = 0; i < locations.length; i++) {  
          

          geocoder.geocode( { 'address': locations[i][1]},          

            function(results, status) {

              if (status == google.maps.GeocoderStatus.OK) {
                latitude = results[0].geometry.location.lat();
                longitude = results[0].geometry.location.lng();              
                
                
                marker = new google.maps.Marker({
                  position: new google.maps.LatLng(latitude, longitude),
                  map: map
                });
              }

          });

        }

      }

$(function(){
  $('#property_gallery').lightGallery(); 

  $(".panorama-view").pano({
    img: $('.panorama-view').attr('data-image-url'),
  });

  $('.property-gallery').slick({
      infinite: true,
      rtl: true,
      slidesToShow: 4,
      slidesToScroll: 4,
      prevArrow: '<button class="fa fa-chevron-left slick-arrow" aria-label="Next" type="button" style=""></button>',
      nextArrow: '<button class="fa fa-chevron-right slick-arrow" aria-label="Next" type="button" style=""></button>'
  });
});
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCeRY-hxEHaucvYIs-BodGYO4wv81roXpg&callback=initMap"></script>
<style>
.slick-slider button {
  padding: 0px !important;
  background: none !important;
}

.slick-prev:before,
.slick-next:before
{
  color: #c5212d;
}

	
  .pano {
    width: 100%;
    height: 500px;
    margin: 0 auto;
    cursor: move;
  }
  .pano .controls a{
    position: absolute;
    top:50%;
    z-index: 1;
    font-size:30px;
    background: #fff;
    width:50px;
    height:50px;
    text-align: center;
    opacity: 0.75;
    transition: 0.5s ease;
  }
  .pano .controls a:hover{
    text-decoration: none;
    opacity: 1;
  }
  .pano .controls a.left{
    left:10px;
  }
  .pano .controls a.right{
    right:10px;
  }

  #lg-actual-size {
    display: none !important;
  }
</style>
@endpush
