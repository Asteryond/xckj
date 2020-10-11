<?php

$config = require("config/config.php");
require "sql/ConnectMySQL.php";

$mySQlConnection = new ConnectMySQL(['host'=>$config['db']['hostname'],
    'login'=>$config['db']['login'],
    'pass'=>$config['db']['password'],
    'db'=>$config['db']['dbname']]);


//TODO: 检查访问方式
if(isset($_GET['id']))
{
    echo queryScore($_GET['id']);
}


function getRank()
{
    global $mySQlConnection;

    $sql = "SELECT * FROM members ORDER BY scores DESC;";

    $result = $mySQlConnection->query($sql);
    $members = array();

    if($result->num_rows > 0)
    {
        while($row = $result->fetch_assoc())
        {
            $member = array("id"=>$row['id'],"name"=> $row['name'], "team"=> queryTeam($row['team']),
                "scores"=>$row['scores'],"sellingPoints"=>$row['SellingPoints'],
                "recruitmentPoints"=>$row['RecruitmentPoints'],"propagandaPoints"=>$row['PropagandaPoints'],
                "meetingPoints"=>$row['MeetingPoints'],'otherPoints'=>$row['OtherPoints']);
            array_push($members, $member);
        }
        return json_encode($members, JSON_UNESCAPED_UNICODE);
    }
    return 'none';

}

//查询分数
function queryScore($id){

    global $mySQlConnection;
    $sql = "SELECT SellingPoints, RecruitmentPoints, PropagandaPoints,MeetingPoints,OtherPoints FROM members WHERE id = {$id};";
    $res = $mySQlConnection->query($sql);
    $scores = array();
    if ($res->num_rows > 0)
    {
        $row = $res->fetch_assoc();
        $scores["sP"] = $row['SellingPoints'];
        $scores[ "rP"] = $row['RecruitmentPoints'];
        $scores['pP'] = $row['PropagandaPoints'];
        $scores['mP']=$row['MeetingPoints'];
        $scores['oP']= $row['OtherPoints'];

        return json_encode($scores);
    }
    return 'none';
}


//查询团队
function queryTeam($teamNUm)
{
    switch ($teamNUm) {
        case 1:
            return '西华大学团队';
    }
    return 'None';
}


