@extends('layouts.app')

@section('title', $page->title)

@section('content')
  <section style="margin-top: 100px;padding-top: 30px;">
    <div class="container">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="row">
            <div class="col-sm-12">
              <h1>{!! $page->title !!}</h1>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              {!! $page->content !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection