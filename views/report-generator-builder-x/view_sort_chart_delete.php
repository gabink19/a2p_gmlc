<script type="text/javascript">
            function move(el, dir) {
                var max = el.options.length;
                //  the selected option
                var i1 = el.selectedIndex;
                var o1 = el.options[i1];
                
                //  the option to switch places with
                var i2 = (i1 + dir) % max;                
                if (i2 < 0) i2 = max - 1;
                var o2 = el.options[i2];
                
                //  temporarily move o1 to very end
                var tmp = el.options[max] = new Option(o1.text, o1.value);
                
                //  move o2 to o1
                el.options[i1] = new Option(o2.text, o2.value);
                
                //  move temp o1 to o2
                el.options[i2] = new Option(tmp.text, tmp.value);
                
                //  remove temp o1
                el.options.length = max;

                el.selectedIndex = i2;
            }
        </script>
        
        <form>
            
<?
$id=0;
$count=count($chart);
echo "<select name='sel' size='$count' style='
    width: 300px;
'>";
foreach ($chart as $ch){
    echo "<option value='$id'> $ch</option>";
    $id++;
}
?>
</select>
      
<br>
<input type="button" value="/\" onclick="move(this.form.sel, -1);" />
<input type="button" value="\/" onclick="move(this.form.sel, 1);" />

</form>



 