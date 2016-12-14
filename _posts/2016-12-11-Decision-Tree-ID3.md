---
layout: post
title:  决策树——ID3算法
categories: Machine&nbsp;Learning
tags: Decision&nbsp;Tree
excerpt: ID3算法通过信息熵来选择最佳的测试属性。
---

## ID3算法的基本理论

ID3算法是基于奥卡姆剃刀原理（<a href="{{ site.url }}/ML-Concept-and-Fundamentals/index.html#14-归纳偏好" target="_blank">奥卡姆剃刀原理</a>）的一种决策树算法。具体原理在“<a href="{{ site.url }}/ML-Decision-Tree/index.html#迭代分类器id3" target="_blank">机器学习笔记——决策树</a>”一文中有详细介绍。

## ID3算法的Python实现

实际上，在python实现之前，我首先使用Matlab来尝试实现ID3算法的。主要原因是：(1)我研究生的研究工作主要使用Matlab；(2)我使用过Matlab实现过一些算法和论文，有一定经验。但是，事实证明我还是too young too simple。首先，Matlab在树的数据结构表达上比较复杂，不利于数据的表达和搜索；其次，Matlab主要在矩阵运算方面发挥优势，而在递归和迭代方面，不如c、python等语言优化的好。当然，之后我还是会使用Matlab重新实现一次ID3算法的。

### 训练集

关于ID3算法的训练集上，我找了找UCI的<a href="https://archive.ics.uci.edu/ml/index.html" target="_blank">Machine Learning Repository</a>，并没有找到合适的。（希望有相关数据的可以email给我）最终，我从一些bolg上发现了一组数据，用来训练我的ID3算法。

这组数据包含了14天的气象数据(outlook、temperature、humidity、windy)，并根据这些天气决定是否出去玩(play)。

|outlook|temperature|humidity|windy|play|
|:-----:|:---------:|:------:|:---:|:---:|
|sunny|hot|high|false|no|
|sunny|hot|high|true|no|
|overcast|hot|high|false|yes|
|rain|mild|high|false|yes|
|rain|cool|normal|false|yes|
|rain|cool|normal|true|no|
|overcast|cool|normal|true|yes|
|sunny|mild|high|false|no|
|sunny|cool|normal|false|yes|
|rain|mild|normal|false|yes|
|sunny|mild|normal|true|yes|
|overcast|mild|high|true|yes|
|overcast|hot|normal|false|yes|
|rain|mild|high|true|no|

### 数据结构

创建了一个类，将数据结构都放在了类里，同时定义了一些方法来处理数据。（题外话：在类的定义过程中，我发现了python很多有意思的地方。有些可以称作优点，有些也可以看出python的缺点。这些内容我会放在一篇新的文章中说。）

{% highlight python %}
class Node:
	def __init__(self, deepNum = -1, attribute = None, classify = None, data = None, childNode = None):
		self.deepNum = deepNum
		self.attribute = attribute
		self.classify = classify
		if data is None:
			self.data = []
		else:
			self.data = data

		if childNode is None:
			self.childNode = {}
		else:
			self.childNode = childNode

	def changeDeepNum(self, deepNum = -1):
		self.deepNum = deepNum

	def changeData(self, data):
		self.data = data

	def changeAttribute(self, attribute = None):
		self.attribute = attribute

	def changeClassify(self, classify = None):
		self.classify = classify

	def changeNextNode(self, nextNode = None):
		if nextNode is None:
			self.childNode = {}
		else:
			self.childNode = nextNode

	def addNextNode(self, nextNode = None):
		if nextNode is None:
			self.childNode = {}
		else:
			self.childNode.update(nextNode)

	def printAll(self):
		print(str(self.deepNum) + ': attribute = ' + str(self.attribute) + '; classify = ' + str(self.classify) + '; childNode = ' + str(self.childNode))
{% endhighlight %}

### ID3算法部分

ID3算法主要分为3个部分，也可以说为4个部分。3个部分是“同一类别的标记为叶结点”、“属性集空或样本的属性值相同标记为叶结点”，“根据属性得到的子集创建分支结点”。第3个部分中有一步至关重要，也是ID3算法的核心，就是选择最优划分属性。

