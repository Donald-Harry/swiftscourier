<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'php/functions.php';

if (isset($_POST['tracking_id']) || isset($_SESSION['tracking_id'])) {
  $tracking_id = sanitize($_POST['tracking_id']);
  if (isset($_SESSION['tracking_id']) && empty($_POST['tracking_id'])) {
    $tracking_id = $_SESSION['tracking_id'];
  }

  $sql = "SELECT * FROM info WHERE tracking_id = '$tracking_id'";
  $result = $db->query($sql);
  if ($result->num_rows !== 0) {
    $row = $result->fetch_assoc();

    $_SESSION['tracking_id'] = $row['tracking_id'];
    if ($row['type'] == 1) {
      echo "<script>window.location.href='admin.php'</script>";
      exit();
    }
  } else {
    echo "<script>alert('Tracking ID Not Found'); window.location.href='../index.php'</script>";
    exit();
  }
} else {

  $_SESSION['errorr'] = "Please Enter tracking id";
  echo '<script>window.location.href="index.php?#that_input";</script>';
  exit();
}


?>

<!doctype html>
<html lang="en">


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Tracking Shipment</title>
<link rel="icon" href="img/xbps.png">
<link rel="stylesheet" href="../css/styles.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://kit.fontawesome.com/765557ebc1.js" crossorigin="anonymous"></script>
<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
<script src="../js/script.js" defer></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="css/bootstrap.min.css%2banimate.css%2bowl.carousel.min.css%2bthemify-icons.css%2bflaticon.css%2bslick.css%2bnice-select.css%2ball.css%2bintlInputPhone.min.css.pagespeed.cc.WNqLfgNLMY.css" />
<link rel="stylesheet" href="css/A.style.css.pagespeed.cf.fGTFytXrdz.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.3/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw5f+ua7R/WRHXxgHX6s5P5jg5od5ShfEqt/rRgcJoXfFq4x0p8HbYUew+OrCx" crossorigin="anonymous"></script>

<script nonce="a7e649c2-4f78-436d-9c4d-8c4aa4fcf7ed">
  (function(w, d) {
    ! function(a, e, t, r) {
      a.zarazData = a.zarazData || {}, a.zarazData.executed = [], a.zaraz = {
        deferred: []
      }, a.zaraz.q = [], a.zaraz._f = function(e) {
        return function() {
          var t = Array.prototype.slice.call(arguments);
          a.zaraz.q.push({
            m: e,
            a: t
          })
        }
      };
      for (const e of ["track", "set", "ecommerce", "debug"]) a.zaraz[e] = a.zaraz._f(e);
      a.addEventListener("DOMContentLoaded", (() => {
        var t = e.getElementsByTagName(r)[0],
          z = e.createElement(r),
          n = e.getElementsByTagName("title")[0];
        for (a.zarazData.c = e.cookie, n && (a.zarazData.t = e.getElementsByTagName("title")[0].text), a.zarazData.w = a.screen.width, a.zarazData.h = a.screen.height, a.zarazData.j = a.innerHeight, a.zarazData.e = a.innerWidth, a.zarazData.l = a.location.href, a.zarazData.r = e.referrer, a.zarazData.k = a.screen.colorDepth, a.zarazData.n = e.characterSet, a.zarazData.o = (new Date).getTimezoneOffset(), a.zarazData.q = []; a.zaraz.q.length;) {
          const e = a.zaraz.q.shift();
          a.zarazData.q.push(e)
        }
        z.defer = !0, z.referrerPolicy = "origin", z.src = "../../cdn-cgi/zaraz/sd0d9.js?z=" + btoa(encodeURIComponent(JSON.stringify(a.zarazData))), t.parentNode.insertBefore(z, t)
      }))
    }(w, d, 0, "script");
  })(window, document);
</script>

