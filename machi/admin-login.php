<?php
// 啟動 session
session_start();

// 檢查是否已經登入
if (isset($_SESSION['machi-user_email'])) {
    header('Location: home-page.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Machi管理者登入</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f5f4eb;
            font-family: 'Noto Sans TC', sans-serif !important;
            background-image: url('../LOGO_images/AI logo.png');
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;

        }

        .navbar-brand {
            height: 50px;
            /* 設定為你想要的高度 */
        }

        .navbar-brand img {
            height: 100%;
            width: auto;
        }

        .sb-sidenav-dark {
            background-color: #283044;
        }

        .bg-dark {
            background-color: #78A1BB !important;
        }

        .logo {
            width: 40vw;
            height: 30vw;
            border-radius: 50%;
            margin-left: 50px;
            margin-top: 5%;
            align-items: center;


        }

        .logodiv {
            Text-Align: center;
        }
    </style>
</head>

<body>


    <div class="container">

        <div class="py-5"></div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-4">
                <div class="card mt-5">
                    <div class="card-header">
                        <h1>Login</h1>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $_SESSION['error'] ?>
                                <?php unset($_SESSION['error']); // 刪除錯誤訊息 
                                ?>
                            </div>
                            <?php
                            // 檢查是否已經登入
                            if (isset($_SESSION['machi-user_eamil'])) {
                                header('Location: home-page.php');
                                exit;
                            }
                            ?>

                        <?php endif; ?>
                        <form method="post" action="admin-do-login.php">
                            <div class="form-group">
                                <label>Account:</label>
                                <input type="text" name="useremail" class="form-control" placeholder="example@machi.com" required>
                            </div>
                            <div class="form-group">
                                <label>Password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary mt-3">登入</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>