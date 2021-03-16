<form action="{{ route('statuses.store') }}" method="post">
  @include('shared._errors')
  {{ csrf_field() }}
  <textarea name="content" id="" cols="30" rows="3" class="form-control">
    {{ old('content') }}
  </textarea>
  <div class="text-right">
    <button type="submit" class="btn btn-primary mt-3">發佈</button>
  </div>
</form>
