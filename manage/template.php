<?php
include ('../includes/config.php');
include("../includes/MysqliDb.php");
if(!$_SESSION["SUSER"]){
$_SESSION["SUTRG"]=$_SERVER["REQUEST_URI"];
header("location:".ADMINROOT."login.php");
}
function admin_header($title="I4UR gadget Admin dashboard",$btn=""){


?>
<!DOCTYPE html>
<html lang="en">

<!-- BEGIN HEAD -->
<head>
<meta charset="UTF-8">
<title><?php echo $title;?></title>

<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT;?>libs/bootstrap/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT;?>libs/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT;?>assets/fonts/open-sans/styles.css">
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT;?>libs/tether/css/tether.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT;?>libs/jscrollpane/jquery.jscrollpane.css">
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT;?>libs/flag-icon-css/css/flag-icon.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT;?>assets/styles/common.min.css">
<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN THEME STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT;?>assets/styles/themes/primary.min.css">
<!-- END THEME STYLES -->
<script type="text/javascript" src="<?php echo ADMINROOT?>libs/jquery/jquery.min.js"></script>
<script src="<?php echo ADMINROOT;?>libs/tether/js/tether.min.js"></script>
<script src="<?php echo ADMINROOT;?>libs/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
var DIR="../";
var URL="<?php echo ADMINROOT?>";
var AJAX="<?php echo ROOT?>ajax/";
var FMAXSIZE=parseInt("<?php echo FILESIZE?>");
</script>
<script type="text/javascript" src="<?php echo ROOT?>js/common.js"></script>





</head>
<!-- END HEAD -->

<body class="ks-navbar-fixed ks-sidebar-default ks-sidebar-fixed ks-theme-primary ks-page-loading ks-sidebar-position-fixed">

<!-- BEGIN HEADER -->
<nav class="navbar ks-navbar">
<!-- BEGIN HEADER INNER -->
<!-- BEGIN LOGO -->
<div href="<?php echo ADMINROOT;?>" class="navbar-brand">
<!-- BEGIN RESPONSIVE SIDEBAR TOGGLER -->
<a href="#" class="ks-sidebar-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
<a href="#" class="ks-sidebar-mobile-toggle"><i class="fa fa-bars" aria-hidden="true"></i></a>
<!-- END RESPONSIVE SIDEBAR TOGGLER -->
<a href="<?php echo ADMINROOT;?>" class="ks-logo">I4UR GADGETS</a>

<!-- BEGIN GRID NAVIGATION -->

<!-- END GRID NAVIGATION -->
</div>
<!-- END LOGO -->

<!-- BEGIN MENUS -->
<div class="ks-wrapper">
<nav class="nav navbar-nav">
<!-- BEGIN NAVBAR MENU -->
<div class="ks-navbar-menu">

<a class="nav-item nav-link" href="<?php echo ADMINROOT?>">Dashboard</a>
<div class="nav-item nav-link ks-btn-action">
<?php echo $btn?>
</div>
</div>
<!-- END NAVBAR MENU -->

<!-- BEGIN NAVBAR ACTIONS -->
<div class="ks-navbar-actions">



<!-- BEGIN NAVBAR USER -->
<div class="nav-item dropdown ks-user">
<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="<?php echo ADMINROOT?>profile" role="button" aria-haspopup="true" aria-expanded="false">
<span class="ks-avatar">
<img src="<?php echo $_SESSION["IMG"]?ROOT."uploads/".$_SESSION["IMG"]:ADMINROOT."assets/img/avatars/avatar-13.jpg"?>" width="36" height="36">
</span>
<span class="ks-info">
<span class="ks-name"><?php echo $_SESSION["SUSERNAME"]?></span>
<span class="ks-description">Premium User</span>
</span>
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="Preview">
<a class="dropdown-item" href="<?php echo ADMINROOT?>profile">
<span class="fa fa-user-circle-o ks-icon"></span>
<span>My Profile</span>
</a>

<a class="dropdown-item" href="#">
<span class="fa fa-question-circle ks-icon" aria-hidden="true"></span>
<span>Help</span>
</a>
<a class="dropdown-item" href="<?php echo ADMINROOT?>logout.php">
<span class="fa fa-sign-out ks-icon" aria-hidden="true"></span>
<span>Logout</span>
</a>
</div>
</div>
<!-- END NAVBAR USER -->
</div>
<!-- END NAVBAR ACTIONS -->
</nav>

</div>
<!-- END MENUS -->
<!-- END HEADER INNER -->
</nav>
<!-- END HEADER -->






<div class="ks-container">
<!-- BEGIN DEFAULT SIDEBAR -->
<div class="ks-column ks-sidebar ks-info">
<div class="ks-wrapper">
<ul class="nav nav-pills nav-stacked">
<li class="nav-item ks-user dropdown">
<a class="nav-link dropdown-toggle"  role="button" aria-haspopup="true" aria-expanded="false">
<img src="<?php echo $_SESSION["IMG"]?ROOT."uploads/".$_SESSION["IMG"]:ADMINROOT."assets/img/avatars/avatar-13.jpg"?>" width="36" height="36" class="ks-avatar rounded-circle">
<div class="ks-info">
<div class="ks-name"><?php echo $_SESSION["SUSERNAME"];?></div>
<div class="ks-text">I4UR Gadget User</div>
</div>
</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="<?php echo ADMINROOT;?>aprofile.php">My Profile</a>

</div>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle"  href="#" role="button" aria-haspopup="true" aria-expanded="false">
<span class="ks-icon fa fa-users"></span>
<span>Admins</span>
</a>
<div class="dropdown-menu">

  <a class="dropdown-item" href="<?php echo ADMINROOT;?>create-admin.php">Create Admin</a>
<a class="dropdown-item" href="<?php echo ADMINROOT;?>users.php">Admins</a>
</div>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle"  href="#" role="button" aria-haspopup="true" aria-expanded="false">
<span class="ks-icon fa fa-cubes"></span>
<span>Brand</span>
</a>
<div class="dropdown-menu">

<a class="dropdown-item" href="<?php echo ADMINROOT;?>create-brand.php">Create Brands</a>
<a class="dropdown-item" href="<?php echo ADMINROOT;?>brands.php">Brands List</a>

</div>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle"  href="#" role="button" aria-haspopup="true" aria-expanded="false">
<span class="ks-icon fa fa-cubes"></span>
<span>Items</span>
</a>
<div class="dropdown-menu">

<a class="dropdown-item" href="<?php echo ADMINROOT;?>items.php">Items</a>
<a class="dropdown-item" href="<?php echo ADMINROOT;?>create-item.php">Create Items</a>

</div>
</li>
<!-- <li class="nav-item">
<a class="nav-link" href="<?php echo ADMINROOT?>pages">
<span class="ks-icon fa fa-gear"></span>
<span>Wbsite Pages</span>
</a>
</li> -->
<li class="nav-item">
<a class="nav-link" href="<?php echo ADMINROOT?>#tickets">
<span class="ks-icon fa fa-ticket"></span>
<span>Tickets</span>
</a>
</li>
<!-- <li class="nav-item">
<a class="nav-link" href="<?php echo ADMINROOT?>comments">
<span class="ks-icon fa fa-ticket"></span>
<span>Comments and replays</span>
</a>
</li> -->

<li class="nav-item">
<a class="nav-link" href="<?php echo ADMINROOT?>change-password">
<span class="ks-icon fa fa-puzzle-piece"></span>
<span>Change Password</span>
</a>
</li>



</ul>
</div>
</div>
<!-- END DEFAULT SIDEBAR -->

<?php }
function admin_footer(){ ?>
</div>
<div class="clearfix" style="clear: both;"></div>
<footer>
<div class="footer-bottom">
    <div class="container">
      <div class="pull-right"> © 2017 I4UR Gadget. All rights reserved.&nbsp; &nbsp;<a href="http://alityart.in" target="_blank">Developed By AlityArt</a> </div>
    </div>
    <!-- /.container -->
  </div>
</footer>
<!-- BEGIN PAGE LEVEL PLUGINS -->


<script src="<?php echo ADMINROOT;?>libs/responsejs/response.min.js"></script>
<script src="<?php echo ADMINROOT;?>libs/loading-overlay/loadingoverlay.min.js"></script>
<script src="<?php echo ADMINROOT;?>libs/tether/js/tether.min.js"></script>

<script src="<?php echo ADMINROOT;?>libs/jscrollpane/jquery.jscrollpane.min.js"></script>
<script src="<?php echo ADMINROOT;?>libs/jscrollpane/jquery.mousewheel.js"></script>
<script src="<?php echo ADMINROOT;?>libs/flexibility/flexibility.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="<?php echo ADMINROOT;?>assets/scripts/common.js"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<div class="ks-mobile-overlay"></div>

<!-- BEGIN SETTINGS BLOCK -->

<!-- END SETTINGS BLOCK -->
<!-- DELETE CONFIRM MODAL SARTS -->

    <div id="delConfirm" class="modal fade">

    <div class="modal-dialog">

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title">Confirm Deletion</h4>

            </div>

            <div class="modal-body">

                <div class="form-group row">
                   <p id="delErr" class="col-xs-7 text-danger hidden">Something went wrong.</p>
                   <div class="clearfix"></div>

                        <div class="col-xs-7">
                            Do you really want to remove this <span id="delType"></span>
                           </div>

                    </div>



            </div>

            <div class="modal-footer">
<button type="button" id="btnDelete" data-dismiss="modal" class="btn btn-danger">Delete </button>
<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>


            </div>

        </div>

    </div>

</div>
<!-- DELETE CONFIRM MODAL ENDS -->
</body>
</html><?php } ?>
