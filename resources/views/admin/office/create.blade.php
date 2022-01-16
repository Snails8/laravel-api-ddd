@extends('admin._layouts.app')
@section('title', $title)
@section('content')
  {{ Form::open(['route' => ['admin.office.store'], 'method' => 'post']) }}
  @csrf
  @method('post')
  @include('.admin.office._form')
  <div class="my-3 pt-3 border-top">
    <a class="btn btn-outline-secondary" href="{{ route('admin.office.index') }}">一覧に戻る</a>
  </div>
  {{ Form::close() }}
@endsection