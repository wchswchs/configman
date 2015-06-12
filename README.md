# configman
基础服务统一配置工具，目前支持Redis，Memcache，MySQL和RabbitMQ，可以通过web或cli方式实现配置文件项的增加，删除，修改，查找。

#特性
1. 支持多种服务配置存储方式 (进行中...)
2. 支持服务的可扩展性
3. 支持cli方式操作配置
4. 支持web方式操作配置
5. 支持API本地调用
6. 支持配置推送方式的可扩展 (进行中...)

#用法
一、Api使用方法

Example(以MySQL配置为例)：

1. 如果基础服务配置路径：

		/home/www/conf

   则config目录下的config.inc.php中
   
   		define('CONF_PATH', '/home/www/conf/');
   
   如果业务项目为B2C，则mysql配置为b2c.mysql.ini
   
   内容为
   
   		db=b2c host=127.0.0.1 port=3306 weight=1 user=b2c pass=123456 master=1//主库
   		db=b2c host=127.0.0.1 port=3306 weight=1 user=b2c pass=123456 master=0//从库

2. cd example

   增加db配置：php add_config.php
   
   读取db配置：php get_config.php
   
   
二、命令行使用方法

   		cd bin
   
   1. help命令：
   
   ./configtool help
   
   		ConfigTool version 0.0.1

		Usage: 
			command [options]

		Available commands:
			add                 Add config item
			help                Displays this help
			list                Show config list
			push                Push config to servers
			remove              Remove config item
   
   
   2. list命令：
   
   ./configtool list --mysql=<业务项目mysql配置前缀>
   
    	db=b2c host=127.0.0.1 port=3306 weight=1 user=b2c pass=123456 master=1
    	db=b2c host=127.0.0.1 port=3306 weight=1 user=b2c pass=123456 master=0
   
   3. add命令
   
   ./configtool add --mysql=<业务项目mysql配置前缀>
   
   		db: b2c
   		host: 127.0.0.1
   		port: 
   		username: test 
   		password: test
   		
   4. remove命令
   	
   ./configtool remove --mysql=<业务项目mysql配置前缀> --line=3
   	
   
