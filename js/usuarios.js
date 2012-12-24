function submitUsers(){
    cometusers.doRequest("add");
}

function userPart() {
  //Remove the user from the list
   cometusers.doRequest("delete");
}

var CometUsers = Class.create();
CometUsers.prototype = {
    timestamp2: 0,
    url: "users.php",
    noerror: true,
    initialize: function(){ },

    connect: function(){
        this.ajax = new Ajax.Request(this.url, {
            method: "POST",
            parameters: { 'timestamp2': this.timestamp2 },
            onSuccess: function(transport){
                var response = transport.responseText.evalJSON();
                this.cometusers.timestamp2 = response['timestamp2'];
                this.cometusers.handleResponse(response);
                this.cometusers.noerror = true;
            },
            onComplete: function(transport){
                //Enviando nuevo ajax request
                if(!this.cometusers.noerror){
                    //Si ocurrio un problema reconectar en 5 segundos
                    setTimeout(function(){cometusers.connect()}, 5000);
                }else{
                    this.cometusers.connect();
                    this.cometusers.noerror = false;
                }
            }
        });
        this.ajax.cometusers = this;
    },
    disconnect: function(){
    },
    handleResponse: function(response){
        $("userNum").innerHTML = "Usuarios en linea: "+ response["num_users"];
        $("chat-users").innerHTML = response["list_users"];
    },
    doRequest: function(request){
        new Ajax.Request(this.url, {
            method: "POST",
            parameters: {"type": request, "nick":usunick}
        });
    }
}
var cometusers = new CometUsers();
cometusers.connect();
