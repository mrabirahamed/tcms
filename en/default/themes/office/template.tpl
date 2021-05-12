<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title id="pageTitle">
        {$title|default: "Welcome to The {$layoutParams.configs.app_name}"} || {$layoutParams.configs.app_name}
    </title>

    <!--meta http-equiv="refresh" content="0"/-->

    <meta name="title" content="{$title}"/>
    <meta name="Keywords" content="{$title}"/>
    <meta name="Company" content="{$layoutParams.configs.app_company}"/>
    <meta name="Author" content="{$layoutParams.configs.app_author}"/>

    <!-- favicon image files include here -->
    {*if isset($layoutParams.favicon)}
        <link rel="icon" type="image/ico" href="{$layoutParams.favicon}">
    {else}
        <link rel="icon" type="image/ico" href="{$layoutParams.logoFolder}favicon.ico">
    {/if*}

    <link rel="apple-touch-icon" sizes="57x57" href="{$layoutParams.logoFolder}apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{$layoutParams.logoFolder}apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{$layoutParams.logoFolder}apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{$layoutParams.logoFolder}apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{$layoutParams.logoFolder}apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{$layoutParams.logoFolder}apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{$layoutParams.logoFolder}apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{$layoutParams.logoFolder}apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{$layoutParams.logoFolder}apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="{$layoutParams.logoFolder}android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="{$layoutParams.logoFolder}favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="{$layoutParams.logoFolder}favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="{$layoutParams.logoFolder}favicon-16x16.png">
    <link rel="manifest" href="{$layoutParams.logoFolder}manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{$layoutParams.logoFolder}ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">

    <!-- StyleSheets -->
    <link href="{$layoutParams.rootCSS}main.css" rel="stylesheet" type="text/css">
    <link href="{$layoutParams.publicCSS}mishusoft.css" rel="stylesheet" type="text/css">
    <link href="{$layoutParams.publicCSS}normalize.css" rel="stylesheet" type="text/css">
    <link href="{$layoutParams.publicCSS}all.css" rel="stylesheet" type="text/css">

    <!-- Javascripts -->
    <script src="{$layoutParams.rootJS}main.js" type="text/javascript"></script>
    <script src="{$layoutParams.publicJqueryJS}jquery.min.js" type="text/javascript"></script>
    <script src="{$layoutParams.publicMishusoftJS}mishusoft_FormValidation.js" type="text/javascript"></script>
    <script src="{$layoutParams.publicJSPlugin}jquery.validate.js" type="text/javascript"></script>


</head>

<body id="Mishusoft" onload=Mishusoft.DigitalClock();>


<div id="container" class="container">

    {if isset($widgets.header)}
        {foreach from = $widgets.header item = hdr}
            {$hdr}
        {/foreach}
    {/if}

    <div class="content_body">
        {if isset($widgets.left)}
            {foreach from = $widgets.left item = lft}
                {$lft}
            {/foreach}
        {/if}

        <section id="content" class="content text-align-justify">

            {*if isset($error)}
                <div class="box-message box-danger box-shadow-light"><b class="text-danger">Error: </b>{$error} </div>
            {/if}
            {if isset($success)}
                <div class="box-message box-success box-shadow-light"><b class="text-success">Message: </b>{$success} </div>
            {/if*}

            {include file = $content}

        </section>

        {if isset($widgets.right)}
            {foreach from = $widgets.right item = ri}
                {$ri}
            {/foreach}
        {/if}

    </div>

    {if isset($widgets.footer)}
        {foreach from = $widgets.footer item = ftr}
            {$ftr}
        {/foreach}
    {/if}
</div>

<script src="{$layoutParams.publicMishusoftJS}mishusoft.js" type="text/javascript"></script>
<script type="text/javascript"> let _root_ = '{$layoutParams.root}'; </script>
{if isset($layoutParams.jsPlugin) && count($layoutParams.jsPlugin)}
    {foreach item = jsplg from = $layoutParams.jsPlugin}
        <script src="{$jsplg}" type="text/javascript"></script>
    {/foreach}
{/if}
{if isset($layoutParams.js) && count($layoutParams.js)}
    {foreach item = js from = $layoutParams.js}
        <script src="{$js}" type="text/javascript"></script>
    {/foreach}
{/if}

</body>
</html>
