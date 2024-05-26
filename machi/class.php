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
require_once("../machi_db_connect.php"); //登入帳號

$perPage = 5; //每一個分頁顯示5筆

$sqlAll = "SELECT * FROM class WHERE class_status=1";
//抓取class資料表，欄位class_status值等於1
$resultAll = $conn->query($sqlAll);
$classTotalCount = $resultAll->num_rows;

$pageCount = ceil($classTotalCount / $perPage); // Math.ceil()
// echo $pageCount;

if (isset($_GET["order"])) {
  $order = $_GET["order"];

  if ($order == 1) {
    $orderString = "ORDER BY class_id ASC";
  } elseif ($order == 2) {
    $orderString = "ORDER BY class_id DESC";
  } elseif ($order == 3) {
    $orderString = "ORDER BY class_price ASC";
  } elseif ($order == 4) {
    $orderString = "ORDER BY class_price DESC";
  }
} else {
  $orderString = "ORDER BY class_id ASC";
}


if (isset($_GET["search"])) {
  $search = $_GET["search"];
  $sql = "SELECT * FROM class 
            JOIN subcategory ON class.subcategory_id_fk = subcategory.subcategory_id 
            JOIN teacher ON class.teacher_id_fk = teacher.teacher_id 
            WHERE class_name LIKE '%$search%' AND class_status=1";
} elseif (isset($_GET["p"])) {
  $p = $_GET["p"];
  $startIndex = ($p - 1) * $perPage; //做上一頁設定

  $sql = "SELECT * FROM class 
            JOIN subcategory ON class.subcategory_id_fk = subcategory.subcategory_id 
            JOIN teacher ON class.teacher_id_fk = teacher.teacher_id 
            WHERE class_status=1 $orderString LIMIT $startIndex, $perPage";
} else {
  $p = 1;
  $order = 1;
  $orderString = "ORDER BY class_id ASC";
  $sql = "SELECT * FROM class 
            JOIN subcategory ON class.subcategory_id_fk = subcategory.subcategory_id 
            JOIN teacher ON class.teacher_id_fk = teacher.teacher_id 
            WHERE class_status=1 $orderString LIMIT $perPage";
}




$result = $conn->query($sql);



