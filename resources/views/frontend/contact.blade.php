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

<div class="view-sec">
  <div class="container">
    <div class="col-12 mt-5">
      <div class="row top-row mb-2">
      <div class="col-12">
        <h2 class="">{!! __('strings.frontend.contact_us') !!}</h2>
</div>
            <div class="login-form" style="width:100%">
            <div class="col-12 mb-5">
                <div class="row">
                    <div class="col-12 col-xl-6">

                {{ html()->form('POST', route('frontend.contact.send'))->open() }}
                
<div class="form-group">
{{ html()->label(__('validation.attributes.frontend.name'))->for('name') }}

{{ html()->text('name')
->class('form-control')
->attribute('maxlength', 191)
->required()
->autofocus() }}
</div><!--form-group-->
<div class="form-group">
{{ html()->label(__('validation.attributes.frontend.email'))->for('email') }}

{{ html()->email('email')
->class('form-control')
->attribute('maxlength', 191)
->required() }}
</div><!--form-group-->
<div class="form-group">
{{ html()->label(__('validation.attributes.frontend.phone'))->for('phone') }}

{{ html()->text('phone')
->class('form-control')
->attribute('maxlength', 191)
->required() }}
</div><!--form-group-->
<div class="form-group">
{{ html()->label(__('validation.attributes.frontend.message'))->for('message') }}

{{ html()->textarea('message')
->class('form-control')
->attribute('rows', 3) }}
</div><!--form-group-->                                
{{ form_submit(__('labels.frontend.contact.button')) }}

                {{ html()->form()->close() }}
</div>
<div class="col-12 col-xl-5 offset-0 offset-lg-1 mt-4">
    <p>{!! __('strings.frontend.contact_us_text') !!}
    </p>
    <ul class="contact">
        <li><i class="fa fa-home"></i> {!! __('strings.frontend.address') !!}</li>
        <li><i class="fa fa-envelope"></i> {!! __('strings.frontend.contact_email') !!}
        </li>
        <li><i class="fa fa-mobile"></i> {!! __('strings.frontend.mobile_number') !!}
        </li>
</ul>
</div>
</div>
            </div>
            </div>
    </div>
  </div>
</div>
@endsection
