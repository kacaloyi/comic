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
.swiper-no img{width:35%}
</style>
<?php if($list): if(is_array($list)): foreach($list as $key=>$v): ?><li class="clear">
	<div class="fl">
		<div><?php echo get_finance_action($v['action']);?></div>
		<div style="margin-top:8px;"><?php echo (date("Y-m-d H:i:s",$v['create_time'])); ?></div>
	</div>		
	<div class="fr" style="color:#659ed2;margin-top:15px;font-size:14px;margin:10px;">
		<?php if($v['action'] == 2 or $v['action'] == 4 or $v['action'] == 6): ?>-
		<?php else: ?>
			+<?php endif; ?>
		<?php echo ($v["money"]); ?>
	</div>
</li><?php endforeach; endif; ?>
<?php else: ?>
	<?php if($page == 1): ?><div class="swiper-s">
		<div class="swiper-no">
			<img src="/Public/home/images/empty.png" />
		</div>
		<div class="swiper-no">
			您还未没有信息
		</div>
	 </div>
	<?php else: ?>
	<div class="swiper-ss" id="common-load">
		<div class="swiper-no">
			已经加载完数据！
		</div>
	</div><?php endif; endif; ?>