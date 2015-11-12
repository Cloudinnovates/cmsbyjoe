<div id="related_headlines" class="related_pages cushion-v">
<h3>Related Entries</h3>
	<ul>
		<?php
		if (isset($articles)) 
		{
				foreach ($articles->result() as $article)
				{
						$datestamp = strtotime($article->datestamp);
						?>		
							<li><a href="/articles/detail/<?=$article->id?>"><?=$article->headline?></a>
							<!--<span class="post_date"><?= date('F jS, Y', $datestamp) ?></span>-->
							</li>				
						<?
				}
		}
		?>
	</ul>
</div>