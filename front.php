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

    <form action="#" method="post" class="w-1/4 mx-auto border-1 rounded-lg px-8 py-4 bg-[#0F828C]" enctype="multipart/form-data">
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





        <div>
            <button class="btn btn-primary btn-sm my-3 mx-4"><input type="submit" name="btnSubmit" value="Submit">
                <button class="btn btn-primary btn-soft btn-sm my-3"> <input type="reset" value="Reset"></button>

        </div>
    </form>
    <?php
    //Step 2:
    require_once("codingFile.php");

    if (isset($_POST["btnSubmit"])) {
        $name = $_POST["txtName"];
        $course = $_POST["txtCourse"];
        $id = trim($_POST["txtId"]);
        $phone = trim($_POST["txtPhone"]);
        $email = trim($_POST["txtEmail"]);
        $filename = $_FILES['profile_pic']['name'];
        $temp_path = $_FILES['profile_pic']['tmp_name'];
        $file_size = $_FILES['profile_pic']['size'];
        $file_type = $_FILES['profile_pic']['type'];
        $file_size_to_kb = $file_size / 1024;
        $new_path = "image/";
        // 
        $file_type_validator = ["image/png", "image/jpg", "image/jpeg"];

        if (!in_array($file_type, $file_type_validator)) {
            echo "file type not match";
        };
        if ($file_size_to_kb < 1000) {
            move_uploaded_file($temp_path, $new_path . $filename);
        };

        if (preg_match("/^(?:\+88|88)?01[3-9]\d{8}$/", $phone) && preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email) && preg_match("/^\d{5,}$/", $id)) {
            $student = new StudentDataClass($id, $name, $course, $phone, $email, $filename);
            $student->save();
        } else {
            echo "<script>
      alert('Try Again With Correct Format');
    
      </script>";
        }
    }
    ?>
    <?php
    StudentDataClass::display_students();
    ?>
</body>

</html>