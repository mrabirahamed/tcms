<div class="row" style="margin: 5px;">
    <div style="margin: 0 auto; width: 100%;">
        <fieldset class="box-shadow-light">
            <legend class="box-shadow-light">Invoices</legend>
            <div class="row">
                <div id="message"> <!-- only javascript show message --> </div>
                <div class="row">
                    <!-- client dialog box -->
                    <div id="modal01" class="modal">
                        <div class="row md-modal-content animate">
                            <div class="modal-header">
                                <span id="clientsEditMode"> <!-- only javascript show action status --> </span>&nbsp;client
                            </div>
                            <div class='modal-body'>
                                <div id="message2"> <!-- only javascript show message --> </div>
                                <div id="clientsEditPAD">
                                    <span class="text-danger">An asterisk (*) marked field must filled up.</span>
                                    <form name="form1" id="ClientsForm1" method="post">
                                        <input id="clientsID" type="hidden" value=""/>
                                        <table class="table table-condensed">
                                            <tr>
                                                <td style="width: 50%;">
                                                    Name:<span class="text-danger">(*)</span>
                                                    <input id="fl_nm" type="text" class="input-control"
                                                           title="Client's name." placeholder="Client's name."/>
                                                </td>
                                                <td style="width: 50%;">
                                                    Mobile/Phone Number:<span class="text-danger">(*)</span>
                                                    <input id="cntct_nmbr" type="text" class="input-control"
                                                           title="Client's mobile number."
                                                           placeholder="Client's mobile number."/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    Address:<span class="text-danger">(*)</span>
                                                    <textarea id="cntct_addrs" class="input-control"
                                                              title="Client's address."
                                                              placeholder="Client's address."></textarea>
                                                </td>
                                            </tr>

                                        </table>
                                    </form>
                                </div>
                            </div>
                            <div class='row2 modal-footer'>
                                <a href="javascript:void(0);" id="clients-close-btn"
                                   class="button button-danger float-left">Cancel</a>
                                <a href="javascript:void(0);" id="clients-data-btn"
                                   class="button button-primary float-right">
                                    <!-- only javascipt show button name --> </a>
                                <a href="javascript:void(0);" id="clients-reset-btn"
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
                                <div id="message5"> <!-- only javascipt show message --> </div>
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
                                <a href="javascript:void(0);" onclick="window.location = _root_"
                                   class="button button-danger float-left">
                                    <i class="fas fa-arrow-left" aria-hidden="true"></i> Back
                                </a>
                            </td>
                            <td>
                                {if $acl->permission('add_clients_invoice')}
                                    <a href="javascript:void(0);" id="clients-add-btn"
                                       class="button button-success float-right">
                                        <i class="fas fa-plus-circle"></i> Add new client
                                    </a>
                                {/if}

                            </td>
                        </tr>
                    </table>
                    <div id="clients-data-table">
                        <table class="table table-condensed table-striped">
                            <thead class="text-notify">
                            <tr>
                                <th class="text-align-center" style="width: 20px;">
                                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                                </th>
                                <th class="text-align-center" style="width: 30px;">S/N</th>
                                <th class="text-align-left" style="width: 250px;">Name</th>
                                <th class="text-align-left" style="width: 100px;">Mob. Number</th>
                                <th class="text-align-left" style="width: 250px;">Address</th>
                                <th class="text-align-center" style="width: 80px;">Action</th>
                            </tr>
                            </thead>
                            <tbody id="clients-data">
                            {if isset($clients) && count($clients)}
                                {foreach item = data  from = $clients}
                                    <tr>
                                        <td class="text-align-center">
                                            <label>
                                                <input type="checkbox" id="clients-select" class="check_box" data-id="{$data.id}" data-name="{$data.name}"
                                                                                    data-mobile-number="{$data.mobile_number}" data-address="{$data.address}"/>
                                            </label>
                                        </td>
                                        <td class="text-align-center">{$data.serialNumber}</td>
                                        <td class="text-align-left">{$data.name}</td>
                                        <td class="text-align-left">{$data.mobile_number}</td>
                                        <td class="text-align-left">{$data.address}</td>
                                        <td class="text-align-center">
                                            <a href="javascript:void(0);" id="clients-edit-btn" class="button button-xs button-success" data-id="{$data.id}" data-name="{$data.name}"
                                               data-mobile-number="{$data.mobile_number}" data-address="{$data.address}"> <i class="far fa-edit"></i></a>&nbsp;&nbsp;
                                            <a href="javascript:void(0);" id="clients-delete-btn" class="button button-xs button-danger" data-id="{$data.id}"><i class="far fa-trash-alt"></i></i></a>
                                        </td>
                                    </tr>
                                {/foreach}
                            {/if}
                            </tbody>
                            <tfoot class="text-notify">
                            <tr>
                                <tr>
                                <th class="text-align-center" style="width: 20px;">
                                    <label><input id="checkAll" type="checkbox" class="check_box"/></label>
                                </th>
                                <th class="text-align-center" style="width: 30px;">S/N</th>
                                <th class="text-align-left" style="width: 250px;">Name</th>
                                <th class="text-align-left" style="width: 100px;">Mob. Number</th>
                                <th class="text-align-left" style="width: 250px;">Address</th>
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