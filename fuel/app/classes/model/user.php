<?php
namespace Model;

use Exception;

class User extends \Model

{
    /**
     * ユーザーテーブルからor条件でセレクト
     * @access  private
     *
     * $colmnで取得するカラムを、$whereで条件を受け取る
     * */
    private static function select_user_orwhere(string $colmn, array $where)
    {
        try
        {
            $query = \DB::select($colmn)->from('users')->where('user_id', '=', 0);

            foreach ($where as $key => $value) 
            {
                $query->or_where($key, '=', $value);
            }

            $result = $query->execute()->as_array();

            // 引数で受け取ったカラムを返す
            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * ユーザーテーブルをor条件でアップデート
     * @access  private
     *
     * $colmnで更新するカラムを、$whereで条件を受け取る
     * */
    private static function update_user_orwhere(array $colmns, array $where)
    {
        try
        {
            $query = \DB::update('users')->set($colmns)->where('user_id', '=', 0);

            foreach ($where as $key => $value) {
                $query->or_where($key, '=', $value);
            }

            // 更新したカラムのあるuser_idを返す
            $result = $query->execute();

            return $result;

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * シークレットキーの取得
     * @access  public
     *
     * */
    public static function get_key(string $email)
    {
        try
        {
            $colmn = 'authenticator';
            $where = array(
                'email' => $email,
            );

            // シークレットキーを返す
            return User::select_user_orwhere($colmn, $where);

        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * シークレットキーの保存（元々あれば上書き保存）
     * @access  public
     *
     * */
    public static function save_key(string $email, string $key)
    {
        try
        {
            $colmns = array(
                'authenticator' => $key,
            );
            $where = array(
                'email' => $email,
            );

            // 保存に成功したユーザーidを返す
            return User::update_user_orwhere($colmns, $where);

        } catch (Exception $e) {
            throw $e;
        }
    }
}
