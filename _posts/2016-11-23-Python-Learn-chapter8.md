---
layout: post
title:  Python学习手册 笔记（第八章）
categories: Python
tags: Python学习手册
excerpt: python中的列表和字典。
---

## 第8章 列表与字典

* python的列表中读取一个项的速度与索引一个c语言数组差不多。实际上，标准python解释器内部，列表就是数组而不是链接结构。

### 原处修改列表

* `L[1:2]=[4,5]`实际上，python会先删除位置1的数据，然后在删除的地方插入[4,5]。所以，`L[1:2]=[]`实际是删除操作。
* 列表pop方法和append方法联用，实现快速的后进先出（last-in-first-out）堆栈结构
* del语句在原处删除某项或某片段

### 字典

* 字典中的元素是通过键来存取的，而不是通过偏移存取
* 字典能执行其他语言中的纪录、符号表的功能，表示稀疏数据结构
* 字典有时叫做关联数组或者散列表
* 与列表不同，保存在字典中的项无特定的顺序
* 字典可以在原处增长或缩短（无需生成一份拷贝），支持深度的嵌套
* 通过给索引赋值，字典可以在原处修改，但不支持用于字符串和列表中的序列操作
* 字典是作为散列表（支持快速检索的数据结构）来实现的

{% highlight python %}
D = dict.fromkeys(keyslist, values) # 生成键，内容都为values
D = ditc(zip(keyslist, valueslist))
'a' in D # 键是否在字典中
D.keys() # 返回可迭代的视图
D.values() # 返回可迭代的视图
D.items() # 返回可迭代的视图
D.copy()
D.get(key, default)
{% endhighlight %}

{% highlight python %}
D.update(OtherD) # 将OtherD合并入D
D.pop(key)
len(D)
D[key] = 42
del D[key]
{% endhighlight %}

### 字典的基本操作

* 字典内键由左至右的次序几乎总是和原先输入的顺序不同，目的是快速执行键查找
* in成员关系符提供了键存在与否的测试方法。keys方法可以返回所有的键，但不应依赖keys列表的次序
* 用于字符串和列表的in成员关系测试适用于字典，因为字典定义了单步遍历keys列表的迭代器

### 字典用法注意事项

* 序列运算无效
* 对新索引赋值会添加项
* 键不一定总是字符串

### 字典视图

* 字典视图并非创建后不能改变——它可以动态反映在视图对象创建之后对字典的修改

{% highlight python %}
D = {'a':1, 'b':2, 'c':3}
K = D.keys()
V = D.values()
list(D) # ['b', 'c', 'a']
list(V) # [2, 3, 1]
del D['b']
D # {'c': 3, 'a': 1}
list(K) # ['c', 'a']
list(V) # [3, 1]
{% endhighlight %}

* 字典视图对象类似集合，可以支持交集、并集等集合操作
