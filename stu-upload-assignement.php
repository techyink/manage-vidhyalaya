<?php
include 'dbconfigur.php';
if (!empty($user_id)) {

    $error = "";
    if (isset($_POST['btnupdate'])) {
        extract($_POST);
        //upload images
        $current_image = $_FILES['fileimg']['name'];
        //if image upload

        $path = "uploads";
        $time = date("fYhis"); //get time
        $comFilePath = "";

        //upload profile image
        $profile_image = $_FILES['datafile']['name'];
        if ($profile_image != '') {
            $extension = substr(strrchr($profile_image, '.'), 1); //filethumgimg
            $comFilePath = $path . "/" . $time . "." . $extension;
            $action = copy($_FILES['datafile']['tmp_name'], $comFilePath);
        }


        echo $query = "INSERT INTO results set assignment_id ='$assignment',submited_data='$submited_data',submited_file='$comFilePath',upload_date='" . date('Y-m-d h:i:s') . "', user_id = '" . $user_id . "'";
        $result = mysql_query($query);
        if ($result) {
            header("location:stu-upload-assignement.php?status=success");
        } else {
            $error = "Data has not been saved.";
        }
    }
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $user_id = mysql_real_escape_string($_GET['id']);
        $sql = "DELETE FROM assignments WHERE id='" . $user_id . "'";
        $result = mysql_query($sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:uploaassignment.php?status=delete");
        } else {
            $error = "Assignments has not been deleted.";
        }
    }
    ?>
    <html>
        <head>
            <title>Upload Assignment - School  Management System</title>
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
                            <h1 style ="color: #800000;">Upload Assignment</h1>
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
                        <form class="form-light mt-20" role="form" method="post" action="" enctype="multipart/form-data">
                            <?php
                            if (!empty($error)) {
                                echo '<div class="style">' . $error . '</div>';
                            }

                            if (isset($_GET['status']) && $_GET['status'] == "success") {
                                echo '<div class="style">Your assignment has been successfuly uploaded.</div>';
                            }
                            ?>  
                            <div class="row">                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Assignment</label>
                                        <select id="assignment" name="assignment" class="form-control" required="">
                                            <option value="" selected=""> - - - - Select - - - - </option>
                                            <?php
                                            $sql = "SELECT id,title FROM assignments ORDER BY id DESC";
                                            $result = mysql_query($sql);
                                            if (mysql_num_rows($result) > 0) {
                                                while ($row = mysql_fetch_array($result)) {
                                                    ?>
                                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['title'] ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" id="submited_data" name="submited_data" style="height:100px;" required=""></textarea>
                            </div>
                            <div class="row">                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>File</label>
                                        <input type="file" id="datafile" name="datafile" required=""/>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="btnupdate" name="btnupdate" class="btn btn-one"/>Submit</button><p><br/></p>
                        </form>
                        <table class="table_list">                            
                            <tr>
                                <td class="grid_heading">S.No</td>
                                <td class="grid_heading">Assignment</td>
                                <td class="grid_heading">Submited Date</td>
                                <td class="grid_heading">Marks</td>
                                <td class="grid_heading">Obtain&nbsp;Marks</td>                                
                                <td class="grid_heading">Download</td>                                
                            </tr>
                            <?php
                            $i = 0;
                            $sql = "SELECT a.title,a.marks,r.submited_data,r.submited_file,r.obtained_marks FROM assignments a JOIN results r ON a.id = r.assignment_id AND r.user_id = '" . $user_id . "' order by r.id desc";
                            $result = mysql_query($sql);
                            if (mysql_num_rows($result) > 0) {
                                while ($row = mysql_fetch_array($result)) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td class="grid_label"><?php echo $i; ?></td>
                                        <td class="grid_label"><?php echo $row['marks'] ?></td>
                                        <td class="grid_label"><?php echo $row['obtained_marks'] ?></td>
                                        <td class="grid_label"><?php echo $row['title'] ?></td>
                                        <td class="grid_label"><?php echo $row['submited_data'] ?></td>                                        
                                        <td class="grid_label"><a href="<?php echo $row['submited_file'] ?>">Download</a></td>                                        
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