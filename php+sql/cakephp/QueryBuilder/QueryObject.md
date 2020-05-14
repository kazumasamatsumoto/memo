## クエリビルダー

ORMのクエリビルダーにより簡単に流れるようなインターフェイスを使ってクエリを作り実行することができる
クエリを組み立てることで、unionやサブクエリを使った高度なクエリも簡単に作成することができる。

```
ORMとは

オブジェクト関係マッピング

オブジェクト指向と関係データベースの考え方を上手く変換して繋いでくれるもの。

```

クエリビルダーは裏側でPDOプリペアードステートメントを使うことで、SQLインジェクション攻撃から守っています。

### クエリオブジェクト

Queryオブジェクトを作成する最も簡単な方法はTableオブジェクトからfind()を使うこと。
このメソッドは完結していないクエリを返し、このクエリは変更可能です。必要なら、テーブルのコネクションオブジェクトも使うことで、ORM機能を含まない、より低い層のクエリビルダーにアクセスすることもできる


#### 詳細

[クエリの詳細](https://book.cakephp.org/3/ja/orm/database-basics.html#database-queries)

```
use Cake\ORM\TableRegistry

// 3.6 より前は、 TableRegistry::get('Articles') を使用
$articles = TableRegistry::getTableLocator()->get('Articles');

// テーブルを取得して変数articlesに代入

// 新しいクエリーを始めます。
$query = $articles->find();

// $articlesからfind()を呼び出すことによってクエリを始めることができる

```

コントローラーの中では自動的に慣習的な機能を使って作成されるテーブル変数を使うことができる

```
// ArticlesController.phpの中で
このコントローラにはそもそもArticlesテーブルが対応しているため

$query = $this->Articles->find();

```

### テーブルから行を取得する

```
use Cake\ORM\TableRegistry;

// ver3.6 以前は、 TableRegistry::get('Articles')を使用する
$query = TableRegistry::getTableLocator()->get('Articles')->find();

foreach($query as $article) {
    debug($article->title);
}
```

Queryオブジェクトのほとんどのメソッdが自分自身のクエリオブジェクトを返します。これはQueryが遅延評価されることを意味し、必要になるまで実行されないことを意味します。

```
$query->where(['id' => 1]);
// 自分自身のクエリオブジェクトを返す

$query->order(['title' => 'DESC']);
// 自分自身を返して、SQLはまだ実行されない
```

もちろんQueryオブジェクトの呼び出しではメソッドをチェーンすることもできます

```
$query = $articles
    ->find()
    ->select(['id', 'name'])
    ->where(['id !=' => 1])
    ->order(['created' => 'DESC']);

foreach ($query as &article) {
    debug($article->created);
}
```

Queryオブジェクトをdebug()で使うと、内部の状態とデータベースで実行されることになるSQLが出力されます

```
debug($articles->find()->where(['id' => 1]));
```

foreachを使わずに、クエリを直接実行することができます。
もっと簡単なのはall()メソッドかtoList()メソッドのどちらかを呼ぶ方法です。

```
$resultsIteratorObject = $articles
    ->find()
    ->where(['id >' => 1])
    ->all();

foreach ($resultsIteratorObject as $article) {
    debug($article->id);
}

$resultsArray = $articles
    ->find()
    ->where(['id >' => 1])
    ->toList();

foreach ($resultsArray as $article) {
    debug($article->id);
}

debug($resultsArray[0]->title);
```

多くの場合、all()を呼ぶ必要はなく、単にQueryオブジェクトをイテレートすることで、結果を得ることができます。
Queryオブジェクトはまた、結果オブジェクトとして直接使うこともできます。

クエリをイテレートしたり、toList()を呼んだり、Collectionから継承したメソッドを呼んだりすると、クエリは実行され結果が帰ります。

