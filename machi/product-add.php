<?php


// 啟動 session
session_start();
// 檢查是否已經登入
if (!isset($_SESSION['machi-user_email'])) {
  // 如果使用者尚未登入，則重定向到 admin-login.php
  header('Location: admin-login.php');
  exit;
}


require_once("../machi_db_connect.php");

$sql = "SELECT * FROM product";

$resultproduct = $conn->query($sql);

$rowproduct = $resultproduct->fetch_assoc();

$sql2 = "SELECT * FROM category";

$resultategory = $conn->query($sql2);

$rowacategory = $resultategory->fetch_assoc();

$sql3 = "SELECT * FROM subcategory";

$resultsubcategory = $conn->query($sql3);

$rowsubcategory = $resultsubcategory->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrinks-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>商品新增</title>
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>


  <style>
    .container {
      width: 50%;
      margin: auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type=text],
    select,
    textarea,
    input[type=file] {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
      margin-top: 6px;
      margin-bottom: 16px;
    }

    input[type=submit] {
      background-color: #4CAF50;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type=submit]:hover {
      background-color: #45a049;
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

    .submit-button-container {
      text-align: right;
    }

    .img-thumbnail {
  border: none;
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
          <h1 class="mt-4">新增商品</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="layout.php">首頁</a></li>
            <li class="breadcrumb-item "><a href="product-list.php">商品頁面</a></li>
            <li class="breadcrumb-item active">新增商品</li>
          </ol>
        </div>


        <div class="container card shadow">

          <form action="product-add-do.php" method="post" enctype="multipart/form-data" id="productForm">
            <label for="">商品名稱</label>
            <input type="text" name="product_name" id="product_name">

            <label for="">價格</label>
            <input type="text" name="product_price" id="product_price">

            <label for="">類別</label>
            <select id="category_id_fk" name="category_id_fk" >
              <option value="0">請選擇主類別</option>
              <?php foreach ($resultategory as $category) : ?>
                <option value="<?php echo $category['category_id']; ?>"><?php echo $category['category_name']; ?></option>
              <?php endforeach; ?>
            </select>

            <select id="sub_category_id" name="subcategory_id_fk">
              <option value="0">請選擇次類別</option>

            </select>






            


            <div class="row">
              <div class="col">
                <label for="image">圖片上傳</label>
                <!-- 這裡放使用者的頭像 -->
                <img id="preview" src="../product_images/0201000274-1.png" alt="" class="img-thumbnail mx-auto d-block" width="200" height="200">
                <!-- 這裡放上傳圖片的 input -->
                <div class="mt-3 d-flex justify-content-center ">
                  <input type="file" id="product_img" name="product_img" accept="product_images/*" style="display: none;" onchange="previewFile()">
                  <button type="button" id="uploadButton" class="btn btn-primary mc-text-semi-primary" onclick="uploadFile()">上傳圖片</button>
                </div>
              </div>

              <div class="col">
                <label for="">商品介紹</label>
                <div></div>
                <textarea name="product_description" id="" cols="20" rows="10" style="width: 280px; height: 200px; " class="mx-auto d-block"></textarea>
              </div>
            </div>

            <div class="submit-button-container">
              <input id="" type="submit" class="btn btn-secondary  mc-text-semi-blue" value="確定">
            </div>



          </form>

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

  <script>
    document.getElementById('category_id_fk').addEventListener('change', function() {
      var mainCategorySelect = document.getElementById('category_id_fk');
      var subCategorySelect = document.getElementById('sub_category_id');
      var selectedMainCategoryId = mainCategorySelect.value;

      // Clear subcategory options
      subCategorySelect.innerHTML = '<option value="0">請選擇次類別</option>';

      // Do not display subcategories if no main category is selected
      if (selectedMainCategoryId === '0') {
        subCategorySelect.style.display = 'none';
      } else {
        subCategorySelect.style.display = 'block';

        // Populate subcategory options based on the selected main category
        <?php foreach ($resultsubcategory as $subcategory) : ?>
          if (selectedMainCategoryId === '<?php echo $subcategory['category_id_fk']; ?>') {
            subCategorySelect.innerHTML += '<option value="<?php echo $subcategory['subcategory_id']; ?>"><?php echo $subcategory['subcategory_name']; ?></option>';
          }
        <?php endforeach; ?>
      }
    });
  </script>

<script>
// document.getElementById('productForm').addEventListener('submit', function(event) {
//   var name = document.getElementById('product_name').value.trim();
//   var price = document.getElementById('product_price').value.trim();
//   var category_id_fk = document.getElementById('category_id_fk').value;
//   var subCategory = document.getElementById('sub_category_id').value;
//   var img = document.getElementById('product_img');

//   if (!name || !price || !img['name'].trim() || category_id_fk == 0 || subCategory == 0) {
//     event.preventDefault(); // Prevent form submission
//     alert('請輸入名稱、價格並選擇主類別和副類別！');
//   }
// });


document.getElementById('productForm').addEventListener('submit', function(event) {
  var name = document.getElementById('product_name').value.trim();
  var price = document.getElementById('product_price').value.trim();
  var category_id_fk = document.getElementById('category_id_fk').value;
  var subCategory = document.getElementById('sub_category_id').value;
  var img = document.getElementById('product_img');

  if (!name || !price  || category_id_fk == 0 || subCategory == 0) {
    alert('新增商品錯誤：請輸入名稱、價格並選擇主類別和副類別！');
    event.preventDefault(); // Prevent form submission
  }

  if (!img.files.length || img.files[0].name === "0201000274-1.png") {
    alert('新增商品錯誤：請選擇圖片！');
    event.preventDefault(); // Prevent form submission
  }

  if(name.length < 2 || name.length > 20){
    alert('商品名稱請輸入2-20個字');
    event.preventDefault(); 
  }
  if (!is_numeric($price) || $price < 100 || $price > 10000) {
    alert('商品價格錯誤：請輸入介於100到10000之間的數字！');
    event.preventDefault();  // Prevent form submission
  }

});
</script>




</body>

</html>