<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>LogIn :: Landing Page</title>
</head>
<body>

    <div class="flex h-screen bg-indigo-700">
<div class="w-full max-w-xs m-auto bg-indigo-100 rounded p-5">   
      <header>
        <img class="w-20 mx-auto mb-5" src="https://img.icons8.com/fluent/344/year-of-tiger.png" />
      </header>     
      <form method="POST">
        <div>
          <label class="block mb-2 text-indigo-500" for="username">Username</label>
          <input class="w-full p-2 mb-6 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-300" type="text" name="username">
        </div>
        <div>
          <label class="block mb-2 text-indigo-500" for="password">Password</label>
          <input class="w-full p-2 mb-6 text-indigo-700 border-b-2 border-indigo-500 outline-none focus:bg-gray-300" type="password" name="password">
        </div>
        <div>          
          <input class="w-full bg-indigo-700 hover:bg-pink-700 text-white font-bold py-2 px-4 mb-6 rounded" type="submit" name="login_submit">
        </div>       
      </form>  
      <footer>
        <a class="text-indigo-700 hover:text-pink-700 text-sm float-left" href="#">Forgot Password?</a>
        <a class="text-indigo-700 hover:text-pink-700 text-sm float-right" href="./registration.php">Create Account</a>
      </footer>   
    </div>
</div>
<?php
session_start();
if(isset($_POST["login_submit"])){
  $username =$_POST["username"];
  $password = $_POST["password"];

  $file_read = file("reg_userName_Pass.txt");
  foreach($file_read as $line){
    list($givenUsername,$givenPassword)=explode(",",$line);
    if(trim($givenUsername)==$username && password_verify($password,trim($givenPassword))){
      $_SESSION["session1"]=$username;
      header("location:./homepage.php");
    }else{
      
      echo "<script>
      alert('Username or Password is incorect');
      window.stop();
      </script>";
    }
  }
}


?>
</body>
</html>