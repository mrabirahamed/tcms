<div class="overlay">
    <div class="vref">&nbsp;</div>
    <div class="message">
        <a href="{$layoutParams.root}"><img src="{$layoutParams.logoFolder}logo.png" class="logo-lg"></a>
        <div class="box-container box-md box-shadow">

            <h3>Create a new account</h3>
            <hr/>
            <br/>
            <div id="showmessage"></div>
            <form id="registrationForm" role="form" name="registrationForm" method="post" action="">
                <input type="hidden" name="regs" value="1">
                <table class="table">
                    <tr>
                        <td style="width: 50%;padding-right: 5px;">
                            <label for="f_name">First name</label>
                            <input type="text" id="f_name" name="f_name" class="input-control"
                                   placeholder="First name.."
                                   required value="{if isset($datas)}{$datas.f_name}{/if}"/>
                        </td>
                        <td style="width: 50%; padding-left:5px;">
                            <label for="l_name">Last name</label>
                            <input type="text" id="l_name" name="l_name" class="input-control" placeholder="Last name.."
                                   required value="{if isset($datas)}{$datas.l_name}{/if}"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%;" colspan="2">
                            <label for="email">Email address</label>
                            <input type="email" id="email" name="email" class="input-control"
                                   placeholder="Email address.."
                                   required value="{if isset($datas)} {$datas.email} {/if}"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding-right:5px;">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" class="input-control"
                                   placeholder="Username.."
                                   required value="{if isset($datas)}{$datas.username}{/if}"/>
                        </td>
                        <td style="width: 50%; padding-left: 5px;">
                            <label for="dateofbirth">Date of birth</label>
                            <input type="date" id="dateofbirth" name="dateofbirth" class="input-control" required/>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 50%; padding-right:5px;">
                            <label for="password">Password</label>
                            <input type="password" id="password" name="password" class="input-control"
                                   autocomplete="none" placeholder="New password" required/>
                        </td>
                        <td style="width: 50%; padding-left:5px;">
                            <label for="c_password">Confirm Password</label>
                            <input type="password" id="c_password" name="c_password" class="input-control"
                                   autocomplete="none" placeholder="Confirm password" required/>
                        </td>
                    </tr>
                </table>
                <div class="row">
                    <div class="row">
                        <div class="float-left text-left">
                            <label class="input-container">I agree with all terms and conditions..
                                <input id="agree" name="agree" type="checkbox" value="1" required>
                                <span class="checkmark"></span>
                            </label>
                        </div>

                        <div class="float-right text-right">
                            <input type="submit" id="signup-button" name="signup" class="button button-primary"
                                   value="Sign Up"/>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <a href="{$layoutParams.root}user/login" class="link"><span class="fa fa-user"></span> Log In</a> ||
                    <a href="{$layoutParams.root}user/pswrdRecovery" class="link"><span class="fa fa-user-times"></span>
                        Forget password?</a>
                    <br/> <br/>
                    <a href="{$layoutParams.root}" class="link"> <span class="fa fa-arrow-left"></span> Go back
                        home.</a>
                </div>
            </form>
        </div>
    </div>
    <div class="vref">&nbsp;</div>
</div>
