<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Sistem UMKM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(90deg, #2C3E50, #4CA1AF);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-login {
            width: 100%;
            max-width: 400px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 25px rgba(0,0,0,0.2);
        }
        .card-header {
            background: #fff;
            border-bottom: none;
            padding-top: 30px;
            text-align: center;
        }
    </style>
  </head>
  <body>

    <div class="card card-login">
      <div class="card-header">
        <h4 class="fw-bold text-dark">Login Admin</h4>
        <small class="text-muted">Desa Candimulyo</small>
      </div>
      <div class="card-body p-4">
        
        <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
        <?php endif;?>

        <form action="<?= base_url('login/process') ?>" method="post">
          <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" name="username" class="form-control" placeholder="Masukan username" required autofocus>
          </div>
          <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" placeholder="Masukan password" required>
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary bg-gradient">Masuk Sistem</button>
          </div>
        </form>

      </div>
      <div class="card-footer text-center bg-white pb-4">
        <small class="text-muted">&copy; 2026 KKN Tim 1 Undip</small>
      </div>
    </div>

  </body>
</html>