<?php
// step 1. Here we declare the STUDENT DATA Class.

class StudentDataClass
{
  // variable declaration
  private $id;
  private $name;
  private $course;
  private $phone;
  private $email;
  private $filename;

  private static $data_file_path = "data.txt";
  // declaring constructor
  function __construct($_id, $name, $_course, $_phone, $_email,$_filename)
  {
    $this->id = $_id;
    $this->name = $name;
    $this->course = $_course;
    $this->phone = $_phone;
    $this->email = $_email;
    $this->filename = $_filename;

  }
  public function save()
  {
    // Check if file exists and is empty — if so, add a header row first
    if (filesize(self::$data_file_path) == 0) {
      $header = "ID     | Name       | Course     | Phone     | Email | ImageFile \n";
      $separator = str_repeat("-", 45) . "\n";
      file_put_contents(self::$data_file_path, $header . $separator, FILE_APPEND);
    }

    // Format each row to fixed width for better alignment
    $line = sprintf("%-6s | %-10s | %-10s | %s | %s | %s\n", $this->id, $this->name, $this->course, $this->phone,$this->email,$this->filename);

    file_put_contents(self::$data_file_path, $line, FILE_APPEND);
    
  }


  public static function display_students()
  {
    // Read the file contents into an array
    
    echo "<div class='overflow-x-auto rounded-box border border-black bg-base-100 w-1/2 mx-auto my-10 bg-[#320A6B] text-base-300'>";
    echo "<table border='1' cellpadding='5' cellspacing='0' class='table'";
    echo "<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Course</th>
    <th>Phone</th>
    <th>Email</th>
    </tr>";
    
    $lines = file(self::$data_file_path);
    foreach ($lines as $index => $student) {
      // Skip header and separator lines
      if ($index < 2)
        continue;

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
    echo"</div>";
  }



}
;

?>