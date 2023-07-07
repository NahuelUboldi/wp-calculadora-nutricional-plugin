<?php 
function createAdminPage($values,$images) {
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

				return "<div id='submission-page'>
            <div class='datos'>
                  <h2>Datos ingresados por el usuario</h2>
                  <ul>
                        <li><strong>Nombre:</strong> {$values['nombre']}</li>
                        <li><strong>Email:</strong> {$values['email']}</li>
                        <li><strong>Teléfono:</strong> {$values['telefono']}</li>
                        <li><strong>Asesor elegido:</strong> {$values['asesor']}</li>
                        <li><strong>Objetivo elegido:</strong> {$values['objetivo']}</li>
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
			<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:100%;border:solid 1px black;background:white; margin:5px auto'>
							<tr style='border-bottom:solid 1px black;background:{$colors["primary"]};color:white;'>
									<td class='block' align='left' valign='center' style='padding:1%; ' width='20%'>
									</td>
									<td class='block' align='left' valign='center' style='padding:1%;font-weight:bold;font-size:1.5rem;' width='80%'>
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
																					<p style='font-weight:bold;font-size:1.2rem'>
																						Nombre: {$values["nombre"]}
																					</p>
																				</td>
																				<td align='center' valign='center' >
																					<p style='font-weight:bold;font-size:1.2rem'>
																						Fecha: {$values["fecha"]}
																					</p>
																				</td>
																	</tr>
																	<tr style=''>
																				<td align='center' valign='center' >
																					<p style='font-weight:bold;font-size:1.2rem'>
																						Edad: {$values["edad"]}
																					</p>
																				</td>
																				<td align='center' valign='center' >
																					<p style='font-weight:bold;font-size:1.2rem'>
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
																					<p style='font-weight:bold;font-size:1.2rem'>
																						PESO
																					</p>
																				</td>
																	</tr>
																	<tr style='background:#fff;'>
																				<td align='center' valign='center' >
																						<p style='font-weight:bold;font-size:1.2rem'>
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
																					<p style='font-weight:bold;font-size:1.2rem'>
																						IMC
																					</p>
																				</td>
																	</tr>
																	<tr style='background:{$colors["imc"]};'>
																				<td align='center' valign='center' >
																						<p style='font-weight:bold;font-size:1.2rem'>
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
			<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:100%;border:solid 1px black;background:white; margin:5px auto'>
							<tr style='background:{$colors["bg"]};'>
										<td class='block' align='left' valign='center' style='padding:1%; ' width='20%'>
													
											<!--inner table start -->
													<table cellpadding='0' cellspacing='0' border='1' align='center' role='presentation' style='width:97%;margin-bottom: 10px'>
																	<tr style='border-bottom:solid 1px black;background:{$colors["primary"]};'>
																				<td align='center' valign='center' >
																					<p style='font-weight:bold;font-size:1.2rem'>
																						% GRASA
																					</p>
																				</td>
																	</tr>
																	<tr style='background:{$colors["%-grasa"]};'>
																				<td align='center' valign='center' >
																						<p style='font-weight:bold;font-size:1.2rem'>
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
																					<p style='font-weight:bold;font-size:1.2rem'>
																						KG GRASA
																					</p>
																				</td>
																	</tr>
																	<tr style='background:#fff;'>
																				<td align='center' valign='center' >
																						<p style='font-weight:bold;font-size:1.2rem'>
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
			<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:100%;border:solid 1px black;background:white; margin:5px auto'>
							<tr style='background:{$colors["bg"]};'>
										<td class='block' align='left' valign='center' style='padding:1%; ' width='20%'>
													
											<!--inner table start -->
													<table cellpadding='0' cellspacing='0' border='1' align='center' role='presentation' style='width:97%;margin-bottom: 10px'>
																	<tr style='border-bottom:solid 1px black;background:{$colors["primary"]};'>
																				<td align='center' valign='center' >
																					<p style='font-weight:bold;font-size:1.2rem'>
																						KG MÚSCULO
																					</p>
																				</td>
																	</tr>
																	<tr style='background:#fff;'>
																				<td align='center' valign='center' >
																						<p style='font-weight:bold;font-size:1.2rem'>
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
																					<p style='font-weight:bold;font-size:1.2rem'>
																						PROTEINA DIARIA
																					</p>
																				</td>
																	</tr>
																	<tr style='background:#fff;'>
																				<td align='center' valign='center' >
																						<p style='font-weight:bold;font-size:1.2rem'>
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
			<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:100%;border:solid 1px black;background:white; margin:5px auto'>
							<tr style='background:{$colors["bg"]};'>
										<td class='block' align='left' valign='center' style='padding:1%; ' width='20%'>
													
											<!--inner table start -->
													<table cellpadding='0' cellspacing='0' border='1' align='center' role='presentation' style='width:97%;margin-bottom: 10px'>
																	<tr style='border-bottom:solid 1px black;background:{$colors["primary"]};'>
																				<td align='center' valign='center' >
																					<p style='font-weight:bold;font-size:1.2rem'>
																						CALORÍAS
																					</p>
																				</td>
																	</tr>
																	<tr style='background:#fff;'>
																				<td align='center' valign='center' >
																						<p style='font-weight:bold;font-size:1.2rem'>
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
																					<p style='font-weight:bold;font-size:1.2rem'>
																						CINTURA
																					</p>
																				</td>
																	</tr>
																	<tr style='background:{$colors['cintura']};'>
																				<td align='center' valign='center' >
																						<p style='font-weight:bold;font-size:1.2rem'>
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