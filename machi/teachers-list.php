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

$perPage = 5; //每一個分頁顯示5筆

$sqlAll = "SELECT * FROM teacher WHERE teacher_status=1";
$resultAll = $conn->query($sqlAll);
$teacherTotalCount = $resultAll->num_rows;

$pageCount = ceil($teacherTotalCount / $perPage); // Math.ceil()
// echo $pageCount;

if (isset($_GET["order"])) {
  $order = $_GET["order"];

  if ($order == 1) {
    $orderString = "ORDER BY teacher_id ASC";
  } elseif ($order == 2) {
    $orderString = "ORDER BY teacher_id DESC";
  } elseif ($order == 3) {
    $orderString = "ORDER BY teacher_name ASC";
  } elseif ($order == 4) {
    $orderString = "ORDER BY teacher_name DESC";
  }
}

if (isset($_GET["search"])) {
  $search = $_GET["search"];
  $sql = "SELECT * FROM teacher WHERE teacher_name LIKE '%$search%' AND teacher_status=1";
} elseif (isset($_GET["p"])) {
  $p = $_GET["p"];
  $startIndex = ($p - 1) * $perPage; //做上一頁設定

  $sql = "SELECT * FROM teacher WHERE teacher_status=1 $orderString LIMIT $startIndex, $perPage";
} else {
  $p = 1;
  $order = 1;
  $orderString = "ORDER BY teacher_id ASC";
  $sql = "SELECT * FROM teacher WHERE teacher_status=1 $orderString LIMIT $perPage";
}

$result = $conn->query($sql);

if (isset($_GET["search"])) {
  $teacherCount = $result->num_rows;
} else {
  $teacherCount = $teacherTotalCount;
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
        <div class="container-fluid px-3">


          <!-- <h1 class="mt-4">講師列表 </h1> -->
          <!-- H1在這裡↑ -->


          <!-- <div class=" mb-4 logodiv"> -->
          <!-- 這層開始可以放內容↓ -->

          <!-- <div class="container"> -->
          <!-- 推薦主內容都放在裡面↓ -->
          <div class="container">
            <h1 class="mt-4">講師列表 </h1>
            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item"><a href="home-page.php">首頁</a></li>
              <li class="breadcrumb-item active">講師列表</li>
            </ol>
            <form action="">
              <div class="input-group mb-3">
                <input type="search" class="form-control" placeholder="Name" aria-label="Recipient's username" aria-describedby="button-addon2" name="search" <?php
                                                                                                                                                              if (isset($_GET["search"])) :
                                                                                                                                                                $searchValue = $_GET["search"];
                                                                                                                                                              ?> value="<?= $searchValue ?>" <?php endif; ?>>
                <button class="btn btn-primary" type="submit" id="button-addon2"><i class="fa-solid fa-magnifying-glass fa-fw"></i></button>
              </div>
            </form>
            <?php if (!isset($_GET["search"])) : ?>
              <div class="py-2 justify-content-between d-flex align-items-center">
                <a role="button" href="teacher-add.php" type="button" class="btn btn-primary">
                  <i class="fa-solid fa-user-plus fa-fw me-2"></i>新增講師資料
                </a>
                <span class="me-2">排序</ㄋ>
                  <div class="btn-group">
                    <a class="btn btn-primary
                                <?php if ($order == 1) echo "active" ?>
                                " href="teachers-list.php?order=1&p=<?= $p ?>"><i class="fa-solid fa-arrow-down-1-9 fa-fw"></i></a>
                    <a class="btn btn-primary
                                <?php if ($order == 2) echo "active" ?>
                                " href="teachers-list.php?order=2&p=<?= $p ?>"><i class="fa-solid fa-arrow-down-9-1 fa-fw"></i></a>
                    <a class="btn btn-primary
                                <?php if ($order == 3) echo "active" ?>
                                " href="teachers-list.php?order=3&p=<?= $p ?>"><i class="fa-solid fa-arrow-down-a-z fa-fw"></i></a>
                    <a class="btn btn-primary
                                <?php if ($order == 4) echo "active" ?>
                                " href="teachers-list.php?order=4&p=<?= $p ?>"><i class="fa-solid fa-arrow-down-z-a fa-fw"></i></a>
                  </div>
              </div>
            <?php endif; ?>
            <table class="table table-bordered no-wrap justify-content-center align-middle">
              <thead class="table-secondary text-center align-middle">
                <tr>
                  <th style="width: 5%;">序號</th>
                  <th style="width: 10%;">講師照片</th>
                  <th style="width: 7%;">姓名</th>
                  <th style="width: 13%;">電話</th>
                  <th style="width: 5%;">信箱</th>
                  <th style="width: 13%;">專長</th>
                  <th style="width: 35%;">簡介</th>
                  <th style="width: 5%;">上架</th>
                  <th style="width: 4%;">檢視</th>
                  <th style="width: 4%;">刪除</th>
                </tr>
              </thead>
              <tbody class="align-middle">
                <?php

                $rows = $result->fetch_all(MYSQLI_ASSOC);

                foreach ($rows as $teacher) :
                ?>

                  <tr>
                    <td><?= $teacher["teacher_id"] ?></td>
                    <td>
                      <img class="td-image" width="100" height="100" src="/team02/teacher_images/<?= $teacher["teacher_img"] ?>">
                    </td>
                    <td><?= $teacher["teacher_name"] ?></td>
                    <td><?= $teacher["teacher_phone"] ?></td>
                    <td><?= $teacher["teacher_email"] ?></td>
                    <td><?= $teacher["teacher_expertise"] ?></td>
                    <div></div>
                    <td>
                      <div style="overflow:auto; height:140px; text-align: left;"><?= $teacher["teacher_intro"] ?></div>
                    </td>
                    <td><?= $teacher["teacher_status"] ?></td>
                    <td>
                      <a class="btn btn-primary" href="teacher-details.php?id=<?= $teacher["teacher_id"] ?>" role="button"><i class="fa-solid fa-eye"></i></a>
                    </td>
                    <!-- <td>
                      <form action="teacher-do-delete.php" method="post">
                        <input type="hidden" name="teacher_id" value="<?= $teacher['teacher_id'] ?>">
                        <button type="submit" class="btn btn-danger" role="button"><i class="fa-regular fa-trash-can"></i></button>
                      </form>
                    </td> -->
                    <td>
                      <!-- 刪除(互動視窗) -->
                      <button class="btn btn-danger mx-2" data-bs-toggle="modal" data-bs-target="#confirmModal<?= $teacher["teacher_id"] ?>"><i class="fa-solid fa-trash"></i></button>
                      <div class="modal fade" id="confirmModal<?= $teacher["teacher_id"] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">刪除講師</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              確定要刪除講師嗎?
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                              <form action="teacher-do-delete.php" method="post">
                                <input type="hidden" name="teacher_id" value="<?= $teacher['teacher_id'] ?>">
                                <button type="submit" class="btn btn-danger">確認刪除</button>
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
                  <?php for ($i = 1; $i <= $pageCount; $i++) : ?>
                    <li class="page-item 
                                    <?php
                                    if ($i == $p) echo "active";
                                    ?>"><!-- 設定所在頁面按鈕與其他頁作區別，所在頁面顯示藍色 -->
                      <a class="page-link" href="teachers-list.php?order=<?= $order ?>&p=<?= $i ?>"><?= $i ?></a>
                    </li>
                  <?php endfor; ?>
                </ul>
              </nav>
            <?php endif; ?>
          </div>





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