---
layout: post
title:  "Python学习手册 笔记（第七章）"
categories: Python
tags: Python学习手册
excerpt: python字符串的三种表示方法。
---

## 第7章 字符串
* python和c语言不一样，没有单个字符的类型，取而代之的是字符串
### 字符串常量
* 单引号、双引号、三引号、转义字符、raw字符串、byte字符串、unicode字符串
### 用转义序列代表特殊字节
* 原始的反斜杠字符并不真正的和字符串一起储存在内存中；它们告诉python字符串中保存的特殊字节值
* '\b':倒退、'\xhh':十六进制值、'\ooo':八进制
* python中，零字符串不会像c语言那样去结束一个字符串，python没有字符会结束一个字符串
* python中没有作为一个合法的转义编码识别在'\'后的字符，会在最终的字符串中保留反斜杠。如果希望脚本中编写明确的常量反斜杠，重复两个反斜杠或使用raw字符串
```python3
x = '\chai\jin\long'
x # '\\chai\\jin\\long'
```
### raw字符串抑制转义
* 如果字母r（大写或小写）出现在字符串的第一引号前，它会关闭转义机制
* 实际上，打印一个嵌入了反斜杠字符串时，python自身会使用两个反斜杠的方法
* 除了在windows下的文件夹路径，raw字符串也常在正则表达式中常见
### 三重引号编写多行字符串块
* 三重引号开始，紧跟任意行数的文本，结束以同样的三重引号结尾
```python3
mantra = '''Always look
 on the bright
 side of life.'''
mantra # 'Always look\n on the bright\n side of life.
```
* 常用于嵌入多行错误信息或在源文件中编写HTML或XML代码
### 基本操作
* python不允许在+表达式中混合数字和字符串(TypeError)
* for语句在一个字符串中循环迭代；in表达式操作符对字符和子字符串进行成员关系的测试
### 索引和分片
* python支持在字符串汇总使用负偏移来从序列中获取元素，可以看作从结束处反向计数
* python获取从下边界直到但不包括上边界的所有元素，并返回一个包含所获取的元素的新的对象。如果被省略，上、下边界的默认值对应为0和分片的对象的长度。
* s[:-1]获取了除最后一个元素外的所有元素——下边界为0，上边界为-1对应的最后一项，但不包含在内
* 扩展分片：第三个索引，步进。分片表达式'hello'[::-1]返回一个新的字符串'olleh'，步进-1表示分片将会从右至左进行而不是通常的从左至右
```python3
'spam'[1:3] # 'pa'
'spam'[slice(1, 3)] # 'pa'
'spam'[::-1] # 'maps'
'spam'[slice(None, None, -1)] # 'maps'
```
* 分片常常用作清理输入文件的内容。
### 字符串转换工具
```python3
int("42"), str(42), float('1.5') # (42, '42', 1.5)
repr(42) # '42'
```
* repr函数将一个对象转换为字符串形式
* 字符串代码转换：ord函数将字符转换为ASCII码；chr执行相反的操作
```python3
ord('s') # 115
chr(115) # 's'
```
### 修改字符串
* python在运行中对不再使用的字符串对象自动进行垃圾收集
* bytearray字符串可以修改，但bytearray对象不是真正的字符串，是8位整数的序列
### 字符串方法
* 方法调用同时进行两次操作：属性读取：具有object.attribute格式的表达式可以理解为“读取object对象的属性attribute的值”；函数调用表达式：具有函数格式的表达式意味“调用函数代码，传递参数对象，返回函数返回值”。
### 字符串方法实例：修改字符串
* replace方法的参数是原始字符串和替换原始子字符串的字符串，之后进行全局搜索并替换
* find方法返回在子字符串出现处的偏移或未找到返回-1
```python3
s = 'xxxxSPAMxxxxSPAMxxxx'
s.replace('SPAM', 'EGGS') # 'xxxxEGGSxxxxEGGSxxxx'
s.replace('SPAM', 'EGGS', 1) # 'xxxxEGGSxxxxSPAMxxxx'
s.find('SPAM') # 4
s.find('spam') # -1
```
* 内置的list函数以任意序列中的元素创建一个新的列表，join函数会将列表“合并”成一个字符串。join将列表字符串串连在一起，并用分隔符隔开，并且更快
```python3
s = 'spammy'
l = list(s)
l # ['s', 'p', 'a', 'm', 'm', 'y']
a = ''.join(l)
a # 'spammy'
'spam'.join(['eggs', 'sausage', 'ham', 'toast']) # 'eggsspamsausagespamhamspamtoast'
```
### 字符串方法实例：文本解析
* split方法，默认分隔符为空格
### 实际应用中的其他常见字符串方法
```python3
line = 'The knights who say Ni!\n'
line.rstrip() # 'The knights who say Ni!'
line.upper() # 'THE KNIGHTS WHO SAY NI!\n'
line.isalpha() # False
line.endswith('Ni\n') # True
line.startswith('The') # True
```
* help(s.method)来获得关于任何字符串对象s的方法的提示
### 字符串格式化表达式
* 在%操作符的左侧放置一个需要进行格式化的字符串，字符串带有一个或多个嵌入的转换目标，都以%开头
* 在%操作符的右侧放置对象，这些对象会插入到左侧想让python进行格式化字符串的转换目标的位置上去
```python3
"%s -- %s -- %s" % (42, 3.14159, [1, 2, 3]) # '42 -- 3.14159 -- [1, 2, 3]'
```
* 对象的每个类型都可以转换为字符串
### 更高级的字符串格式化表达式
* r：使用repr；i：整数；X：x，但打印大写；E：e，但打印大写
* %[(name)][flags][width][.precision]typecode，放置一个字典的键、罗列出左对齐(-)、正负号(+)、和补0的标志位、给出数字的整体长度、小数点后位数。width和precision都可以编码为一个\*，以指定它们从输入的下一项取值
```python3
x = 1234
res = 'integers: ...%d...%-6d...%06d' % (x, x, x)
res # 'integers: ...1234...1234  ...001234'
```
```python3
x = 1.23456789
x # 1.23456789
'%e | %f | %g' % (x, x, x) # '1.234568e+00 | 1.234568 | 1.23457'
'%E' % x # '1.234568E+00'
```
```python3
'%-6.2f | %05.2f | %+06.1f' % (x, x, x) # '1.23   | 01.23 | +001.2'
'%s' % x, str(x) # ('1.23456789', '1.23456789')
```
```python3
'%f, %.2f, %.*f' % (1/3.0, 1/3.0, 4, 1/3.0) # '0.333333, 0.33, 0.3333'
```
### 基于字典的字符串格式化
```python3
'%(n)d %(x)s' % {'n':1, 'x':'spam'} # '1 spam'
```
* 格式化字符串中(n)和(x)引用右边字典里的键，并提取相应的值
```python3
reply = '''
Greetings...
Hello %(name)s!
Your age squared is %(age)s
'''
value = {'name': 'Bob', 'age': 40}
print(reply % value) # \nGreetings...\nHello Bob!\nYour age squared is 40\n
```
* 和内置函数vars配合使用，可以返回包含本函数调用时存在的变量的字典
```python3
food = 'spam'
age = 40
vars() # {'food': 'spam', 'age': 40, ...many more...}
```
```python3
'%(age)d %(food)s' % vars()' # '40 spam'
```
### 字符串格式化调用方法
* 花括号通过位置({1})或关键字({food})指出替换目标及要插入的参数
```python3
template = '{0}, {1} and {2}'
template.format('spam', 'ham', 'eggs') # 'spam, ham and eggs'
template = '{motto}, {pork} and {food}'
template.format(motto='spam', pork='ham', food='eggs') # 'spam, ham and eggs'
template = '{motto}, {0} and {food}'
template.format('ham', motto='spam', food='eggs') # 'spam, ham and eggs'
```
* 就像%表达式和其他字符串方法一样，format创建并返回一个新的字符串对象
### 添加键、属性和偏移量
```python3
import sys
'My {1[spam]} run {0.platform}'.format(sys, {'spam': 'laptop'}) # 'My laptop run darwin'
'My {config[spam]} runs {sys.platform}'.format(sys=sys, config={'spam': 'laptop'}) # 'My laptop runs darwin'
```
* 和%表达式一样，指定负的偏移或分片，或者使用任意表达式，必须在格式化字符串自身之外运行表达式
```python3
somelist = list('SPAM')
somelist # ['S', 'P', 'A', 'M']
'first={0[0]}, third={0[2]}'.format(somelist)
# 'first=S, third=A'
'first={0}, last={1}'.format(somelist[0], somelist[-1])
# 'first=S, last=M'
parts = somelist[0], somelist[-1], somelist[1:3]
'first={0}, last={1}, middle={2}'.format(*parts)
# "first=S, last=M, middle=['P', 'A']"
```
### 添加具体格式化
* {fieldname!conversinflag:formatspec}：fieldname是指定参数的一个数字或关键字，后面跟着可选的'.name'或'[index]'成分引用；conversionflag可以是r、s，或者a分别是在该值上对repr、str或ascii内置函数的一次调用；formatspec指定了该如何表示该值，包括字段宽度、对齐方式、补零、小数点精度等细节，并且以一个可选的数据类型编码结束
* [[fill]align][sign][#][0][width][.precision][typecode]，align可以是<、>、=或^，分别表示左对齐、右对齐、标记字符后的补充、居中对齐。
```python3
'{0:10} = {1:10}'.format('spam', 123.4567)
# 'spam       =   123.4567'
'{0:>10} = {1:<10}'.format('spam', 123.4567)
# '      spam = 123.4567  '
'{0.platform:>10} = {1[item]:<10}'.format(sys, dict(item='laptop'))
# '    darwin = laptop    '
```
### 与%格式化表达式比较
* 通常，格式化表达式会比格式化方法调用更容易编写
```python3
print('%s=%s' % ('spam', 42))
print('{0}={1}'.format('spam', 42))
```
