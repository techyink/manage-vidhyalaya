<?php
include 'dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    if (isset($_POST['btnsubmit'])) {
        extract($_POST);
        $query = "update results set obtained_marks='" . $marks . "' where id = '" . $marksid . "'";
        $result = mysql_query($query);
        if ($result) {
            header("location:assignmentlist.php?status=success");
        } else {
            $error = "Data has not been saved.";
        }
    }
    ?>
    <html lang="en">
        <head>
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <meta name="description" content="Learn is a modern and fully responsive."/>        
            <title>Assignment Marks - School  Management System</title>
            <?php include 'title.php'; ?>           
        </head>
        <body>
            <?php include 'header.php'; ?>
            <header id="head" class="secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 style ="color: #800000;">Assignment Marks</h1>
                        </div>
                    </div>
                </div>
            </header>

            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <?php include 'leftmenu.php'; ?>
                    </div>
                    <div class="col-md-9">
                        <h3 class="section-title">&nbsp;</h3>
                        <form class="form-light mt-20" role="form" method="post" action="">
                            <?php
                            if (!empty($error)) {
                                echo '<div class="style">' . $error . '</div>';
                            }
                            ?>   
                            <div class="form-group">
                                <label>Marks</label>
                                <input type="hidden" name="marksid" id="marksid" value="<?php echo $_GET['id'] ?>"/>
                                <input type="number" name="marks" id="marks" class="form-control" required=""/>
                            </div>                         
                            <button type="submit" class="btn btn-two" id="btnsubmit" name="btnsubmit">Submit</button><p><br/></p>
                        </form>                      
                    </div>

                </div>
            </div>
            <?php include 'footer.php'; ?>
        </body>
    </html>
    <?php
} else {
    header("location:login.php?msg=login");
    ob_flush();
}
mysql_close();
?>