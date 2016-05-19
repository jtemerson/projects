<!DOCTYPE html>
<html>
    <head>
        <?php include $_SERVER['DOCUMENT_ROOT']. '/modules/head.php'; ?>
    </head>
    <body class="sandbox">
        <header>
            <div>
                <?php include $_SERVER['DOCUMENT_ROOT']. '/modules/header.php'; ?>
            </div>
        </header>

        <nav>
            <div>
                <?php include $_SERVER['DOCUMENT_ROOT']. '/modules/nav.php'; ?>
            </div>
        </nav>

        <main>
            <div class="container">
                <h1>Object Creation</h1>
                <p>
                    An object is a container for named values. They are variables also.
                    The name:values pairs (in JavaScript objects) are called properties.
                </p>
                    <h2>Happy Path</h2>
                        <p id="person"></p>
                        <script>
                            var person = {
                            firstName:"John",
                            lastName:"Doe",
                            age:50,
                            eyeColor:"blue"
                            };

                            document.getElementById("person").innerHTML = person.lastName;

                        </script>
                    <h2>Nasty Path</h2>

                <h1>Functions</h1>
                    <h2>Happy Path</h2>
                        <button onclick="printNumbers()" class="btn btn-success">Test Function</button>
                        <p id="happyPath"></p>
                        <script>
                            function printNumbers(){
                                var numbers = "";
                                for (var i = 0; i < 11; i++){
                                    numbers += i + ", ";
                                }
                                document.getElementById("happyPath").innerHTML = numbers;
                            }
                        </script>

                    <h2>Nasty Path</h2>
                        <h3>No "()"</h3>
                            <button onclick="printNumbers2()" class="btn btn-success">Test Function</button>
                            <p id="nastyPath"></p>
                            <script>
                                function printNumbers2{
                                    var numbers = "";
                                    for (var i = 0; i < 11; i++){
                                        numbers += i + ", ";
                                    }
                                    document.getElementById("nastyPath").innerHTML = numbers;
                                }
                            </script>

                            <h3>No "function"</h3>
                                <button onclick="printNumbers3()" class="btn btn-success">Test Function</button>
                                <p id="nastyPath"></p>
                                <script>
                                    printNumbers3(){
                                        var numbers = "";
                                        for (var i = 0; i < 11; i++){
                                            numbers += i + ", ";
                                        }
                                        document.getElementById("nastyPath").innerHTML = numbers;
                                    }
                                </script>
                <h1>Properties</h1>
                <p>
                    The name:values pairs (in JavaScript objects).
                </p>
                    <h2>Happy Path</h2>
                    <p id="person1"></p>
                    <script>
                        var person = {
                        firstName:"John",
                        lastName:"Doe",
                        age:50,
                        eyeColor:"blue"
                        };

                        document.getElementById("person1").innerHTML = person.eyeColor;

                    </script>
                    <h2>Nasty Path</h2>
                <h1>Methods</h1>
                    <p>
                        Methods are actions that can be performed on objects. They are stored in properties as function definitions.
                    </p>
                    <h2>Happy Path</h2>
                        <p id="person2"></p>
                        <script>
                            var person = {
                            firstName:"John",
                            lastName:"Doe",
                            age:50,
                            eyeColor:"blue",
                            fullName: function() {return this.firstName + " " + this.lastName;}
                            };

                            document.getElementById("person2").innerHTML = person.fullName();

                        </script>
                    <h2>Nasty Path</h2>
                <h1>Instantiation</h1>
                    <p>
                        Functional instantiation is at the root of object instantiation in JavaScript.
                        We create a function, and inside it, we can create an empty object, some scoped
                        variables, some instance variables, and some instance methods. At the end of it all,
                        we can return that instance, so that every time the function is called, we have access to those methods
                    </p>
                    <h2>Happy Path</h2>
                        <script>
                        // Set up
                        function book() {
                          var bookInstance = {};
                          var paperBack = "You went cheap";
                          var hardCover = "That is a quality book";

                          bookInstance.paper = function() {
                            return paperBack;
                          }

                            bookInstance.hard = function() {
                                return hardCover;
                              }
                          return bookInstance;
                        }

                        // Usage
                        var returnBook = book();
                        var result = returnBook.hard(); // returns 1

                        </script>
                        <p id="book">

                        </p>
                    <h2>Nasty Path</h2>
                <h1>Inheritance</h1>
                    <h2>Happy Path</h2>
                        <script>
                            function Mammal(name){
                            this.name=name;
                            this.offspring=[];
                            }
                            Mammal.prototype.haveABaby=function(){
                            var newBaby=new Mammal("Baby "+this.name);
                            this.offspring.push(newBaby);
                            return newBaby;
                            }
                            Mammal.prototype.toString=function(){
                            return '[Mammal "'+this.name+'"]';
                            }


                            Cat.prototype = new Mammal();        // Here's where the inheritance occurs
                            Cat.prototype.constructor=Cat;       // Otherwise instances of Cat would have a constructor of Mammal
                            function Cat(name){
                            this.name=name;
                            }
                            Cat.prototype.toString=function(){
                            return '[Cat "'+this.name+'"]';
                            }
                        </script>
                    <h2>Nasty Path</h2>
            </div>
        </main>

        <footer>
            <div>
                <?php include $_SERVER['DOCUMENT_ROOT']. '/modules/footer.php'; ?>
            </div>
        </footer>
    </body>
</html>
