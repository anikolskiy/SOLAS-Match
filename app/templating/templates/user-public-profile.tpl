{include file='header.tpl'}

{if isset($user)}
    <div class="page-header"><h1>
        <img src="http://www.gravatar.com/avatar/{md5( strtolower( trim($user->getEmail())))}?s=80&r=g" alt="" />
        {assign var="user_id" value=$user->getUserId()}
        {if $user->getDisplayName() != ''}
            {$user->getDisplayName()}
        {else}
            User Profile
        {/if}
        <small>View user details here</small>
        {if isset($private_access)}
            <a href='{urlFor name="user-private-profile"}' class='pull-right btn btn-primary'>Private Profile</a>
        {/if}
    </h1></div>
{else}
    <div class='page-header'><h1>User Profile <small>View user details here</small></h1></div>
{/if}

<h3>Public display name:</h3>
<p>{$user->getDisplayName()}</p>
 
{if $user->getNativeLanguage() != ''}
    <h3>First Maternal Language: </h3>
    <p>{$user->getNativeLanguage()}</p>
{/if}
 
{if $user->getBiography() != ''}
    <h3>Biography:</h3>
    <p>{$user->getBiography()}</p>
{/if}


{if isset($badges)}
    {if count($badges) > 0}
        <div class='page-header'><h1>Badges<small> A list of badges you have earned</small>
        <a href='{urlFor name="badge-list"}' class='pull-right btn btn-primary'>Badge List</a></h1></div>

        {foreach $badges as $badge }
    	    <h3>{$badge->getTitle()}</h3>
            <p>{$badge->getDescription()}</p>
        {/foreach}
    {/if}
{/if}

{if isset($user_tags)}
    {if count($user_tags) > 0}
        <div class="page-header">
            <h1>Tags<small> A list of tags you have subscribed to.</small>
            <a href='{urlFor name='tags-list'}' class="pull-right btn btn-primary">Manage Tags</a></h1>
        </div>

        {foreach $user_tags as $tag}
            
                <p><a class="tag" href="{urlFor name="tag-details" options="label.$tag"}"><span class="label">{$tag}</span></a></p>
            
        {/foreach}
    {/if}
{/if}


{if isset($orgList)}
    {if count($orgList) > 0}
        <div class='page-header'><h1>Organisations <small>A list of organisations you belong to</small></h1></div>

        {foreach $orgList as $org}
            {assign var="org_id" value=$org->getId()}
            <h3><a href="{urlFor name="org-public-profile" options="org_id.$org_id"}">{$org->getName()}</a>
                {if $org->getHomePage() != ''}
                    <small>
                        <a href='{$org->getHomePage()}' class='pull-right btn btn-small'>Home Page</a>
                    </small>
                {/if}
            </h3>
            <p>{$org->getBiography()}</p>    
        {/foreach}
    {/if}
{/if}

{if isset($activeJobs)}
    {if count($activeJobs) > 0}
        <div class='page-header'><h1>Active Jobs <small>A list of jobs you are currently working on</small></h1></div>

        {foreach $activeJobs as $job}
                {include file="task.summary-link.tpl" task=$job}
        {/foreach}
    {/if}
{/if}

{if isset($archivedJobs)}
    {if count($archivedJobs) > 0}
        <div class='page-header'><h1>Archived Jobs <small>A list of jobs you have worked on in the past</small></h1></div>

        {foreach $archivedJobs as $job}
            {include file="task.profile-display.tpl" task=$job}
        {/foreach}
    {/if}
{/if}

{include file='footer.tpl'}
