@extends('admin._layouts.app')
@section('title', $title)
@section('content')
  {{ Form::open(['route' => ['admin.work.store'], 'method' => 'post', 'files' => true]) }}
  @csrf
  @method('post')
  @include('.admin.work._form')
  <div class="my-3 pt-3 border-top">
    <a class="btn btn-outline-secondary" href="{{ route('admin.work.index') }}">一覧に戻る</a>
  </div>
  {{ Form::close() }}
@endsection
