<?php require_once 'inc/config.inc.php'; ?>

<?php 
if ($_SESSION['category'] == 'student') {
  $category = "students";
  $column = "student_id";
  $user = fetch_user('students', $column, $_SESSION['user_id']);
  extract($user);
}

if ($_SESSION['category'] == 'staff') {
  $category = "teachers";
  $column = "teachers_id";
  $user = fetch_user('teachers', $column, $_SESSION['user_id']);
  extract($user);
}

if ($_SESSION['category'] == 'admin') {
  $category = "administrators";
  $column = "admin_id";
  $user = fetch_user('administrators', $column, $_SESSION['user_id']);
  extract($user);
}
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Slim">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/slim/img/slim-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/slim">
    <meta property="og:title" content="Slim">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/slim/img/slim-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title><?php if (isset($_SESSION['category'])) {
      echo(ucfirst($_SESSION['category']));
    } ?> Dashboard</title>

    <!-- vendor css -->
    <link href="lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="lib/rickshaw/css/rickshaw.min.css" rel="stylesheet">
    <link href="/lib/datatables/css/jquery.dataTables.css" rel="stylesheet">
    <link href="/lib/select2/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <link rel="icon" href="../images/logo_name2.png">
    <link rel="stylesheet" type="text/css" href="css/sweetalert2.min.css">
    <link href="css/special_action_confirm_style.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="js/sweetalert2.all.min.js"></script>
    <script src="js/slim.js"></script>
    
    <!-- <link rel="stylesheet" type="text/css" href="css/result2.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="css/result1.css"> -->
    
    <script src="lib/jquery/js/jquery.js"></script>

    <!-- Slim CSS -->
    <link rel="stylesheet" href="css/slim.css">
    

  </head>
  <body class="dashboard-3">
    <div class="slim-header">
      <div class="container">
        <div class="slim-header-left">
          <h2 class="slim-logo"><a href="index.php">EBSU<span>.</span></a></h2>
        </div><!-- slim-header-left -->

        <div class="slim-header-right">
          <div class="dropdown dropdown-c">
            <a href="#" class="logged-user" data-toggle="dropdown">
              <img src="<?php if(isset($profile_img_path)){
                echo "$profile_img_path";
              }else{
                echo "http://via.placeholder.com/500x500";
              } ?>" alt="">
              <span><?php echo ucfirst($firstname); ?></span>
              <i class="fa fa-angle-down"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <nav class="nav">
                <a href="profile.php?user_id=<?php echo $_SESSION['user_id']; ?>&category=<?php echo( $category); ?>" class="nav-link"><i class="icon ion-person"></i> View Profile</a>
                <a href="change_password.php" class="nav-link"><i class="icon ion-person"></i>Change Pasword</a>
                <!-- <a href="profile.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="nav-link"><i class="icon ion-compose"></i> Edit Profile</a> -->
                <?php if($_SESSION['category'] == "admin"){ ?>
                  <a href="mail_visitors.php" class="nav-link"><i class="icon ion-ios-email-outline"></i>Mail visitors</a>
                <?php } ?>
                <?php if($_SESSION['category'] == "admin"){ ?>
                  
                  <?php if($admin_rank === 'first'){ ?>
                    <a href="all-operations.php" class="nav-link"><i class="icon ion-ios-gear-outline"></i>All Operations</a>
                    <a href="fetch_all_students_pin.php" class="nav-link"><i class="icon ion-ios-gear-outline"></i>All Students pin</a>
                    <a href="pin-generation.php" class="nav-link"><i class="icon ion-ios-gear-outline"></i>Pin Generation</a>
                  <?php } ?>
                  
                <?php } ?>
                <a href="signout.php" class="nav-link"><i class="icon ion-forward"></i> Sign Out</a>
              </nav>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </div><!-- header-right -->
      </div><!-- container -->
    </div><!-- slim-header -->

    <div class="slim-navbar">
      <div class="container">
        <ul class="nav">
          <?php if ($_SESSION['category'] == "admin"): ?>
           
          <?php endif ?>
           <li class="nav-item <?php if($pageTitle === "Dashboard"){
            echo "active";
           } ?>">
              <a class="nav-link" href="dashboard.php">
                <i class="icon ion-ios-home-outline"></i>
                <span>Dashboard</span>
              </a>
              <!-- <div class="sub-item">
                <ul>
                  <li><a href="index.html">Dashboard 01</a></li>
                </ul>
              </div> -->
              <!-- sub-item -->
           </li>
          
          <li class="nav-item <?php if($pageTitle === "Profile" or $pageTitle === "edit-profile"){
        echo "active";
         } ?>">
            <a class="nav-link" href="profile.php?user_id=<?php echo $_SESSION['user_id']; ?>&category=<?php echo( $category); ?>">
            <i class="icon ion-person"></i>
            <span>Profile</span>
          </a>
            <!-- <div class="sub-item">
              <ul>
                <li><a href="profile.php?user_id=<?php echo $_SESSION['user_id']; ?>&category=<?php echo( $category); ?>">View Profile</a></li>
                <!-- <li><a href="edit-profile.php?user_id=<?php echo $_SESSION['user_id']; ?>&category=<?php echo( $category); ?>">Edit Profile</a></li> 
              </ul>
            </div> -->
            <!-- dropdown-menu -->
          </li>
         
          
          <?php if ($_SESSION['category'] == "student"): ?>
            <li class="nav-item  <?php if($pageTitle === "Enter Pin" or $pageTitle === "Enter Result Details" ){
              echo "active";
              } ?>">
              <a class="nav-link" href="enter_pin.php">
              <i class="icon ion-ios-book-outline"></i>
              <span>Result</span>
            </a>
            <!-- <div class="sub-item">
              <ul>
                <li class="sub-with-sub">
                  <a href="#">Pricing</a>
                  <ul>
                    <li><a href="page-pricing.html">FIRST TERM</a></li>
                    <li><a href="page-pricing2.html">SECOND TERM</a></li>
                    <li><a href="page-pricing3.html">THIRD TERM</a></li>
                  </ul>
                </li>
              </ul>
            </div> -->
            <!-- dropdown-menu -->
          </li>
          <?php endif ?>

         <?php if ($_SESSION['category'] == "admin"): ?>
            <li class="nav-item <?php if($pageTitle === "Creat Class" or $pageTitle === "Update Class Portal Fees Payment Status" or $pageTitle === "Update Class School Fees Payment Status" or $pageTitle === "Update Class" or $pageTitle === "Delete Class" or $pageTitle === "Update Term" or $pageTitle === "Academic Year Update" or $pageTitle === "Class Result Ready State"  or $pageTitle === "Fee confirmation reset" or $pageTitle === "Select Students"){
              echo "active";
              } ?> with-sub">
              <a class="nav-link" href="#" data-toggle="dropdown">
                <i  style="display: inline-block; margin-left: 15px" class="icon ion-ios-gear-outline"></i>
                <span>Manage classes</span>
              </a>
              <div class="sub-item">
                <ul>
                  <li><a href="add_class.php">Creat class</a></li>
                  <li><a href="update-class.php">Update class</a></li>
                  <!-- <li><a href="delete-class.php">Delete class</a></li> -->
                  <li><a href="update-term.php">Update Term</a></li>
                  <li><a href="class_ready_state.php">Class ready state</a></li>
                  <li><a href="academic-year.php">A/D Academic Year</a></li>
                   <li class="sub-with-sub">
                  <a href="#">Fee confirmation reset</a>
                  <ul>
                    <li><a href="fee_reset.php">School Fee Reset</a></li>
                    <li><a href="fee_reset2.php">Portal fee Reset</a></li>
                  </ul>
                </ul>
              </div><!-- dropdown-menu -->
          </li>
          <?php endif ?>
            

          <?php if ($_SESSION['category'] == "admin"): ?>
            <li class="nav-item <?php if($pageTitle === "Add Admin" or $pageTitle === "Add Student" or $pageTitle === "Add Teacher" or $pageTitle === "Manage Students in a class" or $pageTitle === "Manage Admin" or $pageTitle === "Manage Student" or $pageTitle === "Manage Teacher" or $pageTitle === "Update Students" or $pageTitle === "Edit Student" or $pageTitle === "Edit Teacher" or $pageTitle === "Edit Admin" or $pageTitle === "Verify Student" or $pageTitle === "Verify Teacher" or $pageTitle === "Verify Admin"){
              echo "active";
            } ?> with-sub">
            <a class="nav-link" href="#" data-toggle="dropdown">
              <i style="display: inline-block; margin-left: 15px" class="icon ion-ios-gear-outline"></i>
              <span>Manage Users</span>
            </a>
            <div class="sub-item">
              <ul>
                <li><a href="add-student.php">Add Student</a></li>
                <li><a href="add-teacher.php">Add Teacher</a></li>
                <li><a href="add-admin.php">Add Admin</a></li>
                <li><a href="students-classes.php">Student's Classes</a></li>
                <li><a href="manage-students.php">Manage students</a></li>
                <li><a href="manage-teachers.php">Manage teachers</a></li>
                <li><a href="manage-admin.php">Manage Admins</a></li>
                <li><a href="verify_student.php">Verify Students Pin Pay</a></li>
                <li><a href="verify_teacher.php">Verify Teachers</a></li>
                <li><a href="verify_admin.php">Verify Admins</a></li>
              </ul>
            </div><!-- dropdown-menu -->
          </li>
          <?php endif ?>
            

          <?php if ($_SESSION['category'] == "admin"): ?>
            <li class="nav-item <?php if($pageTitle === "Creat Subject" or $pageTitle === "Delete Subject" or $pageTitle === "Update Subject"){
            echo "active";
           } ?> with-sub">
            <a class="nav-link" href="#" data-toggle="dropdown">
              <i class="icon ion-ios-book-outline"></i>
              <span>Subjects</span>
            </a>
            <div class="sub-item">
              <ul>
                <li><a href="add_subject.php">Creat Subject</a></li>
                <li><a href="update-subject.php">Update Subject</a></li>
                <!-- <li><a href="delete-subject.php">Delete Subject</a></li> -->
              </ul>
            </div><!-- dropdown-menu -->
          </li>

          <?php endif ?>
           
          <?php if ($_SESSION['category'] == "staff"): ?>
            <?php $teacher = fetch_column4('teachers_id', 'teachers', $_SESSION['user_id']);
                extract($teacher);
                 ?>
                 <?php if ($subject_teaching_classes !== null or $subject_teaching !== null or $form_class !== "NONE" or $_SESSION['category'] == "admin"): ?>
                   <li class="nav-item <?php if($pageTitle === "Result Fetch" or $pageTitle === "Select Students" or $pageTitle === "Form Teacher's Comment" ){
                        echo "active";
                      } ?> with-sub">
                      <a class="nav-link" href="#" data-toggle="dropdown">
                        <i class="icon ion-ios-book-outline"></i>
                        <span>Result</span>
                      </a>
                      <div class="sub-item">
                        <ul>
                          <?php if ($subject_teaching_classes !== null and $subject_teaching !== null): ?>
                            <li><a href="result_fetch.php">Fetch Result Sheet</a></li>
                          <?php endif ?>

                          <?php if ($form_class !== "NONE"): ?>
                            <li><a href="result_comment.php">Comment form students results</a></li>
                          <?php endif ?>

                                                
                        </ul>
                      </div><!-- dropdown-menu -->
                    </li>

                 <?php endif ?>
          <?php endif ?>


          <?php if ($_SESSION['category'] == "admin"): ?>
            
                   <li class="nav-item <?php if($pageTitle === "Result Fetch"  or $pageTitle === "Pricipal's Comment"){
                        echo "active";
                      } ?> with-sub">
                      <a class="nav-link" href="#" data-toggle="dropdown">
                        <i class="icon ion-ios-book-outline"></i>
                        <span>Result</span>
                      </a>
                      <div class="sub-item">
                        <ul>
                            <li><a href="result_fetch_admin.php">Fetch result</a></li>
                            <li><a href="principals_comment.php">Pricipal's comment</a></li>
                        </ul>
                      </div><!-- dropdown-menu -->
                    </li>

          <?php endif ?>

          
          

          <?php if ($_SESSION['category'] == "admin"): ?>
            <li class="nav-item <?php if($pageTitle === "Creat Event" or $pageTitle === "Update Event" or $pageTitle === "Delete Event"){
            echo "active";
          } ?> with-sub">
            <a class="nav-link" href="#" data-toggle="dropdown">
              <i class="icon ion-ios-filing-outline"></i>
              <span>Events</span>
            </a>
            <div class="sub-item">
              <ul>
                <li><a href="add-event.php">Creat Event</a></li>
                <li><a href="update-event.php">Update Event</a></li>
                <li><a href="delete-event.php">Delete Event</a></li>
              </ul>
            </div><!-- dropdown-menu -->
          </li>
          <?php endif ?>
          
        </ul>
      </div><!-- container -->
    </div><!-- slim-navbar -->

    <div class="slim-mainpanel">
      <div class="container">
        <div class="slim-pageheader">
          <ol class="breadcrumb slim-breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php if (isset($pageTitle)) {
              echo ucfirst($pageTitle);
            } ?></li>
          </ol>
          <h6 class="slim-pagetitle">Welcome back, <?php echo ucfirst($firstname); ?></h6>
        </div><!-- slim-pageheader -->
