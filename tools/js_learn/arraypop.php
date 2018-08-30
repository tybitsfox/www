<?php
$a1=array(0,1);$a2=array('a','b','c');
$ay=array();
array_push($ay,$a1);
array_push($ay,$a2);
echo "origin: ";
var_dump($ay);
echo "<br><br>";
$bc=array();
$bc=array_pop($ay);
echo "after pop: ";
var_dump($bc);
$str="山东省";
echo $str;
?>
<div id="aa"></div>
<button onclick="bb();">click</button>
<script>
var st=<?php echo '"山东省"';?>;
function bb()
{
//	alert("aaa");
	var v=document.getElementById("aa");
	var len=st.length;
	v.innerHTML=len;
};
</script>
