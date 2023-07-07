<?php 
function createEmail($values,$images) {
	
	$palette = [
		"light-pink" => "#FED1EE",
		"pink" => "#ff8ad8",
		"light-blue" => "#b0d3ed",
		"blue" => "#6e91db",
		"optimo" => "#f3f222",
		"normal" => "#94cd52",
		"alto" => "#fec001",
		"elevado" => "#fe0000",

		"delgadez-sobrepeso" => "ffffc7",
		"delgadez-obesidad" => "ffc1bb",
		"obesidad-alta" => "fe8f82",
	];
	
	$colors = [
		"primary" => $palette["pink"],
		"bg" => $palette["light-pink"],
		"imc" => $palette["normal"],
		"%-grasa" => $palette["optimo"],
		"cintura" => $palette["normal"],
	];

		$genderImg = $images["woman"];
		$imcImg = $images["imc"];
		$caloriasImg = $images["calorias-woman"];
		$grasaImg = $images["grasa-woman"];
		$proteinasImg = $images["proteinas-woman"];


		if( $values["imc"] >= 40 ) {
			$colors["imc"] = $palette["obesidad-alta"];
		} else if ( $values["imc"] >= 30 && $values["imc"] <= 39.9) {
			$colors["imc"] = $palette["delgadez-obesidad"];
		} else if ( $values["imc"] >= 25 && $values["imc"] <= 29.9 ) {
			$colors["imc"] = $palette["delgadez-sobrepeso"];
		} else if ( $values["imc"] >= 10 && $values["imc"] <= 17.9 ) {
			$colors["imc"] = $palette["delgadez-sobrepeso"];
		} else if ( $values["imc"] <= 9.9) {
			$colors["imc"] = $palette["delgadez-obesidad"];
		}

		if( $values["sexo"] === "mujer" ) {
				if( $values["%-grasa"] >= 41 ) {
					$colors["%-grasa"] = $palette["elevado"];
				} else if ( $values["%-grasa"] >= 31 && $values["%-grasa"] <= 40 ) {
					$colors["%-grasa"] = $palette["alto"];
				} else if ( $values["%-grasa"] >= 21 && $values["%-grasa"] <= 30 ) {
					$colors["%-grasa"] = $palette["normal"];
				} 

				if( $values["cintura"] >= 87 ) {
					$colors["cintura"] = $palette["elevado"];
				} else if ( $values["cintura"] >= 80 && $values["cintura"] <= 86 ) {
					$colors["cintura"] = $palette["alto"];
				}  
		}

		if( $values["sexo"] !== "mujer" ) {
			$colors["primary"] = $palette["blue"];
			$colors["bg"] = $palette["light-blue"];

			$genderImg = $images["men"];
			$imcImg = $images["imc"];
			$caloriasImg = $images["calorias-men"];
			$grasaImg = $images["grasa-men"];
			$proteinasImg = $images["proteinas-men"];


		if( $values["%-grasa"] >= 26 ) {
			$colors["%-grasa"] = $palette["elevado"];
			} else if ( $values["%-grasa"] >= 21 && $values["%-grasa"] <= 25) {
				$colors["%-grasa"] = $palette["alto"];
			} else if ( $values["%-grasa"] >= 11 && $values["%-grasa"] <= 20 ) {
				$colors["%-grasa"] = $palette["normal"];
			} 

				if( $values["cintura"] >= 101 ) {
			$colors["cintura"] = $palette["elevado"];
			} else if ( $values["cintura"] >= 94 && $values["cintura"] <= 100 ) {
				$colors["cintura"] = $palette["alto"];
			}  
		}

	return "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>

<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
	<title>Your Message Subject or Title</title>
	<style type='text/css'>
		#outlook a {padding:0;}
		body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
		.ExternalClass {width:100%;}
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
		#backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
		img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;}
		a img {border:none;}
		.image_fix {display:block;}
		p {margin: 0;padding:5px;font-weight:bold;font-size:1.2rem;}
		h1, h2, h3, h4, h5, h6 {color: black !important;}
		h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}
		h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {
			color: red !important;
		 }
		h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
			color: purple !important;
		}
		table td {border-collapse: collapse;}
		table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
		a {color: orange;}
		@media only screen and (max-device-width: 480px) {
			a[href^='tel'], a[href^='sms'] {
						text-decoration: none;
						color: black; /* or whatever your want */
						pointer-events: none;
						cursor: default;
					}
			.mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {
						text-decoration: default;
						color: orange !important; /* or whatever your want */
						pointer-events: auto;
						cursor: default;
					}

					
		}

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
			a[href^='tel'], a[href^='sms'] {
						text-decoration: none;
						color: blue;
						pointer-events: none;
						cursor: default;
					}
			.mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {
						text-decoration: default;
						color: orange !important;
						pointer-events: auto;
						cursor: default;
					}
		}
		@media only screen and (-webkit-min-device-pixel-ratio: 2) {
			/* Put your iPhone 4g styles in here */
		}
		@media only screen and (-webkit-device-pixel-ratio:.75){
			/* Put CSS for low density (ldpi) Android layouts in here */
		}
		@media only screen and (-webkit-device-pixel-ratio:1){
			/* Put CSS for medium density (mdpi) Android layouts in here */
		}
		@media only screen and (-webkit-device-pixel-ratio:1.5){
			/* Put CSS for high density (hdpi) Android layouts in here */
		}
				@media screen and (max-width:600px) {
				.block { display: block !important; width: 100% !important; }
		}
	</style>
	<!--[if IEMobile 7]>
	<style type='text/css'>
		/* Targeting Windows Mobile */
	</style>
	<![endif]-->
	<!--[if gte mso 9]>
	<style>
		/* Target Outlook 2007 and 2010 */
	</style>
	<![endif]-->
