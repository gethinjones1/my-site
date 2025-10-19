<?php ?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Projects — Retro ’95</title>
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
  <main class="absolute inset-x-0 top-0 bottom-12 p-2 sm:p-4">
    <!-- Window template -->
    <div class="win bevel-down w-[min(100%,700px)] mx-auto relative" id="win1" role="dialog" aria-labelledby="win1title">
      <div class="titlebar px-3 py-2 flex items-center gap-2 cursor-move" data-drag-handle>
        <div class="flex gap-1">
          <button class="w-4 h-4 bg-gray-200 bevel-up" data-min title="Minimize"></button>
          <button class="w-4 h-4 bg-gray-200 bevel-up" data-max title="Maximize"></button>
          <button class="w-4 h-4 bg-gray-200 bevel-up" data-close title="Close"></button>
        </div>
        <h2 id="win1title" class="font-bold">Project: Retro Window Manager</h2>
      </div>
      <div class="p-4 space-y-3">
        <p>This is a draggable, minimizable window. Use it as a template for more apps.</p>
        <div class="grid sm:grid-cols-2 gap-3">
          <a href="/notepad.php" class="bevel-up bg-gray-200 px-3 py-2 text-center shadow-inner">Open Notepad</a>
          <a href="/gallery.php" class="bevel-up bg-gray-200 px-3 py-2 text-center shadow-inner">Open Gallery</a>
        </div>
      </div>
    </div>

    <!-- Another window -->
    <div class="win bevel-down w-[min(100%,500px)] mt-4 mx-auto relative" id="win2" role="dialog" aria-labelledby="win2title">
      <div class="titlebar px-3 py-2 flex items-center gap-2 cursor-move" data-drag-handle>
        <div class="flex gap-1">
          <button class="w-4 h-4 bg-gray-200 bevel-up" data-min title="Minimize"></button>
          <button class="w-4 h-4 bg-gray-200 bevel-up" data-max title="Maximize"></button>
          <button class="w-4 h-4 bg-gray-200 bevel-up" data-close title="Close"></button>
        </div>
        <h2 id="win2title" class="font-bold">Project: JSON Viewer</h2>
      </div>
      <div class="p-4">
        <textarea id="jsonIn" class="w-full h-32 p-2 bg-white text-black border border-gray-400" placeholder='{"hello":"world"}'></textarea>
        <button id="parseBtn" class="mt-2 bevel-up bg-gray-200 px-3 py-1 shadow-inner">Parse</button>
        <pre id="jsonOut" class="mt-2 bg-black text-green-300 p-2 overflow-auto h-48"></pre>
      </div>
    </div>
  </main>

  <script>
    // Simple window manager (drag, z-index, min/max/close)
    (function(){
      let z=10;
      function makeWindow(win){
        win.style.position='relative';
        win.style.zIndex = ++z;
        win.addEventListener('mousedown',()=>win.style.zIndex=++z);
        const bar = win.querySelector('[data-drag-handle]');
        let ox=0, oy=0, sx=0, sy=0, dragging=false;
        bar.addEventListener('mousedown', e=>{
          dragging=true;
          const rect = win.getBoundingClientRect();
          sx = e.clientX; sy = e.clientY; ox = rect.left; oy = rect.top + window.scrollY;
          document.body.style.userSelect='none';
        });
        window.addEventListener('mousemove', e=>{
          if(!dragging) return;
          const dx = e.clientX - sx; const dy = e.clientY - sy;
          win.style.position='absolute';
          win.style.left = (ox+dx) + 'px';
          win.style.top = (oy+dy) + 'px';
        });
        window.addEventListener('mouseup', ()=>{ dragging=false; document.body.style.userSelect=''; });

        const min = win.querySelector('[data-min]');
        const max = win.querySelector('[data-max]');
        const close = win.querySelector('[data-close]');
        const content = win.children[1];
        let minimized=false, maximized=false, prev={};

        min?.addEventListener('click',()=>{
          minimized=!minimized;
          content.style.display = minimized?'none':'';
        });
        max?.addEventListener('click',()=>{
          maximized=!maximized;
          if(maximized){
            prev = {left:win.style.left, top:win.style.top, width:win.style.width};
            win.style.position='fixed';
            win.style.left='0'; win.style.top='0'; win.style.right='0';
            win.style.width='100%';
          } else {
            win.style.position='absolute';
            win.style.left=prev.left||''; win.style.top=prev.top||''; win.style.width=prev.width||'';
          }
        });
        close?.addEventListener('click',()=>{ win.remove(); });
      }
      document.querySelectorAll('.win').forEach(makeWindow);

      // JSON viewer
      const btn = document.getElementById('parseBtn');
      btn?.addEventListener('click', ()=>{
        const src = document.getElementById('jsonIn').value;
        try{
          const obj = JSON.parse(src);
          document.getElementById('jsonOut').textContent = JSON.stringify(obj, null, 2);
        }catch(e){
          document.getElementById('jsonOut').textContent = 'Parse error: '+e.message;
        }
      });
    })();
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
