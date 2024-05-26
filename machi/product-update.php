<?php

if (!isset($_POST["product_id"])) {
  echo "請循正常管道進入本頁面";
  exit;
} else {
  $id = $_POST["product_id"];
}

session_start();
// 檢查是否已經登入
if (!isset($_SESSION['machi-user_email'])) {
  // 如果使用者尚未登入，則重定向到 admin-login.php
  header('Location: admin-login.php');
  exit;
}



require_once("../machi_db_connect.php");

$sql = "SELECT * FROM product where product_id=$id";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

// $sql2 = "SELECT * FROM category ,product  where category.category_id=product.category_id_fk  and subcategory.subcategory_id=product.subcategory_id_fk and product.product_id=$id";

$sql2 = "SELECT * FROM category";

$resultcategory = $conn->query($sql2);

$rowacategory = $resultcategory->fetch_assoc();

$sql3 = "SELECT * FROM subcategory";

$resultsubcategory = $conn->query($sql3);

$rowsubcategory = $resultsubcategory->fetch_assoc();


$sql4 = "SELECT * FROM product_img where product_img_id=$id";

$result4 = $conn->query($sql4);

$row4 = $result4->fetch_assoc();

$sql5 = "SELECT * FROM category where category_id=$row[category_id_fk]";

$resultcategory2 = $conn->query($sql5);

$rowacategory2 = $resultcategory2->fetch_assoc();

$sql6 = "SELECT * FROM subcategory where subcategory_id=$row[subcategory_id_fk]";

$resultsubcategory2 = $conn->query($sql6);

