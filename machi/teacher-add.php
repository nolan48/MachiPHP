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
require_once("../machi_db_connect.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Machi講師管理</title>
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
      Text-Align: center;
    }

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


          <!-- <h1 class="mt-4">新增講師資料 </h1> -->
          <!-- H1在這裡↑ -->


          <div class=" mb-4">
            <!-- 這層開始可以放內容↓ -->

            <div class="container px-5">
              <!-- 推薦主內容都放在裡面↓ -->
              <h1 class="mt-4">新增講師資料</h1>
              <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="home-page.php">首頁</a></li>
                <li class="breadcrumb-item"><a href="teachers-list.php">講師列表</a></li>
                <li class="breadcrumb-item active">新增講師資料</li>
              </ol>
              <form class="row g-3" action="teacher-do-add.php" method="post" enctype="multipart/form-data">
                <div class="row">
                  <div class="py-1 mb-4">
                    <a class="btn btn-primary mt-4" href="teachers-list.php" role="button"><i class="fa-solid fa-chevron-left"></i> 回講師列表</a>
                  </div>
                  <div class="mb-3 col-md-3">
                    <label for="image" class="form-label">講師照片</label>
                    <input class="form-control" type="file" name="image" multiple>
                    <!-- <img src="../teacher_images/default.png" alt="預設圖片" width="100" height="100"> -->
                  </div>
                </div>
                <div class="col-md-6">
                  <label for="inputName" class="form-label">姓名</label>
                  <input type="text" class="form-control" id="inputName" name="teacherName" minlength="2" maxlength="20" required>
                </div>
                <div class="col-md-6">
                  <label for="inputPhone" class="form-label">電話</label>
                  <input type="phone" class="form-control" id="inputPhone" name="teacherPhone" maxlength="10" required>
                </div>
                <div class="col-12">
                  <label for="inputEmail" class="form-label">信箱</label>
                  <input type="email" class="form-control" id="inputEmail" name="teacherEmail" required>
                </div>
                <!-- <div class="col-12">
                            <label for="inputExpertise" class="form-label">專長</label>
                            <input type="text" class="form-control" id="inputExpertise" placeholder="Apartment, studio, or floor">
                        </div> -->
                <div class="col-md-6">
                  <label for="inputExpertise" class="form-label">專長</label>
                  <select id="inputExpertise" class="form-select" name="teacherExpertise">
                    <option selected>蛋糕</option>
                    <option>千層蛋糕</option>
                    <option>馬卡龍</option>
                    <option>達克瓦茲</option>
                    <option>甜點餡料</option>
                    <option>肉桂捲</option>
                    <option>麵包</option>
                  </select>
                </div>
                <div class="mb-3">
                  <label for="exampleFormControlTextarea1" class="form-label">簡介</label>
                  <textarea class="form-control" id="exampleFormControlTextarea1" name="teacherIntro" rows="3" required></textarea>
                </div>
                <div class="col-12 pb-4">
                  <button type="submit" class="btn btn-primary" href="teachers-list.php">新增</button>
                </div>

              </form>


              <!-- 推薦主內容都放在裡面↑ -->
            </div>

            <!-- 這層開始可以放內容↑ -->
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
</body>

</html>