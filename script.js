var x=1;
var previd="";
idflag=0;

function resetprop()
{
			document.getElementById('fname').innerHTML="";
			document.getElementById('ftype').innerHTML="";
			document.getElementById('fdate').innerHTML="";
			document.getElementById('funame').innerHTML="";
			document.getElementById('fsize').innerHTML="";
			document.getElementById('fexp').innerHTML="";
			document.getElementById("downbtn").style.display="none";
			document.getElementById("reportbtn").style.display="none";
}


function toggleUpload()
{
	var one,two;
	if(x==1)
	{	 one="none";
		 two="inline"; 
		 document.getElementById("dropdownicon").style.transform="rotate(180deg)";
		 x=0
	}
	else
		{	one="inline"; 
			two="none";
			document.getElementById("dropdownicon").style.transform="rotate(0deg)";
			x=1;
		} 

	document.getElementById("propertypanel").style.display=one;
	document.getElementById("uploadpanel").style.display=two;
}

function displayload () {
	document.getElementById("loadingimg").style.display="block";
}
function getproperties(q) 
{
	displayload();
	resetprop();
	xmlhttp = new XMLHttpRequest();
			 xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					var row= xmlhttp.responseText.split('`');
					document.getElementById("loadingimg").style.display="none";
					document.getElementById('fname').innerHTML="Name : "+row[6];
					document.getElementById('ftype').innerHTML="Type : "+row[0];
					document.getElementById('fdate').innerHTML="Date Uploaded : "+row[1];
					document.getElementById('funame').innerHTML="Uploader: "+row[2];
					document.getElementById('fsize').innerHTML="Size : "+row[3]+" MB";
					document.getElementById('fexp').innerHTML="Expiry : "+row[4]+" Hrs";
					fname=row[6];//-------------------------
					{
						dir = "files/uploads/";
						link=dir+fname+"."+row[0];
						var ref=document.getElementById("downlink");
						ref.setAttribute("href",link);
						document.getElementById("downbtn").style.display="inline";
						document.getElementById("reportbtn").style.display="inline";
					}
					}
				}
			
			xmlhttp.open("GET","getdetails.php?q="+q,true);
			xmlhttp.send(); 
}
	function unselect()
	{
		idflag=0; 
			previd="";
			resetprop();
			document.getElementById("loadingimg").style.display="none";
	}

function selectdiv(object)
{
	if(idflag==0)
			idflag=1;
	else	
		previd.style.boxShadow="0px 0px 5px 0px rgba(0,0,0,0.5)";
	if(previd!=object)
		{
			object.style.boxShadow= "0px 0px 10px 3px #33b6ea"; 
			previd=object;
			x=0;
			toggleUpload();											//Open properties
			getproperties(object.id);
		}
	else
		{
			unselect();
		}	

		
}


/*var status="";
var flag=2;
var counter=0;
function networkstatus()
{
	counter=0;
	xmlhttp = new XMLHttpRequest();
				
			 xmlhttp.onreadystatechange = function() {
			 	if(xmlhttp.status==0)
					{if(flag!=2){document.getElementById("statuslog").innerHTML="No Internet.."; flag=1;}}
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
						flag=0;
						if(flag==1)
						{document.getElementById("statuslog").innerHTML="Connected! :) "; flag=0; }
					}
					else
					{	counter++;
						if(counter>=4)
						{document.getElementById("statuslog").innerHTML="Server Error.. Reconnecting"; flag=1;}
					}
				}
			xmlhttp.open("GET","getnetworkstatus.php",true);
			xmlhttp.send(); 
}

function networkstatus()
{
	counter=0;
	xmlhttp = new XMLHttpRequest();
			 xmlhttp.onreadystatechange = function() {
					counter=xmlhttp.readyState;

				}
				document.getElementById("statuslog").innerHTML=""+counter;
			xmlhttp.open("GET","getnetworkstatus.php",true);
			xmlhttp.send(); 
}

function getValue()
{
	if(counter>=4)
		document.getElementById("statuslog").innerHTML="Connected";
	else
		document.getElementById("statuslog").innerHTML="Error!";
		
}
function checknet()
{
	networkstatus();
	window.setTimeout(getValue,5000);
}



*/