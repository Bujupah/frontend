<h1 id="loader"><?php if(sizeof(getSystemData($db,'station')) == 0 ) echo "Add your first station"; else echo "Add another station"; ?> </h1>
<form class="form" id="station-form">
    <label> STATION NAME </label>
    <input type="text" id="name-station" name="name" value="" placeholder="Station name">
    <label> GATEWAY </label>
    <input type="text" id="gateway-station" name="gateway" value="<?php echo getSystemData($db,'gateway')[0]['label']; ?>" placeholder="Gateway" readonly>

    <button type="button" id="save-station">Save</button>
    <div id="error"></div>
    <br>
</form>