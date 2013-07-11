{assign var=task_id value=$task->getId()}

    <section>
        <div class="page-header">
            <h1>{Localisation::getTranslation(Strings::TASK_CLAIMED_DESEGMENTATION_DESEGMENTATION_TASK_CLAIMED)} <small>{Localisation::getTranslation(Strings::TASK_CLAIMED_DESEGMENTATION_0)}</small></h1>
        </div>
        <div class="alert alert-success">
            <strong>{Localisation::getTranslation(Strings::COMMON_SUCCESS)}</strong> {Localisation::getTranslation(Strings::TASK_CLAIMED_DESEGMENTATION_1)} &ldquo;<strong>{$task->getTitle()}</strong>&rdquo;.
        </div>
    </section>

    <section>
        <h1>{Localisation::getTranslation(Strings::COMMON_WHAT_HAPPENS_NOW)}?</h1>
        <p>{Localisation::getTranslation(Strings::COMMON_THIS_THIS_WHAT_YOU_NEED_TO_DO_AS_SOON_AS_POSSIBLE)}:</p>
        <ol>
            <li>{Localisation::getTranslation(Strings::TASK_CLAIMED_DESEGMENTATION_GO)} <a href="{urlFor name="task" options="task_id.$task_id"}">{Localisation::getTranslation(Strings::COMMON_HERE)}</a> {Localisation::getTranslation(Strings::TASK_CLAIMED_DESEGMENTATION_2)}</li>
            <li><strong>{Localisation::getTranslation(Strings::TASK_CLAIMED_DESEGMENTATION_3)}</strong> {Localisation::getTranslation(Strings::TASK_CLAIMED_DESEGMENTATION_4)}</li>
        </ol>
        {if isset($user)}
            <p>{Localisation::getTranslation(Strings::COMMON_WE_HAVE_ALSO_EMAILED_YOU_THESE_INSTRUCTIONS_TO)} <strong>{$user->getEmail()}</strong>.</p>
        {/if}
    </section>

    <section>
        <h3>{Localisation::getTranslation(Strings::TASK_CLAIMED_DESEGMENTATION_WANT_TO_GET_STARTED)}</h3>
        <p></p>
        <p>
            <a href="{urlFor name="task" options="task_id.$task_id"}" class="btn btn-primary">
                <i class="icon-share-alt icon-white"></i> {Localisation::getTranslation(Strings::TASK_CLAIMED_DESEGMENTATION_MERGE_FILES)}
            </a>
            <a href="{urlFor name="home"}" class="btn">
                <i class="icon-arrow-left icon-black"></i> {Localisation::getTranslation(Strings::TASK_CLAIMED_DESEGMENTATION_5)}
            </a>
        </p>
    </section>
