<?php 

    class Helpers{
        public static function convertToAmplified($file){
            extract($file);
            $phpWord = \PhpOffice\PhpWord\IOFactory::load($tmp_name);
            $phpWord->setDefaultFontSize(50);
            $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
            $objWriter->save(PATH_UPLOADS_IMPRESSOES.'/'.$name);
        }
        
        public static function loadValidation($params, $table, $foreignKey = array()){
            if(!isset($params[0]) || !is_numeric($params[0]) || empty($params[0])){
                header('Location: '.URL.$table.'s');
            }elseif(!Database::query('SELECT '.$table.'_id FROM '.$table.' WHERE '.$table.'_id = :id', array(':id'=>$params[0]))[0]){
                // header('Location: '.URL.$table.'s');
            }else{
                if($foreignKey === array()){
                    $data[$table] = Database::query('SELECT * FROM '.$table.' WHERE '.$table.'_id = :id', array(':id'=>$params[0]))[0];
                }else{
                    $tables = $table.','.implode(',', $foreignKey);
                    $where = "{$table}_id = :id";
                    foreach($foreignKey as $f){
                        $where .= " AND {$table}.{$f}_id = {$f}.{$f}_id";
                        // $where .= $table.'.'.$table.'_id = '.$f.'';
                    }
                    $sql = 'SELECT * FROM '.$tables.' WHERE '.$where;
                    $data[$table] = Database::query($sql, array(':id'=>$params[0]))[0];
                }
            }

            return $data;
        }

        public static function strToInt($str){ 
            return preg_replace("/[^0-9]/", "", $str); 
        }

        public static function getDateInterval($date1, $date2){
			$date1 = new DateTime($date1);
			$date2 = new DateTime($date2);
			$interval = $date1->diff($date2);
			
			return $interval;
		}

        public static function getDaysByNumber(){
            $dia[1] = 'Segunda-Feira';
            $dia[2] = 'Terça-Feira';
            $dia[3] = 'Quarta-Feira';
            $dia[4] = 'Quinta-Feira';
            $dia[5] = 'Sexta-Feira';

            return $dia;
        }

        public static function getDaysBySlug(){
            $dia['segunda-feira'] = 'Segunda-Feira';
            $dia['terca-feira'] = 'Terça-Feira';
            $dia['quarta-feira'] = 'Quarta-Feira';
            $dia['quinta-feira'] = 'Quinta-Feira';
            $dia['sexta-feira'] = 'Sexta-Feira';

            return $dia;
        }

        public static function getDaysNumberBySlug(){
            $dia['segunda-feira'] = 1;
            $dia['terca-feira'] = 2;
            $dia['quarta-feira'] = 3;
            $dia['quinta-feira'] = 4;
            $dia['sexta-feira'] = 5;

            return $dia;
        }

        public static function getLessonTime(){
            $aula[1] = '7:30 às 8:30';
            $aula[2] = '8:50 às 9:40';
            $aula[3] = '9:50 às 10:30';
            $aula[4] = '10:40 às 11:30';
            $aula[5] = '13:00 às 13:50';
            $aula[6] = '14:00 às 14:50';
            $aula[7] = '15:20 às 16:10';
            $aula[8] = '16:10 às 15:00';

            return $aula;
        }

        public static function translateDays(){
            $day['Mon'] = 'segunda-feira';
            $day['Tue'] = 'terça-feira';
            $day['Wed'] = 'quarta-feira';
            $day['Thu'] = 'quinta-feira';
            $day['Fri'] = 'sexta-feira';

            return $day;
        }

        public static function getNow(){
			return date('d/m/Y', time());
        }

        public static function strToSlug($text){
            $slug = iconv('UTF-8','ASCII//TRANSLIT',$text);
            $slug = preg_replace("/['|^|`|~|]/","",$slug);
            $slug = preg_replace('/["]/','',$slug);
            return strtolower(preg_replace('/[" _"]/','-',$slug));
        }
        
        public static function generateToken($bytes){
            $cstrong = True;
            $token = bin2hex(openssl_random_pseudo_bytes($bytes, $cstrong));
    
            return $token;
        }

        public static function insertToken($usuario_id){
            $token = uniqid('ad');
            Database::query('INSERT INTO login_token VALUES (\'\', :usuario_id, :token)', array(':usuario_id'=>$usuario_id, ':token'=>$token));

            return $token;
          }

          public static function createCookies($usuario_id, $token){
            setcookie("ADEVIRP_TOKEN", $token, time() + 60 * 60 * 24 * 360, '/', NULL, NULL, TRUE);
            setcookie("ADEVIRP_ID", $usuario_id, time() + 60 * 60 * 24 * 360, '/', NULL, NULL, TRUE);
          }

        public static function unsetCookies(){
            unset($_COOKIE['ADEVIRP_ID']);
			unset($_COOKIE['ADEVIRP_TOKEN']);
        }

        public static function expireCookie($name){
            unset($_COOKIE[$name]);
            setcookie($name, null, -1, '/');
        }

        public static function uploadFile($file, $folder){
            extract($file);
            move_uploaded_file($tmp_name, $folder.$name);
        }
    }

?>