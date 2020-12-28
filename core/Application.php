<?php

namespace app\core;

use app\core\db\Database;

class Application {
    public static string $ROOT_DIR;

    public string $layout = 'main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public ?UserModel $user;
    public View $view;

    public ?Controller $controller = null;
    public static Application $app;

    public function __construct($rootPath, array $config) {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR  = $rootPath;
        self::$app = $this;
        $this->request = new Request;
        $this->response = new Response;
        $this->session = new Session;
        $this->router = new Router($this->request, $this->response);
        $this->view = new View;

        $this->db = new Database($config['db']);

        $primayValue = $this->session->get('user');

        if($primayValue) {
            $primayKey = $this->userClass::primaryKey();
            $this->user = $this->userClass::findOne([$primayKey => $primayValue]);
        } else {
            $this->user = null;
        }
    }

    public function run() {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    public function getController() {
        return $this->controller;
    }

    public function setController(Controller $controller) {
        $this->controller = $controller;
    }
    
    public function login(UserModel $user) {
        $this->user = $user;
        $primayKey = $user->primaryKey();
        $primayValue = $user->{$primayKey};
        $this->session->set('user', $primayValue);
        return true;
    }

    public function logout() {
        $this->user = null;
        $this->session->remove('user');
    }

    public static function isGuest() {
        return !self::$app->user;
    }
}