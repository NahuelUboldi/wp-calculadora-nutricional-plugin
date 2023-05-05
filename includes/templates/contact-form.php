<?php if( get_plugin_options('cn_plugin_active') ):?>

<div id="form-success"></div>
<div id="form-error"></div>

<form id="enquiry_form">

      <?php wp_nonce_field('wp_rest');?>
      <div class="col-3">
            <div class="input-group">
                  <label>Nombre</label>
                  <input type="text" name="name" placeholder="Ej: Juan Pérez">
            </div>
            <div class="input-group">
                  <label>Edad</label>
                  <input type="number" name="edad" placeholder="00">
            </div>
      </div>


      <div class="input-group">
      <label>Email</label>
      <input type="text" name="email" placeholder="Ej: juan@correo.com">
      </div>

      <div class="col-3">
            <div class="input-group">
                  <label for="asesor">Elegir Asesor</label>
                  <select name="asesor">
                  <?php 
                        
                        $asesores = get_plugin_options('cn_plugin_asesores');
                                    
                        foreach($asesores as $asesor) { ?>
                              <option value="<?php echo $asesor["asesor_nombre"] ?>"><?php echo $asesor["asesor_nombre"] ?></option>
                        <?php } ?>
                  </select>
            </div>

            <div class="input-group">
                  <label for="sexo">Sexo</label>
                  <select name="sexo">
                        <option value="hombre">Hombre</option>
                        <option value="mujer">Mujer</option>
                  </select>
            </div>
            <div class="input-group">
                  <label for="actividad-fisica">Actividad Física</label>
                  <select name="actividad-fisica">
                        <option value="sedentario">Sedentario</option>
                        <option value="moderado">Moderado</option>
                        <option value="activo">Activo</option>
                  </select>
            </div>
      </div>

      <div class="col-wrap">
      
            <div class="input-group">
                  <label>Altura</label>
                  <input type="number" name="altura" placeholder="00">
            </div>
      
            <div class="input-group">
                  <label>Peso</label>
                  <input type="number" name="peso" placeholder="00">
            </div>

            <div class="input-group">
                  <label>Cintura</label>
                  <input type="number" name="cintura" placeholder="00">
            </div>
            
            <div class="input-group">
                  <label>Cuello</label>
                  <input type="number" name="cuello" placeholder="00">
            </div>

            <div class="input-group">
                  <label>Cadera</label>
                  <input type="number" name="cadera" placeholder="00">
            </div>
      </div>

      <div class="btn-container">
            <button type="submit">Submit form</button>
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