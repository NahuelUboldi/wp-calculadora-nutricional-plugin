<?php if( get_plugin_options('contact_plugin_active') ):?>

      <?php
$asesores = get_plugin_options('cn_plugin_asesores');
            // var_dump($asesores);
            
            // array(2) { 
            //       [0]=> array(3) { 
            //             ["_type"]=> string(1) "_" 
            //             ["asesor_nombre"]=> string(4) "pepe" 
            //             ["asesor_email"]=> string(14) "pepe@gmail.com" } 
            //       [1]=> array(3) { 
            //             ["_type"]=> string(1) "_" 
            //             ["asesor_nombre"]=> string(7) "roberto" ["asesor_email"]=> string(17) "roberto@gmail.com" } 
            //       }

            // array(3) { 
            //       ["_type"]=> string(1) "_" 
            //       ["asesor_nombre"]=> string(4) "pepe" 
            //       ["asesor_email"]=> string(14) "pepe@gmail.com" 
            // } 
            // array(3) { 
            //       ["_type"]=> string(1) "_" 
            //       ["asesor_nombre"]=> string(7) "roberto" 
            //       ["asesor_email"]=> string(17) "roberto@gmail.com" 
            // }
            
      $field_asesor = "pepe";
      
      $selected_asesor = array_filter($asesores,function($asesor) { 
                  global $field_asesor;
                  var_dump($field_asesor);
                  echo "asesor nombre: " . $asesor["asesor_nombre"] . "<br>";
                  return $asesor["asesor_nombre"] == "pepe";
      });
      echo "/////////////<br>";
      var_dump( $selected_asesor);
      echo "<h1> Selected asesor: " . $selected_asesor[0]["asesor_nombre"] . "</h1>"
?>

<div id="form_success" style="background-color:green; color:#fff;"></div>
<div id="form_error" style="background-color:red; color:#fff;"></div>

<form id="enquiry_form">


      <?php wp_nonce_field('wp_rest');?>

      <!--
            SEXO
            EDAD
            ALTURA
            PESO
            CINTURA
            CUELLO
            CADERA
            Actividad Fisica
      -->

      <label>Name</label><br />
      <input type="text" name="name"><br />

      <label>Email</label><br />
      <input type="text" name="email"><br />

      <label for="asesor">Asesor</label>
      <select name="asesor">
      <?php 
            
            
            foreach($asesores as $asesor) { ?>
                  <option value="<?php echo $asesor["asesor_nombre"] ?>"><?php echo $asesor["asesor_nombre"] ?></option>
            <?php }
            // array(2) { 
            //       [0]=> array(3) { 
            //             ["_type"]=> string(1) "_" 
            //             ["asesor_nombre"]=> string(6) "Nahuel" 
            //             ["asesor_email"]=> string(16) "nahuel@email.com" 
            //       } 
            //       [1]=> array(3) { 
            //             ["_type"]=> string(1) "_" 
            //             ["asesor_nombre"]=> string(6) "carlos" 
            //             ["asesor_email"]=> string(16) "carlos@gmail.com" 
            //       } 
            // }

            
      ?>
      </select><br />


      
      <label for="sexo">Actividad Física</label>
      <select name="sexo">
            <option value="hombre">Hombre</option>
            <option value="mujer">Mujer</option>
      </select><br />
 
      <label>Edad</label><br />
      <input type="number" name="edad"><br />
 
      <label>Altura</label><br />
      <input type="number" name="altura"><br />
 
      <label>Peso</label><br />
      <input type="number" name="peso"><br />
      
      <label>Cintura</label><br />
      <input type="number" name="cintura"><br />
      
      <label>Cuello</label><br />
      <input type="number" name="cuello"><br />

      <label>Cadera</label><br />
      <input type="number" name="cadera"><br />

      <label for="actividad-fisica">Actividad Física</label>
      <select name="actividad-fisica">
            <option value="sedentario">Sedentario</option>
            <option value="moderado">Moderado</option>
            <option value="activo">Activo</option>
      </select><br />

      

      <label>Message</label><br />
      <textarea name="message"></textarea><br />

      <button type="submit">Submit form</button>

</form>

<script>

jQuery(document).ready(function($){

      $("#enquiry_form").submit( function(event){

            event.preventDefault();

            $("#form_error").hide();

            var form = $(this);

            $.ajax({

                  type:"POST",
                  url: "<?php echo get_rest_url(null, 'v1/contact-form/submit');?>",
                  data: form.serialize(),
                  success:function(res){

                        form.hide();

                        $("#form_success").html(res).fadeIn();

                  },
                  error: function(){

                        $("#form_error").html("There was an error submitting").fadeIn();
                  }

            })

      });

});



</script>

<?php else:?>

<p>This form is not active</p>

<?php endif;?>