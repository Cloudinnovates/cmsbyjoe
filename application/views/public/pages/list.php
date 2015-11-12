<h1>Avalon and Stone Harbor Information</h1>
<p>Read on for plenty of local information.</p>

<div id="pages">
	<?php foreach($pages->result() as $page) : ?>
		<dl>
			<dt><a href="/pages/<?=$page->slug?>"><?=$page->title; ?></a></dt>
			<dd><?=$page->description; ?></dd>
		</dl>
	<?php endforeach; ?>
</div>