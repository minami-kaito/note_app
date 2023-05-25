<?php
namespace Model;

use Exception;

class User extends \Model
{
    public static function check_foreign_key($user_id)
    {
        $result = \DB::select('*')
        ->from('notes')
        ->where('user_id', '=', $user_id)
        ->execute();

        if(count($result) > 0){
            try{
                \DB::delete('notes')->where('user_id', '=', $user_id)->execute();
                return true;
            } catch (Exception $e){
                $message = $e->getMessage();
                return false;
            }
        }
        return true;
    }

    public static function select_user_orwhere(string $colmn, array $where)
    {
        $query = \DB::select($colmn)->from('users')->where('user_id', '=', 0);

        foreach($where as $key => $value)
        {
            $query->or_where($key, '=', $value);
        }

        try
        {
            $result = $query->execute()->as_array();
        } 
        catch(Exception $e)
        {
            $result = $e->getMessage();
        }
        return $result;
    }

    public static function update_user_orwhere(string $table, array $colmns, array $where)
    {
        $query = \DB::update($table)->set($colmns)->where('user_id', '=', 0);

        foreach($where as $key => $value)
        {
            $query->or_where($key, '=', $value);
        }

        try
        {
            $result = $query->execute();
        } 
        catch(Exception $e)
        {
            $result = $e->getMessage();
        }
        return $result;
    }
}