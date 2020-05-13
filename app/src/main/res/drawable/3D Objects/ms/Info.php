


<div class="span4">

        <div class="span4 padding30 text-center place-left bg-color-blueLight" id="sponsorBlock">
                  <div class="bg-color-yellow fg-color-blueLight padding15" >
                        <h3 class="fg-color-blueDark">VOTING</h3>
                  </div>
                      
            
                 <fieldset>
                    <legend></legend>
                           
                            <html>
<head>
<script>
function getVote(int)
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("poll").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","poll_vote.php?vote="+int,true);
xmlhttp.send();
}
</script>
</head>
<body>

<div id="poll">
<h3>Apakah Jadwal Sangat Membantu?</h3>
<form>
Yes:
<input type="radio" name="vote" value="0" onClick="getVote(this.value)">
<br>No:
<input type="radio" name="vote" value="1" onClick="getVote(this.value)">
</form>
</div>
<script>
var myVar=setInterval(function(){myTimer()},1000);

function myTimer()
{
var d=new Date();
var t=d.toLocaleTimeString();
document.getElementById("demo").innerHTML=t;
}
</script>
</body>
</html> 
                    </fieldset>
                    
                    
                    
                                                                                                    
        </div>
    </div>
    
    
                