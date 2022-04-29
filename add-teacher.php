<?php
include './dbconfigur.php';
if (!empty($user_id)) {

    $error = "";
    if (isset($_POST['btnsubmit'])) {
        $error = "";
        extract($_POST);
        if (empty($name)) {
            $error = "Please enter your name.";
        }
        if (empty($gender)) {
            $error = "Please select your gender.";
        }
        if (empty($email)) {
            $error = "Please enter your email.";
        }
        if (empty($phone_no)) {
            $error = "Please enter your phone_no.";
        }
        if (empty($password)) {
            $error = "Please enter your password.";
        }
        if (empty($error)) {
            $sql_query = "INSERT INTO users(name,email,phone_no,password,adding_date,gender,user_type)"
                    . "VALUES('" . $name . "','" . $email . "','" . $phone_no . "','" . $password . "','" . date('Y-m-d h:i:s') . "','" . $gender . "','teacher')";
            $reesult = mysql_query($sql_query);
            if (mysql_insert_id() > 0) {
                header("location:add-teacher.php?reg=success");
            } else {
                $error = "Data has not been saved.";
            }
        }
    }
    ?>
    <html>
        <head>
            <title>Add Teacher - School  Management System</title>
            <?php include 'title.php'; ?>
            <script type="text/javascript" src="js/validation.js"></script>
        </head>
        <body>
            <?php
            include 'header.php';
            ?>
            <header id="head" class="secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 style ="color: #800000;">Add Teacher</h1>
                        </div>
                    </div>
                </div>
            </header>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="title-box clearfix">&nbsp;<br/><br/></div> 
                        <?php
                        include './leftmenu.php';
                        ?>
                    </div>
                    <div class="col-md-8">
                        <div class="title-box clearfix">&nbsp;<br/><br/></div> 
                        <form class="form-light mt-20" role="form" method="post" action="" id="register-form">
                            <?php
                            if (!empty($error)) {
                                echo '<div class="style">' . $error . '</div>';
                            }
                            if (isset($_GET['reg']) && $_GET['reg'] == "success") {
                                echo '<div class="style">Teacher has been added.</div>';
                            }
                            ?> 
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Your name" maxlength="100">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="">- - - - Select - - - -</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email address"maxlength="125">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" id="phone_no" name="phone_no"class="form-control" placeholder="Phone number"maxlength="10"  onkeyup="checkForIntegers(this)" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password"maxlength="25">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input type="password" id="cnfpassword" name="cnfpassword" class="form-control" placeholder="Confirm Password"maxlength="25">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" id="btnsubmit" name="btnsubmit" class="btn btn-one" onClick="return regFormValidation()">Submit</button><p><br/></p>
                        </form>
                    </div>                
                </div>
            </div>       
            <?php
            include 'footer.php';
            ?>               
        </body>
    </html>
    <?php
} else {
    header("location:login.php?msg=login");
    ob_flush();
}
?>