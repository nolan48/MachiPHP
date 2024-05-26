<!-- 這裡是登入驗證，不要刪掉!!! -->
<!-- 帳號是user資料表裡的user_email，密碼是user_password，隨便一組都可以 -->
<!-- 記得要先匯入資料表 -->
<?php
// 啟動 session
session_start();
// 檢查是否已經登入
if (!isset($_SESSION['machi-user_email'])) {
    // 如果使用者尚未登入，則重定向到 admin-login.php
    header('Location: admin-login.php');
    exit;
}
?>
<!-- 這裡是登入驗證，不要刪掉!!! -->

<?php
if (!isset($_GET["id"])) {
    $id = 0;
} else {
    $id = $_GET["id"];
}

require_once("../machi_db_connect.php");

$sql = "SELECT * FROM user WHERE user_id=$id";
$result = $conn->query($sql);
$rowCount = $result->num_rows;

if ($rowCount != 0) {
    $row = $result->fetch_assoc();
    $user_status = $row['user_status'];  //取得user_status

}
if ($row["user_img"] == null) {
    $row["user_img"] = "u00000.jpg";
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
    <title>Machi會員編輯</title>
    <link href="css/styles.css" rel="stylesheet" />
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- google fonts -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f5f4eb;
            font-family: 'Noto Sans TC', sans-serif !important;

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

        /* 從這裡開始 */
        :root {
            --machi-pale-blue: #e5fafe;
            --machi-dark-blue: #283044;
            --machi-semi-blue: #50687f;
            --machi-light-blue: #78A1BB;
            --machi-light-gray: #f5f4eb;
            --machi-yellow: #fbc154;
            --machi-brown: #a67c52;
            --machi-semi-primary: #3581e4
        }

        /* h1 */
        h1 {
            color: var(--machi-light-blue) !important;
            font-weight: 600;
            text-shadow: 2px 2px px rgb(36, 36, 36);
        }

        /* 無背景按鈕 */
        .mc-pale-blue {
            color: var(--machi-pale-blue) !important;
            border: 2px solid var(--machi-pale-blue) !important;
        }

        .mc-pale-blue:hover {
            color: #f5f5f5 !important;
            background-color: var(--machi-pale-blue) !important;
            border: 2px solid var(--machi-pale-blue) !important;
        }

        .mc-light-blue {
            color: var(--machi-light-blue) !important;
            border: 2px solid var(--machi-light-blue) !important;
        }

        .mc-light-blue:hover {
            color: #f5f5f5 !important;
            background-color: var(--machi-light-blue) !important;
            border: 2px solid var(--machi-light-blue) !important;
        }

        .mc-semi-blue {
            color: var(--machi-semi-blue) !important;
            border: 2px solid var(--machi-semi-blue) !important;
        }

        .mc-semi-blue:hover {
            color: #f5f5f5 !important;
            background-color: var(--machi-semi-blue) !important;
            border: 2px solid var(--machi-semi-blue) !important;
        }

        .mc-dark-blue {
            color: var(--machi-dark-blue) !important;
            border: 2px solid var(--machi-dark-blue) !important;
        }

        .mc-dark-blue:hover {
            color: #f5f5f5 !important;
            background-color: var(--machi-dark-blue) !important;
            border: 2px solid var(--machi-dark-blue) !important;
        }

        .mc-red {
            color: #ff6b6b !important;
            border: 2px solid #ff6b6b !important;
            background-color: #ffffff !important;
        }


        /* 有背景按鈕 */
        .mc-text-pale-blue {
            color: #f5f5f5 !important;
            border: 2px solid var(--machi-pale-blue) !important;
            background-color: var(--machi-pale-blue) !important;
        }

        .mc-text-light-blue {
            color: #f5f5f5 !important;
            border: 2px solid var(--machi-light-blue) !important;
            background-color: var(--machi-light-blue) !important;
        }

        .mc-text-semi-blue {
            color: #f5f5f5 !important;
            border: 2px solid var(--machi-semi-blue) !important;
            background-color: var(--machi-semi-blue) !important;
        }

        .mc-text-dark-blue {
            color: #f5f5f5 !important;
            border: 2px solid var(--machi-dark-blue) !important;
            background-color: var(--machi-dark-blue) !important;
        }

        .mc-text-semi-primary {
            color: #f5f5f5 !important;
            border: 2px solid var(--machi-semi-primary) !important;
            background-color: var(--machi-semi-primary) !important;
        }

        .mc-text-yellow {
            color: #f5f5f5 !important;
            border: 2px solid var(--machi-yellow) !important;
            background-color: var(--machi-yellow) !important;
        }

        .mc-bg-light-gray {
            background-color: var(--machi-light-gray) !important;
        }



        /* 改變表格的背景顏色 */
        .table {
            background-color: var(--machi-light-blue);
            border: 1px solid var(--machi-light-blue);
            border-radius: 3px;
            overflow: hidden;
            /* 確保背景顏色和邊框都適用於圓角 */

        }

        .table th {
            border: none;
            background-color: var(--machi-light-blue);
        }

        .table td {
            background-color: #ffffff;
        }
    </style>
</head>

<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="home-page.php">
            <img src="/team02/LOGO_images/logo_sm.PNG" alt="Start Bootstrap" />
        </a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group"></div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <form action="admin-logout.php" method="post">
                            <button type="submit" class="dropdown-item">登出</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading"></div>
                        <a class="nav-link" href="home-page.php">
                            <i class="fas fa-tachometer-alt"></i>&nbsp;
                            首頁
                        </a>
                        <div class="sb-sidenav-menu-heading">後台功能</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <i class="fa-solid fa-user"></i>&nbsp;&nbsp;會員管理
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <!-- 兩個 -->
                                <a class="nav-link" href="/team02/machi/user-list-lily.php">會員名單</a>
                                <a class="nav-link" href="/team02/machi/user-list-banned-lily.php">停權名單</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="/team02/machi/deal-list.php">
                            <i class="fa-solid fa-cart-shopping"></i>&nbsp;訂單管理
                        </a>
                        <a class="nav-link collapsed" href="/team02/machi/product-list.php">
                            <i class="fa-solid fa-pizza-slice"></i>&nbsp;商品管理
                        </a>
                        <a class="nav-link collapsed" href="/team02/machi/category.php">
                            <i class="fa-solid fa-bookmark"></i>&nbsp; 分類管理
                        </a>
                        <a class="nav-link collapsed" href="/team02/machi/coupon-list.php">
                            <i class="fa-solid fa-ticket"></i>&nbsp;優惠券管理
                        </a>
                        <a class="nav-link collapsed" href="/team02/machi/teachers-list.php">
                            <i class="fa-solid fa-chalkboard-user"></i>
                            &nbsp;講師管理

                        </a>
                        <a class="nav-link " href="/team02/machi/class.php">
                            <i class="fa-solid fa-book"></i>&nbsp;
                            課程管理

                        </a>
                    </div>
                </div>

            </nav>
        </div>
        <div id="layoutSidenav_content">

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">會員資料編輯 </h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="home-page.php">首頁</a></li>
                        <?php if ($row['user_status'] == 0) : ?>
                            <li class="breadcrumb-item"><a href="user-list-banned-lily.php">停權名單</a></li>
                        <?php else : ?>
                            <li class="breadcrumb-item"><a href="user-list-lily.php">會員名單</a></li>
                        <?php endif; ?>
                        <li class="breadcrumb-item active">會員資料編輯</li>
                    </ol>

                    <div class=" mb-4">
                        <!-- 這裡放我的內容datatablesSimple↓ -->
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card shadow">


                                        <form id="picFormId" action="user-edit-doupdate-lily.php" method="post" enctype="multipart/form-data">

                                            <div class="card-header text-center">
                                                <!-- 這裡放使用者的頭像 -->
                                                <img id="preview" src="/team02/user_images/<?= $row["user_img"] ?>?<?= time() ?>" alt="User Avatar" class="img-thumbnail mx-auto d-block" width="200" height="200">
                                                <!-- 這裡放上傳圖片的 input -->
                                                <div class="mt-3 d-flex justify-content-center">
                                                    <input type="file" id="user_img" name="user_img" accept="image/*" style="display: none;" onchange="previewFile()">
                                                    <button type="button" id="uploadButton" class="btn btn-primary mc-text-semi-primary" onclick="uploadFile()">選擇圖片</button>
                                                </div>
                                                <!-- 這裡放用戶 ID 的 input -->
                                                <input type="hidden" id="user_id" name="user_id" value="<?= $row["user_id"] ?>">
                                            </div>


                                            <div class="card-body">

                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-2">ID:</div>
                                                            <div class="col"><input type="text" name="user_id" value="<?= $row["user_id"] ?>" readonly class="form-control my-2"></div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-2">姓名:</div>
                                                            <div class="col"><input type="text" name="user_name" value="<?= $row["user_name"] ?>" class="form-control my-2" required></div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-2">電話:</div>
                                                            <div class="col"><input type="text" name="user_phone" value="<?= $row["user_phone"] ?>" class="form-control my-2" required></div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-2">Email:</div>
                                                            <div class="col"><input type="text" name="user_email" value="<?= $row["user_email"] ?>" class="form-control my-2" required></div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-2">地址:</div>
                                                            <div class="col"><input type="text" name="user_address" value="<?= $row["user_address"] ?>" class="form-control my-2" required></div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-2">備註:</div>
                                                            <div class="col"><input type="text" name="user_notes" value="<?= $row["user_notes"] ?>" class="form-control my-2"></div>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <div class="d-flex justify-content-center mt-3">
                                                    <div>
                                                        <button type="button" class="btn btn-primary mc-text-semi-primary" onclick="window.history.back();">回上一頁</button>
                                                        <input type="submit" class="btn btn-secondary mc-text-yellow" value="更新資料">
                                                    </div>
                                                </div>
                                        </form>

                                        <?php if ($user_status != 0) : ?>
                                            <form id="suspendForm" action="user-edit-dosuspend-lily.php" method="post" class="text-end">
                                                <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                                <button type="submit" class="btn btn-danger my-2" onclick="return suspendUser();">帳號凍結</button>
                                            </form>
                                        <?php else : ?>

                                            <div class="d-flex justify-content-end">
                                                <form class="mx-2" id="suspendForm" action="user-edit-recover-lily.php" method="post">
                                                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                                    <button type="submit" class="btn btn-warning my-2 mc-red" onclick="return recoverUser();">帳號解凍</button>
                                                </form>
                                                <form id="deleteForm" action="user-do-delete-lily.php" method="post" class="">
                                                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                                                    <button type="submit" class="btn btn-danger my-2" onclick="return deleteUser();">清除帳號</button>
                                                </form>
                                            </div>

                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 這裡放我的內容｜ -->
                </div>
        </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">

                <div class="text-muted" style="text-align: right;">Copyright &copy; Machi Store 2024</div>


            </div>
        </footer>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <!-------------------------------------------------------------切換按鈕用的ajax ------------------------------------------------ -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-------------------------------------------------------------切換按鈕用的ajax ------------------------------------------------ -->
    <script>
        //選擇圖片後預覽，並將按鈕改為儲存
        function uploadFile() {
            document.getElementById('user_img').click();
        }

        function previewFile() {
            const preview = document.getElementById('preview');
            const file = document.getElementById('user_img').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function() {
                // 將圖片轉換為 base64 並顯示
                preview.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script>
        function suspendUser() {
            return confirm('確定要凍結帳號嗎？');
        };

        function recoverUser() {
            return confirm('確定要解凍帳號嗎？');
        };

        function deleteUser() {
            return confirm('確定要清除帳號資料嗎？');
        };
    </script>
</body>

</html>