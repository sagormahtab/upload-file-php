<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>File Handling</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
      <style>
          h1{
              color: purple;
          }
          .containingDIV{
              border: 1px solid #261cec;
              margin-top: 50px;
              border-radius: 15px;
          }
      </style>
  </head>
  <body>
    <?php
        include "header.php";
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-offset-1 col-sm-10 containingDIV">
                <h1>Upload File:</h1>
                <?php
                    if(isset($_POST["submit"])){
                        //file details
                        $name = $_FILES["file"]["name"];
                        $type = $_FILES["file"]["type"];
                        $tmp_name = $_FILES["file"]["tmp_name"];
                        $size = $_FILES["file"]["size"];
                        $fileerror = $_FILES["file"]["error"];
                        $permanant_destination = "uploads/".$_FILES["file"]["name"];
                        $errors = "";
                        
                        //error messages to display
                        $noFileToUpload = "<p><strong>Please choose a file!</strong></p>";
                        $fileAlreadyExists = "<p><strong>This file already exists!</strong></p>";
                        $wrongFormat = "<p><strong>Sorry, you can only upload pdf and text files</strong></p>";
                        $fileTooLarge = "<p><strong>Files should be less than 3MB</strong></p>";
                        
                        //allowed formats to upload
                        $allowedFormats = array("pdf"=>"application/pdf","text"=>"text/plain");
                        //check for errors
                        if($fileerror == 4){
                            $errors .= $noFileToUpload;
                        }
                        else{
                            if(file_exists($permanant_destination)){
                            $errors .= $fileAlreadyExists;
                            }
                            if($size > 3*1024*1024){
                                $errors .= $fileTooLarge;
                            }
                            if(!in_array($type,$allowedFormats)){
                                $errors .= $wrongFormat;
                            }
                        }
                        
                        if($errors){
                            $resultMessage = '<div class="alert alert-danger">'.$errors.'</div>';
                            echo $resultMessage;
                        }
                        else{
                            if(move_uploaded_file($tmp_name,$permanant_destination)){
                                $resultMessage = '<div class="alert alert-success">File uploaded successfully</div>';
                                echo $resultMessage;
                            }
                            else{
                                $resultMessage = '<div class="alert alert-warning">Unable to uplaod file. Please try again later.</div>';
                                echo $resultMessage;
                            }
                        }
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        print_r($_FILES);
                        if($_FILES["file"]["error"] > 0){
                            echo "There is an error ".$_FILES["file"]["error"];
                        }
                        else{
                            echo "<p>File name: ".$_FILES["file"]["name"]."</p>";
                            echo "<p>File type: ".$_FILES["file"]["type"]."</p>";
                            echo "<p>File tmp_name: ".$_FILES["file"]["tmp_name"]."</p>";
                            echo "<p>File size: ".$_FILES["file"]["size"]."</p>";
                            echo "<p>File Permanant address: "."uploads/".$_FILES["file"]["name"]."</p>";
                        }
                    }
                ?>
                <form action="helloworld.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                       <label for="file">Choose File:</label>
                        <input type="file" name="file" id="file">
                        <input type="submit" name="submit" id="submit" class="btn btn-lg btn-success" value="Upload">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
        include "footer.php";
    ?>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </body>
</html>