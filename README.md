# Zabbix-Top10
Zabbix添加Top10页面的方法

## 使用方法
按Top10文件夹中的文件结构，将文件复制到zabbix-web服务器的/usr/share/zabbix/中，按照include文件夹中menu.inc.php.sample编辑/usr/share/zabbix/include/menu.inc.php，即在一级菜单“监测/Monitoring”下添加二级菜单“TOP10”：
```php
				[
					'url' => 'top10.php',
					'label' => _('TOP10')
				],
```

编辑/top10/top10_config.php，填入数据库相应信息，具体原理及效果参看[Zabbix Top10页面的制作](http://www.icoder.top/blog/?p=840)


## 当前存在的问题
1、top10页面中的一级子菜单失效。因为我本身没有仔细研究zabbix的源代码和api，只是本着能用即可的想法来做的，所以很粗糙，等有时间了再进行改进吧，我想这个功能使用原生的zabbix api开发应该不难，且视觉效果更好。

2、数据库信息其实可以从/etc/zabbix/server.conf中读取，而无需再次配置。

3、Top10数据直接从数据库中读取，很粗糙实现方式危险性也很大，好在我们的监控系统处在内网中，不建议将代码直接用于开放的生产环境中。
