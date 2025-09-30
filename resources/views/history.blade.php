<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>History Listrik</title>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/images/Screenshot_2025-08-11_094926-removebg-preview.png') }}">
</head>
<body>
  <div class="container">
    <header class="header">
      <div class="header-left">
        <h1>History Listrik</h1>
      </div>
      <div class="header-right">
        <a class="btn link" href="{{ url('/') }}">⬅ Kembali</a>
      </div>
    </header>

    <main>
      <div id="historyList" class="history-list">
        @forelse($grouped as $dateKey => $items)
          <h2 class="history-date-title">{{ \App\Http\Controllers\HistoryController::getDateLabel($dateKey) }}</h2>

          @foreach($items as $item)
            <div class="card history-item {{ $item['event'] === 'MAINS_RETURN' ? 'on' : 'off' }}">
              <div class="history-left">
                <div class="status-circle {{ $item['event'] === 'MAINS_RETURN' ? 'on' : 'off' }}"></div>
              </div>
              <div class="history-body">
                <div class="history-status">
                  {{ $item['event'] === 'MAINS_RETURN' ? 'Listrik Menyala' : 'Listrik Mati' }}
                </div>
                <div class="history-time">
                  {{ \App\Http\Controllers\HistoryController::formatLocalTime($item['time']) }}
                </div>
              </div>
            </div>
          @endforeach
        @empty
          <div class="card empty">Belum ada histori.</div>
        @endforelse
      </div>
    </main>
  </div>
</body>
</html>
