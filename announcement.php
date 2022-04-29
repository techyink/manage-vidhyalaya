<?php
include './dbconfigur.php';
if (!empty($user_id)) {   
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
                        <table class="table_list">                            
                            <tr>
                                <td class="grid_heading">S.No</td>
                                <td class="grid_heading">Title</td>
                                <td class="grid_heading">Description</td>
                                <td class="grid_heading">Date</td>
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