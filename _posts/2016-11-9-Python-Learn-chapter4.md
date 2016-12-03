---
layout: post
title:  "Python学习手册 笔记（第四章）"
categories: Python
tags: Python学习手册
excerpt: python程序可以分解成模块、语句、表达式以及对象。
---

# 第二部分
## 第4章 介绍python对象类型
* python程序可以分解成模块、语句、表达式以及对象：程序由模块组成；模块包含语句；语句包含表达式；表达式建立并处理对象
### python的核心数据类型

|对象类型|例子|
|----|--|
|数字|1234，3.1415，3+4j|
|字符串|'spam', "guido's"|
|列表|[1, [2, 'three'], 4]|
|字典|{'food': 'spam', 'taste': 'yum'}|
|元组|(1, 'spam', 4, 'U')|
|文件|myfile = open('eggs', 'r')|
|集合|set('abc'), {'a', 'b', 'c'}|
|其他类型|类型、None、bool|
|编程单元类型|函数、模块、类|
* python中没有类型声明，运行的表达式的语法据定了创建和使用的对象的类型
* python是动态类型的，也是强类型语言
### 数字
* 类型：整数、浮点数、有虚部的复数、固定精度的十进制、带分子和分母的有理数、集合
* 数学运输：加分(+)、乘法(\*)、乘方(\*\*)，当需要时，python3的整数类型会自动提供额外的精度
* Example：
```python3
import math
math.pi
math.sqrt(86)
```
```python3
import random
random.random()
random.choice([1, 2, 3, 4])
```
### 序列的操作
* 字符串支持位置顺序的操作
* 字符串支持分片(slice)的操作，左边界默认为0，右边界默认为分片序列的长度
* 字符串支持加分合并(多态)，重复
* Example:
```python3
S = 'spam'
len(s) # 4
S[0] # 's'
S[1] # 'p'
S[-1] # 'm'
```
```python3
S = 'spam'
S[1:3] # 'pa'
```
### 不可变性
* 数组、字符串和元组是不可变的；列表和字典可以自由改变
### 类型特定的方法
* find方法：字符串查找（返回传入字符串的偏移量，没有返回-1）；replace方法：对全局进行搜索和替换
* split方法：分割字符串；upper方法：大小写变换；isalpha方法：测试字符串的内容；strip方法：去掉头尾的空格；rstrip方法：去掉字符串后面的空格
* 字符串方法调用：
`'%s, eggs, and %s' % ('spam', 'SPAM') # 'spam, eggs, and SPAM!'`或`'{0}, eggs, and {1}'.format('spam', 'SPAM!') # 'spam, eggs, and SPAM!'`
* Example：
```python3
S = 'Spam'
S.find('pa') # 1
S.replace('pa', 'XYZ') # 'SXYZm'
S # 'Spam'
```
### 编写字符串的其他方法
* python运行3个引号包含多行字符串常量
### 模式匹配（暂时不懂）
### 序列操作
* 列表支持加法
### 类型特定的操作
* append方法：增加列表元素；pop方法：移除指定偏移量的一项；sort方法：对列表进行排序；reverse方法：翻转列表
### 边界检查
* python不允许引用不存在的元素
### 嵌套
* python核心数据的一个优秀特性是支持任意的嵌套
### 列表解析
* 列表解析式：`[row[1] + 1 for row in M]`或`[row[1] for row in M if row[1] % 2 == 0]`，后面一个使用if表达式，通过%求余表达式过滤结果重的奇数
* 解析语法也可以创建集合和字典：`{sum(row) for row in M}`和`{i: sum(M[i]) for i in range(3)}`
### 重访嵌套
* python对象嵌套：
```python3
rec = {'name': {'first': 'Bob', 'last': 'Smith'}, 'job': ['dev', 'mgr'], 'age': 40.5}
```
python具有一种垃圾收集的特性，一旦最后一次被移除，空间会立即回收
### 键的排序：for循环
* while循环：
```python3
x = 4
while x > 0:
	print('spam!' * x)
	x -= 1
```
### 迭代和优化
* 迭代协议
* map和filter通常运行的比for循环快，这是对大数据集合的程序有程序有重大影响的特性
* python熟悉为了简单和可读性去编写代码，在证明了确实有必要考虑性能后，在考虑性能问题
### 元组
* 基本上是一个不可以改变的列表
* index方法：返回参数在元组中的位置；count方法：返回参数在元组中的数量
* 元组中吃混合的类型和嵌套，但不能增长和缩短，因为他们是不可变的
### 其他文件类工具
* 管道、先进先出队列（FIFO）、套接字、键访问文件、对象持久、基于描述符的文件、关系数据库和面向对象数据库接口
### 如何破环代码的灵活性
* 检查对象类型，至少3种方法：
```python3
L = [1, 2, 3]
if type(L) == type([]):
	print('yes') # yes
if type(L) == list:
	print('yes') # yes
if isinstance(L, list):
	print('yes') # yes
```
