<div class="row" style="margin-top: 5px; ">
    {if isset($title)}
        <div class="box-message box-danger box-shadow-light">
            <div class="text-danger" style="font-size: 20px; font-weight: bold;">{$title}</div>
            {if isset($message)} {$message.Description} {/if}
        </div>
    {/if}
    {*<div class="row" style="margin: 5px;">
        <a href="{$layoutParams.root}" class="action-button">
            <i class="fa fa-home" aria-hidden="true"></i>&nbsp;Home&nbsp;&nbsp;
        </a>
        <a href="#" onclick="history.go(-1)" class="action-button">
            <i class="fas fa-arrow-circle-left" aria-hidden="true"></i>&nbsp;Back&nbsp;&nbsp;
        </a>
        {if !Session::get('auth')}
            <a href="{$layoutParams.root}user/login" class="action-button">
                <i class="fas fa-user" aria-hidden="true"></i>&nbsp;Login
            </a>
        {/if}
    </div>*}
</div>
