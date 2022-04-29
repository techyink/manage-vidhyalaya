<?php
include 'dbconfigur.php';
if (!empty($user_id)) {
    $error = "";
    if (isset($_POST['btnsubmit'])) {
        extract($_POST);
        echo $query = "INSERT INTO faqs set user_id='$user_id', faq='$faq',created='" . date('Y-m-d h:i:s') . "'";
        $result = mysql_query($query);
        if ($result) {
            header("location:faq.php?status=success");
        } else {
            $error = "Data has not been saved.";
        }
    }
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $id = mysql_real_escape_string($_GET['id']);
        $sql = "DELETE FROM faqs WHERE id='" . $id . "'";
        $result = mysql_query($sql);
        $valueInsert = (int) $result;
        if ($valueInsert > 0) {
            header("location:faqlist.php?status=delete");
        } else {
            $error = "Faq has not been deleted.";
        }
    }
    ?>
    <html lang="en">
        <head>
            <meta charset="utf-8"/>
            <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
            <meta name="description" content="Learn is a modern and fully responsive."/>        
            <title>FAQs List - School  Management System</title>
            <?php include 'title.php'; ?>            
        </head>
        <body>
            <?php include 'header.php'; ?>
            <header id="head" class="secondary">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8">
                            <h1 style ="color: #800000;">FAQs List</h1>
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
                        <table class="table_list">   
                            <?php
                            if (!empty($error)) {
                                echo '<div class="style">' . $error . '</div>';
                            }

                            if (isset($_GET['status']) && $_GET['status'] == "success") {
                                echo '<div class="style">Faq has been replyed.</div>';
                            }
                            if (isset($_GET['status']) && $_GET['status'] == "delete") {
                                echo '<div class="style">Faq has been successfuly delete.</div>';
                            }
                            ?> 
                            <tr>
                                <td class="grid_heading">S.No</td>
                                <td class="grid_heading">Question</td>
                                <td class="grid_heading">Answer</td>
                                <td class="grid_heading">Reply By</td>
                                <td class="grid_heading">Date</td>
                                <td class="grid_heading">Delete</td>
                                <td class="grid_heading">Reply</td>
                            </tr>
                            <?php
                            $i = 0;
                            $sql = "SELECT f.id,f.faq,f.reply,f.reply_by,f.created,u.name FROM faqs f LEFT JOIN users u ON f.reply_by = u.id ORDER BY f.id DESC ";
                            $result = mysql_query($sql);
                            if (mysql_num_rows($result) > 0) {
                                while ($row = mysql_fetch_array($result)) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td class="grid_label"><?php echo $i; ?></td>
                                        <td class="grid_label"><?php echo $row['faq'] ?></td>
                                        <td class="grid_label"><?php echo $row['reply'] ?></td>
                                        <td class="grid_label"><?php echo $row['name'] ?></td>
                                        <td class="grid_label"><?php echo $row['created'] ?></td>
                                        <td class="grid_label"><a href="faq.php?id=<?php echo $row ['id']; ?>">Delete</a></td>
                                        <td class="grid_label"><a href="replyfaq.php?id=<?php echo $row ['id']; ?>">Reply</a></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                        </div>

                    </div>
                </div>
                <?php include 'footer.php'; ?>
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