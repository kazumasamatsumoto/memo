## CakePHPの規約
私たちは「設定より規約」(convention over configuration)という考え方に賛成です。
CakePHPの規約を習得するには少し時間がかかりますが、長い目で見ると時間を節約していることになります。規約に従うと自由に使える機能が増えますし、設定ファイルを調べ回ってメンテナンスするという悪夢からも開放されます。
規約によって開発が統一感を持つため、開発者が加わってすぐに手伝うということがやりやすくなります。

## コントローラーの規約
コントローラーのクラス名は複数形でパスカルケースで、最後に```Controller```がつきます。
```UsersController```,```ArticleCategoriesController```は規約にあったコントローラーの例になります。

コントローラにあるpublicメソッドは、アクションとしてブラウザーからアクセス可能になります。例えば```/users/view```は```UsersController```の```view()```メソッドにアクセスします。protectedメソッドやprivateメソッドはルーティングしてアクセスすることはできません。

## コントローラー名とURL
前節の通り、一つの単語からなる名前のコントローラーは簡単に小文字のURLパスにマップできます。例えば、```UsersController```(ファイル名はUsersController.php)には、```http://example.com/users```としてアクセスできます。

複数語のコントローラをあなたの好きなようにルーティングできますが、DashedRouteクラスを使用するとURLは小文字とダッシュを用いる規約であり、
```ArticleCategoriesController::viewAll()```アクションにアクセスするための正しい形式は```/article-categories/view-all```となります

```this->Html->link```を使用してリンクを作成した時、URL配列を以下の規約を使用できます。

```
$this->Html->link('linkーtitle', [
    'prefix' => 'MyPrefix', // パスカルケース
    'plugin' => 'MyPlugin', // パスカルケース
    'controller' => 'ControllerName', // パスカルケース
    'action' => 'actionName' // キャメルバック
])
```

CakePHPのURLとパラメーターの取り扱いに関するより詳細な情報は、ルートを接続をご覧ください。

[ルートを接続](https://book.cakephp.org/3/ja/development/routing.html#routes-configuration)

## ファイルとクラス名の規約

通常、ファイル名はクラス名と一致し、オートローディングのためにPSR-4標準に準拠してください。以下に、クラス名とファイル名の例を挙げます。

・```LatestArticlesController```というコントローラークラスは、LatestArticlesController.phpというファイル名にします。

・```MyHandyComponent```というコンポーネントクラスは、MyHandyComponent.phpというファイル名にします。

・```OptionValuesTable```というTableクラスは、OptionValuesTable.phpというファイル名にします。

・```OptionValue```というEntityクラスは、OptionValue.phpというファイル名にする

・```EspeciallyFunkableBehavior```というビヘイビアークラスは、EspeciallyFunkableBehavior.phpというファイル名にします

・```SuperSimpleView```というビュークラスは、SuperSimpleView.phpというファイル名にします。

・```BestEverHelper```というヘルパークラスは、BestEverHelper.phpというファイル名にします。

各ファイルは、appフォルダーないの適切なフォルダー・名前空間の中に配置します。

## データベースの規約
CakePHPのモデルに対応するテーブル名は、複数形でアンダースコア記法です。上記の例で言えば、テーブル名はそれぞれ、```users```,```article_categories```,```user_favorite_pages```になります。

２個以上の単語で構成されるフィールド/カラムの名前は、```first_name```のようにアンダースコア記法になります。

hasMany,blongsTo,hasOneの中の外部キーは、デフォルトで関連するモデルの（単数形の）名前に```_id```を付けたものとして認識されます。ユーザーが記事を複数持っている（Users hasMany Articles）としたら、```articles```テーブルは、```user_id```を外部キーとして```users```テーブルのデータを参照します。
```article_categories```のような複数の単語のテーブルでは、外部キーは```article_category_id```のようになるでしょう。

モデル間のBelongsToManyの関係で使用されるjoinテーブルは、結合するテーブルに合わせて、アルファベット順に(```tags_articles```ではなく、```articles_tags```)並べた名前にしてください。
そうでなければbakeコマンドは動作しません。連結用テーブルにカラムを追加する必要がある場合は、そのテーブル用に別のエンティティークラスやテーブルクラスを作成する必要があります。

主キーとしてオートインクリメントな整数型を使用することに加えてUUIDカラムも使用できます。```Table::save()```メソッドを使って新規レコードを保存する時、CakePHPはユニークな36文字のUUID(```Cake\Utilitiy\Text::uuid```)を用いようとします

## モデルの規約
Tableクラスの名前は複数形でパスカルケースで、最後に```Table```がつきます。
```UsersTable```,
```ArticleCategoriesTable```,
```UserFavoritePagesTable```,
などは```users```,```article_categories```,```user_favorite_page```テーブルに対応するテーブルクラス名の例です。

## ビューの規約
ビューのテンプレートファイルは、それを表示するコントローラーの関数に合わせた、アンダースコア記法で命名されます。
```ArticlesController```クラスの```viewAll()```関数は、ビューテンプレートとして、src/Template/Articles/view_all.ctpを探すことになります。

基本パターンは
src/Template/コントローラー名/アンダースコア記法_関数名.ctpです

デフォルトで、CakePHP は英単語の語形変化を使用します。もし、別の言語を使った データベースのテーブルやカラムがある場合、語形変化規則 (単数形から複数形、逆もまた同様) の 追加が必要になります。カスタム語形変化規則を定義するために Cake\Utility\Inflector を使うことができます。より詳しい情報は、 [Inflector](https://book.cakephp.org/3/ja/core-libraries/inflector.html) 
をご覧ください。


## 要約
各部分をCakePHPの規約に合わせて命名しておくことで、混乱を招く面倒な設定をしなくても機能的に動作する様になります。以下が最後の規約にあった命名の例です。

・データベースのテーブル:"articles"
・Tableクラス：```ArticlesTable```の場所はsrc/Model/Table/ArticleTable.php

・Entityクラス：```Article```の場所はsrc/Model/Entity/Article.php

・Controllerクラス：```ArticlesController```はsrc/Controller/ArticlesController.php

・ビューテンプレートの場所はsrc/Template/Articles/index.ctp

これらの規約により、CakePHPは、```http://example.com/articles```へのリクエストを、ArticlesControllerの```index()```関数にマップします。そして、Articlesモデルが自動的に使える（データベースの`articles`テーブルに自動的に接続される）様になり、表示されることになります。必要なクラスとファイルを作成しただけでこれらの関係が設定されています。

さて、これでCakePHPの基本について一通り理解できました。
物事がどう組み合わせられるかを確かめるために、[コンテンツ管理チュートリアル](https://book.cakephp.org/3/ja/tutorials-and-examples/cms/installation.html)を体験することができるでしょう。

## プラグインの規約
CakePHPプラグインのパッケージ名にプレフィックスとして"cakephp-"をつけると便利です。これにより、名前が意味的にフレームワークに依存することを関連付けられます。

CakePHP所有のプラグインに予約されているため、ベンダー名としてCakePHPネームスペース(cakephp)を使用しないでください。規約では、小文字と文字とダッシュを区切り使用します
cakephp/foo-bar NG
your-name/cakephp-foo-bar OK