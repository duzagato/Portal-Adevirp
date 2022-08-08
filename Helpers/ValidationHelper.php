<?php 

    class ValidationHelper{
        private $table;
        private $data;

        public function getMethod($file_name){
            $methods = array(
                'docx'=>'text_file'
            );
            $extension = explode('.', $file_name)[1];

            return $methods[$extension];
        }

        public function setTable($table){
            $this->table = $table;
        }

        public function apelido($apelido){
            if(strlen($apelido) > 0){
                if(self::stringFilter($apelido)){
                    extract($this->getSql('apelido', $apelido));
                    
                    if(!Database::query($sql, $params)){
                        return true;
                    }else{
                        return 'Usuário já está em uso';
                    }
                }else{
                    return 'O Nome de usuário pode conter apenas: letras, números e underline';
                }
            }else{
                return true;
            }
        }

        public function email($email){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                extract($this->getSql('email', $email));
                
                if(!Database::query($sql, $params)){
                    return true;
                }else{
                    return 'E-Mail já cadastrado';
                }
            }else{
                return 'Digite um e-mail válido';
            }
        }

        public function id($id){
            $this->data[$this->table.'_id'] = $id;

            return true;
        }

        public function nome($nome){
            $this->data['nome'] = $nome;
            if(self::nomeFilter($nome)){
                return true;
            }else{
                return 'O nome deve conter apenas letras';
            }
        }

        public function sobrenome($sobrenome){
            if(isset($this->data[$this->table.'_id'])){
                if(self::nomeFilter($sobrenome)){
                    if(!Database::query('SELECT usuario_id FROM usuario WHERE usuario_nome = :usuario_nome AND usuario_sobrenome = :usuario_sobrenome AND usuario_id != :id', array(':usuario_nome'=>$this->data['nome'], ':usuario_sobrenome'=>$sobrenome, ':id'=>$this->data[$this->table.'_id']))){
                        return true;
                    }else{
                        FormHelper::setDataInForm('failure', 'Nome e Sobrenome já cadastrados em outro usuário');
                        return false;
                    }
                }else{
                    return 'O sobrenome deve conter apenas letras';
                }
            }else{
                if(self::nomeFilter($sobrenome)){
                    if(!Database::query('SELECT usuario_id FROM usuario WHERE usuario_nome = :usuario_nome AND usuario_sobrenome = :usuario_sobrenome', array(':usuario_nome'=>$this->data['nome'], ':usuario_sobrenome'=>$sobrenome))){
                        return true;
                    }else{
                        FormHelper::setDataInForm('failure', 'Nome e Sobrenome já cadastrados');
                        return false;
                    }
                }else{
                    return 'O sobrenome deve conter apenas letras';
                }
            }
        }

        public function celular($celular){
            if(strlen(Helpers::strToInt($celular)) == 11 || strlen(Helpers::strToInt($celular)) == 10){
                return true;
            }else{
                return 'Número de celular inválido';
            }
        }

        public function senha($senha){
            $this->data['senha'] = $senha;
            if(strlen($senha) > 0){
                if(strlen($senha) >= 8 && strlen($senha) <= 30){
                    return true;
                }else{
                    return 'A senha deve conter no mínimo 8 e no máximo 30 caracteres';
                }
            }else{
                return true;
            }
        }

        public function csenha($csenha){
            if($csenha === $this->data['senha']){
                return true;
            }else{
                return 'As senhas digitadas não conferem';
            }
        }

        public function getSql($key, $value){
            if(isset($this->data[$this->table.'_id'])){
                $table = $this->table;
                $id = $this->data[$this->table.'_id'];
                $data['sql'] = "SELECT {$table}_id FROM {$table} WHERE {$table}_{$key} = :{$key} AND {$table}_id != :id";
                $data['params'] = array(':'.$key=>$key, ':id'=>$id);
            }else{
                $table = $this->table;
                $data['sql'] = "SELECT {$table}_id FROM {$table} WHERE {$table}_{$key} = :{$key}";
                $data['params'] = array(':'.$key=>$value);
            }

            return $data;
        }

        public static function nomeFilter($string){
            if(preg_match('/^[ a-zA-ZÀ-ÿ\u00f1\u00d1]*$/', $string)){
                return true;
            }else{
                return false;
            }
        }

        public function stringFilter($string){
            if(preg_match('/^[a-zA-Z0-9_]+$/', $string)){
                return true;
            }else{
                return false;
            }
        }
    }

?>