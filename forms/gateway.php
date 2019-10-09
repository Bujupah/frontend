<h1 id="loader"><?php if(sizeof(getSystemData($db,'gateway')) == 0 ) echo "Add your first station"; else echo "Edit your gateway"; ?> </h1>
<form class="form" id="gateway-form">
    <input type="text" id="label" name="name" value="<?php if(sizeof(getSystemData($db,'gateway')) >0 ) echo getSystemData($db,'gateway')[0]['label']; ?>" placeholder="NAME">
    <select id="protocol" name="protocol" type="text">
        <option value="tcp/ip" <?php if(sizeof(getSystemData($db,'gateway')) >0 ) if(getSystemData($db,'gateway')[0]['protocol'] == "tcp/ip") echo "selected";?>>TCP/IP</option>
        <option value="mqtt" <?php if(sizeof(getSystemData($db,'gateway')) >0 ) if(getSystemData($db,'gateway')[0]['protocol'] == "mqtt") echo "selected";?>>MQTT</option>
        <option value="lorawan" <?php if(sizeof(getSystemData($db,'gateway')) >0 ) if(getSystemData($db,'gateway')[0]['protocol'] == "lorawan") echo "selected";?>>LoRaWAN</option>
    </select>
    <input type="text" id="ip" value="<?php if(sizeof(getSystemData($db,'gateway')) >0 ) echo getSystemData($db,'gateway')[0]['ip']; ?>" name="ip" placeholder="IP">
    <input type="text" id="port" value="<?php if(sizeof(getSystemData($db,'gateway')) >0 ) echo getSystemData($db,'gateway')[0]['port']; ?>" name="port" placeholder="PORT">
    <input type="text" id="coordination" name="coordination" value="<?php if(sizeof(getSystemData($db,'gateway')) >0 ) echo getSystemData($db,'gateway')[0]['longitude'].",".getSystemData($db,'gateway')[0]['latitude']; ?>" placeholder="Longitude | Latitude">
    <input type="text" id="address" value="<?php if(sizeof(getSystemData($db,'gateway')) >0 ) echo getSystemData($db,'gateway')[0]['address']; ?>" name="address" placeholder="Address">
    <input type="text" id="live_date" value="<?php if(sizeof(getSystemData($db,'gateway')) >0 ) echo getSystemData($db,'gateway')[0]['live_date']; ?>" name="live_date" placeholder="Live date" hidden>
    <button type="button" id="save-gateway">Save</button>

    <div id="error"></div>
    <br>
</form>