<style type="text/css">
  .info_display {
    display: grid;
  }

  tr {
    width: 100%;
  }

  td {
    width: 50%;
    padding: 10px;
    border-bottom: 1px dashed blue;
  }

  table {
    border: 1px solid blue;
  }

  .tracking_position {
    width: 2px;
    background: transparent;
    height: 626px;
    border-radius: 2px;
    border: 2px solid #fff;
    ;
    /*		background-image: linear-gradient(to bottom, #333 10%, rgba(255, 255, 255,0)0%);
		background-position: left;
		background-size: 1px 10px;
		background-repeat: repeat-y;
*/
  }

  .dot,
  .dot_1,
  .dot_2 {
    position: relative;
    width: 25px;
    height: 25px;
    margin-left: -11px;
    margin-top: -2px;
    background: #fff;
    border-radius: 50%;
    border: 2px double grey;
  }

  .dot_1 {
    top: -362px;
  }

  .dot_2 {
    top: -683px;
  }

  .progress_div {
    padding: 20px;
    padding-top: 43px;
    height: 794px;
  }

  .indicator,
  .indicator1,
  .indicator2 {
    width: 80%;
    height: 80%;
    margin: auto;
    border-radius: 50%;
    margin-top: 2px;
  }

  .indicator {
    background: lightgrey;
  }

  .indicator1 {
    background: orange;
  }

  .indicator2 {
    background: #00000096;
  }

  .curr_ent {
    background: green;
    animation: heading;
    animation-duration: 1s;
    animation-fill-mode: forwards;
    animation-iteration-count: infinite;
  }

  @keyframes heading {
    0% {
      background: #fff;
    }

    50% {
      background: green;
    }

    100% {
      background: #fff;
    }
  }

  @media only screen and (max-width: 570px) {
    .progress_div {
      padding: 20px;
      padding-top: 36px;
    }

    .info_display {
      display: block;
    }
  }

  .truck-icon {
    animation: truck 2s ease-in-out;
  }

  @keyframes truck {
    0% {
      left: 0;
    }

    100% {
      left: 100%;
    }
  }
</style>
</head>

