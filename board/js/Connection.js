var Connection = (function() {

    function Connection(username, relation, canvas, url) {
        this.username = username;
        this.relation = relation;
        this.canvas = canvas;
        this.open = false;
        this.socket = new WebSocket("ws://" + url);
        this.setupConnectionEvents();
        window.renderit = false;
        //console.log("Woah");
    }

    Connection.prototype = {
        updateUsername: function() {
            this.socket.send(JSON.stringify({
                action: 'setname',
                username: this.username
            }));
        },

        updateRelation: function() {
            this.socket.send(JSON.stringify({
                action: 'setrelation',
                relation: this.relation
            }));
        },

        addChatMessage: function(name, msg) {
            var self = this;
            window.renderit = false;
            this.canvas.loadFromDatalessJSON(msg, function() {
                self.canvas.renderAll();
                self.canvas.calcOffset();
                window.renderit = true;
                console.log("SIZE Recieved: "+window.siez(self.msg));
            });
            
            // console.log("Sent By: " + name);
            // this.canvas.loadFromJSON(msg);
            // this.canvas.renderAll();
            // window.renderit = true;
        },

        addSystemMessage: function(msg) {
            console.log(msg);
        },

        setupConnectionEvents: function() {
            var self = this;

            self.socket.onopen = function(evt) { self.connectionOpen(evt); };
            self.socket.onmessage = function(evt) { self.connectionMessage(evt); };
            self.socket.onclose = function(evt) { self.connectionClose(evt); };
        },

        connectionOpen: function(evt) {
            this.open = true;
            this.addSystemMessage("Connected");

            this.updateUsername();
            this.updateRelation();
        },

        connectionMessage: function(evt) {
            if (!this.open)
                return;

            var data = JSON.parse(evt.data);
            if (data.action == 'setname') {
                if (data.success)
                    this.addSystemMessage("Session Set to: " + this.username);
                else
                    this.addSystemMessage("Username " + this.username + " has been taken.");
            } else if (data.action == 'message') {
                this.addChatMessage(data.username, data.msg);
            }
        },

        connectionClose: function(evt) {
            this.open = false;
            this.addSystemMessage("Disconnected");
        },

        sendMsg: function(message,session) {
            if (this.open) {
                this.socket.send(JSON.stringify({
                    action: 'message',
                    msg: message
                }));

                //this.addChatMessage(this.username, message);
            } else {
                this.addSystemMessage("You are not connected to the server.");
            }
        }
    };

    return Connection;

})();
