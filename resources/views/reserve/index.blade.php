@extends('_layouts.app')
@section('title', $title ?? '')
@section('description', $description ?? '')
@section('content')
  <div class="container">
    <div class="d-flex justify-content-center">
      <div class="col-md-8 bg-white border">
        <div class="py-5 text-center">
          <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
          <h2>Worker・queue検証用フォーム</h2>
          <p class="lead">
            ここではsendではなく、queueを使った処理を使用しています。<br>
            修正点あればプルリクお願いします＞＜
          </p>
        </div>

        <div class="d-flex justify-content-center">
          <div class="col-md-10">
            {{ Form::open(['route' => ['reserve.post'], 'method' => 'post']) }}
            @csrf
            @method('post')

            {{--  Layout 拡張に対応できるように細分化してある--}}
            @include('reserve._form')
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection