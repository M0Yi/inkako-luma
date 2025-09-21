#!/bin/bash

# 获取第一个'php83'进程的PID
pid=$(ps aux | grep '[p]hp83' | grep -v 'grep' | awk '{print$1}' | head -n 1)

# 检查PID是否存在
if [ -z "$pid" ]; then
  # 如果没有找到PID，则启动PHP服务器
  php bin/hyperf.php server:watch
else
  # 输出要杀死的PID
  echo "Killing process with PID: $pid"
  # 杀死进程
  kill -9 $pid
  # 重启PHP服务器
  php bin/hyperf.php server:watch
fi

