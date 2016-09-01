<?php
session_start();
include "../database/database.class.php";
include "../core/checksession.php";

$db = new database();
$db->connect();

if(!isset($_GET['pi_id'])){
  header('Location: error-404.html');
  exit();
}

?>
<!DOCTYPE html>
<html class="app-ui">

    <head>
        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

        <!-- Document title -->
        <title>ผู้บันทึกข้อมูล :: E-Consult service system</title>

        <meta name="description" content="AppUI - Admin Dashboard Template & UI Framework" />
        <meta name="author" content="rustheme" />
        <meta name="robots" content="noindex, nofollow" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="../assets/img/favicons/apple-touch-icon.png" />
        <link rel="icon" href="../assets/img/favicons/favicon.ico" />

        <!-- Google fonts -->
        <link href='https://fonts.googleapis.com/css?family=Kanit:400,300,200,500&subset=thai,latin' rel='stylesheet' type='text/css'>

        <!-- Page JS Plugin CSS -->
        <link rel="stylesheet" href="../assets/js/plugins/datatables/jquery.dataTables.min.css" />

        <!-- AppUI CSS stylesheets -->
        <link rel="stylesheet" id="css-font-awesome" href="../assets/css/font-awesome.css" />
        <link rel="stylesheet" id="css-ionicons" href="../assets/css/ionicons.css" />
        <link rel="stylesheet" id="css-bootstrap" href="../assets/css/bootstrap.css" />
        <link rel="stylesheet" id="css-app" href="../assets/css/app.css" />
        <link rel="stylesheet" id="css-app-custom" href="../assets/css/app-custom-2.css" />
        <!-- End Stylesheets -->
    </head>

    <body class="app-ui layout-has-drawer layout-has-fixed-header">
        <div class="app-layout-canvas">
            <div class="app-layout-container">

                <!-- Drawer -->
                <aside class="app-layout-drawer">

                    <!-- Drawer scroll area -->
                    <div class="app-layout-drawer-scroll">
                        <!-- Drawer logo -->
                        <div id="logo" class="drawer-header">
                            <a href="index.html"><img class="img-responsive" src="../assets/img/logo/logo-backend.png" title="AppUI" alt="AppUI" /></a>
                        </div>

                        <!-- Drawer navigation -->
                        <?php include "componants/menu.php"; ?>
                        <!-- End drawer navigation -->

                    </div>
                    <!-- End drawer scroll area -->
                </aside>
                <!-- End drawer -->

                <!-- Header -->
                <header class="app-layout-header">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button class="pull-left hidden-lg hidden-md navbar-toggle" type="button" data-toggle="layout" data-action="sidebar_toggle">
                        					<span class="sr-only">Toggle drawer</span>
                        					<span class="icon-bar"></span>
                        					<span class="icon-bar"></span>
                        					<span class="icon-bar"></span>
                        				</button>
                                <span class="navbar-page-title">
                        					<span style="color: #444; font-weight:500;">Register new project </span>
                        				</span>
                            </div>

                            <div class="collapse navbar-collapse" id="header-navbar-collapse">
                                <!-- Header search form -->
                                <?php
                                include "componants/search-tools.php";
                                ?>



                                <ul class="nav navbar-nav navbar-right navbar-toolbar hidden-sm hidden-xs">

                                    <?php
                                    include "componants/notification.php";
                                    ?>

                                    <?php
                                    include "componants/userinfo.php";
                                    ?>

                                </ul>
                                <!-- .navbar-right -->
                            </div>
                        </div>
                        <!-- .container-fluid -->
                    </nav>
                    <!-- .navbar-default -->
                </header>
                <!-- End header -->

                <main class="app-layout-content">

                    <!-- Page Content -->
                    <div class="container-fluid p-y-md">
                      <div class="row">
                        <div class="col-sm-8">
                          <div class="card">
                                <div class="card-header bg-blue bg-inverse">
                                    <h4>เพิ่มงานวิจัย / หัวข้อวิจัย</h4>
                                </div>
                                <div class="card-block">
                                  <div class="loading" style="display:none; padding-top: 50px; padding-bottom: 40px;">
                                    <div id="pg" class="progress active" style="padding: 0px; margin: 0px;">
                                        <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span id="loadLabel">0%</span></div>
                                    </div>
                                  </div>
                                  <div class="register">
                                    <form class="js-validation-material-project-regist form-horizontal m-t-sm" action="controller/insert-project.php" method="post" >
                                      <div class="form-group" style="display:none;">
                                        <div class="col-xs-12">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="txt-pi-id" name="txt-pi-id" readonly placeholder="Enter name or project title..." value="<?php print $_GET['pi_id'];?>">
                                                <label for="register6-email" style="font-weight: 500; font-size: 1.1em;">หัวข้องานวิจัย <span style="color:red;">**</span></label>
                                            </div>
                                        </div>
                                      </div>

                                      <div class="form-group" style="padding-top: 0px;">
                                        <div class="col-xs-12">
                                            <div class="form-material" style="padding-top: 10px;">
                                                <!-- <input class="form-control" type="text" id="txt-projecttitle" name="txt-projecttitle" placeholder="Enter name or project title..."> -->
                                                <textarea class="form-control"  rows="4" cols="40" id="txt-projecttitle" name="txt-projecttitle" placeholder="ระบุชื่อ / หัวข้องานวิจัย..."></textarea>
                                                <label for="register6-email" style="font-weight: 500; font-size: 1.1em;">หัวข้องานวิจัย <span style="color:red;">**</span></label>
                                            </div>
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <div class="col-xs-12">
                                            <div class="form-material">
                                                <input class="form-control" type="text" id="txt-fund" name="txt-fund" placeholder="ระบุชื่อแหล่งทุน...">
                                                <label for="register6-email" style="font-weight: 500; font-size: 1.1em;">แหล่งทุน </label>
                                            </div>
                                        </div>
                                      </div>

                                      <div class="form-group m-b-0">
                                            <div class="col-xs-12">
                                                <button class="btn btn-app-blue" type="submit">บันทึก</button>
                                                <button class="btn btn-app-light" type="reset">รีเซ็ต</button>
                                            </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 col-lg-4">
                          <h2 class="section-title" style="font-size: 1.3em; color: #444;">คำแนะนำ</h2>

                          <p>
                            ในส่วนรายชื่อภาควิชา / สาขาวิชา หากท่านไม่พบรายชื่อภาควิชาหรือสาขาวิชาของท่าน กรุณาเพิ่มข้อมูลโดยการกดปุ่ม "เพิ่มสาขาวิชา / ภาควิชา" ข้างล่าง
                          </p>

                          <div class="row">
                            <div class="col-xs-12">
                                <button class="btn btn-app-red" type="button" onclick="redirect('research-list.php?pi_id=<?php print $_GET['pi_id'];?>')">รายการหัวข้อวิจัย</button>
                            </div>
                          </div>
                        </div>
                        <!-- .col-sm-4-->
                      </div>
                    </div>
                    <!-- End Page Content -->

                </main>

            </div>
            <!-- .app-layout-container -->
        </div>
        <!-- .app-layout-canvas -->

        <div class="app-ui-mask-modal"></div>

        <!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
        <script src="../assets/js/core/jquery.min.js"></script>
        <script src="../assets/js/core/bootstrap.min.js"></script>
        <script src="../assets/js/core/jquery.slimscroll.min.js"></script>
        <script src="../assets/js/core/jquery.scrollLock.min.js"></script>
        <script src="../assets/js/plugins/select2/select2.full.min.js"></script>
        <script src="../assets/js/core/jquery.placeholder.min.js"></script>
        <script src="../assets/js/app.js"></script>
        <script src="../assets/js/app-custom.js"></script>
        <!-- Page JS Plugins -->
        <script src="../assets/js/plugins/jquery-validation/jquery.validate.min.js"></script>
        <!-- JQUERY CODE -->
        <script src="../dist/page/coder/coder.js" type="text/javascript"></script>
        <script src="../dist/page/coder/register_project_validation.js"></script>
        <script>
            $(function()
            {
                // Init page helpers (BS Datepicker + BS Colorpicker + Select2 + Masked Input + Tags Inputs plugins)
                App.initHelpers(['select2']);
            });
        </script>

    </body>

</html>
