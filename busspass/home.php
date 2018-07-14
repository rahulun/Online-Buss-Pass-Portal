<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="slider.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
<style>
.mySlides {display:none;}


body{
background-color:#F6F1F1  ;

}

</style>
<body>
 


  <nav class="navbar navbar-light bg-faded navbar-fixed-top " style="background-color: #8FC7D3    ;">
  

  

    <div class="pull-xs-left">
     <a class="navbar-brand" href="home.php">
    <img src="icon3.png" width="30" height="30" >
  </a>

 <a href ='mywebpage.php'>

        <button class="btn btn-primary-outline fa fa-thumbs-up" ><span style="color:white">Register</span></button></a>


        <a href ='mywebpage.php'>

        <button class="btn btn-primary-outline fa fa-thumbs-up" ><span style="color:white">Contact us</span></button></a>

    </div>

</nav>

<h2 class="w3-center"></h2>

<div class="w3-content w3-section" style="position:absolute; height:100%; width:100%; margin-top:-20px;" >
  <img class="mySlides" src="bus1.jpg" style="width:100%; position:fixed; left:0;  max-width:100%;">
  
  <img class="mySlides" src="bus5.jpg" style="width:100%;  position:fixed; left:0;  max-width:100%;">


  

</div>



<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>

</body>
</html>
