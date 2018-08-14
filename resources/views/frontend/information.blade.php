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
            <h2 class="weight-light">{!! $title !!}</h2>
        </div>
    </div>
    <div class="content">
        {!! $content !!}
    </div>
</div>
@endsection
