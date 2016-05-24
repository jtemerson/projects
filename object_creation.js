function allFunctions(){
  happyObject();
  happyProperties();
  happyMethods();
  book();

}


///////////////////////////Objects/////////////////////////////
function happyObject(){
  var person = {
                firstName:"John",
                lastName:"Doe",
                age:50,
                eyeColor:"blue"
                };
                document.getElementById("happyObjectId").innerHTML = person.lastName;
}



///////////////////////////Properties/////////////////////////////
function happyProperties(){
  var person = {
        firstName:"John",
        lastName:"Doe",
        age:50,
        eyeColor:"blue"
        };

        document.getElementById("happyPropertiesId").innerHTML = person.eyeColor;
}

///////////////////////////Methods/////////////////////////////
function happyMethods(){
  var person = {
          firstName:"John",
          lastName:"Doe",
          age:50,
          eyeColor:"blue",
          fullName: function() {return this.firstName + " " + this.lastName;}
          };

          document.getElementById("happyMethodsId").innerHTML = person.fullName();
}

///////////////////////////Instantiation/////////////////////////////

function book() {
  this.paperBack = "You went cheap";
  this.hardCover = "That is a quality book";
}

var returnBook = new book();
document.getElementById("happyInstantiationId").innerHTML = returnBook.hardCover;


///////////////////////////Inheritance/////////////////////////////
function person(firstName, lastName, age, eyeColor) {
    this.firstName = first;
    this.lastName = last;
    this.age = age;
    this.eyeColor = eye;
  }

function student(firstName, lastName, age, eyeColor, iNumber, major){
  person.call(this, firstName, lastName, age, eyeColor);
  this.iNumber = iNumber;
  this.major = major;
}

var bob = new student("Bob", "Smith", 25, "blue", 45, "WDD");
console.log(bob.age);

//another example of Inheritance
function bear(legs, grawl, poop) {
    this.legs = 4;
    this.grawl = "loud";
    this.poop = volume;
  }

function grizzly(legs, grawl, poop, color){
  person.call(this, legs, grawl, poop);
  this.color = color;
}

var grizzly = new bear(4, "loud", "a lot", "brown");
console.log(grizzly.legs);







//
