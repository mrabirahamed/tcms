{if $acl->permission('edit_user_acitivites')}
    <div class="row">
        <fieldset class="box-shadow-light">
            <legend class="box-shadow-light"> User Activities</legend>
            <div class="row" id="notificationsAll">
                {if isset($activities) && count($activities)}
                    {foreach item = data  from = $activities}
                        {if ($data.message_type === 'error' || $data.message_type === 'Error' || $data.message_type === 'ERROR')} {$messageType = 'danger'}{$messageIcon = '<i class="far fa-times-circle"></i>'}
                        {elseif ($data.message_type === 'success' || $data.message_type === 'Success' || $data.message_type === 'SUCCESS')} {$messageType = 'success'}{$messageIcon = '<i class="far fa-check-circle"></i>'}
                        {elseif ($data.message_type === 'notify' || $data.message_type === 'Notify' || $data.message_type === 'NOTIFY')} {$messageType = 'notify'}{$messageIcon = '<i class="fas fa-info-circle"></i>'}
                        {else} {$messageType = 'danger'}{$messageIcon = '<i class="far fa-times-circle"></i>'}
                        {/if}
                        <div class="box-message box-{$messageType} box-shadow-light">
                            <span class="notify-icon">{$messageIcon}</span>&nbsp;
                            <span class="notify-content"><a href="http://{$data.ip}">{$data.author}</a>&nbsp;[{$data.ip}]&nbsp;[{$data.browser}]&nbsp;[{$data.time}]&nbsp;<a
                                        href="{$data.page}">{$data.message}</a></span>
                            <span class="notify-action"><i class="fas fa-trash-alt"></i> </span>
                        </div>
                    {/foreach}
                {/if}
                {$pagination|default:""}
            </div>
        </fieldset>
    </div>
{/if}

