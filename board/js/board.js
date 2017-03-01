$(function(){
	var canvas = new fabric.Canvas('canvas');
	var freeDrawingBrush = null;
	var cw;
	var ch;
var conn;
var relation = getCookie('relation');
var session = getCookie('session');
function getCookie(name) { var re = new RegExp(name + "=([^;]+)"); var value = re.exec(document.cookie); return (value != null) ? unescape(value[1]) : null; }
if(relation != "" && session !=""){
	console.log("Relation: " + relation + " And Session "+session);
	//conn = new Connection(session, relation, canvas, "192.168.1.6:2000");
	conn = new Connection(session, relation, canvas, "127.0.0.1:2000");
}else{
	document.location.href = "../index.php.php";
}

/* CANVAS CONFIG */

	var csv = document.getElementById('canvas'), context = csv.getContext('2d');
	
    window.addEventListener('resize', resizeCanvas, false);
    function resizeCanvas() {
    	cw = $('.canvascontainer').width();
    	ch = $('.canvascontainer').height();
        canvas.setHeight(ch);
        canvas.setWidth(cw);
    }
    resizeCanvas();

/* CANVAS CONFIG */

/*________________________________________________________________________________________________________________________ */

/*Object Sending*/


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


/*Object Sending*/

/* CANVAS FUNCTIONS */


	$("#iconpencil").click(function(event) {
renderit = true;
		canvas.isDrawingMode = true;
		freeDrawingBrush = new fabric.PencilBrush(canvas);
	    canvas.renderAll();
    	canvas.calcOffset();
	});
	$("#iconstore").click(function(){
		renderit = true;
		canvas.clear();
		canvas.renderAll();
    	canvas.calcOffset();
	});

	/* pencil color choose */
		$('.choosepencilcolor').click(function(event) {
			renderit = true;
			var pencilcolor = $(this).data("pencilcolor");
			if(freeDrawingBrush){
				canvas.freeDrawingBrush.color = "#"+pencilcolor;
			}else{
				freeDrawingBrush = new fabric.PencilBrush(canvas);
				canvas.freeDrawingBrush.color = "#"+pencilcolor;
			}
		});

		$('.choosepencilthickness').click(function(event) {
			renderit = true;
			var pencilthickness = $(this).children("span").data("pencilthickness");
			if(freeDrawingBrush){
				canvas.freeDrawingBrush.width = pencilthickness;
			}else{
				freeDrawingBrush = new fabric.PencilBrush(canvas);
				canvas.freeDrawingBrush.width = pencilthickness;
			}
		});
	/* pencil color choose */

	/* text input */
		$(".outtext").click(function(){
			renderit = true;
	    	canvas.isDrawingMode = false;
	    	if (canvas.getContext) {
	        	var context = canvas.getContext('2d');
			}
			var text, size, color;
			var mouse_pos = { x:0 , y:0 };
			text = $('.textstr').val();

			size = $('.textsize').val();
			if(size === ''){
				size = 30;
				console.log("empty");

			}
			color=$('.textcolor').val();
		        
		        canvas.add(new fabric.Text(text, {
		        	size: parseInt(size, 10),
		            fontFamily: 'Arial',
		            fontSize: size,
		            left: $(window).width()/3,
		            top: 80,
		            textAlign: "left",
		            fontWeight: 'bold',
		            fill: color
	        	}));
		        canvas.renderAll();
		        canvas.calcOffset();
		});
		/* text input */

		/* Delete Feature */
			$("#icondelete").click(function(){
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
					$("#icondelete").click();
				}
			});
		/* Delete Feature */

		/*Undo Feature */
			$("#iconundo").click(function(event) {
				renderit = true;
				var lastItemIndex = (canvas.getObjects().length - 1);
				var item = canvas.item(lastItemIndex);
				  canvas.remove(item);
				  canvas.renderAll();
			});
		/*Undo Feature */

		/* cursor Feature */
			$("#iconcursor").click(function(){
				renderit = true;
				canvas.isDrawingMode = false;
			});
		/* cursor Feature */

		/* Line Feature */
			$("#iconline").click(function(){
				renderit = true;
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
				function mousedown(e) {
				    var mouse = canvas.getPointer(e.e);
				    started = true;
				    startX = mouse.x;
				    startY = mouse.y;
				    canvas.off('mouse:down');
				}
				function mousemove(e) {

				    if(!started) {

				        return false;

				    }
				    canvas.off('mouse:move');

				}
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
		/* Line Feature */

		/* Shapes Feature */

			$("#iconshaperectangle").click(function(){
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
			$("#iconshapecircle").click(function(){
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
			$("#iconshapetriangle").click(function(){
				renderit = true;
				var mouse_pos = { x:0 , y:0 };
				canvas.isDrawingMode = false;
				canvas.observe('mouse:down', function(e) {
					mouse_pos = canvas.getPointer(e.e);
					canvas.add(new fabric.Triangle({
					    left: mouse_pos.x,
					    top: mouse_pos.y,
					    fill: 'white',
					    stroke: 'black',
					    strokeWidth: 3,
					    width: 60,
					    height: 80
			  		}));
					canvas.off('mouse:down');
				});
			});
			$("#iconshapeellipse").click(function(){
				renderit = true;
				var mouse_pos = { x:0 , y:0 };
				canvas.isDrawingMode = false;
				canvas.observe('mouse:down', function(e) {
				mouse_pos = canvas.getPointer(e.e);
					canvas.add(new fabric.Ellipse({
					    rx: 45,
					    ry: 25,
					    fill: 'white',
					    stroke: 'black',
					    strokeWidth: 3,
					    left: mouse_pos.x,
					    top: mouse_pos.y
	  				}));
					canvas.off('mouse:down');
				});
			});
			/* Shapes Feature */

			/*Save As Image*/

			$("#image_out").click(function(){
				renderit = true;
			    canvas.isDrawingMode = false;
			    var json = JSON.stringify(canvas);
			    tempCanvas = document.createElement('canvas');
			    tempCanvas.id = 'tmp_canvas';
			    var temp_canvas = new fabric.Canvas('tmp_canvas',{backgroundColor : "#fff"});
			    temp_canvas.setWidth(cw);
			    temp_canvas.setHeight(ch);
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
			    $("#tmp_canvas").remove();
			});

$("#store_out").click(function(){
	renderit = true;
    canvas.isDrawingMode = false;
if(!window.localStorage){alert("This function is not supported by your browser."); return;}
    // save to localStorage
    var json = JSON.stringify(canvas);
    window.localStorage.setItem("hoge", json);
});


$("#store_load").click(function(){
	renderit = true;
    canvas.isDrawingMode = false;
    if(!window.localStorage){alert("This function is not supported by your browser."); return;}
    //clear canvas
    canvas.clear();
    //load from localStorage
    canvas.loadFromJSON(window.localStorage.getItem("hoge"));
    // re-render the canvas
    canvas.renderAll();
    // optional
    canvas.calcOffset();
});




function ajaxify(js,conn){
	conn.sendMsg(js);	
}


$('html, body').css({
    'overflow': 'hidden',
    'height': '100%'
});


 });




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