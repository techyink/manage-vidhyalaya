<div class="list styled custom-list" style="min-height: 400px;border-right: solid 1px #ccc;">
    <div style="margin-left: 10px;margin-bottom: 10px;text-align: center;">

    </div>
    <ul>

        <?php
        if ($user_type == "admin") {
            ?> 
            <li><a href="add-teacher.php">Add Teacher</a></li>
            <li><a href="teacherlist.php">Teacher List</a></li>
            <li><a href="student_list.php">Student List</a></li>
            <li><a href="contact_list.php">Contact List</a></li>
            <li><a href="subjects.php">Subject</a></li>
            <li><a href="ad-announcement.php">Announcment</a></li>
            <li><a href="notice_upload.php">Notice</a></li>
            <li><a href="uploaassignment.php">Upload Assignment</a></li>
            <li><a href="assignmentlist.php">Assignment Marks</a></li>
            <li><a href="faqlist.php">Faq List</a></li>
            <?php
        } else if ($user_type == "teacher") {
            ?>
            <li><a href="myaccount.php">My Account</a></li>
            <li><a href="student_list.php">Student List</a></li>
            <li><a href="contact_list.php">Contact List</a></li>
            <li><a href="subjects.php">Subject</a></li>
            <li><a href="ad-announcement.php">Announcment</a></li>
            <li><a href="notice_upload.php">Notice</a></li>
            <li><a href="uploaassignment.php">Upload Assignment</a></li>
            <li><a href="assignmentlist.php">Assignment Marks</a></li>
            <li><a href="faqlist.php">Faq List</a></li>
            <?php
        } else if ($user_type == "student") {
            ?>
            <li><a href="myaccount.php">My Account</a></li>
            <li><a href="announcement.php">Announcment</a></li>
            <li><a href="notices.php">Notice</a></li>
            <li><a href="download_assigment.php">Download Assignment</a></li>
            <li><a href="stu-upload-assignement.php">Upload Assignment</a></li>
            <li><a href="faq.php">Faq</a></li>
        <?php } ?>
        <li><a href="changepassword.php">Change Password</a></li>
    </ul>
</div>