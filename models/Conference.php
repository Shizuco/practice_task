<?php

namespace models;
//include_once ROOT . '/components/Db.php';
require_once ROOT . '/components/Db.php';
use components\Db as Db;
use PDO;

class Conference{

    public static function getConferenceById($id){
        $id = $id[0];
        if($id){
            $db = Db::GetConnected();
            $result = $db->query('SELECT * FROM conference WHERE id=' . $id);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $conferenceItem = $result->fetch();
            return $conferenceItem;
        }
    }

    public static function getAllConferences(){
        $db = Db::GetConnected();

        $conferenceList = array();
        $result = $db->query('SELECT * FROM conference');
        $i = 0;
        while($row = $result->fetch()){
            $conferenceList[$i]['date'] = $row['date'];
            $conferenceList[$i]['id'] = $row['id'];
            $conferenceList[$i]['title'] = $row['title'];
            $conferenceList[$i]['country'] = $row['country'];
            $conferenceList[$i]['address_lon'] = $row['address_lon'];
            $conferenceList[$i]['address_lat'] = $row['address_lat'];
            $conferenceList[$i]['time'] = $row['time'];
            $i++;
        }
        return $conferenceList;
    }

    public static function deleteConference($id){
        $id = $id[0];
        $db = Db::GetConnected();
        $count = $db->exec("DELETE FROM conference WHERE id=" .$id);
        echo $count;
        return $count;
    }

    public static function editConference($id, $options){
        $id = $id[0];
        $db = Db::GetConnected();
        $sql = "UPDATE conference SET title=?, address_lat=?, address_lon=?, country=?, date=?, time=? WHERE id=?";
        $db->prepare($sql)->execute([$options['title'], $options['address_lat'], $options['address_lon'], $options['country'], $options['date'], $options['time'], $id]);
        return 1;
    }

    public static function addConference($options){

        $db = Db::GetConnected();

        $sql = "INSERT INTO conference (title, address_lat, address_lon, country, date, time) VALUES (:title, :address_lat, :address_lon, :country, :date, :time)";

        $result = $db->prepare($sql);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':address_lat', $options['address_lat'], PDO::PARAM_INT);
        $result->bindParam(':address_lon', $options['address_lon'], PDO::PARAM_INT);
        $result->bindParam(':country', $options['country'], PDO::PARAM_INT);
        $result->bindParam(':date', $options['date'], PDO::PARAM_STR);
        $result->bindParam(':time', $options['time'], PDO::PARAM_STR);

        if($result->execute()){
            return $db->lastInsertId();
        }
        return 0;
    }
}