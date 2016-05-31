//Local Storage API, Storing and Retrieving Simple Data, Arrays, Associative Arrays, and Objects

function allFunctions(){
  localStorageExample();
  localStorageExample2();
}

//Happy Path (dot notation)
function localStorageExample(){
  // Store Var
  var name = "Emerson";
  localStorage.lastname = name;

  console.log(localStorage.lastname);

  // Store Array
  var cars = ["Ford", " Dodge", " Chevy", " Subaru", 10, 15]; //creat array
  var carsString = JSON.stringify(cars); //stringify array
  localStorage.cars = carsString; //store array

  var carsString2 = localStorage.cars; //retrieve stored array
  newCars = JSON.parse(carsString2); // pars retrieved array (because it is a string)
  console.log(newCars[3]); //call "subaru" from array




  //Store Associative array
  var student = {"Name": 'JT', "Age": 24};
  var studentString = JSON.stringify(student);
  localStorage.student = studentString;

  var studentString2 = localStorage.student;
  newStudent = JSON.parse(studentString2);
  console.log(newStudent["Age"]);
}

//Example 2 does the same thing but uses the Associative array notation.
function localStorageExample2(){
  var aName = "Emerson";
  localStorage["name"] = aName;

  console.log(localStorage.name);
}





//Nasty Path 1 - store nothing

function nastyPath1(){
  localStorage.groceries;

  document.getElementById("nastyPath1Id").innerHTML = localStorage.groceries;
}

//Nasty Path 2 - empty string
function nastyPath2(){
  localStorage.groceries = "";

  document.getElementById("nastyPath2Id").innerHTML = localStorage.groceries;
}

//Nasty Path 3 - store null
function nastyPath3(){
  localStorage.groceries = null;

  document.getElementById("nastyPath3Id").innerHTML = localStorage.groceries;
}

//Nasty Path 4 - undeclared var
function nastyPath4(){
  localStorage.groceries = dogPoop;

  document.getElementById("nastyPath4Id").innerHTML = localStorage.groceries;
}

//Nasty Path 5v - store something that is stored.
function nastyPath5(){
  localStorage.world = "Hello World";
  localStorage.messageToTheWorld = localStorage.world;

  document.getElementById("nastyPath5Id").innerHTML = localStorage.messageToTheWorld;
}

//Nasty Path 6
function nastyPath3(){

  document.getElementById("nastyPath6Id").innerHTML = localStorage.whatsUp;
}














//
