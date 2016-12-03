---
layout: post
title:  "Python学习手册 笔记（第三章）"
categories: Python
tags: Python学习手册
excerpt: python是一门脚本语言，文件被称为模块，模块是变量名的封装，被认为是命名空间。
---

# 第一部分
## 第3章
### 交互提示模式下编写代码：
* 如果没有设置系统中的shell的PATH环境变量，使其包含python的安装目录，需要将python改为机器上python的完整路径

### 系统命令行和文件：
* 模块是一个包含了python语句的简单文本文件
* 可直接运行的模块文件往往也叫脚本（一个顶层程序文件的非正式说法）

### 使用命令行运行文件：
* 流重定向：
```shell
$ python script.py > saveit.txt
```

### UNIX可执行脚本(#!)：
* 脚本的第一行以字符#！开始，后面紧跟python解释器的路径。
* 脚本文件往往告诉操作系统可以作为顶层程序执行，在UNIX上往往使用```chmod +x file.py```
* Example:
```python
#!/usr/local/bin/python
print('The Bright Side ' + 'of Life...')
```
注释：从技术上来说，第一行是python注释。这种情况下，操作系统使用它找到解释器来运行文件其他部分的程序代码

### UNIX env查找技巧：
* 一些UNIX系统可以避免硬编码python解释器的路径
```python
#!/usr/bin/env python
print('The Bright Side ' + 'of Life...')
```
注释：env程序可以通过系统的搜索路径的设置定位python解释器

### input的技巧：
* 可选的接受字符串，这些字符串作为提示打印出来
```python
input('Press Enter to exit')
```
* 以字符串的形式为脚本返回读入的文本
```python
nextinput = input()
```
* 在shell支持输入流的重定向
```shell
$ python spam.py < imput.txt
```

## 模块导入和重载
* 一个模块文件设计成主文件，或者叫顶层文件
* 第一次导入后，其他的导入不会再工作，甚至改变了源代码也不行
* 如果想要再次运行文件，需要调用imp标准库中的reload函数
```python
from imp import reload
reload(script1)
```
注释：reload函数希望获得的参数是一个已经加载了的模块对象的名称，在重载前，请确保成功导入了这个模块。最后一行输出是reload调用的返回值的打印显示

## 模块的显要特性：属性
* 模块扮演了一个工具库的角色
* 模块往往是变量名的封装，被认为是命名空间。一个包中的变量名就是属性
* 导入者得到了模块文件中在顶层所定义的所有变量名
* Example:
```python
import myfile # myfile: title = 'The Meaning of Life'
print(myfile.title)
```
注释：这里表达式代表了object.attribute的语法，可以从任何的object中取出任意的属性
* from和import相似，只不过增加了对载入组件的额外的复制。从技术上讲，from直接复制了模块的属性，以便属性称为接受者的直接变量
* Example:
treenames.py文件：
```python
a = 'dead'
b = 'parrot'
c = 'sketch'
print(a, b, c)
```
```python
import threenames # dead parrot sketch
threenames.b, threenames.c # ('parrot', 'sketch')
from threenames import a, b, c
b, c # ('parrot', 'sketch')
```
注释：内置的dir函数可以获得模块内部的变量名列表，带下划线的是python预定义的内置变量名

## 模块和命名空间
* 每个模块文件是一个独立完备的变量包，即一个命名空间
* 拼写相同的情况下，一个文件的变量名是不会与另一个文件的变量冲突的
* from把变量从一个文件复制到另一个文件，者可能导致导入的文件中相同名称的变量被覆盖

## import和reload的使用注意事项
* reload函数是不可传递的，重载一个模块的话只会重载该模块，不会重载该模块所导入的任何模块
## 使用exec运行模块文件
* `exec(open('module.py').read())`内置函数的调用，每次都运行运行文件的最新版本。与from一样，对当前的变量有潜在的默认覆盖的可能
