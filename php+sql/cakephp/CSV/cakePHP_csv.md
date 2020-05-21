## PHP CSV出力のサンプルコード CakePHP

研修にてCakePHPでCSV出力の実装のサンプルコード

### 環境
PHPのバージョン...5.6.35
CakePHPのバージョン...3.6.3

### 流れをざっくり
基本的には以下のような流れとなります
① ファイル作成し開く
② ファイルに内容を書き込む
③ ファイルを閉じる

### サンプルコード
view(search.ctp)
```
<a href="<?= $this->Url-?build('sales/export') ?>" class="btn btn-success">
<span class="glyphicon glyphicon-download" aria-hidden="true">CSV出力</span>
</a>
```

controller(SalesController.php)
```
// CSV出力
public function export()
{
    // 出力する値の設定
    $sales = array(
        array(1, "ラザニア", 500),
        array(2, "生姜焼き", 450),
        array(3, "かつおのお刺身", 350)
    );

    // 保存場所とファイルの設定
    $file = '/var/www/html/cake3/webroot/csv/' . date('YmdHis') . '.csv';

    // ファイルを書き込み用で開く
    $f = fopen($file, 'w');

    // 正常にファイルを開けていれば書き込む
    if ($f) {
        // ヘッダーの出力
        $header = array("NO.", "商品名", "値段");
        fputcsv($f, $header);

        // データの出力
        foreach($sales as $sale){
            // 出力するデータを整形
            $data = array(
                $sale[0], // NO.
                $sale[1], // 商品名
                $sale[2] // 値段
            );

            // ファイルに書き込み
            fputcsv($f, $data);
        }

        // ファイルを閉じる
        fclose($f);

        // 成功メッセージ
        $this->Flash->success(__('CSV outputted.'));
    } else {
        // 失敗メッセージ
        $this->Flash->error(__('CSV output failure.'));
    }
    // 検索結果画面に遷移
    return $this->redirect(['action' => 'search']);

}

```

ポイントは
fopen
fputcsv()
fclose

に3つが重要