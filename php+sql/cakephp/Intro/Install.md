## インストール
CakePHPは素早く簡単にインストールできます。最小構成で必要な物は、WebサーバとCakePHPのコピー、それだけです。本項には主に（最も一般的である）Apacheでのセットアップに主眼を置いていますが、CakePHPはnginxやlighttpdやMicrosoft IISのような様々なWebサーバで動きます。

## システム要件
・HTTPサーバ
・PHP5.6以上（PHP7.4も含む）
・mbstring PHP拡張
・intl PHP拡張
・simplexml PHP拡張

```
XAMPP/WAMPのいずれでも,mbstring拡張が初期インストール状態で動きます。
XAMPPではintl拡張は同梱されていますが、php.iniの
extension=php_inil.dll
のコメントを外してXAMPPコントロールパネルからサーバの再起動を行う必要はあります。
WAMPではintl拡張は最初からアクティブになっているのですが動作しません。
動作させるためにはPHPフォルダー（初期状態ではC:\wamp\bin\php\php{version} ）にある icu*.dll というファイルを全て、apache の bin ディレクトリー （ C:\wamp\bin\apache\apache{version}\bin ）にコピーしてから、 全てのサービスを再起動すれば動くようになります。
```

データベースエンジンは必ずしも必要ではありませんが、ほとんどのアプリケーションはこれを活用することが想像できます。
CakePHPは種々のデータベース・ストレージのエンジンをサポートしています。

・MySQL（5.5.3以上）
・MariaDB(5.5以上)
・PostgreSQL
・Microsoft SQL Server(2008以上)
・SQLite 3

```
組み込みのドライバーは全てPDOを必要とします。正しいPDO拡張モジュールがインストールされているか必ず確かめてください。
```

## CakePHPのインストール

