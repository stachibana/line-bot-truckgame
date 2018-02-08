<?php

require_once __DIR__ . '/vendor/autoload.php';
define('TABLE_NAME_USERS', 'users');

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);
$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];

$userInfo = array();

$stageJsonArray = array(
  array('par' => 4, 'json' => '[["w","w","f","g"],["w","t","f","t"],["f","f","f","f"],["s","t","w","f"]]'),
  array('par' => 5, 'json' => '[["f","w","w","g"],["t","f","t","f"],["f","f","w","f"],["s","t","w","f"]]'),
  array('par' => 5, 'json' => '[["w","f","t","g"],["f","f","w","f"],["f","t","f","f"],["s","f","f","w"]]'),
  array('par' => 10, 'json' => '[["w","w","f","g"],["f","f","t","w"],["f","t","f","f"],["s","w","f","f"]]'),
  array('par' => 7, 'json' => '[["t","w","f","g"],["f","w","w","f"],["f","t","f","t"],["s","f","f","w"]]'),

  array('par' => 13, 'json' => '[["w","w","f","f","g"],["w","t","f","t","w"],["w","f","t","w","w"],["f","t","w","t","w"],["s","f","f","f","w"]]'),
  array('par' => 10, 'json' => '[["t","f","w","w","g"],["f","t","w","w","f"],["f","f","f","t","f"],["w","t","w","f","w"],["s","f","f","t","w"]]'),
  array('par' => 9, 'json' => '[["f","t","w","f","g"],["f","f","w","w","f"],["w","f","f","t","f"],["w","t","w","f","w"],["s","f","f","t","w"]]'),
  array('par' => 11, 'json' => '[["f","t","w","f","g"],["f","f","t","w","f"],["w","f","f","t","f"],["t","t","w","f","w"],["s","f","f","t","f"]]'),
  array('par' => 10, 'json' => '[["t","f","w","w","g"],["w","f","f","f","t"],["f","f","w","f","w"],["t","t","w","f","w"],["s","f","f","t","w"]]'),


  array('par' => 12, 'json' => '[["f","f","t","f","f","f"],["w","w","f","w","t","f"],["f","t","f","f","t","f"],["f","f","f","w","f","f"],["f","f","f","f","f","w"],["f","f","w","t","t","t"]]'),
  array('par' => 10, 'json' => '[["w","w","f","f","f","g"],["t","f","f","t","w","f"],["t","t","f","f","f","f"],["t","f","f","f","t","f"],["f","f","f","t","f","w"],["s","f","w","f","f","f"]]'),
  array('par' => 17, 'json' => '[["f","w","w","w","f","g"],["f","f","f","w","t","f"],["w","t","t","w","f","f"],["f","f","w","f","f","f"],["w","f","f","f","t","t"],["s","t","f","t","w","w"]]'),
  array('par' => 19, 'json' => '[["f","f","w","f","f","g"],["f","t","f","w","w","f"],["f","w","t","f","f","f"],["w","f","t","f","w","t"],["t","t","t","f","t","w"],["s","f","w","w","f","f"]]'),
  array('par' => 14, 'json' => '[["t","f","f","t","t","g"],["w","f","f","t","t","f"],["f","t","f","f","t","w"],["f","f","t","t","f","w"],["t","w","w","t","f","f"],["s","f","w","t","w","w"]]'),
  array('par' => 15, 'json' => '[["w","f","t","f","f","g"],["f","f","w","f","w","f"],["t","f","t","f","f","f"],["w","t","t","w","f","f"],["f","f","f","t","t","w"],["s","t","f","w","f","t"]]'),
  array('par' => 19, 'json' => '[["f","f","t","w","f","g"],["w","f","f","f","f","w"],["w","w","f","f","f","w"],["f","t","t","f","w","f"],["w","t","f","t","t","w"],["s","t","f","t","f","w"]]'),
  array('par' => 14, 'json' => '[["f","f","w","f","t","g"],["f","f","f","t","f","f"],["f","w","f","t","t","t"],["f","w","t","f","f","w"],["t","f","f","w","f","f"],["s","t","f","f","w","w"]]'),
  array('par' => 14, 'json' => '[["w","f","f","f","w","g"],["f","t","f","f","f","f"],["t","f","f","w","f","w"],["w","w","w","w","f","f"],["f","t","w","f","t","t"],["s","f","t","t","w","f"]]'),
  array('par' => 16, 'json' => '[["w","w","t","f","f","g"],["t","w","f","t","t","f"],["f","f","f","w","w","w"],["t","w","f","f","f","t"],["t","f","t","f","t","f"],["s","f","w","t","f","f"]]'),


  array('par' => 15, 'json' => '[["w","t","f","w","f","g"],["f","t","f","f","f","f"],["w","f","f","f","f","w"],["f","f","f","f","w","w"],["w","w","w","f","t","f"],["s","f","f","f","f","f"]]'),
  array('par' => 18, 'json' => '[["w","f","w","f","t","g"],["f","w","f","f","w","w"],["t","w","f","t","f","w"],["f","t","t","t","t","f"],["w","f","t","t","t","f"],["s","f","f","w","t","f"]]'),
  array('par' => 18, 'json' => '[["w","w","w","f","t","g"],["f","f","w","t","w","f"],["f","t","f","t","f","f"],["t","w","w","f","f","w"],["f","w","t","w","t","f"],["s","w","t","f","f","f"]]'),
  array('par' => 18, 'json' => '[["t","w","f","f","f","g"],["f","t","f","w","t","f"],["f","f","f","f","f","f"],["f","t","w","w","f","f"],["w","f","f","t","t","w"],["s","f","w","f","f","f"]]'),
  array('par' => 17, 'json' => '[["w","w","t","f","t","g"],["w","w","f","t","f","t"],["t","f","w","w","f","w"],["f","f","t","f","f","w"],["t","f","t","t","t","f"],["s","t","t","w","f","f"]]'),
  array('par' => 18, 'json' => '[["t","t","w","t","t","g"],["t","t","f","f","w","f"],["f","f","f","t","f","w"],["t","t","f","t","f","t"],["w","t","f","t","t","w"],["s","f","f","w","w","f"]]'),
  array('par' => 12, 'json' => '[["w","w","w","w","f","g"],["f","f","t","w","f","t"],["f","w","w","w","f","f"],["t","w","t","f","t","f"],["t","f","f","f","f","f"],["s","f","t","w","t","w"]]'),
  array('par' => 14, 'json' => '[["f","t","f","f","t","g"],["f","w","w","w","f","t"],["f","f","t","t","f","w"],["f","w","f","f","f","w"],["f","f","f","f","w","t"],["s","t","f","f","t","f"]]'),
  array('par' => 13, 'json' => '[["w","t","f","w","t","g"],["f","w","f","f","t","f"],["f","f","t","w","f","w"],["w","f","f","w","f","t"],["f","t","f","f","f","f"],["s","f","t","w","t","f"]]'),
  array('par' => 16, 'json' => '[["t","f","w","f","t","g"],["w","f","f","f","f","f"],["t","f","t","f","f","w"],["t","w","w","f","f","f"],["f","f","f","t","f","f"],["s","w","f","f","w","f"]]'),
);