$rowsubcategory2 = $resultsubcategory2->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrinks-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>商品更新</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>


  <style>
    select.custom-select {
      display: block;
      width: 100%;
      padding: 0.375rem 1.75rem 0.375rem 0.75rem;
      font-size: 1rem;
      font-weight: 400;
      line-height: 1.5;
      color: #495057;
      background-color: #fff;
      background-clip: padding-box;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
      transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
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
      <!-- machi -->
      <main>
        <div class="container-fluid px-4">
          <h1 class="mt-4">商品修改</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="home-page.php">首頁</a></li>
            <li class="breadcrumb-item "><a href="product-list.php">商品頁面</a></li>
            <li class="breadcrumb-item active">商品修改</li>
          </ol>
        </div>

        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-8">
              <div class="card shadow">
                <form id="picFormId" action="product-update-do.php" method="post" enctype="multipart/form-data">

                  <div class="card-header text-center">
                    <!-- 這裡放使用者的頭像 -->
                    <img id="preview" src="../product_images/<?= $row4["product_img_filename"] ?>" alt="" class="img-thumbnail mx-auto d-block" width="200" height="200">
                    <!-- 這裡放上傳圖片的 input -->
                    <div class="mt-3 d-flex justify-content-center">
                      <input type="file" id="product_img" name="product_img" value="" accept="" style="display: none;" onchange="previewFile()">
                      <input type="hidden" id="product_img_chick" name="product_img_chick" value="0" accept="" style="display: none;" onchange="previewFile()">
                      <button type="button" id="uploadButton" class="btn btn-primary mc-text-semi-primary " onclick="uploadFile()">上傳圖片</button>
                    </div>
                  </div>


                  <div class="card-body">

                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-2">ID:</div>
                          <div class="col"><input type="text" name="product_id" id="product_id" value="<?= $row["product_id"] ?>" class="form-control my-2"></div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-2">商品名稱:</div>
                          <div class="col"><input type="text" name="product_name" id="product_name" value="<?= $row["product_name"] ?>" class="form-control my-2" required></div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-2">分類:</div>

                          <select id="category_id_fk" name="category_id_fk" class="custom-select mb-2">

                            <?php foreach ($resultcategory as $category) : ?>
                              <?php if ($category['category_id'] == 7) continue; ?>

                              <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
                            <?php endforeach; ?>
                          </select>


                          <select id="sub_category_id" name="subcategory_id_fk" class="custom-select">
                            <option value="<?php echo $rowsubcategory2['subcategory_id']; ?>"><?php echo $rowsubcategory2['subcategory_name']; ?></option>

                          </select>





                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-2">價格:</div>
                          <div class="col"><input type="text" id="product_price" name="product_price" value="<?= $row["product_price"] ?>" class="form-control my-2" required></div>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="row">
                          <div class="col-2">商品介紹:</div>
                          <div class="col">
                            <textarea name="product_description" class="form-control my-2" required><?= $row["product_description"] ?></textarea>
                          </div>
                      </li>
                    </ul>
                    <div class="d-flex justify-content-center mt-3">
                      <div>
                        <button type="button" class="btn btn-primary mc-text-semi-primary" onclick="window.history.back();">回上一頁</button>
                        <input type="submit" class="btn btn-secondary  mc-text-semi-blue" value="更新資料">
                      </div>
                    </div>
                </form>

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
    function uploadFile() {
      document.getElementById('product_img').click();
    }

    function previewFile() {
      const preview = document.getElementById('preview');
      const file = document.getElementById('product_img').files[0];
      const reader = new FileReader();

      reader.addEventListener("load", function() {
        // 將圖片轉換為 base64 並顯示
        preview.src = reader.result;
      }, false);

      if (file) {
        reader.readAsDataURL(file);
      }


    }

    document.getElementById('product_img').addEventListener('change', function() {
      document.getElementById('product_img_check').value = '1';
    });
  </script>



  <!-- 列出資料庫所有的主類別對應的次類別 -->
  <script>
    document.getElementById('category_id_fk').addEventListener('change', function() {
      var mainCategorySelect = document.getElementById('category_id_fk');
      var subCategorySelect = document.getElementById('sub_category_id');
      var selectedMainCategoryId = mainCategorySelect.value;

      // Clear subcategory options
      // subCategorySelect.innerHTML = '<option value="0">請選擇次類別</option>';

      // Do not display subcategories if no main category is selected
      if (selectedMainCategoryId === '0') {
        subCategorySelect.style.display = 'none';
      } else {
        subCategorySelect.style.display = 'block';
        subCategorySelect.innerHTML = '';
        // Populate subcategory options based on the selected main category
        <?php foreach ($resultsubcategory as $subcategory) : ?>
          if (selectedMainCategoryId === '<?php echo $subcategory['category_id_fk']; ?>') {
            subCategorySelect.innerHTML += '<option value="<?php echo $subcategory['subcategory_id']; ?>"><?php echo $subcategory['subcategory_name']; ?></option>';
          }
        <?php endforeach; ?>
      }
    });
  </script>

  <!-- 讀取此ID主類別並設定為selected -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var mainCategorySelect = document.getElementById('category_id_fk');
      var selectedCategoryId = '<?php echo $row['category_id_fk']; ?>';

      for (var i = 0; i < mainCategorySelect.options.length; i++) {
        if (mainCategorySelect.options[i].value === selectedCategoryId) {
          mainCategorySelect.options[i].selected = true;
          break;
        }
      }
    });
  </script>


  <!-- 讀取此ID次類別並設定為selected -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      var mainCategorySelect = document.getElementById('category_id_fk');
      var subCategorySelect = document.getElementById('sub_category_id');
      var selectedSubCategoryId = '<?php echo $row['subcategory_id_fk']; ?>';

      // Trigger change event on main category to load subcategories
      mainCategorySelect.dispatchEvent(new Event('change'));

      // Wait for the subcategories to be loaded
      setTimeout(function() {
        for (var i = 0; i < subCategorySelect.options.length; i++) {
          if (subCategorySelect.options[i].value === selectedSubCategoryId) {
            subCategorySelect.options[i].selected = true;
            break;
          }
        }
      }, 100); // Adjust timeout as needed based on how long it takes to load subcategories
    });
  </script>

  <script>
    //   document.getElementById('picFormId').addEventListener('submit', function(event) {
    //   var name = document.getElementById('product_name').value.trim();
    //   var price = document.getElementById('product_price').value.trim();
    //   var img = document.getElementById('product_img');

    //   if (!name || !price  ) {
    //     alert('更改商品錯誤：請輸入名稱、價格！');
    //     return false; // Prevent form submission
    //   }

    //   if (!img.name.length ) {
    //     alert('新增商品錯誤：請選擇圖片！');
    //     return false; // Prevent form submission
    //   }

    //   if(name.length < 3 || name.length > 20){
    //     alert('商品名稱請輸入2-20個字');
    //     return false; // Prevent form submission
    // }
    // if (isNaN(price) || price < 100 || price > 10000) {
    //     alert('商品價格錯誤：請輸入介於100到10000之間的數字！');
    //     return false; // Prevent form submission
    // }



    // });

    document.getElementById('picFormId').addEventListener('submit', function(event) {
      var name = document.getElementById('product_name').value.trim();
      var price = document.getElementById('product_price').value.trim();
      var img = document.getElementById('product_img');

      if (!name || !price) {
        alert('更改商品錯誤：請輸入名稱、價格！');
        event.preventDefault(); // Prevent form submission
      } else if (!img.name.length) {
        alert('新增商品錯誤：請選擇圖片！');
        event.preventDefault(); // Prevent form submission
      } else if (name.length < 3 || name.length > 20) {
        alert('商品名稱請輸入2-20個字');
        event.preventDefault(); // Prevent form submission
      } else if (isNaN(price) || price < 100 || price > 10000) {
        alert('商品價格錯誤：請輸入介於100到10000之間的數字！');
        event.preventDefault(); // Prevent form submission
      };


    });
  </script>







</body>

</html>