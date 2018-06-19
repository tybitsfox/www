function chlinkfunc()
{
	var str=window.document.location.href.toString();
	var b=str.split('=');
	if(typeof(b[1]) == 'string')
	{
		var i;
		for(i=0;i<liaa.length;i++)
		{
			if(liaa[i][1] == b[1])
			{
				document.getElementById(liaa[i][0]).className='btn-addmerchant active';
				break;
			}
		}
		if(i >= liaa.length)
			document.getElementById(liaa[0][0]).className='active';
	}
	else
		document.getElementById(liaa[0][0]).className='active';
}
function set_min(u)
{
	var ay;
	var str=document.getElementById('upmodule');
	if(str == null)
		return;
	if(str.length == 0)
		ay=array();
	else
		ay=str.value.split(',');
	var i,st;
	i=u.length-1;
	st=u.substring(6,i);
	var a=document.getElementById(u).className.toString();
	if(a.match('plus'))
	{
		document.getElementById(u).className='icon-minus';
		document.getElementById(u).style='color:#455f6c';
		ay.push(st);
	}
	else
	{
		document.getElementById(u).className='icon-plus';
		document.getElementById(u).style='color:#fff';
		i=ay.indexOf(st);
		ay.splice(i,1);
	}
	str.value=ay;
}

