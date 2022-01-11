<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <title>My Site</title>
  <link rel="stylesheet" href="{{asset('css/reset.css')}}">
  <link rel="stylesheet" href="{{asset('css/stamp.css')}}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv=" X-UA-Compatible" content="ie=edge">
</head>

<body>
  <header>
    <h1>Atte</h1>
    <ul>
      <li><a href="#">ホーム</a></li>
      <li><a href="#">日付一覧</a></li>
      <li>
        <form method="post" action="{{ route('logout') }}">
        @csrf
          <button type="submit" class="logout">ログアウト</button>
        </form>
      </li>
    </ul>
  </header>
  <main>
   <h2>{{ Auth::user()->name }}さんお疲れ様です！</h2>
   <div class="date-box">
    <form method="post" class="time-add" action="{{ route('edit') }}">
      @csrf
      <input type="hidden" name="start_time" value="<?php echo date("H:i:s") ?>">
      <button type="button" class="start_time" id="start_time" onclick="location.href='/stamp/start_time/{{ Auth::user()->id }}'">勤務開始</button>
    </form>
    <form method="post" class="time-add" action="{{ route('end_time') }}">
      @csrf
      <input type="hidden" name="end_time" value="<?php echo date("H:i:s") ?>">
      <button type="submit" class="end_time" id="end_time">勤務終了</button>
    </form>
   </div>
   <div class="date-box">
    <form method="post" class="time-add" action="{{ route('lest_start_time') }}">
    @csrf
    <input type="hidden" name="lest_start_time" value="<?php echo date("H:i:s") ?>">
      <button type="submit" class="lest_start_time" id="lest_start_time">休憩開始</button>
    </form>
    <form method="post" class="time-add" action="{{ route('lest_end_time') }}">
    @csrf
    <input type="hidden" name="lest_end_time" value="<?php echo date("H:i:s") ?>">
      <button type="submit" class="lest_end_time" id="lest_end_time">休憩終了</button>
    </form>
   </div>
  </main>
  <footer>
    <p>Atte,inc.</p>
  </footer>

<script>
  document.getElementById('start_time').addEventListener('click',
  function () {
    this.style.opacity = "0.1";
    this.style.pointerEvents = "none";
    document.getElementById('end_time').style.opacity = "1";
    document.getElementById('end_time').style.pointerEvents = "auto";
    document.getElementById('lest_start_time').style.opacity = "1";
    document.getElementById('lest_start_time').style.pointerEvents = "auto";
  })

  document.getElementById('lest_start_time').addEventListener('click',
  function () {
    this.style.opacity = "0.1";
    this.style.pointerEvents = "none";
    document.getElementById('start_time').style.pointerEvents = "none";
    document.getElementById('lest_end_time').style.opacity = "1";
    document.getElementById('lest_end_time').style.pointerEvents = "auto";
    document.getElementById('end_time').style.opacity = "0.1";
    document.getElementById('end_time').style.pointerEvents = "none";
  })

  document.getElementById('lest_end_time').addEventListener('click',
  function () {
    this.style.opacity = "0.1";
    document.getElementById('start_time').style.pointerEvents = "none";
    document.getElementById('lest_start_time').style.opacity = "1";
    document.getElementById('lest_start_time').style.pointerEvents = "auto";
    document.getElementById('end_time').style.opacity = "1";
    document.getElementById('end_time').style.pointerEvents = "auto";
  })

  document.getElementById('end_time').addEventListener('click',
  function () {
    this.style.opacity = "0.1";
    this.style.pointerEvents = "none";
    document.getElementById('start_time').style.opacity = "1";
    document.getElementById('start_time').style.pointerEvents = "auto";
    document.getElementById('lest_start_time').style.opacity = "0.1";
    document.getElementById('lest_start_time').style.pointerEvents = "none";
    document.getElementById('lest_end_time').style.pointerEvents = "none";
  })
</script>
</body>

</html>