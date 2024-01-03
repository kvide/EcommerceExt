{if empty($supplier_all_modules)}
   <div class="warning">{$mod->Lang('warn_no_suppliers')}</div>
{else}

{$formstart}
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('supplier_modules')}:</p>
  <p class="pageinput">
    <select name="{$actionid}supplier_modules[]" multiple="multiple" size="3">
    {html_options options=$supplier_all_modules selected=$supplier_modules}
    </select>
    <br/>
    {$mod->Lang('info_supplier_modules')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('lineitem_desc_template')}:</p>
  <p class="pageinput">
    {$input_lineitem_desc_template}
    <br/>
    <input type="submit" name="{$actionid}reset_lineitem_desc" value="{$mod->Lang('reset')}"/>
    <br/>
    {$mod->Lang('info_lineitem_desc_template')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext">{$mod->Lang('attrib_item_description')}:</p>
  <p class="pageinput">
    <input type="text" name="{$actionid}attrib_item_description" value="{$attrib_item_description}" size="80" maxlength="512"/>
    <br/>
    {$mod->Lang('info_attrib_item_description')}
  </p>
</div>
<div class="pageoverflow">
  <p class="pagetext"></p>
  <p class="pageinput">
    <input type="submit" name="{$actionid}submit" value="{$mod->Lang('submit')}"/>
  </p>
</div>
{$formend}
{/if}
