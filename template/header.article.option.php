<div class="btn icon-only" id="btnOption">
	<i class="fa fa-cog" aria-hidden="true"></i>

	<?php if(!$article->hasCover || !$article->hasInfo || !$article->hasURL || !$article->hasLocation || !$article->hasTags){?>
	<span class="notif"><i class="fa fa-circle" aria-hidden="true"></i></span>
	<?php }?>

	<div class="toggle-panel" id="optionPanel">
		<div class="popover-arrow"></div>
		<ul>
			<li><a href="article/<?php echo $article->id;?>/option#cover">เลือกภาพหน้าปก<?php echo ($article->hasCover)?'<i class="fa fa-check" aria-hidden="true"></i>':'<i class="fa fa-circle" aria-hidden="true"></i>';?></a></li>
			<li><a href="article/<?php echo $article->id;?>/option#info">รายละเอียดอย่างย่อ<?php echo ($article->hasInfo)?'<i class="fa fa-check" aria-hidden="true"></i>':'<i class="fa fa-circle" aria-hidden="true"></i>';?></a></li>
			<li><a href="article/<?php echo $article->id;?>/option#url">ลิงค์บทความ<?php echo ($article->hasURL)?'<i class="fa fa-check" aria-hidden="true"></i>':'<i class="fa fa-circle" aria-hidden="true"></i>';?></a></li>
			<li><a href="article/<?php echo $article->id;?>/option#location">แท็กที่อยู่<?php echo ($article->hasLocation)?'<i class="fa fa-check" aria-hidden="true"></i>':'<i class="fa fa-circle" aria-hidden="true"></i>';?></a></li>
			<li><a href="article/<?php echo $article->id;?>/option#tag">คำที่เกี่ยวข้อง<?php echo ($article->hasTags)?'<i class="fa fa-check" aria-hidden="true"></i>':'<i class="fa fa-circle" aria-hidden="true"></i>';?></a></li>
			<li class="separator"></li>
			<li><a href="article/<?php echo $article->id;?>/option#guide">คำแนะนำ</a></li>
			<li class="separator"></li>

			<?php if($article->status=='published'){?>
			<li id="btn-draft"><span>ยกเลิกเผยแพร่</span></li>
			<?php }?>
			<li id="btn-remove"><span class="delete">ลบบทความ</span></li>
		</ul>
	</div>
</div>

<?php if($article->status!='published'){?>
<div class="btn active" id="btn-publish">เผยแพร่</div>
<?php }?>