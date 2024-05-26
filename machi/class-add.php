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

    .mc-text-semi-primary {
      color: #f5f5f5 !important;
      border: 2px solid var(--machi-semi-primary) !important;
      background-color: var(--machi-semi-primary) !important;
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

    label {
      color: var(--machi-semi-blue);
      font-weight: bold;
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
          <h1 class="mt-4">新增課程</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="home-page.php">首頁</a></li>
            <li class="breadcrumb-item"><a href="class.php">課程列表</a></li>
            <li class="breadcrumb-item active">新增課程</li>
          </ol>
          <div class="py-1 mb-4">
            <a class="btn btn-warning" href="class.php" role="button"><i class="fa-solid fa-chevron-left"></i> 回課程列表</a>
          </div>

          <div class=" mb-4">
            <!-- 這層開始可以放內容↓ -->

            <!-- 推薦主內容都放在裡面↓ -->
            <div class="container">
              <div class="card shadow">
                <div class="card-header">
                  <form class="row g-3" action="class-do-add.php" method="post" enctype="multipart/form-data">
                    <!-- 照片 -->
                    <div class="card-header text-center">
                      <img id="preview" src="/team02/class_images/<?= $row["class_img"] ?>?<?= time() ?>" alt="class img" class="img-thumbnail mx-auto d-block" width="500" height="300">
                      <!-- 這裡放上傳圖片的 input -->
                      <div class="mt-3 d-flex justify-content-center">
                        <input type="file" id="class_img" name="image" accept="image/*" style="display: none;" onchange="previewFile()">
                        <button type="button" id="uploadButton" class="btn mc-text-semi-primary" onclick="uploadFile()"><i class="fa-solid fa-cloud-arrow-up"></i>上傳照片</button>
                      </div>
                
                      <!-- 這裡放 ID 的 input -->
                      <input type="hidden" id="class_id" name="class_id" value="<?= $row["class_id"] ?>">
                    </div>
                    <div class="col-12">
                      <label for="className" class="form-label">課程名稱</label>
                      <input type="text" class="form-control" name="className" placeholder="請輸入課程名稱">
                    </div>
                    <div class="col-md-4">
                      <label for="category" class="form-label">課程類別</label>
                      <select name="category" class="form-select">
                        <option selected>請選擇</option>
                        <?php
                        // 2. 執行 SQL 查詢以獲取所有的 `subcategory`
                        $sql = "SELECT subcategory_name FROM subcategory WHERE category_id_fk = 7";
                        $result = $conn->query($sql);

                        // 3. 遍歷查詢結果，並為每一個 `subcategory_name` 建立一個選項元素
                        if ($result->num_rows > 0) {
                          foreach ($result as $row) {
                            echo '<option value="' . $row['subcategory_name'] . '">' . $row['subcategory_name'] . '</option>';
                          }
                        } else {
                          echo "0 結果";
                        }
                        ?>
                      </select>
                    </div>

                    <div class="col-md-4">
                      <label for="teacher" class="form-label">授課老師</label>
                      <select name="teacher" class="form-select">
                        <option selected>請選擇</option>
                        <?php
                        // 2. 執行 SQL 查詢以獲取所有的 `teacher_name`
                        $sql = "SELECT teacher_name FROM teacher";
                        $result = $conn->query($sql);

                        // 3. 遍歷查詢結果，並為每一個 `teacher_name` 建立一個選項元素
                        if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['teacher_name'] . '">' . $row['teacher_name'] . '</option>';
                          }
                        } else {
                          echo "0 結果";
                        }
                        $conn->close();
                        ?>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="level" class="form-label">課程難度</label>
                      <select name="level" class="form-select">
                        <option selected>請選擇</option>
                        <option>初階</option>
                        <option>中階</option>
                        <option>高階</option>
                      </select>
                    </div>
                    <div class="col-md-4">
                      <label for="location" class="form-label">授課地點</label>
                      <select name="location" class="form-select">
                        <option selected>請選擇</option>
                        <option>台北</option>
                        <option>桃園</option>
                        <option>台中</option>
                      </select>
                    </div>
                    <div class="col-md-8">
                      <label for="price" class="form-label">價格</label>
                      <input type="number" class="form-control" name="price">
                    </div>
                    <!-- <div class="mb-3 col-12">
                      <label for="image" class="form-label">課程照片</label>
                      <input class="form-control" type="file" name="image" multiple>
                    </div> -->
                    <div class="col-md-6">
                      <label for="startDate" class="form-label">報名開始日期</label>
                      <input type="datetime-local" class="form-control" name="enrollstartDate">
                    </div>
                    <div class="col-md-6">
                      <label for="endDate" class="form-label">報名結束日期</label>
                      <input type="datetime-local" class="form-control" name="enrollendDate">
                    </div>
                    <div class="col-md-6">
                      <label for="classStartDate" class="form-label">課程開始日期</label>
                      <input type="datetime-local" class="form-control" name="classstartdate">
                    </div>
                    <div class="col-md-6">
                      <label for="classEndDate" class="form-label">課程結束日期</label>
                      <input type="datetime-local" class="form-control" name="classenddate">
                    </div>
                    <div class="col-md-12">
                      <label for="intro" class="form-label">課程介紹</label>
                      <textarea class="form-control" name="intro" rows="5"></textarea>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary" href="class.php">儲存</button>
                      <!-- // 在表單處理後 -->
                      <!-- <?php
                            //header("Location: class.php"); // 替換 index.php 為你的首頁URL
                            //exit; // 退出
                            ?> -->
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- 推薦主內容都放在裡面↑ -->
          </div>

          <!-- 這層開始可以放內容↑ -->
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
  <script>
    //選擇圖片後預覽，並將按鈕改為儲存
    function uploadFile() {
      document.getElementById('class_img').click();
    }

    function previewFile() {
      const preview = document.getElementById('preview');
      const file = document.getElementById('class_img').files[0];
      const reader = new FileReader();

      reader.addEventListener("load", function() {
        // 將圖片轉換為 base64 並顯示
        preview.src = reader.result;
        // 將按鈕的文字改為 "儲存"
        // document.getElementById('uploadButton').innerText = "儲存";
        // // 將按鈕的 onclick 事件改為提交表單
        // document.getElementById('uploadButton').onclick = function() {
        //     document.getElementById('picFormId').submit();
        // };
      }, false);

      if (file) {
        reader.readAsDataURL(file);
      }
    }
  </script>
</body>

</html>