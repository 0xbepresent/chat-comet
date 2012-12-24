<?php
    session_start();
    if(isset($_POST['usuario'])){
        $nombre = $_POST['usuario'];
        $_SESSION['nombre'] = $nombre;
    }
    else{
        if(isset($_SESSION['nombre']))
            $nombre = $_SESSION['nombre'];       
        else
            header("Location: index.php");
    }
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel='stylesheet' href='css/chat.css' media='screen'>
<script type='text/javascript' src="js/jquery/jquery-1.7.1.min.js"> </script>
<script type="text/javascript" src='js/prototype.js'></script>
<script type="text/javascript">
    var usunick = "<?php echo $nombre; ?>";
    jQuery(document).ready(function(){
        jQuery("#usermsg").focus();
        jQuery("#chat-msg").bind("keypress", function(e){
            if(e.keyCode==13){  
                var jqueryUs = document.getElementById('usermsg');
                var oldscrollHeight = jQuery("#chat-box").prop("scrollHeight") - 20;

                comet.doRequest(jqueryUs.value);
                jqueryUs.value = '';
                //Recorrer Scroll de ChatBox    
                var newscrollHeight = jQuery("#chat-box").prop("scrollHeight");
                    if(newscrollHeight > oldscrollHeight)
                        jQuery("#chat-box").animate({ scrollTop: newscrollHeight }, 'normal'); 
            }
        });
        cometusers.doRequest("");
        submitUsers();
        //Close window
        jQuery(window).unload( function(){
            userPart();
        });
        //Button logout
        jQuery("#linkLogout").click(function(){
            userPart();
        });
    });
</script>
<script type="text/javascript" src='js/usuarios.js'></script>
<script type="text/javascript" src='js/comet.js'></script>
</head>
<body>
    <div id="wrapper">
        <div id="menu">
        <p class="welcome">
        <?php
        echo "Bienvenido ".$nombre." <a id='linkLogout' href='logout.php'>Logout</a>";
        ?>
        </b></p>
        <p align="right" id="userNum">Usuarios en linea: </p> 
        <div style="clear:both"></div>
        </div>  
        <div id='chat-box'>
        </div>
        <div id="chat-users">
        </div>
        <div id='chat-msg'> 
            <form action='' method='post' 
                            onsubmit="var usermsg = $('usermsg').value;
                                    comet.doRequest(usermsg);
                                    $('usermsg').value='';
                                    return false;">
                <textarea id='usermsg' ></textarea><br><br>
                <input type='submit' id='submitmsg' value='Enviar' />
            </form>
        </div>  
        <div id= "msjRespuesta">
        </div>
     <div class = 'footer'>
            &copy; 2012 | Hecho con <font color='#FA5858' size='1px'>♥</font>.
    </div>
    </div>
</body>
</html>
