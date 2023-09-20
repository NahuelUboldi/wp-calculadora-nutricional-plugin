<?php 
function createEmail($values,$images) {

$nombre = $values['nombre'];
$fecha = $values['fecha'];
$edad = $values['edad'];
$estatura = $values['estatura'];
$sexo = $values["sexo"];
$peso = $values["peso"];
$imc = $values["imc"];
$grasa_porcentaje = $values["%-grasa"];
$grasa_kg = $values["kg-grasa"];
$musculo_kg = $values["kg-musculo"];
$proteina_diaria = $values["proteina-diaria"];
$calorias = $values["calorias"];
$cintura = $values["cintura"];

$rounded_borders = "border-radius:1rem; border-collapse: separate;border-spacing: 0;overflow: hidden;";
	
$palette = [
	"cream" => '#e1ccad',
	"purple" => '#774978',
	"light-purple" => '#8c6292',
	"light-blue" => '#25a6ce',
	"pink" => '#fa7576',
	"red" => '#ff5754',
	"orange" => '#f85b00',
	"yellow" => '#fabf00',
	"green" => '#82d55f',
  "gray" => '#eee'
];
	
$colors = [
	"bg-light" => $palette["cream"],
	"bg-dark" => $palette["purple"],
  "mujer" => $palette["pink"],
  "hombre" => $palette["light-blue"],
  "red" => $palette["red"],
	"orange" => $palette["orange"],
	"yellow" => $palette["yellow"],
	"green" => $palette["green"],
	"gray" => $palette["gray"],
];

function createList($array,$imc,$text_color) {
	$result = "";

	foreach ($array as $key => $value) {
		$min = $value[0];
		$max = $value[1];
		$text = $value[2];
		$color = $value[3];
		if($imc >= $min && $imc <= $max) {
			$result .= "
			<li style='font-size:1.5rem;line-height:2rem;'>
				<span style='font-size:1.5rem;line-height:2rem;color:{$color};-webkit-text-stroke-width: 1.5px;-webkit-text-stroke-color: white;'>► ⬤ </span>
				<span style='font-size:1.5rem;line-height:2rem;color:{$text_color}'>{$text} </span>
			</li>";
		} else {
			$result .= "
			<li style='color:{$text_color};opacity:0.5;font-size:1.5rem;line-height:2rem;'>
				<span style='font-size:1.5rem;line-height:2rem;visibility:hidden;opacity:0;'> ► </span>
				<span style='font-size:1.5rem;line-height:2rem;'>
					⬤ {$text}
				</span>
			</li>";
		}
	}

	return $result;
}

function createColor($array,$imc) {
	$result = "";

	foreach ($array as $key => $value) {
		$min = $value[0];
		$max = $value[1];
		$color = $value[3];
		if($imc >= $min && $imc <= $max) {
			$result = $color;
		}
	}

	return $result;
}

$imc_values = [
	[0,9.9, "Menos de diez: DELGADEZ EXTREMA",$colors["orange"]],
	[10,17.9, "10 a 17: BAJO PESO",$colors["yellow"]] ,
	[18,24.9, "18 a 24: PESO ADECUADO PARA TU ESTATURA",$colors["green"]],
	[25,29.9, "25 a 29: SOBREPESO",$colors["yellow"]],
	[30,34.9, "30 a 35: OBESIDAD I",$colors["orange"]],
	[35,40.9, "35 a 40: OBESIDAD II",$colors["orange"]],
	[40,INF, "40 o más: OBESIDAD III",$colors["red"]]
];

$grasa_porcentaje_values = [
      [0,9.9, "ÓPTIMO",$colors["yellow"]],
      [10,19.9, "NORMAL",$colors["green"]] ,
      [20,25.9, "ALTO",$colors["orange"]],
      [26,INF, "ELEVADO",$colors["red"]],

];
$cintura_values = [
      [0,79.9, "NORMAL",$colors["green"]] ,
      [80,86.9, "ALTO",$colors["orange"]],
      [87,INF, "ELEVADO",$colors["red"]],
];

$imc_list = createList($imc_values,$imc,'white');
$imc_color = createColor($imc_values,$imc);
$grasa_porcentaje_list = createList($grasa_porcentaje_values,$grasa_porcentaje,$colors['bg-dark']);
$grasa_porcentaje_color = createColor($grasa_porcentaje_values,$grasa_porcentaje);
$cintura_list = createList($cintura_values,$cintura,$colors['bg-dark']);
$cintura_color = createColor($cintura_values,$cintura);


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
		p {margin: 0;padding:5px;font-weight:bold;}
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

				<!-- USER DATA TABLE -->
				<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;border:solid 1px white;background:{$colors["bg-dark"]};color:white; margin:5px auto;{$rounded_borders}'>
					<tr style='border:none;'>
						<td class='block' align='center' valign='center' style='padding:20px;font-weight:bold;font-size:1.5rem;line-height:2rem;border:none;'>
							<h1 class='font-size:32px;margin:0px;padding:0px;'><span style='color:white;'>Estudio Corporal Virtual</span></h1>
						</td>
					</tr>
					<tr>
						<td class='block' align='left' valign='center' style='padding:0px 20px;' >

							<!--inner table start -->
							<table border='0' align='center' role='presentation' style='width:100%;margin-bottom: 10px;border-collapse: separate;border-spacing: 15px;border:none;'>
								<tr style='border:none;'>
									<td align='center' valign='center' style='padding:10px;background:white;{$rounded_borders};color:{$colors['bg-dark']}'>
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;'>
											Nombre: {$nombre}
										</p>
									</td>
									<td align='center' valign='center' style='padding:10px;background:white;{$rounded_borders};color:{$colors['bg-dark']}'>
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;'>
											Fecha: {$fecha}
										</p>
									</td>
								</tr>
								<tr style='border:none;'>
									<td align='center' valign='center' style='padding:10px;background:white;{$rounded_borders};color:{$colors['bg-dark']}'>
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;'>
											Edad: {$edad}
										</p>
									</td>
									<td align='center' valign='center' style='padding:10px;background:white;{$rounded_borders};color:{$colors['bg-dark']}'>
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;'>
											Estatura: {$estatura}
										</p>
									</td>
								</tr>
							</table>
							<!--inner table end -->

						</td>
					</tr>
							
				</table>
				<!--table end -->


				<!--PESO / IMC TABLE -->
				<!--table start -->
				<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;border:solid 1px white;{$rounded_borders}background:{$colors["$sexo"]}; margin:5px auto'>
					<tr style='border:none;;'>
						<td class='block' align='left' valign='center' style='padding:1%; border:none; ' width='20%'>
															
							<!--inner table start -->
							<table border='1' align='center' role='presentation' style='border:none;width:100%;margin-bottom: 10px;background:white;color:black; margin:5px auto;{$rounded_borders}'>
								<tr style='border:none;border-bottom:solid 1px black;'>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;'>
											PESO
										</p>
									</td>
								</tr>
								<tr>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;'>
											{$peso} Kg.
										</p>
									</td>
								</tr>
							</table>
							<!--inner table end -->

							<!--inner table start -->
							<table border='1' align='center' valign='center' role='presentation' style='border:none;width:100%;margin-bottom: 10px;background:white;color:black; margin:5px auto;{$rounded_borders}'>
								<tr style='border-bottom:solid 1px black;border:none;'>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;'>
											IMC
										</p>
									</td>
								</tr>
								<tr style='border:none;background:{$imc_color}'>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;text-shadow:1px 1px 0 #fff,-1px 1px 0 #fff,-1px -1px 0 #fff,1px -1px 0 #fff;'>
											{$imc}
									</td>
								</tr>
							</table>
							<!--inner table end -->

						</td>
						<td class='block' align='left' valign='center' style='padding:1%;' width='80%'>
							<ul style='list-style:none;font-weight:bold;margin:0 20px;line-height:2rem;'>
							{$imc_list}
							</ul>
						</td>
					</tr>
				</table>
				<!--table end -->

				<!--GRASA TABLE -->
				<!--table start -->
				<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;border:solid 1px white;{$rounded_borders}background:{$colors['bg-light']}; margin:5px auto'>
					<tr style='border:none;'>
						<td class='block' align='left' valign='center' style='padding:1%; border:none;' width='20%'>
															
							<!--inner table start -->
							<table border='1' align='center' role='presentation' style='border:none;width:100%;margin-bottom: 10px;background:white;color:black; margin:5px auto;{$rounded_borders}'>
								<tr style='border:none;border-bottom:solid 1px black;'>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;'>
											KG GRASA
										</p>
									</td>
								</tr>
								<tr style='border:none;'>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;'>
											{$grasa_kg} Kg.
										</p>
									</td>
								</tr>
							</table>
							<!--inner table end -->

							<!--inner table start -->
							<table border='1' align='center' valign='center' role='presentation' style='border:none;width:100%;margin-bottom: 10px;background:white;color:black; margin:5px auto;{$rounded_borders}'>
								<tr style='border:none;border-bottom:solid 1px black;'>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;'>
											GRASA
										</p>
									</td>
								</tr>
								<tr style='border:none;background:{$grasa_porcentaje_color}'>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;text-shadow:1px 1px 0 #fff,-1px 1px 0 #fff,-1px -1px 0 #fff,1px -1px 0 #fff;'>
											{$grasa_porcentaje}
									</td>
								</tr>
							</table>
							<!--inner table end -->
						</td>

						<td class='block' align='left' valign='center' style='padding:1%;border:none !important;' width='40%'>
							<ul style='list-style:none;font-weight:bold;margin:0 20px;line-height:2rem;'>
								{$grasa_porcentaje_list}
							</ul>
						</td>

						<td class='block' align='center' valign='center' style='padding:30px;border:none !important;' width='40%'>

							<!--inner table start -->
							<table border='1' align='center' valign='center' role='presentation' style='border:none;width:100%;margin-bottom: 10px;background:white;color:black; margin:5px auto;{$rounded_borders}'>
								<tr style='border:none;border-bottom:solid 1px black;'>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;padding:30px 20px;line-height:2rem;' height='100%'>
											¡ATENCIÓN!<br> El exceso de grasa es perjudicial para la salud
										</p>
									</td>
								</tr>
							</table>
							<!--inner table end -->

						</td>
					</tr>
				</table>
				<!--table end -->


				<!--MÚSCULOS TABLE -->
				<!--table start -->
				<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;border:solid 1px white;{$rounded_borders}background:{$colors['bg-light']}; margin:5px auto'>
					<tr style='border:none;'>
						<td class='block' align='left' valign='center' style='padding:1%;font-weight:bold;font-size:1.4rem;; border:none;' width='60%'>
							<span style='display:block;line-height:2rem;background:white;color:{$colors['bg-dark']};{$rounded_borders}padding:10px;'>
								En este momento tienes <span style='color:black'>{$musculo_kg}</span> kg. de músculo.
							</span>
							<span style='display:block;line-height:2rem;padding:10px;'>
								Para mantener tu masa muscular te recomendamos consumir:
							</span> 
							<span style='display:block;line-height:2rem;background:white;color:{$colors['bg-dark']};{$rounded_borders}padding:10px;'>
							<span style='color:black'> {$proteina_diaria}</span> gr. de proteína diaria
							</span> 
							<span style='display:block;line-height:2rem;padding:10px;'>
								Tu gasto diario de calorias es: <span style='background:white;color:{$colors['bg-dark']};{$rounded_borders}padding:10px;'>{$calorias}</span>
							</span>
						</td>

						<td class='block' align='center' valign='center' style='padding:1%;border:none !important;' width='40%'>
							<img src='{$images['fitness']}' style='max-width:98%;height:300px;' />
						</td>

						</tr>
				</table>
				<!--table end -->

				<!--CINTURA TABLE -->
				<!--table start -->
				<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;border:solid 1px white;{$rounded_borders}background:{$colors['bg-light']}; margin:5px auto'>
					<tr style='border:none;'>
						<td class='block' align='left' valign='center' style='padding:1%; border:none;' width='20%'>

							<!--inner table start -->
							<table border='1' align='center' valign='center' role='presentation' style='border:none;width:100%;margin-bottom: 10px;background:white;color:black; margin:5px auto;{$rounded_borders}'>
								<tr style='border:none;border-bottom:solid 1px black;'>
									<td align='center' valign='center' style='padding:10px;border:none;' >
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;'>
											CINTURA
										</p>
									</td>
								</tr>
								<tr style='border:none;background:{$cintura_color}'>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;line-height:2rem;margin:0;text-shadow:1px 1px 0 #fff,-1px 1px 0 #fff,-1px -1px 0 #fff,1px -1px 0 #fff;'>
											{$cintura}
										</p>
									</td>
								</tr>
							</table>
							<!--inner table end -->

						</td>

						<td class='block' align='left' valign='center' style='padding:1%;border:none !important;' width='40%'>
							<ul style='list-style:none;font-weight:bold;margin:0 20px;line-height:2rem;'>
								{$cintura_list}
							</ul>
						</td>

						<td class='block' align='center' valign='center' style='padding:1%;border:none !important;' width='40%'>
							<img src='{$images['logo']}' style='max-width:98%;height:80px;' />
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