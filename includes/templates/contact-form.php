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