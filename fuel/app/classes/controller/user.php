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

/**
 * ログイン処理
 *
 * @package  app
 * @extends  Controller
 */
class Controller_User extends Controller
{
	/**
	 * ログイン画面
	 * @access  public
	 * @return  Response
	 */
	public function action_index()
	{
		// すでにログインしているか
		if (Auth::check()) {
			// ログインしていたらホームページへ
			return Response::forge(View::forge('note/home'));
		}
		return Response::forge(View::forge('login/index'));
	}

	/*
	 * ログイン処理
	 * @access  public
	 * @return  Response
	 */
	public function action_login()
	{
		// POSTリクエストの場合にのみ処理を実行する
		if (Input::method() == 'POST') {
			$val = Validation::forge('user_validation');

			// メールアドレスとパスワードを取得する
			$val->add('email', 'メールアドレス')
				->add_rule('required')
				->add_rule('valid_email');
			$val->add('password', 'パスワード')
				->add_rule('required');

			// メールアドレスとパスワードを検証する
			if ($val->run()) {
				// バリデーションに成功したフィールドと値の組を配列で取得
				$data = $val->validated();

				$auth = Auth::instance();
				if ($auth->login($data['email'], $data['password'])) {
					// ログイン成功時の処理
					return Response::forge(View::forge('note/home'));
				} else {
					// ログイン失敗時の処理
					$data['aiueo'] = 'メールアドレスまたはパスワードが正しくありません。';

					return Response::forge(View::forge('login/welcome', $data));
				}
			} else {
				// バリデーションチェックエラー
				$data['aiueo'] = 'バリデーションチェックエラー';
				return Response::forge(View::forge('login/welcome', $data));
			}
		}
		return Response::forge(View::forge('login/index'));
	}

	/*
	 * アカウント作成
	 * @access  public
	 * @return  Response
	 */
	public function action_create()
	{
		// すでにログインしているか
		if (Auth::check()) {
			// ログインしていたらホームページへ
			return Response::forge(View::forge('note/home'));
		}

		if (Input::method() == 'POST') {
			$val = Validation::forge('create_validation');

			// 名前、メールアドレス、パスワードを検証する
			$val->add('user_name', '名前')
				->add_rule('required');
			$val->add('email', 'メールアドレス')
				->add_rule('required')
				->add_rule('valid_email')
				->add_rule('match_value', $_POST['email_check']);
			$val->add('password', 'パスワード')
				->add_rule('required')
				->add_rule('match_value', $_POST['password_check']);

			// バリデーション実行
			if ($val->run()) {
				// バリデーションに成功した場合、dbに登録
				try {
					$created = Auth::create_user(
						Input::post('user_name'),
						Input::post('password'),
						Input::post('email'),
					);
					$data['aiueo'] = 'success';
				} catch (Exception $e) {
					$data['aiueo'] = $e->getMessage();
				}

				return Response::forge(View::forge('login/welcome', $data));
			} else {
				// バリデーション失敗時、作成ページへ
				$data['create_validation'] = false;
				return Response::forge(View::forge('login/create', $data));
			}
		} else {
			// POSTなし、"アカウント作成"から来た場合は作成ページへ
			return Response::forge(View::forge('login/create'));
		}
	}

	/*
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

	/*
	 * 登録情報変更
	 * @access  public
	 * @return  Response
	 *
	 * */
	public function action_reset()
	{
		require_once(__DIR__ . '../../../vendor/GoogleAuthenticator.php');
		$ga = new PHPGangsta_GoogleAuthenticator();

		// POSTリクエストの場合は認証チェック
		if (Input::method() == 'POST') {
			$onecode = Input::post('onecode');
			$secret = Session::get('secret');
			$checkResult = $ga->verifyCode($secret, $onecode, 3);
			if ($checkResult) {
				return Response::forge(View::forge('login/reset_account'));
			} else {
				$data['error'] = 'コードが間違っています。もう一度認証してください。';
			}
		}
		// POSTリクエストでない場合はコード生成
		$session = Session::instance('secret');
		$data['secret'] = $ga->createSecret();
		Session::set('secret', $data['secret']);

		// Google Charts URL のQRコード
		$data['qrcodeurl'] = $ga->getQRCodeGoogleUrl('ノートアプリ', $data['secret']);
		return Response::forge(View::forge('login/authenticator', $data));
	}

	public function action_change()
	{
		if (Input::method() == 'POST') {
			$val = Validation::forge('create_validation');

			// 名前、メールアドレス、パスワードを検証する
			// $val->add('user_name', '名前')
			// 	->add_rule('required');
			$val->add('password', 'パスワード')
				->add_rule('required')
				->add_rule('match_value', $_POST['password_check']);

			// バリデーション実行
			if ($val->run()) {
				// バリデーションに成功した場合、db更新
				try {
						Auth::update_user(
							array(
								'password' => Input::post('password'),
							)
					);
					$data['aiueo'] = 'success update';
				} catch (Exception $e) {
					$data['aiueo'] = $e->getMessage();
				}
				return Response::forge(View::forge('login/welcome', $data));
			} else {
				// バリデーション失敗時、作成ページへ
				$data['create_validation'] = false;
				return Response::forge(View::forge('login/reset_account', $data));
			}
		} else {
			// POSTなし、"アカウント作成"から来た場合は認証ページへ
			return Response::forge(View::forge('user_reset'));
		}
	}

	/*
	 * dbテスト
	 * @access  public
	 * @return  Response
	 *
	 * */
	public function action_testdb()
	{
		//$result = DB::query('SELECT user_id, user_name FROM `users` WHERE user_id = 2', DB::SELECT)->execute();
		$result = DB::select('*')->from('users')->as_assoc()->execute();
		//var_dump($result);
		$data['aiueo'] = 'testdb';
		return Response::forge(View::forge('login/welcome', $data));
	}

	public function action_insertdb()
	{

		list($insert_id, $rows_affected) = DB::insert('users')->set(array(
			'user_name' => 'John Random',
			'email' => 'jon@example.com',
			'password' => 's0_scr3t',
		))->execute();
	}

	/*
	 * The 404 action for the application.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_404()
	{
		return Response::forge(View::forge('login/404'), 404);
	}

}