$stageWidth = 0;
$selectedStage = array();

try {
  $events = $bot->parseEventRequest(file_get_contents('php://input'), $signature);
} catch(\LINE\LINEBot\Exception\InvalidSignatureException $e) {
  error_log('parseEventRequest failed. InvalidSignatureException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\UnknownEventTypeException $e) {
  error_log('parseEventRequest failed. UnknownEventTypeException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\UnknownMessageTypeException $e) {
  error_log('parseEventRequest failed. UnknownMessageTypeException => '.var_export($e, true));
} catch(\LINE\LINEBot\Exception\InvalidEventRequestException $e) {
  error_log('parseEventRequest failed. InvalidEventRequestException => '.var_export($e, true));
}

foreach ($events as $event) {
  if (!($event instanceof \LINE\LINEBot\Event\MessageEvent)) {
    error_log('Non message event has come');
    continue;
  }

  registerUser($event->getUserId());

  $userInfo = getUserInfo($event->getUserId());
  if($userInfo['stageindex'] >= 0) {
    $selectedStage = json_decode($stageJsonArray[$userInfo['playing']]['json']);
    $selectedStagePar = $stageJsonArray[$userInfo['playing']]['par'];
  }

  $stageWidth = count($selectedStage);

  if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {

    if(substr($event->getText(), 0, 4) == "cmd_") {

      if(substr($event->getText(), 4) == "stage_select") {
        $actionArray = array();

        for($i = 0; $i < 6; $i++) {
          for($j = 0; $j < 5; $j++) {
            array_push($actionArray, new LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder(
              'stage_' . str_pad(($i * 5 + $j % 5) + 1, 2, 0, STR_PAD_LEFT),
              new LINE\LINEBot\ImagemapActionBuilder\AreaBuilder(89 + ($j % 5) * 180, 30 + $i * 172, 143, 120)));

          }
        }
        $imageMapMessageBuilder = new \LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder (
          "https://" . $_SERVER["HTTP_HOST"] .  "/stage_select/" . urlencode($userInfo['cleararray'] . "|" . $userInfo['pararray'] . "|" . uniqid()), // to prevent cache
          'stageselect',
          new LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder(1040, 1040),
          $actionArray
        );
        $bot->replyMessage($event->getReplyToken(), $imageMapMessageBuilder);
        continue;
      }
      else if(substr($event->getText(), 4) == "help") {
        $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
        $builder->add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('今日からトラックの運転手！荷物を全部拾ってからゴールに向かってね！トラックは壁か木にぶち当たるまで止まれないので' .
          'どう進むかよく考えてね！画像の上下左右の半透明の三角をタップするとその方向に進むよ！下の「オプション」「ステージ選択」をタップしてゲームスタート！'));
        $builder->add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('もし楽しんでもらえたら右上のボタンから友だちにもおすすめしてね！プレイヤーが増えたら新しいステージも追加します！'));
        $bot->replyMessage($event->getReplyToken(), $builder);
        continue;
      }
      else if(substr($event->getText(), 4) == "u" ||
      substr($event->getText(), 4) == "r" ||
      substr($event->getText(), 4) == "d" ||
      substr($event->getText(), 4) == "l") {

        $pos = json_decode($userInfo['carpos'], true);

        if(substr($event->getText(), 4) == "u") {
          if($pos[0] == 0 || $selectedStage[$pos[0] - 1][$pos[1]] == "w") {
            $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
            $builder->add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('上には進めないよ！'));
            $bot->replyMessage($event->getReplyToken(), $builder);
            continue;
          }
        }
        if(substr($event->getText(), 4) == "d") {
          if($pos[0] == $stageWidth - 1 || $selectedStage[$pos[0] + 1][$pos[1]] == "w") {
            $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
            $builder->add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('下には進めないよ！'));
            $bot->replyMessage($event->getReplyToken(), $builder);
            continue;
          }
        }
        if(substr($event->getText(), 4) == "l") {
          if($pos[1] == 0 || $selectedStage[$pos[0]][$pos[1] - 1] == "w") {
            $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
            $builder->add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('左には進めないよ！'));
            $bot->replyMessage($event->getReplyToken(), $builder);
            continue;
          }
        }
        if(substr($event->getText(), 4) == "r") {
          if($pos[1] == $stageWidth - 1 || $selectedStage[$pos[0]][$pos[1] + 1] == "w") {
            $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
            $builder->add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('右には進めないよ！'));
            $bot->replyMessage($event->getReplyToken(), $builder);
            continue;
          }
        }

        moveCar($bot, $event->getUserId(), $event->getReplyToken(), substr($event->getText(), 4));
      }
      continue;
    }
    if(substr($event->getText(), 0, 6) == "stage_") {
      if(is_numeric(substr($event->getText(), 6)) && intval(substr($event->getText(), 6)) <= 30) {

        $userInfo = startStage($event->getUserId(), intval(substr($event->getText(), 6) - 1));

        $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
        $builder->add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('stage' . intval(substr($event->getText(), 6))));

        $builder->add(getImagemapMessage(true));
        $builder->add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('PAR : ' . $stageJsonArray[$userInfo['playing']]['par']));

        $response = $bot->replyMessage($event->getReplyToken(), $builder);
        if(!$response->isSucceeded()) {
          error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
        }
      }
    }


    continue;
  }

  $bot->replyText($event->getReplyToken(), $event->getText());
}


