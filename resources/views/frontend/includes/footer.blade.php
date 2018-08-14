<footer>
  <div class="col-12 py-5 bg-white">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 first-col">
          <div class="img-logo"><img src="{{ url('/') }}/front/images/logo.png"></div>
          <p class="pt-4">{!! __('strings.frontend.copyright_2018') !!}.</p>
          <p class="rights-reserved">{!! __('strings.frontend.all_rights_reserved') !!}.</p>
          <p class="color-red weight-bold powered-by">{!! __('strings.frontend.mt_pixels') !!}</p>
        </div>
        <?php if (empty($hide_nav)) { ?>
          <div class="col menu">
            <h6 class="heading weight-black">{!! __('strings.frontend.sitemap') !!}</h6>
            <ul>
              <?php if (!empty($pages['home']->status)) { ?>
                <li><a href="{{url('/')}}">{!! __('strings.frontend.home') !!}</a></li>
              <?php } ?>

              <?php if (!empty($pages['sale']->status)) { ?>
                <li><a href="{{url('/properties/list?property_purpose=buy')}}">{!! __('strings.frontend.sale') !!}</a></li>
              <?php } ?>

              <?php if (!empty($pages['rent']->status)) { ?>
                <li><a href="{{url('/properties/list?property_purpose=rent')}}">{!! __('strings.frontend.rent') !!}</a></li>
              <?php } ?>

              <?php if (!empty($pages['faqs']->status)) { ?>
                <li><a href="{{url('/information/faqs')}}">{!! __('strings.frontend.faqs') !!}</a></li>
              <?php } ?>

              <?php if (!empty($pages['broker']->status)) { ?>
                <li><a href="{{url('/information/broker')}}">{!! __('strings.frontend.broker') !!}</a></li>
              <?php } ?>
              
              <?php if (!empty($pages['contact']->status)) { ?>
                <li><a href="{{url('/contact')}}">{!! __('strings.frontend.contact_us') !!}</a></li>
              <?php } ?>
                
                
              <?php if (!empty($pages['terms-and-conditions']->status)) { ?>
                  <li><a href="{{url('/information/terms-and-conditions')}}">{!! __('strings.frontend.terms_and_conditions') !!}</a></li>
              <?php } ?>

            </ul>
          </div>

          <?php if (!empty($top_cities)) { ?>
            <div class="col menu">
              <h6 class="heading weight-black">{!! __('strings.frontend.tOP_cITIES') !!}</h6>
              <ul>
                <?php foreach ($top_cities as $top_city) { ?>
                  <?php 

                  ?>
                  <li><a href="{{ url('properties/list?city_id=' . $top_city->city_id )}}">{!! $top_city->city_name !!}</a></li>
                <?php } ?>
              </ul>
            </div>
          <?php } ?>

          <?php if (!empty(get_property_types())) { ?>
          <div class="col menu">
            <h6 class="heading weight-black">{!! __('strings.frontend.for_rent') !!}</h6>
            <ul>
              <?php foreach (get_property_types() as $property_id => $property_type) { ?>
                <li>
                  <a href="{{ url('properties/list?property_type=' . $property_id . '&property_purpose=rent' )}}">
                    <?php echo $property_type; ?>
                  </a>
              </li>
              <?php } ?>
            </ul>
          </div>
          <div class="col menu">
            <h6 class="heading weight-black">{!! __('strings.frontend.for_sale') !!}</h6>
            <ul>
              <?php foreach (get_property_types() as $property_id => $property_type) { ?>
                <li>
                    <a href="{{ url('properties/list?property_type=' . $property_id . '&property_purpose=buy' )}}">
                      <?php echo $property_type; ?>
                    </a>
                </li>
              <?php } ?>
            </ul>
          </div>
          <?php } ?>
        <?php } ?>

      </div>
    </div>
  </div>
</footer>