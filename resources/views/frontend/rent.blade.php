@extends('frontend.layouts.only_content')

@section('title', $page->title)
@section('meta_description', $page->meta_description)
@section('meta_keywords', $page->meta_keyword)

@section('content')

<div class="view-sec">
  <div class="container">
    <div class="col-12 mt-5">
        <div class="row top-row mb-2">
            <h2 class="weight-light"><?php echo $page->title ?></h2>
        </div>
    </div>
    <div class="content">
        <?php echo $page->content;  ?>
    </div>
</div>
@endsection
