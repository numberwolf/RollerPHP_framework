<img src="Storage/RollerPHP_small.png" />     
* 2017/01/02,路由器改为PHP扩展C实现，PHP扩展路由地址：https://github.com/numberwolf/RollerPHP_Router_Extension, 目前仅支持Ubuntu 14.04上实现，PHP5.5伤的, 示例url：http://numberwolf.top/RollerPHP_CR_framework/?r=/hm/Index/ct/index/mt/start，目前请勿参考旧文档，旧文档因为过年还未来得及更新.
* 2016/08/15,在html文件中相对链接前加{{URL_HEAD}}，定义全局URL_HEAD为项目前缀链接
* 2016/08/12,更新路由器：http://yourhost/projectname/index.php/Home/Controller/Method
* 2016/07/17,更新路由器，更新memcache缓存bug
* 2016/05/03,修正db.class.php兼容事务,之前的db封装类库的PDO连接为私有，所以不兼容，更新之后兼容事务,修正文件上传封装拓展,修正上传文件
* 2016/05/01,更新URL标准路径 在./Views/upload.html中，更新推荐URL为?Home=Index&Cont=index&Meth=uploadFile&class=temp，改变了以往的__Parameter__格式
* 2016/04/04,更新非PDO连接数据库类库的更新
* 2016/03/30,更新视图层路由路径                 
* 2016/03/20,控制器加入命名空间(具体反馈请看文档http://123.56.154.87/RollerDoc/introduce.html),控制器命名:空间规则, <font color="blue">namespace Controller\Home名称</font> 
	  
#### 翻滚吧 PHP!      
###RollerPHP V1.2
======================================================================   
####开发者：	NumberWolf
####邮箱：		porschegt23@foxmail.com
####时间：		2016/02/05
####中文文档：	http://numberwolf.top/RollerDoc/introduce.html
———————————-———————————-———————————-————————
      
 <p>* Copyright [2017] [Chang Yanlong]</p>

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
|----------[System]              			 // 系统文件
|     
|----------[Templates] 						 // 模板    
|    
|----------[Views]							 // 视图     
|     
|----------index.php 						 // 入口文件     


####目前系统数据库封装库不仅可以支持PDO连接，非PDO配置也已经更新，文档之后会跟上,谢谢！    
####支持memcache，请预先在服务器安装memcache     

访问：http://HOST/RollerPHP_framework/        
或者带参数index.php?Home=Index&Cont=index&Meth=start
