<?php

namespace App\Db;

/**
 * Class Table
 * @package App\Db
 */
abstract class Table {

    /**
     * @var \PDO
     */
    protected $db;

    /**
     * @var string
     */
    protected $table;

    public function __construct(\PDO $db) {
        $this->db = $db;
    }

    /**
     * @param $table
     * @return $this
     */
    public function setTable($table)
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @return string
     */
    public function getTable()
    {
        return $this->table;
    }

    /**
     * @param array $data
     * @return mixed
     */
    abstract protected function _insert(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    abstract protected function _update(array $data);

    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data) {
        if (!isset($data['id'])) {
            return $this->_insert($data);
        } else {
            return $this->_update($data);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id) {
        $stmt = $this->db->prepare("select * from ".$this->getTable()." where id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id) {
        $stmt = $this->db->prepare("delete from ".$this->getTable()." where id=:id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return true;
    }

    /**
     * @return array
     */
    public function fetchAll() {
        $stmt = $this->db->prepare("select * from ".$this->getTable());
        $stmt->execute();
        return $stmt->fetchAll();
    }

}