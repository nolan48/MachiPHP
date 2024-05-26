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
if (!isset($_POST["coupon_id"])) {
  echo "請循正常管道進入本頁面";
  exit;
} else {
  $id = $_POST["coupon_id"];
}




require_once("../machi_db_connect.php");

$sql = "SELECT * FROM coupon where coupon_id=$id";

$result = $conn->query($sql);

$row = $result->fetch_assoc();
$coupon_starttime = $row["coupon_starttime"];
$coupon_limittime = $row["coupon_limittime"];
$coupon_starttimedate = date('Y-m-d', strtotime($coupon_starttime));;
$coupon_limittimedate = date('Y-m-d', strtotime($coupon_limittime));;


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Machi優惠券編輯</title>
  <link href="css/styles.css" rel="stylesheet" />
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

    .pagination {
      display: flex;
      list-style: none;
      padding: 0;
    }

    .pagination li {
      margin-right: 5px;
    }

    .pagination a {
      text-decoration: none;
      padding: 5px 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      background-color: #f2f2f2;
      color: #333;
    }

    .pagination a:hover {
      background-color: #ddd;
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
      color: #ffffff !important;
      background-color: var(--machi-pale-blue) !important;
      border: 2px solid var(--machi-pale-blue) !important;
    }

    .mc-light-blue {
      color: var(--machi-light-blue) !important;
      border: 2px solid var(--machi-light-blue) !important;
    }

    .mc-light-blue:hover {
      color: #ffffff !important;
      background-color: var(--machi-light-blue) !important;
      border: 2px solid var(--machi-light-blue) !important;
    }

    .mc-semi-blue {
      color: var(--machi-semi-blue) !important;
      border: 2px solid var(--machi-semi-blue) !important;
    }

    .mc-semi-blue:hover {
      color: #ffffff !important;
      background-color: var(--machi-semi-blue) !important;
      border: 2px solid var(--machi-semi-blue) !important;
    }

    .mc-dark-blue {
      color: var(--machi-dark-blue) !important;
      border: 2px solid var(--machi-dark-blue) !important;
    }

    .mc-dark-blue:hover {
      color: #ffffff !important;
      background-color: var(--machi-dark-blue) !important;
      border: 2px solid var(--machi-dark-blue) !important;
    }


    /* 有背景按鈕 */
    .mc-text-pale-blue {
      color: #ffffff !important;
      border: 2px solid var(--machi-pale-blue) !important;
      background-color: var(--machi-pale-blue) !important;
    }

    .mc-text-light-blue {
      color: #ffffff !important;
      border: 2px solid var(--machi-light-blue) !important;
      background-color: var(--machi-light-blue) !important;
    }

    .mc-text-semi-blue {
      color: #ffffff !important;
      border: 2px solid var(--machi-semi-blue) !important;
      background-color: var(--machi-semi-blue) !important;
    }

    .mc-text-dark-blue {
      color: #ffffff !important;
      border: 2px solid var(--machi-dark-blue) !important;
      background-color: var(--machi-dark-blue) !important;
    }

    .mc-text-semi-primary {
      color: #ffffff !important;
      border: 2px solid var(--machi-semi-primary) !important;
      background-color: var(--machi-semi-primary) !important;
    }

    .mc-text-yellow {
      color: #ffffff !important;
      border: 2px solid var(--machi-yellow) !important;
      background-color: var(--machi-yellow) !important;
    }

    .mc-bg-light-gray {
      background-color: var(--machi-light-gray) !important;
    }
  </style>
</head>

<body class="sb-nav-fixed">

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
          <h1 class="mt-4">優惠券編輯 </h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="home-page.php">首頁</a></li>
            <li class="breadcrumb-item"><a href="coupon-list.php">優惠券列表</a></li>
            <li class="breadcrumb-item active">優惠券編輯</li>
          </ol>


          <div class="card mb-4">
            <div class="card-header">
              <button class="btn btn-primary" onclick="history.back()"><i class="fa-solid fa-left-long"></i>返回</button>

            </div>
            <div class="card-body">
              <form id="picFormId" action="coupon-do-setting.php" method="post" enctype="multipart/form-data">
                <table class="table table-bordered">

                  <thead>

                    <tr>
                      <th>id</th>
                      <td><input type="hidden" maxlength="10" name="coupon_id" value="<?= $row["coupon_id"] ?>"><?= $row["coupon_id"] ?></td>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td>優惠券名稱</td>
                      <td><input style="width: 100%;" type="text" maxlength="10" name="coupon_name" value="<?= $row["coupon_name"] ?>"></td>

                    </tr>
                    <tr>
                      <td>優惠券類型</td>
                      <td><input style="width: 100%;" type="text" maxlength="10" name="coupon_type" value="<?= $row["coupon_type"] ?>"></td>
                    </tr>

                    <tr>
                      <td>優惠券折扣</td>
                      <td><input style="width: 100%;" type="text" maxlength="10" name="coupon_discount" value="<?= $row["coupon_discount"] ?>"></td>

                    </tr>
                    <tr>
                      <td>最低金額</td>
                      <td><input style="width: 100%;" type="text" maxlength="10" name="coupon_purchase" value="<?= $row["coupon_purchase"] ?>"></td>

                    </tr>
                    <tr>
                      <td>起始日期</td>
                      <td><input style="width: 100%;" type="date" name="coupon_starttime" value="<?php echo $coupon_starttimedate; ?>"></td>

                    </tr>
                    <tr>
                      <td>截止日期</td>
                      <td><input style="width: 100%;" type="date" name="coupon_limittime" value="<?php echo $coupon_limittimedate; ?>"></td>

                    </tr>

                    <tr>
                      <td>優惠券數量</td>
                      <td><input style="width: 100%;" type="text" maxlength="10" name="coupon_count" value="<?= $row["coupon_count"] ?>"></td>

                    </tr>
                    <tr>
                      <td>優惠券描述</td>
                      <td> <textarea style="width: 100%;" name="coupon_description" class="form-control my-2" required><?= $row["coupon_description"] ?></textarea>
                      </td>
                    </tr>

                  </tbody>

                </table>
            </div>
            <div class="float-end">
              <input type="submit" class="btn btn-success" value="儲存">
              </form>

            </div>

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
</body>

</html>