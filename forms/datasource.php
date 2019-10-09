<h1 id="loader"><?php if(sizeof(getSystemData($db,'datasource')) == 0 ) echo "Add your first datasource";  else echo "Add another datasource";?> </h1>
<form class="form" id="datasource-form">
    <label> Datasource name </label>
    <input type="text" id="label" name="name" value="" placeholder="NAME">
    <label> is Active? </label>
    <select id="station" name="active" type="text">
        <option value="1" > YES </option>
        <option value="0" > NO </option>
    </select>
    <label> Station name </label>
    <select id="station" name="station" type="text">
        <?php
        foreach (getSystemData($db,'station') as $value){
            echo "<option value='".$value['label']."'>".$value['label']."</option>";
        }
        ?>
    
    </select>
    <button type="button" id="save-datasource">Save</button>

    <div id="error"></div>
    <br>
</form>