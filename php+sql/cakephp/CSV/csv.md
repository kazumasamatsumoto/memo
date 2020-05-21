## PHP CakePHP CSVダウンロード

ダウンロードのためにCSVを作る場合、implode()などを使って、変数上でCSVを作成する方法では、値内のダブルコートや改行のエスケープが面倒なためfputcsv()を使うといい

```
fputcsv(リソース, 配列)
```

現実的な方法として、一旦メモリ上にCSVを作成してから出力する方法とCSV形式を都度出力する方法がある

### 一旦メモリ上にCSVを作成してから出力

都度で出力に比べ一旦作ることで、Content-lengthを出力することができるので、ブラウザの「ダウンロード残り時間」を表示できる
一旦ファイルにCSVを作成してからreadfileで出力する方法は、ディスクIOが大きくパフォーマンスに問題があるので、一旦作るならメモリ上に作成するのが良い

### CakePHPでの書き方

```
// メモリ上に領域確保
$fp = fopen('php://temp/maxmemory:'.(5*1024*1024),'a');

$user_list = [
    [...],
    [...],
    [...],
];

foreach($user_list as $user)
{
    fputcsv($fp, &user);
}

// ビューを使わない
$this->autoRender = false;

// download()ないではheader("Content-Disposition: attachment; filename=hoge.csv")を行っている
$this->response->download("hoge.csv");

// ファイルポイントを先頭へ
$rewind($fp);

// リソースを読み込み文字列を取得する
$csv = stream_get_contents($fp);

// Content-Typeを指定
$this->response->type('csv');

// CSVをエクセルで開くことを想定して文字コードをSJIS-win
$csv = mb_convert_encoding($csv, 'SJIS-win', 'utf8');

this->response->body($csv);

fclose($fp);
```
