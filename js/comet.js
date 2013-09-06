var Comet = Class.create();
Comet.prototype = {
    timestamp: 0,
    url: "backend.php",
    noerror: true,
    initialize: function(){ },

    connect: function(){
        this.ajax = new Ajax.Request(this.url, {
            method: "POST",
            parameters: { 'timestamp': this.timestamp},
            onSuccess: function(transport){
                var response = transport.responseText.evalJSON();
                this.comet.timestamp = response['timestamp'];
                this.comet.handleResponse(response);
                this.comet.noerror = true;
            },
            onComplete: function(transport){
                //Enviando nuevo ajax request
                if(!this.comet.noerror){
                    //Si ocurrio un problema reconectar en 5 segundos
                    setTimeout(function(){comet.connect()}, 5000);
                }else{
                    this.comet.connect();
                    this.comet.noerror = false;
                }
            }
        });
        this.ajax.comet = this;
    },
    disconnect: function(){
    },
    handleResponse: function(response){
        $("chat-box").innerHTML += response["msg"];
    },
    doRequest: function(request){
        new Ajax.Request(this.url, {
            method: "POST",
            parameters: {"msg": usunick +": "+ request}
        });
    }
}
var comet = new Comet();
comet.connect();