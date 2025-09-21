<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\RequestMapping;
use Hyperf\View\RenderInterface;

#[Controller]
class DemoController extends AbstractController
{

    #[RequestMapping(path: "/demo", methods: ["GET"])]
    public function index(): \Psr\Http\Message\ResponseInterface
    {
        $data = [
            'title' => 'Hyperf Twig Demo',
            'name' => 'Hyperf开发者',
            'age' => 25,
            'skills' => ['PHP', 'Swoole', 'Hyperf', 'MySQL', 'Redis'],
            'projects' => [
                ['name' => '微服务API', 'status' => '已完成', 'score' => 95],
                ['name' => '实时聊天系统', 'status' => '进行中', 'score' => 80],
                ['name' => '数据分析平台', 'status' => '计划中', 'score' => 0],
            ],
            'isVip' => true,
            'loginTime' => date('Y-m-d H:i:s'),
        ];

        return $this->render->render('demo/index.html', $data);
    }

    #[RequestMapping(path: "/demo/user/{id}", methods: ["GET"])]
    public function userProfile(int $id)
    {
        // 模拟用户数据
        $users = [
            1 => ['name' => '张三', 'email' => 'zhangsan@hyperf.io', 'role' => 'admin'],
            2 => ['name' => '李四', 'email' => 'lisi@hyperf.io', 'role' => 'user'],
            3 => ['name' => '王五', 'email' => 'wangwu@hyperf.io', 'role' => 'moderator'],
        ];

        $user = $users[$id] ?? null;

        if (!$user) {
            return $this->render->render('demo/404.html', ['userId' => $id]);
        }

        return $this->render->render('demo/profile.html', [
            'title' => '用户资料',
            'user' => $user,
            'userId' => $id,
        ]);
    }

    #[RequestMapping(path: "/demo/form", methods: ["GET", "POST"])]
    public function form()
    {
        if ($this->request->getMethod() === 'POST') {
            $name = $this->request->input('name', '');
            $email = $this->request->input('email', '');
            $message = $this->request->input('message', '');

            return $this->render->render('demo/form_result.html', [
                'title' => '表单提交结果',
                'name' => $name,
                'email' => $email,
                'message' => $message,
            ]);
        }

        return $this->render->render('demo/form.html', [
            'title' => '联系我们',
        ]);
    }
}
