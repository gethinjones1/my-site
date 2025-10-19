<?php ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gallery — Retro ’95</title>
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
  <main class="absolute inset-x-0 top-0 bottom-12 p-4 space-y-4">
    <section class="win bevel-down max-w-5xl mx-auto">
      <header class="titlebar px-3 py-2"><h2 class="font-bold">Pixel Gallery</h2></header>
      <div class="p-4 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-3">
        <div class="aspect-square bg-gray-200 bevel-up flex items-center justify-center">IMG 1</div>
<div class="aspect-square bg-gray-200 bevel-up flex items-center justify-center">IMG 2</div>
<div class="aspect-square bg-gray-200 bevel-up flex items-center justify-center">IMG 3</div>
<div class="aspect-square bg-gray-200 bevel-up flex items-center justify-center">IMG 4</div>
<div class="aspect-square bg-gray-200 bevel-up flex items-center justify-center">IMG 5</div>
<div class="aspect-square bg-gray-200 bevel-up flex items-center justify-center">IMG 6</div>
<div class="aspect-square bg-gray-200 bevel-up flex items-center justify-center">IMG 7</div>
<div class="aspect-square bg-gray-200 bevel-up flex items-center justify-center">IMG 8</div>
<div class="aspect-square bg-gray-200 bevel-up flex items-center justify-center">IMG 9</div>
<div class="aspect-square bg-gray-200 bevel-up flex items-center justify-center">IMG 10</div>
<div class="aspect-square bg-gray-200 bevel-up flex items-center justify-center">IMG 11</div>
<div class="aspect-square bg-gray-200 bevel-up flex items-center justify-center">IMG 12</div>
      </div>
    </section>

    <section class="win bevel-down max-w-3xl mx-auto">
      <header class="titlebar px-3 py-2"><h2 class="font-bold">ASCII Art</h2></header>
      <div class="p-4">
        <textarea id="asciiText" class="w-full h-32 p-2 bg-white text-black border border-gray-400" placeholder="Type here"></textarea>
        <button id="asciiBtn" class="mt-2 bevel-up bg-gray-200 px-3 py-1 shadow-inner">Render</button>
        <pre id="asciiOut" class="mt-3 bg-black text-green-300 p-3 overflow-auto h-48"></pre>
      </div>
    </section>
  </main>
  <script>
    document.getElementById('asciiBtn').addEventListener('click',()=>{
      const t = document.getElementById('asciiText').value;
      const width = Math.min(60, Math.max(3, t.length + 2));
      const pad = (s)=> s.padEnd(width-2, ' ');
      const border = '+' + '-'.repeat(width-2) + '+';
      const lines = t.split('\n').map(s=>'|' + pad(' ' + s) + '|');
      document.getElementById('asciiOut').textContent = [border, ...lines, border].join('\n');
    });
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
