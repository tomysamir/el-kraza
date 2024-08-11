<?php
session_start();
include('incloude/connect.php');
if(isset($_POST['Username']) && isset($_POST['password'])){
    $username = stripcslashes(strtolower( $_POST['Username']));
    $md5_pass = md5($_POST['password']);
    $username = filter_input(INPUT_POST,'Username');
    $password = stripcslashes(strtolower($_POST['password']));

    $username = htmlentities(mysqli_real_escape_string($conn, $_POST['Username']));
    $password = htmlentities(mysqli_real_escape_string($conn, $_POST['password']));

} 

if(empty($username)) {
    $username_error = 'please enter your username <br>';
    $error_s = 1;
} 

if(empty($password)){
    $password_error = 'please insert your password <br>';
    $error_s = 1;
    include('login.php');
}

if(!isset($error_s)){
    $sql = " SELECT id,username FROM `users informations` WHERE Username='$username' AND $md5_pass ='$md5_pass";
    $result = mysqli_query($conn,$sql);
    // كدا انا اتصلت بقاعدة البيانات
    // طالما اتصلت بيها هيديني اليوزر وال اي دي
    $row = mysqli_fetch_assoc($result);
    // دي هتديني النتيجة من جوا قاعدة البيانات
    if($row['Uusername'] === $username  && $row['password'] === $password){
        $_SESSION['Username'] = $row['Uusername'];
        $_SESSION['id'] = $row['id'];
        // session:عشان لو الباسورد والبوزرنيم صح هبرمج الصفحه اللي بعدها عشان ميكتبهمش تاني فالصفحه التانيه فيتسجل علطول فالداتابيز
        header('location:nextloginpost.php');
        exit();

    }

// $result = [
//     'id' => '1',
//     'Username'=>  'thomas'
// ];
// دا هيبقي شكل اليوزر وال اي دي
// عشان استدعيها لازم اعمل الامر اللي فالسطر31بعدين33
// دي اسمها assoc array
}
