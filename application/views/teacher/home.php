<?php 
		
		if($this->session->userdata('logged_in')!=1)
		redirect('home/index','location');
 ?>

 <!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">

  
body{
  background:darkslateblue;
  width: 100%;
  height: 100%;
  overflow: hidden;
  -moz-animation: 18s sky-change infinite linear;
  -webkit-animation: 18s sky-change infinite linear;
  animation: 18s sky-change infinite linear;
}

/** basic elements **/

div.grass,div.star,div.circle,div.crater{
  position: absolute;
}
div.grass{
  background-image:url('<?php echo base_url()."img/home_footer.png" ?>');
  width: 100%;
  height: 110px;
  bottom: 0;
  z-index: 1;
}
div.star,div.circle,div.crater{
  -moz-animation-duration: 18s;
  -webkit-animation-duration: 18s;
  animation-duration: 18s;
  -moz-animation-timing-function: linear;
  -webkit-animation-timing-function: linear;
  animation-timing-function: linear;
  -moz-animation-iteration-count: infinite;
  -webkit-animation-iteration-count: infinite;
  animation-iteration-count: infinite;
}
div.star{  
  background-color: white;
  width: 18px;
  height: 18px;
  -ms-transform: rotate(50deg);
  -webkit-transform: rotate(50deg);
  transform: rotate(50deg);
  -moz-box-shadow: 0px 0px 25px white;
  -webkit-box-shadow: 0px 0px 25px white;
  box-shadow: 0px 0px 25px white;
  -moz-animation-name: stars_switch;
  -webkit-animation-name: stars_switch;
  animation-name: stars_switch;
  z-index: -1;
}
div.star:nth-of-type(1){
  left: -moz-calc(50% - 20px);
  left: -webkit-calc(50% - 20px);
  left: calc(50% - 20px);
  top: 20%;
}
div.star:nth-of-type(2){
  left: 40%;
  top: 25%; 
}
div.star:nth-of-type(3){
  left: 59%;
  top: 28%;
}
div.star:nth-of-type(4){
  left: 67%;
  top: 36%;
}
div.star:nth-of-type(5){
  left: 70%;
  top: 47%;
}
div.star:nth-of-type(6){
  left: 80%;
  top: 48%;
}
div.star:nth-of-type(7){
  left: 83%;
  top: 37%;
}
div.star:nth-of-type(8){
  left: 13%;
  top: 16%;
}
div.star:nth-of-type(9){
  left: 90%;
  top: 10%;
}
div.star:nth-of-type(10){
  left: 18%;
  top: 70%;
}
div.circle,div.crater{
  -moz-border-radius: 50%;
  -webkit-border-radius: 50%;
  border-radius: 50%;
}
div.circle{
  bottom: -150px;
  left: 0;
  width: 150px;
  height: 150px;
  -moz-box-shadow: 0px 0px 25px yellow;
  -webkit-box-shadow: 0px 0px 25px yellow;
  box-shadow: 0px 0px 25px yellow;
  -moz-animation-name: sunsets;
  -webkit-animation-name: sunsets;
  animation-name:sunsets;
}
div.crater{
  background-color: red;
  -moz-box-shadow: 0px 0px 1px 1px hsl(0,0%,60%);
  -webkit-box-shadow: 0px 0px 1px 1px hsl(0,0%,60%);
  box-shadow: 0px 0px 1px 1px hsl(0,0%,60%);
  -moz-animation-name: craters_switch;
  -webkit-animation-name: craters_switch;
  animation-name: craters_switch;
}
div.crater:nth-of-type(1){
  width: 15px;
  height: 15px;
  left: 25%;
  bottom: 15%;
}
div.crater:nth-of-type(2){
  width: 15px;
  height: 15px;
  left: 50%;
  top: 15%;
}
div.crater:nth-of-type(3){
  width: 22px;
  height: 22px;
  left: calc(50% - 12px);
  top: calc(50% - 12px);
}
div.crater:nth-of-type(4){
  width: 12px;
  height: 12px;
  left: 10%;
  top: 50%;
}
div.crater:nth-of-type(5){
  width: 14px;
  height: 14px;
  left: 70%;
  top: 30%;
} 
/** basic elements **/

/** keyframes **/
@keyframes sky-change{
  0%{
    background-color: darkslateblue;
    box-shadow: 0px -450px 300px -400px orange inset;
  }
  25%{
    background-color: skyblue;
    box-shadow: 0px -450px 300px -400px steelblue inset;
  }
  50%{
    background-color: darkslateblue;
    box-shadow: 0px -450px 300px -400px orange inset;
  }
  100%{
    background-color: darkslateblue;
  }
}
@keyframes sunsets{
  0%{
    bottom: -150px;
    left: 0;
    background: orange;
  }
  25%{
    bottom: calc(100% - 220px);
    left: calc(50% - 100px);
    background: gold;
  }
  38%{
    background: yellow;
  }
  50%{
    bottom: -152px;
    left: 102%;
    background: orange;
  }
  51%{
    bottom: -150%;
    left: -150px;
  }
  52%{
    bottom: 25%;
    left: -150px;
    background: hsl(0,3%,70%);
    box-shadow: 0px 0px 25px hsl(0,1%,60%);
  }
  75%{
    left: 50%;
    bottom: 75%;
  }
  100%{
    left: calc(100% + 150px);
    bottom: 25%;
    background: hsl(0,3%,70%);
  }
}
@keyframes craters_switch{
  0%{
    background-color: transparent;
    box-shadow: none;
  }
  49%{
    background-color: transparent;
    box-shadow: none;
  }
  100%{
    background-color: hsl(0,0%,60%);
  }
}
@keyframes stars_switch{
  0%{
    background-color: transparent;
    box-shadow: none;
  }
  49%{
    background-color: transparent;
    box-shadow: none;
  }
  51%{
    background-color: white;
    box-shadow: 0px 0px 25px white;
  }
  60%{
    box-shadow: 0px 0px 15px white;
  }
  80%{
    box-shadow: 0px 0px 10px white;
  }
  90%{
    box-shadow: 0px 0px 15px white;
  }
  100%{
    box-shadow: 0px 0px 25px white;
}

  </style>
</head>
<body>
	 <center><p id ="tt"class="blue" style="font-family:Bradley Hand ITC; font-weight:800; font-size: 250%">XeroneIT World</p></center>
  <div class="grass"></div>
<div class="circle"> 
  <div class="crater"></div>
  <div class="crater"></div>
  <div class="crater"></div> 
  <div class="crater"></div>
  <div class="crater"></div>
</div>
<div class="stars">
  <div class="star"></div>
  <div class="star"></div>
  <div class="star"></div>
  <div class="star"></div>
  <div class="star"></div>
  <div class="star"></div>
  <div class="star"></div>
  <div class="star"></div>
  <div class="star"></div>
  <div class="star"></div>
</div>

</body>
</html>
