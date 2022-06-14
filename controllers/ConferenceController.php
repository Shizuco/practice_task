<?php

//include_once ROOT . '/models/Conference.php';
require_once ROOT . '/models/Conference.php';
use models\Conference as Conference;

class ConferenceController{

    public function actionIndex(){

        $conferenceList = array();
        $conferenceList = Conference::getAllConferences();

        require_once(ROOT . '/views/index.php');
        return true;
    }

    public function actionView($id){
        if($id){
            $conferenceItem = Conference::GetConferenceById($id);
            require_once (ROOT . '/views/view.php');
            return true;
        }
    }

    public function actionDelete($id){
        Conference::deleteConference($id);
        header("Location: /conference");
        require_once (ROOT . '/views/delete.php');
        return true;
    }

    public function actionEdit($id, $options){
        $conferenceItem = Conference::GetConferenceById($id);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $options['title'] = $_POST['title'];
            $options['address_lat'] = $_POST['address_lat'];
            $options['address_lon'] = $_POST['address_lon'];
            $options['country'] = $_POST['country'];
            $options['date'] = $_POST['date'];
            $options['time'] = $_POST['time'];

            $idp = Conference::editConference($id, $options);
            if($idp =! 0){
                header("Location: /conference");
            }
        }
        require_once (ROOT . '/views/edit.php');
        return true;
    }

    public function actionAdd($options){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $options['title'] = $_POST['title'];
            $options['address_lat'] = $_POST['address_lat'];
            $options['address_lon'] = $_POST['address_lon'];
            $options['country'] = $_POST['country'];
            $options['date'] = $_POST['date'];
            $options['time'] = $_POST['time'];

            $id = Conference::addConference($options);
            if($id =! 0){
                header("Location: /conference");
            }
        }
        require_once (ROOT . '/views/add.php');
        return true;
    }
}