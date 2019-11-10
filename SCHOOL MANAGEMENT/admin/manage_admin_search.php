<?php 
$pageTitle = "Manage Admin Search";

require_once 'inc/config.inc.php'; 

if (!isset($_SESSION['user_id'])) {
    redirect_to("index.php");
}

if ($_SESSION['category'] !== 'admin') {
    redirect_to("dashboard.php");
}

require_once 'inc/page-header.inc.php'; 
?>

<?php 
if (isset($_POST['Search'])) {
  $result = fetch_search_result3($_POST);

extract($_POST);
    if ($result) {
        $msg = true;
    } else {
        $errors = $result;
    }
    }
    
    $category = "administrators";
 ?>

    </head>
    <body class="top-navbar-fixed">
        <div class="main-wrapper">

<div class="main-page">
<div class="container-fluid">
<div class="row page-title-div">
    <div class="col-md-6">
        <h2 class="title">Manage Teachers</h2>
    
    </div>
    
    <!-- /.col-md-6 text-right -->
</div>
</div>
<!-- /.container-fluid -->

<section class="section">
<div class="container-fluid">

<div class="row">
    <div class="col-sm-6">
    <div class="dataTables_length one" id="example_length">
        <label>Show 
        <select name="example_length" aria-controls="example" class="form-control input-sm">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select> Entries</label>
    </div>
    <div class="dataTables_length two" id="example_length">
        <label>Order by 
        <select name="example_length" aria-controls="example" class="form-control input-sm">
            <option value="10">Name</option>
            <option value="25">Reg No</option>
            <option value="50">Class</option>
        </select> </label>
    </div>
    </div>
    <!-- <div class="col-sm-6" >
    <div style="float: right;" id="example_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example"></label>
    </div>
    </div> -->

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="col-sm-6">
    <div>    
    <div style="float: right;" id="example_filter" class="search-box">
        <input type="search" class="form-control input-sm" aria-controls="example"  name="SearchString" value="<?php if(isset($_POST['SearchString'])) {
            echo($_POST['SearchString']);
        } ?>"  placeholder="Quick Search">
        <button class="btn btn-primary"  type="submit" name="Search"><i class="fa fa-search"></i></button>
    </div>
</div>
</form>
</div>

    <div class="row">
        <div class="col-md-12">

            <div class="panel">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h5>Teachers Info</h5>
                    </div>
                </div>

                <div class="panel-body p-20">

                    <table id="example" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <!-- <th>Select</th> -->
                                <th>Teachers Name</th>
                                <th>Username</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>#</th>
                                <!-- <th>Select</th> -->
                                <th>Teachers Name</th>
                                <th>Username</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Edit</th>
                            </tr>
                        </tfoot>
                        <?php 
                        $counter = 0;
                        if (isset($msg)){
                            if (count($result) != count($result, COUNT_RECURSIVE)) { 
                                foreach ($result as $search_result) { 
                                extract($search_result);
                                ?>
                            <tbody id="tbody10">
                            <tr>
                                <td><?php echo ++$counter; ?></td>
                                <!-- <td><input style="width: 20%; float: left;" class="form-control" type="checkbox" name="studdent[]" value="<?php   ?>"></td> -->
                                <td><a href="profile.php?user_id=<?php echo $admin_id; ?>&category=<?php echo $category; ?>"><?php echo ucfirst($firstname) .' '. ucfirst($lastname) .' '. ucfirst($surname);?></a></td>
                                <td><a href="profile.php?user_id=<?php echo $admin_id; ?>&category=<?php echo $category; ?>"><?php echo $username; ?></a></td>
                                <td><?php echo $gender; ?></td>
                                <td><?php echo $phone; ?></td>
                                <td><a href="edit-teachers.php?teacher_id=<?php echo $admin_id; ?>"><i class="fa fa-edit" title="Edit Record"></i> </a> </td>
                            </tr>
                            </tbody>
                        <?php }} elseif(count($result) == count($result, COUNT_RECURSIVE)){ 
                                extract($result);
                            ?>
                            <tbody id="tbody11">
                            <tr>
                                <td><?php echo ++$counter; ?></td>
                                <!-- <td><input style="width: 20 %; float: left;" class="form-control" type="checkbox" name="studdent[]" value="<?php   ?>"></td> -->
                                <td><a href="profile.php?user_id=<?php echo $admin_id; ?>"><?php echo ucfirst($firstname) .' '. ucfirst($lastname) .' '. ucfirst($surname);?></a></td>
                                <td><a href="profile.php?user_id=<?php echo $admin_id; ?>"><?php echo $username; ?></a></td>
                                <td><?php echo $gender; ?></td>
                                <td><?php echo $phone; ?></td>
                                <td><a href="edit-admin.php?admin_id=<?php echo $admin_id; ?>"><i class="fa fa-edit" title="Edit Record"></i> </a> </td>
                            </tr>
                            </tbody>
                            <?php }else{ ?>
                            <tbody id="tbody12">
                            <tr>
                                <td><?php echo ++$counter; ?></td>
                                <td>No result found</td>
                                <td>No result found</td>
                                <td>No result found</td>
                                <td>No result found</td>
                                <td>No result found</td>
                            </tr>
                            </tbody>
                        <?php   } }?>                                                   
                    </table>
                    <!-- /.col-md-12 -->
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->                                                               
        </div>
        <!-- /.col-md-12 -->
    </div>
                         
</section>
<!-- /.section -->
</div>
                         
<script>
 $(document).ready(function () {
   var checkAll = document.getElementById('checkAll');
   $('#checkAll').click(function () {
    if ($('#checkAll').attr("checked", false)) {
      $(':checkbox').attr("checked", true);
    }else{
     $(':checkbox').attr("checked", false);
    }
   });
 })
</script>
   
<?php require_once 'inc/page-footer.inc.php'; ?>
  </body>
</html>