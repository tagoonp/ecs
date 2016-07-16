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
                        					<span style="color: #444; font-weight:500;">รายชื่อผู้วิจัย</span>
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
                            <div class="col-sm-12">
                              <div class="card">
                                <div class="card-header bg-success">
                                    <h4>รายชื่อผู้วิจัย</h4>
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
                                            <th>ชื่อ - นามสกุล</th>
                                            <th class="hidden-xs">ภาควิชา</th>
                                            <th class="hidden-xs w-20">หมายเลขโทรศัพท์</th>
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
                                              <td class="text-center">
                                                  <div class="btn-group">
                                                      <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit Client"><i class="ion-edit"></i></button>
                                                      <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Research" onclick="redirect('research.php?pi_id=<?php print $value['acc_id'];?>')"><i class="ion-ios-albums-outline"></i></button>
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
                          </div>
                          <!-- End row -->
                        </p>
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
        <script src="../assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
        <!-- JQUERY CODE -->
        <script src="../dist/page/coder/coder.js" type="text/javascript"></script>
        <script src="../assets/js/pages/base_tables_datatables.js"></script>
        <script>
            $(function()
            {
                // Init page helpers (BS Datepicker + BS Colorpicker + Select2 + Masked Input + Tags Inputs plugins)
                App.initHelpers(['select2']);
            });
        </script>

    </body>

</html>
