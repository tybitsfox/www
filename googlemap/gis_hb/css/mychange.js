function onsss()
{
	//var jary=document.getElementById("arry");
	//alert(jary);
	var x=document.getElementById("sel1p");
	var i=x.selectedIndex;
	if(i>jary.length)
		alert('length error!');
	var av=jary[i];
	var y=document.getElementById("sel3p");
	var k=y.selectedIndex;
	if(k > av.length)
		alert('length error again');
	var bv=av[k];
	var v=document.getElementById('sel2p');
	v.options.length=0;	//clear
//	var j=av.length;
	var j=bv.length;
	for(i=0;i<j;i++)
	{
		var aa=new Option;
		aa.value=bv[i][0];
		aa.text=bv[i][1];
		v.add(aa);
	} 
}
function onssa()
{
	var v=document.getElementById('sel2p');
	var i=v.selectedIndex;
	var bb=v.Option[i].value
}
function onass()
{
	var x=document.getElementById("sel1");
	var i=x.selectedIndex;
	if(i>jary.length)
		alert('length error!');
	var b=x.options[i].value;
	var av=jary[i];
	if(av[0][0] != b)
		alert("not equal!");
	else
	{
		var v=document.getElementById("sel3");
		v.options.length=0;
		var j=av.length;
		for(i=0;i<j;i++)
		{
			var aa=new Option;
			aa.value=av[i][2];
			aa.text=av[i][1];
			v.add(aa);
		}
	}
}
