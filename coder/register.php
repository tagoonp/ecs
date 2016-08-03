<?php
session_start();
include "../database/database.class.php";
include "../core/checksession.php";

$db = new database();
$db->connect();


?>
<!DOCTYPE html>
<html class="app-ui">

    <head>
        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

        <!-- Document title -->
        <title>ผู้ลงข้อมูล :: E-Consult service system</title>

        <meta name="description" content="AppUI - Admin Dashboard Template & UI Framework" />
        <meta name="author" content="rustheme" />
        <meta name="robots" content="noindex, nofollow" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="../assets/img/favicons/apple-touch-icon.png" />
        <link rel="icon" href="../assets/img/favicons/favicon.ico" />

        <!-- Google fonts -->
        <link href='//fonts.googleapis.com/css?family=Kanit:400,300,200,500&subset=thai,latin' rel='stylesheet' type='text/css'>

        <!-- Page JS Plugin CSS -->
        <link rel="stylesheet" href="../assets/js/plugins/select2/select2.min.css" />
        <link rel="stylesheet" href="../assets/js/plugins/select2/select2-bootstrap.css" />

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
                        					<span style="color: #444; font-weight:500;">ลงทะเบียนงานวิจัย</span>
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

                        <p>
                          <div class="row">

                            <div class="col-sm-8 col-lg-8">
                              <h2 class="section-title" style="font-size: 1.5em; color: #444;">ลงทะเบียนผู้วิจัย</h2>
                                <div class="card">
                                    <div class="card-header bg-green bg-inverse">
                                        <h4>เพิ่มรายการผู้ขอคำปรึกษา</h4>
                                    </div>
                                    <div class="card-block">
                                      <div class="loading" style="display:none; padding-top: 50px; padding-bottom: 40px;">
                                        <div id="pg" class="progress active" style="padding: 0px; margin: 0px;">
                                            <div id="progress-bar" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span id="loadLabel">0%</span></div>
                                        </div>
                                      </div>
                                      <div class="register">
                                        <form class="js-validation-material form-horizontal m-t-sm" action="base_forms_samples.html" method="post" onsubmit="return false;">
                                          <div class="form-group"  style="margin-top: 20px;">
                                            <div class="col-xs-12">
                                                <div class="form-material">
                                                    <select class="js-select2 form-control" id="txt-prefix" name="txt-prefix" style="width: 100%;" data-placeholder="เลือกคำนำหน้าชื่อ..">
                                                      <option value=""></option>
                                                      <?php
                                                      $strSQL = "SELECT * FROM `trs_prefix`";
                                                      $resultPrefix = $db->select($strSQL,false,true);
                                                      if($resultPrefix){
                                                        foreach ($resultPrefix as $value) {
                                                          ?>
                                                          <option value="<?php print $value['prefix_id'];?>"><?php print $value['prefix_name']; ?></option>
                                                          <?php
                                                        }
                                                      }
                                                      ?>
                                                    </select>
                                                    <label for="example2-select2">คำนำหน้าชื่อ <span style="color:red;">**</span></label>
                                                </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                            <div class="col-sm-6">
                                              <div class="form-group">
                                                  <div class="col-xs-12">
                                                      <div class="form-material">
                                                          <input class="form-control" type="text" id="txt-fname" name="txt-fname" placeholder="กรอกชื่อ">
                                                          <label for="register6-firstname">ชื่อ <span style="color:red;">**</span></label>
                                                      </div>
                                                  </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                              <div class="form-group">
                                                <div class="col-xs-12">
                                                    <div class="form-material ">
                                                        <input class="form-control" type="text" id="txt-lname" name="txt-lname" placeholder="กรอกนามสกุล">
                                                        <label for="register6-lastname">นามสกุล <span style="color:red;">**</span></label>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <div class="col-xs-12">
                                                <div class="form-material">
                                                    <input class="form-control" type="text" id="txt-phone" name="txt-phone" placeholder="กรอกหมายเลขโทรศัพท์">
                                                    <label for="register6-email">หมายเลขโทรศัพท์ <span style="color:red;">**</span></label>
                                                </div>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                            <div class="col-xs-12">
                                                <div class="form-material">
                                                    <input class="form-control" type="email" id="txt-email" name="txt-email" placeholder="กรอกอีเมลแอดเดรส">
                                                    <label for="register6-email">อีเมล <span style="color:red;">**</span></label>
                                                </div>
                                            </div>
                                          </div>

                                          <div class="form-group">
                                                  <div class="col-xs-12">
                                                      <div class="form-material">
                                                          <select class="js-select2 form-control" id="txt-department" name="txt-department" style="width: 100%;" data-placeholder="เลือกภาควิชา / สาขาวิชา..">
                                        										<option value=""></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                        									</select>
                                                          <label for="example2-select2">ภาควิชา / สาขาวิชา <span style="color:red;">**</span></label>
                                                      </div>
                                                  </div>
                                            </div>
                                            <div class="form-group m-b-0">
                                                  <div class="col-xs-12">
                                                      <button class="btn btn-app" type="submit">ลงทะเบียนผู้วิจัย</button>
                                                      <button class="btn btn-app-light" type="reset">รีเซ็ต</button>
                                                  </div>
                                            </div>
                                        </form>
                                      </div>

                                    </div>
                                </div>
                            </div>
                            <!-- .col-sm-8-->

                            <div class="col-sm-4 col-lg-4">
                              <h2 class="section-title" style="font-size: 1.3em; color: #444;">คำแนะนำ</h2>

                              <p>
                                ในส่วนรายชื่อภาควิชา / สาขาวิชา หากท่านไม่พบรายชื่อภาควิชาหรือสาขาวิชาของท่าน กรุณาเพิ่มข้อมูลโดยการกดปุ่ม "เพิ่มสาขาวิชา / ภาควิชา" ข้างล่าง
                              </p>

                              <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-app-orange" type="button" data-toggle="modal" data-target="#apps-modal">เพิ่มสาขาวิชา / ภาควิชา</button>
                                </div>
                              </div>
                            </div>
                            <!-- .col-sm-4-->

                          </div>
                        </p>
                    </div>
                    <!-- End Page Content -->

                </main>

            </div>
            <!-- .app-layout-container -->
        </div>
        <!-- .app-layout-canvas -->

        <!-- Apps Modal -->
        <!-- Opens from the button in the header -->
        <div id="apps-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-sm modal-dialog modal-dialog-top">
                <div class="modal-content">
                    <!-- Apps card -->
                    <div class="card m-b-0">
                        <div class="card-header bg-blue bg-inverse">
                            <h4>เพิ่มสาชาวิชา / ภาควิชา</h4>
                            <ul class="card-actions">
                                <li>
                                    <button id="modal-addept-close" data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-block">
                            <form class="js-validation-material-adddept form-horizontal m-t-sm" onsubmit="return false;">
                              <div class="form-group">
                                <div class="col-xs-12">
                                    <div class="form-material">
                                        <input class="form-control" type="text" id="txt-deptadd" name="txt-deptadd" placeholder="กรอกชื่อสาขาวิชา / ภาควิชา">
                                        <label for="register6-email">ชื่อสาขาวิชา / ภาควิชา  <span style="color:red;">**</span></label>
                                    </div>
                                </div>
                              </div>
                              <div class="form-group m-b-0 text-center">
                                    <div class="col-xs-12">
                                        <button class="btn btn-app-teal btn-block" type="submit">บันทึก</button>
                                    </div>
                              </div>
                            </form>
                        </div>
                        <!-- .card-block -->
                    </div>
                    <!-- End Apps card -->
                </div>
            </div>
        </div>
        <!-- End Apps Modal -->

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
        <script src="../dist/page/coder/reigter_pm_validation.js"></script>
        <script>
            $(function()
            {
                // Init page helpers (BS Datepicker + BS Colorpicker + Select2 + Masked Input + Tags Inputs plugins)
                App.initHelpers(['select2']);
            });
        </script>

    </body>

</html>