</head>
<body>
	<table cellpadding='0' cellspacing='0' border='0' id='backgroundTable' style='background:#eee;'>
	<tr>
		<td>



		<!--table start -->
	<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='max-width:600px;border:solid 1px black;background:white; margin:5px auto'>
							<tr style='border-bottom:solid 1px black;background:{$colors["primary"]};color:white;'>
									<td class='block' align='left' valign='center' style='padding:1%; ' width='20%'>
									</td>
									<td class='block' align='left' valign='center' style='padding:1%;' width='80%'>
									 ESTUDIO CORPORAL VIRTUAL - Sexo {$values["sexo"]}
									</td>
							</tr>
							<tr>
									<td class='block' align='center' valign='center' style='padding:1%; ' width='20%'>
										<img src='{$genderImg}' style='max-width:98%;height:90px;' />
									</td>
									<td class='block' align='left' valign='center' style='padding:1%;' width='80%'>

													<!--inner table start -->
													<table cellpadding='0' cellspacing='0' border='1' align='center' role='presentation' style='width:97%;margin-bottom: 10px'>
																	<tr style=''>
																				<td align='center' valign='center' >
																					<p>
																						Nombre: {$values["nombre"]}
																					</p>
																				</td>
																				<td align='center' valign='center' >
																					<p>
																						Fecha: {$values["fecha"]}
																					</p>
																				</td>
																	</tr>
																	<tr style=''>
																				<td align='center' valign='center' >
																					<p>
																						Edad: {$values["edad"]}
																					</p>
																				</td>
																				<td align='center' valign='center' >
																					<p>
																						Estatura: {$values["estatura"]}
																					</p>
																				</td>
																	</tr>
													</table>
													<!--inner table end -->


									</td>
							</tr>
							<tr style='background:{$colors["bg"]};'>
										<td class='block' align='left' valign='center' style='padding:1%; ' width='20%'>
													
											<!--inner table start -->
													<table cellpadding='0' cellspacing='0' border='1' align='center' role='presentation' style='width:97%;margin-bottom: 10px'>
																	<tr style='border-bottom:solid 1px black;background:{$colors["primary"]};'>
																				<td align='center' valign='center' >
																					<p>
																						PESO
																					</p>
																				</td>
																	</tr>
																	<tr style='background:#fff;'>
																				<td align='center' valign='center' >
																						<p>
																								{$values["peso"]}
																						</p>
																				</td>
																	</tr>
													</table>
													<!--inner table end -->

													<!--inner table start -->
													<table cellpadding='0' cellspacing='0' border='1' align='center' role='presentation' style='width:97%;margin-bottom: 10px'>
																	<tr style='border-bottom:solid 1px black;background:{$colors["primary"]};'>
																				<td align='center' valign='center' >
																					<p>
																						IMC
																					</p>
																				</td>
																	</tr>
																	<tr style='background:{$colors["imc"]};'>
																				<td align='center' valign='center' >
																						<p>
																								{$values["imc"]}
																						</p>
																				</td>
																	</tr>
													</table>
													<!--inner table end -->
													

												</td>
												<td class='block' align='left' valign='center' style='padding:1%;' width='80%'>
																	<img src='{$imcImg}' width='98%' />
										</td>
							</tr>
			</table>
			<!--table end -->



		<!--table start -->
			<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='max-width:600px;border:solid 1px black;background:white; margin:5px auto'>
							<tr style='background:{$colors["bg"]};'>
										<td class='block' align='left' valign='center' style='padding:1%; ' width='20%'>
													
											<!--inner table start -->
													<table cellpadding='0' cellspacing='0' border='1' align='center' role='presentation' style='width:97%;margin-bottom: 10px'>
																	<tr style='border-bottom:solid 1px black;background:{$colors["primary"]};'>
																				<td align='center' valign='center' >
																					<p>
																						% GRASA
																					</p>
																				</td>
																	</tr>
																	<tr style='background:{$colors["%-grasa"]};'>
																				<td align='center' valign='center' >
																						<p>
																								{$values["%-grasa"]}
																						</p>
																				</td>
																	</tr>
													</table>
													<!--inner table end -->

													<!--inner table start -->
													<table cellpadding='0' cellspacing='0' border='1' align='center' role='presentation' style='width:97%;margin-bottom: 10px'>
																	<tr style='border-bottom:solid 1px black;background:{$colors["primary"]};'>
																				<td align='center' valign='center' >
																					<p>
																						KG GRASA
																					</p>
																				</td>
																	</tr>
																	<tr style='background:#fff;'>
																				<td align='center' valign='center' >
																						<p>
																								{$values["kg-grasa"]}
																						</p>
																				</td>
																	</tr>
													</table>
													<!--inner table end -->

										</td>
												<td class='block' align='left' valign='center' style='padding:1%;' width='80%'>
																	<img src='{$grasaImg}' width='98%' />
										</td>
							</tr>
			</table>
			<!--table end -->



		<!--table start -->
			<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='max-width:600px;border:solid 1px black;background:white; margin:5px auto'>
							<tr style='background:{$colors["bg"]};'>
										<td class='block' align='left' valign='center' style='padding:1%; ' width='20%'>
													
											<!--inner table start -->
													<table cellpadding='0' cellspacing='0' border='1' align='center' role='presentation' style='width:97%;margin-bottom: 10px'>
																	<tr style='border-bottom:solid 1px black;background:{$colors["primary"]};'>
																				<td align='center' valign='center' >
																					<p>
																						KG MÚSCULO
																					</p>
																				</td>
																	</tr>
																	<tr style='background:#fff;'>
																				<td align='center' valign='center' >
																						<p>
																								{$values["kg-musculo"]}
																						</p>
																				</td>
																	</tr>
													</table>
													<!--inner table end -->

													<!--inner table start -->
													<table cellpadding='0' cellspacing='0' border='1' align='center' role='presentation' style='width:97%;margin-bottom: 10px'>
																	<tr style='border-bottom:solid 1px black;background:{$colors["primary"]};'>
																				<td align='center' valign='center' >
																					<p>
																						PROTEINA DIARIA
																					</p>
																				</td>
																	</tr>
																	<tr style='background:#fff;'>
																				<td align='center' valign='center' >
																						<p>
																								{$values["proteina-diaria"]}
																						</p>
																				</td>
																	</tr>
													</table>
													<!--inner table end -->




										</td>
												<td class='block' align='left' valign='center' style='padding:1%;' width='80%'>
																	<img src='{$proteinasImg}' width='98%' />
										</td>
							</tr>
			</table>
			<!--table end -->

			<!--table start -->
			<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='max-width:600px;border:solid 1px black;background:white; margin:5px auto'>
							<tr style='background:{$colors["bg"]};'>
										<td class='block' align='left' valign='center' style='padding:1%; ' width='20%'>
													
											<!--inner table start -->
													<table cellpadding='0' cellspacing='0' border='1' align='center' role='presentation' style='width:97%;margin-bottom: 10px'>
																	<tr style='border-bottom:solid 1px black;background:{$colors["primary"]};'>
																				<td align='center' valign='center' >
																					<p>
																						CALORÍAS
																					</p>
																				</td>
																	</tr>
																	<tr style='background:#fff;'>
																				<td align='center' valign='center' >
																						<p>
																								{$values['calorias']}
																						</p>
																				</td>
																	</tr>
													</table>
													<!--inner table end -->

													<!--inner table start -->
													<table cellpadding='0' cellspacing='0' border='1' align='center' role='presentation' style='width:97%;margin-bottom: 10px'>
																	<tr style='border-bottom:solid 1px black;background:{$colors["primary"]};'>
																				<td align='center' valign='center' >
																					<p>
																						CINTURA
																					</p>
																				</td>
																	</tr>
																	<tr style='background:{$colors['cintura']};'>
																				<td align='center' valign='center' >
																						<p>
																								{$values["cintura"]}
																						</p>
																				</td>
																	</tr>
													</table>
													<!--inner table end -->




										</td>
												<td class='block' align='left' valign='center' style='padding:1%;' width='80%'>
																	<img src='{$caloriasImg}' width='98%' />
										</td>
							</tr>
			</table>
			<!--table end -->



		</td>
	</tr>
	</table>
	";
	}
	?>