<?php 
include ('../includes/config.php');
include("../includes/MysqliDb.php");
if(!$_SESSION["SUSER"]){
$_SESSION["UTRG"]=$_SERVER["REQUEST_URI"];
header("location:".ADMINROOT."login.php");
}
function admin_header($title="Vyapar Formation Dashboard",$btn=""){
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
<link rel="stylesheet" type="text/css" href="<?php echo ADMINROOT;?>libs/bootstrap/css/bootstrap.min.css">
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
<script type="text/javascript" src="<?php echo ROOT?>js/jQuery-2.2.0.min.js"></script>
<script src="<?php echo ADMINROOT;?>libs/tether/js/tether.min.js"></script>
<script src="<?php echo ADMINROOT;?>libs/bootstrap/js/bootstrap.min.js"></script> 
<script type="text/javascript">
var DIR="../";
var URL="<?php echo ADMINROOT?>";
var FMAXSIZE=parseInt("<?php echo FILESIZE?>")
</script>





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
<a href="<?php echo ADMINROOT;?>" class="ks-logo">VyaparFormations</a>

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
<div class="nav-item dropdown">
<a class="nav-link"  href="<?php echo ROOT?>"  role="button" aria-haspopup="true" aria-expanded="false">
Website
</a>
<div class="dropdown-menu ks-info" aria-labelledby="Preview">
<a class="dropdown-item ks-active" href="<?php echo ROOT?>" target="_blank">Home</a>

</div>
</div>
<div class="nav-item nav-link ks-btn-action">
<?php echo $btn?>
</div>
</div>
<!-- END NAVBAR MENU -->

<!-- BEGIN NAVBAR ACTIONS -->
<div class="ks-navbar-actions">



<!-- BEGIN NAVBAR USER -->
<div class="nav-item dropdown ks-user">
<a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
<span class="ks-avatar">
<img src="<?php echo $_SESSION["IMG"]?ROOT."uploads/".$_SESSION["IMG"]:ADMINROOT."assets/img/avatars/avatar-13.jpg"?>" width="36" height="36">
</span>
<span class="ks-info">
<span class="ks-name"><?php echo $_SESSION["USERNAME"]?></span>
<span class="ks-description">Premium User</span>
</span>
</a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="Preview">
<a class="dropdown-item" href="<?php echo ROOT?>dashboard/business-profile">
<span class="fa fa-user-circle-o ks-icon"></span>
<span>Business Profile</span>
</a>
<a class="dropdown-item" href="<?php echo ROOT?>dashboard/profile">
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

<!-- BEGIN NAVBAR ACTIONS TOGGLER -->
<!-- <nav class="nav navbar-nav ks-navbar-actions-toggle">
<a class="nav-item nav-link" href="#">
<span class="fa fa-ellipsis-h ks-icon ks-open"></span>
<span class="fa fa-close ks-icon ks-close"></span>
</a>
</nav>-->
<!-- END NAVBAR ACTIONS TOGGLER -->

<!-- BEGIN NAVBAR MENU TOGGLER -->
<!-- <nav class="nav navbar-nav ks-navbar-menu-toggle">
<a class="nav-item nav-link" href="#">
<span class="fa fa-th ks-icon ks-open"></span>
<span class="fa fa-close ks-icon ks-close"></span>
</a>
</nav>-->
<!-- END NAVBAR MENU TOGGLER -->
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
<a class="nav-link dropdown-toggle"  href="#" role="button" aria-haspopup="true" aria-expanded="false">
<img src="<?php echo $_SESSION["IMG"]?ROOT."uploads/".$_SESSION["IMG"]:ADMINROOT."assets/img/avatars/avatar-13.jpg"?>" width="36" height="36" class="ks-avatar rounded-circle">
<div class="ks-info">
<div class="ks-name"><?php echo $_SESSION["USERNAME"];?></div>
<div class="ks-text">Entrepreneur</div>
</div>
</a>
<div class="dropdown-menu">
<!-- <a class="dropdown-item" href="profile-social-profile.html">Profile</a>-->
<a class="dropdown-item" href="<?php echo ADMINROOT;?>profile">My Profile</a>
<a class="dropdown-item" href="<?php echo ADMINROOT;?>business-profile">Business Profile</a>
</div>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle"  href="#" role="button" aria-haspopup="true" aria-expanded="false">
<span class="ks-icon fa fa-dashboard"></span>
<span>Services</span>
</a>
<div class="dropdown-menu">
<a class="dropdown-item" href="<?php echo ADMINROOT;?>active-services">Active Services</a>
<a class="dropdown-item" href="<?php echo ADMINROOT;?>add-service">Add Services</a>

</div>
</li>
<li class="nav-item dropdown">
<a class="nav-link dropdown-toggle"  href="#" role="button" aria-haspopup="true" aria-expanded="false">
<span class="ks-icon fa fa-cubes"></span>
<span>Documents</span>
</a>
<div class="dropdown-menu">

<a class="dropdown-item" href="<?php echo ADMINROOT;?>my-documents">Upload/download</a>

</div>
</li>


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
      <div class="pull-right"> © 2017 VyaparFormations. All rights reserved.&nbsp; &nbsp;<a href="http://alityart.in" target="_blank">Developed By AlityArt</a> </div>
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


</body>
</html><?php } ?>