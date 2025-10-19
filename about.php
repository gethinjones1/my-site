<?php ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>About — Retro ’95</title>
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
      <header class="titlebar px-3 py-2 flex items-center justify-between">
        <h1 class="font-bold">About this Site</h1>
        <div class="text-xs">[x]</div>
      </header>
      <div class="p-4 space-y-4">
        <p>Built with <span class="font-bold">Tailwind</span> but styled like it’s <span class="font-bold">1995</span>. Keyboard friendly, readable, and fast.</p>
        <ul class="list-disc ml-6">
          <li>Old-school chrome: bevels, gray windows, pixel font.</li>
          <li>Modern UX: responsive grid, accessible focus styles, local storage.</li>
          <li>No build step: served as plain PHP/HTML using CDN Tailwind.</li>
        </ul>
        <p>Use the taskbar below to jump around. Try <a class="linkish underline" href="/projects.php">Projects</a> for draggable windows.</p>
      </div>
    </section>
  </main>

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
