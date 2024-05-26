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
if (!isset($_POST["teacher_id"])) {
  $id = 0;
} else {
  $id = $_POST["teacher_id"];
}
// echo $id;

require_once("../machi_db_connect.php");

$sql = "SELECT * FROM teacher WHERE teacher_id=$id";
$result = $conn->query($sql);
$rowCount = $result->num_rows;

if ($rowCount != 0) {
  $row = $result->fetch_assoc();
  $teacher_status = $row['teacher_status'];  //取得teacher_status

}
if ($row["teacher_img"] == null) {
  $row["teacher_img"] = "t28.png";
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
        <div class="container-fluid px-4">


          <div class="container px-5">
            <h1 class="mt-4">編輯講師資料 </h1>

            <ol class="breadcrumb mb-4">
              <li class="breadcrumb-item"><a href="home-page.php">首頁</a></li>
              <li class="breadcrumb-item"><a href="teachers-list.php">講師列表</a></li>
              <li class="breadcrumb-item"><a href="teacher-details.php">講師詳細資料</a></li>
              <li class="breadcrumb-item active">編輯講師資料</li>

            </ol>
          </div>
          <!-- H1在這裡↑ -->


          <div class=" mb-4 justify-content-center">
            <!-- 這層開始可以放內容↓ -->

            <div class="container">
              <!-- 推薦主內容都放在裡面↓ -->
              <div class="row justify-content-center">
                <div class="col-md-8">
                  <div class="d-flex justify-content-center">
                    <div class="card" style="width: 40rem;">
                      <form action="teacher-do-edit.php" method="post" enctype="multipart/form-data">
                        <div class="card-header text-center">
                          <!-- 這裡放使用者的頭像 -->
                          <img id="preview" src="/team02/teacher_images/<?= $row["teacher_img"] ?>?<?= time() ?>" alt="" class="img-thumbnail mx-auto d-block" width="200" height="200">
                          <!-- 這裡放上傳圖片的 input -->
                          <div class="mt-3 d-flex justify-content-center">
                            <input type="file" id="teacher_img" name="teacher_img" accept="image/*" style="display: none;" onchange="previewFile()">
                            <button type="button" id="uploadButton" class="btn btn-primary" onclick="uploadFile()">選擇圖片</button>
                          </div>
                          <!-- 這裡放用戶 ID 的 input -->
                          <input type="hidden" id="teacher_id" name="teacher_id" value="<?= $row["teacher_id"] ?>">
                        </div>
                        <div class="card-body">
                          <!-- 新增一個隱藏的 input 用於傳送 teacher_id -->
                          <input type="hidden" name="teacher_id" value="<?= $row["teacher_id"] ?>">

                          <!-- 編輯姓名 -->
                          <div class="mb-3">
                            <label for="teacherName" class="form-label">姓名:</label>
                            <input type="text" class="form-control" id="teacherName" name="teacherName" value="<?= $row["teacher_name"] ?>">
                          </div>

                          <!-- 編輯電話 -->
                          <div class="mb-3">
                            <label for="teacherPhone" class="form-label">電話:</label>
                            <input type="text" class="form-control" id="teacherPhone" name="teacherPhone" value="<?= $row["teacher_phone"] ?>">
                          </div>

                          <!-- 編輯Email -->
                          <div class="mb-3">
                            <label for="teacherEmail" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="teacherEmail" name="teacherEmail" value="<?= $row["teacher_email"] ?>">
                          </div>

                          <!-- 編輯專長 -->
                          <div class="mb-3">
                            <label for="teacherExpertise" class="form-label">專長:</label>
                            <input type="text" class="form-control" id="teacherExpertise" name="teacherExpertise" value="<?= $row["teacher_expertise"] ?>">
                          </div>

                          <!-- 編輯簡介 -->
                          <div class="mb-3">
                            <label for="teacherIntro" class="form-label">簡介:</label>
                            <textarea class="form-control" id="teacherIntro" name="teacherIntro" rows="3"><?= $row["teacher_intro"] ?></textarea>
                          </div>
                        </div>
                        <div class="text-center my-3">
                          <input type="hidden" name="teacher_id" value="<?= $id ?>">
                          <button type="submit" class="btn btn-primary">更新</button>
                          <a class="btn btn-secondary" href="teachers-list.php" role="button">取消</a>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
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

<script>
  //選擇圖片後預覽，並將按鈕改為儲存
  function uploadFile() {
    document.getElementById('teacher_img').click();
  }

  function previewFile() {
    const preview = document.getElementById('preview');
    const file = document.getElementById('teacher_img').files[0];
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

</html>