<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

require("./PHPMailer-master/PHPMailer-master/src/PHPMailer.php");
require("./PHPMailer-master/PHPMailer-master/src/Exception.php");
require("./PHPMailer-master/PHPMailer-master/src/SMTP.php");

mb_language("Japanese");
mb_internal_encoding("UTF-8");

$mail = new PHPMailer(true);



require('library.php');
$error = [];

if(!empty($_POST)){
  if ($_POST['name'] == ""){
    $error['name'] = 'blank';
  }elseif ($_POST['email'] == ""){
    $error['email'] = 'blank';
  }elseif ($_POST['message'] == ""){
    $error['message'] = 'blank';
  }else{
    $stmt = $pdo->prepare('insert into customer_info(name, email, message) values (:name, :email, :message)');
    $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
  
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
  
    $stmt->bindParam(':message', $_POST['message'], PDO::PARAM_STR);

    $success = $stmt->execute();


   try{
    // $phpmailer = new PHPMailer();
    // $phpmailer->isSMTP();
    // $phpmailer->Host = 'sandbox.smtp.mailtrap.io';
    // $phpmailer->SMTPAuth = true;
    // $phpmailer->Port = 2525;
    // $phpmailer->Username = '1bb972606c9ae0';
    // $phpmailer->Password = '33c276e84c24d3';

    //server
    $mail->SMTPDebug = 2; //本番では0とかにする。
    $mail->isSMTP();
    $mail->Host = 'smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = '1bb972606c9ae0'; //ここにusername入れる
    $mail->Password = '33c276e84c24d3'; //ここにpassword入れる
    $mail->SMTPSecure = 'tls';
    $mail->Port = 2525;    


    $mail->setFrom($_POST['email']);
    $mail->addAddress('to@example.com', 'Mr To');
    $mail->Subject = 'テストです';
    $mail->Body = 'メッセージ本文';


    $mail->send();
    header('location:success.html');
    exit();
   }catch (Exception $e){
    echo "送信に失敗しました : {$mail->ErrorInfo}";
   }
  
  }

}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.2/tailwind.min.css">
</head>
<body>
<header class="header">
     <div class="logo"><img src="img/logo.png" alt=""></div>
     <!-- <button class="hamburger-menu" id="js-hamburger-menu">
       <span class="hamburger-menu_bar"></span>
       <span class="hamburger-menu_bar"></span>
       <span class="hamburger-menu_bar"></span>
     </button> -->
     <!-- <nav class="navigation">
      <ul class="navigation_list">
        <li class="navigation_list-item"><a href="#theme1" class="navigation_link">ホーム</a></li>
        <li class="navigation_list-item"><a href="#theme2" class="navigation_link">選ばれる理由</a></li>
        <li class="navigation_list-item"><a href="#theme3" class="navigation_link">体験談</a></li>
        <li class="navigation_list-item"><a href="#theme4" class="navigation_link">合格実績</a></li>
        <li class="navigation_list-item"><a href="#theme5" class="navigation_link">お問い合わせ</a></li>
      </ul>
     </nav> -->

  </header>



<section class="text-gray-600 body-font relative">
  <form method="post" class="p-0 m-0 w-full"> 
  <div class="container px-5 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-gray-900">お問い合わせ内容</h1>
      <p class="lg:w-2/3 mx-auto leading-relaxed text-base">この度はアドバンスゼミ公式ホームページを<br>ご覧いただきまして誠にありがとうございます。
        <br>教室見学・無料体験授業のお問い合わせなど、 <br>下記項目にご記入の上ご送信ください。
      </p>
    </div>
    <div class="lg:w-1/2 md:w-2/3 mx-auto">
      <div class="flex flex-wrap -m-2">

          <div class="p-2 w-full">
            <div class="relative">
              <label for="name" class="leading-7 text-sm text-gray-600">お名前</label>
              <input type="text" id="name" name="name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
          </div>
          <div class="p-2 w-full">
            <div class="relative">
              <label for="email" class="leading-7 text-sm text-gray-600">メールアドレス</label>
              <input type="email" id="email" name="email" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            </div>
          </div>
          <div class="p-2 w-full">
            <div class="relative">
              <label for="message" class="leading-7 text-sm text-gray-600">お問い合わせ内容</label>
              <textarea id="message" name="message" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
            </div>
          </div>
          <div class="p-2 w-1-2">
           
              <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg"><a href="./index.html">戻る</a></button>
         
          </div>
          <div class="p-2 w-1/2">
            <button name="btn" class="flex mx-auto text-white bg-indigo-500 border-0  py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg
            absolute right-5">送信する</button>
          </div>
          <div class="p-2 w-full pt-8 mt-8 border-t border-gray-200 text-center">
            <a class="text-indigo-500">example@email.com</a>
            <p class="leading-normal my-5">〒144-0044
              <br>東京都大田区本羽田2丁目6-9 
            </p>
          </div>
        </div>
      </div>
    </div>
  </form>
</section>


<script 
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>

  <script src="./js/sample.js"></script>
</body>
</html>