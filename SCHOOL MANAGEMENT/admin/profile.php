<?php 
$pageTitle = "Profile";

require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

require_once 'inc/page-header.inc.php'; 
?>

<?php 
if (!isset($_GET['user_id']) and !isset($_GET['category'])) {
  redirect_to('dashboard.php');
}else{
  $user_id = $_GET['user_id'];
  
  if($_GET['category'] === 'students' or $_GET['category'] === 'teachers' or $_GET['category'] === 'administrators' ){
    $category = $_GET['category'];
  }else{
    redirect_to('dashboard.php');
  }
  

  if ($category == "administrators") {
    $user = fetch_user('administrators', 'admin_id', $user_id);
    if($user){
      extract($user); 
    }else{
      redirect_to('dashboard.php');
    }
    $user_id = $admin_id;
  }

  if ($category == "teachers") {
    $user = fetch_user('teachers', 'teachers_id', $user_id);
    if($user){
      extract($user);
    }else{
      redirect_to('dashboard.php');
    }
    $user_id = $teachers_id;
  }

  if ($category == "students") {
    $user = fetch_user('students', 'student_id', $user_id);
    if($user){
      extract($user);
    }else{
      redirect_to('dashboard.php');
    }
    $user_id = $student_id;
  }

  if ($_SESSION['category'] !== 'admin') {

    if($_SESSION['category'] === 'staff' ){
      $current_cat = 'staff';
    }

    if($_SESSION['category'] === 'student' ){
      $current_cat = 'student';
    }

    if(($_SESSION['user_id'] !== $_GET['user_id']) or ($_SESSION['category'] !== $current_cat)){
      redirect_to('dashboard.php');
    }
  }
}
?>
        <div class="row row-sm">
          <div class="col-lg-8">
            <div class="card card-profile">
              <div class="card-body">
                <div class="media">
                  <img style="background: url(<?php echo $profile_img_path; ?>); background-size: cover; width: 150px; height: 150px; border-radius: 100%; background-position-x: 57.667%" src="<?php if(isset($profile_img_path)){
                    echo "$profile_img_path";
                    }else{
                      echo "http://via.placeholder.com/500x500";
                    } ?>" alt="">
                  <div class="media-body">
                    <h3 class="card-profile-name"><?php echo ucfirst($firstname) ." ". ucfirst($lastname) ." ". ucfirst($surname);  ?></h3>
                    <p class="card-profile-position">

                      <?php if ($category == "administrators") {
                      echo "An Administrator of Ebonyi State University Staff Secondary School.";
                    } ?>

                    <?php if ($category == "teachers") {
                      echo "An Staff of Ebonyi State University Staff Secondary School.";
                    } ?>

                    <?php if ($category == "students") {
                      echo "An Student of Ebonyi State University Staff Secondary School.";
                    } ?>

                    </p>
                    <p>
                      <?php if ($category == "students") {
                      // echo "From" ." ". $home_town  .", ". $LGA  ." LGA, ". $state .", ". $country  .".";
                    } ?>
                    </p>

                    <p class="mg-b-0">
                       <?php if ($category == "administrators") {
                          echo "A $gender Administrator Employed at Ebonyi State University Staff Secondary School.";
                        } ?>

                        <?php if ($category == "teachers") {
                          echo "A $gender staff Employed at Ebonyi State University Staff Secondary School.";
                          if ($form_class != "NONE") {
                            $form_class = fetch_class($form_class, 'classroom');
                            $classroom  = $form_class['classroom_name'];
                            echo" Also a form teacher to classroom $classroom.";
                          }
                          if ($subject_teaching != NULL) {
                            $subject_teaching = fetch_column4('subject_id', 'subjects', $subject_teaching);
                            $subject_teacher  = ucwords($subject_teaching['subject_name']);
                            echo" And a subject teacher of $subject_teacher.";
                          }
                        } ?>

                        <?php if ($category == "students") {
                          $stud_class = fetch_class($class, 'classroom');
                          $classroom  = $stud_class['classroom_name'];
                          echo "A $gender student of Ebonyi State University Staff Secondary School, currently in classroom $classroom.";
                        } ?>
                    </p>
                  </div><!-- media-body -->
                </div><!-- media -->
              </div><!-- card-body -->
              <div class="card-footer">
                <!-- <div>
                  <a href="edit-profile.php?user_id=<?php echo $user_id; ?>&category=<?php echo( $category); ?>">Edit Profile</a>
                </div> -->
              </div><!-- card-footer -->
            </div><!-- card -->

          <form method="post" action="upload.php" enctype="multipart/form-data">
            <ul class="nav nav-activity-profile mg-t-20">
              <li class="nav-item">
                <label for="upload" class="nav-link"><i class="icon ion-ios-redo tx-purple"></i>Browse Picture</label><input id="upload" type="file" name="profile_img" style="display: none;"><input type="hidden" name="userid" value="<?php echo $_GET['user_id'] ?>"><input type="hidden" name="user_cat" value="<?php echo $category; ?>">
              </li>
              <li class="nav-item"><a href="" class="nav-link">
                <input type="submit" name="submit" value="Upload Profile Picture" class="form-control button"></a>
              </li>
            </ul><!-- nav -->
          </form>

           <?php if (isset($_SESSION['err_msg'])): ?>
                    
                   <?php if ($_SESSION['err_msg'] === true):  ?>
                    <?php $_SESSION['err_msg'] = false; ?>
                      <div class="alert alert-danger mg-b-0" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Oh snap!</strong> Ensure you browse a picture before you upload
                    </div><!-- alert -->
                   <?php 
                   endif; ?>
                    
                  <?php endif ?>

            <div class="card card-latest-activity mg-t-20">
              <div class="card-body">

                <div class="row no-gutters">
                  <div class="col-md-4">
                    <a href=""><img src="img/glad.png" class="img-fit-cover" alt=""></a>
                  </div><!-- col-4 -->

                  <?php if($category == "students"):?>
                    <div class="col-md-8">
                        <div class="post-wrapper">
                          <a href="" class="activity-title">Basic Information You Need To Know</a>
                          <p>As a student after you have paid your fees and activated your account, you have the access to manage Your account.</p>

                          <p>You will be able to access your result if and only if you passed the above criteria</p>

                          <p>You can also view events detail form your dashboard and update your profile picture</p>
                        </div><!-- post-wrapper -->
                      </div><!-- col-8 -->
                  <?php endif; ?>

                  <?php if($category == "teachers"):?>
                    <div class="col-md-8">
                        <div class="post-wrapper">
                          <a href="" class="activity-title">Basic Information You Need To Know</a>
                          <p>As a teacher if you are a form teacher you can comment on the results of students in your class.</p>

                          <p>Also if you are a class teacher you can enter the result scores of your students.</p>

                          <p>You can also view events detail form your dashboard and update your profile picture</p>
                        </div><!-- post-wrapper -->
                      </div><!-- col-8 -->
                  <?php endif; ?>



                  <?php if($category == "administrators"):?>
                    <div class="col-md-8">
                        <div class="post-wrapper">
                          <a href="" class="activity-title">Basic Information You Need To Know</a>
                          <p>As a administrator You manage the whole system.</p>
                          <p>An administrator does the Adding, Updating and deleting function of the system, Basically all the major operation is performed by the administrator(s)</p>
                        </div><!-- post-wrapper -->
                      </div><!-- col-8 -->
                  <?php endif; ?>

                </div><!-- row -->

              </div><!-- card-body -->
            </div><!-- card -->

          </div><!-- col-8 -->

          <div class="col-lg-4 mg-t-20 mg-lg-t-0">

            <div class="card card-people-list mg-t-20" style="max-height: 450px; overflow: scroll; margin-top: 0;">

            <?php if ($category === 'administrators' or $category === 'teachers'){ ?>
              <div class="slim-card-title">People you may know</div>
            <?php }else{ ?>
              <div class="slim-card-title">Your Classmates</div>
            <?php
            $classMates = fetch_column9('students', 'class', $class, 'firstname');
            } 
            ?>
              <div class="media-list">

                <?php $teachers = fetch_column3('teachers', 'firstname'); ?>
                  <?php if ($category === 'administrators' or $category === 'teachers'): ?>
                     <?php foreach ($teachers as $persons): ?>
                      <?php extract($persons); ?>
                      <div class="media">
                      <img style="background: url(<?php echo $profile_img_path; ?>); background-size: cover; width: 50px; height: 50px; border-radius: 100%; background-position-x: 57.667%" src="<?php if(isset($profile_img_path)){
                        echo $profile_img_path;
                      }else{
                        echo 'http://via.placeholder.com/500x500';
                      } ?>" alt="">
                      <div class="media-body">
                        <a><?php echo ucfirst($firstname) ." ". ucfirst($lastname); ?></a>
                      </div><!-- media-body -->
                      <a href="mailto:<?php if(isset($email)){
                        echo $email;
                      } ?>"><i class="icon ion-ios-email-outline tx-20" style="padding-right: 15px;"></i></a>
                      <a href="tel:<?php if(isset($phone)){
                        echo $phone;
                      } ?>"><i class="icon ion-ios-telephone-outline tx-20"></i></a>
                    </div><!-- media -->      
                    <?php endforeach ?>
                  <?php endif ?>

                  <?php if ($category === 'students'): ?>
                     <?php foreach ($classMates as $classMate): ?>
                      <?php extract($classMate); ?>
                      <div class="media">
                      <img style="background: url(<?php echo $profile_img_path; ?>); background-size: cover; width: 50px; height: 50px; border-radius: 100%; background-position-x: 57.667%" src="<?php if(isset($profile_img_path)){
                        echo $profile_img_path;
                      }else{
                        echo 'http://via.placeholder.com/500x500';
                      } ?>" alt="">
                      <div class="media-body">
                        <a><?php echo ucfirst($firstname) ." ". ucfirst($lastname); ?></a>
                      </div><!-- media-body -->
                      <a href="mailto:<?php if(isset($email)){
                        echo $email;
                      } ?>"><i class="icon ion-ios-email-outline tx-20" style="padding-right: 15px;"></i></a>
                      <a href="tel:<?php if(isset($phone_no)){
                        echo $phone_no;
                      } ?>"><i class="icon ion-ios-telephone-outline tx-20"></i></a>
                    </div><!-- media -->      
                    <?php endforeach ?>
                  <?php endif ?>
               
                          
              </div><!-- media-list -->
            </div><!-- card -->

            <div class="card pd-25 mg-t-20">
              <div class="slim-card-title">Your Contact</div>

              <div class="media-list mg-t-25">
                
                <div class="media mg-t-25">
                  <div><i class="icon ion-ios-telephone-outline tx-24 lh-0"></i></div>
                  <div class="media-body mg-l-15 mg-t-4">
                    <h6 class="tx-14 tx-gray-700">Phone Number</h6>
                    <?php if ($category === 'administrators' or $category === 'teachers'): ?>
                      <a href="tel:<?php if(isset($phone)){
                          echo $user['phone'];
                        } ?>"><?php if(isset($phone)){
                          echo $user['phone'];
                        } ?></a>
                    <?php endif ?>

                    <?php if ($category === 'students'): ?>
                      <a href="tel:<?php if(isset($phone_no)){
                          echo $user['phone_no'];
                        } ?>"><?php if(isset($phone_no)){
                          echo $user['phone_no'];
                        } ?></a>
                    <?php endif ?>
                    
                  </div><!-- media-body -->
                </div><!-- media -->
                <div class="media mg-t-25">
                  <div><i class="icon ion-ios-email-outline tx-24 lh-0"></i></div>
                  <div class="media-body mg-l-15 mg-t-4">
                    <h6 class="tx-14 tx-gray-700">Email Address</h6>
                    <a href="mailto:<?php if(isset($email)){
                    echo $user['email'];
                  } ?>"><?php if(isset($email)){
                    echo $user['email'];
                  } ?></a>
                  </div><!-- media-body -->
                </div><!-- media -->
                
              </div><!-- media-list -->
            </div><!-- card -->
          </div><!-- col-4 -->
        </div><!-- row -->

      </div><!-- container -->
    </div><!-- slim-mainpanel -->

    <?php require_once 'inc/page-footer.inc.php'; ?>
  </body>
</html>
