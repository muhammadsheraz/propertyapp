@extends('frontend.layouts.only_pano')

@section('meta_description', $property->meta_description)
@section('meta_keywords', $property->meta_keywords)

@section('share_url', url('/properties/' . $property->id))
@section('share_title', $property->title)
@section('share_description', $property->description_excerpt)
@section('share_image', \Storage::url($property->cover_image->image_path))

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

    // foreach($properties as $property){ 
    $location = $property->street1 . ' ' .  $property->street2 . ', ' . $property->state . ', ' . $property->city_name . '/' . $property->district_name;
    // $location = 'Kaltakiye Mahallesi, 588. Sk., 01960 Ceyhan/Adana, Turkey';

    $rent_value = '';
    if($property->property_purpose == 'rent'){            
        $rent_value =  (string) number_format($property->price , 2)  . '/month';
        $purp = 'FOR RENT';
    }else{
      $rent_value = number_format($property->price , 2)  ;
      $purp = 'FOR SALE';
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
                      <div id="myPano" class="pano panorama-view" data-image-url="{{ Storage::url($image->image_url) }}">
                        <div class="controls">
                          <a href="javascript: void(0)" class="left">&laquo;</a>
                          <a href="javascript: void(0)" class="right">&raquo;</a>
                        </div>
                      </div>
              <?php } ?>
              <?php endforeach; ?>
              <?php } ?>
    </div>
  </div>
<!-- Panorama End -->
@endsection

@push('after-scripts')
<script type="text/javascript">      

$(function(){

  $(".panorama-view").pano({
    img: $('.panorama-view').attr('data-image-url'),
  });

  $('.property-gallery').slick({
      infinite: true,
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
