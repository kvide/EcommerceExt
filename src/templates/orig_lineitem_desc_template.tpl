{* used for summarizing products in view cart form page *}
{strip}
{if isset($product_obj)}
{$product_obj->get_name()}&nbsp;-&nbsp;
  {if isset($meta)}
    {foreach from=$meta->attributes item='attrib'}
      {$attrib->name}&nbsp;{if $attrib->adjustment != 0}{$currencysymbol}({$attrib->adjustment|number_format:2}){/if}&nbsp;
    {/foreach}
  {else}
    {assign var='opts' value=$cart_item->get_options()}
    {foreach from=$opts item='opt'}
      {$opt->text}&nbsp;{if $opt->adjustment != 0}{$currencysymbol} ({$opt->adjustment|number_format:2}){/if}&nbsp;
    {/foreach}
  {/if}
{/if}
{/strip}
