<h1 id="loader"><?php if(sizeof(getSystemData($db,'sensor')) == 0 ) echo "Add your first sensor"; else echo "Add another sensor"; ?> </h1>
<form class="form" id="sensor-form">
    <label> #TAG NAME </label>
    <input type="text" id="label-sensor" name="label" value="" placeholder="Tag name">
    <label> SENSOR NAME </label>
    <input type="text" id="name-sensor" name="name" value="" placeholder="Name">
    <label> TAGS </label>
    <input type="text" id="tags-sensor" name="tags" value="" placeholder="Tag1, Tag2, Tag3...">
    <label> is Active? </label>
    <select id="sensor" name="active" type="text">
        <option value="1" > YES </option>
        <option value="0" > NO </option>
    </select>
    <label> Datasource name </label>
    <select id="datasource" name="datasource" type="text">
        <?php
        foreach (getSystemData($db,'datasource') as $value){
            echo "<option value='".$value['label']."'>".$value['label']."</option>";
        }
        ?>
    
    </select>
    <button type="button" id="save-sensor">Save</button>
    <div id="error"></div>
    <br>
</form>