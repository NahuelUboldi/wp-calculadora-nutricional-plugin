<?php 
function createRecomendationsEmail($values,$images) {

  $obj_principal_elegido = $values["objetivo"];
  $obj_secundario_elegido = $values["objetivo-secundario"];


  $all_obj_principales = get_plugin_options('cn_plugin_redirect');

  foreach($all_obj_principales as $key => $value) {

    if($value["objetivo"] == $obj_principal_elegido) {

      $obj_principal_recomendaciones = $value['objetivo_recomendaciones'];

    }

  }

  $all_obj_secundarios = get_plugin_options('cn_plugin_objetivo_secundario');

  foreach($all_obj_secundarios as $key => $value) {

    if($value["objetivo_secundario"] == $obj_secundario_elegido) {

      $obj_secundario_recomendaciones = $value['objetivo_secundario_recomendaciones'];

    }

  }

  $palette = [
    "bg-cream" => '#e1ccad',
    "bg-purple" => '#764979'
	];
	
$colors = [
      "bg-light" => $palette["bg-cream"],
      "bg-dark" => $palette["bg-purple"]
];

  return "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Strict//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd'>

<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<meta name='viewport' content='width=device-width, initial-scale=1.0'/>
	<title>Your Message Subject or Title</title>
	<style type='text/css'>
		#outlook a {padding:0;}
		body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
		.ExternalClass {width:100%;}
		.ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
		#backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
		img {outline:none; text-decoration:none; -ms-interpolation-mode: bicubic;}
		a img {border:none;}
		.image_fix {display:block;}
		p {margin: 0;padding:5px;font-weight:bold;}
		h1, h2, h3, h4, h5, h6 {color: black !important;}
		h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {color: blue !important;}
		h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {
			color: red !important;
		 }
		h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited {
			color: purple !important;
		}
		table td {border-collapse: collapse;}
		table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
		a {color: orange;}
		@media only screen and (max-device-width: 480px) {
			a[href^='tel'], a[href^='sms'] {
						text-decoration: none;
						color: black; /* or whatever your want */
						pointer-events: none;
						cursor: default;
					}
			.mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {
						text-decoration: default;
						color: orange !important; /* or whatever your want */
						pointer-events: auto;
						cursor: default;
					}

					
		}

		@media only screen and (min-device-width: 768px) and (max-device-width: 1024px) {
			a[href^='tel'], a[href^='sms'] {
						text-decoration: none;
						color: blue;
						pointer-events: none;
						cursor: default;
					}
			.mobile_link a[href^='tel'], .mobile_link a[href^='sms'] {
						text-decoration: default;
						color: orange !important;
						pointer-events: auto;
						cursor: default;
					}
		}
		@media only screen and (-webkit-min-device-pixel-ratio: 2) {
			/* Put your iPhone 4g styles in here */
		}
		@media only screen and (-webkit-device-pixel-ratio:.75){
			/* Put CSS for low density (ldpi) Android layouts in here */
		}
		@media only screen and (-webkit-device-pixel-ratio:1){
			/* Put CSS for medium density (mdpi) Android layouts in here */
		}
		@media only screen and (-webkit-device-pixel-ratio:1.5){
			/* Put CSS for high density (hdpi) Android layouts in here */
		}
				@media screen and (max-width:600px) {
				.block { display: block !important; width: 100% !important; }
		}
	</style>
	<!--[if IEMobile 7]>
	<style type='text/css'>
		/* Targeting Windows Mobile */
	</style>
	<![endif]-->
	<!--[if gte mso 9]>
	<style>
		/* Target Outlook 2007 and 2010 */
	</style>
	<![endif]-->
</head>
<body>

<table cellpadding='0' cellspacing='0' border='0' id='backgroundTable' style='background:#eee;'><tr><td>

<!--table start -->
<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;margin:5px auto;border-radius:1rem; border-collapse: separate;border-spacing: 0;
  overflow: hidden;'>
      <tr border='0' style='border:none !important'>
            <td class='block' align='left' valign='center' style='padding:0%;border:none !important;line-height: 0%;' width='100%' border='0'>
                  <img src='{$images['recomendaciones-banner']}' style='width:100%;' />
            </td>

      </tr>
      
</table>
<!--table end -->

<!--table start -->
<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;margin:10px auto;padding:10px;border-radius:1rem;border:none !important; border-collapse: separate;border-spacing: 0;overflow: hidden;background:{$colors['bg-light']};'>
      <tr border='0' style='border:none !important'>
            <td class='block' align='left' valign='center' style='padding:20px;border:none !important;line-height: 0%;text-align:center;' width='100%' border='0'>
                  <p style='text-align:center;font-weight:bold; font-size:1.2rem; color:{$colors['bg-dark']};'>Objetivo Principal: </p>
                  <h3 style='font-size:1.4rem;'>{$obj_principal_elegido}</h3>
            </td>

      </tr>
      <tr border='0' style='background:white;'>
            <td class='block' align='left' valign='center' style='padding:10px;border:none !important;background:white; border-radius:1rem; border-collapse: separate; border-spacing: 0;overflow: hidden;' width='100%' border='0'>
                  <p style='text-align:center;font-weight:bold; font-size:1.2rem;color:{$colors['bg-dark']};'>Recomendaciones: </p>
                  
                  {$obj_principal_recomendaciones}

            </td>

      </tr>
     
</table>
<!--table end -->

<!--table start -->
<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;margin:10px auto;padding:10px;border-radius:1rem;border:none !important; border-collapse: separate;border-spacing: 0;overflow: hidden;background:{$colors['bg-light']};'>
      <tr border='0' style='border:none !important'>
            <td class='block' align='left' valign='center' style='padding:20px;border:none !important;line-height: 0%;text-align:center;' width='100%' border='0'>
                  <p style='text-align:center;font-weight:bold; font-size:1.2rem; color:{$colors['bg-dark']};'>Objetivo Secundario: </p>
                  <h3 style='font-size:1.4rem;'>{$obj_secundario_elegido}</h3>
            </td>

      </tr>
      <tr border='0' style='background:white;'>
            <td class='block' align='left' valign='center' style='padding:10px;border:none !important;background:white; border-radius:1rem; border-collapse: separate; border-spacing: 0;overflow: hidden;' width='100%' border='0'>
                  <p style='text-align:center;font-weight:bold; font-size:1.2rem;color:{$colors['bg-dark']};'>Recomendaciones: </p>
                  
                 <p>{$obj_secundario_recomendaciones}</p>

            </td>

      </tr>
     
</table>
<!--table end -->

<!--table start -->
<table cellpadding='0' cellspacing='0' border='0' align='center' role='presentation' style='width:80%;background:{$colors['bg-dark']};margin:5px auto;border-radius:1rem; border-collapse: separate;border-spacing: 0;
  overflow: hidden;'>
      <tr border='0' style='border:none !important'>
            <td class='block' align='center' valign='center' style='padding:40px 20px;border:none !important;line-height: 0%;' width='100%' border='0'>
                  <img src='{$images['logo']}' style='height:50px' />
            </td>

      </tr>
      
</table>
<!--table end -->  
	
</td></tr></table>
";
}