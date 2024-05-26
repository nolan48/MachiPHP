<?php
if (!isset($_GET["id"])) {
  echo "請循正常管道進入本頁面";
  exit;
} else {
  $id = $_GET["id"];
}

session_start();
// 檢查是否已經登入
if (!isset($_SESSION['machi-user_email'])) {
  // 如果使用者尚未登入，則重定向到 admin-login.php
  header('Location: admin-login.php');
  exit;
}


require_once("../machi_db_connect.php");

$sql = "SELECT product.*, category.category_name
        FROM product
        INNER JOIN category ON product.category_id_fk = category.category_id WHERE product_id = $id";

$result = $conn->query($sql);

$product = $result->fetch_assoc();


$sql2 = "SELECT * FROM product_img where product_img_id=$id";

$result2 = $conn->query($sql2);

$row2 = $result2->fetch_assoc();
// echo $row2["product_img_filename"];


$sql3 = "SELECT product.*, subcategory.subcategory_name
        FROM product
        INNER JOIN subcategory ON product.subcategory_id_fk = subcategory.subcategory_id WHERE product_id = $id";

$result = $conn->query($sql3);

$row3 = $result->fetch_assoc();
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrinks-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>商品資料</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
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

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="index.html">
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
            <a class="nav-link" href="index.html">
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
      <!-- machi -->
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">商品資料</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="layout.php">首頁</a></li>
            <li class="breadcrumb-item "><a href="product-list.php">商品頁面</a></li>
            <li class="breadcrumb-item active">商品資料</li>
          </ol>
        </div>

        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="card shadow">
                <div class="card-header text-center">
                  <!-- 這裡放使用者的頭像 -->
                  <img src="/team02/product_images/<?= $row2["product_img_filename"] ?>?<?= time() ?>" alt="product Avatar"
                    class="img-thumbnail mx-auto d-block" width="200" height="200">
                </div>
                <div class="card-body">
                  <!-- 這裡放使用者的資料 -->
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item">ID:
                      <?= $product["product_id"] ?>
                    </li>
                    <li class="list-group-item">商品名稱:
                      <?= $product["product_name"] ?>
                    </li>
                    <li class="list-group-item">售價:
                      <?= $product["product_price"] ?>
                    </li>
                    <li class="list-group-item">主類:
                      <?= $product["category_name"] ?>
                    </li>
                    <li class="list-group-item">次類:
                      <?= $row3["subcategory_name"] ?>
                    </li>
                    <li class="list-group-item">新增時間:
                      <?= $product["product_createtime"] ?>
                    </li>
                    <li class="list-group-item">修改時間:
                      <?= $product["product_updatetime"] ?>
                    </li>
                    <li class="list-group-item">商品介紹:
                      <?= $product["product_description"] ?>
                    </li>
                  </ul>
                  <div style="text-align: center; " class="mt-3">
                    <button class="btn btn-primary mc-text-semi-primary" onclick="window.history.back();">回上一頁</button>
                    <form action="product-update.php?id=<?= $product["product_id"] ?>" method="post"
                      style="display: inline;">

                      <input type="hidden" id="product_id" name="product_id" value="<?= $product["product_id"] ?>">
                      <button type="submit" class="btn btn-secondary mx-2 mc-text-semi-blue">資料修改</button>
                    </form>


                  </div>
                  <div class="d-flex justify-content-end">
                    <button class="btn btn-danger mt-2" data-bs-toggle="modal"
                      data-bs-target="#confirmModal<?= $product["product_id"] ?>">刪除商品</button>


                    <div class="modal fade" id="confirmModal<?= $product["product_id"] ?>" tabindex="-1"
                      aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">刪除商品</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            確認刪除?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary mc-text-semi-blue" data-bs-dismiss="modal">取消</button>
                            <form action="product_delete.php" method="post">
                              <input type="hidden" name="product_id" value="<?= $product["product_id"] ?>">
                              <button type="submit" class="btn btn-danger">確認刪除

                              </button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

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
  <?php include("../js.php") ?>
  <script>
    //選擇圖片後預覽，並將按鈕改為儲存
    function uploadFile() {
      document.getElementById('product_img').click();
    }

    function previewFile() {
      const preview = document.getElementById('preview');
      const file = document.getElementById('product_img').files[0];
      const reader = new FileReader();

      reader.addEventListener("load", function () {
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