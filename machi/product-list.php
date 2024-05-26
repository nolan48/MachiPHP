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
$perPage = 10;

$sql = "SELECT *
        FROM product
        INNER JOIN category ON product.category_id_fk = category.category_id";
$result = $conn->query($sql);

$rows = $result->fetch_all(MYSQLI_ASSOC);


$sqlAll = "SELECT * FROM product";
$resultAll = $conn->query($sqlAll);
$productTotalCount = $resultAll->num_rows;

$pageCount = ceil($productTotalCount / $perPage);


// 判斷是否有排序的參數
if (isset($_GET["order"])) {
  $order = $_GET["order"];

  if ($order == 1) {
    $orderStringAD = "ASC";
  } elseif ($order == 2) {
    $orderStringAD = "DESC";
  }
} else {
  $orderStringAD = "ASC";
}

// 判斷是否有排序的參數

$orderString="";
if (isset($_GET["sort"])) {

  $sort = $_GET["sort"];
  if ($sort == 1) {
    $orderString = "ORDER BY product_id $orderStringAD";
  } elseif ($sort == 2) {
    $orderString = "ORDER BY product_name $orderStringAD";
  } elseif ($sort == 3) {
    $orderString = "ORDER BY product_price $orderStringAD";
  } elseif ($sort == 4) {
    $orderString = "ORDER BY product_count $orderStringAD";
  } elseif ($sort == 5) {
    $orderString = "ORDER BY category_id_fk $orderStringAD";
  } elseif ($sort == 6) {
    $orderString = "ORDER BY product_updatetime $orderStringAD";
  } elseif ($sort == 7) {
    $orderString = "ORDER BY product_valid $orderStringAD";
  }
} else {
  $orderString = "ORDER BY product_id $orderStringAD";
}



if (isset($_GET["search"])) {
  $search = $_GET['search'];
  if (isset($_GET['scope']) && $_GET['scope'] == 'id') {
    $sql = "SELECT * FROM product 
            INNER JOIN category ON product.category_id_fk = category.category_id 
            WHERE product.product_id = '$search' " . $orderString;
  } else {
    $searchWhatever = '(product_id LIKE "%' . $search . '%" OR product_name LIKE "%' . $search . '%" OR product_price LIKE "%' . $search . '%" )';
    $sql = "SELECT * FROM product 
            INNER JOIN category ON product.category_id_fk = category.category_id 
            WHERE $searchWhatever " . $orderString;
  }
} elseif (isset($_GET["p"])) {
  $p = $_GET["p"];
  $startIndex = ($p - 1) * $perPage;
  $sql = "SELECT * FROM product 
          INNER JOIN category ON product.category_id_fk = category.category_id 
           $orderString  
           LIMIT $startIndex, $perPage ";
} else {
  $p = 1;
  $sql = "SELECT * FROM product 
INNER JOIN category ON product.category_id_fk = category.category_id 
$orderString 
LIMIT $perPage";
}





$result = $conn->query($sql);




// echo "<pre>";
// print_r($rows);
// echo "</pre>";








