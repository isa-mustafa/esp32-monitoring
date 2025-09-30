const CORRECT_PWD = "12345";
const pwdModal = document.getElementById('pwdModal');
const pwdBtn = document.getElementById('pwdBtn');
const pwdInput = document.getElementById('pwdInput');
const pwdError = document.getElementById('pwdError');
const logoutBtn = document.getElementById('logoutBtn');
const serverToggle = document.getElementById('serverToggle');
const serverStatus = document.getElementById('serverStatus');
const manualStatus = document.getElementById('manualStatus');
const saveManual = document.getElementById('saveManual');
const tempValue = document.getElementById('tempValue');
const humValue = document.getElementById('humValue');
const tempStats = document.getElementById('tempStats');
const humStats = document.getElementById('humStats');

let serverOn = false;
let tempHistory = JSON.parse(localStorage.getItem('tempHistory')) || [];
let humHistory = JSON.parse(localStorage.getItem('humHistory')) || [];
let listrikHistory = JSON.parse(localStorage.getItem('listrikHistory')) || [];

// Login
if (localStorage.getItem('esp_logged') === 'true') {
  pwdModal.classList.add('hidden');
  logoutBtn.classList.remove('hidden');
}

pwdBtn.addEventListener('click', () => {
  if (pwdInput.value.trim() === CORRECT_PWD) {
    localStorage.setItem('esp_logged', 'true');
    pwdModal.classList.add('hidden');
    logoutBtn.classList.remove('hidden');
  } else {
    pwdError.classList.remove('hidden');
    setTimeout(()=> pwdError.classList.add('hidden'), 2000);
  }
});

logoutBtn.addEventListener('click', () => {
  localStorage.removeItem('esp_logged');
  location.reload();
});

function saveListrikEvent(status) {
  const now = new Date();
  listrikHistory.unshift({ status, time: now.toISOString() });
  if (listrikHistory.length > 200) listrikHistory.pop();
  localStorage.setItem('listrikHistory', JSON.stringify(listrikHistory));
}

serverToggle.addEventListener('click', () => {
  serverOn = !serverOn;
  serverStatus.textContent = serverOn ? 'Online' : 'Offline';
  serverStatus.style.color = serverOn ? '#22c55e' : '#ef4444';
  serverToggle.textContent = serverOn ? 'Turn Off' : 'Turn On';
  saveListrikEvent(serverOn ? 'Nyala' : 'Mati');
});

saveManual.addEventListener('click', () => {
  saveListrikEvent(manualStatus.value);
  alert('Riwayat tersimpan: ' + manualStatus.value);
});

const tempChart = new Chart(document.getElementById('tempChart'), {
  type: 'line',
  data: { labels: Array(10).fill(''), datasets: [{ data: Array(10).fill(0), borderColor:'#3b82f6', fill:true, tension:0.3 }] },
  options: { plugins:{legend:{display:false}}, scales:{x:{display:false}, y:{beginAtZero:true}} }
});

const humChart = new Chart(document.getElementById('humChart'), {
  type: 'line',
  data: { labels: Array(10).fill(''), datasets: [{ data: Array(10).fill(0), borderColor:'#10b981', fill:true, tension:0.3 }] },
  options: { plugins:{legend:{display:false}}, scales:{x:{display:false}, y:{beginAtZero:true}} }
});

setInterval(() => {
  if (!serverOn || localStorage.getItem('esp_logged') !== 'true') return;
  const t = 24 + Math.random()*6;
  const h = 50 + Math.random()*20;
  tempValue.textContent = t.toFixed(1) + ' °C';
  humValue.textContent = h.toFixed(1) + ' %';
  tempChart.data.datasets[0].data.shift(); tempChart.data.datasets[0].data.push(t); tempChart.update();
  humChart.data.datasets[0].data.shift(); humChart.data.datasets[0].data.push(h); humChart.update();
}, 2000);
