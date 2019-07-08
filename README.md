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
