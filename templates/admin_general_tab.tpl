<div class="warning">{$mod->Lang('warn_general_settings')}</div>

{form_start action=admin_general_tab}
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('currency_symbol')}:</label>
  <div class="grid_10">
    <input class="grid_2" type="text" name="{$actionid}currency_symbol" value="{$currency_symbol}" size="4" maxlength="4"/>
  </div>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('currency_code')}:</label>
  <div class="grid_10">
    <input class="grid_2" type="text" name="{$actionid}currency_code" value="{$currency_code}" size="4" maxlength="4"/>
  </div>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('weight_units')}:</label>
  <div class="grid_10">
    <select name="{$actionid}weight_units" class="grid_12">
      {html_options options=$weight_units_list selected=$weight_units}
    </select>
  </div>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('length_units')}:</label>
  <div class="grid_10">
    <select name="{$actionid}length_units" class="grid_12">
      {html_options options=$units selected=$length_units}
    </select>
  </div>
</div>
<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('tax_shipping')}:</label>
  <div class="grid_10">
    <select name="{$actionid}tax_shipping" class="grid_12">
      {cms_yesno selected=$tax_shipping}
    </select>
    <p class="grid_12">{$mod->Lang('info_tax_shipping')}</p>
  </div>

</div>
<div class="c_full cf">
  <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
</div>
{form_end}