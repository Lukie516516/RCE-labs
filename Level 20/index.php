<?php 
error_reporting(0);
/*
# -*- coding: utf-8 -*-
# @Author: 探姬
# @Date:   2024-08-11 14:34
# @Repo:   github.com/ProbiusOfficial/RCE-labs
# @email:  admin@hello-ctf.com
# @link:   hello-ctf.com

--- HelloCTF - RCE靶场 关卡 20 :  PHP 特性 - 自增 --- 

可用字符：! $ ' ( ) + , . / ; = [ ] _

自增通过一下几个特性实现：
变量：
在PHP中变量以 $ 开头，后面为变量名称，PHP中变量可以是下划线 _ 开头，所以 $_ 是一个变量，$__ 则是不同的变量，就像 $a 和 $aa 一样。

数组->字符串：
在PHP中，非字符串是不能使用 . 符号进行拼接的，当你强制拼接时 PHP 会将非字符串转换为字符串：
$_ = 1; var_dump($_); var_dump($_.'');
这将会输出：int(1) string(1) "1"
但如果 $_ 是一个数组，则会被强制转换为字符串 Array 而无视数组内容。
所以 [].'' 表示在空数组后面拼接空字符串，PHP会优先转换类型，从而将数组转换为字符串 Array。

字符串：
字符串本质上是一个字符的有序序列，同C语言类似，你可以直接通过索引（或者说下标）的方式直接访问字符串中的字符。
$_ = "Hello-CTF";var_dump($_[0]);
这将会输出 string(1) "H"
所以在 $_ = ([].'')[0]; var_dump($_); 你会得到输出：string(1) "A"

自增：
这是一个编程语言中很常见的操作，我们一般在for循环会写到的语句 i++ 或者 ++i，这是一个自增操作，PHP也一样，只不过我们的变量名称不是很常见与之等效的 $_++ 或者 ++$_。
当我们对一个字符或者是字母进行自增操作时，PHP会将其转换为ASCII码，然后自增，然后再转换为字符。直观一点 A++ 将会输出 B，Z++ 将会输出 AA。++的位置决定语句的执行顺序，++在前面时会先进行自增操作。 $_ = ([].'')[0]; 在前面时输出B，后面时输出A。

所以通过特性的连用，你可以看到很多自增的Payload长这样：
payload=$_=(_/_._)[''=='_'];$_++;$__ = $_++;$__ = $_.$__;$_++;$_++;$_++;$__ = $__.$_++.$_++;$_ = $__;$__ ='_';$__.=$_;$$__[__]($$__[_]); 
&__=system 
&_=ls

自增题目的考点通常在Payload的长度限制，挑战关卡，让你的Payload足够短吧。
*/

highlight_file(__FILE__);

isset($_POST['code']) ? $code = $_POST['code'] : $code = null;

if(preg_match("/[a-zA-Z0-9@#%^&*:{}\-<\?>\"|`~\\\\]/", $code)){
    die("WAF!");
}else{
    echo "Your Payload's Length : ".strlen($code)."<br>";
    eval($code);
}

?>
