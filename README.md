opMultiExecutableTaskPlugin
===========================


実行時間やメモリを消費するタスクの実行をプロセスレベルで分割して実行できるようにするプラグイン
クロージャを用いるため PHP 5.3 以上が必須

    protected function execute($arguments = array(), $options = array())
    {
      parent::execute($arguments, &$options); # 親クラスでこのプロセスが実行するべきオプションを設定
      # 実際に処理する部分
    }


    /**
     * このメソッドで実行するときのオプションを指定する
     * 配列を返すクロージャを返す
     *
     * 下記の例は from から to を 10 ずつ 100 までインクリメントした値を返す．
     */
    protected function nextOptions()
    {
      $i = 0;
      $max = 100;
      return function() use (&$i, $max)
      {
        if ($i > $max)
        {
          return false;
        }

        return array(
          'from' => $i,
          'to' => $i + 10,
        );
        $i += 10;
      }
    }
