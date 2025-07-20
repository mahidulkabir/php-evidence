<?php
session_start();
if (!isset($_SESSION["session1"])) {
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student File</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style>
        legend {
            color: aliceblue;
        }
    </style>

</head>


<body class="bg-[#78B9B5] py-8">
    <header class="text-gray-600 body-font mb-10">
  <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
    <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
      </svg>
      <span class="ml-3 text-xl">PHP Table</span>
    </a>
    <nav class="md:ml-auto md:mr-auto flex flex-wrap items-center text-base justify-center">
      <a class="mr-5 hover:text-gray-900">Home</a>
      <a class="mr-5 hover:text-gray-900">About Us</a>
      <a class="mr-5 hover:text-gray-900">Contact</a>
      <a class="mr-5 hover:text-gray-900">Register</a>
    </nav>
    <a href="./logout.php"> <button class="inline-flex items-center bg-gray-100 border-0 py-1 px-3 focus:outline-none hover:bg-gray-200 rounded text-base mt-4 md:mt-0">Logout
      <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
        <path d="M5 12h14M12 5l7 7-7 7"></path>
      </svg>
    </button>
    </a>
  </div>
</header>

<div>


<div>
    <form action="#" method="post" class="w-1/4 mx-auto border-1 rounded-lg px-8 py-4 bg-[#0F828C] mx-auto"
        enctype="multipart/form-data">
        <h3 class="text-center font-semibold text-2xl text-white">Student Form </h3>

        <fieldset class="fieldset">
            <legend class="fieldset-legend">What is your Id?</legend>
            <input type="text" class="input bg-[#065084] text-white" name="txtId" placeholder="Type here" />

        </fieldset>
        <fieldset class="fieldset">
            <legend class="fieldset-legend">What is your Name?</legend>
            <input type="text" class="input bg-[#065084] text-white" name="txtName" placeholder="Type here" />

        </fieldset>
        <fieldset class="fieldset">
            <legend class="fieldset-legend">What is your Course?</legend>
            <input type="text" class="input bg-[#065084] text-white" name="txtCourse" placeholder="Type here" />

        </fieldset>
        </fieldset>
        <fieldset class="fieldset">
            <legend class="fieldset-legend">What is your Phone No?</legend>
            <input type="text" class="input bg-[#065084] text-white" name="txtPhone" placeholder="Type here" />

        </fieldset>
        <fieldset class="fieldset">
            <legend class="fieldset-legend">What is your Email?</legend>
            <input type="text" class="input bg-[#065084] text-white" name="txtEmail" placeholder="Type here" />

        </fieldset>
        <fieldset class="fieldset">
            <legend class="fieldset-legend">Provide Profile Pic</legend>
            <input type="file" class="input bg-[#065084] text-white" name="profile_pic" placeholder="Type here" />

        </fieldset>





        <div class="space-x-5">
            <button class="btn btn-primary btn-sm my-3 mx-4"><input type="submit" name="btnSubmit" value="Submit">
                <button class="btn btn-primary btn-soft btn-sm my-3"> <input type="reset" value="Reset"></button>


        </div>
    </form>
</div>
    
    <?php
    //Step 2:
    require_once("codingFile.php");

    if (isset($_POST["btnSubmit"])) {
        $id = trim($_POST["txtId"]);
        $name = trim($_POST["txtName"]);
        $course = trim($_POST["txtCourse"]);
        $phone = trim($_POST["txtPhone"]);
        $email = trim($_POST["txtEmail"]);

        if (
            preg_match("/^(?:\+88|88)?01[3-9]\d{8}$/", $phone) &&
            preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email) &&
            preg_match("/^\d{5,}$/", $id)
        ) {
            $student = new StudentDataClass($id, $name, $course, $phone, $email, "profile_pic");
            $student->save();
        } else {
            echo "<script>alert('Try Again With Correct Format');</script>";
        }
    }

    ?>
    <div> 

    <?php
    StudentDataClass::display_students();
    ?>
    </div>
    
    
</body>

</html>