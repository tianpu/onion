# 优势
1. 模板直观，就是最终的html加上必要的标记
2. 语法简单，只支持unit(块元素), list(列表), this(静态变量)三种语法
3. 洋葱一样的嵌套结构，支持任意多层嵌套(由于实现简单，当前unit下级关键字需要唯一)

# 使用
```
$tmpl = 'sample'; //模板名称，示例为sample.html
$data = array(); //演示数据，示例数据在sample.php
$html = html_render($tmpl,$data);
/*
缓存为md5($tmpl)，首次运行自动生成缓存文件
默认不自动销毁缓存文件或者监控模板文件更改，需要手工删除tmp目录下缓存文件
*/
```

# 版权
MIT
