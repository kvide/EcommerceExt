<div class="information">{$mod->Lang('info_config_tab')}</div>

{foreach $report as $key => $rec}
<h4>{$rec.label}</h4>
<div class="c_full cf">
  {if !$rec.name}
    <div class="warning grid_12" style="text-align: center;">{$mod->Lang('warn_nomodule')}</div>
  {else}
    <div class="grid_4">{$rec.name}</div>
    <div class="grid_4">{if !$rec.ok}<span style="color: red;">{$mod->Lang('not_configured')}</span>{else}{$mod->Lang('ok')}{/if}</div>
    <div class="grid_4"><a href="{cms_action_url action=admin_config_tab type=$key rmmod=$rec.name}"/>{$mod->lang('unset')}</a></div>
  {/if}
</div>
{if !$rec@last}<hr/>{/if}
{/foreach}