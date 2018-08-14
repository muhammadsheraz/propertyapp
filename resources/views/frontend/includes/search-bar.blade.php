{{ html()->form('GET', route('frontend.properties.list'))->open() }}



      <div class="row">

        <div class="col-sm-12 col-md-10 col-lg-10 col-xl-10">

          <div class="first-row row">

            <div class="col-sm-12 col-lg-4">

                <select name="city_id" id="city_id">

                    <?php foreach ($cities as $city) { ?>

                        <option value="<?php echo $city->id; ?>" <?php echo array_get($request_input, 'city_id') == $city->id ? "selected" : ""; ?>><?php echo $city->city_name; ?></option>

                    <?php } ?>

                </select>

            </div>



            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">

                <input type="text" name="search_text" id="search_text" placeholder="{{ __('strings.frontend.search') }}" value="<?php echo array_get($request_input, 'search_text', ''); ?>">

            </div>



            <div class="col-sm-12 col-lg-4">

                <select name="property_purpose" id="property_purpose">

                    <option value="buy" <?php echo array_get($request_input, 'property_purpose') == config('app.buy') ? "selected" : ""; ?>>{!! __('strings.frontend.for_sale') !!}</option>

                    <option value="rent" <?php echo array_get($request_input, 'property_purpose') == config('app.rent') ? "selected" : ""; ?>>{!! __('strings.frontend.for_rent') !!}</option>

                </select>

            </div>



          </div>

          <div class="first-row my-0 my-lg-3 row">

          

        <div class="col-sm-12 col-lg-4">            

            <select class="last" name="district_id" id="district_id">

                <option value="">{!! __('labels.location.district') !!}</option>

                <?php foreach ($districts as $district) { ?>

                    <option value="<?php echo $district->id; ?>" data-city-id="<?php echo $district->city_id; ?>" <?php echo array_get($request_input, 'district_id') == $district->id ? "selected" : ""; ?>><?php echo $district->name; ?></option>

                <?php } ?>

            </select>        

        </div>

        

        <div class="col-sm-12 col-lg-4">

            <select name="property_type" id="property_type">

                <option value="">{!! __('labels.general.property_type') !!}</option>

                <?php foreach (get_property_types() as $property_id => $property_type) { ?>

                    <option value="<?php echo $property_id; ?>" <?php echo array_get($request_input, 'property_type') == $property_id ? "selected" : ""; ?>><?php echo $property_type; ?></option>

                <?php } ?>

            </select>

        </div>

        <div class="col-sm-12 col-lg-4">

            <select name="rooms" id="rooms">

                <option value="">{!! __('labels.general.rooms') !!}</option>

                <?php foreach (get_rooms() as $key => $value) { ?>

                    <option value="<?php echo $key; ?>" <?php echo array_get($request_input, 'rooms') == $key ? "selected" : ""; ?>><?php echo $value; ?></option>

                <?php } ?>                

            </select>

        </div>



        <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 d-none">

          <div class="price-range">{{__('strings.frontend.price')}}

            <input name="price_from" id="price_from" type="hidden" value="0">

            <input name="price_to" id="price_to" type="range" min="1" max="10000000" value="<?php echo array_get($request_input, 'price_to', '10000000')?>">

        </div>

            

            </div>

            <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 d-none">    

            <select name="order_by" id="order_by" class="d-none">

                <option value="">{{ __('strings.frontend.sort_by') }}</option>

                <option value="{{config('app.cheapest')}}" <?php echo array_get($request_input, 'order_by') == config('app.cheapest') ? "selected" : ""; ?>>{{ucfirst(config('app.cheapest'))}}</option>

                <option value="{{config('app.highest')}}" <?php echo array_get($request_input, 'order_by') == config('app.highest') ? "selected" : ""; ?>>{{ucfirst(config('app.highest'))}}</option>

                <option value="{{config('app.newest')}}" <?php echo array_get($request_input, 'order_by') == config('app.newest') ? "selected" : ""; ?>>{{ucfirst(config('app.newest'))}}</option>

                <option value="{{config('app.oldest')}}" <?php echo array_get($request_input, 'order_by') == config('app.oldest') ? "selected" : ""; ?>>{{ucfirst(config('app.oldest'))}}</option>

            </select>

        </div>

          </div>

          <div class="third-row row">

            <div class="col">

                <input type="checkbox" name="car_park" value="1" <?php echo !empty(array_get($request_input, 'car_park')) ? "checked" : ""; ?>>

                {{__('strings.frontend.car_park')}}

            </div>

            <div class="col">

                <input type="checkbox" name="elevator" value="1" <?php echo !empty(array_get($request_input, 'elevator')) ? "checked" : ""; ?>>

                    {{__('strings.frontend.elevator')}}

            </div>

            <div class="col">

                <input type="checkbox" name="private_security" value="1" <?php echo !empty(array_get($request_input, 'private_security')) ? "checked" : ""; ?>>

                    {{__('strings.frontend.security')}}

            </div>

            <div class="col">

                <input type="checkbox" name="garden" value="1" <?php echo !empty(array_get($request_input, 'garden')) ? "checked" : ""; ?>>

                    {{__('strings.frontend.garden')}}

            </div>

            <div class="col-3">

                <input type="checkbox" name="playground" value="1" <?php echo !empty(array_get($request_input, 'playground')) ? "checked" : ""; ?>>

                {{__('strings.frontend.smart_house')}}

            </div>

          </div>

        </div>

        <div class="col-sm-12 col-md-2 col-lg-2 col-xl-2"> <button type="submit" class="search-btn red-bg">{{ __('strings.frontend.search') }}</button> </div>

      </div>

{{ html()->form()->close() }}



@push('after-scripts')

<script type="text/javascript">

    $(function () {

        $('#city_id').on('change', function () {

        if ($(this).val() != '') {

                $('#district_id').find('option').hide();

                var districtOption = $('#district_id').find('[data-city-id="' + $(this).val() + '"]');

                districtOption.each(function () {

                    $(this).show();

                });            

                $('#district_id').val('').change();

                $('#district_id').find('option').each(function () {

                    if ($(this).css('display') === 'block'){

                        $(this).prop('selected', true);

                        return;

                    }

                });

                $('#district_id').change();

            }

        });

    });

</script>

@endpush



