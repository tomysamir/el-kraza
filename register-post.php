<?php
include('incloude/connect.php');
// كدا ضمنته دوا صفحتي
if(isset($_POST['submit' ])){
    // يعني لو حد دخل بيانات وداس عالزر يعتبر بوست اللي هي الميثود بتاعت الفورم :هيبعتهالي علي شكل بوست
    $username = stripcslashes(strtolower($_POST['Username']));
    $email    = stripcslashes($_POST['Email']);
    $password = stripcslashes($_POST['Password']);
// stripslashes: بتشيل اي حاجه بيتكتب فيها "/"عشان ميجيش حد يكتبلك سكريبت جافا سكريبت خبيث وياخد كل معلومات الداتا بيس
// strtolowers : بتخليه يكتب بحرةف صغيرة اجباري

  if(isset($_POST['bitrhday_month']) && isset($_POST['bitrhday_day']) && isset($_POST['bitrhday_year'])){
    $bitrhday_month = (int) $_POST['bitrhday_month'];
    $bitrhday_day = (int) $_POST['birthday-day'];
    $bitrhday_year = (int) $_POST['birthday-year'];
    // (int): عشان يخزن اي حاجه ك رقم عشان لما اخد البنات هاخد الفاليو بتاعتها ودي كلها ارقام
    $bitrhday = htmlentities(mysqli_real_escape_string($conn,$bitrhday_day.'-'.$bitrhday_month.'-'.$bitrhday_year));
    // htmlentities(): بتحولي كود ال html لرموز
   //mysqli_real_escape_string(): بتحميني من ال sql injection  //
  //   (")بتجولي اقيم اللي فوق بعد ماكانت رقم الي نص وبتشيل ال  //
  }


  $username = htmlentities(mysqli_real_escape_string($conn, $_POST['Username']));
  $email    = htmlentities(mysqli_real_escape_string($conn, $_POST['Email']));
  $password = htmlentities(mysqli_real_escape_string($conn, $_POST['Password']));
  $md5_pass = md5($password);
  // عشان اي حد يكتب باسورد تشفره

  if(isset($_POST['gender'])){
    $gender = $_POST['gender'];
    $gender = htmlentities(mysqli_real_escape_string($conn, $_POST['gender']));
//  الجايه عشان لما حد يخش علي كود الموقع ويعدل  فقيمه الجيندر مياخدهاش
    if(!in_array($gender,['male','female'])){
      $gender_error = 'please choose gender not a text ! <br>';
      $error_s = 1;
      }
  }


  $check_username = " SELECT * FROM `users informations` WHERE username = '$username' ";
// كدا هيشوف في اسم متكرر ولا لا
  $check_result = mysqli_query($conn,$check_username);
  $num_rows = mysqli_num_rows($check_result);
// الجايه يعني لو السطور =0 يعني الاسم مش متكرر ف هيسجل عادي
  if($num_rows != 0){
    $username_error = 'sorry username already exist , try to use another one <br>';
  }


// الجايه عشان لو مكتبش اسم افكره
  if(empty($username)) {
    $username_error = 'please enter your username <br>';
    $error_s = 1;
  } 
// الجايه عشان مخليهوش يكتب اسم اقل من 6 حروف
  elseif(strlen($username) < 6) {
    $username_error = 'your username shold be minimum of 6 litetrs <br>';
    $error_s = 1;
  }
// الجاية عشان اتحقق من نوع القيم
// FILTER_VALIDATE_INT:عشان يتحثث ان اللي كتبه رقم ولا لا
  else if(filter_var($username,FILTER_VALIDATE_INT)){
    $username_error = 'please enter litters not numbers <br>';
    $error_s = 1;
  // لو رقم هيطبعله دي
  }

// الجايه عشان لو مكتبش ايميل افكره
  if(empty($email)) {
    $email_error = 'please insert your email <br>';
    $error_s = 1;
  } 
// الجاية عشان اتحقق من نوع القيم
// FILTER_VALIDATE_INT:عشان يتحثث ان اللي كتبه ايميل ولا لا
  else if(filter_var($email,FILTER_VALIDATE_EMAIL)){
    $email_error = 'please enter a valid email <br>';
  // لو رقم هيطبعله دي
    $error_s = 1;
  }

  if(empty($gender)){
    $gender_error = 'please choose gender <br>';
    $error_s = 1;
  }

  if(empty($birthday)){
    $birthday = 'please insert date of birthday <br>';
    $error_s = 1;
  }

  if(empty($password)){
    $password_error = 'please insert your password <br>';
    $error_s = 1;
  }
  elseif(strlen($password) < 6) {
    $password_error = 'your password shold be minimum of 6 characters <br>';
    $error_s = 1;
    include('register.php');
  }

  else{
    if($error_s == 0 && $num_rows == 0){
      $sql = "INSERT INTO christianity world(username,email,password,gender,birthday,md5_pass) 
      VALUES ('$username','$email','$password','$gender','$birthday','$md5_pass')";
      mysqli_query($conn,$sql);
      header('location:login.php');
    }
    else{
      include('register.php');
    }
    // دا لو متمش رفع البيانات يفضل فنفس الصفحة
  }
}
?>