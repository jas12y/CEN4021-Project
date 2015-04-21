<html>
<meta charset="utf8">
<head><title>Kanji Tools</title>
<link href="http://fonts.googleapis.com/css?family=Lobster" rel"stylesheet">
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/mycss.css">
<meta name="viewpoint" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="./js/bootstrap.min.js"> </script>
<style>
.card {
  position: relative;
  float: left;
  padding-bottom: 25%;
  left: 165px;
  width: 25%;
  text-align: center;
}

.card__front,
.card__back {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.card__front,
.card__back {
  -webkit-backface-visibility: hidden;
          backface-visibility: hidden;
  -webkit-transition: -webkit-transform 0.3s;
          transition: transform 0.3s;
}

.card__front {
  background-color: #b5d8e8;
}

.card__back {
  background-color: #d3d3d3;
  -webkit-transform: rotateY(-180deg);
          transform: rotateY(-180deg);
}
.card__text {
  display: inline-block;
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  margin: auto;
  height: 20px;
//  color: #fff;
  font-family: "Roboto Slab", serif;
  line-height: 20px;
}
.card.effect__click.flipped .card__front {
  -webkit-transform: rotateY(-180deg);
          transform: rotateY(-180deg);
}

.card.effect__click.flipped .card__back {
  -webkit-transform: rotateY(0);
          transform: rotateY(0);
}
</style>
</head>
<body>
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand newfont"><font face="mv boli">Kanji Tools</font></a>
    </div>
      <ul class="nav navbar-nav pull-right">
      <li><a href="index.html">Home</a></li>
      <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" > Kanji Search <span class="caret"></span></a>
	  <ul class="dropdown-menu" role="menu">
            <li><a href="meaning.php">Search by Meaning</a></li>
            <li><a href="hiragana.php">Search by Hiragana</a></li>
            <li><a href="byradical.php">Search by Radical</a></li>
            <li><a href="stroke.php">Search by Stroke Count</a></li>
	  </ul>
      </li> 
      <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown"> Word Search <span class="caret"></span></a>
	  <ul class="dropdown-menu" role="menu">
            <li><a href="etoj.php">Search by English</a></li>
            <li><a href="jtoe.php">Search by Japanese</a></li>
	  </ul>
      </li>
      <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown"> Study Area <span class="caret"></span></a>
	  <ul class="dropdown-menu" role="menu">
            <li><a href="quiz.php">Take a Quiz</a></li>
            <li class="active"><a href="flashcard.php">Make some Flashcards</a></li>
	  </ul>
      </li>
      </ul>
    </div>
  </div>
</nav>
<div id="content">
<div class="container-fluid">
 <div class="row">
  <div class="col-sm-3 col-md-2 sidebar">
   <ul class="nav nav-sidebar">
    <li> Flash Card Methods </li>
    <li> <a href=glcards.php> Grade Level Cards </a> </li>
    <li> <a href=randcards.php> Random Cards </a> </li>
    <li> <a href=bykanjicards.php> Specific Kanji </a> </li>
   </ul>
   <ul class="nav nav-sidebar">
    <li> External Links </li>
    <li> <a href="http://www.kanjialive.com"> Kanji Alive </a> </li>
    <li> <a href="http://www.edrdg.org/jmdict/j_jmdict.html"> JMDict </a> </li>
   </ul>
   <ul class="nav nav-sidebar">
    <li> <a> </a> </li>
    <li> <a> Kanji Tools </a> </li>
    <li> <a> Flipadelphia </a> </li>
   </ul>
  </div>
  <div class="col-sm-9 ">
    <h2> Random Flashcards! </h2>
     <p> This card set is generated by providing randomly chosen vocabulary words </p>
     <form action="randcards.php" method="post">
      <input type="submit" class="btn btn-sm btn-success" name="random" value="Random">
     </form>


<?php
include "database_connector.php";
if($_SERVER["REQUEST_METHOD"] == "POST") {
	if(isset($_POST['random'])) {
	//	echo "I still win\n";
		$answers = array();
		$problems = array();
		$kanji = array();
		$temp = mysqli_query($con,"SELECT count(*) FROM dictionary WHERE id > 0");
		$num_of_entries = mysqli_fetch_array($temp);
	//	echo $num_of_entries[0] . "\n";
		$j = 0;
		for($j; $j < 10; $j++) {
			$my_rand = rand(1,$num_of_entries[0]);
			$temp = mysqli_query($con,"SELECT * FROM dictionary WHERE id=$my_rand");
			$temp2 = mysqli_fetch_array($temp);
			array_push($answers,"$temp2[5]");
			array_push($problems,"$temp2[3]");
			array_push($kanji,"$temp2[1]");
		}
/*		$i = 0;
		for($i; $i < 5; $i++) {
			$my_rand = rand(1,$num_of_entries[0]);
			$temp = mysqli_query($con,"SELECT * FROM dictionary WHERE id=$my_rand");
			$temp2 = mysqli_fetch_array($temp);
			array_push($answers,"$temp2[3]");
			array_push($problems,"$temp2[5]");
			array_push($kanji,"$temp2[1]");
		}
*/
$kanji = implode(",", $kanji);
$answers = implode(",", $answers);
$problems = implode(",", $problems);
?>
<!-- *************************************************************************************** -->
<script type="text/javascript"> 
var i = 0;
var eng = new Array();   
eng = '<?php echo $answers; ?>'.split(",");  
var k = eng.length-1;    
var word = new Array(); 
word = '<?php echo $kanji; ?>'.split(",");
var furi = new Array(); 
furi = '<?php echo $problems; ?>'.split(",");

function next(){
var frnt = document.getElementById("front"); 
frnt.innerHTML=word[i]; 
var ebck = document.getElementById("eback"); 
ebck.innerHTML= eng[i]; 
var rbck = document.getElementById("rback"); 
rbck.innerHTML= furi[i]; 
if(i < k ) { i++;}  
else  { i = 0; }
}

function prev(){
var frnt = document.getElementById("front"); 
frnt.innerHTML=word[i]; 
var ebck = document.getElementById("eback"); 
ebck.innerHTML= eng[i]; 
var rbck = document.getElementById("rback"); 
rbck.innerHTML= furi[i]; 
if(i >0 ) { i--;}  
else  { i = k; } 
}

function swapImage(){ 
var frnt = document.getElementById("front"); 
frnt.innerHTML=word[i]; 
var ebck = document.getElementById("eback"); 
ebck.innerHTML= eng[i]; 
var rbck = document.getElementById("rback"); 
rbck.innerHTML= furi[i]; 
if(i < k ) { i++;}  
else  { i = 0; }  
} 
function addLoadEvent(func) { 
var oldonload = window.onload; 
if (typeof window.onload != 'function') { 
window.onload = func; 
} else  { 
window.onload = function() { 
if (oldonload) { 
oldonload(); 
} 
func(); 
} 
} 
} 
addLoadEvent(function() { 
swapImage(); 
});  
</script>
 
<table width = "100%">
<tr>
          <div class="card effect__click">
            <div class="card__front">
              <span id="front" name="card_fnt" class="card__text"></span>
            </div>
            <div class="card__back">
<div class="card__text">

              <span id="eback" name="card_bck"></span>
</br>
		<span id="rback" name="card_bck"></span>

</div>
            </div>
        </div><!-- /card -->
</tr><tr><td style="padding-left:23%">
<img onclick="prev()" height="40" width="40"src="images/prev.jpg"/> 
<img onclick="next()" height="40" width="40" src="images/next.jpg"/> 
</td></tr></table>

<script type="text/javascript">
(function() {
  var cards = document.querySelectorAll(".card.effect__click");
  for ( var i  = 0, len = cards.length; i < len; i++ ) {
    var card = cards[i];
    clickListener( card );
  }

  function clickListener(card) {
    card.addEventListener( "click", function() {
      var c = this.classList;
      c.contains("flipped") === true ? c.remove("flipped") : c.add("flipped");
    });
  }
})();
</script>
<!-- *************************************************************************************** -->
<?php

	}
}
?>
	</div>
  </div>
 </div>
</div>
</div>
</body>
</html>