<?php 
$pageTitle = "Mail Visitor(s)";

require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

require_once 'inc/page-header.inc.php'; 
?>

<?php 
  if (isset($_POST['addClass'])) {
    $result = addClass($_POST);

    if ($result === true) {
      $msg = true;
    }else{
      $errors = $result;
    }
}

 ?>
            <!-- btn-demo -->
            <div class="btn-demo">
            <button class="btn btn-primary btn-block mg-b-10" style="padding:0;"><a href="compose_mail.php" style="text-decoration:none; font-size:18px; color:#fff; display:inline-block; width:100%; padding:10px 12px;">Compose Mail</a></button>
            </div><!-- btn-demo -->
   
 <div class="section-wrapper" style="margin: 20px 0">
    <label class="section-title">Visitor's Emails</label>
    <p class="mg-b-20 mg-sm-b-40">Send mail(s) to our visitors who wishes to be updated about our activites.</p>
     
    <?php 
    
    $results = fetch_column7('newsletter');
    
    ?>

    <div class="table-wrapper">
        <table id="datatable1" class="table display responsive nowrap">
        <thead>
            <tr>
                
            <th class="wd-15p">Subscribers Email</th>
            <th class="wd-15p">Subscription Reg Date</th>
            <!-- <th class="wd-20p">Position</th>
            <th class="wd-15p">Start date</th>
            <th class="wd-10p">Salary</th>
            <th class="wd-25p">E-mail</th> -->
            </tr>
        </thead>
        <tbody>

        <?php if(count($results) === count($results, COUNT_RECURSIVE)){ ?>
          <tr>
            <td><?php echo $results['subscribers_email']; ?></td>
            <td><?php echo $results['subscription_reg_date']; ?></td>
            <!-- <td>Customer Support</td>
            <td>2011/01/25</td>
            <td>$112,000</td>
            <td>d.snider@datatables.net</td> -->
        </tr>
       <?php }else{?>
            
        <?php foreach($results as $result):
            extract($result);
            ?>
            <tr>
                <td><?php echo $subscribers_email; ?></td>
                <td><?php echo $subscription_reg_date; ?></td>
                <!-- <td>Customer Support</td>
                <td>2011/01/25</td>
                <td>$112,000</td>
                <td>d.snider@datatables.net</td> -->
            </tr>
        <?php endforeach; }?>

        </tbody>
        </table>
    </div><!-- table-wrapper -->
 </div><!-- section-wrapper -->      



        <script>
      $(function(){
        'use strict';

        $('#datatable1').DataTable({
          responsive: true,
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>
       
    <?php require_once 'inc/page-footer.inc.php'; ?>