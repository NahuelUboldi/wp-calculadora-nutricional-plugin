<?php if( get_plugin_options('cn_plugin_active') ):?>



<div id="form_success" style="background-color:green; color:#fff;"></div>
<div id="form_error" style="background-color:red; color:#fff;"></div>

<form id="enquiry_form">
      <?php
// Get all pages
$pages = get_pages();


// Loop through the pages
// foreach ($pages as $page) {

//     echo '<a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a><br>';
// }

?>


      <?php wp_nonce_field('wp_rest');?>
      <div class="col-3">
            <div class="input-group">
                  <label>Nombre</label>
                  <input type="text" name="name">
            </div>
            <div class="input-group">
                  <label>Edad</label>
                  <input type="number" name="edad">
            </div>
      </div>


      <div class="input-group">
      <label>Email</label>
      <input type="text" name="email">
      </div>

      <div class="col-3">
            <div class="input-group">
                  <label for="asesor">Asesor</label>
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
                  <input type="number" name="altura">
            </div>
      
            <div class="input-group">
                  <label>Peso</label>
                  <input type="number" name="peso">
            </div>

            <div class="input-group">
                  <label>Cintura</label>
                  <input type="number" name="cintura">
            </div>
            
            <div class="input-group">
                  <label>Cuello</label>
                  <input type="number" name="cuello">
            </div>

            <div class="input-group">
                  <label>Cadera</label>
                  <input type="number" name="cadera">
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
                  success:function(res){

                        form.hide();

                        $("#form_success").html(res).fadeIn();

                  },
                  // success:function(res){

                  // form.hide();

                  //       // check if response is a URL
                  //       if(/^https?:\/\//.test(res)){
                  //       window.location.replace(res);
                  //       } else {
                  //       $("#form_success").html(res).fadeIn();
                  //       }
                  // },
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