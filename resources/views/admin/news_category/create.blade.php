@extends('admin._layouts.app')
@section('title', $title)
@section('content')
  {{ Form::open(['route' => ['admin.news_category.store'], 'method' => 'post']) }}
  @csrf
  @method('post')
  @include('.admin.news_category._form')
  <div class="my-3 pt-3 border-top">
    <a class="btn btn-outline-secondary" href="{{ route('admin.news_category.index') }}">一覧に戻る</a>
  </div>
  {{ Form::close() }}
@endsection