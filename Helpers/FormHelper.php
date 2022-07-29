<?php

    class FormHelper{
        private static $form;

        public static function getValidation(){
            return self::$form;
        }

        public static function setIsValid($alerts){
            $isValid = true;
            foreach($alerts as $a){
                if($a !== true){
                    $isValid = false;
                }
            }

            self::$form['isValid'] = $isValid;
        }

        public static function getIsValid(){
            if(isset(self::$form['isValid'])){
                return self::$form['isValid'];
            }
        }

        public static function stringFilter($string){
            if(preg_match('/^[a-zA-Z0-9_]+$/', $string)){
                return true;
            }else{
                return false;
            }
        }

        public static function nameFilter($string){
            if(preg_match('/^[a-zA-Z ]+$/', $string)){
                return true;
            }else{
                return false;
            }
        }

        public static function trimData($data){
            foreach($data as $key => $value){
                if(!is_array($value)){
                    $trim[$key] = addslashes(trim($value));
                }
            }

            return $trim;
        }

        public static function form_validation($post, $files){
            unset($post['form_submit']);
            if($_FILES != array()){
                foreach($files as $key => $value){
                    $f = new ValidationHelper();
                    $method = $f->getMethod($value['name']);
                    $data[$key] = $value;

                    if(method_exists($f, $method)){
                        self::$form['alerts'][$key] = $f->$method($value);
                    }else{
                        self::$form['alerts'][$key] = true;
                    }
                }
            }

            self::$form['form_data'] = $data + $post;
            $v = new ValidationHelper();

            foreach($data as $key => $value){
                $name = explode('_', $key);
                $v->setTable($name[0]);
                $method = $name[count($name)-1];

                if(method_exists($v, $method)){
                    self::$form['alerts'][$key] = $v->$method($value);
                }else{
                    self::$form['alerts'][$key] = true;
                }
            }

            self::setIsValid(self::$form['alerts']);
        }

        public static function setDataInForm($key, $value){
            self::$form[$key] = $value;
        }

        public static function educando($data){
            $trim = FormHelper::trimData($data);
            $formController = 'educando_'.$data['form_validation']['educando'];
            unset($data['form_submit']);

            FormHelper::{$formController}($trim);
        }

        public static function educando_add($data){
            $data['educando_nome'] = ucfirst($data['educando_nome']);
            $data['educando_sobrenome'] = ucfirst($data['educando_sobrenome']);
            self::$form['form_data'] = $data;
            $v = new ValidationHelper();

            foreach($data as $key => $value){
                $method = str_replace("educando_", "", $key);

                if(method_exists($v, $method)){
                    self::$form['alerts'][$key] = $v->$method($value);
                }else{
                    self::$form['alerts'][$key] = true;
                }
            }

            self::$form['isValid'] = self::isValid(self::$form['alerts']);
        }

        public static function usuario($data){
            $trim = FormHelper::trimData($data);
            $formController = 'usuario_'.$data['form_validation']['usuario'];
            unset($data['form_submit']);

            FormHelper::{$formController}($trim);
        }

        public static function usuario_add($data){
            FormHelper::$form['form_data'] = $data;
            extract($data);

            if(!Database::query('SELECT usuario_id FROM usuario WHERE usuario_apelido = :usuario_apelido', array(':usuario_apelido'=>$usuario_apelido))){
                if(self::stringFilter($usuario_apelido)){
                    if(filter_var($usuario_email, FILTER_VALIDATE_EMAIL)){
                        if(!Database::query('SELECT usuario_id FROM usuario WHERE usuario_email = :usuario_email', array(':usuario_email'=>$usuario_email))){
                            if(strlen(Helpers::strToInt($usuario_phone)) == 11 || strlen(Helpers::strToInt($usuario_phone)) == 10){
                                if(strlen($usuario_password) > 8 && strlen($usuario_password) < 30){
                                    if($usuario_password === $usuario_cpassword){
                                        FormHelper::$form['usuario_add'] = true;
                                    }else{
                                        FormHelper::$form['usuario_add'] = 'As senhas digitadas não conferem';
                                    }
                                }else{
                                    FormHelper::$form['usuario_add'] = 'A senha deve conter no mínimo 8 caracteres e no máximo 30 caracteres';
                                }
                            }else{
                                FormHelper::$form['usuario_add'] = 'Número de celular inválido';
                            }
                        }else{
                            FormHelper::$form['usuario_add'] = 'E-Mail já cadastrado';
                        }
                    }else{
                        FormHelper::$form['usuario_add'] = 'E-Mail inválido! Tente novamente';
                    }
                }else{
                    FormHelper::$form['usuario_add'] = 'O Nome de usuário só pode conter letras, números e underline';
                }
            }else{
                self::$form['usuario_add'] = 'Nome de usuário já cadastro';
            }
        }

        public static function usuario_login($data){
            extract($data);

            if(Database::valueExists('usuario', 'usuario_apelido', $data['usuario_apelido']) == true){
                if(password_verify($usuario_password, Database::query("SELECT usuario_password FROM usuario WHERE usuario_apelido = :usuario_apelido", array(':usuario_apelido'=>$usuario_apelido))[0]['usuario_password'])){
                    $usuario_id = Database::query('SELECT usuario_id FROM usuario WHERE usuario_apelido = :usuario_apelido', array(':usuario_apelido'=>$usuario_apelido))[0]['usuario_id'];
                    $token = Helpers::insertToken($usuario_id);
                    $_SESSION['usuario_id'] = $usuario_id;
                    $_SESSION['token'] = $token;
                    header('Location: '.URL);
                }else{
                    echo 'senha não existe';
                    exit;
                }
            }else{
                echo 'falso';
                exit;
            }
        }
    }


    /*
        <form action="" method="post">
            <input type="text" name="usuarios_name" placeholder="digite o usuário" />
            <input type="hidden" name="form_validation[usuario]" value="add" />
            <button type="submit" name="form_submit">Add</button>
        </form>

        public static function usuario($data){
            $formController = 'usuario_'.$data['form_validation']['usuario'];
            unset($data['form_validation']);

            FormHelper::{$formController}($data);
        }

        public static function usuario_add($data){
            self::$form = 'Dados de validação';
        }
    */
?>