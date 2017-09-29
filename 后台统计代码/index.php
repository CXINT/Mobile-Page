<?php
include_once("conn.php");
require_once('page.class.php'); //分页类
$showrow = 100; //一页显示的行数
$curpage = empty($_GET['page']) ? 1 : $_GET['page']; //当前的页,还应该处理非数字的情况
$url = "?page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q']

//省略了链接mysql的代码，测试时自行添加

$sql = "SELECT * FROM user";
$sql = $sql." where 1=1 ";


$clinkurl = isset($_GET['clinkurl']) ? $_GET['clinkurl'] : '';
//echo $clinkurl;
if($clinkurl!=''){
	  $str = strstr( $clinkurl, '/?', TRUE );	
	  if($str!=''){$clinkurl =   $str;}
} 
//echo $clinkurl;
if($clinkurl!=''){
	$sql = $sql." and  url like '%$clinkurl%'";
}

$sql = $sql." order by id desc";

$daochu_sql  =  $sql;

$total = mysql_num_rows(mysql_query($sql)); //记录总条数

if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow))
    $curpage = ceil($total_rows / $showrow); //当前页数大于最后页数，取最后一页

//获取数据
$sql .= " LIMIT " . ($curpage - 1) * $showrow . ",$showrow;";
//echo $sql;
//exit;
$query = mysql_query($sql);


?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <title>统计管理系统</title>
        <meta name="keywords" content="php分页类" />
        <meta name="description" content="本文介绍一款原生的PHP分页类，分页样式有点类似bootstrap。" />
    </head>
    <body>	
    <style>
        #content{
            display: block;
            width: 40px;
            height: 40px;
            line-height: 58px;
            float: left;
            margin-right: 10px;
            border: solid 1px #fff;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            color: #333;
width: 100px !important;
height: 30px !important;
font-weight: bold;
line-height: 30px !important;
background: #3c8dbc;
color: #fff !important;
margin-top: 6px !important;
        }
    </style>


            <a id='content' href="export.php?sql=<?php echo $daochu_sql;?>">导出</a>
			<a href="index.php">回全部链接首页<a/>
            <div class="demo">
                <div class="showData">
					<style>.tab tr td {border: 1px solid #000;padding: 5px;}table tr:nth-child(odd){background: #ddd;}</style>
					<table cellspacing="0" cellpadding="0"  width="80%" style="text-align:center;border: 1px solid #000;" align="center" class="tab" >
						<tr>
							<th>ID</th>
							<th>姓名</th>
							<th>微信号</th>
							<th>ip</th>
							<th>时间</th>
						</tr>
                        <?php  while ($row = mysql_fetch_array($query)) { ?>
							<tr>
								
									<td><span><?php echo $row['id'] ?></span></td>
									<td><span><?php echo $row['visitorName'] ?></span></td>
									<td><span><?php echo $row['visitorPhone'] ?></span></td>
									<td><span><?php echo $row['ip'] ?></span></td>
									<td><span><?php echo $row['addtime'] ?></span></td>
							</tr>
                        <?php } ?>						
					</table>
					
                    <!--显示数据区-->
                </div>
                <div class="showPage">
                    <?php
                    if ($total > $showrow) {//总记录数大于每页显示数，显示分页
                        $page = new page($total, $showrow, $curpage, $url, 2);
                        echo $page->myde_write();
                        
                    }
                    ?>
                </div>
            </div>
			<style type="text/css">
				p{margin:0}
				#page{height:40px;padding:20px 0px;}
				#page a{display:block; float:left;margin-right:10px;padding:2px 12px;height:24px;border:1px #cccccc solid;background:#fff;text-decoration:none;color:#808080;font-size:12px;line-height:24px;}
				#page a:hover{color:#077ee3;border:1px #077ee3 solid;}
				#page a.cur{border:none;background:#077ee3;color:#fff;}
				#page p{float:left;padding:2px 12px;font-size:12px;height:24px;line-height:24px;color:#bbb;border:1px #ccc solid;background:#fcfcfc;margin-right:8px;}
				#page p.pageRemark{border-style:none;background:none;margin-right:0px;padding:4px 0px;color:#666;}
				#page p.pageRemark b{color:red;}
				#page p.pageEllipsis{border-style:none;background:none;padding:4px 0px;color:#808080;}
				.dates li {font-size: 14px;margin:20px 0}
			</style>
    </body>
</html>