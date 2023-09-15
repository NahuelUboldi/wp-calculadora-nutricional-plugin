<?php if( get_plugin_options('cn_plugin_active') ):?>

<?
$images = [
		"logo" => MY_PLUGIN_URL . "includes/templates/images/logo.png",
		"woman" => MY_PLUGIN_URL . "includes/templates/images/mujer.jpg",
		"men" => MY_PLUGIN_URL . "includes/templates/images/hombre.jpg",
		"imc" => MY_PLUGIN_URL . "includes/templates/images/imc.jpg",
		"calorias-men" => MY_PLUGIN_URL . "includes/templates/images/calorias-hombre.jpg",
		"calorias-woman" => MY_PLUGIN_URL . "includes/templates/images/calorias-mujer.jpg",
		"grasa-men" => MY_PLUGIN_URL . "includes/templates/images/grasa-hombre.jpg",
		"grasa-woman" => MY_PLUGIN_URL . "includes/templates/images/grasa-mujer.jpg",
		"proteinas-men" => MY_PLUGIN_URL . "includes/templates/images/proteinas-hombre.jpg",
		"proteinas-woman" => MY_PLUGIN_URL . "includes/templates/images/proteinas-mujer.jpg",
		"recomendaciones-banner" => MY_PLUGIN_URL . "includes/templates/images/recomendaciones-banner.jpg",
	];
$palette = [
		"light-pink" => "#FED1EE",
		"pink" => "#ff8ad8",
		"light-blue" => "#b0d3ed",
		"blue" => "#6e91db",
		"optimo" => "#f3f222",
		"normal" => "#94cd52",
		"alto" => "#fec001",
		"elevado" => "#fe0000",

		"delgadez-sobrepeso" => "#ffffc7",
		"delgadez-obesidad" => "#ffc1bb",
		"obesidad-alta" => "#fe8f82",

            "bg-cream" => '#e1ccad',
            "bg-purple" => '#764979'
	];
	
$colors = [
      "primary" => $palette["pink"],
      "bg" => $palette["light-pink"],
      "imc" => $palette["normal"],
      "%-grasa" => $palette["optimo"],
      "cintura" => $palette["normal"],
      "bg-light" => $palette["bg-cream"],
      "bg-dark" => $palette["bg-purple"]
];

$genderImg = $images["woman"];
$imcImg = $images["imc"];
$caloriasImg = $images["calorias-woman"];
$grasaImg = $images["grasa-woman"];
$proteinasImg = $images["proteinas-woman"];

echo "
<h1>RECOMENDATIONS EMAIL</h1><br>

<!--table start -->
<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;margin:5px auto;border-radius:1rem; border-collapse: separate;border-spacing: 0;
  overflow: hidden;'>
      <tr border='0' style='border:none !important'>
            <td class='block' align='left' valign='center' style='padding:0%;border:none !important;line-height: 0%;' width='100%' border='0'>
                  <img src='{$images['recomendaciones-banner']}' style='width:100%;' />
            </td>

      </tr>
      
</table>
<!--table end -->

<!--table start -->
<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;margin:10px auto;padding:10px;border-radius:1rem;border:none !important; border-collapse: separate;border-spacing: 0;overflow: hidden;background:{$colors['bg-light']};'>
      <tr border='0' style='border:none !important'>
            <td class='block' align='left' valign='center' style='padding:20px;border:none !important;line-height: 0%;text-align:center;' width='100%' border='0'>
                  <p style='text-align:center;font-weight:bold; font-size:1.2rem; color:{$colors['bg-dark']};'>Objetivo Principal: </p>
                  <h3 style='font-size:1.4rem;'>BAJAR DE PESO // PERDER GRASA // TONIFICAR</h3>
            </td>

      </tr>
      <tr border='0' style='background:white;'>
            <td class='block' align='left' valign='center' style='padding:10px;border:none !important;background:white; border-radius:1rem; border-collapse: separate; border-spacing: 0;overflow: hidden;' width='100%' border='0'>
                  <p style='text-align:center;font-weight:bold; font-size:1.2rem;'>Recomendaciones: </p>
                  
                  <ul>
                  <li>PLAN ECONOMICO: 2 batidos y 1 Te</li>
                  <li>PLAN BASICO: 2 batidos, 1 te y 1 bebida de proteína. (que se destaque este con una estrellita o algo)</li>
                  <li>PLAN AVANZADO: 2 batidos, 1 te, 1 bebida de proteína, 1 aloe y 1 fibra de manzana</li>
                  </ul>

            </td>

      </tr>
     
