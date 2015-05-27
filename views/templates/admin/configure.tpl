{if $id_shop}
    <div class="conf" id="confirm_message">
        {l s='Settings saved' mod='modulename'}
    </div>

    <div id="module_name_configuration">
        Your configuration here.
    </div>
{else}
    <p class="center">
        {l s='Please select a shop first' mod='modulename'}
    </p>
{/if}