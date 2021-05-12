<div class="row" style="margin: 5px;">
    <div style="margin: 0 auto; width: 500px;">
        <fieldset class="box-shadow-light">
            <legend class="box-shadow-light">Items</legend>
            <div class="row">
                <div id="message"> <!-- only javascript show message --> </div>
                <div class="row">
                    <div id="modal01" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="itemEditMode"> <!-- only javascript show action status --> </span>&nbsp;item
                            </div>
                            <div class='modal-body'>
                                <div id="message2"> <!-- only javascript show message --> </div>
                                <div id="itemEditPAD">
                                    <form name="form1" id="itemform1" method="post">
                                        <input id="itemID" type="hidden" value=""/>
                                        <table class="table table-condensed">
                                            <tr>
                                                <td style="width: 50%;">
                                                    Name:
                                                    <input id="itemName" type="text" class="input-control" value=""
                                                           placeholder="Name" maxlength="30"/>
                                                </td>
                                                <td style="width: 50%;">
                                                    Current Status:
                                                    <select id="current_status" class="input-control"
                                                            title="Current Status">
                                                        <option value=""> -- select one --</option>
                                                        <option value="available"> Available</option>
                                                        <option value="unavailable"> Unavailable</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);"
                                   onclick="Mishusoft.detectElement('modal01').style.display = 'none'"
                                   class="button button-danger float-left">Cancel</a>
                                <a href="javascript:void(0);" id="item-data-btn"
                                   class="button button-primary float-right">
                                    <!-- only javascript show button name --> </a>
                                <a href="javascript:void(0);" id="item-reset-btn"
                                   class="button button-danger float-right">
                                    <!-- only javascript show button name --> </a>
                            </div>
                        </div>
                    </div>

                    <div id="PopUpDialogBox" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="PopUpDialogBoxTitle"> <!-- only javascript show action status --> </span>
                            </div>
                            <div class='modal-body'>
                                <div id="message3"> <!-- only javascript show message --> </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);" id="message-done-btn"
                                   class="button button-primary float-right">
                                    <!-- only javascript show button name --> </a>
                                <a href="javascript:void(0);"
                                   onclick="Mishusoft.detectElement('PopUpDialogBox').style.display = 'none'"
                                   class="button button-danger float-right">Cancel</a>
                            </div>
                        </div>
                    </div>

                    <table class="table">
                        <tr>
                            <td>
                                <a href="javascript:void(0);" onclick="window.location = _root_"
                                   class="button button-danger float-left">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Back
                                </a>
                            </td>
                            <td>
                                {if $acl->permission('add_product_item')}
                                    <a href="javascript:void(0);" id="item-add-btn"
                                       class="button button-success float-right">
                                        <i class="fas fa-plus-circle"></i> Add New
                                    </a>
                                {/if}
                            </td>
                        </tr>
                    </table>
                    <div id="item-data-table">
                        <table class="table table-condensed table-striped">
                            <thead class="text-notify">
                            <tr>
                                <th class="text-align-center" style="width: 20px;">
                                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                                </th>
                                <th class="text-align-center" style="width: 25px;">S/N</th>
                                <th class="text-align-left">Name</th>
                                <th class="text-align-center" style="width: 50px;">Ability</th>
                                <th class="text-align-center" style="width: 80px;">Action</th>
                            </tr>
                            </thead>
                            <tbody id="items-data">
                            {if isset($items) && count($items)}
                                {foreach item = data  from = $items}
                                    <tr>
                                        <td class="text-align-center">
                                            <label><input type="checkbox" id="item-select" class="check_box" data-id="{$data.id}" data-name="{$data.name}" data-c_status="{$data.c_status}"/></label>
                                        </td>
                                        <td class="text-align-center">{$data.serialNumber}</td>
                                        <td class="text-align-left">{$data.name}</td>
                                        <td class="text-align-center">
                                            {if ($data.c_status === 'available')}<a href="javascript:void(0)" id="changeItemAbility" data-id="{$data.id}" data-curent_status="{$data.c_status}" class="button button-xs button-success" title="Click to make unavailable"><i class="far fa-check-circle"></i></a>{else}<a href="javascript:void(0)" id="changeItemAbility" data-id="{$data.id}" data-curent_status="{$data.c_status}" class="button button-xs button-danger" title="Click to make available"><i class="far fa-times-circle"></i></a>{/if}
                                        </td>
                                        <td class="text-align-center">
                                            <a href="javascript:void(0);" id="item-edit-btn" class="button button-xs button-success" data-id="{$data.id}" data-name="{$data.name}" data-c_status="{$data.c_status}"><i class="far fa-edit"></i></i></a>&nbsp;&nbsp;
                                            <a href="javascript:void(0);" id="item-delete-btn" class="button button-xs button-danger" data-id="{$data.id}"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                {/foreach}
                            {/if}
                            </tbody>
                            <tfoot class="text-notify">
                            <tr>
                                <th class="text-align-center">
                                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                                </th>
                                <th class="text-align-center">S/N</th>
                                <th class="text-align-left">Name</th>
                                <th class="text-align-center">Ability</th>
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
