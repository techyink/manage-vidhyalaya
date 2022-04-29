<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    //Code for saving subject
    if (isset($_POST['btnsubmit'])) {

        extract($_POST);
        if (empty($subject)) {
            $error = "Please enter subject name.";
        }
        if (empty($error)) {
            $sql_query = "INSERT INTO subjects(sname,created)"
                    . "VALUES('" . $subject . "','" . date('Y-m-d h:i:s') . "')";
            $result = mysql_query($sql_query);
            if ($result) {
                header("location:subjects.php?status=success");
            } else {
                $error = "Data has not been saved.";
            }
        }
    }
    //Code for deleting subjects
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $user_id = mysql_real_escape_string($_GET['id']);
        $sql = "DELETE FROM subjects WHERE id='" . $user_id . "'";
        $result = mysql_query($sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:subjects.php?status=delete");
        } else {
            $error = "Subject has not been deleted.";
        }
    }
    ?>
    <html>
        <head>
            <title> Subject  - School  Management System</title>
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
                            <h1 style ="color: #800000;">Subject</h1>
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
                        <form action="subjects.php." method="post">                            
                            <?php
                            if (!empty($error)) {
                                echo '<div class="style">' . $error . '</div>';
                            }

                            if (isset($_GET['status']) && $_GET['status'] == "success") {
                                echo '<div class="style">Your subject has been successfuly added.</div>';
                            }

                            if (isset($_GET['status']) && $_GET['status'] == "delete") {
                                echo '<div class="style">Your subject has been successfuly delete.</div>';
                            }
                            ?>                                                           
                            <div class="form-group">
                                <label>Subject:</label>
                                <input type="text" name="subject" id="subject" class="form-control" placeholder="Your subject" maxlength="100">
                            </div>                                         
                            <button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-two" onclick="return questionFormValidation()" >Submit</button><p><br/></p>                    
                        </form>
                        <table class="table_list">                            
                            <tr>
                                <td class="grid_heading">S.No</td>
                                <td class="grid_heading">SSubject</td>
                                <td class="grid_heading">Delete</td>
                            </tr>
                            <?php
                            $i = 0;
                            $sql = "SELECT * FROM subjects ORDER BY id ASC";
                            $result = mysql_query($sql);
                            if (mysql_num_rows($result) > 0) {
                                while ($row = mysql_fetch_array($result)) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td class="grid_label"><?php echo $i; ?></td>
                                        <td class="grid_label"><?php echo $row['sname'] ?></td>
                                        <td class="grid_label"><a href="subjects.php?id=<?php echo $row ['id']; ?>">Delete</a></td>                            
                                    </tr>
                                    <?php
                                }
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
} else {
    header("location:login.php?msg=login");
    ob_flush();
}
mysql_close();
?>