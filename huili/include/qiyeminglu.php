<?php
	$st=sprintf($SIG_HTML['RIGHT_TOP1'],"主页");
	echo $st;
	$st=sprintf($SIG_HTML['RIGHT_TOP2'],$err_string);
	echo $st;
	echo "<div id='slide1' class='inner' style='display:none;'><div class='order-empty panel'>";
?>
<div class="form">
<div class="searchbar">
	<div class="searchbar-search">
		<div class="form-group">
			<div class="form-prefix">
				<i class="icon-group picto"></i>
				<input class="form-control form-search" placeholder="按名称查找" value="" type="text">
			</div>
			<button class="btn btn-search">查找</button>
		</div>	
	</div>
	<div class="searchbar-dates">
		<div class="form-group">
			<div class="form-prefix">
				<i class="icon-group picto"></i>
				<input class="form-control form-daterange" placeholder="按行业过滤" value="" type="text">
				<span class="caret"></span>
			</div>
		</div>
	</div>
	<div class="searchbar-filters">
		<div class="dropdown dropdown-filters">
			<div class="form-group">
		   		<div class="form-prefix">
					<i class="icon-user picto"></i>
					<input class="form-control form-filters" id="texta1" placeholder="按属地过滤" value="" type="text">
					<span class="caret"></span>
				</div>	
			</div>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-filters">
				<div class="dropdown-menu-head text-right">
					<a class="btn-text" href="#">清空过滤</a>
				</div>
				<div class="dropdown-menu-body form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label">省份</label>
						<div class="col-sm-9">
							<select class="form-control">
								<option value="aaa">aaa</option>
								<option value="bbb">bbb</option>
								<option value="ccc">ccc</option>
							</select>
						</div>
					</div>
					<div class="form-group">
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">排序</label>
						<div class="col-sm-9">
							<div class="btn-group btn-group-switch">
								<button class="btn active">升序</button>
								<button class="btn">降序</button>
							</div>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">&nbsp;</label>
						<div class="col-sm-9">
							<button class="btn btn-primary btn-block btn-applyfilters" data-dismiss="dropdown">应用查询</button> 
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="searchbar-advanced"><p></p>
		<a href="#" class="btn-text btn-advancedsearch">高级搜索</a>
	</div>
</div>	
<script>
$(document).ready(function(){
	$("#texta1").click(function(){
			$(".dropdown-filters").toggleClass("open");
			});
	$(".btn-advancedsearch").click(function(){
			$(".searchbar-filters").show();
			});
});
</script>	
<?php
//	echo "<div><script type='text/javascript'>app.renderInlineToDOM(app.AccountPage, {'initialTab':'transactions'}, reduxStore);</script></div>";
?>

<?php
	echo "</div></div></div>";
	echo $SIG_HTML['RIGHT_TOP3'];
?>
