<?php 
function createAdminPage($values,$images) {
	
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
			<li style='font-size:1.5rem;'>
				<span style='font-size:1.5rem;color:{$color};-webkit-text-stroke-width: 1.5px;-webkit-text-stroke-color: white;'>► ⬤ </span>
				<span style='font-size:1.5rem;color:{$text_color}'>{$text} </span>
			</li>";
		} else {
			$result .= "
			<li style='color:{$text_color};opacity:0.5;font-size:1.5rem;'>
				<span style='font-size:1.5rem;visibility:hidden;'> ► </span>
				<span style='font-size:1.5rem;'>
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

return "
<div id='submission-page'>
	<div class='datos'>
		<h2>Datos ingresados por el usuario</h2>
		<ul>
			<li><strong>Nombre:</strong> {$values['nombre']}</li>
			<li><strong>Email:</strong> {$values['email']}</li>
			<li><strong>Teléfono:</strong> {$values['telefono']}</li>
			<li><strong>Asesor elegido:</strong> {$values['asesor']}</li>
			<li><strong>Objetivo elegido:</strong> {$values['objetivo']}</li>
			<li><strong>Objetivo secundario:</strong> {$values['objetivo-secundario']}</li>
			<li><strong>Sexo:</strong> {$values['sexo']}</li>
			<li><strong>Edad:</strong> {$values['edad']}</li>
			<li><strong>Altura:</strong> {$values['estatura']}</li>
			<li><strong>Peso:</strong> {$values['peso']}</li>
			<li><strong>Cintura:</strong> {$values['cintura']}</li>
			<li><strong>Cuello:</strong> {$values['cuello']}</li>
			<li><strong>Cadera:</strong> {$values['cadera']}</li>
			<li><strong>Actividad Física:</strong> {$values['actividad_fisica']}</li>
		</ul>          
	</div>
	<div class='calculations'>
		<h2>Calculos realizados</h2>
		<ul>
			<li><strong>IMC:</strong> {$values['imc']}</li>
			<li><strong>Metabolismo basal:</strong> {$values['metab_basal']}</li>
			<li><strong>Porcentaje de grasa:</strong> {$values['%-grasa']}</li>
			<li><strong>Kg de grasa:</strong> {$values['kg-grasa']}</li>
			<li><strong>Kg de músculo:</strong> {$values['kg-musculo']}</li>
			<li><strong>Proteina diaria:</strong> {$values['proteina-diaria']}</li>
		
		</ul> 
	</div>

</div>
	<table cellpadding='0' cellspacing='0' border='0' id='backgroundTable' style='background:#eee; width:100%;padding:30px 0px;'>
		<tr>
			<td>

				<!-- USER DATA TABLE -->
				<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;border:solid 1px white;background:{$colors["bg-dark"]};color:white; margin:5px auto;{$rounded_borders}'>
					<tr style='border:none;'>
						<td class='block' align='center' valign='center' style='padding:20px;font-weight:bold;font-size:1.5rem;border:none;'>
							<h1 class='font-size:32px;margin:0px;padding:0px;'><span style='color:white;'>Estudio Corporal Virtual</span></h1>
						</td>
					</tr>
					<tr>
						<td class='block' align='left' valign='center' style='padding:0px 20px;' >

							<!--inner table start -->
							<table border='0' align='center' role='presentation' style='width:100%;margin-bottom: 10px;border-collapse: separate;border-spacing: 15px;border:none;'>
								<tr style='border:none;'>
									<td align='center' valign='center' style='padding:10px;background:white;{$rounded_borders};color:{$colors['bg-dark']}'>
										<p style='font-weight:bold;font-size:1.5rem;margin:0;'>
											Nombre: {$nombre}
										</p>
									</td>
									<td align='center' valign='center' style='padding:10px;background:white;{$rounded_borders};color:{$colors['bg-dark']}'>
										<p style='font-weight:bold;font-size:1.5rem;margin:0;'>
											Fecha: {$fecha}
										</p>
									</td>
								</tr>
								<tr style='border:none;'>
									<td align='center' valign='center' style='padding:10px;background:white;{$rounded_borders};color:{$colors['bg-dark']}'>
										<p style='font-weight:bold;font-size:1.5rem;margin:0;'>
											Edad: {$edad}
										</p>
									</td>
									<td align='center' valign='center' style='padding:10px;background:white;{$rounded_borders};color:{$colors['bg-dark']}'>
										<p style='font-weight:bold;font-size:1.5rem;margin:0;'>
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
										<p style='font-weight:bold;font-size:1.5rem;margin:0;'>
											PESO
										</p>
									</td>
								</tr>
								<tr>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;margin:0;'>
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
										<p style='font-weight:bold;font-size:1.5rem;margin:0;'>
											IMC
										</p>
									</td>
								</tr>
								<tr style='border:none;background:{$imc_color}'>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;margin:0;text-shadow:1px 1px 0 #fff,-1px 1px 0 #fff,-1px -1px 0 #fff,1px -1px 0 #fff;'>
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
										<p style='font-weight:bold;font-size:1.5rem;margin:0;'>
											KG GRASA
										</p>
									</td>
								</tr>
								<tr style='border:none;'>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;margin:0;'>
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
										<p style='font-weight:bold;font-size:1.5rem;margin:0;'>
											GRASA
										</p>
									</td>
								</tr>
								<tr style='border:none;background:{$grasa_porcentaje_color}'>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;margin:0;text-shadow:1px 1px 0 #fff,-1px 1px 0 #fff,-1px -1px 0 #fff,1px -1px 0 #fff;'>
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
										<p style='font-weight:bold;font-size:1.5rem;margin:0;padding:30px 20px;line-height:2rem;' height='100%'>
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
										<p style='font-weight:bold;font-size:1.5rem;margin:0;'>
											CINTURA
										</p>
									</td>
								</tr>
								<tr style='border:none;background:{$cintura_color}'>
									<td align='center' valign='center' style='padding:10px;border:none;'>
										<p style='font-weight:bold;font-size:1.5rem;margin:0;text-shadow:1px 1px 0 #fff,-1px 1px 0 #fff,-1px -1px 0 #fff,1px -1px 0 #fff;'>
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