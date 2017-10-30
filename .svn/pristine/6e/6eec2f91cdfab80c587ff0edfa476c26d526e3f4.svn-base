<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<meta name="Generator" content="EditPlus®">
		<meta name="Author" content="">
		<meta name="Keywords" content="">
		<meta name="Description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>餐位管理</title>
		<link rel="stylesheet" type="text/css" href="/Public/quanxian/css/cwguanli.css" />
		<script type="text/javascript" src="/Public/quanxian/js/jquery.js"></script>
 		<script type="text/javascript" src="/Public/quanxian/js/jquery.SuperSlide.2.1.1.js"></script>
	</head>
	<body>
		<input type="hidden" name="id" id="id" value="<?php echo ($id); ?>"/>
		<!-- Tab切换 S -->
		<div class="slideTxtBox">
			<div class="hd">
				<ul>
					<li><a href="<?php echo U('seat',array('sid' => $sid,'id'=>1));?>">大厅</a></li>
					<li><a href="<?php echo U('seat',array('sid' => $sid,'id'=>0));?>">包房</a></li>
				</ul>
			</div>
			<div class="bd">
				<ul>
					<li class="tianjia">
						<a href="<?php echo U('addSeat',array('sid' => $sid,'id'=>$id));?>">
							<img src="/Public/quanxian/img/jia.png"/></span>
						</a>
					</li>
					<?php if(is_array($person)): foreach($person as $key=>$data): ?><a href="<?php echo U('seatInfo',array('table_id'=>$data['table_id'],'sid'=>$data['sid'],'id'=>$id,'level'=>$level[0],'openid'=>$openid[0]));?>">
							<li class="
								<?php if($data["state"] == 0): ?>bianse<?php endif; ?>
								">
								<span><?php echo ($data["table_id"]); ?></span>
								<span><?php echo ($data["table_name"]); ?></span>
								<span>
									<?php if($data["state"] == 0): ?>未使用<?php endif; ?>
									<?php if($data["state"] == 1): ?>用餐中<?php endif; ?>
								</span>
								<span>
									<?php if($data["table_type"] == 0): ?>包房<?php endif; ?>
									<?php if($data["table_type"] == 1): ?>2人桌<?php endif; ?>
									<?php if($data["table_type"] == 2): ?>4人桌<?php endif; ?>
									<?php if($data["table_type"] == 3): ?>6人桌<?php endif; ?>
									<?php if($data["table_type"] == 4): ?>8人桌<?php endif; ?>
								</span>
								<span>
									<?php if($data["is_order"] == 0): ?>不可预订<?php endif; ?>
									<?php if($data["is_order"] == 1): ?>提供预订<?php endif; ?>
								</span>
							</li>
						</a><?php endforeach; endif; ?>
				</ul>
			</div>
		</div>
		<script type="text/javascript">jQuery(".slideTxtBox").slide();</script>
		<!-- Tab切换 E -->
	</body>
</html>