<?php 
$pageTitle = "Dashboard";
require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

require_once 'inc/page-header.inc.php'; 

?>

        <?php   
         
          $totalTeachers = fetch_column3('teachers', 'teachers_id');
          $totalStuds = fetch_column3('students', 'student_id');
          $totalSubjects = fetch_column3('subjects', 'subject_id');
          $totalClasses = fetch_column3('classroom', 'classroom_id');

         ?>
        <div class="row row-xs">
          <div class="col-sm-6 col-lg-3">
            <div class="card card-status">
              <div class="media">
                <i class="icon ion-ios-analytics-outline tx-pink"></i>
                <div class="media-body">
                  <?php 
                     $counter1 = 0;
                  foreach ($totalTeachers as $totalTeacher) {
                    $counter1++;
                  } ?>
                  <h1><?php echo $counter1; ?></h1>
                  <p>Total Teachers</p>
                </div><!-- media-body -->
              </div><!-- media -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-lg-3 mg-t-10 mg-sm-t-0">
            <div class="card card-status">
              <div class="media">
                <i class="icon ion-ios-analytics-outline tx-pink"></i>
                <div class="media-body">
                   <?php 
                     $counter2 = 0;
                   foreach ($totalStuds as $totalStud) {
                    $counter2++;
                  } ?>
                  <h1><?php echo $counter2; ?></h1>
                  <p>Total Students</p>
                </div><!-- media-body -->
              </div><!-- media -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
            <div class="card card-status">
              <div class="media">
                <i class="icon ion-ios-analytics-outline tx-pink"></i>
                <div class="media-body">
                   <?php 
                    $counter3 = 0;
                   foreach ($totalSubjects as $totalSubject) {
                    $counter3++;
                  } ?>
                  <h1><?php echo $counter3; ?></h1>
                  <p>Total Subjects</p>
                </div><!-- media-body -->
              </div><!-- media -->
            </div><!-- card -->
          </div><!-- col-3 -->
          <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
            <div class="card card-status">
              <div class="media">
                <i class="icon ion-ios-analytics-outline tx-pink"></i>
                <div class="media-body">

                   <?php 
                     $counter4 = 0;
                   foreach ($totalClasses as $totalClasse) {
                    $counter4++;
                  } ?>
                  <h1><?php echo $counter4; ?></h1>
                  <p>Total Classes</p>
                </div><!-- media-body -->
              </div><!-- media -->
            </div><!-- card -->
          </div><!-- col-3 -->
        </div><!-- row -->

        <?php 
              
          $results = fetch_column10('events', 'event_reg_date');
          if($results){
            $msg = true;
          }else{
            $errors['events'] = true;
          }

        ?>          
                  
        <div class="row row-xs mg-t-10">
          
        <div class="col-lg-8 col-xl-9">
            <div class="row row-xs">
              <div class="col-md-5 col-lg-6 col-xl-5" >
                <div class="card card-activities pd-20" style="min-height: 480px; overflow: scroll; margin-top:0">
                

                <?php if(isset($msg)){ 
                  $pattern = array('\r\n', '\f', '\s', '\n', '\r', '\v', '\t', '[\b]');
                  $replace = '';
                  $event_title = trim($results[0]['event_title']);
                  $event_title = str_replace($pattern, $replace, $event_title);                      
                  ?>
                  <h6 class="slim-pagetitle" id="event_title" ><?php echo $event_title;?></h6>
                <?php }else{ ?>
                  <h6 class="slim-pagetitle" id="event_title" >No events yet</h6>
                <?php }?>

                  <div class="media-list" style="margin-top:30px;" id="event_desc">
                    <?php
                      $pattern = '/\s{2,}||\n||\r||\t||\0||\x0B||\f||\v||\r\n/';
                      // '/\r||\n||\s||\r\n/';
                      // $pattern = array('\r\n', '\f', '\s', '\n', '\r', '\v', '\t');
                      $replace = '';
                      
                      $event_detail = trim($results[0]['event_desc']);
                      $event_detail = preg_replace($pattern, $replace, $event_detail);                      
                      echo $event_detail;
                     ?>
                     
                  </div><!-- media-list -->
                </div><!-- card -->
              </div><!-- col-5 -->
              <div class="col-md-7 col-lg-6 col-xl-7 mg-t-10 mg-md-t-0" style="background-size:contain">
              <div style=width"100%; max-height:480px;" >
                <img src="<?php echo $results[0]['event_image']?>" alt="EVENT IMAGE APPEARS HERE"  id="event_image">
              </div>
                
                
              </div><!-- col-7 -->
            </div><!-- row -->
          </div><!-- col-9 -->        

          <div class="col-lg-4 col-xl-3 mg-t-10 mg-lg-t-0">
            <div class="card card-activities pd-20" style="min-height: 480px; overflow: scroll; margin-top:0">
            <?php if(isset($msg)){ ?>
                <h6 class="slim-card-title">Events</h6>
              
              <p>Last event was added on <?php echo substr($results[0]['event_reg_date'], 0 , 11)?></p>
              <div class="media-list">
                
                <?php if(count($results) === count($results, COUNT_RECURSIVE)){ 
                  extract($results);
                  ?>
                  <a href="Javascript:Void()" class="media">
                  <div class="media" style"margin-bottom:20px;">
                    <div class="activity-icon bg-primary">
                      <i class="icon ion-image"></i>
                    </div><!-- activity-icon -->
                    <div class="media-body">
                      <h6><?php echo $event_title?></h6>
                      <p><?php echo substr($event_desc, 0, 30)?></p>
                      <span><?php echo substr($event_reg_date, 0, 11)?></span>
                    </div><!-- media-body -->
                  </div><!-- media -->
                  </a>
                <?php }else{?>
                    
                <?php foreach($results as $result):
                    extract($result);
                    ?>
                    <a href="Javascript:Void()" class="media" onclick='displayComment(<?php echo '"'.$event_title . '", "' . $event_image . '", "' . $event_desc . '"'; ?>)'>
                    <div class="media" style"margin-bottom:20px;"  onclick='displayComment(<?php echo '"'.$event_title . '", "' . $event_image . '", "' . $event_desc . '"'; ?>)'>
                      <div class="activity-icon bg-primary">
                        <i class="icon ion-image"></i>
                      </div><!-- activity-icon -->
                      <div class="media-body">
                        <h6><?php echo $event_title?></h6>
                        <p><?php echo substr($event_desc, 0, 30)?></p>
                        <span><?php echo substr($event_reg_date, 0, 11)?></span>
                      </div><!-- media-body -->
                    </div><!-- media -->
                    </a>
                <?php endforeach; }?>

              </div><!-- media-list -->
                <?php }else{ ?>
                  <h6 class="slim-pagetitle">No events Yet</h6>
                <?php }?>     
            </div>
            <!-- card -->       
          </div>  
          
      </div><!-- container -->
    </div><!-- slim-mainpanel -->


  <script>
  
    function displayComment(event_title, event_image, event_desc, commentId) {
        let nameEle = document.getElementById('event_title');
        let imageEle = document.getElementById('event_image');
        let commentEle = document.getElementById('event_desc');
        // let commentIdEle = document.getElementById('commentId');

        nameEle.innerHTML = event_title;
        imageEle.src = event_image;
        commentEle.innerHTML = event_desc;
        // commentIdEle.innerHTML = commentId;
    }              
  
  </script>                

    <?php require_once 'inc/page-footer.inc.php'; ?>