function getImagemapMessage($canTap) {
  global $userInfo;

  $actionArray = array();
  if($canTap) {
    array_push($actionArray, new LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder(
          'cmd_u',
          new LINE\LINEBot\ImagemapActionBuilder\AreaBuilder(206, 36, 616, 179)));
    array_push($actionArray, new LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder(
          'cmd_r',
          new LINE\LINEBot\ImagemapActionBuilder\AreaBuilder(825, 231, 205, 572)));
    array_push($actionArray, new LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder(
          'cmd_d',
          new LINE\LINEBot\ImagemapActionBuilder\AreaBuilder(217, 832, 616, 192)));
    array_push($actionArray, new LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder(
          'cmd_l',
          new LINE\LINEBot\ImagemapActionBuilder\AreaBuilder(3, 228, 223, 590)));
  } else {
    array_push($actionArray, new LINE\LINEBot\ImagemapActionBuilder\ImagemapMessageActionBuilder(
          '-',
          new LINE\LINEBot\ImagemapActionBuilder\AreaBuilder(0, 0, 1, 1)));
  }
  $imageMapMessageBuilder = new \LINE\LINEBot\MessageBuilder\ImagemapMessageBuilder (
    "https://" . $_SERVER["HTTP_HOST"] .  "/images/" . urlencode($userInfo['playing'] . "|" . $userInfo['treasures'] . "|" . $userInfo['carpos'] . "|" . $userInfo['cardirection'] . "|" . $canTap . "|" . uniqid()), // to prevent cache
    'stage',
    new LINE\LINEBot\MessageBuilder\Imagemap\BaseSizeBuilder(1040, 1040),
    $actionArray
  );
  return $imageMapMessageBuilder;
}

