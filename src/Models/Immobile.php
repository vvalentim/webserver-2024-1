<?php

namespace Models;

use Core\Database;

class Immobile {
    protected Database $db;

    public function __construct(Database $db) {
        $this->db = $db;
    }

    public function destroy($id){
        if(!$id){
            return null;
        }

        $this->db->query("delete from imoveis where id = :id", [$id]);
    }

    public function get(){
        return $this->db->query("select * from imoveis")->findAll();
    }

    public function list($filter = null){
        $sql = "SELECT id, titulo, preco, imagem_path, descricao, cep, numero, complemento FROM imoveis";
        $bind = [];

        if($filter){
            $filter = '%' . $filter . '%';
            $sql .=  " WHERE titulo LIKE :filter OR complemento LIKE :filter OR cep LIKE :filter";
            $bind = [$filter];
        }

        $sql .=  " ORDER BY id DESC";

        return $this->db->query($sql, $bind)->findAll();
    }

    public function create() {
        $path = $this->storeUploadedImage();
        if(!$path) return;

        $complemento = $_POST['logradouro'].', '. $_POST['bairro'].', '.$_POST['cidade'].', '.$_POST['uf'];

        $response = $this->db->query("INSERT INTO imoveis (id_proprietario,
                                                      tipo_imovel,
                                                      finalidade,
                                                      qntd_quartos,
                                                      qntd_banheiros,
                                                      qntd_suites,
                                                      qntd_garagem,
                                                      area_util,
                                                      area_total,
                                                      preco,
                                                      titulo,
                                                      descricao,
                                                      cep,
                                                      numero,
                                                      complemento,
                                                      imagem_path) 
                                                      VALUES 
                                                      (:id_proprietario, :tipo_imovel, :finalidade, :qntd_quartos, :qntd_banheiros, :qntd_suites, :qntd_garagem, :area_util, :area_total, :preco, :titulo, :descricao, :cep, :numero, :complemento, :imagem_path)",
                                                      [
                                                        $_POST['id_proprietario'], $_POST['tipo_imovel'], $_POST['finalidade'], $_POST['quartos'], $_POST['banheiros'], $_POST['suites'], $_POST['garagens'], $_POST['area_util'], $_POST['area_total'], $_POST['preco'], $_POST['titulo'], $_POST['descricao'], $_POST['cep'], $_POST['numero'], $complemento, $path
                                                    ]);
        return true;
    }

    public function storeUploadedImage(){
        $uploadPath = 'public/assets/images/uploads/';

        $target = $uploadPath . basename($_FILES["imagem"]["name"]);
        $imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
        $r = move_uploaded_file($_FILES["imagem"]["tmp_name"], $target);
        if($r) return $target;
        return null;
    }

    public function validate(){
        $e = [];

        if($_POST['id_proprietario'] == ''){
            $e[] = 'id_proprietario';
        }

        if($_POST['tipo_imovel'] == ''){
            $e[] = 'tipo_imovel';
        }

        if($_POST['finalidade'] == ''){
            $e[] = 'finalidade';
        }

        if($_POST['qntd_quartos'] == ''){
            $e[] = 'qntd_quartos';
        }
        
        if($_POST['qntd_banheiros'] == ''){
            $e[] = 'qntd_banheiros';
        }

        if($_POST['qntd_suites'] == ''){
            $e[] = 'qntd_suites';
        }

        if($_POST['qntd_garagens'] == ''){
            $e[] = 'qntd_garagens';
        }
        
        if($_POST['arae_util'] == ''){
            $e[] = 'arae_util';
        }
        
        if($_POST['area_total'] == ''){
            $e[] = 'area_total';
        }
        
        if($_POST['preco'] == ''){
            $e[] = 'preco';
        }
        
        if($_POST['titulo'] == ''){
            $e[] = 'titulo';
        }
        
        if($_POST['descricao'] == ''){
            $e[] = 'descricao';
        }
        
        if($_POST['cep'] == ''){
            $e[] = 'cep';
        }
        
        if($_POST['numero'] == ''){
            $e[] = 'numero';
        }
        
        if($_POST['complemento'] == ''){
            $e[] = 'complemento';
        }
        
        if(isset($_FILES['imagem']) && !empty($_FILES['imagem'])){
            $e[] = 'imagem';
        }
        $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    //     && $imageFileType != "gif") {
    //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    //     $uploadOk = 0;
    // }

        return $e;
    }
}