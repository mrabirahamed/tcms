<div class="logInBox">
    <img src="{$layoutParams.publicIMG}img_avatar3.png" class="userIconImage">
    <div class="messageZone">
        {if isset($error)}
            <div class="box-message box-danger box-shadow-light"><b class="text-danger">Error: </b>{$error} </div>
        {/if}
        {if isset($success)}
            <div class="box-message box-success box-shadow-light"><b class="text-success">Message: </b>{$success} </div>
        {/if}
    </div>

    <form role="form"  name="PasswrodRecoveryForm" method="post" action="">
        <input type="hidden" name="enviar" value="1">
        <div class="row">
            <div class="row">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" class="input-control"
                       placeholder="Your email address.."/>
            </div>

            <div class="row">
                <div class="float-right text-right">
                    <input type="submit" id="recovery-mail-button" name="recovery-account" class="button button-primary" value="Send Recovery Code"/>
                </div>
            </div>
        </div>
        <div class="row">
            <a href="{$layoutParams.root}user/login" class="link"><span class="fa fa-user"></span> Log In</a>{* ||
                    <a href="{$layoutParams.root}user/registration" class="link"><span class="fa fa-user-plus"></span> Register</a>*}
            <br/> <br/>
            <a href="{$layoutParams.root}" class="link"> <span class="fa fa-arrow-left"></span> Go back home.</a>
        </div>
    </form>

</div>


{*
<div class="overlay">
    <div class="vref">&nbsp;</div>
    <div class="message">
        <a href="{$layoutParams.root}"><img src="{$layoutParams.logoFolder}logo.png" class="logo-lg"></a>
        <div class="box-container box-md box-shadow">
                  <h3> Passwrod recovery</h3> <hr/><br/>
            {if isset($error)}
                <div class="box-message box-danger box-shadow-light"><b class="text-danger">Error: </b>{$error} </div>
            {/if}
            {if isset($success)}
                <div class="box-message box-success box-shadow-light"><b class="text-success">Message: </b>{$success} </div>
            {/if}
            <form role="form" name="form1" method="post" action="">
                <input type="hidden" name="enviar" value="1">
                <div class="row">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" class="input-control"
                           placeholder="Your email address.."/>
                    <div class="float-right text-right">
                        <input type="submit" id="recovery-mail-button" name="recovery-mail"
                               class="button button-primary" value="Send Recovery Code"/>
                    </div>
                </div>
                <div class="row">
                    <a href="{$layoutParams.root}user/login" class="link"><span class="fa fa-user"></span> Log In</a>*}
{* ||
                    <a href="{$layoutParams.root}user/registration" class="link"><span class="fa fa-user-plus"></span> Register</a>*}{*

                    <br/> <br/>
                    <a href="{$layoutParams.root}" class="link"> <span class="fa fa-arrow-left"></span> Go back home.</a>
                </div>
            </form>
        </div>
    </div>
    <div class="vref">&nbsp;</div>
</div>
*}