function registerUser($userId) {
  $dbh = dbConnection::getConnection();
  $sql = 'select * from ' . TABLE_NAME_USERS . ' where ? = pgp_sym_decrypt(userid, \'' . getenv('DB_ENCRYPT_PASS') . '\')';
  $sth = $dbh->prepare($sql);
  $sth->execute(array($userId));
  $result = $sth->fetchAll();
  if(count($result) == 0) {
    $weatherArray = array();
    for($i = 0; $i < 30; $i++) {
      if(rand(0, 10) < 4) {
        array_push($weatherArray, "r");
      } else {
        array_push($weatherArray, "s");
      }
    }
    $sql = 'insert into '. TABLE_NAME_USERS .' (userid, cleararray, pararray, playing, step, treasures, carpos, cardirection) values (pgp_sym_encrypt(?, \'' . getenv('DB_ENCRYPT_PASS') . '\'), ?, ?, ?, ?, ?, ?, ?) returning *';
    $sth = $dbh->prepare($sql);
    $sth->execute(array($userId, json_encode(array()), json_encode(array()), -1, 0, json_encode(array()), json_encode(array()), 'u'));
    return true;
  }
}

function startStage($userId, $stageIndex) {
  $stageSize = 4;
  if($stageIndex < 5) {
    $stageSize = 4;
  } else if($stageIndex < 10) {
    $stageSize = 5;
  } else {
    $stageSize = 6;
  }
  $dbh = dbConnection::getConnection();
  $sql = 'update ' . TABLE_NAME_USERS . ' set (playing, step, carpos, treasures, cardirection) = (?, ?, ?, ?, ?) where ? = pgp_sym_decrypt(userid, \'' . getenv('DB_ENCRYPT_PASS') . '\') returning *';
  $sth = $dbh->prepare($sql);
  $sth->execute(array($stageIndex, 0, json_encode(array($stageSize - 1, 0)), json_encode(array()), 'u', $userId));
  if($row = $sth->fetch()) {
    return $row;
  }
}

