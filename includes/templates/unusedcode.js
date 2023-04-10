// jQuery(document).ready(function($){

//       $("#enquiry_form").submit( function(event){

//             event.preventDefault();

//             $("#form_error").hide();

//             var form = $(this);

//             $.ajax({

//                   type:"POST",
//                   url: "<?php echo get_rest_url(null, 'v1/contact-form/submit');?>",
//                   data: form.serialize(),
//                   success:function(res){

//                         form.hide();

//                         $("#form_success").html(res).fadeIn();

//                   },
//                   error: function(){

//                         $("#form_error").html("There was an error submitting").fadeIn();
//                   }

//             })

//       });

// });

// document.addEventListener("DOMContentLoaded", function() {
//   var form = document.querySelector("#enquiry_form");
//   form.addEventListener("submit", function(event) {
//     event.preventDefault();
//     document.querySelector("#form_error").style.display = "none";
//     var formData = new FormData(form);
//     var request = new XMLHttpRequest();
//     request.open("POST", "<?php echo get_rest_url(null, 'v1/contact-form/submit');?>");
//     request.onload = function() {
//       if (request.status === 200) {
//         form.style.display = "none";
//         document.querySelector("#form_success").innerHTML = request.responseText;
//         document.querySelector("#form_success").style.display = "block";
//       } else {
//         document.querySelector("#form_error").innerHTML = "There was an error submitting";
//         document.querySelector("#form_error").style.display = "block";
//       }
//     };
//     request.onerror = function() {
//       document.querySelector("#form_error").innerHTML = "There was an error submitting";
//       document.querySelector("#form_error").style.display = "block";
//     };
//     request.send(formData);
//   });
// });
