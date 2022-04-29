<?php
include 'dbconfigur.php';
if (!empty($user_id)) {

    $error = "";
    if (isset($_POST['btnupdate'])) {
        extract($_POST);
        //upload images
        $current_image = $_FILES['fileimg']['name'];
        //if image upload

        $path = "uploads/userspic";
        $time = date("fYhis"); //get time
        $comImagePath = "";

        //upload profile image
        $profile_image = $_FILES['fileimg']['name'];
        if ($profile_image != '') {
            $extension = substr(strrchr($profile_image, '.'), 1); //filethumgimg
            $comImagePath = $path . "/" . $time . "." . $extension;
            $action = copy($_FILES['fileimg']['tmp_name'], $comImagePath);
        }
        if (!empty($comImagePath)) {
            $_SESSION['map_user_image'] = $comImagePath;
        }


      echo  $query = "update users set dob='" . $dob . "', city='$city', state='$state', address='$address', country='$country', pin_no='$pin_no', imgpath='" . $comImagePath . "' where id = '$user_id' ";
        $r = mysql_query($query);
        $num = (int) $r;
        if ($num > 0) {
            $_SESSION['MSG'] = "Your profile has been successfully updated.!!";
        } else {
            $_SESSION['MSG'] = "Your profile has not been updated.!!";
        }
    }
    ?>
    <html>
        <head>
            <title>My Account - School  Management System</title>
            <?php include 'title.php'; ?>
        </head>
        <body>
            <?php
            include 'header.php';
            ?>
            <header id="head" class="secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 style ="color: #800000;">My Account</h1>
                        </div>
                    </div>
                </div>
            </header>
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="title-box clearfix">&nbsp;<br/><br/></div> 
                        <?php
                        include 'leftmenu.php';
                        ?>
                    </div>
                    <div class="col-md-8">
                        <div class="title-box clearfix">&nbsp;<br/><br/></div> 
                        <form class="form-light mt-20" role="form" method="post" action="myaccount.php" enctype="multipart/form-data">
                            <?php
                            $i = 0;
                            $sql = "SELECT * FROM users WHERE id = '" . $user_id . "' ";
                            $result = mysql_query($sql);
                            if (mysql_num_rows($result) > 0) {
                                $row = mysql_fetch_array($result);
                                ?>
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" id="name" name="name" class="form-control" value="<?php echo $row['name']; ?>">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" id="email" name="email" class="form-control" value="<?php echo $row['email']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="text" id="phone_no" name="phone_no" class="form-control" value="<?php echo $row['phone_no']; ?>">
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Gender</label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option selected=""> - - - - - Select - - - - - </option>
                                            <?php
                                            if (strtolower($row['gender']) == "male") {
                                                echo '<option value="Male" selected="">Male</option>';
                                                echo '<option value="Female">Female</option>';
                                            } else {
                                                echo '<option value="Male">Male</option>';
                                                echo '<option value="Female">Female</option>';
                                            }
                                            ?>
                                        </select> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Date of Birth</label>
                                            <input type="text" id="dob" name="dob" class="form-control" value="<?php echo $row['dob']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>City</label>
                                            <input type="text" id="city" name="city" class="form-control" value="<?php echo $row['city']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>State</label>
                                            <input type="text" id="state" name="state" class="form-control" value="<?php echo $row['state']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" id="address" name="address" style="height:100px;"><?php echo $row['address']; ?></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Country</label>
                                            <input type="text" id="country" name="country" class="form-control"value="<?php echo $row['country']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Pin</label>
                                            <input type="text" id="pin_no" name="pin_no" class="form-control" value="<?php echo $row['pin_no']; ?>">
                                        </div>
                                    </div>
                                </div>                                 
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" id="fileimg" name="fileimg">
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (!empty($error)) {
                                    echo '<div class="style">' . $error . '</div>';
                                }
                                if (isset($_GET['status']) && $_GET['status'] == "success") {
                                    echo '<div class="style">Your profile has been successfuly update.</div>';
                                }
                                ?>
                                <button type="submit" id="btnupdate" name="btnupdate" class="btn btn-one" onclick="return myaccountFormValidation()"/>Update</button><p><br/></p>
                                <?php } ?>
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
mysql_close();
?>