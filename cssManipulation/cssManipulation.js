function happyManipulation(){
  var myDiv = document.querySelector("#blue");
  myDiv.style.backgroundColor = "green";
}

function nastyPaths(){

  var myElement = document.querySelector("#blue");
  myElement.style.backgroundColor = "grapefruit"; //invalid css

  var myElement = document.querySelector("#blue");
  myElement.style.backgroundColor = null; //null

  var myElement = document.querySelector("#blue");
  myElement.style.backgroundColor = " "; //empty string

}











//
