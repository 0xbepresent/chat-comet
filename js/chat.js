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