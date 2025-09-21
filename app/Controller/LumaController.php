<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Hyperf\View\RenderInterface;
use Psr\Container\ContainerInterface;

class LumaController extends AbstractController
{
    public function __construct(protected RenderInterface $render)
    {
    }
    public function index(RequestInterface $request, ResponseInterface $response): \Psr\Http\Message\ResponseInterface
    {
        print_r(['luma/index']);
        return $this->render->render('luma/index');
    }

    public function discover(RequestInterface $request, ResponseInterface $response)
    {
        // 模拟活动发现页面数据
        $categories = [
            ['name' => '科技', 'count' => 234, 'icon' => 'fas fa-laptop-code'],
            ['name' => '商业', 'count' => 189, 'icon' => 'fas fa-briefcase'],
            ['name' => '设计', 'count' => 156, 'icon' => 'fas fa-palette'],
            ['name' => '教育', 'count' => 298, 'icon' => 'fas fa-graduation-cap'],
            ['name' => '娱乐', 'count' => 167, 'icon' => 'fas fa-music'],
            ['name' => '健康', 'count' => 134, 'icon' => 'fas fa-heart']
        ];

        $events = [
            [
                'id' => 1,
                'title' => 'AI 与未来工作论坛',
                'date' => '2024-04-05',
                'location' => '上海',
                'price' => 399,
                'attendees' => 234,
                'category' => '科技',
                'featured' => true
            ],
            [
                'id' => 2,
                'title' => '数字营销实战训练营',
                'date' => '2024-04-12',
                'location' => '北京',
                'price' => 299,
                'attendees' => 178,
                'category' => '商业',
                'featured' => false
            ],
            [
                'id' => 3,
                'title' => 'UI/UX 设计大师班',
                'date' => '2024-04-18',
                'location' => '深圳',
                'price' => 599,
                'attendees' => 89,
                'category' => '设计',
                'featured' => true
            ]
        ];

        return $this->render->render('luma/discover', [
            'categories' => $categories,
            'events' => $events,
            'total_events' => array_sum(array_column($categories, 'count'))
        ]);
    }

    public function pricing(RequestInterface $request, ResponseInterface $response)
    {
        $plans = [
            [
                'name' => '免费版',
                'price' => 0,
                'period' => '永久免费',
                'description' => '适合个人和小型活动',
                'features' => [
                    '最多 50 人参加',
                    '基础活动页面',
                    '邮件通知',
                    '基础数据统计',
                    '社区支持'
                ],
                'highlight' => false,
                'button_text' => '立即开始',
                'button_class' => 'btn-outline-primary'
            ],
            [
                'name' => '专业版',
                'price' => 299,
                'period' => '每月',
                'description' => '适合中小企业和专业组织者',
                'features' => [
                    '无限参加人数',
                    '自定义品牌页面',
                    '高级营销工具',
                    '详细数据分析',
                    '优先客服支持',
                    '多种支付方式',
                    '活动录播功能'
                ],
                'highlight' => true,
                'button_text' => '选择专业版',
                'button_class' => 'btn-primary'
            ],
            [
                'name' => '企业版',
                'price' => 999,
                'period' => '每月',
                'description' => '适合大型企业和机构',
                'features' => [
                    '专业版全部功能',
                    '白标解决方案',
                    'API 集成',
                    '专属客户经理',
                    '定制开发',
                    'SSO 单点登录',
                    '高级安全保障',
                    '培训和咨询服务'
                ],
                'highlight' => false,
                'button_text' => '联系销售',
                'button_class' => 'btn-outline-primary'
            ]
        ];

        return $this->render->render('luma/pricing', [
            'plans' => $plans
        ]);
    }

