---
layout: post
title:  "MarkDown使用LaTeX指南"
categories: MarkDown
tags: LaTeX MarkDown
excerpt: 在MarkDown文件中插入LaTeX公式。
---

### 测试时间和环境
**2016/11/30-Ubuntu 14.04-Atom**
### 插入LaTeX公式的方法
#### 使用Google Chart的服务器
{% highlight html %}
<img src="http://chart.googleapis.com/chart?cht=tx&chl=在此插入Latex公式" style="border:none;">
{% endhighlight %}
举一个例子：
{% highlight html %}
<img src="http://chart.googleapis.com/chart?cht=tx&chl=\Large x=\frac{-b\pm\sqrt{b^2-4ac}}{2a}" style="border:none;">
{% endhighlight %}
实际效果：
<img src="http://chart.googleapis.com/chart?cht=tx&chl=\Large x=\frac{-b\pm\sqrt{b^2-4ac}}{2a}" style="border:none;">

#### 使用forkosh服务器
{% highlight html %}
<img src="http://www.forkosh.com/mathtex.cgi?在此处插入Latex公式">
{% endhighlight %}
举一个例子：
{% highlight html %}
<img src="http://latex.codecogs.com/png.latex?\Large x=\frac{-b\pm\sqrt{b^2-4ac}}{2a}">
{% endhighlight %}
实际效果：
<img src="http://latex.codecogs.com/png.latex?\Large x=\frac{-b\pm\sqrt{b^2-4ac}}{2a}">

#### Google的Latex服务调用接口
{% highlight html %}
<img src="http://latex.codecogs.com/png.latex?LaTex公式代码" >
{% endhighlight %}
举一个例子：
{% highlight html %}
<img src="http://latex.codecogs.com/png.latex?\Large x=\frac{-b\pm\sqrt{b^2-4ac}}{2a}">
{% endhighlight %}
实际效果：
<img src="http://latex.codecogs.com/png.latex?\Large x=\frac{-b\pm\sqrt{b^2-4ac}}{2a}">

#### 使用MathJax引擎
1. 在Markdown中添加MathJax引擎
{% highlight html %}
<script type="text/javascript" src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=default"></script>
{% endhighlight %}
2. 输入公式
```latex
$$x=\frac{-b\pm\sqrt{b^2-4ac}}{2a}$$
```
实际效果：
$$x=\frac{-b\pm\sqrt{b^2-4ac}}{2a}$$

如果是在文本中插入公式，则用`$...$`；如果公式自成段落，则使用`$$...$$`。

### 参考文献
1. [在Markdown中使用数学公式](http://www.kuqin.com/shuoit/20150610/346533.html)
2. [MathJax基本的使用方式](http://blog.csdn.net/u010945683/article/details/46757757)
3. [Markdown中插入数学公式的方法](http://blog.csdn.net/xiahouzuoxin/article/details/26478179)
4. [MathJax官网](https://www.mathjax.org/)
5. [怎样在 Markdown 中使用数学公式](http://www.ituring.com.cn/article/32403)
