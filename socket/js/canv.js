$(function(){
var canvas = new fabric.Canvas('c');
var conn;
var relation = getCookie('relation');
var session = getCookie('session');
function getCookie(name) { var re = new RegExp(name + "=([^;]+)"); var value = re.exec(document.cookie); return (value != null) ? unescape(value[1]) : null; }

if(relation != "" && session !=""){
	console.log("Relation: " + relation + " And Session "+session);
	//conn = new Connection(session, relation, canvas, "192.168.1.6:2000");
	conn = new Connection(session, relation, canvas, "127.0.0.1:2000");
}else{
	document.location.href = "../teacher.php";
}


	//f0e8d8
// 	if(cntt == true || cnts == true){
// 		$.ajax({
// 			url: "showjson.php",
// 			type: 'GET',
// 		})
// 		.done(function(data){	
// 			canvas.loadFromJSON(data);
// 			canvas.renderAll();
// 			renderit = true
// 			watcher();
// 			console.log("now rendered");
// 			listener();
// 		});
// 	}
	

		
		// canvas.on('mouse:down', function(e) {
  // 			if(renderit){
		// 		if (e.target) {
		// 		    console.log('an object was Modified! ', e.target.type);
		// 		    var js = JSON.stringify(canvas);
		// 		    ajaxify(js,conn);
		// 		}		
		// 	}
		// });
		// canvas.on('mouse:up', function(e) {
  // 			if(renderit){
		// 		if (e.target) {
		// 		    console.log('an object was Modified! ', e.target.type);
		// 		    var js = JSON.stringify(canvas);
		// 		    ajaxify(js,conn);
		// 		}		
		// 	}
		// });
		// canvas.on('mouse:move', function(e) {
  // 			if(renderit){
		// 		//if (e.target) {
		// 		    console.log('Mouse moved!');
		// 		    var js = JSON.stringify(canvas);
		// 		    ajaxify(js,conn);
		// 		//}		
		// 	}
		// });

		canvas.on('object:modified', function(e) {
			
			if(renderit){
				if (e.target) {
				    console.log('an object was Modified! ', e.target.type);
				    var js = JSON.stringify(canvas.toDatalessJSON());
				    ajaxify(js,conn);
				    console.log("SIZE SENT: "+window.siez(js)+" KB");
				}		
			}
		  
		});
		canvas.on('object:added', function(e) {
			if(renderit){
				if (e.target) {
				    console.log('an object was Added! ', e.target.type);
				    var js = JSON.stringify(canvas.toDatalessJSON());
				    ajaxify(js,conn);
				    console.log("SIZE SENT: "+window.siez(js)+" KB");
				}
			}
		});
		canvas.on('object:removed', function(e) {
			if(renderit){
				if (e.target) {
				    console.log('an object was Removed! ', e.target.type);
				    var js = JSON.stringify(canvas.toDatalessJSON());
				    ajaxify(js,conn);
				    console.log("SIZE SENT: "+window.siez(js)+" KB");
				}
			}
		});

	$("#pencil").click(function(){
		renderit = true;
	    canvas.isDrawingMode = true;
	    canvas.freeDrawingLineWidth = 5;
	    canvas.renderAll();
	    canvas.calcOffset();
	});
	$("#line").click(function(){

canvas.isDrawingMode = false;

if (canvas.getContext) {
    var context = canvas.getContext('2d');
}

canvas.observe('mouse:down', function(e) { mousedown(e); });
canvas.observe('mouse:move', function(e) { mousemove(e); });
canvas.observe('mouse:up', function(e) { mouseup(e); });

var started = false;
var startX = 0;
var startY = 0;

/* Mousedown */
function mousedown(e) {
    var mouse = canvas.getPointer(e.e);
    started = true;
    startX = mouse.x;
    startY = mouse.y;
    canvas.off('mouse:down');
}

/* Mousemove */
function mousemove(e) {

    if(!started) {

        return false;

    }
    canvas.off('mouse:move');

}

/* Mouseup */
function mouseup(e) {

    if(started) {

        var mouse = canvas.getPointer(e.e);

        canvas.add(new fabric.Line([startX, startY, mouse.x, mouse.y],{ stroke: "#000000", strokeWidth: 2 }));
        canvas.renderAll();
        canvas.calcOffset(); 

        started = false;
        canvas.off('mouse:up');

    }   

 }

});
	$("#rect").click(function(){
		renderit = true;
		var mouse_pos = { x:0 , y:0 };
  		canvas.isDrawingMode = false;
		canvas.observe('mouse:down', function(e) {
			mouse_pos = canvas.getPointer(e.e);
			canvas.add(new fabric.Rect({
				left: mouse_pos.x,
			    top: mouse_pos.y,
			    width: 75,
			    height: 50,
			    fill: 'white',
			    stroke: 'black',
			    strokeWidth: 3,
			    padding: 10
	  		}));
			canvas.off('mouse:down');
		});
	});
	$("#circle").click(function(){
		renderit = true;
		var mouse_pos = { x:0 , y:0 };
		canvas.isDrawingMode = false;
		canvas.observe('mouse:down', function(e) {
			mouse_pos = canvas.getPointer(e.e);
			canvas.add(new fabric.Circle({
			    left: mouse_pos.x,
			    top: mouse_pos.y,
			    radius: 30,
			    fill: 'white',
			    stroke: 'black',
			    strokeWidth: 3
	  		}));
			canvas.off('mouse:down');
		});
	});
	$(".outtext").click(function(){
		renderit = true;
    	canvas.isDrawingMode = false;
    	if (canvas.getContext) {
        	var context = canvas.getContext('2d');
		}
		var text, size, color;
		var mouse_pos = { x:0 , y:0 };
		// text = $('#text').val();
		// size = $('#size').val();
		// color = $('#color').val();
		text = $('.textstr').val();

		size = $('.textsize').val();
			if(size === ''){
			size = 30;
		}
		color=$('.textcolor').val();
	        size = parseInt(size, 10);
	        canvas.add(new fabric.Text(text, {
	            fontFamily: 'Arial',
	            fontSize: size,
	            left: $(window).width()/3,
	            top: $(window).height()/3,
	            textAlign: "left",
	            fontWeight: 'bold',
	            fill: color
        	}));
	        canvas.renderAll();
	        canvas.calcOffset();
	});
	$("#remove").click(function(){
		renderit = true;
    	canvas.isDrawingMode = false;
	    var activeObject = canvas.getActiveObject(),
	    activeGroup = canvas.getActiveGroup();
	    if (activeObject) {
	            canvas.remove(activeObject);
	    }
	    else if (activeGroup) {
	            var objectsInGroup = activeGroup.getObjects();
	            canvas.discardActiveGroup();
	            objectsInGroup.forEach(function(object) {
	            canvas.remove(object);
	            });
	    }

	});

$(window).keypress(function(event) {
	var key = event.keyCode || event.charCode;
	if(key == 46){
renderit = true;
    	canvas.isDrawingMode = false;
	    var activeObject = canvas.getActiveObject(),
	    activeGroup = canvas.getActiveGroup();
	    if (activeObject) {
	            canvas.remove(activeObject);
	    }
	    else if (activeGroup) {
	            var objectsInGroup = activeGroup.getObjects();
	            canvas.discardActiveGroup();
	            objectsInGroup.forEach(function(object) {
	            canvas.remove(object);
	            });
	    }
	}
});

$("#image_out").click(function(){
    canvas.isDrawingMode = false;

    var json = JSON.stringify(canvas);

    // add the temporary canvas
    tempCanvas = document.createElement('canvas');
    tempCanvas.id = 'tmp_canvas';
    var temp_canvas = new fabric.Canvas('tmp_canvas',{backgroundColor : "#fff"});
    temp_canvas.setWidth(1050);
    temp_canvas.setHeight($(window).height());
    wrapperEl = document.createElement('div');
    wrapperEl.className = 'CONTAINER_CLASS';
    fabric.util.makeElementUnselectable(wrapperEl);
    $('body').append(tempCanvas.wrapperEl);

    temp_canvas.loadFromJSON(json);
    temp_canvas.renderAll();
    temp_canvas.calcOffset();

    var base64 = temp_canvas.toDataURL("png");

    var image = new Image();
    image.onload = function() {
        window.open(image.src);
    }
    image.src = base64;

    // remove the temporary canvas
    $("#tmp_canvas").remove();

});



















// function listener(timestamp)
// {
//     var queryString = {'timestamp' : timestamp};

//     $.ajax(
//         {
//             type: 'GET',
//             url: 'server.php',
//             data: queryString,
//             success: function(data){
//                 // put result data into "obj"
//                 var obj = jQuery.parseJSON(data);
//                 // put the data_from_file into #response
// 				console.log(data);
//       //           if(obj.teacher){
//       //           	if(!obj.teacher == tch){
//       //           		canvas.loadFromJSON(obj.data_from_file);
// 						// canvas.renderAll();
//       //           	}
//       //           }
//       //           if(obj.student){
//       //           	if(!obj.student == usr){
//       //           		canvas.loadFromJSON(obj.data_from_file);
// 						// canvas.renderAll();
//       //           	}
//       //           }
//       canvas.loadFromJSON(obj.data_from_file);
//       canvas.renderAll();
//                 listener(obj.timestamp);
//             }
//         }
//     );
// }

// function listener(){
// 	timestamp = '';
// 	setInterval(function(){ 
// 		var queryString = {'timestamp' : timestamp};
// 	$.ajax({
// 			url: "listener.php",
// 			type: 'GET',
// 			data: queryString,

// 		})
// 		.done(function(data){	
// 			if(data != ''){
// 				renderit = false;
// 				var obj = jQuery.parseJSON(data);
// 				console.log(obj.data_from_file);
// 				var csjs = JSON.stringify(canvas);
// 				if(csjs != obj.data_from_file){
// 					canvas.loadFromJSON(obj.data_from_file);
// 					canvas.renderAll();
// 					timestamp = '';
// 				}
// 			}
// 		});
//  	}, 3000);
// }


});
function ajaxify(js,conn){
	conn.sendMsg(js);	
}








window.siez = function roughSizeOfObject( object ) {

    var objectList = [];
    var stack = [ object ];
    var bytes = 0;

    while ( stack.length ) {
        var value = stack.pop();

        if ( typeof value === 'boolean' ) {
            bytes += 4;
        }
        else if ( typeof value === 'string' ) {
            bytes += value.length * 2;
        }
        else if ( typeof value === 'number' ) {
            bytes += 8;
        }
        else if
        (
            typeof value === 'object'
            && objectList.indexOf( value ) === -1
        )
        {
            objectList.push( value );

            for( var i in value ) {
                stack.push( value[ i ] );
            }
        }
    }
    return bytes/1024;
}