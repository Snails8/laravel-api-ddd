@extends('admin._layouts.app')
@section('title', $title)
@section('content')
  @includeWhen(session('flash_message'), 'admin._partials.flash_message_success')
  {{--  <a href="{{ route('admin.work.images.edit', ['work' => $work->id]) }}" class="btn btn-outline-success mb-2">施工事例画像登録</a>--}}
  {{ Form::open(['route' => ['admin.work.update', 'work' => $work->id], 'method' => 'put', 'files' => true]) }}
  @csrf
  @method('PUT')
  @include('admin.work._form')
  {{ Form::close() }}
  <div class="my-3 pt-3 border-top">
    <a class="btn btn-outline-secondary" href="{{ route('admin.work.index') }}" >一覧に戻る</a>
    <form name="delete" method="POST" action="{{ route('admin.work.destroy', ['work' => $work]) }}" class="d-inline">
      @csrf
      @method('DELETE')
      <input type="button" class="btn btn-outline-danger" role="button" data-bs-toggle="modal" data-bs-target="#deleteModal" value="削除">
      @include('admin._partials.confirm_delete_modal')
    </form>
  </div>
@endsection
