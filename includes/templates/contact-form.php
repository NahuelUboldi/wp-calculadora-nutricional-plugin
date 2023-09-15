<?php if( get_plugin_options('cn_plugin_active') ):?>

<?

// "asesor" => $field_asesor,
// "objetivo" => $field_objetivo,
// "objetivo-secundario" => $field_objetivo_secundario,
// "peso" => $field_peso,
// "cintura" => $field_cintura,
// "cuello" => $field_cuello,
// "cadera" => $field_cadera,
// "actividad_fisica" => $field_actividad_fisica,
// "imc" => $field_IMC,
// "metab_basal" => $field_metab_basal,
// "%-grasa" => $field_porcentaje_grasa,
// "kg-grasa" => $field_kg_grasa,
// "kg-musculo" => $field_kg_musculo,
// "proteina-diaria" => $field_proteina_diaria,
// "calorias" => $field_metab_basal,

$valor = "hombre";

$nombre = "roberto";
$fecha = "17-02-1945";
$edad = "45";
$estatura = "145";
$sexo = $values["sexo"] ?? "mujer";
$peso = $values["peso"] ?? "79";
$imc = $values["imc"] ?? 42;
$grasa_porcentaje = $values["%-grasa"] ?? 19;
$grasa_kg = $values["kg-grasa"] ?? 8;

$rounded_borders = "border-radius:1rem; border-collapse: separate;border-spacing: 0;overflow: hidden;";

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


