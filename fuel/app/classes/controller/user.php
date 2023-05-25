<?php

/**
 * Fuel is a fast, lightweight, community driven PHP 5.4+ framework.
 *
 * @package    Fuel
 * @version    1.9-dev
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2019 Fuel Development Team
 * @link       https://fuelphp.com
 */

use Fuel\Core\Response;
use \Model\User;

/**
 * ユーザーに関する処理
 *
 * @package  app
 * @extends  Controller
 */
class Controller_User extends Controller
{
    /**
     * ログイン中かチェック
     * @access  public
     * @return  Response
     *
     * */
    public function before()
    {
        if (Auth::check()) {
            return Response::forge(View::forge('note/home'));
        }
    }

    /**
     * ログイン画面へ
     * @access  public
     * @return  Response
     */
    public function action_index()
    {
		if (Auth::check()) {
            return Response::forge(View::forge('note/home'));
        }
        return Response::forge(View::forge('login/index'));
    }

    /**
     * ログイン処理
     * @access  public
     * @return  Response
     */
    public function action_login()
    {
		// POSTリクエストでない場合は入力ページへ
        if (Input::method() != 'POST') {
            return Response::forge(View::forge('login/index'));
        }

        $val = Validation::forge('user_validation');
        $val->add('email', 'メールアドレス')
            ->add_rule('required')
            ->add_rule('valid_email');
        $val->add('password', 'パスワード')
            ->add_rule('required');

        if (!$val->run()) {
            $data['login_error'] = 'バリデーションチェックエラー';
            return Response::forge(View::forge('login/index', $data));
        }

        $value = $val->validated();
        $auth = Auth::instance();
		
		// ログイン検証
        if ($auth->login($value['email'], $value['password'])) {
            return Response::forge(View::forge('note/home'));
        } else {
            $data['login_error'] = 'メールアドレスまたはパスワードが正しくありません。';
            return Response::forge(View::forge('login/index', $data));
        }
    }

    /**
     * アカウント作成
     * @access  public
     * @return  Response
     */
    public function action_create()
    {
		// POSTリクエストでない場合は入力ページへ
        if (Input::method() != 'POST') {
            return Response::forge(View::forge('login/create'));
        }

        $val = Validation::forge('create_validation');

        $val->add('user_name', '名前')
            ->add_rule('required');
        $val->add('email', 'メールアドレス')
            ->add_rule('required')
            ->add_rule('valid_email')
            ->add_rule('match_value', $_POST['email_check']);
        $val->add('password', 'パスワード')
            ->add_rule('required')
            ->add_rule('match_value', $_POST['password_check']);

        if (!$val->run()) {
            $data['error'] = 'バリデーションエラー';
            return Response::forge(View::forge('login/create', $data));
        }

        //バリデーション成功時、DBにユーザー登録
		$value = $val->validated();
        try {
            Auth::create_user(
                $value['user_name'],
                $value['password'],
                $value['email'],
            );
            $data['result'] = 'データ登録完了';
        } catch (Exception $e) {
            $data['result'] = $e->getMessage();
            return Response::forge(View::forge('login/create', $data));
        }
        return Response::forge(View::forge('login/welcome', $data));
    }

    /**
     * ログアウト
     * @access  public
     * @return  Response
     *
     * */
    public function action_logout()
    {
        Auth::logout();
        return Response::forge(View::forge('login/index'));
    }

    /**
     * アカウント情報の変更(名前)
     * @access  public
     * @return  Response
     *
     * */
    public function action_change_name()
    {
		// POSTリクエストでない場合は入力ページへ
        if (Input::method() != 'POST') {
            return Response::forge(View::forge('login/change-name'));
        }

        $val = Validation::forge('create_validation');
        $val->add('user_name', '名前')
            ->add_rule('required');

        // バリデーション実行
        if (!$val->run()) {
            $data['error'] = 'バリデーションエラー';
            return Response::forge(View::forge('login/change-name', $data));
        }

		$value = $val->validated();
        $email = Auth::get('email');

        $result = Auth::update_user($value, $email);
        if ($result) {
            $data['result_name'] = '名前を変更しました。';
            return Response::forge(View::forge('note/home', $data));
        } else {
            $data['result_name'] = '名前の変更に失敗しました。';
            return Response::forge(View::forge('note/home', $data));
        }
    }

    /**
     * アカウント情報の変更(パスワード)
     * @access  public
     * @return  Response
     *
     * */
    public function action_change_pass()
    {
		// POSTリクエストでない場合は入力ページへ
        if (Input::method() != 'POST') {
            return Response::forge(View::forge('login/change-pass'));
        }

        $val = Validation::forge('create_validation');
        $val->add('password', 'パスワード')
            ->add_rule('required')
            ->add_rule('match_value', Input::post('password_check'));

        // バリデーション実行
        if (!$val->run()) {
            $data['error'] = 'バリデーションエラー';
            return Response::forge(View::forge('login/change-pass', $data));
        }

		$value = $val->validated();
        $email = Auth::get('email');

        $result = Auth::update_user($value, $email);
        if ($result) {
            $data['result'] = 'パスワードを変更しました。';
            Auth::logout();
            return Response::forge(View::forge('login/index', $data));
        } else {
            $data['error'] = '変更に失敗しました。';
            return Response::forge(View::forge('login/change-pass', $data));
        }

    }

    /**
     * アカウント情報の変更(リセット)
     * @access  public
     * @return  Response
     *
     * */
    public function action_reset()
    {
		// POSTリクエストでない場合は入力ページへ
        if (Input::method() != 'POST') {
            return Response::forge(View::forge('authen/index'));
        }

        $val = Validation::forge('create_validation');
        $val->add('password', 'パスワード')
            ->add_rule('required')
            ->add_rule('match_value', Input::post('password_check'));

		// sessionが使えたらこれは不要
		$email = Input::post('email');

        // バリデーション実行
        if (!$val->run()) {
			$data['email'] = $email;
            $data['error'] = 'バリデーションエラー';
            return Response::forge(View::forge('login/reset', $data));
        }

		$value = $val->validated();
		// ここでsessionにあるメールを取得したいが、消えてしまっている
        //$email = Session::get('email');
        $result = Auth::update_user($value, $email);

        if ($result) 
		{
            $data['result'] = 'パスワードの変更が完了しました。';
            return Response::forge(View::forge('login/index', $data));
        } else {
			$data['email'] = $email;
            $data['error'] = '更新に失敗しました。';
            return Response::forge(View::forge('login/reset', $data));
        }
    }

    /**
     * アカウント削除
     * @access  public
     * @return  Response
     *
     * */
    public function action_delete()
    {
		// POSTリクエストでない場合は確認ページへ
        if (Input::method() != 'POST') {
			return Response::forge(View::forge('login/delete'));
		}

		// 紐づいているノートの削除
		$db_result = User::check_foreign_key(Auth::get('user_id'));
		
		if ($db_result) {
			Auth::delete_user(Input::post('email'));
			$data['result'] = 'アカウント削除が完了しました';
			return Response::forge(View::forge('login/index', $data));
		}
		else
		{
			$data['error'] = '削除に失敗しました。';
			return Response::forge(View::forge('login/delete', $data));
		}
    }

    /**
     * The 404 action for the application.
     *
     * @access  public
     * @return  Response
     */
    public function action_404()
    {
        return Response::forge(Presenter::forge('welcome/404'), 404);
    }
}
