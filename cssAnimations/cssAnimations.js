//Creating CSS3 Transitions and Animations in CSS and triggering them with JavaScript

   
function causeTransition(){
  var div1 = document.querySelector("#transition");

  div1.style.width = "300px";
  div1.style.height = "300px";
  div1.style.transform = "rotate(360deg)";
}

//nasty paths
var div1 = document.querySelector("#transition");

div1.style.width = "300px";
div1.style.height = "300px";
div1.style.transform = " "; //empty



var div1 = document.querySelector("#transition");

div1.style.width = "300px";
div1.style.height = "300px";
div1.style.transform = "poop"; //invalid css



var div1 = document.querySelector("#transition");

div1.style.width = "300px";
div1.style.height = "300px";
div1.style.transform = null; //null













function causeAnimation(){
  var div2 = document.querySelector("#animation");

  div2.style.animationDuration = "4s";
  div2.style.animationIterationCount = "3";
}

//nasty paths

var div2 = document.querySelector("#animation");

div2.style.animationDuration = " "; //empty
div2.style.animationIterationCount = " "; //empty


var div2 = document.querySelector("#animation");

div2.style.animationDuration = null; //null
div2.style.animationIterationCount = null; //null


var div2 = document.querySelector("#animation");

div2.style.animationDuration = "dog crap"; //invalid
div2.style.animationIterationCount = "dog crap"; //invalid













//
