<?php
//Step 2:
require_once("codingFile.php");

if (isset($_POST["btnSubmit"])) {

    $id = $_POST["txtId"];
    $name = $_POST["txtName"];
    $course = $_POST["txtCourse"];
    $phone = $_POST["txtPhone"];
    $email = $_POST["txtEmail"];

    if (preg_match("/^(?:\+88|88)?01[3-9]\d{8}$/", $phone) && preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$email))  {

        $student = new StudentDataClass($id, $name, $course, $phone, $email);
        $student->save();
        echo "Success!";
    } else {
        echo "Invalid Phone or Gmail";
    }
}
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Student Form </title>
</head>

<body style="text-align: center;">

    <form action="#" method="post">
        <div>
            ID:<br />
            <input type="text" name="txtId" />
        </div>

        <div>
            Name<br />
            <input type="text" name="txtName" />
        </div>

        <div>
            Course<br />
            <input type="text" name="txtCourse" />
        </div>

        <div>
            Phone<br />
            <input type="text" name="txtPhone" />
        </div>
        <div>
            Email<br />
            <input type="text" name="txtEmail" />
        </div>

        <div>
            <input type="submit" name="btnSubmit" value="Submit" />
        </div>
    </form>
    <?php
    StudentDataClass::display_students();
    ?>
</body>

</html>