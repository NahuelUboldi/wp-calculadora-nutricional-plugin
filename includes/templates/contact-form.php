<?php if( get_plugin_options('contact_plugin_active') ):?>




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
            $asesores = get_plugin_options('cn_plugin_asesores');
            
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

document.addEventListener("DOMContentLoaded", function() {
  var form = document.querySelector("#enquiry_form");
  form.addEventListener("submit", function(event) {
    event.preventDefault();
    document.querySelector("#form_error").style.display = "none";
    var formData = new FormData(form);
    fetch("<?php echo get_rest_url(null, 'v1/contact-form/submit');?>", {
      method: "POST",
      body: formData
    })
    .then(function(response) {
      if (response.ok) {
        form.style.display = "none";
        return response.text();
      } else {
        throw new Error("There was an error submitting");
      }
    })
    .then(function(text) {
      document.querySelector("#form_success").innerHTML = text;
      document.querySelector("#form_success").style.display = "block";
    })
    .catch(function(error) {
      document.querySelector("#form_error").innerHTML = error.message;
      document.querySelector("#form_error").style.display = "block";
    });
  });
});


</script>

<?php else:?>

<p>This form is not active</p>

<?php endif;?>