    public function help(RequestInterface $request, ResponseInterface $response)
    {
        $faq_categories = [
            [
                'title' => '快速开始',
                'icon' => 'fas fa-rocket',
                'questions' => [
                    ['q' => '如何创建我的第一个活动？', 'a' => '点击"创建活动"按钮，填写基本信息，选择模板，几分钟即可完成。'],
                    ['q' => '活动页面可以自定义吗？', 'a' => '是的，您可以自定义颜色、字体、布局和内容，打造独特的品牌体验。'],
                    ['q' => '支持哪些支付方式？', 'a' => '支持微信支付、支付宝、银行卡等多种支付方式。']
                ]
            ],
            [
                'title' => '活动管理',
                'icon' => 'fas fa-cogs',
                'questions' => [
                    ['q' => '如何邀请参与者？', 'a' => '可以通过邮件、短信、社交媒体分享活动链接，或批量导入联系人。'],
                    ['q' => '可以设置不同类型的门票吗？', 'a' => '可以，支持免费票、付费票、VIP票等多种门票类型和价格设置。'],
                    ['q' => '如何处理退款？', 'a' => '在活动管理后台可以轻松处理退款申请，资金会原路返回。']
                ]
            ],
            [
                'title' => '技术支持',
                'icon' => 'fas fa-headset',
                'questions' => [
                    ['q' => '遇到技术问题怎么办？', 'a' => '可以通过在线客服、邮件或电话联系我们的技术支持团队。'],
                    ['q' => '数据安全如何保障？', 'a' => '我们采用银行级加密技术，通过了 ISO 27001 安全认证。'],
                    ['q' => '是否提供 API 接口？', 'a' => '企业版用户可以使用我们的 REST API 进行系统集成。']
                ]
            ]
        ];

        return $this->render->render('luma/help', [
            'faq_categories' => $faq_categories
        ]);
    }

    public function create(RequestInterface $request, ResponseInterface $response)
    {
        return $this->render->render('luma/create');
    }

    public function login(RequestInterface $request, ResponseInterface $response)
    {
        return $this->render->render('luma/login');
    }

    public function register(RequestInterface $request, ResponseInterface $response)
    {
        // 获取活动ID，如果没有则使用默认值
        $eventId = $request->query('event_id', '1');

        // 模拟活动数据
        $event = [
            'id' => $eventId,
            'title' => 'AI 与未来工作论坛 2024',
            'start_date' => '2024-12-20',
            'start_time' => '14:00',
            'end_date' => '2024-12-20',
            'end_time' => '17:30',
            'location' => '上海国际会议中心 · 浦东新区',
            'description' => '探讨人工智能技术如何重塑未来工作模式，邀请行业专家分享最新趋势和实践案例。本次论坛将涵盖AI在各行业的应用、就业市场变化、技能培训需求等热点话题，为参会者提供前瞻性的洞察和实用的指导。',
            'cover_image' => '/static/images/ai-forum-cover.jpg',
            'max_capacity' => 200,
            'registered_count' => 156,
            'require_approval' => false,
            'limit_capacity' => true,
            'seat_layout' => true,
            'status' => 'open', // open, closed, cancelled
            'price' => 0, // 免费活动
            'organizer' => [
                'name' => '上海科技创新协会',
                'avatar' => '/static/images/organizer-avatar.jpg'
            ],
            'theme' => 'tech'
        ];

        // 模拟座位布局数据（如果启用了座位排布）
        $seatLayout = null;
        if ($event['seat_layout']) {
            $seatLayout = [
                'rows' => 10,
                'cols' => 12,
                'seats' => [
                    // 座位状态：available, occupied, vip, special, disabled
                    // 模拟已占用的座位
                    ['row' => 0, 'col' => 0, 'status' => 'occupied'],
                    ['row' => 0, 'col' => 1, 'status' => 'occupied'],
                    ['row' => 0, 'col' => 3, 'status' => 'vip'],
                    ['row' => 0, 'col' => 4, 'status' => 'vip'],
                    ['row' => 1, 'col' => 2, 'status' => 'occupied'],
                    ['row' => 1, 'col' => 5, 'status' => 'special'],
                    ['row' => 2, 'col' => 1, 'status' => 'occupied'],
                    ['row' => 2, 'col' => 7, 'status' => 'occupied'],
                    // 其余座位默认为 available
                ]
            ];
        }

        // 检查活动状态
        if ($event['status'] === 'closed') {
            return $this->render->render('luma/register-closed', ['event' => $event]);
        }

        if ($event['status'] === 'cancelled') {
            return $this->render->render('luma/register-cancelled', ['event' => $event]);
        }

        // 检查是否已满员
        if ($event['limit_capacity'] && $event['registered_count'] >= $event['max_capacity']) {
            return $this->render->render('luma/register-full', ['event' => $event]);
        }

        return $this->render->render('luma/register', [
            'event' => $event,
            'seat_layout' => $seatLayout
        ]);
    }

