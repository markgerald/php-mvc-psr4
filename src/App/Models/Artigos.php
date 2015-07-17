<?php

namespace App\Models;

use App\Db\Table;

/**
 * Class Artigos
 * @package App\Models
 */
class Artigos extends Table {

    /**
     * @var string
     */
    protected $table = "artigos";

    /**
     * @param array $data
     * @return string
     */
    protected function _insert(array $data) {
        $stmt = $this->db->prepare(
            "Insert into ".$this->getTable()."
            (titulo,texto,ativo,data_cadastro) Values(:titulo, :texto, :ativo, :mailing, :senha, :ativo, :data_cadastro)"
        );
        $stmt->bindParam(":nome", $data['titulo']);
        $stmt->bindParam(":email", $data['texto']);
        $stmt->bindParam(":celular", $data['ativo']);
        $dt = new \DateTime();
        $agora =$dt->format('Y-m-d H:i:s');
        $stmt->bindParam(":data_cadastro",$agora);
        $stmt->execute();
        return $this->db->lastInsertId();
    }

    /**
     * @param array $data
     * @return mixed
     */
    protected function _update(array $data) {
        $stmt = $this->db->prepare("update ".$this->getTable()."
            set titulo=:titulo, texto=:texto, ativo=:ativo where id=:id"
        );
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":nome", $data['titulo']);
        $stmt->bindParam(":email", $data['texto']);
        $stmt->bindParam(":celular", $data['email']);
        $stmt->execute();
        return $data['id'];
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function _activate($id) {
        $stmt = $this->db->prepare("update ".$this->getTable()."
            set ativo=:ativo where id=:id"
        );
        $ativo = 1;
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":ativo", $ativo);
        $stmt->execute();
        return $id;
    }

}