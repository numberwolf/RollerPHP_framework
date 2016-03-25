<img src="Storage/RollerPHP_small.png" />                  
* 更新  
	* 2016/03/20,控制器加入命名空间(具体反馈请看文档http://123.56.154.87/RollerDoc/introduce.html)
		* 控制器命名:空间规则, <font color="blue">namespace Controller\Home名称</font> 
    * 2016/03/25,更新控制器继承关系          
        * Controller之间引用继承，并且更新System核心文件     

###RollerPHP Beta2.0
======================================================================   
####开发者：	NumberWolf
####邮箱：		porschegt23@foxmail.com
####时间：		2016/02/05
####中文文档：	http://123.56.154.87/RollerDoc/introduce.html
———————————-———————————-———————————-————————
      
 <p>* Copyright [2016] [Chang Yanlong]</p>

 <p>* Licensed under the Apache License, Version 2.0 (the "License");</p>
 <p>* you may not use this file except in compliance with the License.</p>
 <p>* You may obtain a copy of the License at</p>

 <p>   http://www.apache.org/licenses/LICENSE-2.0</p>

 <p>* Unless required by applicable law or agreed to in writing, software</p>
 <p>* distributed under the License is distributed on an "AS IS" BASIS,</p>
 <p>* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.</p>
 <p>* See the License for the specific language governing permissions and</p>
 <p>* limitations under the License.</p>


####框架结构:  

[RollerPHP]   
|     
|----------[Configs]                         // 配置        
|     
|----------[Controller]                      // 控制器文件     
|     
|----------[Models]				  	 		 // 数据模型   
|          
|----------[Storage]						 // 存储       
|     
|----------[System]              			 // 核心/路由       
|     
|----------[Templates] 						 // 模板    
|    
|----------[Views]							 // 视图     
|     
|----------index.php 						 // 入口文件     


####目前系统数据库封装库仅支持PDO连接，非PDO配置之后会更新    
####支持memcache，请预先在服务器安装memcache     

访问：http://HOST/RollerPHP_framework/        
或者带参数index.php?Home=Index&Cont=index&Meth=start
