<?php
/**
 * @package base
 * @version 0.1.0.0
 * @author 田勇 Alias tybitsfox <tybitsfox@163.com>
 * @copyright (c) 2017 by tybitsfox
 * @license GPLv2
 * 
 * 本文件是土壤环境信息系统其中的一个文件
 * Available at http://202.102.134.68
 *
 * 这一程序是自由软件，你可以遵照自由软件基金会出版的GNU通用公共许可证条款来修改和重新
 * 发布这一程序。或者用许可证的第二版，或者（根据你的选择）用任何更新的版本。
 *
 * 发布这一程序的目的是希望它有用，但没有任何担保。甚至没有适合特定目的的隐含的担保。更
 * 详细的情况请参阅GNU通用公共许可证。
 *
 * 你应该已经和程序一起收到一份GNU通用公共许可证的副本。如果还没有，请查阅：
 * <http://www.gnu.org/licenses/>.
 * 或者写信给： The Free Software Foundation, Inc., 59 Temple Place, Suite 330, Boston,
 * MA  02111-1307  USA
 */
?>
<?php
$im = imagecreatetruecolor(100, 100); //创建100*100大小的画布
$red = imagecolorallocate($im, 255, 0, 0); //设置一个颜色变量为红色
 
imagefill($im, 0, 0, $red); //将背景设为红色
 
header('Content-type:image/png'); //通知浏览器这不是文本而是一个图片
imagepng($im); //生成PNG格式的图片输出给浏览器
 
imagedestroy($im); //销毁图像资源，释放画布占用的内存空间
?>

