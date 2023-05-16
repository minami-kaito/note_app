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
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Note extends Controller
{
	/**
	 * The basic welcome message
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_create()
	{
		if(Input::method() == 'POST') {
			$val = Validation::forge('create_validation');
			$val->add('title', 'タイトル')
				->add_rule('required');
			
			if($val->run()){
				try {
					$title = Input::post('title');
					$content = Input::post('content');
					$user_id = Auth::get('user_id');
					DB::insert('notes')->set(array(
						'user_id' => $user_id,
						'title' => $title,
						'content' => $content,
						'share_flag' => 0,
					))->execute();
					$data['aiueo'] = '保存が完了しました';
				} catch (Exception $e) {
					$data['aiueo'] = $e->getMessage();
				}
				return Response::forge(View::forge('note/note_page', $data));
			}else{
				$data['aiueo'] = 'タイトルを入力してください';
				return Response::forge(View::forge('note/note_page', $data));
			}
		}else{
			// POSTなし最初に訪れた時
			try {
				$title = '新規ノート';
				$user_id = Auth::get('user_id');
				DB::insert('notes')->set(array(
					'user_id' => $user_id,
					'title' => $title,
					'share_flag' => 0,
				))->execute();
				return Response::forge(View::forge('note/note_page'));
			} catch (Exception $e) {
				$data['aiueo'] = $e->getMessage();
				return Response::forge(View::forge('note/home', $data));
			}
		}
	}

	/**
	 * A typical "Hello, Bob!" type example.  This uses a Presenter to
	 * show how to use them.
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_page_edit()
	{
		return Response::forge(Presenter::forge('welcome/hello'));
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
