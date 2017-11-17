<?php

namespace App\Models;

use App\Db\Table;

/**
 * Class Artigos
 * @package App\Models
 */
class Artigos extends Table
{

    /**
     * @var string
     */
    protected $table = "artigos";

    /**
     * @param array $data
     * @return string
     */
    protected function _insert(array $data)
    {
        $stmt = $this->db->prepare(
            "INSERT INTO ".$this->getTable().
            "(titulo,texto,ativo,data_cadastro) VALUES(:titulo, :texto, :ativo,:data_cadastro)"
        );
        $stmt->bindParam(":titulo", $data['titulo']);
        $stmt->bindParam(":texto", $data['texto']);
        $stmt->bindParam(":ativo", $data['ativo']);
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
    protected function _update(array $data)
    {
        $stmt = $this->db->prepare("UPDATE ".$this->getTable()."
            SET titulo=:titulo, texto=:texto, ativo=:ativo WHERE id=:id"
        );
        $stmt->bindParam(":id", $data['id']);
        $stmt->bindParam(":titulo", $data['titulo']);
        $stmt->bindParam(":texto", $data['texto']);
        $stmt->bindParam(":ativo", $data['ativo']);
        $stmt->execute();

        return $data['id'];
    }


}