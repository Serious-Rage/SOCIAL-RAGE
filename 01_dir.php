<?php ?>
<!DOCTYPE html>
<html lang="">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Local Directory Lister</title>
   <link rel="stylesheet" href="jquery-ui-1.11/jquery-ui.structure.min.css">
   <link rel="stylesheet" href="jquery-ui-1.11/jquery-ui.min.css">
  <link rel="stylesheet" href="jquery-ui-1.11/jquery-ui.theme.css">
   <link rel="stylesheet" href="bad.css">


  <script src="jquery-ui-1.11/external/jquery/jquery.js"></script>
   <script src="jquery-ui-1.11/jquery-ui.min.js"></script>
  <script>

  </script>

</head>


<body onload="setSlctDfault()">

 <?php include 'dirArrays.php';?>
<?php


?>

  <br><br><br>
<form id="f"  action="02_dir.php" method="post">
   <label for="rootdr" class="fltLft">htDocs Directorys - </label>
<select type="input" name="rootdr" id="rootdr" class="fltLft" onchange="showMe(this.value)">

  <?php
for ($x = 3; $x <= count($array); $x++) {
  if (is_dir($array[$x]))
    echo "<option value=\"".$array[$x]."\" >".$array[$x]."</option><br>";
}



?>

</select >




   <?php
// *************************************************************

// here this select will manifest if a dir has been posted
$rootdr = $_POST["rootdr"];
$mypath = $_POST["mypath"];

if (isset($_POST['rootdr'])) {
  echo $rootdr;
//$conCat2 = $myRoot . "/" . $rootdr;
//$dir = $rootdr;

// Sort in ascending order - this is default

$myRoot = getcwd();
$partB = "/".$rootdr."/";
$localSrvrRoot = "http://localhost:8888/";
//echo "<br><br>";
//echo $myRoot;
//echo "<br><br>";
$array2 = scandir($myRoot.$partB);
//print_r($array2);


echo "<label for=\"lvl2dir\" class=\"fltLft\">- </label>";
echo "<select type=\"input\" id=\"lvl2dir\" name=\"lvl2dir\" class=\"fltLft\" onchange=\"showMelvl2(this.value)\">";




  for ($y = 3; $y <= count($array2); $y++) {

  //  echo "<option value=\"".$array[$x]."/".$rootdr.\" >".$array[$x]."</option><br>";
     echo "<option value=\"".$array2[$y]."\" >".$array2[$y]."</option><br>";
}
  echo "</select>";

  echo  "<input id=\"mypath2\" name=\"mypath2\" size=\"120\" value=\"".$mypath."\" ></input>";
}
// *************************************************************

?>
   <button type="submit" form="f" value="Submit">Submit</button>
<br><br>
  <label for="rootFiles" class="fltLft"> htDocs Files     - </label>
<select id="rootFiles" class="fltLft" onchange="showMe2(this.value)">

  <?php
for ($x = 3; $x <= count($array); $x++) {
  if (is_file($array[$x]))
    echo "<option value=\"".$array[$x]."\" >".$array[$x]."</option><br>";
}


echo "</select>";




  ?>

   <br>
   <input id="mypath" name="mypath" size="120" ></input>
   <br>




</form>

  <br>


  <button id="goThere" onclick="goThere()">Go There</button>

  <script>

     var baseRoot = "http://localhost:8888/";
   var frstAftrBase = document.getElementById('rootdr').value;
  var concatR1 = baseRoot + frstAftrBase.value + "/";

    function goThere() {
       var grbVlu1=document.getElementById("mypath").value;
       location.href = grbVlu1;
    }

    function showMe(str) {
   // var x = document.getElementById("rootdr").value;
    // document.getElementById("mydiv").innerHTML = str;
    //  document.getElementById("mypath").value = str;
       var grbVlu1=document.getElementById("mypath");
    grbVlu1.value =  baseRoot + str;

        }
    function showMelvl2(str) {
       var grbVlu2=document.getElementById("mypath2");
      var Valgrb2 = grbVlu2.value;
      var grblvl2dir = document.getElementById("lvl2dir");
      var ValLvl2dir = "/" + str;
      var makeValThis = Valgrb2 + ValLvl2dir;
      var grbVlu1=document.getElementById("mypath");
      grbVlu1.value=makeValThis;


     // alert("level 2 triggered this message as event");
    }

     function showMe2(str) {
   // var x = document.getElementById("rootdr").value;
    // document.getElementById("mydiv").innerHTML = str;
    //  document.getElementById("mypath").value = str;
       var grbVlu1=document.getElementById("mypath");
    grbVlu1.value =  baseRoot + str;

        }


    function createNewSlct() {

   var crtSlct1 = document.createElement("SELECT");
    crtSlct1.setAttribute("id", "lvl2Select");
    document.body.appendChild(crtSlct1);

    var crtOpt1 = document.createElement("option");
    crtOpt1.setAttribute("value", "volvocar");
    var t = document.createTextNode("Volvo");
    crtOpt1.appendChild(t);
    document.getElementById("lvl2Select").appendChild(crtOpt1);

    }




function setSlctDfault() {
  document.getElementById('rootdr').options[0].setAttribute('selected','selected');
document.getElementById('f').reset(); // make it get applied by resetting form
    }


function grabbslcts() {
   document.getElementById("mypath").value = frstAftrBase;
}





  </script>

</body>
</html>
