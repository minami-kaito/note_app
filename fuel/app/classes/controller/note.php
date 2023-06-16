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
use Fuel\Core\Validation;
use \Model\Note;
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
     * ログインしているかのチェック
     * @access  public
     *
     * */
    public function before()
    {
        // ログインしていなかったらログインページへ
		if (!Auth::check()) 
		{
            return Response::redirect('user/index');
        }
    }

	/**
	 *ホームページに戻る
	 * @access  public
	 * @return  Response
	 */
	public function action_home()
	{
		$data['result'] = Note::note_list(Auth::get('user_id'));

		return Response::forge(View::forge('note/home', $data));
	}


	/**
	 * 新規ノート作成
	 * The basic welcome message
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_create()
	{
		$result = Note::new_note(Auth::get('user_id'));
		$data['current_note'] = $result[0];
		$content = '';
		Note::save_version($data['current_note'], $content);
		$data['result'] = Note::edit_page($data['current_note']);

		return Response::forge(View::forge('note/page', $data));
	}

	/**
	 * ノートの保存
	 * The basic welcome message
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_save()
	{
		// POSTリクエストでない場合はホームページへ
        if (Input::method() != 'POST') 
        {
            return Response::redirect('note/home');
        }

		$note_id = Input::post('note_id');

		// ノートの作成者かチェック
		$result_userid = Note::check_note($note_id);
		if ($result_userid[0]['user_id'] != Auth::get('user_id'))
		{
			$data['result'] = Note::note_list(Auth::get('user_id'));
			return Response::forge(View::forge('note/home', $data));
		}

		$tags = Input::post('tag', '');
		// タグが入力されているならチェック
		if ($tags !== '') 
		{
			$tag_result = $this->action_check_tag($tags, $note_id);
		}
		// タグが入力されていないなら、問題なし
		else 
		{
			$tag_result = true;
		}

		// 入力したタグが正規表現と一致しなかった場合
		if (!$tag_result)
		{
			$data['tag_error'] = 'タグは先頭に"#"をつけてください。
			複数入力する場合は、スペースで区切ってください。';
		}
		
		$val = Validation::forge();
		$val->add('title', 'タイトル')
			->add_rule('required');

		// バリデーションチェック
		if (!$val->run()) 
		{
			$data['error'] = 'タイトルを入力してください';
			$data['current_note'] = $note_id;
			$data['result'] = Note::edit_page($data['current_note']);
			return Response::forge(View::forge('note/page', $data));
		}
			
		$title = Input::post('title');
		$content = Input::post('content');
		$share_flag = Input::post('share');

		// ノートの保存
		Note::save_note($note_id, $title, $content, $share_flag);
			 
		// 履歴の保存
		$this->action_save_version($note_id, $content);

		$data['result_save'] = '保存が完了しました';
		$data['current_note'] = $note_id;
		$data['result'] = Note::edit_page($data['current_note']);

		return Response::forge(View::forge('note/page', $data));
	}

	/**
	 * タグのリンク
	 *
	 * @access  private
	 */
	private function action_link_tag(array $tag, string $note_id)
	{
		foreach ($tag[0] as $tag_name) 
		{
			// 先頭の＃を取り除く
			$tag_name = substr($tag_name, 1);
			$existing_id = Note::get_tag($tag_name);

			// 新しいタグの場合
			if ($existing_id == null) 
			{
				$new_tag_id = Note::save_tag($tag_name);
				Note::link_tag($note_id, $new_tag_id[0]);
			} 
			// 既存タグの場合
			else 
			{
				$link_id = Note::get_linkid($note_id, $existing_id[0]['tag_id']);

				// まだ紐づいてないなら、新規紐づけ
				if ($link_id == null) 
				{
					Note::link_tag($note_id, $existing_id[0]['tag_id']);
				}
			}
		} 
	}

	/**
	 * タグのチェック
	 *
	 * @access  private
	 */
	private function action_check_tag(string $tags, int $note_id)
	{
		// 正規表現で確認、区切る
		preg_match_all('/#[^\s\xE38080]+/u', $tags, $tag);

		if($tag[0] == null)
		{
			return false;
		}

		// タグのリンク、保存
		$this->action_link_tag($tag, $note_id);

		return true;	
	}

	/**
	 * 履歴の保存
	 *
	 * @access  private
	 */
	private function action_save_version(int $note_id, string $content)
	{
		$version_result = Note::list_versions($note_id);
		$count_versions = count($version_result);

		// 履歴が5個未満なら登録
		if ($count_versions < 5) 
		{
			Note::save_version($note_id, $content);
		} 
		// 5個以上なら一番古いものと入れ替える
		else 
		{
			Note::update_version($note_id, $content, $version_result[4]['version_at']);
		}
	}

	/**
	 *ノートページを開く
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_page()
	{
		$data['current_note'] = Input::get('noteid');
		$data['result'] = Note::edit_page($data['current_note']);

		if ($data['result'][0]['user_id'] != Auth::get('user_id'))
		{
			$data['result'] = Note::note_list(Auth::get('user_id'));
			return Response::forge(View::forge('note/home', $data));
		}

		return Response::forge(View::forge('note/page', $data));
	}

	/**
	 * ノートの削除
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_delete()
	{
		$note_id = Input::get('noteid');

		// ノートの作成者かチェック
		$result_userid = Note::check_note($note_id);
		if ($result_userid[0]['user_id'] != Auth::get('user_id'))
		{
			$data['result'] = Note::note_list(Auth::get('user_id'));
			return Response::forge(View::forge('note/home', $data));
		}

		Note::delete_note($note_id);
		$data['delete_result'] = 'ノートを削除しました';
		$data['result'] = Note::note_list(Auth::get('user_id'));

		return Response::forge(View::forge('note/home', $data));
	}

	/**
	 * 履歴から復元
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_restoration()
	{
		// GET,POSTじゃないなら、ホームへ
		if (Input::method() != 'POST' and Input::method() != 'GET') 
		{
			$data['result'] = Note::note_list(Auth::get('user_id'));
			return Response::forge(View::forge('note/home', $data));
		}

		// 最終確認、okなら履歴の復元
		if (Input::post('confirm') == 'ok')
		{
			$version_id = Input::post('version_id');

			$select_version = Note::get_version($version_id);

			Note::restoration_note($select_version[0]['note_id'], $select_version[0]['version_content']);

			Note::delete_restoration($version_id);

			$data['current_note'] = $select_version[0]['note_id'];
			$data['result'] = Note::edit_page($data['current_note']);
			$data['result_version'] = '復元しました。'; 

			return Response::forge(View::forge('note/page', $data));
		}

		// 一覧から選んだ後、最終確認へ
		if (Input::get('verid') != null) 
		{
			$version_id = Input::get('verid');
			$data['result'] = Note::get_version($version_id);

			return Response::forge(View::forge('note/restocheck', $data));
		}
		// 最初に訪れた時、バージョン一覧へ
		else
		{
			$note_id = Input::get('noteid');
			$data['versions'] = Note::list_versions($note_id);
			$data['note_id'] = $note_id;

			return Response::forge(View::forge('note/restoration', $data));
		}
	}

	/**
	 * タグの削除
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_delete_tag()
	{
		$tag_name = Input::get('tagname');
		$note_id = Input::get('noteid');

		// ノートの作成者かチェック
		$result_userid = Note::check_note($note_id);
		if ($result_userid[0]['user_id'] != Auth::get('user_id'))
		{
			$data['result'] = Note::note_list(Auth::get('user_id'));
			return Response::forge(View::forge('note/home', $data));
		}

		Note::delete_note_tag($tag_name, $note_id);
		$data['current_note'] = $note_id;
		$data['result'] = Note::edit_page($data['current_note']);

		return Response::forge(View::forge('note/page', $data));
	}

	/**
	 * 閲覧用ページ
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_browse()
	{
		$data['current_note'] = Input::get('noteid');
		$data['result'] = Note::edit_page($data['current_note']);
		$result = $data['result'];

		// ノートが共有⇒閲覧ページへ
		if ($result[0]['share_flag'])
		{
			return Response::forge(View::forge('note/browse', $data));
		}

		// ノートが非共有⇒作成者か確認
		if ($result[0]['user_id'] == Auth::get('user_id'))
		{
			$editor = true;
		}
		else
		{
			$editor = false;
		}

		// 非共有でも作成者なら閲覧可
		if (!$result[0]['share_flag'] and $editor)
		{
			return Response::forge(View::forge('note/browse', $data));
		}
		else
		{
			return Response::forge(View::forge('note/home'));
		}
	}

	/**
	 * ノート、タグ検索
	 *
	 * @access  public
	 * @return  Response
	 */
	public function action_search()
	{
		// スペースのみの場合空文字に変換
		$val_text = Input::get('search');
		$val_text = preg_replace("/\s*|　*/", '', $val_text);

		if ($val_text == '' )
		{
			$data['search_empty'] = '入力がされていません。';
			$data['result'] = Note::note_list(Auth::get('user_id'));
			return Response::forge(View::forge('note/home', $data));
		}
				
		// タグを#ごと切り取る
		preg_match_all('/(^#[^\s\xE38080]+)|([\s\xE38080]#[^\s\xE38080]+)/u', Input::get('search'), $tag);

		// タグ以外はタイトルの検索として切り取る
		preg_match_all('/(^[^#][^\s\xE38080]*)|([\s\xE38080][^#][^\s\xE38080]*)/u', Input::get('search'), $title);

		// タイトルの検索
		if (isset($title))
		{
			$result_title = Note::search_result_title($title, Auth::get('user_id'));
		}	

		// タグの検索
		if (isset($tag))
		{
			$result_tag = Note::search_result_tag($tag, Auth::get('user_id'));
		}

		// 結果：タイトル検索かつタグ検索
		if(($result_title != null) and ($result_tag != null))
		{
			$note_id = array();
			foreach($result_title as $re_title)
			{
				array_push($note_id, (string)$re_title['note_id']);
			}
			foreach($result_tag as $re_tag)
			{
				array_push($note_id, (string)$re_tag['note_id']);
			}
			$note_id = array_unique($note_id);

			$data['result'] = Note::search_list($note_id);
			$data['search_text'] = Input::get('search');

			return Response::forge(View::forge('note/search', $data));
		}

		// 結果：タイトル検索のみ
		if($result_title != null)
		{
			$note_id = array();
			foreach($result_title as $re_title)
			{
				array_push($note_id, (string)$re_title['note_id']);
			}
			$note_id = array_unique($note_id);

			$data['result'] = Note::search_list($note_id);
			$data['search_text'] = Input::get('search');

			return Response::forge(View::forge('note/search', $data));
		}

		// 結果：タグ検索のみ
		if($result_tag != null)
		{
			$note_id = array();
			foreach($result_tag as $re_tag)
			{
				array_push($note_id, (string)$re_tag['note_id']);
			}
			$note_id = array_unique($note_id);

			$data['result'] = Note::search_list($note_id);
			$data['search_text'] = Input::get('search');

			return Response::forge(View::forge('note/search', $data));
		}

		$data['search_empty'] = '検索に一致するものがありませんでした。';
		$data['result'] = Note::note_list(Auth::get('user_id'));
		return Response::forge(View::forge('note/home', $data));
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
