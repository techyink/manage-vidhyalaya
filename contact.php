<?php
include './dbconfigur.php';
if (isset($_POST['btnsubmit'])) {
    $error = "";
    extract($_POST);
    if (empty($name)) {
        $error = "Please enter name.";
    }
    if (empty($email)) {
        $error = "Please enter email.";
    }
    if (empty($phone_no)) {
        $error = "Please enter phone_no.";
    }
    if (empty($subject)) {
        $error = "Please enter subject.";
    }
    if (empty($message)) {
        $error = "Please enter your message.";
    }
    if (empty($error)) {
        $sql_query = "INSERT INTO contact(name,email,phone_no,subject,message,adding_date)"
                . "VALUES('" . $name . "','" . $email . "','" . $phone_no . "','" . $subject . "','" . $message . "','" . date('Y-m-d h:i:s') . "')";
        $result = mysql_query($sql_query);
        if ($result) {
            header("location:contact.php?reg=success");
        } else {
            $error = "Data has not been saved.";
        }
    }
}
?>
<html>
    <head>
        <title>Contact Us - School Management System</title>
        <?php include './title.php'; ?>
         <script type="text/javascript">
            //check for integer
            function checkForIntegers(i)
            {
                if (i.value.length > 0)
                {
                    i.value = i.value.replace(/[^\d]+/g, '');

                }
            }

        </script>
    </head>
    <body >
	
        <?php
        include 'header.php';
        ?>
        <header id="head" class="secondary">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8">
                        <h1 style ="color: #800000;">Contact us</h1>
                    </div>
                </div>
            </div>
        </header>

        <!-- container -->
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="section-title" >Contact us</h3>
                    <form class="form-light mt-20" role="form" method="post" action="contact.php">
                        <?php
                        if (!empty($error)) {
                            echo '<div class="style">' . $error . '</div>';
                        }

                        if (isset($_GET['reg']) && $_GET['reg'] == "success") {
                            echo '<div class="style">Your contact form has been successfuly saved.</div>';
                        }
                        ?> 
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Your name" maxlength="100">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Email address" maxlength="125">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text"id="phone_no" name="phone_no" class="form-control" placeholder="Phone number" maxlength="10"  onkeyup="checkForIntegers(this)" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject" maxlength="500">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control" id="message" name="message" placeholder="Write you message here..." style="height:100px;" maxlength="1000"></textarea>
                        </div>
                        <button type="submit" name="btnsubmit" class="btn btn-two" onClick="return contactFormValidation()" >Send message</button><p><br/></p>
                    </form>
					
                </div>
				
				
				
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="section-title">Address</h3>
                            <div class="contact-info">
                                <h5><b>Address</b></h5>
                                <p>Shyam Lal College, Shahadara Delhi</p>

                                <h5><b>Email</b></h5>
                                <p>amitrikhari9627@gmail.com</p>

                                <h5><b>Phone</b></h5>
                                <p>XXXXXXXXXX</p>
                            </div>
                        </div>
                    </div>                    						
                </div>
            </div>
        </div>       
		
		
        <?php
        include 'footer.php';
        ?>               

    </body>
</html>
