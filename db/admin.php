<?php
include 'php/functions.php';
if (get('type') != 1) {
	echo "<script> alert('Access denied. please check again as admin'); window.location.href='index.php' </script>";
	exit();
}
?>
<!doctype html>
<html lang="en">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Admin Tracking Shipment</title>
<link rel="icon" href="img/xfavicon.png.pagespeed.ic.4ol6gLfWzM.png">
<link rel="stylesheet" href="css/bootstrap.min.css%2banimate.css%2bowl.carousel.min.css%2bthemify-icons.css%2bflaticon.css%2bslick.css%2bnice-select.css%2ball.css%2bintlInputPhone.min.css.pagespeed.cc.WNqLfgNLMY.css" />
<link rel="stylesheet" href="css/A.style.css.pagespeed.cf.fGTFytXrdz.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
		grid-template-columns: 1fr 1fr;
		background: #fff;
	}

	.adm_table_div {
		width: 100%;
		height: 50%;
		overflow: auto;
		overflow-y: auto;
		padding: 20px 0px;
	}

	.adm_table_div input,
	th {
		padding: 10px;
		margin: 10px auto;
	}

	.adm_table_div input {
		border: none;
		border-radius: 3px;
	}

	.adm_table_div input:focus {
		border: 1px solid orange;
	}

	table {
		margin-bottom: 100px;
		width: 100%;
	}

	.button_btn {
		background: blue;
		margin-left: 10px;
		border: none;
		outline: none;
		cursor: pointer;
		color: #fff;
		padding: 5px 15px;
		font-size: 16px;
	}

	@media only screen and (max-width: 570px) {
		.info_display {
			display: block;
		}
	}
</style>
</head>

