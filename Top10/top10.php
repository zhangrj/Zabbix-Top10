<?php
/*
** Zabbix
** Copyright (C) 2001-2018 Zabbix SIA
**
** This program is free software; you can redistribute it and/or modify
** it under the terms of the GNU General Public License as published by
** the Free Software Foundation; either version 2 of the License, or
** (at your option) any later version.
**
** This program is distributed in the hope that it will be useful,
** but WITHOUT ANY WARRANTY; without even the implied warranty of
** MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
** GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License
** along with this program; if not, write to the Free Software
** Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
**/


require_once dirname(__FILE__).'/include/config.inc.php';
//require_once dirname(__FILE__).'/include/hostgroups.inc.php';
//require_once dirname(__FILE__).'/include/hosts.inc.php';
//require_once dirname(__FILE__).'/include/triggers.inc.php';
//require_once dirname(__FILE__).'/include/items.inc.php';

$page['title'] = _('Top10');
$page['file'] = 'top10.php';
$page['type'] = detect_page_type(PAGE_TYPE_HTML);

define('ZBX_PAGE_DO_REFRESH', 1);
define('SHOW_TRIGGERS', 0);
define('SHOW_DATA', 1);

require_once dirname(__FILE__).'/include/page_header.php';
?>

<div id="cpu_idle_time" style="height:400px;margin:auto;"></div>
<div id="cpu_load" style="height:400px;margin:auto;"></div>
<div id="network_incoming" style="height:400px;margin:auto;"></div>
<div id="network_outgoing" style="height:400px;margin:auto;"></div>

<script src="js/echarts.min.js"></script> 

<script src="js/jquery.min.js"></script>

<script type="text/javascript">
    var cpu_idle_Chart = echarts.init(document.getElementById('cpu_idle_time'));
    var cpu_idle_hostname=[], cpu_idle_value=[];
    function getData(){
        $.ajax({
            type:"post",
            async:false,
            url:"top10/cpu_idle_time_top10.php",
            data:{},
            dataType:"json",
            success:function(result){
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        cpu_idle_hostname.push(result[i].host_name);
                        cpu_idle_value.push(result[i].item_value);
                    }
                }
            }
        })
        //return cpu_idle_hostname, cpu_idle_value;
    }
    getData();
    var cpu_idle_option = {
        title: {
            text: 'CPU idle time Top10',
            subtext: 'CPU空闲时间 单位:%'
        },
        tooltip: {
            show: true
        },
        legend: {
            data:['CPU idle time 单位:%']
        },
        grid: {
            containLabel:true
        },
        xAxis: {
            type:'value'
        },
        yAxis: {
            data:cpu_idle_hostname.reverse(),
        },
        series: [
            {
                name:"CPU idle time 单位:%",
                type:"bar",
                data:cpu_idle_value.reverse(),
                label:{
                    show:true
                }
            }
        ]
    };
    cpu_idle_Chart.setOption(cpu_idle_option);
</script>
<script type="text/javascript">
    var cpu_load_Chart = echarts.init(document.getElementById('cpu_load'));

    var cpu_load_hostname=[], cpu_load_value=[];
    function getData(){
        $.ajax({
            type:"post",
            async:false,
            url:"top10/cpu_load_top10.php",
            data:{},
            dataType:"json",
            success:function(result){
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        cpu_load_hostname.push(result[i].host_name);
                        cpu_load_value.push(result[i].item_value);
                    }
                }
            }
        })
        //return cpu_load_hostname, cpu_load_value;
    }
    getData();
    var cpu_load_option = {
        title: {
            text: 'CPU load Top10',
            subtext: 'CPU负载（5分钟平均）'
        },
        tooltip: {
            show: true
        },
        legend: {
            data:['CPU load']
        },
        grid: {
            containLabel:true
        },
        xAxis: {
            type:'value'
        },
        yAxis: {
            data:cpu_load_hostname.reverse()
        },
        series: [
            {
                name:"CPU load",
                type:"bar",
                data:cpu_load_value.reverse(),
                label:{
                    show:true
                }
            }
        ]
    };
    cpu_load_Chart.setOption(cpu_load_option);
</script>
<script type="text/javascript">
    var network_incoming_Chart = echarts.init(document.getElementById('network_incoming'));

    var network_incoming_hostname=[], network_incoming_value=[];
    function getData(){
        $.ajax({
            type:"post",
            async:false,
            url:"top10/network_incoming_top10.php",
            data:{},
            dataType:"json",
            success:function(result){
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        network_incoming_hostname.push(result[i].host_name);
                        network_incoming_value.push(result[i].item_value);
                    }
                }
            }
        })
        //return network_incoming_hostname, network_incoming_value;
    }
    getData();
    var network_incoming_option = {
        title: {
            text: 'Network incoming Top10',
            subtext: '流入流量top10 单位:Mbps'
        },
        tooltip: {
            show: true
        },
        legend: {
            data:['network incoming 单位:Mbps']
        },
        grid: {
            containLabel:true
        },
        xAxis: {
            type:'value'
        },
        yAxis: {
            data:network_incoming_hostname.reverse()
        },
        series: [
            {
                name:"network incoming 单位:Mbps",
                type:"bar",
                data:network_incoming_value.reverse().map(function convertToMbps(num) {return (num/1000000).toFixed(2);}),
                label:{
                    show:true
                }
            }
        ]
    };
    network_incoming_Chart.setOption(network_incoming_option);
</script>
<script type="text/javascript">
    var network_outgoing_Chart = echarts.init(document.getElementById('network_outgoing'));

    var network_outgoing_hostname=[], network_outgoing_value=[];
    function getData(){
        $.ajax({
            type:"post",
            async:false,
            url:"top10/network_outgoing_top10.php",
            data:{},
            dataType:"json",
            success:function(result){
                if (result) {
                    for (var i = 0; i < result.length; i++) {
                        network_outgoing_hostname.push(result[i].host_name);
                        network_outgoing_value.push(result[i].item_value);
                    }
                }
            }
        })
        //return network_outgoing_hostname, network_outgoing_value;
    }
    getData();
    var network_outgoing_option = {
        title: {
            text: 'Network outgoing Top10',
            subtext: '流出流量top10 单位:Mbps'
        },
        tooltip: {
            show: true
        },
        legend: {
            data:['network outgoing 单位:Mbps']
        },
        grid: {
            containLabel:true
        },
        xAxis: {
            type:'value'
        },
        yAxis: {
            data:network_outgoing_hostname.reverse()
        },
        series: [
            {
                name:"network outgoing 单位:Mbps",
                type:"bar",
                data:network_outgoing_value.reverse().map(function convertToMbps(num) {return (num/1000000).toFixed(2);}),
                label:{
                    show:true
                }
            }
        ]
    };
    network_outgoing_Chart.setOption(network_outgoing_option);
</script>

<?php
require_once dirname(__FILE__).'/include/page_footer.php';
?>