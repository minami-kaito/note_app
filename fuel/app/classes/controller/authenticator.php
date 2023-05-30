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
 * Google Authenticatorに関する処理
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Authenticator extends Controller
{
    /**
     * Google Authenticatorを使うための初期処理
     * @access  public
     * @return  Response
     *
     * */
    public function before()
    {
        require_once(__DIR__  .'/../../vendor/GoogleAuthenticator.php');
        $ga = new PHPGangsta_GoogleAuthenticator();
		Session::delete('ga');
        Session::set('ga', $ga);
    }

    /**
     * パスワードリセットのための認証確認
     * @access  public
     * @return  Response
     *
     * */
    public function action_check()
    {
        $ga = Session::get('ga');

        // POSTリクエストでない場合は入力ページへ
        if (Input::method() != 'POST') 
        {
            return Response::forge(View::forge('authen/index'));
        }

        $onecode = Input::post('onecode');

        $val = Validation::forge('user_validation');
        $val->add('email', 'メールアドレス')
            ->add_rule('required')
            ->add_rule('valid_email');

        if (!$val->run()) 
        {
            $data['error'] = 'バリデーションチェックエラー';
            return Response::forge(View::forge('authen/index', $data));
        }
    
        $value = $val->validated();
        $email = $value['email'];

        $secret = User::get_key($email);

        // 一致するメールアドレスがなかった場合
        if (empty($secret)) 
        {
            $data['error'] = 'メールアドレスが正しくないか、認証登録されていません。';
            return Response::forge(View::forge('authen/index', $data));
        }

        // 認証チェック
        $checkResult = $ga->verifyCode($secret[0]['authenticator'], $onecode, 3);
        if ($checkResult) 
        {
            // 本当はここでセッションに保存し、update_userに使いたい
            //Session::set('email', $email);
            $data['email'] = $email;
            return Response::forge(View::forge('login/reset', $data));
        } 
        else 
        {
            $data['error'] = 'コードが間違っているか、認証登録されていません。';
            return Response::forge(View::forge('authen/index', $data));
        }
    }

    /**
     * シークレットキーからQRコードを生成する。
     * シークレットキーがない場合は、シークレットキーを作成し、QRコードを生成する。
     * @access  public
     * @return  Response
     *
     * */
    public function action_change()
    {
        $ga = Session::get('ga');
        $email = Auth::get('email');

        $secret = User::get_key($email);

        // シークレットキーがすでに保存されているか
        if (isset($secret[0]['authenticator'])) 
        {
            $key = $secret[0]['authenticator'];
            $data['qrcodeurl'] = $ga->getQRCodeGoogleUrl($email, $key, 'ノートアプリ');
            return Response::forge(View::forge('authen/change', $data));
        }

		// シークレットキーがなければ新しく生成し、保存
        $key = $ga->createSecret();

        $result = User::save_key($email, $key);

        if ($result) 
        {
            $data['qrcodeurl'] = $ga->getQRCodeGoogleUrl($email, $key, 'ノートアプリ');
            return Response::forge(View::forge('authen/change', $data));
        } 
        else 
        {
            $data['result'] = 'キーの保存に失敗しました。QRコードを新しく生成してください。';
            return Response::forge(View::forge('authen/change', $data));
        }
    }

    /**
     * シークレットキーを変更する
     * @access  public
     * @return  Response
     *
     * */
    public function action_reset()
    {
        $ga = Session::get('ga');
        $email = Auth::get('email');

        // 新しいシークレットキーを保存する
        $key = $ga->createSecret();
        $result = User::save_key($email, $key);

        if ($result) 
		{
            $data['qrcodeurl'] = $ga->getQRCodeGoogleUrl($email, $key, 'ノートアプリ');
            return Response::forge(View::forge('authen/change', $data));
        }
		else
		{
            $data['result'] = 'キーの保存に失敗しました。QRコードを新しく生成してください。';
            return Response::forge(View::forge('authen/change', $data));
		}
    }

    /**
     * キーが正しく入力できているかのテスト
     * @access  public
     * @return  Response
     *
     * */
    public function action_test()
    {
		$ga = Session::get('ga');
        $onecode = Input::post('onecode');
        $email = Auth::get('email');

        $secret = User::get_key($email);

        $checkResult = $ga->verifyCode($secret[0]['authenticator'], $onecode, 3);
        if ($checkResult) 
		{
            $data['result'] = 'OK!';
        } 
        else 
		{
            $data['result'] = 'コードが間違っています。もう一度入力してください。または、QRコードを新しく生成してください。';
        }
        return Response::forge(View::forge('authen/change', $data));
    }

}
