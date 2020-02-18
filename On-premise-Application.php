<html> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
        <title>Insert title here</title>
        <link href="css/bootstrap.css" rel = "stylesheet"/>

    </head>
    <style>
        /* Full-width input fields */
        input[type=text], input[type=password] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: green;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        h1 { color: 	
                 #C70039   ;font-family: "Comic Sans MS", cursive, sans-serif;
        }
        .cancelbtn {
            padding: 14px 20px;
            background-color: #DC7633 ;
        }

        .formpage {	 
            left: 50%;
            top: 50%;
            margin-left: -25%;
            position: absolute;
            margin-top: -2%;
        }
    </style>
    <body background="http://cdn.wallpapersafari.com/64/21/2ZPSzq.jpg">

        <div class = "login"><h1> CompanyCloudA.com</h1></div>

        <?php
//		mb_internal_encoding("UTF-8");
        ini_set("display_errors", "1");
        error_reporting(E_ALL);
        include('On-premiseConfig.php');
//		include('image_check.php');
        // getExtension Method
        $msg = '';

        function getExtension($str) {
            $i = strrpos($str, ".");
            if (!$i) {
                return "";
            }

            $l = strlen($str) - $i;
            $ext = substr($str, $i + 1, $l);
            return $ext;
        }

        $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "PNG", "JPG", "JPEG", "GIF", "BMP");
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $tmp = $_FILES['file']['tmp_name'];
            $ext = getExtension($name);
            if (strlen($name) > 0) {
                // File format validation
                if (in_array($ext, $valid_formats)) {
                    // File size validation
                    if ($size < (1024 * 1024)) {
                        $actual_image_name = $name;
                        $keyname = $actual_image_name;
                       /* $hostname = 'localhost';
                        $username = 'root';//enter the username of MYSQL database
                        $password = 'edureka';//enter the password of MYSQL database
                        $dbname = 'Myolddatabase';
                        $usertable = 'tablenew';*/
                        $con = mysqli_connect($hostname, $username, $password) OR DIE('Unable to connect to database! Please try again later.');
                        mysqli_select_db($con, $dbname);
                        $cname = '';
                        $email = '';
                        if (!empty($_POST['name']) && !empty($_POST['name'])) {
                            $cname = $_POST['name'];
                            $email = $_POST['email'];
                        }
                        //echo $email."---".$cname."---".$actual_image_name;exit;
                        $query = "insert into " . $usertable . " values('" . $email . "','" . $cname . "','" . $actual_image_name . "');";
                        //echo $query;exit;//<<--- chnage this
                        mysqli_query($con, $query) or die("Not Updated!");
                        move_uploaded_file($tmp,"images/".$actual_image_name);
                        echo "Image Upload Successful";;
                    } else
                        echo "S3 Upload Failed.";
                } else
                    echo "Invalid file, please upload image file";
            } else
                echo "Invalid file, please upload image file.";
        } else
            echo "Please Select Image File";
        ?>


        <div class ="formpage" >
            <form action="" method='post' enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <td><input type ="text" placeholder="email" name="email" id="email"  class="form-control"/></td>
                        <td><input type="text" placeholder="Name" name="name" id="name" class="form-control"/></td>
                        <!--  <td><input type="text" name="file_location" class="form-control"/></td>-->

                        <td><input type="submit" value="upload image" class="cancelbtn"></td>
                    </tr>
                    <tr><td>
                            <input type="file" name="file">
                        </td></tr>
                </table>
            </form>
        </div>
    </body>
</html>
