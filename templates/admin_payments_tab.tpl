{if !isset($module_list)}
<div class="warning" style="width: 94%; margin-right: 10px;">
  {$mod->Lang('err_gateways_notfound')}
</div>
{else}
  {$formstart}
  <div class="information">{$mod->Lang('info_payment_modules2')}</div>
  <div class="pageoverflow">
    <p class="pagetext">{$mod->Lang('payment_modules')}:</p>
    <p class="pageinput">
      <select name="{$actionid}sel_payment_modules[]" size="3" multiple="multiple">
      {html_options options=$module_list selected=$sel_payment_modules}
      </select>
    </p>
  </div>
  <div class="pageoverflow">
    <p class="pageinput">
      <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
    </p>
  </div>
{$formend}
{/if}