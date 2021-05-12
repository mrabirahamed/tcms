<div class="row" style="margin: 5px;">
    <div style="margin: 0 auto; width: 600px;">
        <fieldset class="box-shadow-light">
            <legend class="box-shadow-light"> Permissions</legend>
            <div class="row">
                <div id="message"> <!-- only javascipt show message --> </div>
                <div class="row">
                    <div id="modal01" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="permissionEditMode"> <!-- only javascipt show action status --> </span>&nbsp;permission
                            </div>
                            <div class='modal-body'>
                                <div id="message2"> <!-- only javascipt show message --> </div>
                                <div id="permissionEditPAD">
                                    <form name="form1" id="permissionform1" method="post">
                                        <input id="permissionID" type="hidden" value=""/>
                                        <table class="table table-condensed">
                                            <tr>
                                                <td style="width: 50%;">
                                                    Name:
                                                    <input id="permissionName" type="text" class="input-control"
                                                           placeholder="Permission's name" maxlength="30"/>
                                                </td>
                                                <td style="width: 50%;">
                                                    Key:
                                                    <input id="permissionKey" type="text" class="input-control"
                                                           placeholder="Permission key" maxlength="30"/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 50%;">
                                                    PKID:
                                                    <input id="permissionPKID" type="text" class="input-control"
                                                           placeholder="Permission key Id" maxlength="30"/>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);"
                                   onclick="Mishusoft.detectElement('modal01').style.display = 'none'"
                                   class="button button-danger float-left">Cancel</a>
                                <a href="javascript:void(0);" id="permission-data-btn"
                                   class="button button-primary float-right">
                                    <!-- only javascipt show button name --> </a>
                                <a href="javascript:void(0);" id="permission-reset-btn"
                                   class="button button-danger float-right">
                                    <!-- only javascipt show button name --> </a>
                            </div>
                        </div>
                    </div>

                    <div id="PopUpDialogBox" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="PopUpDialogBoxTitle"> <!-- only javascript show action status --> </span>
                            </div>
                            <div class='modal-body'>
                                <div id="message3"> <!-- only javascipt show message --> </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);" id="message-done-btn"
                                   class="button button-primary float-right">
                                    <!-- only javascipt show button name --> </a>
                                <a href="javascript:void(0);"
                                   onclick="Mishusoft.detectElement('PopUpDialogBox').style.display = 'none'"
                                   class="button button-danger float-right">Cancel</a>
                            </div>
                        </div>
                    </div>

                    <table class="table">
                        <tr>
                            <td>
                                <a href="javascript:void(0);" onclick="window.location = _root_ + 'appManager'"
                                   class="button button-danger float-left">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Back
                                </a>
                            </td>
                            <td><a href="javascript:void(0);" id="permission-add-btn"
                                   class="button button-success float-right">
                                    <i class="fas fa-plus-circle"></i> Add New</a></td>
                        </tr>
                    </table>
                    <div id="permissions-data-table">
                        <table class="table table-condensed table-striped">
                            <thead class="text-notify">
                            <tr>
                                <th class="text-align-center" style="width: 20px">
                                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                                </th>
                                <th class="text-align-center" style="width: 20px">ID</th>
                                <th class="text-align-left">Name</th>
                                <th class="text-align-left">Key</th>
                                <th class="text-align-center">PKID</th>
                                <th class="text-align-center" style="width: 80px;">Action</th>
                            </tr>
                            </thead>
                            <tbody id="permissions-data2">
                            {if isset($permissions) && count($permissions)}
                                {foreach item = data  from = $permissions}
                                    <tr>
                                        <td class="text-align-center">
                                            <label>
                                                <input type="checkbox" id="permission-select" class="check_box"
                                                       data-permissionID="{$data.id_permission}"
                                                       data-permissionName="{$data.permission}"
                                                       data-permissionKey="{$data.key}"
                                                       data-permissionPKID="{$data.PKID}"/>
                                            </label>
                                        </td>
                                        <td class="text-align-center">{$data.id_permission}</td>
                                        <td class="text-align-left">{$data.permission}</td>
                                        <td class="text-align-left">{$data.key}</td>
                                        <td class="text-align-center">{$data.PKID}</td>
                                        <td class="text-align-center">
                                            <a href="javascript:void(0);" id="permission-edit-btn"
                                               class="button button-xs button-success"
                                               data-permissionID="{$data.id_permission}"
                                               data-permissionName="{$data.permission}" data-permissionKey="{$data.key}"
                                               data-permissionPKID="{$data.PKID}"><i class="far fa-edit"></i></i></a>&nbsp;&nbsp;
                                            <a href="javascript:void(0);" id="permission-delete-btn"
                                               class="button button-xs button-danger"
                                               data-permissionID="{$data.id_permission}"><i
                                                        class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                {/foreach}
                            {/if}
                            <!--tr><td class="text-align-center" colspan="6">Loading.......</td></tr-->
                            <!-- only javascipt show action status -->
                            </tbody>
                            <tfoot class="text-notify">
                            <tr>
                                <th class="text-align-center" style="width: 20px">
                                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                                </th>
                                <th class="text-align-center" style="width: 20px">ID</th>
                                <th class="text-align-left">Name</th>
                                <th class="text-align-left">Key</th>
                                <th class="text-align-center">PKID</th>
                                <th class="text-align-center" style="width: 80px;">Action</th>
                            </tr>
                            </tfoot>
                        </table>
                        {$pagination|default:""}
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
</div>