if (isset($_GET["search"])) {
  $productCount = $result->num_rows;
} else {
  $productCount = $productTotalCount;
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrinks-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>商品頁面</title>

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

    .pagination a.active {
      background-color: dodgerblue;
      color: white;
      border: 1px solid dodgerblue;
    }

    .pagination a:hover:not(.active) {
      background-color: #ddd;
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
      <!-- machi -->
      <main>

        <div class="container-fluid px-4">
          <h1 class="mt-4">商品頁面</h1>
          <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item "><a href="home-page.php">首頁</a></li>
            <li class="breadcrumb-item active ">商品頁面</li>
          </ol>
          <div class="container">

            <div class="py-2">
              <div class="row g-3">

                <div class="col">
                  <?php if (isset($_GET["search"])) : ?>
                    <div class="col-auto">
                      <a class="btn btn-outline-success me-2  mc-semi-blue" href="product-list.php?sort=<?= isset($_GET['sort']) ? $_GET['sort'] : '' ?>&p=<?= isset($_GET['p']) ? $_GET['p'] : '1' ?>"><i class="fa-solid fa-rotate-right"></i></a>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="col"></div>
                <div class="col-auto">
                  <button class="btn btn-secondary mc-text-semi-blue" type="button" id="searchButton">
                    找關鍵字
                  </button>
                </div>
                <div class="col">


                  <form class="d-flex flex-grow-1" action="product-list.php" method="get" id="searchForm">
                    <input class="form-control flex-grow-1 me-2" type="search" placeholder="輸入關鍵字" aria-label="搜尋" name="search">
                    <input type="hidden" name="scope">
                    <button class="btn btn-outline-susccess ms-auto mc-semi-blue " type="submit" style="min-width: 60px;"> <i class="fa fa-search"></i></button>
                  </form>
                </div>
              </div>
            </div>

            <div class="d-flex justify-content-between pb-2 align-items-center">
              <div>
                共
                <?= $productCount ?> 項
              </div>


              <div>
                <div class="container-fluid d-flex justify-content-end my-2">
                  <!-- 排序根據的下拉選單 -->
                  <div class="dropdown ">
                    <button class="btn btn-secondary dropdown-toggle mc-text-semi-blue" type="button" id="dropdownMenuSort" data-bs-toggle="dropdown" aria-expanded="false">
                      排序依據
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuSort">
                      <li><a class="dropdown-item dropdown-item-e" href="?sort=1">
                          商品ID</a></li>
                      <li><a class="dropdown-item dropdown-item-e" href="?sort=2">商品名稱</a></li>
                      <li><a class="dropdown-item dropdown-item-e" href="?sort=3">售價</a></li>
                      <li><a class="dropdown-item dropdown-item-e" href="?sort=4">售出數量</a></li>
                      <li><a class="dropdown-item dropdown-item-e" href="?sort=5">商品主類</a></li>
                      <li><a class="dropdown-item dropdown-item-e" href="?sort=6">更改時間</a></li>
                      <li><a class="dropdown-item dropdown-item-e" href="?sort=7">上架狀態</a></li>
                    </ul>
                  </div>

                  <!-- 切換升降順序的按鈕 -->
                  <button class="btn btn-outline-success ml-2 mx-2 mc-semi-blue" type="button" id="toggleSortOrder">
                    <i class="fa-solid fa-arrow-up-wide-short" id="sortIcon"> </i>
                  </button>
                  <a name="" id="" class="btn btn-primary mc-text-semi-primary " href="product-add.php" role="button">新增商品</i></a>
                </div>
              </div>


            </div>



            <table id="" class="table table-hover table-striped">
              <thead class="table-dark">
                <tr>
                  <th>商品ID

                  </th>
                  <th>商品名稱

                  </th>
                  <th>售價

                  </th>
                  <th>售出數量

                  </th>
                  <th>商品主類

                  </th>
                  <th>更改時間

                  </th>
                  <th>上架狀態

                  </th>
                  <th></th>

                </tr>
              </thead>
              <tbody>
                <?php

                $result = $conn->query($sql);

                $rows = $result->fetch_all(MYSQLI_ASSOC);
                foreach ($rows as $product) :

                ?>
                  <tr>
                    <td>
                      <?= $product["product_id"] ?>
                    </td>
                    <td>
                      <?= $product["product_name"] ?>
                    </td>
                    <td>
                      <?= $product["product_price"] ?>
                    </td>
                    <td>
                      <?= $product["product_count"] ?>
                    </td>
                    <td>
                      <?= $product["category_name"] ?>
                    </td>
                    <td>
                      <?= $product["product_updatetime"] ?>
                    </td>
                    <td>
                      <?php if ($product["product_valid"] == 1) : ?>
                        <form action="product-valid.php" method="get">
                          <input type="hidden" name="product_id" value="<?= $product["product_id"] ?>">
                          <button type="submit" class="btn btn-outline-primary  mx-2 mc-light-blue"><i class="fa-solid fa-eye"></i></button>
                        </form>
                      <?php else : ?>
                        <form action="product-valid.php" method="get">
                          <input type="hidden" name="product_id" value="<?= $product["product_id"] ?>">
                          <button type="submit" class="btn  btn-outline-secondary mx-2 mc-semi-blue"><i class="fa-solid fa-eye-slash"></i></button>
                        </form>
                      <?php endif ?>
                    </td>
                    <td class="  ">

                      <a class="btn btn-primary mx-2  mc-text-semi-primary " href="product_edit.php?id=<?= $product["product_id"] ?>" role="button">詳細資料</a>

                      <button class="btn mc-semi-blue mx-2" data-bs-toggle="modal" data-bs-target="#confirmModal<?= $product["product_id"] ?>"><i class="fa-solid fa-trash fa-fw"></i></button>


                      <div class="modal fade" id="confirmModal<?= $product["product_id"] ?>" tabindex="-1" aria-hidden="true">
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
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                              <form action="product_delete.php" method="post">
                                <input type="hidden" name="product_id" value="<?= $product["product_id"] ?>">
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
            <nav aria-label="Page navigation example">
              <ul class="pagination" id="pagination">
                <!-- 此處將在JavaScript中動態生成分頁連結 -->
              </ul>
            </nav>

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
    $(document).ready(pag());
    document.getElementById('searchForm').addEventListener('submit',pag());

    function pag() {
      // 獲取網址的查詢參數
      var params = new URLSearchParams(window.location.search);

      // 從 PHP 程式碼中獲取總頁數
      var pageCount = <?php echo $pageCount; ?>;

      // 獲取當前頁碼
      var currentPage = <?php echo $p; ?>;

      // 計算起始和結束頁碼
      var startPage = Math.max(1, currentPage - 2);
      var endPage = Math.min(pageCount, startPage + 4);
      startPage = Math.max(1, endPage - 4);

      // 建立分頁連結
      var pagination = $('#pagination');

      // 添加首頁連結
      params.set('p', 1);
      pagination.append('<li><a href="?' + params.toString() + '">首頁</a></li>');

      // 添加分頁連結
      for (var i = startPage; i <= endPage; i++) {
        // 如果已經添加了5個分頁按鈕，則停止添加
        if (i - startPage >= 5) {
          break;
        }
        var li = $('<li></li>');
        var a = $('<a></a>');
        params.set('p', i);
        a.attr('href', '?' + params.toString());
        a.text(i);
        if (i === currentPage) {
          li.addClass('active');
        }
        li.append(a);
        pagination.append(li);
      }

      // 添加末頁連結
      params.set('p', pageCount);
      pagination.append('<li><a href="?' + params.toString() + '">末頁</a></li>');
    };

  </script>
  <!-------------------------------------------------------------分頁用的ajax↑ ------------------------------------------------ -->


  <script>
    $(document).ready(function() {
      // 獲取網址的查詢參數
      var params = new URLSearchParams(window.location.search);

      // 獲取 'scope' 參數的值
      var scope = params.get('scope');

      // 為 "找關鍵字" 按鈕添加點擊事件處理器
      $('#searchButton').click(function() {
        // 如果 'scope' 參數的值為 'all'，則將其設定為 'byid'，並將按鈕的文字設定為 '找ID'
        if (scope === 'id') {
          scope = 'all';
        } else {
          // 否則將 'scope' 參數的值設定為 'all'，並將按鈕的文字設定為 '找全部關鍵字'
          scope = 'id';
        }

        // 更新網址的查詢參數
        params.set('scope', scope);

        // 重新導向到新的網址
        window.location.href = window.location.pathname + '?' + params.toString();
      });

      // 獲取 'sort' 參數的值
      var sort = params.get('sort');

      // 獲取 'order' 參數的值
      var order = params.get('order');

      // 如果 'order' 參數的值為 '2'，則將箭頭圖標設定為向下，否則設定為向上
      if (order === '2') {
        $('#sortIcon').removeClass('fa-arrow-up-wide-short').addClass('fa-arrow-down-wide-short');
      } else {
        $('#sortIcon').removeClass('fa-arrow-down-wide-short').addClass('fa-arrow-up-wide-short');
      }

      // 為切換升降順序的按鈕添加點擊事件處理器
      $('#toggleSortOrder').click(function() {
        // 如果 'order' 參數的值為 '2'，則將其設定為 '1'，否則設定為 '2'
        if (order === '2') {
          order = '1';
        } else {
          order = '2';
        }

        // 更新網址的查詢參數
        params.set('order', order);

        // 重新導向到新的網址
        window.location.href = window.location.pathname + '?' + params.toString();
      });


      $(document).ready(function() {
        // 獲取網址的查詢參數
        var params = new URLSearchParams(window.location.search);

        // 獲取 'sort' 參數的值
        var sort = params.get('sort');
        var scope = params.get('scope');

        // 根據 'sort' 參數的值來設定按鈕的文字
        switch (sort) {
          case '1':
            $('#dropdownMenuSort').text('商品ID');
            break;
          case '2':
            $('#dropdownMenuSort').text('商品名稱');
            break;
          case '3':
            $('#dropdownMenuSort').text('售價');
            break;
          case '4':
            $('#dropdownMenuSort').text('售出數量');
            break;
          case '5':
            $('#dropdownMenuSort').text('	商品主類');
            break;
          case '6':
            $('#dropdownMenuSort').text('更新時間');
            break;
          case '7':
            $('#dropdownMenuSort').text('上架狀態');
            break;

        }
        if (scope === 'id') {

          $('#searchButton').text('找ID');
          $('input[name="search"]').attr('placeholder', '輸入會員ID');
          $('input[name="scope"]').val('id');
        } else {
          $('#searchButton').text('找關鍵字');
          $('input[name="search"]').attr('placeholder', '輸入關鍵字');
          $('input[name="scope"]').val('all');

        }

      });


      // 為每個下拉選單項目添加點擊事件處理器
      $('.dropdown-item-e').click(function(e) {
        e.preventDefault();

        // 獲取選擇的值
        sort = $(this).attr('href').split('=')[1];

        // 更新按鈕的文字
        $('#dropdownMenuSort').text($(this).text());

        // 更新網址的查詢參數
        params.set('sort', sort);

        // 重新導向到新的網址
        window.location.href = window.location.pathname + '?' + params.toString();
      });

      var url = new URL(window.location.href);

      // 獲取 search 參數的值
      var search = url.searchParams.get('search');

      // 如果 search 參數存在，則將搜尋輸入框的值設定為該值
      if (search) {
        document.querySelector('input[name="search"]').value = search;
      }
    });
  </script>

</body>

</html>