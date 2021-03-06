---
layout: post
title:  Python学习手册 笔记（第九章）
categories: Python
tags: Python学习手册
excerpt: python中的元组和文件。
---

## 第9章 元组、文件及其他

### 元组

* 元组诗一个位置有序的对象的集合，可以嵌入到任何类型的对象中
* 不支持在原处修改
* 元组是不可变的，在不生成一个拷贝的情况下不能增长或缩短

### 实际应用中的元组

* 在赋值语句中，即使没有圆括号，python也能够识别出这是一个元组，但一般不建议使用

### 为什么有了列表还要元组

* python的创始人把元组看作简单的对象组合，把列表看作随时间改变的数据结构
* 元组的不可变性提供了某种完整性

### 文件

{% highlight python %}
fileOut = open(r'C:\spam', 'w') # w是写入
fileIn = open('data', 'r') # r是读
fileIn = open('data') # r是默认
aString = fileIn.read() # 将文件读进单一字符串
aString = fileIn.read(N) # 读取文件后N个字节
aString = fileIn.readline() # 读取一行
aList = fileIn.readlines() # 将文件读取到一个列表，每行一个字符串
fileOut.write(aString) # 将字符串写到文件
fileOut.writelines(aList) # 将字符串列表写进文件
fileOut.close()
fileOut.flush() # 把输出缓冲区刷到硬盘中，但不关闭文件
{% endhighlight %}

### 打开文件

* 'r'代表为输入打开文件，'w'代表为输出打开文件，'a'代表在文件尾部追加内容而打开文件
* 加上'+'意味着同时为输入和输出打开文件
* 第三个是可选参数，控制输出缓存

### 使用文件

* 当文件对象呗收回时，python会自动关闭该文件。但是，还是建议手动关闭。
* 默认情况下，输出文件总是缓冲的，意味着写入的文件不能立即自动从内存中转换到硬盘。使用flush方法，迫使缓存的数据进入硬盘。

### 用pickle储存python的原生对象

* pickle模块能够在文件中储存几乎任何python对象的高级工具，并不要求我们把字符串转换来转换去

{% highlight python %}
D = {'a': 1, 'b': 2}
F = open('datafile.pkl', 'wb')
import pickle
pickle.dump(D, F)
F.close()
{% endhighlight %}

{% highlight python %}
import pickle
F = open('datafile.pkl', 'rb')
E = pickle.load(F)
{% endhighlight %}

### 文件上下文管理器

* with...as...可以将文件处理代码包装到一个逻辑层，以确保退出后可以自动关闭文件，而不是依赖于垃圾收集上的自动关闭
* try...finally...语句可以提供类似的功能，但是需要一些额外的代码成本

### 重访类型分类

* 对象根据分类来共享操作；如，字符串、列表和元组共享合并、长度和索引等序列操作
* 只有可变对象（列表、字典和集合）可以在原处修改；不能原处修改数字、字符串或元组
* 集合类似一个无值的字典的键，但不能映射为值，并且没有顺序

### 对象灵活性

* 列表、字典和元组可以包含任何类型的对象
* 列表、字典和元组可以任意嵌套
* 列表和字典可以动态扩大、缩小

### 引用 VS 拷贝

* 在原处修改可变对象时可能会影响程序中其他地方对相同对象的其他引用
* 引用时其他语言中指针的更高级模拟
* 如果需要一个深层嵌套的数据结构的完整的、独立的拷贝，使用标准的copy模块，`X = copy.deepcopy(Y)`。

### 比较、想等性和真值

* 在嵌套对象存在时，python可以自动遍历数据结构，从左到右递归应用比较，有多深走多深
* “==”操作符测试值的相等性，递归地比较所有内嵌对象
* “is”表达式测试对象的一致性，测试是否在同一个内存地址
* 数字通过相对大小比较；字符串按照字典顺序比较，一个字符一个字符比较；列表和元组从左到右对每部分的内容比较；字典的相对大小在python3中不支持；数字混合类型比较在python3中不支持

### python中真和假的含义

* python中吧任意的空数据结构视为假，把任何非空数据结构视为真
* 数字如果非0，为真；其他对象如果非空，为真
* None总被认为是假。None起到一个空的占位作用，与C语言中的NULL指针类似

### bool类型

* python还提供了一个内置函数bool，测试一个对象的布尔值

### type对象

* `type(X)`可以返回对象X的类型对象
* dict、list、str、tuple、int、float、complex、byte、type、set、file
* python的类型还可以分为子类，一般建议使用isinstance技术

### 重复能够增加层次深度

{% highlight python %}
L = [3, 4, 5]
X = L * 4
Y = [L] * 4
X # [3, 4, 5, 3, 4, 5, 3, 4, 5, 3, 4, 5]
Y # [[3, 4, 5], [3, 4, 5], [3, 4, 5], [3, 4, 5]]
{% endhighlight %}

### 留意循环数据结构

* 一个复合对象包含指向自身的引用，称为循环对象。python在对象中检测到循环，会打印成`[...]`，而不会陷入无限循环

{% highlight python %}
L = ['grail']
L.append(L)
L # ['grail', [...]]
{% endhighlight %}
