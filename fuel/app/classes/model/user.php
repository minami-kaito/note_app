<?php
namespace Model;

use Exception;

class User extends \Model
{
    /**
     * ユーザーテーブルからor条件でセレクト
     * @access  private
     * @return  Response
     *
     * */
    private static function select_user_orwhere(string $colmn, array $where)
    {
        $query = \DB::select($colmn)->from('users')->where('user_id', '=', 0);

        foreach($where as $key => $value)
        {
            $query->or_where($key, '=', $value);
        }

        $result = $query->execute()->as_array();
        
        return $result;
    }

    /**
     * ユーザーテーブルからor条件でアップデート
     * @access  private
     * @return  Response
     *
     * */
    private static function update_user_orwhere(array $colmns, array $where)
    {
        $query = \DB::update('users')->set($colmns)->where('user_id', '=', 0);

        foreach($where as $key => $value)
        {
            $query->or_where($key, '=', $value);
        }

        $result = $query->execute();
        
        return $result;
    }

    /**
     * シークレットキーの取得
     * @access  public
     * @return  Response
     *
     * */
    public static function get_key($email)
    {
        $colmn = 'authenticator';
        $where = array(
            'email' => $email,
        );
        
        return User::select_user_orwhere($colmn, $where);
    }

    /**
     * シークレットキーの保存（元々あれば上書き保存）
     * @access  public
     * @return  Response
     *
     * */
    public static function save_key($email, $key)
    {
        $colmns = array(
            'authenticator' => $key,
        );
        $where = array(
            'email' => $email,
        );
        
        return User::update_user_orwhere($colmns, $where);
    }
}