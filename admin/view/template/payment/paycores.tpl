<?php
/**
 * Created by Paycores.com.
 * User: paycores-02
 * Date: 30/10/17
 * Time: 09:41 AM
 */ ?>

<?php echo $header; ?>
<?php echo $column_left; ?>
<div id="content">
  <div class="box">
    <div class="page-header">
      <div class="container-fluid">
        <h1><img src="view/image/payment/paycores.png" alt="" width="100px" /> <?php echo $heading_title; ?></h1>
        <ul class="breadcrumb">
          <?php foreach ($breadcrumbs as $breadcrumb) { ?>
            <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
          <?php } ?>
        </ul>
        <div class="pull-right">
          <a onclick="$('#form').submit();" class="btn btn-primary"><i class="fa fa-save"></i></a>
          <a href="<?php echo $cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
        </div>
      </div>
    </div>
    <div class="container-fluid">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><i class="fa fa-cog"></i> Paycores Settings</h3>
        </div>
        <div class="panel-body">
          <div class="well">
            <div class="row">
              <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">

                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label" for="paycores_status"><?php echo $entry_status; ?></label>
                    <select name="paycores_status" id="paycores_status" class="form-control">
                      <?php if ($paycores_status) { ?>
                        <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                        <option value="0"><?php echo $text_disabled; ?></option>
                      <?php } else { ?>
                        <option value="1"><?php echo $text_enabled; ?></option>
                        <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label" for="paycoresTestMode"><?php echo $paycores_test_mode; ?></label>
                    <select name="paycoresTestMode" id="paycoresTestMode" class="form-control">
                      <?php if ($paycores_settings_test_mode) { ?>
                        <option value="1" selected="selected"><?php echo $paycores_yes; ?></option>
                        <option value="0"><?php echo $paycores_no; ?></option>
                      <?php } else { ?>
                        <option value="1"><?php echo $paycores_yes; ?></option>
                        <option value="0" selected="selected"><?php echo $paycores_no; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label" for="paycoresOrderApprovedId"><?php echo $entry_order_approved; ?></label>
                    <select name="paycoresOrderApprovedId" id="paycoresOrderApprovedId" class="form-control">
                      <?php foreach ($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $paycores_order_approved_id) { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label" for="paycoresOrderCancelId"><?php echo $entry_order_failed; ?></label>
                    <select name="paycoresOrderCancelId" id="paycoresOrderCancelId" class="form-control">
                      <?php foreach ($order_statuses as $order_status) { ?>
                        <?php if ($order_status['order_status_id'] == $paycores_order_failed_id) { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
                        <?php } else { ?>
                        <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="clearfix"></div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label" for="paycoresCommerceID"><?php echo $paycores_commerce_id; ?></label>
                    <input type="text" name="paycoresCommerceID" id="paycoresCommerceID" class="form-control" value="<?php echo $paycores_settings_commerce_id; ?>" size="10" />
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label" for="paycoresApikey"><?php echo $paycores_api_key; ?></label>
                    <input type="text" name="paycoresApikey" id="paycoresApikey" class="form-control" value="<?php echo $paycores_settings_api_key; ?>" size="10" />
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label" for="paycoresApiLogin"><?php echo $paycores_api_login; ?></label>
                    <input type="text" name="paycoresApiLogin" id="paycoresApiLogin" class="form-control" value="<?php echo $paycores_settings_api_login; ?>" size="10" />
                  </div>
                </div>

                <div class="clearfix"></div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo $footer; ?>
