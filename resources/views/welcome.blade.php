<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>ESP32 Monitoring</title>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <style>
    body { font-family: Arial, sans-serif; margin: 0; background: #2c3e50; color: #111; }
    .container { padding: 10px; max-width: 800px; margin: auto; }
    .header { display: flex; justify-content: space-between; align-items: center; padding: 10px 0; }
    .header h1 { font-size: 1.2em; margin: 0; color: white; }
    .card { background: white; border-radius: 12px; padding: 12px; margin-bottom: 12px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .label { font-size: 0.9em; color: #555; margin-bottom: 5px; }
    .big-value { font-size: 1.8em; font-weight: bold; }
    .small-stat { font-size: 0.8em; color: #777; }
    .btn { padding: 10px; border: none; border-radius: 8px; font-size: 1em; cursor: pointer; margin-top: 6px; width: 100%; text-align:center; }
    .primary { background: #3b82f6; color: white; }
    .secondary { background: #9ca3af; color: white; }
    .danger { background: #ef4444; color: white; }
    .success { background: #10b981; color: white; }
    .grid { display: grid; grid-template-columns: 1fr; gap: 10px; }
    @media(min-width: 600px) {
      .grid { grid-template-columns: repeat(2, 1fr); }
    }
    .spacer { margin-top: 12px; }
    .btn {
  display: inline-block;
  text-decoration: none;
  text-align: center;
  padding: 12px 0px;
  border-radius: 30px;
  color: #fff;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s;
}

.btn.blue {
  background: #007bff;
}
  </style>
</head>
<body>

<div class="container">
  <header class="header">
    <h1>ESP32 Monitoring Server</h1>
    <form action="{{ route('logout') }}" method="POST">
      @csrf
      <button type="submit" id="logoutBtn" class="btn danger" style="width:auto; padding:6px 12px;">Logout</button>
    </form>
  </header>

  <main>
    <section class="grid">
      <div class="card">
        <div class="label">Suhu</div>
        <div id="tempValue" class="big-value">-- °C</div>
        <div id="tempStats" class="small-stat">Maks: -- | Rata-rata: --</div>
        <canvas id="tempChart" height="100"></canvas>
      </div>

      <div class="card">
        <div class="label">Kelembaban</div>
        <div id="humValue" class="big-value">-- %</div>
        <div id="humStats" class="small-stat">Maks: -- | Rata-rata: --</div>
        <canvas id="humChart" height="100"></canvas>
      </div>
    </section>

    <div class="card">
      <div class="label">Server Status</div>
      <div id="serverStatus" style="font-weight:bold; color:#ef4444;">Offline</div>
      <button id="serverToggle" class="btn primary">Turn On</button>

      <div class="spacer"></div>

        <a href="histori" class="btn blue">lihat history</a>
    </div>
  </main>
</div>

<script>
  const toggleBtn = document.getElementById("serverToggle");
  const serverStatus = document.getElementById("serverStatus");

  let isOn = false;

  toggleBtn.addEventListener("click", () => {
    isOn = !isOn;

    if(isOn){
      serverStatus.textContent = "Online";
      serverStatus.style.color = "#10b981"; // hijau
      toggleBtn.textContent = "Turn Off";
      toggleBtn.classList.remove("primary");
      toggleBtn.classList.add("danger");
    } else {
      serverStatus.textContent = "Offline";
      serverStatus.style.color = "#ef4444"; // merah
      toggleBtn.textContent = "Turn On";
      toggleBtn.classList.remove("danger");
      toggleBtn.classList.add("primary");
    }
  });
</script>

<script src="{{ asset('js/monitoring.js') }}"></script>

</body>
</html>
