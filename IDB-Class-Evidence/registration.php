<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>LogIn :: Landing Page</title>
</head>

<body>
    <div class="bg-gray-100 flex h-screen items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-5">
            <div class="bg-white shadow-md rounded-md p-6">

                <img class="mx-auto h-12 w-auto" src="https://www.svgrepo.com/show/499664/user-happy.svg" alt="" />

                <h2 class="my-3 text-center text-3xl font-bold tracking-tight text-gray-900">
                    Sign up for an account
                </h2>


                <form class="space-y-6" method="POST" enctype="multipart/form-data">
                    <!-- Full Name  -->
                    <div>
                        <label for="new-password" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <div class="mt-1">
                            <input name="full_name" type="name" required
                                class="px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm" placeholder="Type Here" />
                        </div>
                    </div>

                    <!-- Email Address  -->
                    <div>
                        <label for="new-password" class="block text-sm font-medium text-gray-700">Email Address</label>
                        <div class="mt-1">
                            <input name="email_address" type="email" required
                                class="px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm" placeholder="Type Here" />
                        </div>
                    </div>
                    <!-- user name  -->
                    <div>
                        <label for="new-password" class="block text-sm font-medium text-gray-700">Username</label>
                        <div class="mt-1">
                            <input name="username" type="name" required
                                class="px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm" placeholder="Type Here" />
                        </div>
                    </div>
                    
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1">
                            <input name="password" type="password" autocomplete="password" required
                                class="px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm" placeholder="Type Here" />
                        </div>
                    </div>
                    <!-- confirm password  -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <div class="mt-1">
                            <input name="confirm_password" type="password" autocomplete="password" required
                                class="px-2 py-3 mt-1 block w-full rounded-md border border-gray-300 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-sky-500 sm:text-sm" placeholder="Retype Password" />
                        </div>
                    </div>

                    <div class="space-y-4">
                        <button type="submit"
                            class="flex w-full justify-center rounded-md border border-transparent bg-sky-400 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2" name="btn_reg_submit">Register Account
                        </button>
                        <a href="./index.php" class="flex w-full justify-center rounded-md border border-transparent bg-sky-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-opacity-75 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-2">
                            Go Back To Login Page
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    class LoginForm
    {
        private $fullName;
        private $email;
        private $userName;
        private $password;
        private $confirm_password;
        private $hashedPass;
        
        private static $file_Path_for_userName_password = "reg_userName_Pass.txt";

        function __construct($_fullName, $_email, $_userName, $_password, $_confirm_password)
        {
            $this->fullName = $_fullName;
            $this->email = $_email;
            $this->userName = $_userName;
            $this->password = $_password;
            $this->hashedPass = password_hash($_password, PASSWORD_DEFAULT);
            $this->confirm_password = $_confirm_password;
        }
        public function csv()
        {
            return $this->userName . "," . $this->hashedPass . PHP_EOL;
        }
        public function csv2()
        {
            return $this->fullName . "," . $this->email . "," . $this->userName . PHP_EOL;
        }
        public function saveIdPass()
        {
            file_put_contents("reg_userName_Pass.txt", $this->csv(), FILE_APPEND);
        }

        public function saveUserInfo()
        {
            file_put_contents("reg_user_data.txt", $this->csv2(), FILE_APPEND);
        }
        
    }
    if (isset($_POST["btn_reg_submit"])) {

        $userName = $_POST["username"];
        $fullName = $_POST["full_name"];
        $email = $_POST["email_address"];
        $password = $_POST["password"];
        $confirm_password = $_POST["confirm_password"];
       
        if ($password != $confirm_password) {
            echo "<script>
      alert('retype password dosent match');
      window.stop();
      </script>";
        } elseif (preg_match("/(?=(?:.*\d))(?=(?:.*[A-Z]))(?=(?:.*[a-z]))([a-zA-Z\d]){8,}$/", $password)) {
            $newUser = new LoginForm($fullName, $email, $userName, $password, $confirm_password);
            $newUser->saveIdPass();
            $newUser->saveUserInfo();
            $img = "image/";
            move_uploaded_file("$this->temp_file", "$img.$this->filename");
            echo "<script>
      alert('Registration Successful');
      window.stop();
      </script>";
        } else {

            echo "<script>
      alert('Password must be at least 8 charecter and Contain atleast one Capital, one small and one digit.');
      window.stop();
      </script>";
        }
    }
     if(isset($_POST['btn_reg_submit'])){
        $filename = $_FILES['profile_pic']['name'];
        $temp_path = $_FILES['profile_pic']['tmp_name'];
        $file_size = $_FILES['profile_pic']['size'];
        $file_type = $_FILES['profile_pic']['type'];
        $file_size_to_kb = $file_size/1024;
        $new_path = "image/";
        // 
        $file_type_validator = ["image/png","image/jpg","image/jpeg"];

        if(!in_array($file_type,$file_type_validator)){
            echo "file type not match";
        };
        if($file_size_to_kb<500){
            move_uploaded_file($temp_path,$new_path.$filename);
        };
        // echo $file_type;
    }
    ?>
    ?>
</body>

</html>