<p>Ecco i quattro componenti degli ABBA:</p>
<table>
{foreach from=$foto item=array1}
    <tr>
    {foreach from=$array1 item=valore}
        <td>
    {$valore}  
        </td>
{/foreach}
    </tr>
{/foreach}
</table> 