if (isset($_GET["search"])) {
  $classCount = $result->num_rows;
} else {
  $classCount = $classTotalCount;
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
  <title>layout</title>
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
  <style>
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

    .mc-semi-blue {
      color: var(--machi-semi-blue) !important;
      border: 2px solid var(--machi-semi-blue) !important;
    }

    .mc-semi-blue:hover {
      color: #ffffff !important;
      background-color: var(--machi-semi-blue) !important;
      border: 2px solid var(--machi-semi-blue) !important;
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

    h1 {
      color: var(--machi-light-blue);
      font-weight: bold;
    }

    .table {
      border-radius: 5px;
      overflow: hidden;
      /* 確保背景顏色和邊框都適用於圓角 */
    }

    .table th {
      border: none;
      background-color: var(--machi-light-blue);
      color: white;
    }

    .modal-body {
      letter-spacing: 5px;
      color: var(--machi-semi-blue);
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


          <!-- H1在這裡↑ -->
          <h1 class="mt-4">課程列表 </h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="home-page.php">首頁</a></li>
            <li class="breadcrumb-item active">課程管理</li>
          </ol>
          <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light">
              <div class="container-fluid d-flex">
                <!-- 按鈕 -->
                <a class="btn mc-semi-blue me-2" href="class.php"><i class="fa-solid fa-rotate-right"></i></a>

                <!-- 搜尋列和搜尋按鈕 -->
                <form class="d-flex flex-grow-1" action="class.php" method="get">
                  <input class="form-control flex-grow-1 me-2" type="search" placeholder="輸入關鍵字" aria-label="搜尋" name="search">
                  <input type="hidden" name="scope">
                  <button class="btn mc-semi-blue ms-auto" type="submit" style="min-width: 60px;"> <i class="fa fa-search"></i></button>
                </form>
              </div>
            </nav>

            <div class="d-flex py-2 justify-content-start align-items-center">
              <div>
                <a name="" id="" class="btn btn-warning" href="class-add.php" role="button"><i class="fa-solid fa-square-plus"></i> 新增課程</a>
              </div>

            </div>

            <?php if (!isset($_GET["search"])) : ?>
              <div class="d-flex py-2 justify-content-between align-items-center">
                <div class="col-9 class-count">
                  共 <?= $classCount ?> 筆
                </div>
                <div>
                  <span class="me-2">排序</span>
                  <div class="btn-group">
                    <a class="btn btn-warning
                                    <?php if ($order == 1) echo "active" ?>
                                    " href="class.php?order=1&p=<?= $p ?>"><i class="fa-solid fa-arrow-down-short-wide"></i></a>
                    <a class="btn btn-warning
                                    <?php if ($order == 2) echo "active" ?>
                                    " href="class.php?order=2&p=<?= $p ?>"><i class="fa-solid fa-arrow-down-wide-short"></i></a>
                    <a class="btn btn-warning
                                    <?php if ($order == 3) echo "active" ?>
                                    " href="class.php?order=3&p=<?= $p ?>"><i class="fa-solid fa-down-long"></i></a>
                    <a class="btn btn-warning
                                    <?php if ($order == 4) echo "active" ?>
                                    " href="class.php?order=4&p=<?= $p ?>"><i class="fa-solid fa-up-long"></i></a>
                  </div>
                </div>
              </div>
            <?php endif; ?>


            <div class=" mb-4 logodiv">
              <!-- 這層開始可以放內容↓ -->

              <div class="container">
                <!-- 推薦主內容都放在裡面↓ -->
                <table class="table table-bordered justify-content-center align-middle">
                  <thead class="table-secondary text-center align-middle">
                    <tr>
                      <th style="width: 10%;">圖片</th>
                      <th style="width: 15%;">課程名稱</th>
                      <th style="width: 6%;">類型</th>
                      <th style="width: 6%;">老師</th>
                      <th style="width: 5%;">難度</th>
                      <th style="width: 5%;">價格</th>
                      <th style="width: 5%;">地點</th>
                      <th style="width: 15%;">報名日期</th>
                      <th style="width: 15%;">課程日期</th>
                      <th style="width: 5%;">狀態</th>
                      <th style="width: 5%;">編輯</th>
                      <th style="width: 5%;">下架</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php

                    $rows = $result->fetch_all(MYSQLI_ASSOC);

                    foreach ($rows as $class) :
                    ?>
                      <tr>
                        <td>
                          <img class="td-image" src="/team02/class_images/<?= $class["class_img"] ?>?<?= time() ?>" alt="" width="150" height="100">
                        </td>
                        <td><?= $class["class_name"] ?></td>
                        <td><?= $class["subcategory_name"] ?></td>
                        <td><?= $class["teacher_name"] ?></td>
                        <td><?= $class["class_level"] ?></td>
                        <td><?= $class["class_price"] ?></td>
                        <td><?= $class["class_locations"] ?></td>
                        <td><?= $class["class_enroll_start"] ?>
                          <br><?= $class["class_enroll_end"] ?>
                        </td>
                        <td><?= $class["class_coursedate_start"] ?>
                          <br><?= $class["class_coursedate_end"] ?>
                        </td>
                        <td><?= $class["class_status"] ?></td>

                        <td>
                          <!-- 編輯按鈕 -->
                          <form action="class-edit.php" method="post">
                            <input type="hidden" name="id" value="<?= $class["class_id"] ?>">
                            <button type="submit" class="btn mc-light-blue"><i class="fa-solid fa-pen-to-square"></i></button>
                          </form>
                        </td>
                        <td>
                          <!-- 刪除按鈕 -->
                          <button class="btn mc-semi-blue mx-2" data-bs-toggle="modal" data-bs-target="#confirmModal<?= $class["class_id"] ?>"><i class="fa-solid fa-trash fa-fw"></i></button>
                          <!-- 刪除(互動視窗) -->
                          <div class="modal fade" id="confirmModal<?= $class["class_id"] ?>" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">刪除課程</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                確定要刪除課程嗎?
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                                  <form action="class-do-delete.php" method="post">
                                    <input type="hidden" name="class_id" value="<?= $class["class_id"] ?>">
                                    <button type="submit" class="btn btn-danger">確認刪除

                                    </button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>

                <?php if (!isset($_GET["search"])) : ?><!--在搜尋結果下，不顯示分頁-->
                  <nav aria-label="Page navigation">
                    <ul class="pagination">
                      <li class="page-item">
                        <a class="page-link" href="class.php?order=1&p=1" aria-label="First">
                          <span aria-hidden="true">&laquo;</span>
                        </a>
                      </li>
                      <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                        <li class="page-item 
                                        <?php
                                        if ($i == $p) echo "active";
                                        ?>"><!-- 設定所在頁面按鈕與其他頁作區別，所在頁面顯示藍色 -->
                          <a class="page-link" href="class.php?order=<?= $order ?>&p=<?= $i ?>"><?= $i ?></a>
                        </li>
                      <?php endfor; ?>
                      <!-- 跳到第一頁 -->


                      <!-- 跳到最後一頁，最後一頁是第 5 頁 -->
                      <li class="page-item">
                        <a class="page-link" href="class.php?order=1&p=5" aria-label="Last">
                          <span aria-hidden="true">&raquo;</span>
                        </a>
                      </li>
                    </ul>
                  </nav>
                <?php endif; ?>
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