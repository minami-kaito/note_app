<?php

use Fuel\Core\Response;
use Fuel\Core\Validation;
use \Model\Note;

class Controller_Api extends Controller_Rest
{
    /**
	 * タグの削除
	 *
	 * @access  public
	 * @return  Response
	 */
	public function get_delete_tag()
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

		return $this->response(array(
			'success' => true,
			'tag' => $tag_name,
		));
	}
}