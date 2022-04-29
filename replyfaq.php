<?php
include 'dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    if (isset($_POST['btnsubmit'])) {
        extract($_POST);
        $query = "update faqs set reply_by='$user_id', reply='$reply' where id = '" . $faqid . "'";
        $result = mysql_query($query);
        if ($result) {
            header("location:faqlist.php?status=success");
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
            <title>Reply Faq - School  Management System</title>
            <?php include 'title.php'; ?>           
        </head>
        <body>
            <?php include 'header.php'; ?>
            <header id="head" class="secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 style ="color: #800000;">Reply Faq</h1>
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
                                <label>Answer</label>
                                <input type="hidden" name="faqid" id="faqid" value="<?php echo $_GET['id'] ?>"/>
                                <input type="text" name="reply" id="reply" class="form-control" required=""/>
                            </div>                         
                            <button type="submit" class="btn btn-two" id="btnsubmit" name="btnsubmit" onclick="return validation()">Submit</button><p><br/></p>
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