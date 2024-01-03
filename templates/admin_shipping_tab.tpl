{form_start action=admin_shipping_tab}
<div class="information">{$mod->Lang('info_shipping_policy')}</div>

<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('ships_to')}:</label>
  <div class="grid_9">
    <select class="grid_12" name="{$actionid}shipto[]" multiple size="8">
       {html_options options=$countries selected=$policy->shipto}
    </select>
    <p class="grid_12">{$mod->Lang('info_shipping_shipto')}</p>
  </div>
</div>

<div class="c_full cf">
  <label class="grid_2">{$mod->Lang('allow_pickup')}:</label>
  <div class="grid_9">
    <select class="grid_12" name="{$actionid}allow_pickup">
       {xt_yesno_options selected=$policy->can_pickup}
    </select>
    <p class="grid_12">{$mod->Lang('info_shipping_pickup')}</p>
  </div>
</div>


<div class="c_full cf">
  <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
</div>
{form_end}