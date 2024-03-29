<div class="list-group-item">
  <img src="{{ $user->gravatar() }}" alt="{{ $user->name }}" class="mr-3">
  <a href="{{ route('users.show', $user) }}">
    {{ $user->name}}
  </a>
  @can('destroy', $user)
    <form action="{{ route('users.destroy', $user->id) }}" method="post" class='float-right'>
      {{ csrf_field() }}
      {{ method_field('DELETE') }}
      <button type="submit" class="btn btn-sm btn-danger delete-btn">刪除</button>
    </form>
  @endcan
</div>
