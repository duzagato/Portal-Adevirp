<?php
    class impressoesController extends Controller{
        public static function index(){
            $data = array();

            Controller::loadTemplate('impressoes/index', $data);
        }

        public static function adicionar(){
            $data = array();

            if(FormHelper::getIsValid() === true){
                $data = FormHelper::getValidation();
                if($data['form_data']['impressao_ampliada'] === 'on'){
                    $file = Helpers::convertToAmplified($data['form_data']['impressao_arquivo']);
                    $data['form_data']['impressao_arquivo'] = $data['form_data']['impressao_arquivo']['name'];
                }else{
                    $data['form_data']['impressao_arquivo'] = $data['form_data']['impressao_arquivo']['name'];
                }
                $data['form_data']['impressao_ampliada'] = (isset($data['form_data']['impressao_ampliada']) ? 1 : 0);
                $data['form_data']['impressao_braille'] = (isset($data['form_data']['impressao_braille']) ? 1 : 0);
                $data['form_data']['usuario_id'] = $_SESSION['ADEVIRP_ID'];
                $data['form_data']['status'] = 0;

                Database::dbAction('add', $data['form_data'], 'impressao');
                $data['alerts']['success'] = 'Impressão solicitada com sucesso!';
            }elseif(FormHelper::getIsValid() === false){
                $data = FormHelper::getValidation();
                Controller::test($data);
            }

            Controller::loadView('impressoes/adicionar', $data);
        }
    }
?>