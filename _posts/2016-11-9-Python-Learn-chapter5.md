---
layout: post
title:  "Python学习手册 笔记（第五章）"
categories: Python
tags: Python学习手册
excerpt: 多进制数、小数、分数和集合。
---

## 第5章 数字
### 数字常量
* 八进制：0o177；十六进制：0x9ff；二进制：0b0101010
* 复数常量：3+4j
* 浮点数：和c语言中的双精度一样实现
* 内置函数hex(I)、oct(I)和bin(I)把一个整数准啊还为这三种进制表示的字符串，int(str, base)把给定的进制的字符串转化为整数
* complex(real, imag)创建复数
### 内置数字工具和扩展
* 表达式操作符：+、-、\*、／、>>、\**、&
* 内置数学函数：pow、abs、round、int、hex、bin
* 公用模块：random、math
### python表达式操作符

|操作符|描述|
|-----|---|
|yield x|生成器函数发送协议|
|lambda args: expression|生成匿名函数|
|x if y else z|三元选择表达式|
|x or y|逻辑或（只有x假才会计算y）|
|x and y|逻辑与（只有x真才会计算y）|
|x in y, x not in y|成员关系（可迭代对象、集合）|
|x is y, x is not y|对象实体测试|
|x < y, x <= y, x > y, x >= y, x == y, x != y|大小比较，集合比较|
|x 竖 y|位或，集合并集|
|x ^ y|位异或，集合对称差|
|x & y|位与，集合交集|
|x << y, x >> y|左移或右移y位|
|x + y, x - y|加法/合并，减法/差集|
|x * y, x % y, x / y, x // y|乘法/重复，余数/格式化，除法：真除法或floor除法|
|-x, +x|一元减法，识别|
|~x|按位取补|
|x ** y|幂运算|
|x[i]|索引|
|x[i:j:k]|分片|
|x(...)|调用|
|x.attr|属性引用|
|(...)|元组|
|[...]|列表|
|{...}|字典、集合|
* floor除法表达式(X // Y)总会向下取整
* X < Y < Z等于X < Y and Y < Z
### 混合类型自动升级
* 在混合类型的表达式，python将被操作的对象转换为其中最复杂的操作对象的类型。整数比浮点数简单，浮点数比复数简单。
* 手动调用内置函数来强制转换类型
### 变量和基本的表达式
* python中，变量不需要预声明，但是使用前，至少赋一次值
### 数字显示的格式
```python3
'%e' % num # '3.333333e-001'
'%4.2f' % num # '0.33'
'{0:4.2f}'.format(num) # '0.33'
```
### 比较：一般的和连续的
* str和repr显示格式：repr(默认的交互模式回显)产生的结果好像他们是代码；str转变为一种对用户更加友好的格式；str用于一般用途，repr用于额外细节；str也是字符串数据类型的名字
* python允许多个比较连续执行，这样运行速度略快
```python3
X < Y > Z # 等于X < Y and Y > Z
1 == 2 < 3 # 等于1 == 2 and 2 < 3
```
### 除法：传统除法、Floor除法和真除法
* /真除法：不管操作数的类型，返回包含任何余数的一个浮点结果
* //Floor除法：向下取整，如果操作数包含浮点数，返回浮点数
### Floor除法VS截断除法
* 向下取整
```python3
import math
math.floor(2.5) # 2
math.floor(-2.5) # -3
math.trunc(2.5) # 2
math.trunc(-2.5) # -2
```
### 十六进制、八进制和二进制
* 把整数转换为其他进制的字符串
```python3
oct(64), hex(64), bin(64) # ('0o100', '0x40', '0b1000000')
```
* 将一个数字的字符串变换为一个整数，第二个参数确定进制
```python3
int('64'), int('100', 8), int('40', 16), int('1000000', 2) # (64, 64, 64, 64)
```
* eval函数，会把字符串作为python代码，但会运行的慢
```python3
eval('64'), eval('0o100'), eval('0x40'), eval('0b1000000')
```
### 其他的内置数学工具
* random模块，可以提供0-1间的任意浮点数，选择2个数字间的任意整数，在一个序列中任意挑选一项
```python3
import random
random.random() # 0-1任意浮点数
random.randint(1, 10) # 1-10间任意整数
random.choice(['Life of Brian', 'Holy Grail', 'Meaning of Life'])
```
### 小数对象
* 浮点数缺乏精确性
```python3
0.1 + 0.1 + 0.1 - 0.3 # 5.551115123125783e-17
```
* 小数对象：通过导入的模块调用函数后创建，有固定的位数和小数点，因此有固定的精度
```python3
from decimal import decimal
Decimal('0.1') + Decimal('0.1') + Decimal('0.1') - Decimal('0.3') # Decimal('0.0')
```
注释：python会自动升级为小数位数最多的
### 设置全局精度
* decimal模块可以设置所有小数数值的精度、设置错误处理
```python3
import decimal
decimal.getcontext().prec = 4
decimal.Decimal(1) / decimal.Decimal(7) # Decimal('0.1429')
```
### 小数上下文管理器
* 可以使用上下文管理器，设置临时精度。语句退出后精度重新设置为初始值
```python3
with decimal.localcontext() as ctx:
	ctx.prec = 2
    decimal.Decimal('1.00') / decimal.Decimal('3.00') # Decimal('0,33')
```
### 分数类型
* 分数，避免了浮点数的不精确和局限性
```python3
from fractions import Fraction
x = Fraction(1, 3)
y = Fraction(4, 6)
x # Fraction(1, 3)
y # Fraction(2, 3)
print(y) # 2/3
Fraction('.25') # Fraction(1, 4)
x + y # Fraction(1, 1)
Fraction('.25') + Fraction('1.25') # Fraction(3, 2)
Fraction.from_float(1.75)
```
### 集合
* 集合是无序的、唯一的、不可改变的，建立时会排序
```python3
set([1, 2, 3, 4]) # {1, 2, 3, 4}
set('spam') # {'a', 'p', 's', 'm'}
```
```python3
s1 = {1, 2, 3, 4}
s1 & {1, 3} # {1, 3}
s1 | {1, 5, 3, 6} # {1, 2, 3, 4, 5, 6}
s1 - {1, 3, 4} # {2}
s1 > {1, 3} # True
```
```python3
{1, 2, 3}.union([3, 4]) # {1, 2, 3, 4}
{1, 2, 3}.union({3, 4}) # {1, 2, 3, 4}
{1, 2, 3}.intersection((1, 3, 5)) # {1, 3}
{1, 2, 3}.issubset(range(-5, 5)) # True
```
### 不可变限制和冻结集合
* 列表和字典不能嵌入集合，元组可以嵌入
```python3
s = {1.23}
s.add([1, 2, 3]) # TypeError: unhashable type: 'list'
s.add({'a':1}) # TypeError: unhashable type: 'dict'
s.add((1, 2, 3))
s # {1.23, (1, 2, 3)}
```
### 为什么使用集合
* 集合可以把重复项从其他集合中过滤掉
### 数字扩展
* Numpy高级数学编程工具：矩阵、向量等计算
* SciPy
