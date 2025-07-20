<?php
class FileUploadHandler
{
    protected $filename;
    protected $temp_path;
    protected $file_size;
    protected $file_type;
    protected $upload_folder = "image/";

    protected $allowed_types = ["image/png", "image/jpg", "image/jpeg"];

    public function __construct($file_input)
    {
        $this->filename = $_FILES[$file_input]['name'];
        $this->temp_path = $_FILES[$file_input]['tmp_name'];
        $this->file_size = $_FILES[$file_input]['size'];
        $this->file_type = $_FILES[$file_input]['type'];
    }

    public function isValidFile()
    {
        return in_array($this->file_type, $this->allowed_types) && ($this->file_size / 1024) < 700;
    }

    public function saveFile()
    {
        if ($this->isValidFile()) {
            move_uploaded_file($this->temp_path, $this->upload_folder . $this->filename);
            return true;
        }
        return false;
    }

    public function getFilename()
    {
        return $this->filename;
    }
}
class StudentDataClass extends FileUploadHandler
{
    private $id;
    private $name;
    private $course;
    private $phone;
    private $email;

    private static $data_file_path = "data.txt";

    public function __construct($id, $name, $course, $phone, $email, $file_input)
    {
        parent::__construct($file_input);
        $this->id = $id;
        $this->name = $name;
        $this->course = $course;
        $this->phone = $phone;
        $this->email = $email;
    }

    public function save()
    {
        if ($this->saveFile()) {

            


            $line = sprintf(
                "%-6s | %-10s | %-10s | %s | %s | %s\n",
                $this->id,
                $this->name,
                $this->course,
                $this->phone,
                $this->email,
                $this->getFilename()
            );

            file_put_contents(self::$data_file_path, $line, FILE_APPEND);
        } else {
           echo "<script>alert('Try Again With Correct format(jpg,png,jpeg) and file size(<700kb)');</script>";
        }
    }
    public static function display_students()
    {
       

        echo "<div class='overflow-x-auto rounded-box border border-black bg-base-100 w-1/2 mx-auto my-10 bg-[#320A6B] text-base-300'>";
        echo "<table border='1' cellpadding='5' cellspacing='0' class='table'";
        echo "<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Course</th>
    <th>Phone</th>
    <th>Email</th>
    <th>Profile Pic</th>
    </tr>";

        $lines = file(self::$data_file_path);
        foreach ($lines as $index => $student) {
    
            $fields = explode("|", $student);
            if (count($fields) == 6) {
                $id = trim($fields[0]);
                $name = trim($fields[1]);
                $course = trim($fields[2]);
                $phone = trim($fields[3]);
                $email = trim($fields[4]);
                $filename = trim($fields[5]);

                echo "<tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$course</td>
                    <td>$phone</td>
                    <td>$email</td>
                    <td><img src='image/$filename' width='200px'</td>
                  </tr>";
            }
        }

        echo "</table>";
        echo "</div>";
    }
}

?>