{% highlight python %}
def id3(data, attr):
	import myClass

	node = myClass.Node()
	node.changeData(data)
	deepNum = 4 - len(attr)
	node.changeDeepNum(deepNum)

	temp = []
	for eachData in data:
		temp.append(eachData['classify'])

	if len(set(temp)) == 1:

		node.changeClassify(temp[0])
		return(node)

	if (not list(attr.keys())) | dataIsSameInAttr(data, attr):

		node.changeClassify(mostClassifyInData(data))
		return(node)

	bestAttr = findMaxGain(data, attr)
	node.changeAttribute(list(bestAttr.keys())[0])

	for eachValueInBestAttr in bestAttr[list(bestAttr.keys())[0]]:
		dataV = getDataV(data, bestAttr, eachValueInBestAttr)
		if not dataV:
			nextNode = myClass.Node()
			nextNode.changeClassify(mostClassifyInData(data))
			nextNode.changeDeepNum(deepNum + 1)
			node.addNextNode({eachValueInBestAttr: nextNode})
		else:
			attrCopy = attr.copy()
			attrCopy.pop(list(bestAttr.keys())[0])
			node.addNextNode({eachValueInBestAttr: id3(dataV, attrCopy)})
	return(node)

def dataIsSameInAttr(data, attr):
	dataAttrValue = []
	for eachData in data:
		temp = {}
		for eachAttrKey in attr.keys():
			temp.update({eachAttrKey: eachData['attrValue'][eachAttrKey]})
		dataAttrValue.append(temp)
	for eachdataAttrValue in dataAttrValue:
		if eachdataAttrValue == dataAttrValue[0]:
			pass
		else:
			return(False)
	return(True)

def mostClassifyInData(data):
	mostClassify = []
	import collections
	countData = dict(collections.Counter([each_data['classify'] for each_data in data]))
	mostClassifyNum = max(list(countData.values()))
	for eachCountData in countData:
		if countData[eachCountData] == mostClassifyNum:
			mostClassify.append(eachCountData)
	return(mostClassify)

def getDataV(data, bestAttr, attrValue):
	dataV = []
	for eachData in data:
		if eachData['attrValue'][list(bestAttr.keys())[0]] == attrValue:
			dataV.append(eachData)
	return(dataV)

def findMaxGain(data, attr):
	temp = gain(data, attr)
	tempValues = list(temp.values())
	for tempKey in temp.keys():
		if temp[tempKey] == max(tempValues):
			return({tempKey: attr[tempKey]})

def gain(data, attr):
	temp = {}
	for eachAttrKey in attr.keys():
		sum = entropy(data)
		for eachAttrValue in attr[eachAttrKey]:
			dataV = getDataV(data, {eachAttrKey :attr[eachAttrKey]}, eachAttrValue)
			sum -= len(dataV) / len(data) * entropy(dataV)
		temp.update({eachAttrKey: sum})
	return(temp)

def entropy(data):
	import math
	import collections
	countData = dict(collections.Counter([each_data['classify'] for each_data in data]))
	ent = 0
	for countDataKey in countData.keys():
		ent -= countData[countDataKey] / len(data) * math.log2(countData[countDataKey] / len(data))
	return(ent)
{% endhighlight %}

### 树的表达

最终，我使用了2种方法来呈现树的结构。第一种方法，将每个结点打印出来，结构如下：

```
0: attribute = outlook; classify = None; childNode = {'overcast': <myClass.Node object at 0x1021ecba8>, 'rain': <myClass.Node object at 0x1021ecb70>, 'sunny': <myClass.Node object at 0x104754208>}
1: attribute = None; classify = yes; childNode = {}
1: attribute = windy; classify = None; childNode = {'false': <myClass.Node object at 0x104754240>, 'true': <myClass.Node object at 0x104754278>}
2: attribute = None; classify = yes; childNode = {}
2: attribute = None; classify = no; childNode = {}
1: attribute = humidity; classify = None; childNode = {'normal': <myClass.Node object at 0x104754320>, 'high': <myClass.Node object at 0x104754358>}
2: attribute = None; classify = yes; childNode = {}
2: attribute = None; classify = no; childNode = {}
```

其中，第1个数字表示该结点所在树的层数（自上向下计算），0表示根结点。

第二种方法，就是使用python的matplotlib库画图。使用matplotlib画图的过程非常曲折，画出来的效果也差强人意：

<img src="{{ site.url }}/image/Machine_Learning/Decision_Tree_ID3_1.png">

下载完整程序： [ID3算法源码]({{ site.url }}/download/ID3.zip)
