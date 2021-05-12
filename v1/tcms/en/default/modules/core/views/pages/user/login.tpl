<div class="logInBox">
    <img src="{$layoutParams.publicIMG}img_avatar3.png" class="userIconImage">
    <div class="messageZone">
        {if isset($notify) }
            <div class="box-message box-notify box-shadow-light">{$notify}</div>
        {/if}
        {if isset($error)}
            <div class="box-message box-danger box-shadow-light"><b class="text-danger">Error: </b>{$error} </div>
        {/if}
        {if isset($success)}
            <div class="box-message box-success box-shadow-light"><b class="text-success">Message: </b>{$success} </div>
        {/if}
    </div>

    <form role="form"  name="LogInForm" method="post" action="">
        <input type="hidden" name="logged" value="1">
        <div class="row">
            <div class="row text-align-left">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="input-control"
                       placeholder="Your username.." autofocus required
                       value="{if isset($datas)}{$datas.username}{/if}"/>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="input-control"
                       placeholder="***********" autocomplete="off" required/>
            </div>

            <div class="row">
                <div class="float-left text-left">
                    <label class="input-container">Remember me.
                        <input type="checkbox" id="remember" name="RememberMe"/>
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="float-right text-right">
                    <input type="submit" id="login-button" name="login" class="button button-primary" value="Log In"/>
                </div>
            </div>
        </div>
        <div class="row">
            {*<a href="{$layoutParams.root}user/registration" class="link"><span class="fa fa-user-plus"></span> Register</a> ||*}
            <a href="{$layoutParams.root}user/pswrdRecovery" class="link"><span class="fa fa-user-times"></span> Forget password?</a>
            <br/> <br/>
            <a href="{$layoutParams.root}" class="link"> <span class="fa fa-arrow-left"></span> Go back home.</a>
        </div>
    </form>

</div>
