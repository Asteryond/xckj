<?php

namespace XCPhp\db;

use PDOStatement;

class Sql
{
    //数据库表名
    protected $table;

    protected $primary = 'id';

    private $filter = '';

    private $param = array();


    /**
     * 查询条件拼接
     *
     * @param array $where 条件
     * @param array $param
     * @return $this 当前对象
     */
    public function where($where = array(), $param = array())
    {
        if($where)
        {
            $this->filter .= ' WHERE ';
            $this->filter .= implode(' ', $where);

            $this->param = $param;
        }
        return $this;
    }


    /**
     * 拼装排序条件
     *
     * @param array $order 排序条件
     *
     * @return Sql
     */
    public function order($order = array())
    {
        if($order)
        {
            $this->filter .= ' ORDER BY ';
            $this->filter .= implode(',', $order);
        }
        return $this;
    }

    //查询所有
    public function fetchAll()
    {
        $sql = sprintf("SELECT * FROM %s %s",$this->table, $this->filter);
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, $this->param);
        $sth->execute();
        return $sth->fetchAll();
    }

    // 查询一条
    public function fetch()
    {
        $sql = sprintf("select * from %s %s", $this->table, $this->filter);
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, $this->param);
        $sth->execute();

        return $sth->fetch();
    }

    //根据id删除数据
    public function delete($id)
    {
        $sql = sprintf("DELETE FROM %s where %s = :%s", $this->table, $this->primary, $this->primary);
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, [$this->primary => $id]);
        $sth->execute();
        return $sth->rowCount();
    }

    //新增数据
    public function add($data)
    {
        $sql = sprintf("insert into %s %s", $this->table, $this->formatInsert($data));
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, $data);
        $sth = $this->formatParam($sth, $this->param);
        $sth->execute();
        return $sth->rowCount();
    }

    public function update($data)
    {
        $sql = sprintf("UPDATE %s SET %s %s", $this->table, $this->formatUpdate($data),$this->filter);
        $sth = Db::pdo()->prepare($sql);
        $sth = $this->formatParam($sth, $data);
        $sth = $this->formatParam($sth, $this->param);
        $sth->execute();

        return $sth->rowCount();
    }

    private function formatInsert($data)
    {
        $fields = array();
        $names = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("%s", $key);
            $names[] = sprintf(":%s", $key);
        }

        $field = implode(',', $fields);
        $name = implode(',', $names);

        return sprintf("(%s) values (%s)", $field, $name);
    }

    public function formatParam(PDOStatement $sth, $params = array())
    {
        foreach ($params as $param => &$value) {
            $param = is_int($param) ? $param + 1 : ':' . ltrim($param, ':');
            $sth->bindParam($param, $value);
        }
        return $sth;
    }

    public function formatUpdate($data)
    {
        $fields = array();
        foreach ($data as $key => $value) {
            $fields[] = sprintf("%s = :%s", $key, $key);
        }
        return implode(',', $fields);
    }
}
