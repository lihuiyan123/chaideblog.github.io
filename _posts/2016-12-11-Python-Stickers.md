---
layout: post
title:  "Python需要注意的一些问题"
categories: "Python"
tags: "References"
excerpt: Beautiful is better than ugly.
---

## “引用”是门大学问

Python中需要特别注意引用的问题。由于Python中变量只是对对象的一个引用，而多个变量可以引用同一个对象。这就会造成一些问题，举个简单的例子：

{% highlight python %}
A = [1, 2, 3]
B = A
print("A = " + str(A) + "; B = " + str(B))
A.remove(2)
print("A = " + str(A) + "; B = " + str(B))
{% endhighlight %}

输出的结果：
<img src="{{ site.url }}/image/Python/References_Example1-1.png">

例子中，A和B都是对对象“[1, 2, 3]”的一个引用，可以理解为A和B是两个指向“[1, 2, 3]”的指针，事实上Python也是这么实现的。当修改了A的值，实际上是修改了A指向的对象的值，所以B的值也发生了变化。我们可以再进行一个尝试，可以发现A和B实际是同一个对象。

<img src="{{ site.url }}/image/Python/References_Example1-2.png">

但是，当你给A赋予一个新的对象，之前的对象的空间会被回收（如果没有被其他变量名或对象引用），称为垃圾回收。此外，大的对象可以连接到其他对象，比如列表、字典等。所以，如果你更改列表中的一个变量时，需要小心了。

## 函数默认值是可变对象时

上一部分的内容是为这一部分的内容做铺垫。在实现ID3算法时，我发现了一个问题：当函数默认值是可变对象时，对函数多次调用，可是变量都指向了同一个对象。举个例子：
{% highlight python %}
from myclass import node
import copy

a = node()
a.addValue(1)
a.printNode()

b = node()
b.addValue(2)
b.printNode()

print("a is b = " + str(a is b))
print("a == b = " + str(a == b))
print("a.node is b.node = " + str(a.node is b.node))
{% endhighlight %}

其中，myclass文件如下：
{% highlight python %}
class node:
    def __init__(self, node = []):
        self.node = node

    def addValue(self, value):
        self.node.append(value)

    def printNode(self):
        print(self.node)
{% endhighlight %}

结果显示：
{% highlight python %}
[1]
[1, 2]
a is b = False
a == b = False
a.node is b.node = True
{% endhighlight %}

针对这个问题，我找到了两种方法解决：

1. 不改变class，使用copy库：

{% highlight python %}
from myclass import node
import copy

a = copy.deepcopy(node())
a.addValue(1)
a.printNode()

b = copy.deepcopy(node())
b.addValue(2)
b.printNode()

print("a is b = " + str(a is b))
print("a == b = " + str(a == b))
print("a.node is b.node = " + str(a.node is b.node))
{% endhighlight %}

结果显示：

{% highlight python %}
[1]
[2]
a is b = False
a == b = False
a.node is b.node = False
{% endhighlight %}

注意，不要使用浅复制(copy)，浅复制实际还是对对象的引用（浅复制和深复制的区别）。问题虽然得到了解决，但是这种方法显然不漂亮。

2. 不使用可变变量作为函数默认值

将class文件修改成如下：
{% highlight python %}
class node:
    def __init__(self, node = None):
        if node is None:
            self.node = []

    def addValue(self, value):
        self.node.append(value)

    def printNode(self):
        print(self.node)
{% endhighlight %}

同时，将主文件恢复成原先的样子：
{% highlight python %}
from myclass import node
import copy

a = node()
a.addValue(1)
a.printNode()

b = node()
b.addValue(2)
b.printNode()

print("a is b = " + str(a is b))
print("a == b = " + str(a == b))
print("a.node is b.node = " + str(a.node is b.node))
{% endhighlight %}

可以看到结果如下：
{% highlight python %}
[1]
[2]
a is b = False
a == b = False
a.node is b.node = False
{% endhighlight %}
