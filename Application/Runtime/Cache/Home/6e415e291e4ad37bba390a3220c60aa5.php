<?php if (!defined('THINK_PATH')) exit();?><style>
.swiper-no{
    padding: 20px 0 20px 0;
    min-height: 50px;
    line-height: 10px;
    background-color: #fff;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    color: #93899E;
    margin: 0 auto;
}
</style>
<?php if($list): if(is_array($list)): foreach($list as $key=>$v): ?><li class="flex">
	<img src="<?php echo ($v['headimg']); ?>" />
	<div class="flex_1">
		<p style="padding-top:6px">昵称：<?php echo ($v['nickname']); ?></p>
		<p style="padding-top:6px">微信号：<?php echo ($v['wxid']); ?></p>
		<p style="padding-top:6px">等级：<?php echo get_level_lv_name($v['level'],$v['lv']);?></p>
	</div>
	<?php if($type): ?><div class="leava_msg" onclick="window.location.href=&#39;<?php echo U('Ucenter/message',array('touser'=>$v['id']));?>&#39;">
			<i class="iconfont icon-community"></i>
			<h5>给Ta留言</h5>
		</div>
	<?php else: ?>
		<div class="leava_msg">
			<i class="iconfont icon-recharge"></i>
			<h5><?php echo sprintf("%.2f",$v['money']);?></h5>
		</div><?php endif; ?>
</li><?php endforeach; endif; ?>
<?php else: ?>
	<?php if($page == 1): ?><div class="swiper-s">
		<div class="swiper-no">
			<img src="/Public/home/images/empty.png" />
		</div>
		<div class="swiper-no">
			您还未有客户
		</div>
	 </div>
	<?php else: ?>
	<div class="swiper-ss" id="common-load">
		<div class="swiper-no">
			已经加载完数据！
		</div>
	</div><?php endif; endif; ?>