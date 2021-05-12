<div class="row" style="margin: 5px;">
    <div style="margin: 0 auto; width: 500px;">
        <fieldset class="box-shadow-light">
            <legend class="box-shadow-light">Brands</legend>
            <div class="row">
                <div id="message"> <!-- only javascipt show message --> </div>
                <div class="row">
                    <div id="modal01" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="brandEditMode"> <!-- only javascipt show action status --> </span>&nbsp;brand
                            </div>
                            <div class='modal-body'>
                                <div id="message2"> <!-- only javascipt show message --> </div>
                                <div id="brandEditPAD">
                                    <form name="form1" id="brandform1" method="post">
                                        <input id="brandID" type="hidden" value=""/>
                                        <table class="table table-condensed">
                                            <tr>
                                                <td style="width: 50%;">
                                                    Name:
                                                    <input id="brandName" type="text" class="input-control" value=""
                                                           placeholder="Name" maxlength="30"/>
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
                                <a href="javascript:void(0);" id="brand-data-btn"
                                   class="button button-primary float-right">
                                    <!-- only javascipt show button name --> </a>
                                <a href="javascript:void(0);" id="brand-reset-btn"
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
                                <a href="javascript:void(0);" onclick="window.location = _root_ + 'office/'"
                                   class="button button-danger float-left">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Back
                                </a>
                            </td>
                            <td>
                                {if $acl->permission('add_product_item')}
                                    <a href="javascript:void(0);" id="brand-add-btn"
                                       class="button button-success float-right">
                                        <i class="fas fa-plus-circle"></i> Add New
                                    </a>
                                {/if}

                            </td>
                        </tr>
                    </table>
                    <div id="brands-data-table">
                        <table class="table table-condensed table-striped">
                            <thead class="text-notify">
                            <tr>
                                <th class="text-align-center" style="width: 20px;">
                                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                                </th>
                                <th class="text-align-center" style="width: 30px;">S/N</th>
                                <th class="text-align-left">Name</th>
                                <th class="text-align-center" style="width: 80px;">Action</th>
                            </tr>
                            </thead>
                            <tbody id="brands-data">
                            {if isset($brands) && count($brands)}
                                {foreach item = data  from = $brands}
                                    <tr>
                                        <td class="text-align-center">
                                            <label><input type="checkbox" id="brand-select" class="check_box"
                                                          data-id="{$data.id}" data-name="{$data.name}"/></label>
                                        </td>
                                        <td class="text-align-center">{$data.serialNumber}</td>
                                        <td class="text-align-left">{$data.name}</td>
                                        <td class="text-align-center">
                                            <a href="javascript:void(0);" id="brand-edit-btn"
                                               class="button button-xs button-success" data-id="{$data.id}"
                                               data-name="{$data.name}">&nbsp;<i class="far fa-edit"></i></i></a>&nbsp;&nbsp;
                                            <a href="javascript:void(0);" id="brand-delete-btn"
                                               class="button button-xs button-danger" data-id="{$data.id}"><i
                                                        class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                {/foreach}
                            {else}
                                <tr>
                                    <td colspan="4">
                                        No brand exist.
                                    </td>
                                </tr>
                            {/if}
                            </tbody>
                            <tfoot class="text-notify">
                            <tr>
                                <th class="text-align-center">
                                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                                </th>
                                <th class="text-align-center">S/N</th>
                                <th class="text-align-left">Name</th>
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