</table>
<!--table end -->

<!--table start -->
<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;margin:10px auto;padding:10px;border-radius:1rem;border:none !important; border-collapse: separate;border-spacing: 0;overflow: hidden;background:{$colors['bg-light']};'>
      <tr border='0' style='border:none !important'>
            <td class='block' align='left' valign='center' style='padding:20px;border:none !important;line-height: 0%;text-align:center;' width='100%' border='0'>
                  <p style='text-align:center;font-weight:bold; font-size:1.2rem; color:{$colors['bg-light']};'>Objetivo Secundario: </p>
                  <h3 style='font-size:1.4rem;'>Cuidar de mi piel y retrasar el envejecimiento</h3>
            </td>

      </tr>
      <tr border='0' style='background:white;'>
            <td class='block' align='left' valign='center' style='padding:10px;border:none !important;background:white; border-radius:1rem; border-collapse: separate; border-spacing: 0;overflow: hidden;' width='100%' border='0'>
                  <p style='text-align:center;font-weight:bold; font-size:1.2rem;'>Recomendaciones: </p>
                  
                 <p>⭐️RECOMENDADOS: Linea SKIN, Linea HerbalAloe, Colágeno, te, Batido y Proteína</p>

            </td>

      </tr>
     
</table>
<!--table end -->

<!--table start -->
<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;background:{$colors['bg-dark']};margin:5px auto;border-radius:1rem; border-collapse: separate;border-spacing: 0;
  overflow: hidden;'>
      <tr border='0' style='border:none !important'>
            <td class='block' align='center' valign='center' style='padding:40px 20px;border:none !important;line-height: 0%;' width='100%' border='0'>
                  <img src='{$images['logo']}' style='height:50px' />
            </td>

      </tr>
      
</table>
<!--table end -->

<br><br>";

echo "
<h1>CALCULATIONS EMAIL</h1><br>
<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;border:solid 1px black;background:white; margin:5px auto'>
      <tr style='border-bottom:solid 1px black;background:{$colors["primary"]};color:white;'>
            <td class='block' align='left' valign='center' style='padding:1%; ' width='20%'>
            </td>
            <td class='block' align='left' valign='center' style='padding:1%;font-weight:bold;font-size:1.5rem;' width='80%'>
                  ESTUDIO CORPORAL VIRTUAL - Sexo {$SEXO}
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
                                          Nombre: {$NOMBRE}
                                    </p>
                              </td>
                              <td align='center' valign='center' >
                                    <p style='font-weight:bold;font-size:1.2rem'>
                                          Fecha: {$FECHA}
                                    </p>
                              </td>
                        </tr>
                        <tr style=''>
                              <td align='center' valign='center' >
                                    <p style='font-weight:bold;font-size:1.2rem'>
                                          Edad: {$EDAD}
                                    </p>
                              </td>
                              <td align='center' valign='center' >
                                    <p style='font-weight:bold;font-size:1.2rem'>
                                          Estatura: {$ESTATURA}
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
                                          {$PESO}
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
<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;border:solid 1px black;background:white; margin:5px auto'>
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
<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;border:solid 1px black;background:white; margin:5px auto'>
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
<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;border:solid 1px black;background:white; margin:5px auto'>
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
                  <table cellpadding='0' cellspacing='0' border='1' align='center' role='presentation' style='width:97%;      margin-bottom: 10px'>
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
</table>" 

?>

<div id="form-success"></div>
<div id="form-error"></div>

