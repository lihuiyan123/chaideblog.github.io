---
layout: post
title:  "瑞利分布"
categories: 概率论
tags: 概率分布
excerpt: 当一个随机二维向量的两个分量呈独立的、有着相同的方差的正态分布时，这个向量的模呈瑞利分布。
---

瑞利分布（Rayleigh Distribution）:当一个随机二维向量的两个分量呈独立的、有着相同的方差的正态分布时，这个向量的模呈瑞利分布。

推导过程：

$$f(x, y)=\frac{1}{2\pi\sigma^2}e^{-\frac{x^2+y^2}{2\sigma^2}}$$

$$F_{z}(z)=P\{Z{\leq}z\}=P\{\sqrt{x^2+y^2}{\leq}z\}=P\{x^2+y^2{\leq}z^2\}$$

$$if\ z<0, F_{z}(z)=0$$

$$if\ z>0, F_{z}(z)={\iint \limits_{x^2+y^2{\leq}z^2}} {\frac{1}{2\pi\sigma^2}}
e^{-{\frac{x^2+y^2}{2\sigma^2}}} dxdy={\frac{1}{2\pi\sigma^2}} {\int_0^{2\pi} d\theta}
{\int_0^z e^{-\frac{r^2}{2\sigma^2}}rdr}=\frac{1}{sigma^2}\int_0^z
e^{-\frac{r^2}{2\sigma^2}}rdr=1-e^{-\frac{z^2}{2\sigma^2}}$$

$$f_{z}(z)=F^{'}_{z}(z)=\frac{z}{\sigma^2}e^{-\frac{z^2}{2\sigma^2}}(z{\leq}0)$$

数学期望：

$$\mu(X)=\int_0^{+ \infty} \frac{x^2}{\sigma^2}e^{-\frac{x^2}{2\sigma^2}}dx=
-\int_0^{+ \infty} xd(e^{-\frac{x^2}{2\sigma^2}})=\sigma\sqrt{\frac{\pi}{2}}$$

方差：

$$var(X)=\int_0^{+\infty} \frac{x^3}{\sigma^2}e^{-\frac{x^2}{2\sigma^2}}dx-\mu^2(X)=
-\int_0^{+\infty}x^2d(e^{-\frac{x^2}{2\sigma^2}})-\mu^2(X)=2\sigma^2-\mu^2(X)=
2\sigma^2-(\sigma\sqrt{\frac{\pi}{2}})^2=\frac{4-\pi}{2}\sigma^2$$
