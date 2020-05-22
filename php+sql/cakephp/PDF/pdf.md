## 超絶簡単にCakePHPのViewをPDFに変換する

HTMLをPDFにうまいこと変換してくれるwkhtmltopdfを日本語で使う
ここで紹介したようにHMTLをPDFに変換するベストな選択肢はwkhtmltopdfですよと。

そんでもって、それをCakePHPのViewに使いたいというわけで、便利なプラグインがあったので紹介。

その名もceeram/CakePdf　使い方も簡単。　いくつかの園児任意対応している

### URLに「.pdf」とつけるだけで、ViewをPDFにしてくれる

つまり、そういうことです。普段CakePHPで見ているページを、URLに「.pdf」と付けてアクセスするだけでPDFとしてダウンロードできちゃうわけです。

#### 設定方法
GitHubに書かれているように、プラグインファイル本体をapp/Pluginディレクトリに配置する。

Config/routes.phpに
```
<?php
Router::parseExtensions('pdf')>;
```

と書いて拡張子PDFを有効にする。

Config/bootstrap.phpあたりに
```
<?php
CakePlugin::load('CakePdf', array('bootstrap' => true, 'routes' => true));

>
```

と記述する

同様にbootstrap.phpもしくは使用するコントローラに下記の設定を追記する

```
<?php
Configure::write('CakePdf', array(
    'engine' => 'CakePdf.WkHtmlToPdf', //使用するPDFエンジン
    'binary' => '/usr/loacl/bin/wkhtmltox/bin/wkhtmltopdf', // WkHtmlToPdfバイナリファイルのパス
    'options' => array(
        'print-media-type' => false,
        'outline' => true,
        'dpi' => 96
    ),
    'margin' => array(
        'bottom' => 5,
        'left' => 5,
        'right' => 5,
        'top' => 5
    ),
    'orientation' => 'portrait', // landscape(横)指定もできる
    'download' => true // 表示のみかダウンロードか
));
>
```

ダウンロードのファイル名を都度変更したい場合は
```
<?php
$this->pdfConfig = array(
    'filename' => 'ご請求書_' . $id
);>
```

こんな感じで指定できる

あとは、PDFにしたいURLの一番最後に「.pdf」と付ければ数状でPDFがダウンロードされるはず

