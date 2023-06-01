<?php
namespace Model;

use Exception;

class Note extends \Model

{
    /**
	 * ノートの一覧を取得する
	 *
	 * @access  public
     */
    public static function note_list($user_id)
    {  
        $result = \DB::select(
            'users.user_id',
            'notes.note_id',
            'notes.title',
            'notes.updated_at',
            \DB::expr('group_concat(tags.tag_name) as tag_name')
        )   
        ->from('notes')
        ->join('users', 'INNER')
        ->on('notes.user_id', '=', 'users.user_id')
        ->join('note_tags', 'LEFT')
        ->on('note_tags.note_id', '=', 'notes.note_id')
        ->join('tags', 'LEFT')
        ->on('tags.tag_id', '=', 'note_tags.tag_id')
        ->where('users.user_id', '=', $user_id)
        ->group_by('notes.note_id')
        ->order_by('notes.updated_at', 'dasc')
        ->execute()
        ->as_array();
            
            return $result;
    }

    /**
	 * ノートを取得する（編集ページ）
	 *
	 * @access  public
     */
    public static function edit_page($note_id)
    {
        $result = \DB::select(
            'users.user_id',
            'notes.note_id',
            'users.user_name',
            'notes.title',
            \DB::expr('group_concat(tags.tag_name) as tag_name'),
            'notes.content',
            'notes.updated_at',
            'notes.share_flag'
        )
        ->from('notes')
        ->join('users', 'INNER')
        ->on('notes.user_id', '=', 'users.user_id')
        ->join('note_tags', 'LEFT')
        ->on('note_tags.note_id', '=', 'notes.note_id')
        ->join('tags', 'LEFT')
        ->on('tags.tag_id', '=', 'note_tags.tag_id')
        ->where('notes.note_id', '=', $note_id)
        ->group_by('notes.note_id')
        ->execute()
        ->as_array();

        return $result;
    }

    /**
	 * ノートの削除
	 *
	 * @access  public
     */
    public static function delete_note($note_id)
    {
        // 紐づいているタグを全て削除
        \DB::delete('note_tags')
            ->where('note_id', '=', $note_id)
            ->execute();

        // ノートの履歴を消す
        \DB::delete('versions')
            ->where('note_id', '=', $note_id)
            ->execute();

        // ノートを消す
        \DB::delete('notes')
            ->where('note_id', '=', $note_id)
            ->execute();
        return ;
    }

    /**
	 * ノートを全て削除
	 *
	 * @access  public
     */
    public static function delete_allNote($user_id)
    {
       
        // ユーザーの全てのノートIDを取得
        $result = \DB::select('note_id')
        ->from('notes')
        ->where('user_id', '=', $user_id)
        ->execute()
        ->as_array();

        if (count($result) === 0)
        {
            return ;
        }

        // ノートを削除
        foreach ($result as $t) 
        {
            $note_id = $t['note_id'];
            Note::delete_note($note_id);
        }
        return ;
    }

    /**
	 * 新しくノートを作成
	 *
	 * @access  public
     */
    public static function new_note($user_id)
    {
        $result = \DB::insert('notes')->set(array(
            'user_id' => $user_id,
            'title' => '新規ノート'
            ))->execute();
            
            return $result;
    }
        
    /**
     * ノートの保存
     *
     * @access  public
     */
    public static function save_note($note_id, $title, $content, $share)
    {
        \DB::update('notes')->set(array(
            'title' => $title,
            'content' => $content,
            'share_flag' => $share
        ))->where('note_id', '=', $note_id)
        ->execute();
        return ;
    }

    /**
	 * 名前が一致するタグのIDを取得
	 *
	 * @access  public
     */
    public static function get_tag($tag_name)
    {
        $result = \DB::select('tag_id')
        ->from('tags')
        ->where('tag_name', '=', $tag_name)
        ->execute()
        ->as_array();

        return $result;
    }

    /**
	 * タグの保存
	 *
	 * @access  public
     */
    public static function save_tag($tag_name)
    {
        $result = \DB::insert('tags')->set(array(
            'tag_name' => $tag_name
        ))->execute();

        return $result;
    }


    /**
	 * タグをノートと紐付ける
	 *
	 * @access  public
     */
    public static function link_tag($note_id, $tag_id)
    {
        \DB::insert('note_tags')->set(array(
            'note_id' => $note_id,
            'tag_id' => $tag_id
        ))->execute();
        
        return ;
    }

    /**
	 * タグとノートが紐づいているものを取得
	 *
	 * @access  public
     */
    public static function get_linkid($note_id, $tag_id)
    {
        $result = \DB::select('note_tag_id')
        ->from('note_tags')
        ->where('note_id', '=', $note_id)
        ->and_where('tag_id', '=', $tag_id)
        ->execute()
        ->as_array();

        return $result;
    }

