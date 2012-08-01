{if isset($top_tags) AND is_array($top_tags)}
	<h3><i class="icon-tags"></i> Popular tags</h3>
	<ul class="nav nav-list unstyled">
		{foreach from=$top_tags item=tag}
			<li>
                <div class="tag">
				    <a href="{urlFor name="tag-details" options="label.$tag"}" class="label">{$tag}</a>
                </div>
			</li>
		{/foreach}
	</ul>
{/if}