<body style="background: #212529;">

  <style>
    .fas {
      color: white;
      margin: 10px;
      border-radius: 100px;
      background: #0fb7a2;
      padding: 16px;
      font-size: 40px;
    }
  </style>

  <body>


    <div class="container" style="padding: 20px;
    background: #858282;
    border-radius: 10px;">
      <div>
        <ul style="display: flex;">
          <li style="float: left;"><i class="fas fa-truck"></i></li>

          <li style="float: right;margin-top: 10px;">
            <h2> Swifts<br>Express</h2>
          </li>
        </ul>
      </div>

      <hr>
      <div style="display: flex;">
        <ul style="float: left; width: 50%;">
          <li style="font-weight: bold;">From:</li>
          <li style="color: white;
    border-radius: 10px;
    margin: 5px 0px;
    padding: 5px;
    background: linear-gradient(89deg, #212529, rgb(204 204 204));"></i>
            <?= get('disperse_address') ?></li>
          <li style="color: white;
    border-radius: 10px;
    margin: 5px 0px;
    padding: 5px;
    background: linear-gradient(89deg, #212529, rgb(204 204 204));"><?= get('disperse_country') ?></li>
        </ul>
        <ul style="float: right; width: 50%;">
          <li style="font-weight: bold;">To:</li>
          <li style="
    color: white;
    border-radius: 10px;
    margin: 5px 0px;
    padding: 5px;
    background: linear-gradient(89deg, #0fb7a2, rgb(204 204 204));"><?= get('delivering_to') ?></li>
          <li style="
    color: white;
    border-radius: 10px;
    margin: 5px 0px;
    padding: 5px;
    background: linear-gradient(89deg, #3b5d96, rgb(204 204 204));
    "><?= get('delivering_country') ?></li>
        </ul>
      </div>
    </div>
    <div class="container">
      <h1 style="color: #fff;">Your Order is Being Shipped</h1>
      <p>Your order is currently <?= get('perc') ?>% complete.</p>
      <div style="border-radius: 10px;
    height: 20px;" class="progress">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: <?= get('perc') ?>%">
          <div class="progress-bar-water"></div>
        </div>
      </div>
    </div>

    <style>
      .progress {
        margin-bottom: 20px;
      }

      .progress-bar {
        background-color: #fac904;
        color: #000;
        border-radius: 4px;
      }

      .progress-bar-water {
        background-image: linear-gradient(to right, #000, #000, #fac904, #000);
        animation: water 2s infinite;
      }

      @keyframes water {
        0% {
          background-position: 0 0;
        }

        50% {
          background-position: 100% 0;
        }

        100% {
          background-position: 0 0;
        }
      }

      .progress-bar-animated {
        -webkit-animation: progress-bar-stripes 2s linear infinite;
        -moz-animation: progress-bar-stripes 2s linear infinite;
        -o-animation: progress-bar-stripes 2s linear infinite;
        animation: progress-bar-stripes 2s linear infinite;
      }

      @keyframes progress-bar-stripes {
        from {
          background-image: linear-gradient(45deg, #fac904 25%, #000 25%, #000 50%, #fac904 50%, #fac904 75%, #000 75%, #000 100%);
        }

        to {
          background-image: linear-gradient(45deg, #000 25%, #fac904 25%, #fac904 50%, #000 50%, #000 75%, #fac904 75%, #fac904 100%);
        }
      }
    </style>


    <section style="padding-top: 40px;">

      <div class="container">
        <div class="row">
          <div class="col-md-6">

            <div class="info_display">
              <div style="background: linear-gradient(to left, #415094, #ffcc00); padding: 20px; border-radius: 20px;">
                <h3 class="text-white">Your Package Info</h3>
                <p><i class="fa fa-gift" style="font-size: 18px; color: #fff"></i></p>
                <p style="font-size: 12px; color: #ddd; border-bottom: 1px solid #6345fe; margin-bottom: 10px;">Tracking No: <?= get('tracking_id'); ?></p>
                <table style="color: #d7d7d7; background: linear-gradient(to left, #333, #000);" class="table  table-dark">
                  <tr>
                    <th>PACKAGE</th>
                    <td><?= get('package') ?></td>
                  </tr>
                  <tr>
                    <th>DESCRIPTION</th>
                    <td><?= get('description') ?></td>
                  </tr>
                  <tr>
                    <th>PRODUCT ID</th>
                    <td><?= get('tracking_id') ?></td>
                  </tr>
                  <tr>
                    <th>PACKAGE TYPE</th>
                    <td><?= get('package_TYPE') ?></td>
                  </tr>
                  <tr>
                    <th>QUANTITY</th>
                    <td><?= get('qty') ?></td>
                  </tr>
                  <tr>
                    <th>WEIGHT</th>
                    <td><?= number_format(get('weight'), 2) ?>kg</td>
                  </tr>
                  <tr>
                    <th>SERVICE TYPE</th>
                    <td><?= get('service_type') ?></td>
                  </tr>
                  <tr>
                    <th>STATUS</th>
                    <td><?= get('package_status') ?></td>
                  </tr>
                  <tr>
                    <th>BOOKING DATE</th>
                    <td><?= get('booking_date') ?></td>
                  </tr>
                  <tr>
                    <th>ARRIVAL DATE</th>
                    <td><?= get('arrival_date') ?></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <p style="font-weight: bold;
    color: #212529;
    margin: 10px;
    background: #cccccc;
    padding: 20px;"><span style="padding: 10px;
  background: #08c4a4;">
                Shipping History
              </span>


            </p>
            <div class="progress_div">
              <div class="tracking_position">
              </div>
              <div class="dot">

                <div class="indicator <?php if (get('status') == 3) {
                                        echo 'curr_ent';
                                      } ?>"></div>
              </div>

              <div class="dot_1">
                <div class="indicator1 <?php if (get('status') == 2) {
                                          echo 'curr_ent';
                                        } ?>"></div>
              </div>

              <div class="dot_2">
                <div class="indicator2 <?php if (get('status') == 1) {
                                          echo 'curr_ent';
                                        } ?>"></div>
              </div>
              <div style="position: relative; top: -720px;padding: 0px 25px; box-shadow: 10px 10px 6px 5px #cccccc94;">
                <p style="font-size: 0.8em; 
    border-radius: 10px;
    padding: 10px 12px;
    background: #cccccc;
    font-size: 0.8em;
    color: #212529;">
                  FROM</p>
                <p style="padding: 0px 10px;
    color: white;"><?= get('booking_date') ?></p>
                <p style="background: white;
    border-radius: 5px;
    padding: 5px;
    margin: 10px;
    border: 1px solid #cccccc;">
                  <?= get('disperse_address') ?></p>
                <p style="color: #fd7e14; ">
                  <?= get('disperse_country') ?></p>
              </div>
              <div style="position: relative; top: -562px;padding: 0px 25px; box-shadow: 10px 10px 5px 5px #f1f1f175;; ">
                <p style="font-size: 0.8em; color: grey;">CURRENTLY IN</p>
                <p style="background: white;
    border-radius: 5px;
    padding: 5px;
    margin: 10px;
    border: 1px solid #cccccc;"><?= get('current_destination') ?></p>
                <p style="margin: 10px;
    padding: -1px 22px;
    width: 50%;
    background: #2b0909;
    color: #fd7e14;"><?= get('package_status') ?></p>
              </div>
              <div style="position: relative; top: -397px;padding: 0px 25px; box-shadow: 10px 10px 5px 0px #77bb77; ">
                <p style="font-size: 0.8em; 
    border-radius: 10px;
    padding: 10px 12px;
    background: #77bb77;
    font-size: 0.8em;
    color: #212529;">TO</p>
                <p style="padding: 0px 10px;
    color: white;"><?= get('arrival_date') ?></p>

                <p><?= get('delivering_to') ?></p>
                <p style="color: #fd7e14;"><?= get('delivering_country') ?></p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <style>
      .image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;

      }

      .frame {
        position: absolute;
        top: 0;
        left: 0;
        max-width: 70%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;

      }

      .frame h3 {
        color: white;
        font-size: 1.5rem;
        margin: 0;
      }
    </style>
    <section>
      <div class="image-container">
        <img style="border: 10px solid floralwhite; max-width: 70%;" src="uploads/<?= get('photo') ?>" alt="package photo">

      </div>
    </section>


    <div id="map" style="height: 400px; width: 500px; margin: auto;"></div>

    <script>
      var map = L.map('map').setView([0, 0], 3); // Initial coordinates (latitude, longitude) and zoom level

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
      }).addTo(map);

      var countryName = "<?= get('current_destination') ?>";

      if (countryName) {
        // Use a geocoding service to convert the country name into coordinates
        fetch('https://nominatim.openstreetmap.org/search?format=json&q=' + countryName)
          .then(response => response.json())
          .then(data => {
            if (data.length > 0) {
              var latitude = parseFloat(data[0].lat);
              var longitude = parseFloat(data[0].lon);

              var marker = L.marker([latitude, longitude]).addTo(map);
              map.setView([latitude, longitude], 6); // Adjust the zoom level as needed
            } else {
              alert('Country not found.');
            }
          })
          .catch(error => {
            console.error('Error:', error);
          });
      }
    </script>

    <?php include "../footer.php"
    ?>


    <script src="js/jquery-1.12.1.min.js"></script>

    <script src="js/popper.min.js%2bbootstrap.min.js.pagespeed.jc.LKWtDHPWPS.js"></script>
    <script>
      eval(mod_pagespeed_CUTY2hLpTk);
    </script>

    <script>
      eval(mod_pagespeed_wRQBYJaI$a);
    </script>

    <script src="js/jquery.magnific-popup.js%2bmasonry.pkgd.js.pagespeed.jc.7pgdBQf2rE.js"></script>
    <script>
      eval(mod_pagespeed_zg7eA38Qhj);
    </script>

    <script>
      eval(mod_pagespeed_tW5sxDBeWi);
    </script>

    <script src="js/owl.carousel.min.js"></script>

    <script src="js/gijgo.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/intlInputPhone.min.js"></script>

    <script src="js/jquery.ajaxchimp.min.js%2bjquery.form.js%2bjquery.validate.min.js%2bmail-script.js%2bcontact.js%2bcustom.js.pagespeed.jc.gluAe1vgNY.js"></script>
    <script>
      eval(mod_pagespeed_TLJfk8ljIZ);
    </script>
    <script>
      eval(mod_pagespeed_93Bf1mo$HF);
    </script>
    <script>
      eval(mod_pagespeed_PvP9UDGZsA);
    </script>
    <script>
      eval(mod_pagespeed_12zv6r3LZ0);
    </script>
    <script>
      eval(mod_pagespeed_wCsNvbfkPC);
    </script>

    <script>
      eval(mod_pagespeed_nENxee0pfk);
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());

      gtag('config', 'UA-23581568-13');
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"6fdcd1bb28d15989","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2021.12.0","si":100}' crossorigin="anonymous"></script>
    <script>
      const truck = document.querySelector(".fas.fa-truck");
      const truckSpeed = 10;

      function animateTruck() {
        truck.style.left = truck.offsetLeft + truckSpeed + "px";

        if (truck.offsetLeft >= window.innerWidth) {
          truck.style.left = 0;
        }
      }

      setInterval(animateTruck, 100);
    </script>
    <script>
      var text = document.getElementById("text");

      function shake() {
        text.classList.add("shake");
        setTimeout(function() {
          text.classList.remove("shake");
        }, 200);
      }

      setInterval(shake, 20000);
    </script>



 <!-- Live Chat Starts Here -->

<!-- Live Chat Ends Here -->
  </body>

</html>