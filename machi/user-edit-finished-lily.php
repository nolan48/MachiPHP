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
    <title>Machi會員詳細資料</title>
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
            Text-Align: left;
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
                    <h1 class="mt-4">會員詳細資料 </h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="home-page.php">首頁</a></li>
                        <?php if ($row['user_status'] == 0) : ?>
                            <li class="breadcrumb-item"><a href="user-list-banned-lily.php">停權名單</a></li>
                        <?php else : ?>
                            <li class="breadcrumb-item"><a href="user-list-lily.php">會員名單</a></li>
                        <?php endif; ?>
                        <li class="breadcrumb-item active">會員詳細資料</li>
                    </ol>
                    <div class=" mb-4">
                        <!-- 這裡放我的內容datatablesSimple↓ -->
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card shadow">
                                        <div class="card-header text-center">
                                            <!-- 這裡放使用者的頭像 -->
                                            <img src="/team02/user_images/<?= $row["user_img"] ?>?<?= time() ?>" alt="User Avatar" class="img-thumbnail mx-auto d-block" width="200" height="200">
                                        </div>
                                        <div class="card-body">
                                            <!-- 這裡放使用者的資料 -->
                                            <ul class="list-group list-group-flush">
                                                <li class="list-group-item">ID:<?= $row["user_id"] ?></li>
                                                <li class="list-group-item">姓名:<?= $row["user_name"] ?></li>
                                                <li class="list-group-item">電話:<?= $row["user_phone"] ?></li>
                                                <li class="list-group-item">Email:<?= $row["user_email"] ?></li>
                                                <li class="list-group-item">地址:<?= $row["user_address"] ?></li>
                                                <li class="list-group-item">備註:<?= $row["user_notes"] ?></li>
                                                <li class="list-group-item">加入時間:<?= $row["user_createtime"] ?></li>
                                                <li class="list-group-item">更新時間:<?= $row["user_updatetime"] ?></li>
                                            </ul>
                                            <div class="mt-3 text-center">
                                                <button class="btn btn-primary mc-text-semi-primary" onclick="window.location.href='user-list-lily.php';">使用者列表</button>
                                                <button class="btn btn-secondary mc-text-yellow" onclick="window.location.href='user-edit-lily.php?id=<?= $row['user_id'] ?>'">編輯資料</button>
                                            </div>
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
</body>

</html>