function createList($array,$imc) {
      $result = "";

      foreach ($array as $key => $value) {
            $min = $value[0];
            $max = $value[1];
            $text = $value[2];
            $color = $value[3];
            if($imc >= $min && $imc <= $max) {
                  $result .= "
                  <li style='color:white'>
                        <span style='color:{$color};-webkit-text-stroke-width: 1.5px;-webkit-text-stroke-color: white;'>► ⬤ </span>
                        <span style='color:white'>{$text} </span>
                  </li>";
            } else {
                  $result .= "
                  <li style='color:white;opacity:0.5;'>
                        <span style='visibility:hidden;'> ► </span>
                        ⬤
                        {$text}
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
            $text = $value[2];
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

$imc_list = createList($imc_values,$imc);
$imc_color = createColor($imc_values,$imc);
$grasa_porcentaje_list = createList($grasa_porcentaje_values,$grasa_porcentaje);
$grasa_porcentaje_color = createColor($grasa_porcentaje_values,$grasa_porcentaje);

echo "
<br><br>";

echo "
<h1>CALCULATIONS EMAIL</h1><br>

<!-- USER DATA TABLE -->
<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;border:solid 1px white;background:{$colors["bg-dark"]};color:white; margin:5px auto;{$rounded_borders}'>
      <tr style='border:none;'>
            <td class='block' align='center' valign='center' style='padding:10px;font-weight:bold;font-size:1.5rem;border:none;'>
                  Estudio Corporal Virtual
            </td>
      </tr>
      <tr>
            <td class='block' align='left' valign='center' style='padding:0px 10%;' >

                  <!--inner table start -->
                  <table border='0' align='center' role='presentation' style='width:100%;margin-bottom: 10px;border-collapse: separate;border-spacing: 15px;border:none;'>
                        <tr style='border:none;'>
                              <td align='center' valign='center' style='background:white;{$rounded_borders};color:{$colors['bg-dark']}'>
                                    <p style='font-weight:bold;font-size:1.2rem;margin:0;'>
                                          Nombre: {$nombre}
                                    </p>
                              </td>
                              <td align='center' valign='center' style='background:white;{$rounded_borders};color:{$colors['bg-dark']}'>
                                    <p style='font-weight:bold;font-size:1.2rem;margin:0;'>
                                          Fecha: {$fecha}
                                    </p>
                              </td>
                        </tr>
                        <tr style='border:none;'>
                              <td align='center' valign='center' style='background:white;{$rounded_borders};color:{$colors['bg-dark']}'>
                                    <p style='font-weight:bold;font-size:1.2rem;margin:0;'>
                                          Edad: {$edad}
                                    </p>
                              </td>
                              <td align='center' valign='center' style='background:white;{$rounded_borders};color:{$colors['bg-dark']}'>
                                    <p style='font-weight:bold;font-size:1.2rem;margin:0;'>
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
      <table border='1' align='center' role='presentation' style='width:100%;margin-bottom: 10px;background:white;color:black; margin:5px auto;{$rounded_borders}'>
        <tr style='border-bottom:solid 1px black;'>
          <td align='center' valign='center' >
            <p style='font-weight:bold;font-size:1.2rem;margin:0;'>
              PESO
            </p>
          </td>
        </tr>
        <tr>
          <td align='center' valign='center' >
            <p style='font-weight:bold;font-size:1.2rem;margin:0;'>
              {$peso} Kg.
            </p>
          </td>
        </tr>
      </table>
      <!--inner table end -->

      <!--inner table start -->
      <table border='1' align='center' valign='center' role='presentation' style='width:100%;margin-bottom: 10px;background:white;color:black; margin:5px auto;{$rounded_borders}'>
        <tr style='border-bottom:solid 1px black;'>
          <td align='center' valign='center' >
            <p style='font-weight:bold;font-size:1.2rem;margin:0;'>
              IMC
            </p>
          </td>
        </tr>
        <tr style='background:{$imc_color}'>
          <td align='center' valign='center' >
            <p style='font-weight:bold;font-size:1.2rem;margin:0;text-shadow:1px 1px 0 #fff,-1px 1px 0 #fff,-1px -1px 0 #fff,1px -1px 0 #fff;'>
              {$imc}
          </td>
        </tr>
      </table>
      <!--inner table end -->

    </td>
    <td class='block' align='left' valign='center' style='padding:1%;' width='80%'>
      <ul style='list-style:none;font-weight:bold;margin:0 20px'>
      {$imc_list}
      </ul>
    </td>
  </tr>
</table>
<!--table end -->

<!--GRASA TABLE -->
<!--table start -->
<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;border:solid 1px white;{$rounded_borders}background:{$colors['bg-light']}; margin:5px auto'>
  <tr style='border:none;;'>
    <td class='block' align='left' valign='center' style='padding:1%; border:none; ' width='20%'>
                      
      <!--inner table start -->
      <table border='1' align='center' role='presentation' style='width:100%;margin-bottom: 10px;background:white;color:black; margin:5px auto;{$rounded_borders}'>
        <tr style='border-bottom:solid 1px black;'>
          <td align='center' valign='center' >
            <p style='font-weight:bold;font-size:1.2rem;margin:0;'>
              KG GRASA
            </p>
          </td>
        </tr>
        <tr>
          <td align='center' valign='center' >
            <p style='font-weight:bold;font-size:1.2rem;margin:0;'>
              {$grasa_kg} Kg.
            </p>
          </td>
        </tr>
      </table>
      <!--inner table end -->

      <!--inner table start -->
      <table border='1' align='center' valign='center' role='presentation' style='width:100%;margin-bottom: 10px;background:white;color:black; margin:5px auto;{$rounded_borders}'>
        <tr style='border-bottom:solid 1px black;'>
          <td align='center' valign='center' >
            <p style='font-weight:bold;font-size:1.2rem;margin:0;'>
              GRASA
            </p>
          </td>
        </tr>
        <tr style='background:{$grasa_porcentaje_color}'>
          <td align='center' valign='center' >
            <p style='font-weight:bold;font-size:1.2rem;margin:0;text-shadow:1px 1px 0 #fff,-1px 1px 0 #fff,-1px -1px 0 #fff,1px -1px 0 #fff;'>
              {$grasa_porcentaje}
          </td>
        </tr>
      </table>
      <!--inner table end -->

    </td>
    <td class='block' align='left' valign='center' style='padding:1%;' width='80%'>
      <ul style='list-style:none;font-weight:bold;margin:0 20px'>
      {$grasa_porcentaje_list}
      </ul>
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