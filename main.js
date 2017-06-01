var canvas;
window.onload = function() {
	canvas = new fabric.Canvas("canvas");
	canvas.setWidth(500);
	canvas.setHeight(500);
}

function white_shirt(string) {
	canvas.add(fabric.Image.fromURL(string,function(oImg){
		oImg.scale(0.5);
		oImg.selectable = false;
		canvas.add(oImg);
	}));
}
function addText() {
 	var text = window.prompt("Voer tekst in");
 	var color = window.prompt("Voer kleur in");
 	console.log(text);
 	var textObject = new fabric.Text(text).setColor(color);
 	canvas.add(textObject);
}
function loadImage(src) {
	if(!src.type.match(/image.*/)){
		return;
	}
	var reader = new FileReader();
	reader.onload = function(e){
		canvas.add(fabric.Image.fromURL(e.target.result,function(oImg){
			oImg.scale(0.5);
			canvas.add(oImg);
		}));
	}
	reader.readAsDataURL(src);
}
var target = document.getElementById("droptarget");
target.addEventListener("dragover",function(e){e.preventDefault();})
target.addEventListener("drop",function(e){
	e.preventDefault();
	loadImage(e.dataTransfer.files[0]);
}, true);

window.addEventListener("keydown", function(e){
 if(e.keyCode == 46) {
  canvas.getActiveObject().remove();
 }
});