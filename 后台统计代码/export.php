<?php 
header('Content-type: text/html; charset=utf-8');
header("Content-type:application/vnd.ms-excel;charset=UTF-8"); 
header("Content-Disposition:filename=data.xls"); //输出的表格名称
echo "ID\t";echo "路径\t";echo "IP\t";echo "添加时间\t";echo "数次\t";echo "微信号\t\n";;
//这是表格头字段 加\T就是换格,加\T\N就是结束这一行,换行的意思

$conn = mysql_connect("localhost","root","g7rg6431d67gt814f@#145") or die("不能连接数据库");
mysql_select_db("user", $conn);
mysql_query("set names 'UTF-8'");
//$sql="select * from tongji";


$sql = isset($_GET['sql']) ? $_GET['sql'] : '';

$result=mysql_query($sql);




while($row=mysql_fetch_array($result)){

echo $row[0]."\t"; 
echo $row[1]."\t";
echo $row[2]."\t";
echo $row[3]."\t";
echo $row[4]."\t\n";
}
?>