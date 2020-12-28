<?php 

namespace app\models;

use app\core\Application;
use app\core\Model;

class LoginForm extends Model {
    public string $email = '';
    public string $pwd = '';

    public function rules(): array {
        return [
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'pwd' => [self::RULE_REQUIRED]
        ];
    }

    public function labels(): array {
        return [
            'email' => 'Email',
            'pwd' => 'Password'
        ];
    }

    public function login() {
        $user = User::findOne(['email' => $this->email]);

        if(!$user) {
            $this->addError('email', 'User does not exist with this email');
            return false;
        }

        if(!password_verify($this->pwd, $user->pwd)) {
            $this->addError('pwd', 'Password is incorrect');
            return false;
        };

        return Application::$app->login($user);
    }
}