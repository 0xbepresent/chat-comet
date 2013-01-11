<?php
    session_start();
    if( isset($_SESSION['nombre']) )
        header("Location: chat.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' href='css/chat.css' media='screen'>
<script type='text/javascript' src="js/jquery/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
jQuery(document).ready(function(){
        jQuery("#submitNick").click(function(){
           var usuario = jQuery("#usuario").val();
           //Comprobar que no existe
           jQuery.post("exist.php", {nick:usuario}, function(data){
             if(data == 0){
                jQuery.post("chat.php", {usuario:usuario}, function(){
                    window.location.reload(true);
                });
             }else{
                alert("Usuario existente en el chat");
             }
           });
        });
});
</script>
</head>
<body>
    <div id="loginform">
        <h1>Introduce tu nombre</h1>
                <label for="name">Nombre:</label>
                <input type="nick" name="usuario" id="usuario"  autofocus="autofocus" required="required"/><br><br>
                <input type="submit" id="submitNick" value="Enter" />
    <div class = 'footer'>
            &copy; 2012 | Hecho con <font color='#FA5858' size='1px'>♥</font>.
    </div>
    </div>
</body>
</html>