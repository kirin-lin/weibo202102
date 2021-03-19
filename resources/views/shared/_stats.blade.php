<a href="#">
  <strong class="stat" id='following'>
    {{ count($user->followings) }}
  </strong>
  關注
</a>
<a href="#">
  <strong class="stat" id='followers'>
    {{ count($user->followers) }}
  </strong>
  粉絲
</a>
<a href="#">
  <strong class="stat" id="statuses">
    {{ $user->statuses()->count() }}
  </strong>
  微博
</a>