function getUserInfo($userId) {

  $dbh = dbConnection::getConnection();
  $sql = 'select * from ' . TABLE_NAME_USERS . ' where ? = pgp_sym_decrypt(userid, \'' . getenv('DB_ENCRYPT_PASS') . '\')';
  $sth = $dbh->prepare($sql);
  $sth->execute(array($userId));
  if($row = $sth->fetch()) {
    return $row;
  }
}

function moveCar($bot, $userId, $replyToken, $direction) {
  global $userInfo, $selectedStage, $selectedStagePar, $stageWidth;
  $pos = json_decode($userInfo['carpos'], true);

  $newRow = $pos[0];
  $newCol = $pos[1];
  switch ($direction) {
    case "u":
    for($i = 0; $i < $pos[0]; $i++) {
      if(($selectedStage[$pos[0] - 1 - $i][$pos[1]]) == "w") {
        $newRow = $pos[0] - $i;
        break;
      }
      $newRow = 0;
    }
    break;
    case "d":
    for($i = 0; $i < (count($selectedStage) - 1) - $pos[0]; $i++) {
      if(($selectedStage[$pos[0] + 1 + $i][$pos[1]]) == "w") {
        $newRow = $pos[0] + $i;
        break;
      }
      $newRow = (count($selectedStage) - 1);
    }
    break;
    case "l":
    for($i = 0; $i < $pos[1]; $i++) {
      if(($selectedStage[$pos[0]][$pos[1] - 1 - $i]) == "w") {
        $newCol = $pos[1] - $i;
        break;
      }
      $newCol = 0;
    }
    break;
    case "r":
    for($i = 0; $i < (count($selectedStage) - 1) - $pos[1]; $i++) {
      if(($selectedStage[$pos[0]][$pos[1] + 1 + $i]) == "w") {
        $newCol = $pos[1] + $i;
        break;
      }
      $newCol = (count($selectedStage) - 1);
    }
    break;
  }

  $newPos = array($newRow, $newCol);

  $alreadyGotTreasure = json_decode($userInfo['treasures'], true);
  $treasurePosArray = array();
  for($i = 0; $i < $stageWidth; $i++) {
    for($j = 0; $j < $stageWidth; $j++) {
      if($selectedStage[$i][$j] == "t") {
        array_push($treasurePosArray, array($i, $j));
      }
    }
  }

  $gotTreasure = array();
  $allPos = getAllPosByTwoPos($pos, $newPos);
  foreach($allPos as $p) {
    foreach($treasurePosArray as $t) {
      if($p[0] == $t[0] && $p[1] == $t[1]) {
        array_push($gotTreasure, $t);
      }
    }
  }
  $merged = array_merge($alreadyGotTreasure, $gotTreasure);
  $merged = array_unique($merged, SORT_REGULAR);
  $merged = array_values($merged);

  $dbh = dbConnection::getConnection();
  $sql = 'update ' . TABLE_NAME_USERS . ' set (step, carpos, cardirection, treasures) = (?, ?, ?, ?) where ? = pgp_sym_decrypt(userid, \'' . getenv('DB_ENCRYPT_PASS') . '\') returning *';
  $sth = $dbh->prepare($sql);
  $sth->execute(array($userInfo['step'] + 1, json_encode($newPos), $direction, json_encode($merged), $userId));
  if($row = $sth->fetch()) {
    $userInfo = $row;
  }

  if($newPos[0] == 0 && $newPos[1] == $stageWidth - 1 && count($merged) == count($treasurePosArray)) {
    if($userInfo['step'] <= $selectedStagePar) {
      $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
      $builder->add(getImagemapMessage(false));
      $builder->add(new \LINE\LINEBot\MessageBuilder\StickerMessageBuilder(1, 4));

      $actionArray = array();
      array_push($actionArray, new LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder('次', 'stage_' . str_pad($userInfo['playing'] + 2, 2, 0, STR_PAD_LEFT)));
      array_push($actionArray, new LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder('選択','cmd_stage_select'));
      $confirmBuilder = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder(
        'おめでとう！',
        new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder ('クリアおめでとう！PAR条件クリアだよ！', $actionArray)
      );
      $builder->add($confirmBuilder);
      $bot->replyMessage($replyToken, $builder);

      if($userInfo['playing'] != 0 && ($userInfo['playing'] + 1) % 5 == 0) {
        $builder->add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('もし楽しんでもらえてるなら是非右上のボタンから友だちにもおすすめしてね！プレイヤーが増えたらもっとステージを追加するよ！'));
      }

      $parArray = json_decode($userInfo['pararray'], true);
      array_push($parArray, $userInfo['playing']);
      $parArray = array_unique($parArray, SORT_REGULAR);
      $parArray = array_values($parArray);

      $clearArray = json_decode($userInfo['cleararray'], true);
      $clearArray = array_diff($clearArray, array($userInfo['playing']));
      $clearArray = array_unique($clearArray, SORT_REGULAR);
      $clearArray = array_values($clearArray);

      $sql = 'update ' . TABLE_NAME_USERS . ' set (step, playing, pararray, cleararray) = (?, ?, ?, ?) where ? = pgp_sym_decrypt(userid, \'' . getenv('DB_ENCRYPT_PASS') . '\') returning *';
      $sth = $dbh->prepare($sql);
      $sth->execute(array(0, -1, json_encode($parArray), json_encode($clearArray), $userId));
      if($row = $sth->fetch()) {
        $userInfo = $row;
      }

    } else {
      $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
      $builder->add(getImagemapMessage(false));
      $builder->add(new \LINE\LINEBot\MessageBuilder\StickerMessageBuilder(1, 106));
      $actionArray = array();
      array_push($actionArray, new LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder('次', 'stage_' . str_pad($userInfo['playing'] + 2, 2, 0, STR_PAD_LEFT)));
      array_push($actionArray, new LINE\LINEBot\TemplateActionBuilder\MessageTemplateActionBuilder('選択','cmd_stage_select'));
      $confirmBuilder = new \LINE\LINEBot\MessageBuilder\TemplateMessageBuilder(
        'おめでとう！',
        new \LINE\LINEBot\MessageBuilder\TemplateBuilder\ConfirmTemplateBuilder ('クリアおめでとう！PAR条件以内でクリアできるよう頑張ってね！', $actionArray)
      );
      $builder->add($confirmBuilder);
      $bot->replyMessage($replyToken, $builder);

      $clearArray = json_decode($userInfo['cleararray'], true);
      array_push($clearArray, $userInfo['playing']);
      $clearArray = array_unique($clearArray, SORT_REGULAR);
      $clearArray = array_values($clearArray);

      $sql = 'update ' . TABLE_NAME_USERS . ' set (step, playing, cleararray) = (?, ?, ?) where ? = pgp_sym_decrypt(userid, \'' . getenv('DB_ENCRYPT_PASS') . '\') returning *';
      $sth = $dbh->prepare($sql);
      $sth->execute(array(0, -1, json_encode($clearArray), $userId));
      if($row = $sth->fetch()) {
        $userInfo = $row;
      }
    }
    continue;
  }
  else {
    $builder = new \LINE\LINEBot\MessageBuilder\MultiMessageBuilder();
    $builder->add(getImagemapMessage(true));
    $builder->add(new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('手数 : ' . $userInfo['step']));
    $response = $bot->replyMessage($replyToken, $builder);
  }

}

