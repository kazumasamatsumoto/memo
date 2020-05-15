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