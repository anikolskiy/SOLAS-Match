{* Must have an object $task assigned by parent *}
<div class="task">
    {assign var='task_id' value=$task->getTaskId()}
	<h2>{$task->getTitle()}</h2>
	<p>
		{if $task->getSourceId()}
			From <b>{Languages::languageNameFromId($task->getSourceId())}</b>
		{/if}
		{if $task->getTargetId()}
			To <b>{Languages::languageNameFromId($task->getTargetId())}</b>
		{/if}                

		{foreach from=$task->getTags() item=tag}
			<span class="label">{$tag}</span>                        
		{/foreach}
	</p>
	
	<p class="task_details">
		Added {IO::timeSinceSqlTime($task->getCreatedTime())} ago
		&middot; By {OrganisationDao::nameFromId($task->getOrganisationId())}
		{if $task->getWordcount()}
			&middot; {$task->getWordcount()|number_format} words
		{/if}
                <p style="margin-bottom:30px;"></p>
	</p>
</div>
