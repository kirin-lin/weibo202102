@extends('layouts.default')
@section('title', '更新個人資料')

@section('content')
<div class="offset-md-2 col-md-8">
  <div class="card">
    <div class="card-header">
      <h5>更新個人資料</h5>
    </div>
    <div class="card-body">

      @include('shared._errors')


      <div class="gravatar_edit">
        <a href="http://gravatar.com/emails" target="_blank">
          <img src="{{ $user->gravatar('200') }}" alt="{{ $user->name }}" srcset="" class="gravatar">
        </a>
      </div>
      <form action="{{ route('users.update', $user->id) }}" method="post">
        {{ method_field('PATCH')}}
        {{ csrf_field() }}

        <div class="form-group">
          <label for="name">名稱</label>
          <input type="text" name="name" value="{{ $user->name }}" class="form-control">
        </div>

        <div class="form-group">
          <label for="email">郵箱：</label>
          <input type="text" name="email" value="{{ $user->email }}" class="form-control" disabled>
        </div>

        <div class="form-group">
          <label for="password">密碼：</label>
          <input type="password" name="password" value="{{ old('password') }}" class="form-control">
        </div>

        <div class="form-group">
          <label for="password_confirmation">確認密碼</label>
          <input type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">更新</button>
      </form>
    </div>
  </div>
</div>
@stop
