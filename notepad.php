<?php ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Notepad — Retro ’95</title>
  <meta name="theme-color" content="#008080" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=VT323&display=swap" rel="stylesheet">
  <style>
    body { font-family: "VT323", monospace; font-size: 20px; }
    .crt::before {
      content: "";
      pointer-events: none;
      position: fixed; inset: 0; z-index: 50; mix-blend-mode: multiply;
      opacity: 0.12;
      background: repeating-linear-gradient(
        to bottom,
        rgba(0,0,0,0.15), rgba(0,0,0,0.15) 1px,
        rgba(0,0,0,0) 2px, rgba(0,0,0,0) 3px
      );
    }
    .bevel-up { border-width: 2px; border-style: solid; border-color: #ffffff #808080 #808080 #ffffff; }
    .bevel-down { border-width: 2px; border-style: solid; border-color: #808080 #ffffff #ffffff #808080; }
    .titlebar { background: linear-gradient(#000080, #000060); color: #fff; }
    .win { background:#c0c0c0; }
    .linkish { color:#0000ee; }
    .linkish:visited { color:#551a8b; }
  </style>
</head>

<body class="bg-teal-700 text-black crt min-h-screen pb-12">
  <main class="absolute inset-x-0 top-0 bottom-12 p-4">
    <section class="win bevel-down max-w-3xl mx-auto">
      <header class="titlebar px-3 py-2 flex justify-between items-center">
        <h2 class="font-bold">Notepad</h2>
        <div class="text-xs">Ctrl+S to save</div>
      </header>
      <div class="p-3 space-y-3">
        <textarea id="pad" class="w-full h-[50vh] p-2 bg-white text-black border border-gray-400" placeholder="Type notes..."></textarea>
        <div class="flex flex-wrap gap-2">
          <button id="save" class="bevel-up bg-gray-200 px-3 py-1 shadow-inner">Save</button>
          <button id="load" class="bevel-up bg-gray-200 px-3 py-1 shadow-inner">Load</button>
          <button id="clear" class="bevel-up bg-gray-200 px-3 py-1 shadow-inner">Clear</button>
          <button id="download" class="bevel-up bg-gray-200 px-3 py-1 shadow-inner">Download .txt</button>
        </div>
        <p class="text-sm">Data is stored locally in your browser (localStorage).</p>
      </div>
    </section>
  </main>
  <script>
    const key='retro_notepad';
    const pad=document.getElementById('pad');
    function save(){ localStorage.setItem(key, pad.value); }
    function load(){ pad.value = localStorage.getItem(key) || ''; }
    document.getElementById('save').addEventListener('click', save);
    document.getElementById('load').addEventListener('click', load);
    document.getElementById('clear').addEventListener('click', ()=>{ pad.value=''; save(); });
    document.getElementById('download').addEventListener('click', ()=>{
      const blob = new Blob([pad.value], {type:'text/plain'});
      const a=document.createElement('a'); a.href=URL.createObjectURL(blob); a.download='notes.txt'; a.click();
      URL.revokeObjectURL(a.href);
    });
    window.addEventListener('keydown',e=>{ if((e.ctrlKey||e.metaKey)&&e.key==='s'){ e.preventDefault(); save(); } });
    load();
  </script>

  <!-- Taskbar -->
  <div class="fixed bottom-0 left-0 right-0 h-12 bg-gray-300 flex items-center gap-2 px-2 border-t-2 border-gray-400">
    <a href="/index.php" class="bevel-up bg-gray-200 px-3 py-1 font-bold shadow-inner hover:bg-gray-100">Start</a>
    <nav class="flex gap-2 overflow-x-auto">
      <a href="/about.php" class="bevel-up bg-gray-200 px-3 py-1 shadow-inner">About</a>
      <a href="/projects.php" class="bevel-up bg-gray-200 px-3 py-1 shadow-inner">Projects</a>
      <a href="/gallery.php" class="bevel-up bg-gray-200 px-3 py-1 shadow-inner">Gallery</a>
      <a href="/notepad.php" class="bevel-up bg-gray-200 px-3 py-1 shadow-inner">Notepad</a>
    </nav>
    <div class="ml-auto text-sm select-none" id="clock"></div>
  </div>
  <script>
    function updateClock(){
      const el=document.getElementById('clock');
      const d=new Date(); el.textContent=d.toLocaleTimeString();
    }
    updateClock(); setInterval(updateClock,1000);
  </script>

</body>
</html>
