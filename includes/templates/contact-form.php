<?php if( get_plugin_options('cn_plugin_active') ):?>

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
                  <input id="edad" type="number" name="edad" required>
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
                  <label for="altura">Altura (en cm)</label>
                  <input id="altura" type="number" name="altura"  required>
            </div>
      
            <div class="input-group">
                  <label for="peso">Peso (en kg)</label>
                  <input id="peso" type="number" name="peso"  required>
            </div>

           
            <div class="input-group">
                  <label for="cuello">Cuello (en cm)</label>
                  <input id="cuello" type="number" name="cuello"  required>
            </div>

            <div class="input-group">
                  <label for="cintura">Cintura (en cm)</label>
                  <input id="cintura" type="number" name="cintura"  required>
            </div>

            <div class="input-group">
                  <label for="cadera">Cadera (en cm)</label>
                  <input id="cadera" class="error" type="number" name="cadera"  required>
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