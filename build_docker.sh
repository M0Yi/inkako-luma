#!/bin/bash

# 记录开始时间
start_time=$(date +%s)

# 检查是否传入了 APP_ENV 参数
if [ -z "$1" ]; then
    echo "请传入 APP_ENV 参数"
    exit 1
fi

# 检查是否有第二个参数用于跳过Composer操作
SKIP_COMPOSER=false
if [ ! -z "$2" ] && [ "$2" = "skip" ]; then
    SKIP_COMPOSER=true
    echo "检测到skip参数，将跳过Composer更新和安装操作..."
fi

# 使用 Docker 容器执行 composer install
if [ "$SKIP_COMPOSER" = false ]; then
    echo "在 Docker 容器中执行 Composer "

#    docker run --rm -v "$(pwd)":/var/www/html -w /var/www/html hyperf/hyperf:8.3-alpine-v3.19-swoole \
#        composer config -g repo.packagist composer https://mirrors.cloud.tencent.com/composer/
#    echo "在 Docker 容器中执行 Composer update"
#
#
#    # 先执行 composer update
#    docker run --rm -v "$(pwd)":/var/www/html -w /var/www/html hyperf/hyperf:8.3-alpine-v3.19-swoole composer update
#
#    # 检查 composer update 是否成功
#    if [ $? -ne 0 ]; then
#        echo "Composer 更新失败，脚本终止！"
#        exit 1
#    fi
#    echo "在 Docker 容器中执行 Composer install"
#
#    # 执行 composer install composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/
# composer config -g repo.packagist composer https://mirrors.cloud.tencent.com/composer/ \
#    docker run --rm -v "$(pwd)":/var/www/html -w /var/www/html hyperf/hyperf:8.3-alpine-v3.19-swoole composer install --no-dev -o
    docker run --rm -v "$(pwd)":/var/www/html -w /var/www/html \
        hyperf/hyperf:8.3-alpine-v3.19-swoole sh -c \
        "composer config -g repo.packagist composer https://mirrors.aliyun.com/composer/ \
         && composer update \
         && composer install --no-dev -o"


    # 检查 composer 安装是否成功
    if [ $? -ne 0 ]; then
        echo "Composer 安装失败，脚本终止！"
        exit 1
    fi
else
    echo "跳过Composer更新和安装操作..."
fi

# 获取当前时间
current_time=$(date +%Y%m%d%H%M%S)
docker_image_name=inkako-api-"$1":"$current_time"
export DOCKER_IMAGE_NAME="$docker_image_name"
# 构建 Docker 镜像，传入 APP_ENV 参数，并使用当前时间作为标签
docker build --build-arg APP_ENV="$1" -t "$docker_image_name" .
# 检查构建是否成功
if [ $? -eq 0 ]; then
    echo "Docker 镜像构建成功"
    # 计算并显示总用时
    end_time=$(date +%s)
    elapsed_time=$((end_time - start_time))
    echo "脚本执行总用时: ${elapsed_time} 秒"
    cp -r ./deploy."$1".yml ./docker-compose.yml
    docker-compose up -d
else
    echo "Docker 镜像构建失败"
    exit 1
fi

