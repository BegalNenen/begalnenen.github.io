<nav class="w3-sidebar w3-bar-block w3-collapse w3-animate-left w3-card" style="z-index:3;width:250px;" id="mySidebar">
 <a class="w3-bar-item w3-teal w3-large">DAFTAR TOOLS</a>
 <a class="w3-bar-item w3-button" href="https://lepita.herokuapp.com/youtube-to-mp3">Youtube to Mp3</a>
  <a class="w3-bar-item w3-button" href="https://lepita.herokuapp.com/facebook-downloader">Facebook Downloader</a>
  <a class="w3-bar-item w3-button" href="https://lepita.herokuapp.com/tiktok-downloader">Tik Tok Downloader</a>
  <hr>
  <div>
    <a class="w3-bar-item w3-button" onclick="myAccordion('demo')" href="javascript:void(0)">Others Tools <i class="fa fa-caret-down"></i></a>
    <div id="demo" class="w3-hide">
      <a class="w3-bar-item w3-button" href="https://lepita.herokuapp.com/corona">Pantau Corona</a>
      <a class="w3-bar-item w3-button" href="https://lepita.herokuapp.com/text-generator">Text Generator</a>
      <a class="w3-bar-item w3-button" href="https://lepita.herokuapp.com/password-generator">Password Generator</a>
 <a class="w3-bar-item w3-button" href="https://lepita.herokuapp.com/al-quran">Al Quran Online</a>
<a class="w3-bar-item w3-button" href="https://lepita.herokuapp.com/random-number">Random Number</a>
   </div>
  </div>
  <hr>
 <a class="w3-bar-item w3-button" href="https://lepita.herokuapp.com/about">About</a>

</nav>

<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>

<div class="w3-main" style="margin-left:250px;">

<div id="myTop" class="w3-container w3-top w3-theme w3-large">
  <p><i class="fa fa-bars w3-button w3-teal w3-hide-large w3-xlarge" onclick="w3_open()"></i>
  <span id="myIntro" class="w3-hide"><a href="/"><b>LEPITA</b></a></span></p>
</div>
<header class="w3-container w3-theme" style="padding:64px 32px">
  <h1 class="w3-xxxlarge"><a href="/">Lepita</a></h1>Adalah web tools sederhana dengan berbagai macam fitur yang bisa kamu coba sebagai hiburan untuk mengusir kebosanan.
</header>
<script>
// Open and close the sidebar on medium and small screens
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

// Change style of top container on scroll
window.onscroll = function() {myFunction()};
function myFunction() {
  if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
    document.getElementById("myTop").classList.add("w3-card-4", "w3-animate-opacity");
    document.getElementById("myIntro").classList.add("w3-show-inline-block");
  } else {
    document.getElementById("myIntro").classList.remove("w3-show-inline-block");
    document.getElementById("myTop").classList.remove("w3-card-4", "w3-animate-opacity");
  }
}

// Accordions
function myAccordion(id) {
  var x = document.getElementById(id);
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
    x.previousElementSibling.className += " w3-theme";
  } else { 
    x.className = x.className.replace("w3-show", "");
    x.previousElementSibling.className = 
    x.previousElementSibling.className.replace(" w3-theme", "");
  }
}
</script>
<style>
	body {font-family: "Roboto", sans-serif}
.w3-bar-block .w3-bar-item {
  padding: 16px;
  font-weight: bold;
}
textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  resize: none;
}
.btn {
	background-color:#009788;
	color:#fff;
	width:100%;
	}
.btn-kecil {
	background-color:#009788;
	color:#fff;
	width:50%;
	}
.kaki {
	background-color:#009788;
	color:#fff;
	width:100%;
	text-align:center;
	padding-bottom:2.5px;
	padding-top:2.5px;
	}
.container {
  position: relative;
  overflow: hidden;
  width: 100%;
  padding-top: 56.25%; /* 16:9 Aspect Ratio (divide 9 by 16 = 0.5625) */
}

/* Then style the iframe to fit in the container div with full height and width */
.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  border:none;
}
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}
a {text-decoration:none;
}
input {
  display: inline-block;
  font-size: 16px;
}
input[type="text"]{
width:100%;
height:40px;
padding-left:2%;
}
input[type="number"]{
width:25%;
height:40px;
padding-left:2%;
}
input[type="checkbox"] + label {
  width: 180px;
  padding-right: 12px;
  margin: 10px 0;
  display: inline-block;
  cursor: pointer;
  text-align: left;
}

input[type="button"] {
  width: 220px;
  margin-top: 10px;
  display: inline-block;
  border: 1px solid #0096ff;
  background-color: #0096ff;
  color: #ffffff;
  padding: 8px 16px;
  transition: background-color .5s, color .5s;
}
input[type="button"]:hover {
  background-color: transparent;
  color: #0096ff;
  cursor: pointer;
}
#display {
width:50%;
height:40px;
padding:3%;
background:#fff;
border:1px solid grey;
}
</style>
