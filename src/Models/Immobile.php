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

    public function find($id){
        return $this->db->query("select * from imoveis where id = :id", [$id])->find();
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

    public function update($id) {
        $path = $this->storeUploadedImage();
        
        if(!$path){
            if(!empty($_POST['imagem_path'])){
                $path = $_POST['imagem_path'];
            }else{
                return;
            }
        }

        $complemento = $_POST['logradouro'].', '. $_POST['bairro'].', '.$_POST['cidade'].', '.$_POST['uf'];

        $sql = "UPDATE imoveis SET id_proprietario = :id_proprietario,
                                    tipo_imovel = :tipo_imovel,
                                    finalidade = :finalidade,
                                    qntd_quartos = :qntd_quartos,
                                    qntd_banheiros = :qntd_banheiros,
                                    qntd_suites = :qntd_suites,
                                    qntd_garagem = :qntd_garagem,
                                    area_util = :area_util,
                                    area_total = :area_total,
                                    preco = :preco,
                                    titulo = :titulo,
                                    descricao = :descricao,
                                    cep = :cep,
                                    numero = :numero,
                                    complemento = :complemento,
                                    imagem_path = :imagem_path 
                                    WHERE id = :id";

        $response = $this->db->query($sql, [$_POST['id_proprietario'], $_POST['tipo_imovel'], $_POST['finalidade'], $_POST['quartos'], $_POST['banheiros'], $_POST['suites'], $_POST['garagens'], $_POST['area_util'], $_POST['area_total'], $_POST['preco'], $_POST['titulo'], $_POST['descricao'], $_POST['cep'], $_POST['numero'], $complemento, $path, $id]);
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
            $e[] = 'Selecione um proprietário!';
        }

        if($_POST['tipo_imovel'] == ''){
            $e[] = 'Selecione o tipo de imóvel';
        }

        if($_POST['finalidade'] == ''){
            $e[] = 'Selecione a finalidade';
        }

        if($_POST['quartos'] == ''){
            $e[] = 'Quantidade de quartos é obrigatória';
        }
        
        if($_POST['banheiros'] == ''){
            $e[] = 'Quantidade de banheiros é obrigatória';
        }

        if($_POST['suites'] == ''){
            $e[] = 'Quantidade de suítes é obrigatória';
        }

        if($_POST['garagens'] == ''){
            $e[] = 'Quantidade de garagens é obrigatória';
        }
        
        if($_POST['area_util'] == ''){
            $e[] = 'Área útil é obrigatória';
        }
        
        if($_POST['area_total'] == ''){
            $e[] = 'Área total é obrigatória';
        }
        
        if($_POST['preco'] == ''){
            $e[] = 'Preço é obrigatório';
        }
        
        if($_POST['titulo'] == ''){
            $e[] = 'Título é obrigatório';
        }
        
        if($_POST['descricao'] == ''){
            $e[] = 'Informe uma descrição';
        }
        
        if($_POST['cep'] == ''){
            $e[] = 'CEP é obrigatório';
        }
        
        if($_POST['numero'] == ''){
            $e[] = 'Número do imóvel é obrigatório';
        }
        
        if($_POST['logradouro'] == ''){
            $e[] = 'Logradouro é obrigatório';
        }
        
        if($_POST['bairro'] == ''){
            $e[] = 'Bairro é obrigatório';
        }
        
        if($_POST['cidade'] == ''){
            $e[] = 'Cidade é obrigatório';
        }
        
        if($_POST['uf'] == ''){
            $e[] = 'Selecione a UF';
        }

        if((empty($_FILES['imagem'])) && isset($_POST['imagem_path']) && $_POST['imagem_path'] == ''){
            $e[] = 'Imagem é obrigatório';
        }
        
        if(isset($_FILES['imagem']) && !empty($_FILES['imagem']) && $_POST['imagem_path'] == ''){
            if ($_FILES["imagem"]["size"] > 500000) {
                $e[] = 'Tamanho da imagem é muito grande';
            }
            $imageFileType = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $e[] = "Imagem deve ser do tipo JPG, JPEG ou PNG.";
            }
        }

        return $e;
    }
}