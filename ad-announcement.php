<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    //Code for saving subject
    if (isset($_POST['btnsubmit'])) {

        extract($_POST);
        if (empty($title)) {
            $error = "Please enter title.";
        }
        if (empty($description)) {
            $error = "Please enter description.";
        }
        if (empty($error)) {
            $sql_query = "INSERT INTO announcements(title,description,created)"
                    . "VALUES('" . $title . "','" . $description . "','" . date('Y-m-d h:i:s') . "')";
            $result = mysql_query($sql_query);
            if ($result) {
                header("location:ad-announcement.php?status=success");
            } else {
                $error = "Data has not been saved.";
            }
        }
    }
    //Code for deleting subjects
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $user_id = mysql_real_escape_string($_GET['id']);
        $sql = "DELETE FROM announcements WHERE id='" . $user_id . "'";
        $result = mysql_query($sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:ad-announcement.php?status=delete");
        } else {
            $error = "Announcement has not been deleted.";
        }
    }
    ?>
    <html>
        <head>
            <title>Announcement  - School  Management System</title>
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
                            <h1 style ="color: #800000;">Announcement</h1>
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
                        <form action="" method="post">                            
                            <?php
                            if (!empty($error)) {
                                echo '<div class="style">' . $error . '</div>';
                            }

                            if (isset($_GET['status']) && $_GET['status'] == "success") {
                                echo '<div class="style">Announement has been successfuly added.</div>';
                            }

                            if (isset($_GET['status']) && $_GET['status'] == "delete") {
                                echo '<div class="style">Announement has been successfuly delete.</div>';
                            }
                            ?>                                                           
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" id="title" class="form-control"  maxlength="100" required="">
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" id="description" class="form-control"  maxlength="255" required="">
                            </div>
                            <button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-two">Submit</button><p><br/></p>                    
                        </form>
                        <table class="table_list">                            
                            <tr>
                                <td class="grid_heading">S.No</td>
                                <td class="grid_heading">Title</td>
                                <td class="grid_heading">Description</td>
                                <td class="grid_heading">Date</td>
                                <td class="grid_heading">Delete</td>
                            </tr>
                            <?php
                            $i = 0;
                            $sql = "SELECT * FROM announcements ORDER BY id desc";
                            $result = mysql_query($sql);
                            if (mysql_num_rows($result) > 0) {
                                while ($row = mysql_fetch_array($result)) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td class="grid_label"><?php echo $i; ?></td>
                                        <td class="grid_label"><?php echo $row['title'] ?></td>
                                        <td class="grid_label"><?php echo $row['description'] ?></td>
                                        <td class="grid_label"><?php echo $row['created'] ?></td>
                                        <td class="grid_label"><a href="ad-announcement.php?id=<?php echo $row ['id']; ?>">Delete</a></td>                            
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