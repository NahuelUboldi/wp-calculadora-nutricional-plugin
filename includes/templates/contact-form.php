<?php if( get_plugin_options('cn_plugin_active') ):?>

<div id="form_success" style="background-color:green; color:#fff;"></div>
<div id="form_error" style="background-color:red; color:#fff;"></div>

<form id="enquiry_form">


      <?php wp_nonce_field('wp_rest');?>
      <div class="input-group">
            <label>Nombre</label><br />
            <input type="text" name="name"><br />
      </div>

      <div class="input-group">
      <label>Email</label><br />
      <input type="text" name="email"><br />
      </div>

      <div class="input-group">
      <label for="asesor">Asesor</label>
      <select name="asesor">
      <?php 
            
            $asesores = get_plugin_options('cn_plugin_asesores');
                        
            foreach($asesores as $asesor) { ?>
                  <option value="<?php echo $asesor["asesor_nombre"] ?>"><?php echo $asesor["asesor_nombre"] ?></option>
            <?php } ?>
      </select><br />
      </div>

      <div class="input-group">
      <label for="sexo">Sexo</label>
      <select name="sexo">
            <option value="hombre">Hombre</option>
            <option value="mujer">Mujer</option>
      </select><br />
      </div>
 
      <div class="input-group">
      <label>Edad</label><br />
      <input type="number" name="edad"><br />
      </div>
 
      <div class="input-group">
      <label>Altura</label><br />
      <input type="number" name="altura"><br />
      </div>
 
      <div class="input-group">
      <label>Peso</label><br />
      <input type="number" name="peso"><br />
      </div>
      
      <div class="input-group">
      <label>Cintura</label><br />
      <input type="number" name="cintura"><br />
      </div>
      
      <div class="input-group">
      <label>Cuello</label><br />
      <input type="number" name="cuello"><br />
      </div>

      <div class="input-group">
      <label>Cadera</label><br />
      <input type="number" name="cadera"><br />
      </div>

      <div class="input-group">
      <label for="actividad-fisica">Actividad Física</label>
      <select name="actividad-fisica">
            <option value="sedentario">Sedentario</option>
            <option value="moderado">Moderado</option>
            <option value="activo">Activo</option>
      </select><br />
      </div>


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