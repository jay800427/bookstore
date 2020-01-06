<?php
     //初始化 curl
     $curl = curl_init();

     //設定發出請求的瀏覽器
     curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36");

     //設定接受所有https 憑證，不做驗證
     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER,false);

     //設定跟隨重新導向
     curl_setopt($curl, CURLOPT_FOLLOWLOCATION,true);

     //重新導向時自動設定訪客來源 referer
     curl_setopt($curl, CURLOPT_AUTOREFERER,true);

     // 將回傳資料寫入變數，而不是直接輸出
     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 

     curl_setopt($curl, CURLOPT_URL, "https://cloud.culture.tw/frontsite/trans/emapOpenDataAction.do?method=exportEmapJson&typeId=M");

     $data = curl_exec($curl);

     curl_close($curl);
 
     // 將JSON文字轉為可使用的陣列
     // true 轉陣列，false 轉物件
     $json = json_decode($data, true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
 <!-- Global site tag (gtag.js) - Google Analytics -->
 <script async src="https://www.googletagmanager.com/gtag/js?id=UA-154746325-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-154746325-2');
    </script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <!-- Primary Meta Tags -->
   <title>書店資訊</title>
    <meta name="title" content="獨立書店">
    <meta name="description" content="獨立書店範例網">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="http://220.128.133.15/s1080309/boostrap/bookstore/">
    <meta property="og:title" content="獨立書店">
    <meta property="og:description" content="獨立書店範例網">
    <meta property="og:image" content="./images/bg.jpg">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="http://220.128.133.15/s1080309/boostrap/bookstore/">
    <meta property="twitter:title" content="獨立書店">
    <meta property="twitter:description" content="獨立書店範例網">
    <meta property="twitter:image" content="./images/bg.jpg">
  <link rel="stylesheet" href="./css/all.min.css">
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/work.css">
  <link rel="stylesheet" href="./css/dataTables.bootstrap4.min.css">
  <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Noto+Sans+TC&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="./images/event.ico" type="image/x-icon">
  <style>
    body{
      background: linear-gradient(#ACBB78,#F7F8F8);
      font-family: 'Noto Sans TC','Baloo Bhai', cursive;
    }
    .navbar{
    box-shadow: 5px 5px 5px #888888;
            }

    #footer, #part, #part1, #part2{
          display:none;
      }
    #loading{
        height: 100vh;
        position: fixed;
        z-index: 999;
  
    }
  </style>
</head>

<body>
<div id="particles"></div>
    
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" style="font-size:20px;" href="index.html"><i class="fas fa-feather"></i>&nbsp;&nbsp;My Book Store</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
    <ul class="navbar-nav navbar-right">
      <li class="nav-item">
        <a class="nav-link" href="event.html"><i class="fas fa-genderless"></i>&nbsp;首頁 <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="main.php"><i class="fas fa-genderless"></i>&nbsp;書店資訊</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="msg.php"><i class="fas fa-genderless"></i>&nbsp;連絡我們</a>
      </li>
    </ul>
  </div>
</div>
</nav>

<div class="container-fluid" id="loading">
  <div class="row h-100">
      <div class="col-12 align-self-center text-center">
          <img src="./images/gear.svg" alt="">
          <p class="text-dark">Loading...</p>
      </div>
  </div>
</div>

<div class="container" id="part">
    <div class="row">
            <div class="col-12 my-3">
                
                <hr class="bg-black">
            </div>
  </div>
</div>

  <div class="container" id="part1">
    <div class="row">
            <div class="col-12 my-3">
                <h1 class="text-center text-black">Unique BookStore</h1>
                <hr class="bg-black">
            </div>
      <div class="col-12 my-3">
        <table class="table table-hover table-bordered" id="box">
          <thead class="thead-dark">
            <tr>
              <th>店名</th>
              <th>地址</th>
              <th>網站</th>
              <th>電話</th>
              <th>信箱</th>
              <th>營業時間</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($json as $value) {
            ?>
            <tr>
              <td data-th="店名"><?=$value['name']?></td>
              <td data-th="地址"><?=$value['address']?></td>
              <td data-th="網站"><a href="<?=$value['website']?>" target="_blank"><?=$value['name']?></a></td>
              <td data-th="電話"><?=$value['phone']?></td>
              <td data-th="信箱"><?=$value['email']?></td>
              <td data-th="營業時間"><?=$value['openTime']?></td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="container-fluid bg-secondary text-white text-center" id="footer">
            <div class="row">
                <div class="col-12">
                <ul class="nav justify-content-center">
                                <li class="nav-item">
                                  <a class="nav-link text-white" href="https://github.com/jay800427"><i class="fab fa-github-square" title="My github"></i></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link text-white"><i class="fas fa-envelope" title="jay8000427@gmail.com"></i></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link text-white" href="https://wdaweb.github.io/"><i class="fab fa-google-plus-square" title="泰山網頁設計"></i></i></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link text-white" href="#"><i class="far fa-caret-square-up" title="置頂"></i></i></a>
                                </li>
                              </ul>
                    <h6>&copy;<script>document.write(new Date().getFullYear())</script>&nbsp;泰&nbsp;山&nbsp;網&nbsp;頁&nbsp;班&nbsp;製&nbsp;作</h6>
                </div>
            </div>
        </div>
  <script src="./js/jquery-3.4.1.min.js"></script>
  <script src="./js/bootstrap.bundle.min.js"></script>
  <script src="./js/jquery.dataTables.min.js"></script>
  <script src="./js/dataTables.bootstrap4.min.js"></script>
  <script src="./js/Chart.min.js"></script>
  <script>
  $("#box").DataTable({
            language:{
                url: './datatables/chinese.json'
            },
            columnDefs:[
                {
                    targets: 3,
                    orderable:false,
                    searchable:false
                }
            ]
        })
    </script>

  <script>
    $(window).on('load', function(){
        $("#loading").fadeOut(2000,function(){
            $("#footer").fadeIn(); 
            $("#part").fadeIn(); 
            $("#part1").fadeIn(); 
        })
    })

</script>
</body>

</html>