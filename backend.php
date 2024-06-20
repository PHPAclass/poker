<?php
    ini_set('display_errors', 1);
    require_once('player.php');
    session_start();


    function main()
    {
      //post通信が来た時
        if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_POST['select']))){
          switch ($_POST['select'])
          {
            case "raise": //raiseが押された時に呼ぶ関数
              raise();
              break;
            case "call": //callが押された時に呼ぶ関数
              call();
              break;
            case "fold": //foldが押された時に呼ぶ関数
              fold();
              break;
          }
          judge();

        } else{
          start();
        }
    }

    function start()
    {
        //turnをSESSIONで管理したい
        $_SESSION['turn'] = 0;

        $_SESSION['judge'] = False;
        $_SESSION['player_turn'] = 'your'; #自分を1とする
        $_SESSION['your_status'] = new Player(10000, 100);
        $_SESSION['enemy2_status'] = new Player(10000, 100);
        $_SESSION['enemy3_status'] = new Player(10000, 100);
        $_SESSION['enemy4_status'] = new Player(10000, 100);
        $_SESSION['total_pot'] = 0;
        $_SESSION['participants'] = ['your','enemy2','enemy3','enemy4'];



        $loadedCards = dealCards(); //ランダムでカードを持ってきてる


        // 下の部分でプレイヤーのカードを全て管理してる(sessionに入れてる)
        $enemy3_card = array($loadedCards[0],$loadedCards[1]);
        $_SESSION['enemy3_status']->setCard($enemy3_card);

        $enemy2_card = array($loadedCards[2],$loadedCards[3]);
        $_SESSION['enemy2_status']->setCard($enemy2_card);

        $_SESSION['pots'] = array($loadedCards[4],$loadedCards[5],$loadedCards[6],$loadedCards[7],$loadedCards[8]);

        $enemy4_card = array($loadedCards[9],$loadedCards[10]);
        $_SESSION['enemy4_status']->setCard($enemy4_card);

        $your_card = array($loadedCards[11],$loadedCards[12]);
        $_SESSION['your_status']->setCard($your_card);
    }

    function dealCards()
    {
        $numbers = range(1, 52);
        shuffle($numbers);


        $cards = array_slice($numbers, 0, 13);
        foreach ($cards as $card) {
            $sql = sql($card);
            $i['num'] = $sql['num'];
            $i['type'] = $sql['type'];
            $i['image'] = $sql['image'];
            $result[] = $i;
        }
        return $result;
    }


    function raise(): void
    {
        $yourStack = $_SESSION['your_status']->getStack();
        $_SESSION['your_status']->setStack($yourStack+50);
        $yourStack = $_SESSION['your_status']->getStack();
        $_SESSION['enemy2_status']->setStack($yourStack+50);
        $yourStack = $_SESSION['your_status']->getStack();
        $_SESSION['enemy3_status']->setStack($yourStack+50);
        $yourStack = $_SESSION['your_status']->getStack();
        $_SESSION['enemy4_status']->setStack($yourStack+50);
        $_SESSION['total_pot'] += 200;
        turnControl();
    }

    function call()
    {
      turnControl();
        return 0;
    }

    function fold()
    {


        $user = $_SESSION['player_turn'];
        $_SESSION["{$user}_status"]->setPlaying(False);

        // switch ($_SESSION['player_turn'])
        // {
        //     case 1:
        //         $yourMoney = $_SESSION['your_status']->getMoney();
        //         $yourMoney -= $_SESSION['your_status']->getStack();
        //         $_SESSION['your_status']->setMoney($yourMoney);
        //         break;
        //     case 2:
        //         $enemy2Money = $_SESSION['enemy2_status']->getMoney();
        //         $enemy2Money -= $_SESSION['enemy2_status']->getStack();
        //         $_SESSION['enemy2_status']->setMoney($enemy2Money);
        //         break;
        //     case 3:
        //         $enemy3Money = $_SESSION['enemy3_status']->getMoney();
        //         $enemy3Money -= $_SESSION['enemy3_status']->getStack();
        //         $_SESSION['enemy3_status']->setMoney($enemy3Money);
        //         break;
        //     case 4:
        //         $enemy4Money = $_SESSION['enemy4_status']->getMoney();
        //         $enemy4Money -= $_SESSION['enemy4_status']->getStack();
        //         $_SESSION['enemy4_status']->setMoney($enemy4Money);
        //         break;
        //     default:
        //         var_dump($_SESSION['player_turn']);
        // }
        // turnControl();
    }

    function continueGame()
    {
      return 0;

    }

    /**
     * $_SESSION['pots'] はフィールド上のカード
     *
     * $cardsには、potの5枚とユーザーの手札の2枚の合計7枚欲しい
     */
    function judge($cards)
    {
        $values = [];
        $type = [];

        foreach ($cards as $card) {
            $values[] = $card[0];
            $type[] = $card[1];
        }

        sort($values);

        $isflush = count(array_unique($type)) == 1;
    }

    function checkRole($your_cards)
    {

    }

    function enemyAction()
    {
        return 0;
    }

    function sql($id)
    {
        $dsn = 'mysql:dbname=play_card;host=localhost';
        $user = 'root';
        $password = '';

        try {
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $query = "SELECT * FROM card_variations where id = {$id}";
            $stmt = $dbh->query($query);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $stmt = null;
            $dbh = null;
            $dsn = null;
            return $result;

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    function sqljudge($id, $sql)
    {
        $dsn = 'mysql:dbname=play_card;host=localhost';
        $user = 'root';
        $password = '';

        try {
            $dbh = new PDO($dsn, $user, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

            $query = $sql;
            $stmt = $dbh->query($query);

        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    //何ターン目かチェックしたい
    function turnControl(){
      $currentTurn = $_SESSION['turn'];
      if ($currentTurn == 5){
        //結果を計算する関数を呼びだず(結果も表示したい)
      }
      $_SESSION['turn'] += 1;
    }
