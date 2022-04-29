<?php
include 'dbconfigur.php';
if (!empty($user_id)) {

    $error = "";
    if (isset($_POST['btnsubmit'])) {
        extract($_POST);
        //upload images
        $current_image = $_FILES['fileimg']['name'];
        //if image upload

        $path = "uploads";
        $time = date("fYhis"); //get time
        $comImagePath = "";

        //upload profile image
        $profile_image = $_FILES['fileimg']['name'];
        if ($profile_image != '') {
            $extension = substr(strrchr($profile_image, '.'), 1); //filethumgimg
            $comImagePath = $path . "/" . $time . "." . $extension;
            $action = copy($_FILES['fileimg']['tmp_name'], $comImagePath);
        }       


        $query = "INSERT INTO notices set title='$title',description='$description',filepath='" . $comImagePath . "',created='" . date('Y-m-d h:i:s') . "'";
        $result = mysql_query($query);
        if ($result) {
            header("location:notice_upload.php?status=success");
        } else {
            $error = "Data has not been saved.";
        }
    }
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $user_id = mysql_real_escape_string($_GET['id']);
        $sql = "DELETE FROM notices WHERE id='" . $user_id . "'";
        $result = mysql_query($sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:notice_upload.php?status=delete");
        } else {
            $error = "Notice has not been deleted.";
        }
    }
    ?>
    <html>
        <head>
            <title>Upload Notice - School  Management System</title>
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
                            <h1 style ="color: #800000;">Upload Notice</h1>
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
                        <form class="form-light mt-20" role="form" method="post" action="notice_upload.php" enctype="multipart/form-data">
                            <?php
                            if (!empty($error)) {
                                echo '<div class="style">' . $error . '</div>';
                            }

                            if (isset($_GET['status']) && $_GET['status'] == "success") {
                                echo '<div class="style">Your notice has been successfuly added.</div>';
                            }

                            if (isset($_GET['status']) && $_GET['status'] == "delete") {
                                echo '<div class="style">Your notice has been successfuly delete.</div>';
                            }
                            ?>     
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" id="title" name="title" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>File</label>
                                        <input type="file" id="fileimg" name="fileimg" />
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" id="description" name="description" style="height:100px;"></textarea>
                            </div>
                            <button type="submit" id="btnsubmit" name="btnsubmit" class="btn btn-one" onclick="return myaccountFormValidation()"/>Update</button><p><br/></p>
                        </form>
                        <table class="table_list">                            
                            <tr>
                                <td class="grid_heading">S.No</td>
                                <td class="grid_heading">Title</td>
                                <td class="grid_heading">Description</td>
                                <td class="grid_heading">Download</td>
                                <td class="grid_heading">Delete</td>
                            </tr>
                            <?php
                            $i = 0;
                            $sql = "SELECT * FROM notices ORDER BY id ASC";
                            $result = mysql_query($sql);
                            if (mysql_num_rows($result) > 0) {
                                while ($row = mysql_fetch_array($result)) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td class="grid_label"><?php echo $i; ?></td>
                                        <td class="grid_label"><?php echo $row['title'] ?></td>
                                        <td class="grid_label"><?php echo $row['description'] ?></td>
                                        <td class="grid_label"><a href="<?php echo $row['filepath'] ?>">Download</a></td>
                                        <td class="grid_label"><a target="_blank" href="notice_upload.php?id=<?php echo $row ['id']; ?>">Delete</a></td>                            
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>                
                    </div>
                </div>       
                <?php
                include 'footer.php';
                ?>               
            </body>
        </html>
        <?php
    }
} else {
    header("location:login.php?msg=login");
    ob_flush();
}
mysql_close();
?>