<?php
    require("top10_config.php");
    
    // create connection
    $conn = mysqli_connect($DB_SERVER, $DB_USER, $DB_PASSWORD, $DB_NAME, $DB_PORT);
    // Check connection
    if (!$conn) {
        die("connect database failed:" . mysqli_connect_error());
    }
 
    // change character set to utf8 
    mysqli_set_charset($conn, "utf8"); 

    // get top10 data
    $network_incoming_top10_sql = "select hosts.name,b.value from (select * from (select * from history_uint where itemid in (select itemid from items where key_ like 'net.if.in[%]' and hostid in ( select hostid from hosts where available=1)) and clock in (select MAX(clock) from history group by itemid) order by clock) a group by a.itemid order by a.value desc limit 10) b inner join items on items.itemid=b.itemid inner join hosts on hosts.hostid=items.hostid";
    $network_incoming_top10 = mysqli_query($conn, $network_incoming_top10_sql);   

    // convert object to json
    class top10{
        public $host_name;
        public $item_value;
    }
    $data = "";
    $array = array();
    while($row = mysqli_fetch_array($network_incoming_top10,MYSQL_ASSOC))
    {
        $top10_data = new top10();
        $top10_data->host_name = $row['name'];
        $top10_data->item_value = $row['value'];
        $array[] = $top10_data;
    }
    $data = json_encode($array);  
    mysqli_close($conn);
    echo $data;  
?>