var conn;
var relation = getCookie('relation');
var session = getCookie('session');

jQuery(document).ready(function($) {
    
conn = new Connection(session, relation, "127.0.0.1:2000");


function getCookie(name) { var re = new RegExp(name + "=([^;]+)"); var value = re.exec(document.cookie); return (value != null) ? unescape(value[1]) : null; }

});

// username.addEventListener('keypress', function(evt) {
//     if (evt.keyCode != 13 || this.value == ""){
//         return;
// 	}
    
//     evt.preventDefault();
//     var name = this.value;
//     this.style.display = "none";
// 	console.log("haha");
//     chatcontainer.style.display = "block";

//     conn = new Connection(name, "chatwindow", "127.0.0.1:2000");
// });

messagebox.addEventListener('keypress', function(evt) {
    if (evt.keyCode != 13 || conn == undefined)
        return;

    evt.preventDefault();

    if (this.value == "")
        return;

    conn.sendMsg(this.value);

    this.value = "";
});


