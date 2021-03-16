@extends('layouts.default')
@section('title', '重設密碼')

@section('content')
<div class="col-md-8 offset-md-2">
  <div class="card">
    <div class="card-header"><h5>重設密碼</h5></div>

    <div class="card-body">
      @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
      @endif

      <form action="{{ route('password.email') }}" method="post">
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="form-control-label">email: </label>

          <input type="email" name="email" id="" class="form-control" value="{{ old('email') }}">

          @if ($errors->has('email'))
          <span class="form-text">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>

        <div class="form-group">
          <button type="submit" class="btn btn-primary">發送重設密碼郵件</button>
        </div>
      </form>
    </div>
  </div>
</div>

@stop
