## View

ビューはMVCのVです。ビューはリクエストに対する出力を生成する役割を担います。
たいていの場合は、これはHTMLフォームやXML,JSONなどですが、ファイルのストリーミングや、ユーザがダウンロード可能なPDFの生成もビューレイヤの役割になります。

CakePHPでは下記の典型的な描画シナリオに対応するためのいくつかの組み込みのビュークラスを用意しています。

・XMLやJSONウェブサービスを作成するにはJSONとXMLビューを利用できます
https://book.cakephp.org/3/ja/views/json-and-xml-views.html

・保護されたファイルや動的に生成されたファイルを提供するにはファイルの送信を利用できます
https://book.cakephp.org/3/ja/controllers/request-response.html#cake-response-file

・複数テーマのビューを作成するためにはテーマを利用できます
https://book.cakephp.org/3/ja/views/themes.html

## App View
```AppView```はアプリケーションの規定のビュークラスです。
```AppView```は地震がCakePHPに含まれる```Cake\View\View```クラスを継承していて、src/View/AppView.phpの中で次のように定義されています。

```
<?php
namespace App\View;

use Cake\View\View;

class AppView extends View
{

}
```

アプリケーション中で描画される全てのビューで使われるヘルパーを読み込むために```AppView```を使用することができます。
こうした用途のために、CakePHPはViewのコンストラクターの最後で呼び出される```initialize()```メソッドを提供します。

```
<?php
namespace App\View;

use Cake\View\View;

class AppView extends View
{
    public function initialize()
    {
        $this->loadHelper('MyUtils');
    }
}
```

## ビューテンプレート

CakePHPのビューレイヤ〜は、どのようにユーザーに伝えるかです。ほとんどの場合、ビューはHTML/XHTMLドキュメントをブラウザーに返しますが、JSONを介してリモートアプリケーションに返答したり、CSVファイルを出力する必要もあるかもしれません。

CakePHPのテンプレートファイルは規定の拡張子を.ctp(CakePHP Template)としており、制御構造や出力のためにPHP別の構文を利用することができます。

これらのファイルにはコントローラーから受け取ったデータを、閲覧者のために用意した表示形式に整形するのに必要なロジックを入れます

## 別のecho
テンプレート中の変数をechoまたはprintします。

```
<?php echo $variable; ?>
```

短いタグにも対応しています

<?= $variable ?>

## 別の制御構文
```if```,```for```,```foreach```,```switch```,そして```while```のような制御構文は単純な形式で書くことができます。括弧は必要ないことに注意してください。

代わりに、```foreach```の閉じ括弧は```endforeach```に置き換えられています。

上記の各制御構造は```endif```,```endfor```,```endforeach```,```endwhile```のような閉じ構文を持っています。

各制御構造の後（最後の一つをのぞいて）に```セミコロン(;)```ではなく、```コロン(:)```があることにも注意してください。

以下は```foreach```の使用例ですy。

```
<ul>
<?php foreach ($todo as $item): ?>// ここはコロン
    <li><?= $item ?></li>
<?php endforeach; ?>// ここはセミコロン
</ul>
```

別の例として、```if/elseif/else```の用法です。
コロンに注意してください

```
<?php if ($username === 'sally'): ?>
   <h3>やあ、Sally</h3>
<?php elseif ($username === 'joe'): ?>
   <h3>やあ、Joe</h3>
<?php else: ?>
   <h3>やあ、知らない人</h3>
<?php endif; ?>
```

もしも、Twigのようなテンプレート言語を使いたいのであれば、ビューのサブクラスがテンプレート言語とCakePHPの橋渡しをしてくれるでしょう。

https://twig.symfony.com/

テンプレートファイルは/src/Template/の中の、ファイルを使用するコントローラーにちなんで名付けられたフォルダーにおかれ、その対応するアクション名にちなんで名付けられます。
例えば、```Products```のコントローラの```view()```アクションのビューファイルは通常、/src/Template/Products/view.ctpとなります

CakePHPのビューレイヤはいくつかの異なるパーツによって作りあげられています。各パーツは異なる役割を持っており、この章で説明していきます。

・テンプレート：テンプレートは実行中のアクション固有のページの一部分です。アプリケーションの応答の中心となります。

・エレメント：小さな再利用可能なちょっとしたコードです。エレメントは通常、ビューの中で描画されます

・レイアウト：アプリケ０ションの多くのインターフェイスをくるむ表示コードを入れるテンプレートファイルです。ほとんどのビューはレイアウトの中に描画されます

・ヘルパー：これらのクラスはビューレイヤの様々な場所で必要とされるロジックをカプセル化します。とりわけ、CakePHPのヘルパーはフォームの構築やAJAX機能の構築、モデルデータのページ切り替え、RSSフィードの提供などの手助けをしてくれます。

・cells：これらのクラスは、自己完結型のUI部品を作成する小さなコントローラー風の機能を提供します。より詳しい情報はビューセルを参照してください。

https://book.cakephp.org/3/ja/views/cells.html

## ビュー変数
コントローラの中で```set()```で設定した変数は、アクションが描画するビューやレイヤの双方で使用可能です。加えて、設定した変数はエレメントの中でも使用可能です。もしも、追加の変数をビューからレイアウトに渡す必要があれば、ビューテンプレートの中から```set()```を呼ぶか、ビューブロックの使用が利用できます。

https://book.cakephp.org/3/ja/views.html#view-blocks

CakePHPは自動では出力をエスケープしませんので、ユーザーデータを出力する前にはいつもエスケープしなければならないことを覚えておいてください。
```h()```関数でユーザコンテンツをエスケープできます

```
<?= h($user->bio); ?>
```

## ビュー変数の設定
Cake\View\View::set(string $var,mixed $value)

ビューにはコントローラーオブジェクトの```set()```と類似の```set()```メソッドがあります。

ビューファイルからset()を使うとあとで描画されるレイアウトやエレメントに変数を追加できます。```set()```の使い方のより詳しい情報はビュー変数の設定を参照してください

https://book.cakephp.org/3/ja/controllers.html#setting-view-variables

ビューファイルでは、次のように記述できます

```
$this->set('activeMenuButton', 'posts');
```
そしてレイアウトでは、```$activeMenuButton```変数が使用でき、'posts'という値を持ちます。


