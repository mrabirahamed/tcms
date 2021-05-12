<div class="row">
    <fieldset class="box-shadow-light">
        <legend class="box-shadow-light"> Quick access</legend>

        <!--div class="row" id="Quickaccess">
            <div class="quick-access-app box-shadow-light">
                <div class="quick-access-app-logo">
                    <span class="quick-access-app-logo-image-alt"><i class="fab fa-app-store"></i></span>
                </div>
                <div class="quick-access-app-text">
                    <div class="quick-access-app-title-text">Loading...</div>
                    <div class="quick-access-app-status-text">&nbsp;</div>
                </div>
            </div>
        </div-->
        <div class="row">

            {if $acl->permission('edit_product_details')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/productDetails">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-info"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Product Details</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}

            {if $acl->permission('edit_clients_invoice')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/invoices">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-file-invoice"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Invoices</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}

            {if $acl->permission('system_access')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/clients">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-users"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Clients</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}
            {if $acl->permission('system_access')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/moneyreceipt">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="far fa-credit-card"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Money receipt</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}
        </div>
    </fieldset>
    <fieldset class="box-shadow-light">
        <legend class="box-shadow-light"> Manage Products</legend>

        <!--div class="row" id="Quickaccess">
            <div class="quick-access-app box-shadow-light">
                <div class="quick-access-app-logo">
                    <span class="quick-access-app-logo-image-alt"><i class="fab fa-app-store"></i></span>
                </div>
                <div class="quick-access-app-text">
                    <div class="quick-access-app-title-text">Loading...</div>
                    <div class="quick-access-app-status-text">&nbsp;</div>
                </div>
            </div>
        </div-->
        <div class="row">
            {if $acl->permission('edit_product_item')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/items">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-clipboard-list"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Items</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}
            {if $acl->permission('edit_product_brand')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/brands">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt">B</span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Brands</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}

            {if $acl->permission('edit_product_details')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/productDetails">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-info"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Product Details</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}

            {if $acl->permission('edit_product_item')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/items/photos">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-images"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Items Photos</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}
            {if $acl->permission('edit_product_brand')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/brands/photos">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-images"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Brands Photos</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}

            {if $acl->permission('edit_product_details')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/productDetails/photos">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-images"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Products Photos</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}
        </div>
    </fieldset>
    <fieldset class="box-shadow-light">
        <legend class="box-shadow-light"> Manage Stock</legend>

        <!--div class="row" id="Quickaccess">
            <div class="quick-access-app box-shadow-light">
                <div class="quick-access-app-logo">
                    <span class="quick-access-app-logo-image-alt"><i class="fab fa-app-store"></i></span>
                </div>
                <div class="quick-access-app-text">
                    <div class="quick-access-app-title-text">Loading...</div>
                    <div class="quick-access-app-status-text">&nbsp;</div>
                </div>
            </div>
        </div-->
        <div class="row">
            <a class="quick-access-app box-shadow-light" href="#">
                <div class="quick-access-app-logo">
                    <span class="quick-access-app-logo-image-alt"><i class="fas fa-clipboard-list"></i></span>
                </div>
                <div class="quick-access-app-text">
                    <div class="quick-access-app-title-text">Product categories</div>
                    <div class="quick-access-app-status-text">&nbsp;</div>
                </div>
            </a>
            <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}#">
                <div class="quick-access-app-logo">
                    <span class="quick-access-app-logo-image-alt"><i class="fas fa-info"></i></span>
                </div>
                <div class="quick-access-app-text">
                    <div class="quick-access-app-title-text">Products</div>
                    <div class="quick-access-app-status-text">&nbsp;</div>
                </div>
            </a>
        </div>
    </fieldset>
    <fieldset class="box-shadow-light">
        <legend class="box-shadow-light"> Developers</legend>

        <!--div class="row" id="Quickaccess">
            <div class="quick-access-app box-shadow-light">
                <div class="quick-access-app-logo">
                    <span class="quick-access-app-logo-image-alt"><i class="fab fa-app-store"></i></span>
                </div>
                <div class="quick-access-app-text">
                    <div class="quick-access-app-title-text">Loading...</div>
                    <div class="quick-access-app-status-text">&nbsp;</div>
                </div>
            </div>
        </div-->
        <div class="row">
            {if $acl->permission('system_access')}
                {*{if $acl->permission('edit_app_developer')}*}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/developers">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fab fa-connectdevelop"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Developers</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}
        </div>
    </fieldset>

    <!--<fieldset class="box-shadow-light">
        <legend class="box-shadow-light"> Manage Products</legend>

        <!--div class="row" id="Quickaccess">
            <div class="quick-access-app box-shadow-light">
                <div class="quick-access-app-logo">
                    <span class="quick-access-app-logo-image-alt"><i class="fab fa-app-store"></i></span>
                </div>
                <div class="quick-access-app-text">
                    <div class="quick-access-app-title-text">Loading...</div>
                    <div class="quick-access-app-status-text">&nbsp;</div>
                </div>
            </div>
        </div-->
    <!--<div class="row">
            {if $acl->permission('edit_product_item')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/items">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-clipboard-list"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Items</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}
            {if $acl->permission('edit_product_brand')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/brands">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt">B</span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Brands</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}

            {if $acl->permission('edit_product_details')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/productDetails">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-info"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Product Details</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}

            {if $acl->permission('edit_clients_invoice')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/invoices">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-file-invoice"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Invoices</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}

            {if $acl->permission('system_access')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/clients">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-users"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Clients</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}
            {if $acl->permission('system_access')}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/moneyreceipt">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fas fa-users"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Money receipt</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}
            {if $acl->permission('system_access')}
            {*{if $acl->permission('edit_app_developer')}*}
                <a class="quick-access-app box-shadow-light" href="{$layoutParams.root}office/developers">
                    <div class="quick-access-app-logo">
                        <span class="quick-access-app-logo-image-alt"><i class="fab fa-connectdevelop"></i></span>
                    </div>
                    <div class="quick-access-app-text">
                        <div class="quick-access-app-title-text">Developers</div>
                        <div class="quick-access-app-status-text">&nbsp;</div>
                    </div>
                </a>
            {/if}
        </div>
    </fieldset>-->
</div>

{if $acl->permission('edit_content')}
    <div class="row">
        <fieldset class="box-shadow-light">
            <legend class="box-shadow-light"> Notifications</legend>
            <div class="row" id="notifications">
                {*if isset($acitivities) && count($acitivities)}
                    {foreach item = data  from = $acitivities}
                {$data|@print_r}
                        <div class="box-message box-{$data.message_type} box-shadow-light">
                            <span class="notify-icon float-left"></span>&nbsp;
                            <span class="notify-content">{$data.message}</span>
                            <span class="notify-action float-right"><i class="fa fa-trash"></i> </span>
                        </div>

                    {/foreach}
                {/if*}
                <!--div class="box-message box-success box-shadow-light">
                    <span class="notify-icon float-left"></span>&nbsp;
                    <span class="notify-content">Loading</span>
                    <span class="notify-action float-right"><i class="fa fa-trash"></i> </span>
                </div-->
            </div>
            <a href="{$layoutParams.root}user/activities" class="button button-success float-right"><i
                        class="fas fa-list-ul"></i> See more</a>
        </fieldset>
    </div>
{/if}



