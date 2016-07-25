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
        <link rel="stylesheet" href="../assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker3.min.css" />
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

                        <div class="row">
                          <div class="col-sm-4">
                            <div class="card">
                                  <div class="card-header bg-blue bg-inverse">
                                      <h4>Consultation and Appointments</h4>
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
                                                  <label for="register6-email" style="font-weight: 500; font-size: 1.1em;">Project title <span style="color:red;">**</span></label>
                                              </div>
                                          </div>
                                        </div>

                                        <h3>Author</h3>
                                        <div class="form-group" style="padding-top: 10px;">
                                                <div class="col-xs-12">
                                                    <div class="form-material">
                                                        <select class="js-select2 form-control" id="example2-select2" name="example2-select2" style="width: 100%;" data-placeholder="Choose one..">
                                      										<option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                                          <?php
                                                          $strSQL = "SELECT * FROM trs_useraccount WHERE acc_type = '5' ORDER BY acc_fname";
                                                          $resultAut = $db->select($strSQL,false,true);
                                                          if($resultAut){
                                                            foreach($resultAut as $value){
                                                              ?>
                                                              <option value="<?php print $value['acc_id'];?>"><?php print $value['acc_fname']." ".$value['acc_lname'];?></option>
                                                              <?php
                                                            }
                                                          }
                                                          ?>
                                      									</select>
                                                        <label for="example2-select2" style="font-weight: 500; font-size: 1.1em;">Main author <span style="color: red;">**</span></label>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="form-group">
                                                <div class="col-xs-12">
                                                    <div class="form-material">
                                                        <select class="js-select2 form-control" id="example2-select2" name="example2-select2" style="width: 100%;" data-placeholder="Choose one..">
                                      										<option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                      										<?php
                                                          $strSQL = "SELECT * FROM trs_useraccount WHERE acc_type = '5' ORDER BY acc_fname";
                                                          $resultAut = $db->select($strSQL,false,true);
                                                          if($resultAut){
                                                            foreach($resultAut as $value){
                                                              ?>
                                                              <option value="<?php print $value['acc_id'];?>"><?php print $value['acc_fname']." ".$value['acc_lname'];?></option>
                                                              <?php
                                                            }
                                                          }
                                                          ?>
                                      									</select>
                                                        <label for="example2-select2" style="font-weight: 500; font-size: 1.1em;">Co-author 1</label>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="form-group">
                                                <div class="col-xs-12">
                                                    <div class="form-material">
                                                        <select class="js-select2 form-control" id="example2-select2" name="example2-select2" style="width: 100%;" data-placeholder="Choose one..">
                                      										<option></option><!-- Required for data-placeholder attribute to work with Chosen plugin -->
                                                          <?php
                                                          $strSQL = "SELECT * FROM trs_useraccount WHERE acc_type = '5' ORDER BY acc_fname";
                                                          $resultAut = $db->select($strSQL,false,true);
                                                          if($resultAut){
                                                            foreach($resultAut as $value){
                                                              ?>
                                                              <option value="<?php print $value['acc_id'];?>"><?php print $value['acc_fname']." ".$value['acc_lname'];?></option>
                                                              <?php
                                                            }
                                                          }
                                                          ?>
                                      									</select>
                                                        <label for="example2-select2" style="font-weight: 500; font-size: 1.1em;">Co-author 2</label>
                                                    </div>
                                                </div>
                                        </div>

                                        <h3>Consultation</h3>

                                        <div class="form-group" style="padding-top: 10px;">
                                          <div class="col-md-12">
                                              <div class="form-material">
                                                  <input class="js-datepicker form-control" type="text" id="example-datepicker4" name="example-datepicker4" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd">
                                                  <label for="example-datepicker4" style="font-weight: 500; font-size: 1.1em;">Date of consultation <span style="color: red;">**</span></label>
                                              </div>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <div class="col-md-12">
                                              <div class="form-material">
                                                  <input class="js-masked-time form-control" type="text" id="example-masked2-date1" name="example-masked2-date1" placeholder="HH.MM" />
                                                  <label for="example-masked2-date1" style="font-weight: 500; font-size: 1.1em;">Start time <span style="color: red;">**</span></label>
                                                  <p style="font-size: 0.8em; padding-top: 5px; color: red;">
                                                    <i>* Between 0.01 - 24.00.<br>** Example format: 13.30</i>
                                                  </p>
                                              </div>
                                          </div>
                                        </div>

                                        <div class="form-group">
                                          <div class="col-md-12">
                                              <div class="form-material">
                                                  <input class="js-masked-time form-control" type="text" id="example-masked2-date1" name="example-masked2-date1" placeholder="HH.MM" />
                                                  <label for="example-masked2-date1" style="font-weight: 500; font-size: 1.1em;">End time <span style="color: red;">**</span></label>
                                                  <p style="font-size: 0.8em; padding-top: 5px; color: red;">
                                                    <i>* Between 0.01 - 24.00.<br>** Example format: 24.30</i>
                                                  </p>
                                              </div>
                                          </div>
                                        </div>


                                        <div class="form-group m-b-0">
                                              <div class="col-xs-12">
                                                  <button class="btn btn-app-blue" type="submit">Submit</button>
                                                  <button class="btn btn-app-light" type="reset">Reset</button>
                                              </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                              </div>
                          </div>
                          <!-- End col-md-4 -->
                          <div class="col-sm-8">
                            <div class="card">
                              <div class="card-header bg-teal bg-inverse">
                                  <h4>Consultation service log</h4>
                                  <ul class="card-actions">
                                      <li>
                                          <button type="button"><i class="ion-more"></i></button>
                                      </li>
                                  </ul>
                              </div>
                              <div class="card-block">
                                <table class="table table-bordered table-striped table-vcenter js-dataTable-full table-header-bg">
                                  <thead>
                                      <tr>
                                          <th class="text-center"></th>
                                          <th>Author name</th>
                                          <th class="hidden-xs">Date - Time</th>
                                          <th class="hidden-xs w-20">Durations</th>
                                          <th class="hidden-xs w-20">Appointment</th>
                                          <th class="text-center" style="width: 120px;"></th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $strSQL = "SELECT * FROM trs_useraccount a inner join trs_institute b on a.acc_instituteid=b.inst_id
                                              left join trs_prefix c on a.acc_prefixid=c.prefix_id
                                              WHERE a.acc_type = '4'
                                              ORDER BY a.acc_regdate DESC";
                                    $resultPI = $db->select($strSQL,false,true);
                                    if($resultPI){
                                      $c = 1;
                                      foreach ($resultPI as $value) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php print $c; ?></td>
                                            <td class="font-500">
                                              <?php
                                              if(($value['acc_prefixid']!='') || ($value['acc_prefixid']!=null)){
                                                print $value['prefix_name'];
                                              }
                                              print $value['acc_fname']." ".$value['acc_lname'];
                                              ?>
                                            </td>
                                            <td class="hidden-xs"><?php print $value['inst_name']; ?></td>
                                            <td class="hidden-xs"><?php print $value['acc_phone']; ?></td>
                                            <td class="hidden-xs"><?php print $value['acc_phone']; ?></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit Client"><i class="ion-edit"></i></button>
                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Add appointment" onclick="redirect('schedule.php?pi_id=<?php print $value['acc_id'];?>')"><i class="ion-calendar"></i></button>
                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remove Client"><i class="ion-close"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $c++;
                                      }
                                    }
                                    ?>


                                    </tbody>
                                  </table>
                              </div>
                            </div>

                          </div>
                          <!-- End col-sm-8 -->
                        </div>
                        <!-- End row -->
                        <div class="row">

                        </div>
                        <!-- End row -->
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
        <script src="../assets/js/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/js/plugins/masked-inputs/jquery.maskedinput.min.js"></script>
        <script src="../assets/js/plugins/select2/select2.full.min.js"></script>
        <!-- JQUERY CODE -->
        <script src="../dist/page/coder/coder.js" type="text/javascript"></script>
        <script src="../assets/js/pages/base_tables_datatables.js"></script>
        <script>
            $(function()
            {
                // Init page helpers (BS Datepicker + BS Colorpicker + Select2 + Masked Input + Tags Inputs plugins)
                App.initHelpers(['datepicker','select2', 'masked-inputs']);
            });
        </script>

    </body>

</html>
