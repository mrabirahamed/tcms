<h3> Searching for : {if isset($q)}{$q.q}{/if} </h3>

{if isset($datas) && count($datas)}
    {if !empty(datas)}

        {if isset($data) && count($data)}

            {foreach item = d  from =$data}
                <div class="search_result">
                    <div class=" nav header">
                        {if !empty($d.image)}
                            <div class="pull-left" style="width: 50px; height: 60px;">
                                <a href="{$layoutParams.uploads}{$d.image}">
                                    <img src="{$layoutParams.uploads}thumbs/thumb_{$d.image}"
                                         class="img-responsive img-thumbnail" style="width: 40px; height: 50px;"/>
                                </a>
                            </div>
                        {/if}
                        <a href="{$layoutParams.root}word/view/{$d.word}" style="text-decoration: none">
                            <div>
                    <span class="lead">
                        {$d.word}
                    </span>
                                ({$d.spelling})
                            </div>
                            <div class="text-justify">
                                {$d.meaning}
                            </div>
                        </a> {if !empty($d.r_word)}
                            Related word: {$d.r_word}
                            <br/>
                        {/if}
                    </div>
                </div>
            {/foreach}
        {else}
            {if isset($datas) && count($datas)}

                {foreach item = data  from =$datas}
                    <div class="search_result">
                        {if !empty($data.image)}
                            <div class="pull-left" style="width: 50px; height: 60px;">
                                <a href="{$layoutParams.uploads}{$data.image}">
                                    <img src="{$layoutParams.uploads}thumbs/thumb_{$data.image}"
                                         class="img-responsive img-thumbnail" style="width: 40px; height: 50px;"/>
                                </a>
                            </div>
                        {/if}
                        <a href="{$layoutParams.root}word/view/{$data.word}" style="text-decoration: none">
                            <div>
                    <span class="lead">
                        {$data.word}
                    </span>
                                ({$data.spelling})
                            </div>
                            <div class="text-justify">
                                {$data.meaning}
                            </div>
                        </a>
                    </div>
                {/foreach}
            {/if}

        {/if}

    {/if}
{else}
    {"No data exist."}
{/if}