function getAllPosByTwoPos($ar1, $ar2) {
  $result = array();
  array_push($result, $ar1);
  if($ar1[1] == $ar2[1]) {
    if($ar1[0] > $ar2[0]) {
      for($j = 1; $j < $ar1[0] - $ar2[0]; $j++) {
        array_push($result, array($ar1[0] - $j, $ar1[1]));
      }
    }
    else {
      for($j = 1; $j < $ar2[0] - $ar1[0]; $j++) {
        array_push($result, array($ar1[0] + $j, $ar1[1]));
      }
    }
  }
  else {
    if($ar1[1] > $ar2[1]) {
      for($j = 1; $j < $ar1[1] - $ar2[1]; $j++) {
        array_push($result, array($ar1[0], $ar1[1] - $j));
      }
    } else {
      for($j = 1; $j < $ar2[1] - $ar1[1]; $j++) {
        array_push($result, array($ar1[0], $ar1[1] + $j));
      }
    }
  }
  array_push($result, $ar2);

  return $result;
}

// テキストを返信。引数はLINEBot、返信先、テキスト
function replyTextMessage($bot, $replyToken, $text) {
  // 返信を行いレスポンスを取得
  // TextMessageBuilderの引数はテキスト
  $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($text));
  // レスポンスが異常な場合
  if (!$response->isSucceeded()) {
    // エラー内容を出力
    error_log('Failed! '. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// 画像を返信。引数はLINEBot、返信先、画像URL、サムネイルURL
function replyImageMessage($bot, $replyToken, $originalImageUrl, $previewImageUrl) {
  // ImageMessageBuilderの引数は画像URL、サムネイルURL
  $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\ImageMessageBuilder($originalImageUrl, $previewImageUrl));
  if (!$response->isSucceeded()) {
    error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// 位置情報を返信。引数はLINEBot、返信先、タイトル、住所、
// 緯度、経度
function replyLocationMessage($bot, $replyToken, $title, $address, $lat, $lon) {
  // LocationMessageBuilderの引数はダイアログのタイトル、住所、緯度、経度
  $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\LocationMessageBuilder($title, $address, $lat, $lon));
  if (!$response->isSucceeded()) {
    error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// スタンプを返信。引数はLINEBot、返信先、
// スタンプのパッケージID、スタンプID
function replyStickerMessage($bot, $replyToken, $packageId, $stickerId) {
  // StickerMessageBuilderの引数はスタンプのパッケージID、スタンプID
  $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\StickerMessageBuilder($packageId, $stickerId));
  if (!$response->isSucceeded()) {
    error_log('Failed!'. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// 動画を返信。引数はLINEBot、返信先、動画URL、サムネイルURL
function replyVideoMessage($bot, $replyToken, $originalContentUrl, $previewImageUrl) {
  // VideoMessageBuilderの引数は動画URL、サムネイルURL
  $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\VideoMessageBuilder($originalContentUrl, $previewImageUrl));
  if (!$response->isSucceeded()) {
    error_log('Failed! '. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

// オーディオファイルを返信。引数はLINEBot、返信先、
// ファイルのURL、ファイルの再生時間
function replyAudioMessage($bot, $replyToken, $originalContentUrl, $audioLength) {
  // AudioMessageBuilderの引数はファイルのURL、ファイルの再生時間
  $response = $bot->replyMessage($replyToken, new \LINE\LINEBot\MessageBuilder\AudioMessageBuilder($originalContentUrl, $audioLength));
  if (!$response->isSucceeded()) {
    error_log('Failed! '. $response->getHTTPStatus . ' ' . $response->getRawBody());
  }
}

class dbConnection {
  protected static $db;
  private function __construct() {

    try {
      $url = parse_url(getenv('DATABASE_URL'));
      $dsn = sprintf('pgsql:host=%s;dbname=%s', $url['host'], substr($url['path'], 1));
      self::$db = new PDO($dsn, $url['user'], $url['pass']);
      self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch (PDOException $e) {
      echo "Connection Error: " . $e->getMessage();
    }
  }

  public static function getConnection() {
    if (!self::$db) {
      new dbConnection();
    }
    return self::$db;
  }
}


?>
