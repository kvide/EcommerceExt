<div class="information">{$mod->Lang('info_cart_policy')}</div>

<fieldset>
  <legend>{$mod->Lang('system_policy')}:</legend>
  {$formstart}
<div class="c_full cf">
  <label class="grid_5">{$mod->Lang('max_products')}:</label>
  <div class="grid_6">
    <select name="{$actionid}policy_maxproducts" class="grid_12">
      {html_options options=$num_options selected=$syspolicy->max_products()}
    </select>
  </div>
</div>
<div class="c_full cf">
  <label class="grid_5">{$mod->Lang('max_services')}:</label>
  <div class="grid_6">
    <select name="{$actionid}policy_maxservices" class="grid_12">
      {html_options options=$num_options selected=$syspolicy->max_services()}
    </select>
  </div>
</div>
<div class="c_full cf">
  <label class="grid_5">{$mod->Lang('max_subscriptions')}:</label>
  <div class="grid_6">
    <select name="{$actionid}policy_maxsubscriptions" class="grid_12">
    {html_options options=$num_options selected=$syspolicy->max_subscriptions()}
    </select>
  </div>
</div>
<div class="c_full cf">
  <label class="grid_5">{$mod->Lang('max_subscription_periods')}:</label>
  <div class="grid_6">
    <select name="{$actionid}policy_maxsubscription_periods" class="grid_12">
    {html_options options=$num_options selected=$syspolicy->max_subscription_periods()}
    </select>
  </div>
</div>
<div class="c_full cf">
  <label class="grid_5">{$mod->Lang('mixed_subscriptions')}:</label>
  <div class="grid_6">
    {xt_yesno_options prefix=$actionid name='policy_mixedsubscriptions' selected=$syspolicy->handle_mixed_subscriptions() class="grid_12"}
  </div>
</div>
<div class="c_full cf">
  <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
</div>
{$formend}
</fieldset>

<fieldset>
<legend>{$mod->Lang('gateway_policy')}</legend>
<div class="c_full cf">
  <label class="grid_6">{$mod->Lang('max_products')}:</label>
  <div class="grid_6">
    {assign var='tmp' value=$paypolicy->max_products()}
    {$num_options[$tmp]}
  </div>
</div>
<div class="c_full cf">
  <label class="grid_6">{$mod->Lang('max_services')}:</label>
  <div class="grid_6">
    {assign var='tmp' value=$paypolicy->max_services()}
    {$num_options[$tmp]}
  </div>
</div>
<div class="c_full cf">
  <label class="grid_6">{$mod->Lang('max_subscriptions')}:</label>
  <div class="grid_6">
    {assign var='tmp' value=$paypolicy->max_subscriptions()}
    {$num_options[$tmp]}
  </div>
</div>
<div class="c_full cf">
  <label class="grid_6">{$mod->Lang('max_subscription_periods')}:</label>
  <div class="grid_6">
    {assign var='tmp' value=$paypolicy->max_subscription_periods()}
    {$num_options[$tmp]}
  </div>
</div>
<div class="c_full cf">
  <label class="grid_6">{$mod->Lang('mixed_subscriptions')}:</label>
  <div class="grid_6">
   {if $paypolicy->handle_mixed_subscriptions()}
     {$mod->Lang('yes')}
   {else}
     {$mod->Lang('no')}
   {/if}
  </div>
</div>
</fieldset>