<form id="enquiry_form">

      <?php wp_nonce_field('wp_rest');?>
      <div class="col-3">
            <div class="input-group">
                  <label for="name">Nombre</label>
                  <input id="name" type="text" name="name" placeholder="Ej: Juan Pérez" required>
            </div>
            <div class="input-group">
                  <label for="edad">Edad</label>
                  <input id="edad" type="number" name="edad" min="0" max="125" required>
            </div>
      </div>


      <div class="input-group">
            <label for="email">Email</label>
            <input id="email" type="text" name="email" placeholder="Ej: juan@correo.com" required>
      </div>
      <div class="input-group">
            <label for="telefono">Teléfono</label>
            <input id="telefono" type="tel" name="telefono" placeholder="Solo números de 7 a 14 dígitos sin espacios, guiones ni paréntesis." pattern="\d{7,14}" required>
      </div>

            <div class="input-group">
                  <label for="objetivo">Objetivo Principal</label>
                  <select id="objetivo" name="objetivo">
                  <?php 
                        
                        $objetivos = get_plugin_options('cn_plugin_redirect');
                                    
                        foreach($objetivos as $objetivo) { ?>
                              <option value="<?php echo $objetivo["objetivo"] ?>"><?php echo $objetivo["objetivo"] ?></option>
                        <?php } ?>
                  </select>
            </div>

            <div class="input-group">
                  <label for="objetivo-secundario">Objetivo Secundario</label>
                  <select id="objetivo-secundario" name="objetivo-secundario">
                  <?php 
                        
                        $objetivos = get_plugin_options('cn_plugin_objetivo_secundario');
                                    
                        foreach($objetivos as $objetivo) { ?>
                              <option value="<?php echo $objetivo["objetivo_secundario"] ?>"><?php echo $objetivo["objetivo_secundario"] ?></option>
                        <?php } ?>
                  </select>
            </div>

      <div class="col-3">


            <div class="input-group">
                  <label for="asesor">¿Quién es tu asesor?</label>
                  <select id="asesor" name="asesor">
                  <?php 
                        
                        $asesores = get_plugin_options('cn_plugin_asesores');
                                    
                        foreach($asesores as $asesor) { ?>
                              <option value="<?php echo $asesor["asesor_nombre"] ?>"><?php echo $asesor["asesor_nombre"] ?></option>
                        <?php } ?>
                  </select>
            </div>
      </div>
      <div class="col-3">
            <div class="input-group">
                  <label for="sexo">Sexo</label>
                  <select id="sexo" name="sexo">
                        <option value="hombre">Hombre</option>
                        <option value="mujer">Mujer</option>
                  </select>
            </div>
            <div class="input-group">
                  <label for="actividad-fisica">Actividad Física</label>
                  <select id="actividad-fisica" name="actividad-fisica">
                        <option value="sedentario">Sedentario</option>
                        <option value="moderado">Moderado</option>
                        <option value="activo">Activo</option>
                  </select>
            </div>
      </div>

      <div class="col-wrap">

            <div class="input-group">
                  <label for="altura">Altura (en cm) <br> Ej: 170</label>
                  <input id="altura" type="number" step="0.01" name="altura" min="50" max="230" required>
            </div>
      
            <div class="input-group">
                  <label for="peso">Peso (en kg) <br>  Ej: 70</label>
                  <input id="peso" type="number" step="0.01" name="peso" min="45" max="200" required>
            </div>

           
            <div class="input-group">
                  <label for="cuello">Cuello (en cm) <br>  Ej: 34</label>
                  <input id="cuello" type="number" step="0.01" name="cuello" min="20" max="50" required>
            </div>

            <div class="input-group">
                  <label for="cintura">Cintura (en cm) <br>  Ej: 90</label>
                  <input id="cintura" type="number" step="0.01" name="cintura" min="40" max="250" required>
            </div>

            <div class="input-group">
                  <label for="cadera">Cadera (en cm) <br> Ej: 70</label>
                  <input id="cadera" class="error" type="number" step="0.01" name="cadera" min="40" max="250" required>
            </div>
      </div>

      <div class="btn-container">
            <button type="submit">Comenzar Scanner</button>
      </div>

</form>

<script defer>

jQuery(document).ready(function($){

      $("#enquiry_form").submit( function(event){

            event.preventDefault();

            $("#form_error").hide();

            var form = $(this);

            $.ajax({

                  type:"POST",
                  url: "<?php echo get_rest_url(null, 'v1/contact-form/submit');?>",
                  data: form.serialize(),
                  // success:function(res){

                  //       form.hide();

                  //       $("#form_success").html(res).fadeIn();

                  // },
                  success:function(res){

                  form.hide();

                        // check if response is a URL
                        if(/^https?:\/\//.test(res)){
                        window.location.replace(res);
                        } else {
                        $("#form-success").html(res).addClass("form-alert").fadeIn();
                        
                        }
                  },
                  error: function(){

                        $("#form-error").html("Hubo un error al tratar de enviar el mensaje. Por favor, verifica que todos los campos han sido completados con la información correcta. Gracias.").addClass("form-alert").fadeIn();
                        setTimeout(() => {
                              $("#form-error").fadeOut()
                        }, 2500);
                  }

            })

      });

});



</script>

<?php else:?>

<p>La calculadora nutricional no está activa. Revisa la página de configuración.</p>

<?php endif;?>