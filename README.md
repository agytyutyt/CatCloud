# CatCloud后端解析

## 1. 单文件入口
入口文件: index.php

## 2. 新建项目主对象app

在Application.php文件中定义项目类
在index.php中new出相应实例。
调用app中的run()方法。

## 3. Application.php

截获请求，然后从请求url中分析请求路径，
请求路径具体参数为：ip:port/页面大类/方法名?参数
先获取页面大类，根据页面大类构造出相应类名，产生相应的controller
然后分析出请求的方法，调用controller的相应方法。
(利用ReflectionClass)

### 补充:
1. [php使用函数exec()时获取更高权限的方法](https://blog.csdn.net/weicy1510/article/details/83508816)
   https://blog.csdn.net/yuanya/article/details/78175124

2. exec() 函数返回状态码：

   | Exit Code Number | Meaning                                                      | Example                       | Comments                                                     |
   | ---------------- | ------------------------------------------------------------ | ----------------------------- | ------------------------------------------------------------ |
   | `1`              | Catchall for general errors                                  | let "var1 = 1/0"              | Miscellaneous errors, such as "divide by zero"               |
   | `2`              | Misuse of shell builtins (according to Bash documentation)   |                               | Seldom seen, usually defaults to exit code 1                 |
   | `126`            | Command invoked cannot execute                               |                               | Permission problem or command is not an executable           |
   | `127`            | "command not found"                                          |                               | Possible problem with `$PATH` or a typo                      |
   | `128`            | Invalid argument to [exit](http://www.linuxtopia.org/online_books/advanced_bash_scripting_guide/exit-status.html#EXITCOMMANDREF) | exit 3.14159                  | **exit** takes only integer args in the range 0 - 255 (see footnote) |
   | `128+n`          | Fatal error signal "n"                                       | **kill -9** `$PPID` of script | **$?** returns 137 (128 + 9)                                 |
   | `130`            | Script terminated by Control-C                               |                               | Control-C is fatal error signal 2, (130 = 128 + 2, see above) |
   | `255*`           | Exit status out of range                                     | exit -1                       | **exit** takes only integer args in the range 0 - 255        |

   
3. 验证用户密码核心文件：auth.c
 [参考](https://blog.csdn.net/chenjifeng1987/article/details/80290895)
