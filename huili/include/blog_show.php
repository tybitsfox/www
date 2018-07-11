<?php
if(!defined("FULL_PATH"))
	define("FULL_PATH",substr(dirname(__FILE__),0,strlen(dirname(__FILE__))-strlen(strstr(dirname(__FILE__),"huili")))."huili".DIRECTORY_SEPARATOR);
require_once(constant("FULL_PATH")."config/glob_new.php");	//全局常量及变量定义文件的引入
require_once(constant("FULL_PATH")."config/glob_prev.php");	//全局常量及变量定义文件的引入
include_once(constant("FULL_PATH")."include/head_doc.php"); //起始头文件的引入
$idx_num=0;
$ay=array();
if(isset($_GET['blog_index']))
	$idx_num=intval($_GET['blog_index']);
if($idx_num > count($GLOB_DEF['BLOG_ARRY']))
	$idx_num=0;
$ay=$GLOB_DEF['BLOG_ARRY'][$idx_num];
?>
  <section class='promo ultrashort blog'>
    <div class='container'>
      <div class='promo-msg wide'>
        <p class='sect nomargin animated'>汇氏管家的博客</p>    
      </div>
    </div>
  </section>
  <section class='block block-blog grey'>
    <div class='container'>
      <div>
        <div class='textblock widest'>
          <div class='blogpost-article'>
            <article class='blogpost'>
                <header class='inner'>
                  <p class='blog-sect'></p>
                  <h1><?php echo $ay[1];?></h1>
                  <p class='author'><?php echo $ay[4];?></p>
                  <div class='blog-soc'>
                    <ul class='list-unstyled list-blogsoc'>
                      <li>
                        <a href='#' data-facebook='gb-blog' class='btn'><i class='icon-wechat'></i></a>
                      </li>
                      <li>
                        <a href='#' class='btn' target='social-share'><i class='icon-tqq'></i></a>
                      </li>
                      <li>
					  <?php echo"<a href='/huili/index.php?selecter=".$GLOB_DEF['PG_FUR']."' class='btn' target='social-share'><i class='icon-chevron_right'></i></a>";  ?>
                      </li>
                    </ul>
                  </div>
                </header>
                <div class='inner wide'>
                  <div class='blog-img'>
                    <img src='<?php echo $ay[2];?>' alt='<?php echo $ay[1];?>'/>
                  </div>
                </div>
              <div class='inner'>
				<?php $st=constant("FULL_PATH").$ay[6];include($st);?>
              </div>
            </article>
          </div>
        </div>
      </div>
    </div>
  </section>
          <section class='block block-highlight'>
            <div class='container'>
                <div class='inner'>
                    <h2 class='full'>加入我们</h2>
                    <p class='intro'></p>
                    <div class='ctablock'>
                        <div class='signup'>
                            <form class='form' action='/register/signup' method='POST'>
                                <input type='hidden' value='f807ced2-a1d9-495c-a35d-dcc95bc64240' name='authenticityToken' />
                                <div class='form-group'>
                                    <div class='form-prefix'>
                                        <i class='icon-envelope picto'></i>
                                        <input class='form-control' type='text' name='email' value='' required placeholder='使用邮箱注册' />
                                    </div>
                                    <button type='submit' class='btn btn-primary'>开始加入</button>
                                </div>
                                <?php echo "<a href='/huili/index.php?selecter=".$GLOB_DEF['PG_FUR']."' class='mysty'>继续浏览</a>";?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<style>
.mysty:link{color:white;}
.mysty:visited{color:white;}
</style>		
<?php
//include_once(constant("FULL_PATH")."include/blog.php");
include_once(constant("FULL_PATH")."include/foot.php");	//底部文件的引入
?>
