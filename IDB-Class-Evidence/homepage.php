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
    <?php
    StudentDataClass::display_students();
    ?>
    <a href="logout.php"><button class="btn btn-danger btn-sm">Logout</button></a>
</body>

</html>