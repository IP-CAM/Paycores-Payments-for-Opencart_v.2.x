<?php
/**
 * Created by Paycores.com.
 * User: paycores-02
 * Date: 30/10/17
 * Time: 09:41 AM
 */

$paycores_args_array = array();
foreach ($paycoresData as $key => $value) {
  $keyName  = html_entity_decode($key, ENT_QUOTES, 'UTF-8');
  $keyValue = html_entity_decode($value, ENT_QUOTES, 'UTF-8');
  $paycores_args_array[] = '<input type="hidden" name="'.$keyName.'" value="'.$keyValue.'" />';
}
?>

<form action="<?php echo $action; ?>" method="post" class="form-horizontal">
  <?php echo implode( '', $paycores_args_array); ?>

  <h4><?php echo $paycores_tanks_orden; ?></h4>

  <div class="col-sm-4">
    <div class="form-group">
      <label for="genlist">Género</label>
      <select name="paycores_usr_gender" id="genlist" class="form-control">
        <option value="M">Masculino</option>
        <option value="F">Femenino</option>
      </select>
    </div>
  </div>
  <div class="col-sm-4">
    <label for="paycores_usr_birth">Fecha de nacimiento</label>
    <input type="text" class="form-control" name="paycores_usr_birth" id="paycores_usr_birth" placeholder="1980-01-20" required>
  </div>
  <div class="col-sm-4">
    <div class="form-group">
      <label for="paycores_usr_numberId">Número de identificación</label>
      <input type="text" class="form-control" name="paycores_usr_numberId" id="paycores_usr_numberId" placeholder="1094000000" required>
    </div>
  </div>
  <div class="col-sm-12">
    <div class="form-group">
      <div class="buttons">
        <div class="pull-right"><input type="submit" value="<?php echo $button_confirm; ?>" class="btn btn-primary" /></div>
      </div>
    </div>
  </div>
</form>