    /**
	 * タグの紐づけ削除
	 *
	 * @access  public
     */
    public static function delete_note_tag($tag_name, $note_id)
    {
        $result = \DB::select('note_tags.note_tag_id')
        ->from('note_tags')
        ->join('tags', 'INNER')
        ->on('note_tags.tag_id', '=', 'tags.tag_id')
        ->where('tags.tag_name', '=', $tag_name)
        ->and_where('note_tags.note_id', '=', $note_id)
        ->execute()
        ->as_array();

        \DB::delete('note_tags')
        ->where('note_tag_id', '=', $result[0]['note_tag_id'])
        ->execute();

        return ;
    }

    /**
	 * 履歴の保存
	 *
	 * @access  public
     */
    public static function save_version($note_id, $content)
    {
        \DB::insert('versions')->set(array(
            'note_id' => $note_id,
            'version_content' => $content
        ))->execute();

        return ;
    }

    /**
	 * 履歴の更新
	 *
	 * @access  public
     */
    public static function update_version($note_id, $content, $old_version)
    {
        \DB::update('versions')->set(array(
            'version_content' => $content
        ))->where('note_id', '=', $note_id)
        ->and_where('version_at', '=', $old_version)
        ->execute();

        return ;
    }

    /**
	 * 選択されたノートの履歴一覧取得
	 *
	 * @access  public
     */
    public static function list_versions($note_id)
    {
        $result = \DB::select('*')
        ->from('versions')
        ->where('note_id', '=', $note_id)
        ->order_by('version_at', 'dasc')
        ->execute()
        ->as_array();

        return $result;
    }

    /**
	 * 選択された履歴の取得
	 *
	 * @access  public
     */
    public static function get_version($version_id)
    {
        $result = \DB::select('*')
        ->from('versions')
        ->where('version_id', '=', $version_id)
        ->execute()
        ->as_array();

        return $result;
    }

    /**
	 * 履歴の復元
	 *
	 * @access  public
     */
    public static function restoration_note($note_id, $veriosn_content)
    {
        \DB::update('notes')->set(array(
            'content' => $veriosn_content
        ))->where('note_id', '=', $note_id)
        ->execute();
    }

    /**
	 * 履歴の削除
	 *
	 * @access  public
     */
    public static function delete_restoration($version_id)
    {
        \DB::delete('versions')
        ->where('version_id', '=', $version_id)
        ->execute();

        return ;
    }

    /**
	 * ノートタイトルの検索
	 *
	 * @access  public
     */
    public static function search_result_title(array $title)
    {
    
        error_log(print_r($title,true),"3","/home/minami/note_app/debug.log");

        $query = \DB::select('note_id')
        ->from('notes')
        ->where('note_id', '=', '0');
        
        foreach($title[0] as $ti)
        {
            // 先頭にスペースがあれば削除
            $ti = preg_replace("/\s|　+/", "", $ti);
            $query->or_where('title', 'like', '%' .$ti .'%');
        }
        
        $result = $query->execute()->as_array();
        error_log(print_r(\DB::last_query(),true),"3","/home/minami/note_app/debug.log");

        return $result;
    }

    /**
	 * タグの検索
	 *
	 * @access  public
     */
    public static function search_result_tag(array $tag)
    {
        $query = \DB::select('note_tags.note_id')
        ->from('note_tags')
        ->join('tags', 'INNER')
        ->on('tags.tag_id', '=', 'note_tags.tag_id')
        ->where('tags.tag_id', '=', '0');
        foreach($tag[0] as $ta)
        {
            // 先頭の#とスペースがあれば削除
            $ta = preg_replace("/(\s|　+#)|(#)/", "", $ta);
            $query->or_where('tags.tag_name', '=', $ta);
        }
        $result = $query->execute()->as_array();
        
        return $result;
    }
    
    /**
	 * ノートの検索結果一覧を取得する
	 *
	 * @access  public
     */
    public static function search_list($note_id)
    {  
        $query = \DB::select(
            'notes.note_id',
            'notes.title',
            'notes.updated_at',
            \DB::expr('group_concat(tags.tag_name) as tag_name')
        )   
        ->from('notes')
        ->join('users', 'INNER')
        ->on('notes.user_id', '=', 'users.user_id')
        ->join('note_tags', 'LEFT')
        ->on('note_tags.note_id', '=', 'notes.note_id')
        ->join('tags', 'LEFT')
        ->on('tags.tag_id', '=', 'note_tags.tag_id')
        ->where('users.user_id', '=', 0);

        foreach($note_id as $id)
        {
            $query->or_where('notes.note_id', '=', $id);
        }
        $result = $query->group_by('notes.note_id')
        ->execute()
        ->as_array();
            
            return $result;
    }
}
