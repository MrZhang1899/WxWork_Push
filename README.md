## WxWork_Push是什么

利用企业微信的Api，实现推送消息到微信上

是一款类似于server酱Turbo版的一款「程序员」和「服务器」之间的通信软件

注：不需要使用到企业微信，只需要获取 `cropid` `secret` `agentid`三个值即可

## WxWork_Push使用方式

### 使用方式

在`index.php`文件中填入 `cropid` `secret` `agentid`三个值，用GET参数请求

访问方式1（消息推送）：http://你的域名/?msg=推送测试  
访问方式2（实时天气推送）：http://你的域名/?type=weather&loc=guangzhou


### 参数说明

| 参数 | 必须 | 说明 |
| ------------ | ------------ | ------------ |
| cropid（已填写在文件中） | 是 | 企业ID |
| secret（已填写在文件中） | 是 | 应用的凭证密钥 |
| agentid（已填写在文件中） | 是 | 应用ID |
| msg (二选一) | 是 | 推送内容，最长不超过2048个字节，否则截断 |
| type=weather&loc=(二选一) | 是 | 推送天气，loc后接地区参数 |

注：`loc`默认 广州天河，可在 `weather.php` 中修改，参数可在 [https://www.tianqi.com/](https://www.tianqi.com/chinacity.html) 中查看


### 返回实例
<pre>
{
   "errcode" : 0,
   "errmsg" : "ok",
}
</pre>

注：`errcode`代码请查看企业微信官方文档详细解析 >[点击查看](https://work.weixin.qq.com/api/doc/90000/90139/90313)

### 消息推送样式  
![消息推送样式1](https://i.loli.net/2021/02/22/Qf6UE9R7uJshSZA.png)  
![消息推送样式2](https://i.loli.net/2021/02/22/yPBONoSTzbcHxUl.png)  

## 参数获取
如果没有创建企业，请自行注册企业，可以不用验证

`corpid获取`

点击 [此处](https://work.weixin.qq.com/wework_admin/frame#profile) 登陆企业微信，点击我的企业，最下面就是企业ID

![企业ID.png](https://i.loli.net/2021/02/22/kmAyYGjxZe2C5pM.png)

`secret` 和 `agentid` 获取

点击应用管理，点击创建应用，自行填写资料，创建好后即可看到

![secret和agentid获取1](https://i.loli.net/2021/02/22/ZRutYNels41IFDU.png)
![secret和agentid获取2](https://i.loli.net/2021/02/22/arqSobE7kxNDwYX.png)