    public function registerSubmit(RequestInterface $request, ResponseInterface $response)
    {
        // 获取表单数据
        $eventId = $request->input('event_id');
        $name = $request->input('name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $company = $request->input('company', '');
        $title = $request->input('title', '');
        $notes = $request->input('notes', '');
        $seatId = $request->input('seat_id', null);
        $agreeTerms = $request->input('agree_terms', false);
        $receiveUpdates = $request->input('receive_updates', false);

        // 基本验证
        $errors = [];

        if (empty($name)) {
            $errors[] = '姓名不能为空';
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = '请输入有效的邮箱地址';
        }

        if (empty($phone) || !preg_match('/^1[3-9]\d{9}$/', $phone)) {
            $errors[] = '请输入有效的手机号码';
        }

        if (!$agreeTerms) {
            $errors[] = '请同意隐私政策和服务条款';
        }

        // 如果有验证错误，返回错误信息
        if (!empty($errors)) {
            return $response->json([
                'success' => false,
                'message' => '报名失败',
                'errors' => $errors
            ]);
        }

        // 模拟检查活动状态和容量
        $eventStatus = $this->checkEventAvailability($eventId);
        if (!$eventStatus['available']) {
            return $response->json([
                'success' => false,
                'message' => $eventStatus['message']
            ]);
        }

        // 模拟检查座位可用性（如果选择了座位）
        if ($seatId) {
            $seatStatus = $this->checkSeatAvailability($eventId, $seatId);
            if (!$seatStatus['available']) {
                return $response->json([
                    'success' => false,
                    'message' => $seatStatus['message']
                ]);
            }
        }

        // 处理头像上传（如果有）
        $avatarPath = null;
        $uploadedFile = $request->file('avatar');
        if ($uploadedFile && $uploadedFile->isValid()) {
            $avatarPath = $this->handleAvatarUpload($uploadedFile);
        }

        // 创建报名记录（实际应用中应该保存到数据库）
        $registrationData = [
            'id' => uniqid('reg_'),
            'event_id' => $eventId,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'company' => $company,
            'title' => $title,
            'notes' => $notes,
            'seat_id' => $seatId,
            'avatar' => $avatarPath,
            'status' => 'confirmed', // 如果需要审核则为 'pending'
            'agree_terms' => $agreeTerms,
            'receive_updates' => $receiveUpdates,
            'register_time' => date('Y-m-d H:i:s'),
            'confirmation_code' => strtoupper(substr(md5(uniqid()), 0, 8))
        ];

        // 模拟保存到数据库
        $this->saveRegistration($registrationData);

        // 发送确认邮件（实际应用中实现）
        $this->sendConfirmationEmail($registrationData);

        // 返回成功响应
        return $response->json([
            'success' => true,
            'message' => '报名成功！我们已向您的邮箱发送确认信息。',
            'data' => [
                'registration_id' => $registrationData['id'],
                'confirmation_code' => $registrationData['confirmation_code'],
                'seat_id' => $seatId
            ]
        ]);
    }

    public function management(RequestInterface $request, ResponseInterface $response)
    {
        // 模拟活动管理数据
        $event = [
            'id' => 1,
            'title' => '产品发布会 2024',
            'date' => '2024-12-15',
            'time' => '14:00',
            'location' => '上海国际会议中心',
            'max_capacity' => 100,
            'registered_count' => 48,
            'status' => 'active'
        ];

        // 模拟参与者数据
        $participants = [
            [
                'id' => 1,
                'name' => '张三',
                'email' => 'zhang@example.com',
                'phone' => '138****8888',
                'company' => '科技有限公司',
                'position' => '产品经理',
                'status' => 'confirmed',
                'seat_id' => 'A1',
                'register_time' => '2024-12-01 15:30',
                'last_update' => '2024-12-02 09:15',
                'avatar' => null
            ],
            [
                'id' => 2,
                'name' => '李四',
                'email' => 'li@example.com',
                'phone' => '139****9999',
                'company' => '创新企业',
                'position' => '技术总监',
                'status' => 'confirmed',
                'seat_id' => 'A2',
                'register_time' => '2024-12-01 16:20',
                'last_update' => '2024-12-02 10:30',
                'avatar' => null
            ],
            [
                'id' => 3,
                'name' => '王五',
                'email' => 'wang@example.com',
                'phone' => '137****7777',
                'company' => '设计工作室',
                'position' => 'UI设计师',
                'status' => 'pending',
                'seat_id' => null,
                'register_time' => '2024-12-02 08:45',
                'last_update' => '2024-12-02 08:45',
                'avatar' => null
            ],
            [
                'id' => 4,
                'name' => '赵六',
                'email' => 'zhao@example.com',
                'phone' => '136****6666',
                'company' => '咨询公司',
                'position' => '项目经理',
                'status' => 'confirmed',
                'seat_id' => 'B5',
                'register_time' => '2024-12-01 20:15',
                'last_update' => '2024-12-02 11:00',
                'avatar' => null
            ],
            [
                'id' => 5,
                'name' => '孙七',
                'email' => 'sun@example.com',
                'phone' => '135****5555',
                'company' => '金融集团',
                'position' => '数据分析师',
                'status' => 'cancelled',
                'seat_id' => null,
                'register_time' => '2024-11-30 14:20',
                'last_update' => '2024-12-01 09:30',
                'avatar' => null
            ]
        ];

        // 模拟座位数据
        $seats = [
            // VIP区座位 (A1-A20)
            ['id' => 'A1', 'area' => 'VIP区', 'type' => 'vip', 'status' => 'assigned', 'assigned_to' => 1],
            ['id' => 'A2', 'area' => 'VIP区', 'type' => 'vip', 'status' => 'assigned', 'assigned_to' => 2],
            ['id' => 'A3', 'area' => 'VIP区', 'type' => 'vip', 'status' => 'available', 'assigned_to' => null],
            ['id' => 'A4', 'area' => 'VIP区', 'type' => 'vip', 'status' => 'reserved', 'assigned_to' => null],
            ['id' => 'A5', 'area' => 'VIP区', 'type' => 'vip', 'status' => 'available', 'assigned_to' => null],

            // 普通区座位 (B1-B60)
            ['id' => 'B1', 'area' => '普通区', 'type' => 'standard', 'status' => 'available', 'assigned_to' => null],
            ['id' => 'B2', 'area' => '普通区', 'type' => 'standard', 'status' => 'available', 'assigned_to' => null],
            ['id' => 'B3', 'area' => '普通区', 'type' => 'standard', 'status' => 'assigned', 'assigned_to' => null],
            ['id' => 'B4', 'area' => '普通区', 'type' => 'standard', 'status' => 'available', 'assigned_to' => null],
            ['id' => 'B5', 'area' => '普通区', 'type' => 'standard', 'status' => 'assigned', 'assigned_to' => 4],
        ];

        // 计算统计数据
        $stats = [
            'total_seats' => count($seats),
            'assigned_seats' => count(array_filter($seats, fn($s) => $s['status'] === 'assigned')),
            'available_seats' => count(array_filter($seats, fn($s) => $s['status'] === 'available')),
            'reserved_seats' => count(array_filter($seats, fn($s) => $s['status'] === 'reserved')),
            'total_participants' => count($participants),
            'confirmed_participants' => count(array_filter($participants, fn($p) => $p['status'] === 'confirmed')),
            'pending_participants' => count(array_filter($participants, fn($p) => $p['status'] === 'pending')),
            'cancelled_participants' => count(array_filter($participants, fn($p) => $p['status'] === 'cancelled')),
            'assigned_participants' => count(array_filter($participants, fn($p) => !empty($p['seat_id']))),
            'unassigned_participants' => count(array_filter($participants, fn($p) => empty($p['seat_id'])))
        ];

        return $this->render->render('luma/management', [
            'event' => $event,
            'participants' => $participants,
            'seats' => $seats,
            'stats' => $stats
        ]);
    }

    /**
     * 检查活动可用性
     */
    private function checkEventAvailability($eventId)
    {
        // 模拟检查活动状态
        // 实际应用中应该从数据库查询

        // 模拟活动已满的情况
        if (rand(1, 10) === 1) {
            return [
                'available' => false,
                'message' => '抱歉，该活动报名人数已满'
            ];
        }

        // 模拟活动已结束的情况
        if (rand(1, 10) === 2) {
            return [
                'available' => false,
                'message' => '抱歉，该活动报名已截止'
            ];
        }

        return [
            'available' => true,
            'message' => '活动可以报名'
        ];
    }

    /**
     * 检查座位可用性
     */
    private function checkSeatAvailability($eventId, $seatId)
    {
        // 模拟检查座位状态
        // 实际应用中应该从数据库查询

        // 模拟座位已被占用的情况
        if (rand(1, 5) === 1) {
            return [
                'available' => false,
                'message' => '抱歉，该座位已被其他用户选择，请选择其他座位'
            ];
        }

        return [
            'available' => true,
            'message' => '座位可用'
        ];
    }

    /**
     * 处理头像上传
     */
    private function handleAvatarUpload($uploadedFile)
    {
        // 实际应用中应该实现文件上传逻辑
        // 包括文件类型验证、大小限制、重命名、保存等

        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        if (!in_array($uploadedFile->getMimeType(), $allowedTypes)) {
            throw new \Exception('不支持的文件类型');
        }

        if ($uploadedFile->getSize() > $maxSize) {
            throw new \Exception('文件大小超过限制（2MB）');
        }

        // 生成文件名
        $filename = uniqid('avatar_') . '.' . $uploadedFile->getExtension();
        $uploadPath = 'uploads/avatars/' . $filename;

        // 模拟保存文件
        // $uploadedFile->moveTo($uploadPath);

        return $uploadPath;
    }

    /**
     * 保存报名记录
     */
    private function saveRegistration($registrationData)
    {
        // 实际应用中应该保存到数据库
        // 这里只是模拟

        // 示例：
        // DB::table('registrations')->insert($registrationData);

        return true;
    }

    /**
     * 发送确认邮件
     */
    private function sendConfirmationEmail($registrationData)
    {
        // 实际应用中应该发送邮件
        // 这里只是模拟

        // 示例邮件内容
        $emailContent = [
            'to' => $registrationData['email'],
            'subject' => '活动报名确认 - ' . $registrationData['confirmation_code'],
            'content' => "
                亲爱的 {$registrationData['name']}，

                感谢您报名参加我们的活动！

                确认码：{$registrationData['confirmation_code']}
                报名时间：{$registrationData['register_time']}
                " . ($registrationData['seat_id'] ? "座位号：{$registrationData['seat_id']}" : '') . "

                我们期待您的参与！
            "
        ];

        // 实际发送邮件
        // Mail::send($emailContent);

        return true;
    }
}