<body>
	<?php
	include 'nav.php';
	?>
	<section style="padding-top: 80px; background: #000;">
		<div style="background: #fff;">
			<div style="padding: 10px;">
				<div style="text-align: right; padding: 20px;">
					<button class="button_btn" onclick="document.getElementById('add_shipment').style.display='block';document.getElementById('add_shipment').style.display='table-row';document.getElementById('add_indicator').style.opacity='1';">Add Shipment</button>
				</div>
				<div class="adm_table_div">
					<table style="width: 100%;">
						<tr>
							<th>S/N</th>
							<th>CLIENT</th>
							<th>PACKAGE</th>
							<th>DESCRIPTION</th>
							<th>TRACKING ID</th>
							<th>PACKAGE TYPE</th>
							<th>QUANTITY</th>
							<th>WEIGHT</th>
							<th>SERVICE TYPE</th>
							<th>PACKAGE STATUS</th>
							<th>BOOKING DATE</th>
							<th>ARRIVAL DATE</th>
							<th>DISPERSE ADDRESS</th>
							<th>DISPERSE COUNTRY</th>
							<th>DELEVERING ADDRESS</th>
							<th>COUNTRY DESTINATION</th>
							<th>CURRENT DESTINATION</th>
							<th>Progress</th>

							<th>Photo</th>


							<th>STATUS</th>
							<th>ACTION</th>
						</tr>
						<form enctype="multipart/form-data" action="php/add_shipment.php" method="POST" autocomplete="off">
							<p style="position: relative; margin-top: 10px; margin-bottom: -60px; font-size: 12px; color: red;opacity: 0;" id="add_indicator"><b>Add New Client Here</b></p>
							<tr style="border: 2px solid green; display: none;" id="add_shipment">
								<th>0</th>
								<td><input required id="add_first" type="text" name="reciever_name" placeholder="CLIENT NAME"></td>
								<td><input required type="text" name="package" placeholder="PACKAGE"></td>
								<td><input required type="text" name="description" placeholder="DESCRIPTION">
								<td><input onclick="alert('This would be generated autamatically  upon submistion.')" required readonly title="Cannot edit Tracking ID" type="text" name="tracking_id" value="000000"></td>
								<td><input required type="text" name="package_type" placeholder="PACKAGE TYPE"></td>
								<td><input required type="number" name="qty" placeholder="QUANTITY"></td>
								<td><input required type="text" name="weight" placeholder="WEIGHT"></td>
								<td><input required type="text" name="service_type" placeholder="SERVICE TYPE"></td>
								<td><input required type="text" name="package_status" placeholder="PACKAGE STATUS"></td>
								<td><input required type="text" name="booking_date" placeholder="BOOKING DATE"></td>
								<td><input required type="text" name="arrival_date" placeholder="ARRIVAL DATE"></td>
								<td><input required type="text" name="disperse_address" placeholder="DISPERSE ADDRESS"></td>
								<td>
									<select style="overflow-y: auto; width:200px; padding:20px; height: 30px;" required name="disperse_country">
										<option style="overflow-y: auto; width:200px; padding:20px; height: 30px;" value="">Country</option>
										<?php include 'includes/country.php'; ?>
									</select>
								</td>
								<td><input required type="text" name="delivering_to" placeholder="DELEVERING ADDRESS"></td>
								<td>
									<select style='overflow-y: auto; width:200px; padding:20px; height: 30px;' required name="delivering_country">
										<?php include 'includes/country.php'; ?>
									</select>
								</td>

								<td><input required type="text" name="current_destination" placeholder="CURRENT DESTINATION"></td>
								<td><input required type="number" name="perc" placeholder="Enter Progress number"></td>
								<td><input required type="file" name="photo"></td>
								<td>
									<select required name="status">
										<option>PENDING</option>
										<option>SHIP</option>
										<option>DELIVERED</option>
										<option>DELETED</option>
									</select>
								</td>
								<td>
									<button type="submit" name="add" class="button_btn">ADD</button>
								</td>
							</tr>
						</form>
						<?php
						function get_add_shipment()
						{
							global $db;
							$sl = "SELECT * FROM info ORDER BY id DESC";
							$qr = $db->query($sl);
							$arr = [];
							while ($row = $qr->fetch_assoc()) $arr[] = $row;
							return $arr;
						}
						$get_add_shipment = get_add_shipment();
						$count = 0;
						foreach ($get_add_shipment as $ship) {
							$count += 1;
							if ($ship['status'] == 1) {
								$status = "PENDING";
								$status1 = "SHIP";
								$status2 = "DELIVERED";
								$status3 = "DELETED";
							} else if ($ship['status'] == 2) {
								$status = "SHIP";
								$status1 = "PENDING";
								$status2 = "DELIVERED";
								$status3 = "DELETED";
							} else if ($ship['status'] == 3) {
								$status = "DELIVERED";
								$status1 = "PENDING";
								$status2 = "SHIP";
								$status3 = "DELETED";
							} else {
								$status = "UNDO";
								$status1 = "PENDING";
								$status2 = "DELIVERED";
								$status3 = "SHIP";
							}
							$real_status = $status;
						?>
							<form enctype="multipart/form-data" action="php/update_shipment.php" method="POST" autocomplete="off">
								<tr ondblclick="this.style.border='2px solid blue';">
									<th><?php echo $count ?></th>
									<td><input type="text" name="reciever_name" value="<?= $ship['reciever_name'] ?>"></td>
									<td><input type="text" name="package" value="<?= $ship['package'] ?>"></td>
									<td><input type="text" name="description" value="<?= $ship['description'] ?>"></td>
									<td><input onclick="alert('You can\'t edit tracking Id')" readonly title="Cannot edit Tracking ID" type="text" name="tracking_id" value="<?= $ship['tracking_id'] ?>"></td>
									<td><input type="text" name="package_type" value="<?= $ship['package_type'] ?>"></td>
									<td><input type="number" name="qty" value="<?= $ship['qty'] ?>"></td>
									<td><input type="text" name="weight" value="<?= $ship['weight'] ?>"></td>
									<td><input type="text" name="service_type" value="<?= $ship['service_type'] ?>"></td>
									<td><input type="text" name="package_status" value="<?= $ship['package_status'] ?>"></td>
									<td><input type="text" name="booking_date" value="<?= $ship['booking_date'] ?>"></td>
									<td><input type="text" name="arrival_date" value="<?= $ship['arrival_date'] ?>"></td>
									<td><input type="text" name="disperse_address" value="<?= $ship['disperse_address'] ?>"></td>
									<td>
										<select name="disperse_country">
											<option><?= $ship['disperse_country'] ?></option>

										</select>
									</td>
									<td><input type="text" name="delivering_to" value="<?= $ship['delivering_to'] ?>"></td>
									<td>
										<select name="delivering_country">
											<option><?= $ship['delivering_country'] ?></option>
										</select>
									</td>

									<td><input type="text" name="current_destination" value="<?= $ship['current_destination'] ?>"></td>
									<td><input type="text" name="perc" value="<?= $ship['perc'] ?>"></td>
									<td><input type="file" name="photo" value="<?= $ship['photo'] ?>"></td>

									<td>
										<p style="color: orange; font-size: 0.7em"><?= $real_status ?></p>
										<select name="status">
											<option><?= $status ?></option>
											<option><?= $status1 ?></option>
											<option><?= $status2 ?></option>
											<option><?= $status3 ?></option>
										</select>
									</td>
									<td>
										<button type="submit" name="update" class="button_btn">Save</button>
									</td>
								</tr>
							</form>
						<?php } ?>
					</table>
				</div>


			</div>
		</div>

	</section>
	

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
	
	 <!-- Live Chat Starts Here -->

<!-- Live Chat Ends Here -->
</body>

</html>