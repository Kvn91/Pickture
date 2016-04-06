$(document).ready( function () {
	
	var clickSize = new Array();
	var curSize = 5;

	var canvasDiv = $('#canvasDiv');
	context = canvas.getContext("2d");

	var clickX = new Array();
	var clickY = new Array();
	var clickDrag = new Array();
	var paint;

	$('#fin').click(function(){
		curSize = 2;
	});

	$('#moyen').click(function(){
		curSize = 5;
	});

	$('#epais').click(function(){
		curSize = 8;
	});

	$('#efface').click(function(){
		canvas.width = canvas.width;
		clickX = [];
	});
	
	function addClick(x, y, dragging)
	{
	  clickX.push(x);
	  clickY.push(y);
	  clickDrag.push(dragging);
	  clickSize.push(curSize);
	}

	function redraw(){
  		canvas.width = canvas.width; // Clears the canvas
  
  		context.strokeStyle = "#df4b26";
  		context.fillStyle = "solid";
    	context.lineCap = "round";
			
  		for(var i=0; i < clickX.length; i++)
  		{		
    		context.beginPath();
    		if(clickDrag[i] && i){
     			context.moveTo(clickX[i-1], clickY[i-1]);
     		}else{
       			context.moveTo(clickX[i]-1, clickY[i]);
     		}
     		context.lineTo(clickX[i], clickY[i]);
     		context.closePath();
     		context.lineWidth = clickSize[i];
     		context.stroke();
  		}
	}

	$('#canvas').mousedown(function(e){
  		var mouseX = e.pageX - this.offsetLeft;
  		var mouseY = e.pageY - this.offsetTop - 41;
				
  		paint = true;
  		addClick(mouseX, mouseY);
  		redraw();
	});

	$('#canvas').mousemove(function(e){
  		if(paint){
  			var mouseX = e.pageX - this.offsetLeft;
  			var mouseY = e.pageY - this.offsetTop - 41;
  		  addClick(mouseX, mouseY, true);
  		  redraw();
  		}
	});

	$('#canvas').mouseup(function(e){
  		paint = false;
	});

	$('#canvas').mouseleave(function(e){
  		paint = false;
	});

});