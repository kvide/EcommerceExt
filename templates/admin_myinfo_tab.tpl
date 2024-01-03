{$formstart}
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('prompt_company')}:*</label>
  <input class="grid_9" type="text" name="{$actionid}company" size="50" maxlength="255" value="{$my_address->get_company()}"/>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('prompt_firstname')}:</label>
  <input class="grid_9" type="text" name="{$actionid}firstname" size="50" maxlength="50" value="{$my_address->get_firstname()}"/>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('prompt_lastname')}:</label>
  <input class="grid_9" type="text" name="{$actionid}lastname" size="50" maxlength="50" value="{$my_address->get_lastname()}"/>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('prompt_address1')}:*</label>
  <input class="grid_9" type="text" name="{$actionid}address1" size="50" maxlength="100" value="{$my_address->get_address1()}"/>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('prompt_address2')}:</label>
  <input class="grid_9" type="text" name="{$actionid}address2" size="50" maxlength="100" value="{$my_address->get_address2()}"/>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('prompt_city')}:*</label>
  <input class="grid_9" type="text" name="{$actionid}city" size="20" maxlength="50" value="{$my_address->get_city()}"/>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('prompt_state')}:</label>
  <select class="grid_9" name="{$actionid}state">
    {html_options options=$state_list selected=$my_address->get_state()}
  </select>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('prompt_postal')}:</label>
  <input class="grid_9" type="text" name="{$actionid}postal" size="10" maxlength="25" value="{$my_address->get_postal()}"/>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('prompt_country')}:*</label>
  <select class="grid_9" name="{$actionid}country">
    {html_options options=$country_list selected=$my_address->get_country()}
  </select>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('prompt_phone')}:*</label>
  <input class="grid_9" type="text" name="{$actionid}phone" size="12" maxlength="25" value="{$my_address->get_phone()}"/>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('prompt_fax')}:</label>
  <input class="grid_9" type="text" name="{$actionid}fax" size="12" maxlength="25" value="{$my_address->get_fax()}"/>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('prompt_email')}:*</label>
  <input class="grid_9" type="text" name="{$actionid}email" size="50" maxlength="255" value="{$my_address->get_email()}"/>
</div>
<div class="c_full cf">
  <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
</div>
{$formend}