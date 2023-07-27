<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Print anggota</title>

    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f0f0;
      }

      .kartu-anggota {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 300px;
      }

      .nama {
        text-align: center;
        margin-top: 0;
        margin-bottom: 5px;
      }

      .role {
        text-align: center;
        margin: 0;
        color: #888;
        margin-bottom: 20px;
      }

      .foto {
        display: block;
        margin: 0 auto;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 20px;
      }

      .kontak {
        margin-top: 10px;
        text-align: center;
        color: #444;
      }

      .kontak p {
        margin: 5px;
      }

      @media print {
              body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f0f0;
      }

      .kartu-anggota {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 5px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        width: 300px;
      }

      .nama {
        text-align: center;
        margin-top: 0;
        margin-bottom: 5px;
      }

      .role {
        text-align: center;
        margin: 0;
        color: #888;
        margin-bottom: 20px;
      }

      .foto {
        display: block;
        margin: 0 auto;
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 20px;
      }

      .kontak {
        margin-top: 10px;
        text-align: center;
        color: #444;
      }

      .kontak p {
        margin: 5px;
      }
      }
    </style>
  </head>
  <body>
    <div class="wrapper">
      <div class="kartu-anggota">
        <h2 class="nama">John Doe</h2>
        <p class="role">Anggota</p>
        <img class="foto" src="/adminPages/img/alfian.png" alt="Foto Anggota" />
        <div class="kontak">
          <p>Email: johndoe@example.com</p>
          <p>ID Anggota: 12345</p>
        </div>
      </div>
    </div>
  </body>
</html>
