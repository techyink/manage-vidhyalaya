<?php
include 'dbconfigur.php';
if (!empty($user_id)) {
    ?>
    <html>
        <head>
            <title>Assignment Result - School  Management System</title>
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
                            <h1 style ="color:#800000;">Assignment Result</h1>
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
                        <?php
                        if (isset($_GET['status']) && $_GET['status'] == "success") {
                            echo '<div class="style">Assignment marks has been successfuly saved..</div>';
                        }
                        ?>                           
                        <table class="table_list">                            
                            <tr>
                                <td class="grid_heading">S.No</td>
                                <td class="grid_heading">User</td>
                                <td class="grid_heading">Assignment</td>
                                <td class="grid_heading">Submited Date</td>                                
                                <td class="grid_heading">Download</td>     
                                <td class="grid_heading">Marks</td>
                                <td class="grid_heading">Obtain&nbsp;Marks</td>
                                <td class="grid_heading">Marks</td>                                
                            </tr>
                            <?php
                            $i = 0;
                            $sql = "SELECT a.title,a.marks,r.id,r.submited_data,r.submited_file,r.obtained_marks,u.name FROM assignments a JOIN results r ON a.id = r.assignment_id JOIN users u ON u.id = r.user_id ORDER BY r.id DESC ";
                            $result = mysql_query($sql);
                            if (mysql_num_rows($result) > 0) {
                                while ($row = mysql_fetch_array($result)) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td class="grid_label"><?php echo $i; ?></td>
                                        <td class="grid_label"><?php echo $row['name'] ?></td>
                                        <td class="grid_label"><?php echo $row['title'] ?></td>
                                        <td class="grid_label"><?php echo $row['submited_data'] ?></td>                                        
                                        <td class="grid_label"><a href="<?php echo $row['submited_file'] ?>">Download</a></td>                                        
                                        <td class="grid_label"><?php echo $row['marks'] ?></td>
                                        <td class="grid_label"><?php echo $row['obtained_marks'] ?></td>
                                        <td class="grid_label"><a href="marks.php?id=<?php echo $row['id'] ?>">Marks</a></td>
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