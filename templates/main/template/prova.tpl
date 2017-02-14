<p>Ecco i quattro componenti degli ABBA:</p>
<table>
{foreach from=$abba item=array1}
    <tr>
    {foreach from=$array1 item=valoredelporcodio}
        <td>
    {$valoredelporcodio}  
        </td>
{/foreach}
    </tr>
{/foreach}
</table> 

