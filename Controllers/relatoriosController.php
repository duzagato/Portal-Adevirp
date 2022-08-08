<?php
    class relatoriosController extends Controller{
        public static function index(){
            $data = array();
            $data['professor'] = Database::query('SELECT usuario_id FROM usuario WHERE usuario_slug = :slug', array(':slug'=>$_SESSION['ADEVIRP_SLUG']))[0];
            $data['ultimos_relatorios'] = Database::query('SELECT relatorio.relatorio_id, usuario.usuario_nome, usuario.usuario_sobrenome, relatorio.relatorio_data, relatorio.relatorio_atendimento_data, relatorio.relatorio_presenca FROM relatorio, usuario WHERE relatorio.professor_id = :id AND relatorio.educando_id = usuario.usuario_id ORDER BY relatorio.relatorio_atendimento_data DESC LIMIT 10', array(':id'=>$_SESSION['ADEVIRP_ID']));
            $data['agenda'] = Database::query('SELECT agenda.agenda_id, agenda.agenda_titulo, agenda.agenda_dia, agenda.agenda_aula, agenda.agenda_inc_data, agenda.educando_id, usuario.usuario_slug, usuario.usuario_nome, usuario.usuario_sobrenome FROM agenda, usuario WHERE professor_id = :id AND agenda.educando_id = usuario.usuario_id ORDER BY educando_id ASC', array(':id'=>$data['professor']['usuario_id']));
            
            Controller::loadTemplate('relatorios/abrir', $data);
        }

        public static function abrir($params){
            $data = array();
            $data['professor'] = Database::query('SELECT usuario_id FROM usuario WHERE usuario_slug = :slug', array(':slug'=>$params[0]))[0];
            $data['ultimos_relatorios'] = Database::query('SELECT relatorio.relatorio_id, usuario.usuario_nome, usuario.usuario_sobrenome, relatorio.relatorio_data, relatorio.relatorio_atendimento_data, relatorio.relatorio_presenca FROM relatorio, usuario WHERE relatorio.professor_id = :id AND relatorio.educando_id = usuario.usuario_id ORDER BY relatorio.relatorio_atendimento_data DESC LIMIT 10', array(':id'=>$_SESSION['ADEVIRP_ID']));
            $data['agenda'] = Database::query('SELECT agenda.agenda_id, agenda.agenda_titulo, agenda.agenda_dia, agenda.agenda_aula, agenda.agenda_inc_data, agenda.educando_id, usuario.usuario_slug, usuario.usuario_nome, usuario.usuario_sobrenome FROM agenda, usuario WHERE professor_id = :id AND agenda.educando_id = usuario.usuario_id ORDER BY educando_id ASC', array(':id'=>$data['professor']['usuario_id']));
            
            Controller::loadTemplate('relatorios/abrir', $data);
        }

        public static function visualizar($params){
            $data = array();
            $relatorio_id = $params[0];
            $data['relatorio'] = Database::query('SELECT relatorio.relatorio_descricao, relatorio.relatorio_data, relatorio.relatorio_atendimento_data, relatorio.relatorio_presenca, usuario.usuario_nome, usuario.usuario_sobrenome FROM relatorio, usuario WHERE relatorio_id = :id AND relatorio.educando_id = usuario.usuario_id', array(':id'=>$relatorio_id))[0];

            Controller::loadView('relatorios/visualizar', $data);
        }

        public static function preencher($params){
            $data = array();
            $data['educando_id'] = $params[0];
            $data['data'] = $params[1];
            $dia = Helpers::translateDays()[date('D', $params[1])];

            if(Database::query('SELECT agenda_id FROM agenda WHERE professor_id = :professor_id AND educando_id = :educando_id AND agenda_dia = :dia', array(':professor_id'=>$_SESSION['ADEVIRP_ID'], ':educando_id'=>$data['educando_id'], ':dia'=>$dia))){
                if(!Database::query('SELECT relatorio_id FROM relatorio WHERE professor_id = :professor_id AND educando_id = :educando_id AND relatorio_atendimento_data = :data', array(':professor_id'=>$_SESSION['ADEVIRP_ID'], ':educando_id'=>$data['educando_id'], ':data'=>date('d-m-Y', $data['data'])))){
                    if(FormHelper::getIsValid() === true){
                        $data = FormHelper::getValidation();
                        $data['form_data']['relatorio_presenca'] = 1;
                        $data['form_data']['relatorio_atendimento_data'] = $params[1];
                        $data['form_data']['relatorio_data'] = time();
                        $data['form_data']['educando_id'] = $params[0];
                        $data['form_data']['professor_id'] = $_SESSION['ADEVIRP_ID'];
    
                        Database::dbAction('add', $data['form_data'], 'relatorio');
                        $data['redirect'] = URL.'relatorios/'.$_SESSION['ADEVIRP_SLUG'];
                    }elseif(FormHelper::getIsValid() === false){
                        $data['failure'] = 'Ocorreu um erro! Tente novamente mais tarde, ou entre em contato com a sala de informática';
                    }
                }else{
                    $data['failure'] = 'Relatório já preenchido';
                }
            }else{
                header('Location: '.URL.'relatorios/'.$_SESSION['ADEVIRP_SLUG']);
            }

            Controller::loadView('relatorios/preencher', $data);
        }

        public static function falta($params){
            $data = array();
            if(isset($params[0]) && isset($params[1])){
                $educando_id = $params[0];
                $time = $params[1];
                $agenda_inc_data = Database::query('SELECT agenda_inc_data FROM agenda WHERE educando_id = :id ORDER BY agenda_inc_data ASC LIMIT 1', array(':id'=>$educando_id))[0]['agenda_inc_data'];

                if($time > $agenda_inc_data && $time < time()){
                    $data['educando'] = Database::query('SELECT usuario.usuario_id, usuario.usuario_nome, usuario.usuario_sobrenome FROM usuario WHERE usuario_id = :id', array(':id'=>$educando_id))[0];
                    $data['data'] = $time;

                    Controller::loadView('relatorios/falta', $data);
                }else{
                    header('Location: '.URL.'relatorios/'.$_SESSION['ADEVIRP_SLUG']);
                }
            }else{
                header('Location: '.URL.'relatorios/'.$_SESSION['ADEVIRP_SLUG']);
            }
        }

        public static function cfalta($params){
            $data = array();
            if(isset($params[0]) && isset($params[1])){
                $educando_id = $params[0];
                $time = $params[1];
                $agenda_inc_data = Database::query('SELECT agenda_inc_data FROM agenda WHERE educando_id = :id ORDER BY agenda_inc_data ASC LIMIT 1', array(':id'=>$educando_id))[0]['agenda_inc_data'];

                if($time > $agenda_inc_data && $time < time()){
                    $relatorio['agenda_atendimento_descricao'] = '';
                    $relatorio['relatorio_presenca'] = 0;
                    $relatorio['relatorio_atendimento_data'] = $time;
                    $relatorio['relatorio_data'] = time();
                    $relatorio['educando_id'] = $educando_id;
                    $relatorio['professor_id'] = $_SESSION['ADEVIRP_ID'];

                    Database::dbAction('add', $relatorio, 'relatorio');
                    header('Location: '.URL.'relatorios/'.$_SESSION['ADEVIRP_SLUG']);
                }else{
                    header('Location: '.URL.'relatorios/'.$_SESSION['ADEVIRP_SLUG']);
                }
            }else{
                header('Location: '.URL.'relatorios/'.$_SESSION['ADEVIRP_SLUG']);
            }
        }
    }
?>