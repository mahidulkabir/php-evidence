<?php 
// step 1. Here we declare the STUDENT DATA Class.

class StudentDataClass{
    // variable declaration
    private $id;
    private $name;
    private $course;
    private $phone;

    private static $data_file_path = "data.txt";

    // declaring constructors

    function __construct($_id,$name,$_course,$_phone){
        $this->id = $_id;
        $this->name = $name;
        $this->course = $_course;
        $this->phone = $_phone;

    }
  public function save() {
    // Check if file exists and is empty — if so, add a header row first
    if (filesize(self::$data_file_path) == 0) {
        $header = "ID     | Name       | Course     | Phone\n";
        $separator = str_repeat("-", 45) . "\n";
        file_put_contents(self::$data_file_path, $header . $separator, FILE_APPEND);
    }

    // Format each row to fixed width for better alignment
    $line = sprintf("%-6s | %-10s | %-10s | %s\n", $this->id, $this->name, $this->course, $this->phone);
    
    file_put_contents(self::$data_file_path, $line, FILE_APPEND);
}


  public static function display_students(){
	   
	   // Display the student data in an HTML table


$StudentDataClass = file(self::$data_file_path);
echo "<h3>Student List</h3>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr>
        <th>ID</th>
        <th>Name</th>
        <th>Course</th>
        <th>Phone</th>
      </tr>";   
foreach ($StudentDataClass as $student) {
    // list($id, $name, $course, $phone) = explode(",", trim($student));
    echo "<tr>
            <td>$_id</td>
            <td>$name</td>
            <td>$course</td>
            <td>$phone</td>
          </tr>";
}

echo "</table>";
				
		
   } 



};

?>