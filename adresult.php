<?php
include './dbconfigur.php';
if (!empty($user_id)) {
    ?>
    <html>
        <head>
            <title>Top Scorer  - School  Management System</title>
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
                            <h1 style ="color: #800000;">Top Scorer</h1>
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
                                <td class="grid_heading">Top Scorer</td>
                                <td class="grid_heading">Subject</td>
                                <td class="grid_heading">Marks</td>
                                <td class="grid_heading">Date</td>
                            </tr>
                            <?php
                            $i = 0;
                            $sql = "SELECT u.name,r.subjects,r.quiz_date,r.score,r.tot_ques FROM users u JOIN user_result r WHERE u.id = r.user_id ORDER BY r.score DESC LIMIT 5";
                            $result = mysql_query($sql);
                            if (mysql_num_rows($result) > 0) {
                                while ($row = mysql_fetch_array($result)) {
                                    $i++;
                                    ?>
                                    <tr>
                                        <td class="grid_label" align="center"><?php echo $i; ?></td>
                                        <td class="grid_label"><?php echo $row['name'] ?></td>
                                        <td class="grid_label"><?php echo $row['subjects'] ?></td>
                                        <td class="grid_label" align="center"><?php echo $row['score'] ?></td>
                                        <td class="grid_label" align="center"><?php echo $row['quiz_date'] ?></td>

                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td colspan="4">
                                        <?php
                                        $sql_chart = "SELECT u.name,r.subjects,r.quiz_date,r.score,r.tot_ques FROM users u JOIN user_result r WHERE u.id = r.user_id ORDER BY r.score DESC LIMIT 5";
                                        $res_chart = mysql_query($sql_chart);
                                        if (mysql_num_rows($res_chart) > 0) {
                                            include "libchart/classes/libchart.php";
                                            $chart = new PieChart();
                                            $dataSet = new XYDataSet();
                                            while ($row_chart = mysql_fetch_array($res_chart)) {

                                                $perc = ($row_chart['score'] * 100) / ($row_chart['tot_ques']);

                                                $dataSet->addPoint(new Point($row_chart['subjects'], $perc));
                                            }
                                            $chart->setDataSet($dataSet);
                                            $chart->setTitle("www.School  Management Systemmap.com");
                                            $chart->render("images/sturesult.png");
                                            echo '<img alt="Pie chart"  src="images/sturesult.png"/>';
                                        }
                                        ?>

                                    </td>
                                </tr>
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
?>