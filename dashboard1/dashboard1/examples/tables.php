<?php 

  include("../../../db_con.php");
  session_start();
  if(isset($_SESSION['id']))
    $vendor_id = $_SESSION['id'];
  else header("Location: ../../../index.php");
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    farmers Forum
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../assets/css/material-dashboard.css?v=2.1.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
              <?php if(isset($_GET['inv'])) {
                    if($_GET['inv'] == "true") {
                ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <center>
                  <strong>Invalid Input</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </center>
                  </div>
                <?php
                  }
                }
                ?>
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="green" data-image="../assets/img/sidebar-1.jpg">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

        Tip 2: you can also add an image using data-image tag
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-normal">
          Farmers Forum
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item ">
            <a class="nav-link" href="./dashboard.php">
              <i class="material-icons"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="../../Forms/addStock.php">
              <i class="material-icons"></i>
              <p>Add New Stock</p>
            </a>
          </li>
          <li class="nav-item active  ">
            <a class="nav-link" href="./tables.php">
              <i class="material-icons"></i>
              <p>Table List</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="tables.php">Table List</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                  <i class="material-icons">dashboard</i>
                  <p class="d-lg-none d-md-block">
                    Stats
                  </p>
                </a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">notifications</i>
                  <span class="notification">5</span>
                  <p class="d-lg-none d-md-block">
                    Some Actions
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Mike John responded to your email</a>
                  <a class="dropdown-item" href="#">You have 5 new tasks</a>
                  <a class="dropdown-item" href="#">You're now friend with Andrew</a>
                  <a class="dropdown-item" href="#">Another Notification</a>
                  <a class="dropdown-item" href="#">Another One</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Order Management</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>
                          #
                        </th>
                        <th>
                          Item Name
                        </th>
                        <th>
                          Customer Name
                        </th>
                        <th>
                            Remaining Quanity
                        </th>
                        <th>
                          Order Price
                        </th>
                      </thead>
                      <tbody>
                      <?php
                        $getOrders = mysqli_query($con, "SELECT before_checkout.stock_id, before_checkout.quantity, before_checkout.cust_id FROM order_table INNER JOIN before_checkout ON (order_table.bcid = before_checkout.id) WHERE order_table.vendor_id='$vendor_id'");
                        $c = 1;
                        while($rows = mysqli_fetch_array($getOrders)) {
                          $name= "";
                          $cust_name = "";
                          $price = 0;
                          $orderQuantity = 0;
                          $stock_id = $rows['stock_id'];
                          $cust_id = $rows['cust_id'];
                          $quantity = $rows['quantity'];
                          $stockRes = mysqli_query($con, "SELECT name, quantity, price FROM stock WHERE status=1 AND id='$stock_id'");
                          if($stockRow = mysqli_fetch_array($stockRes)) {
                            $name = $stockRow['name'];
                            $remQuantity = $stockRow['quantity'];
                            $price = $stockRow['price'];
                          }
                          $custRes = mysqli_query($con, "SELECT name FROM c_fregistration WHERE id='$cust_id'");
                          if($custRow = mysqli_fetch_array($custRes)) {
                            $cust_name = $custRow['name'];
                          }
                      ?>
                        <tr>
                          <td>
                            <?php echo $c; ?>
                          </td>
                          <td>
                            <?php echo $name; ?>
                          </td>
                          <td>
                            <?php echo $cust_name; ?>
                          </td>
                          <td>
                            <?php echo $quantity; ?>
                          </td>
                          <td class="text-primary">
                            <?php echo ($price * $quantity); ?>
                          </td>
                        </tr>
                        <?php $c++; } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="card card-plain">
                <div class="card-header card-header-primary">
                  <h4 class="card-title mt-0">Stock Management</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead class="">
                        <th>
                          ID
                        </th>
                        <th>
                          Item Name
                        </th>
                        <th>
                          <!-- TODO:: need reference from order table -->
                          Quantity (KG)
                        </th>
                        <th>
                          Price (/kg)
                        </th>
                        <th>
                          <a class="btn btn-info" onclick="showOptions()">Edit</a>
                        </th>
                      </thead>
                      <tbody>
                        <?php 
                          $result = mysqli_query($con, "SELECT * FROM stock WHERE vendor_id='".$_SESSION['id']."'");
                          while($row=mysqli_fetch_array($result)) {
                        ?>
                        <tr>
                          <td>
                            <?php echo $row['id']; ?>
                            <input type="hidden" class="checkID" value="<?php echo $row['id']; ?>">
                          </td>
                          <td>
                            <?php echo $row['name']; ?>
                          </td>
                          <td>
                            <span class="showQuantity common"><?php echo $row['quantity']; ?></span>
                                <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>" style="display: none;" class="editQuantity common">
                          </td>
                          <td>
                            <span class="showPrice common"><?php echo $row['price']; ?></span>
                                <input type="text" name="price" value="<?php echo $row['price']; ?>"  style="display: none;" class="editPrice common">
                          </td>
                          <td>
                            <form action="../../Forms/deleteStock.php" method="get">
                              <button type="submit" name="id" value="<?php echo $row['id']; ?>" class="btn btn-danger">Delete</button>
                            </form>
                            <button name="editStock" onclick="saveChanges()" class="showSaveButton common btn btn-primary" style="display: none;">Save Changes</button>
                            <div style="display: none;">
                            <?php 
                                  $counter = 1;
                                  for($i = $counter; $i <= mysqli_num_rows($result); $i++) {
                            ?>
                              <form name="edit" class="editForm" action="../../Forms/editStock.php" method="get">
                                <input type="hidden" name="id" class="editID commonForm" value="<?php echo $row['id']; ?>">
                                <input type="text" name="quantity">
                                <input type="text" name="price">
                                <input type="hidden" class="counterValue" value="<?php echo $counter; ?>">
                              </form>
                              <?php } ?>
                            </div>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid">
          <nav class="float-left">
            <ul>
              <li>
                <a href="#">
                  About Us
                </a>
              </li>
              <li>
                <a href="#">
                  Blog
                </a>
              </li>
            </ul>
          </nav>
          <div class="copyright float-right">
            &copy;
            <script>
              document.write(new Date().getFullYear())

              // edit button options

              function showOptions() {
                var elements = document.getElementsByClassName('common').length;
                var i;
                for(i=0; i<elements; i++) {
                  document.getElementsByClassName('showQuantity')[i].style.display = 'none';
                  document.getElementsByClassName('editQuantity')[i].style.display = 'inline-block';
                  document.getElementsByClassName('showPrice')[i].style.display = 'none';
                  document.getElementsByClassName('editPrice')[i].style.display = 'inline-block';
                  document.getElementsByClassName('showSaveButton')[i].style.display = 'inline-block';
                }
              }

              function saveChanges() {
                var elements = document.getElementsByClassName('commonForm').length;
                var counter = document.getElementsByClassName('counterValue').length;
                var i;
                for(i=0; i<=(counter-1); i++) {
                  var checkID = document.getElementsByClassName('checkID')[i].value;
                  var id = document.getElementsByClassName('editID')[i].value;
                  var quantity = document.getElementsByClassName('editQuantity')[i].value;
                  var price = document.getElementsByClassName('editPrice')[i].value;
                  // var editElements = document.getElementsByClassName('commonForm').length;
                  form = document.getElementsByClassName('editForm')[i];
                  form.elements[0].value = id;
                  form.elements[1].value = quantity;
                  form.elements[2].value = price;
                  // console.log(form.elements[0].value + " " + form.elements[1].value);
                  document.getElementsByClassName('showQuantity')[i].style.display = 'inline-block';
                  document.getElementsByClassName('editQuantity')[i].style.display = 'none';
                  document.getElementsByClassName('showPrice')[i].style.display = 'inline-block';
                  document.getElementsByClassName('editPrice')[i].style.display = 'none';
                  document.getElementsByClassName('showSaveButton')[i].style.display = 'none';
                  // console.log(id + " " + checkID)
                    if(id == checkID) {
                      form.submit();
                      // console.log(id + " " + checkID);
                      break;
                    }
                  }
                // form.submit();
              }

            </script>Made by <i class="material-icons">Farmer Forum</i>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap-material-design.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Plugin for the momentJs  -->
  <script src="../assets/js/plugins/moment.min.js"></script>
  <!--  Plugin for Sweet Alert -->
  <script src="../assets/js/plugins/sweetalert2.js"></script>
  <!-- Forms Validations Plugin -->
  <script src="../assets/js/plugins/jquery.validate.min.js"></script>
  <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
  <script src="../assets/js/plugins/jquery.bootstrap-wizard.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="../assets/js/plugins/bootstrap-selectpicker.js"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="../assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
  <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
  <script src="../assets/js/plugins/jquery.dataTables.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="../assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
  <script src="../assets/js/plugins/jasny-bootstrap.min.js"></script>
  <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
  <script src="../assets/js/plugins/fullcalendar.min.js"></script>
  <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
  <script src="../assets/js/plugins/jquery-jvectormap.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="../assets/js/plugins/nouislider.min.js"></script>
  <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
  <!-- Library for adding dinamically elements -->
  <script src="../assets/js/plugins/arrive.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chartist JS -->
  <script src="../assets/js/plugins/chartist.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
  <!-- Material Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');

        $sidebar_img_container = $sidebar.find('.sidebar-background');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

        if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
          if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
            $('.fixed-plugin .dropdown').addClass('open');
          }

        }

        $('.fixed-plugin a').click(function(event) {
          // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .active-color span').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-color', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data-color', new_color);
          }
        });

        $('.fixed-plugin .background-color .badge').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('background-color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data-background-color', new_color);
          }
        });

        $('.fixed-plugin .img-holder').click(function() {
          $full_page_background = $('.full-page-background');

          $(this).parent('li').siblings().removeClass('active');
          $(this).parent('li').addClass('active');


          var new_image = $(this).find("img").attr('src');

          if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            $sidebar_img_container.fadeOut('fast', function() {
              $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
              $sidebar_img_container.fadeIn('fast');
            });
          }

          if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $full_page_background.fadeOut('fast', function() {
              $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
              $full_page_background.fadeIn('fast');
            });
          }

          if ($('.switch-sidebar-image input:checked').length == 0) {
            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
          }
        });

        $('.switch-sidebar-image input').change(function() {
          $full_page_background = $('.full-page-background');

          $input = $(this);

          if ($input.is(':checked')) {
            if ($sidebar_img_container.length != 0) {
              $sidebar_img_container.fadeIn('fast');
              $sidebar.attr('data-image', '#');
            }

            if ($full_page_background.length != 0) {
              $full_page_background.fadeIn('fast');
              $full_page.attr('data-image', '#');
            }

            background_image = true;
          } else {
            if ($sidebar_img_container.length != 0) {
              $sidebar.removeAttr('data-image');
              $sidebar_img_container.fadeOut('fast');
            }

            if ($full_page_background.length != 0) {
              $full_page.removeAttr('data-image', '#');
              $full_page_background.fadeOut('fast');
            }

            background_image = false;
          }
        });

        $('.switch-sidebar-mini input').change(function() {
          $body = $('body');

          $input = $(this);

          if (md.misc.sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            md.misc.sidebar_mini_active = false;

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

          } else {

            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

            setTimeout(function() {
              $('body').addClass('sidebar-mini');

              md.misc.sidebar_mini_active = true;
            }, 300);
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);

        });
      });
    });
  </script>
</body>

</html>
