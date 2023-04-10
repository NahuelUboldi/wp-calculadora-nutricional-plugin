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