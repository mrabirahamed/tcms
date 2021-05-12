<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">Complete your Profile</div>
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#per_info" aria-controls="per_info" role="tab"
                                                      data-toggle="tab"> Personal Informaion </a></li>
            <li role="presentation"><a href="#ed_q" aria-controls="ed_q" role="tab" data-toggle="tab"> Educational
                    Qualification </a></li>
            <li role="presentation"><a href="#pr_q" aria-controls="pr_q" role="tab" data-toggle="tab"> Professional
                    Qualification </a></li>
            <li role="presentation"><a href="#pro_pic" aria-controls="pro_pic" role="tab" data-toggle="tab"> Profile
                    Picture </a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content" role="tablist">
            <div role="tabpanel" class="tab-pane fade in active" id="per_info">
                A quick brown fox jumps over a lazy dog.

                <div align="right">
                    <a href="" class="btn btn-primary" role="tab" data-toggle="tab"> Next </a>
                    <a href="#ed_q" class="btn btn-danger" role="tab" data-toggle="tab"> Skip </a>
                </div>

            </div>

            <div role="tabpanel" class="tab-pane fade" id="ed_q">
                <form id="form1" role="form" name="form1" method="post">
                    <input type="hidden" name="enviar" value="1">
                    <fieldset>
                        <legend> School</legend>
                        <div class="form-group">
                            <label> School's name: </label>
                            <input type="text" name="sch_name" class="form-control-static"
                                   value="{if isset($datas)} {$datas.sch_name} {/if}" placeholder="School's Name."/>
                        </div>

                        <div class="form-group">
                            <label> School's position: </label>
                            <input type="text" name="sch_pos" class="form-control-static"
                                   value="{if isset($datas)} {$datas.sch_pos} {/if}" placeholder="School's position."/>
                        </div>

                        <div class="form-group">
                            <label> Subject/Group: </label>
                            <input type="text" name="group" class="form-control-static"
                                   value="{if isset($datas)} {$datas.group} {/if}" placeholder="School's position."/>
                        </div>

                        <div class="form-group">
                            <label> Passing year: </label>
                            <input type="number" name="pass_year" class="form-control-static"
                                   value="{if isset($datas)} {$datas.pass_year} {/if}"
                                   placeholder="Your passing year."/>
                        </div>

                        <div class="form-group">
                            <label> Result (GPA/Grade): </label>
                            <input type="text" name="result" class="form-control-static"
                                   value="{if isset($datas)} {$datas.result} {/if}" placeholder="School's position."/>
                        </div>

                    </fieldset>

                    <div align="right">
                        <a href="" class="btn btn-primary" role="tab" data-toggle="tab"> Next </a>
                        <a href="#pr_q" class="btn btn-danger" role="tab" data-toggle="tab"> Skip </a>
                    </div>
            </div>

            <div role="tabpanel" class="tab-pane fade" id="pr_q">
                A quick brown fox jumps over a lazy dog.

                <div align="right">
                    <a href="" class="btn btn-primary" role="tab" data-toggle="tab"> Next </a>
                    <a href="#pro_pic" class="btn btn-danger" role="tab" data-toggle="tab"> Skip </a>
                </div>

            </div>
            <div role="tabpanel" class="tab-pane fade" id="pro_pic">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <input type="file" id="main-input">
                    <h4 id="fake-btn" class="form-input fake-styled-btn text-center truncate"><span class="margin"> Choose File</span>
                    </h4>
                </div>

                <div align="right">
                    <a href="" class="btn btn-primary" role="tab" data-toggle="tab"> Next </a>
                    <a href="" class="btn btn-danger" role="tab" data-toggle="tab"> Skip </a>
                </div>

            </div>
        </div>
    </div>
</div>