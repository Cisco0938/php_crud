<?php

require_once "config.php";
 

$fname =$lname = $reg = $email = $course = $year = "";
$fname_err = $lname_err = $reg_err = $email_err = $course_err = $year_err  = "";
 

if($_SERVER["REQUEST_METHOD"] == "POST"){
   
    $input_fname = trim($_POST["fname"]);
    if(empty($input_fname)){
        $fname_err = "Please enter a first name.";
    } 
    else{
        $fname = $input_fname;
    }
    
    
    $input_lname = trim($_POST["lname"]);
    if(empty($input_lname)){
        $lname_err = "Please enter last name.";     
    } else{
        $lname = $input_lname;
    }
    
    $input_reg = trim($_POST["reg"]);
    if(empty($input_reg)){
        $reg_err = "Please enter reg.";     
    } else{
        $reg = $input_reg;
    }

    $input_email = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Please enter an email.";     
    } else{
        $email = $input_email;
    }

    $input_course = trim($_POST["course"]);
    if(empty($input_course)){
        $course_err = "Please enter student course.";     
    } else{
        $course = $input_course;
    }

    $input_year = trim($_POST["year"]);
    if(empty($input_year)){
        $year_err = "Please enter year.";     
    } else{
        $year = $input_year;
    }
    
    
    if(empty($fname_err) && empty($lname_err) && empty($reg_err) && empty($email_err) && empty($course_err) && empty($year_err)){
        
        $sql = "INSERT INTO student (fname, lname, reg, email, course, year) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
           
            mysqli_stmt_bind_param($stmt, "ssssss", $param_fname, $param_lname, $param_reg, $param_email, $param_course, $param_year);
            
            
            $param_fname = $fname;
            $param_lname = $lname;
            $param_reg = $reg;
            $param_email = $email;
            $param_course = $course;
            $param_year = $year;
            
            
            if(mysqli_stmt_execute($stmt)){
              
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        
        mysqli_stmt_close($stmt);
    }
    
   
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>student record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Student Record</h2>
                    <p>Please fill this form and submit to add student record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Firt Name</label>
                            <input type="text" name="fname" class="form-control <?php echo (!empty($fname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fname; ?>">
                            <span class="invalid-feedback"><?php echo $fname_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control <?php echo (!empty($lname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lname; ?>">
                            <span class="invalid-feedback"><?php echo $lname_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Registration</label>
                            <textarea name="reg" class="form-control <?php echo (!empty($reg_err)) ? 'is-invalid' : ''; ?>"><?php echo $reg; ?></textarea>
                            <span class="invalid-feedback"><?php echo $reg_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Course</label>
                            <input type="text" name="course" class="form-control <?php echo (!empty($course_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $course; ?>">
                            <span class="invalid-feedback"><?php echo $course_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Year</label>
                            <input type="text" name="year" class="form-control <?php echo (!empty($year_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $year; ?>">
                            <span class="invalid-feedback"><?php echo $year_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>