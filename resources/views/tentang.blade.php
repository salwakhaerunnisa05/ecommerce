<!DOCTYPE html>
<html lang="id">
  <head>
      {{-- Encoding karakter --}}
      <meta charset="UTF-8" />

    {{-- Responsive untuk mobile --}}
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <title>Tentang Kami</title>

    <style>
      body {
        font-family: system-ui, -apple-system, sans-serif;
        max-width: 800px;
        margin: 50px auto;
        padding: 20px;
      }
      h1 {
        color: #37276b;
      }
    </style>
  </head>
  <body>
    <h1>Tentang Toko Kamera Instax</h1>
    <p>Selamat datang di toko kamera instax kami.</p>
    <p>Dibuat dengan 💜 menggunakan Laravel.</p>
    <p>Waktu saat ini: {{ now()->format('d M Y, H:i:s') }}</p>

    <a href="/">← Kembali ke Home</a>
    
  </body>
</html>