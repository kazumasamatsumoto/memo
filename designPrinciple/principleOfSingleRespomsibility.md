## 単一責任の原則

### 解説
「単一責任の原則」について解説すると、
単一責任の原則とは、「クラスを変更する理由は1つ以上存在してはならない」、言い換えると

```
「クラスに変更が起こる理由は1つであるべき」
```

という原則です。

サンプルプログラム

```
/**
* 車クラス
*/

public class Car {
    private String name;
    private String engine;
    private String tire;

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getEngine() {
        return engine;
    }

    public void setEngin(String engin) {
        this.engine = engine;
    }

    public String getTyre() {
    return tyre;
    }

    public void setTyre(String tyre) {
    this.tyre = tyre;
    }

    public void store() throws IOException {
        try (final OutputStreamWriter outputStreamWriter = new FileWriter(new File("c:\\car.txt"))) {
            outputStreamWriter.write("name:" + name + ",engine:" + engine + ",tyre:" + tyre);
        }
    }
}
```

### 解説
この車クラスは一見何の問題ないように見えますが、変更する理由（役割）が2つあります。1つは車の名前やエンジンなど、属性の値を表現するという役割、もう1つは属性の値を保存するというビジネスロジックの役割です。

### そもそも
なぜ変更する理由（役割）が単一でなく複数あるといけないのかというと、役割が複数あると、その役割の数分だけ変更する理由が増えてしまうためです。すなわち、複数の役割が異なった理由で変更される可能性があるということです。
このサンプルでは属性が変更される場合にクラスを修正する必要が出てきます。

この他にも、属性の値の保存方法がタブ区切りのTSV形式のファイルに仕様変更された場合や、そもそも保存場所がファイルではなくデータベースに変更された場合などもクラスを修正する必要が発生します。

このように、複数の役割をもつ車クラスはとても脆い設計と言えます。複数の役割のうち1つでも変更があればクラスに修正が発生してしまうからです

車クラスが修正されると、関連する他のクラスにも漏れなく影響が出ます（場合によっては関連するクラスにも修正が発生する）。テストまで完了したクラスに手を入れることは、プログラム修正の他に再テストも必要になります。
関連するクラスというよりも、関連する機能全てに再テストが発生します。
すなわち工数が増える元凶となります

より良い設計とは、疎結合で依存性の少ない設計です。
単一責任の原則で言えばクラスの変更理由（役割）が1つであれば良い設計と言えます。

それでは、この役割が2つある車クラスを単一の役割に分離し、リファクタリングしてみましょう。

### 車クラスとデータ倉庫クラスに分けたリファクタリング

```
/**
 * 車クラス.
 */
public class Car {

 private String name;

 private String engine;

 private String tyre;

 public String getName() {
  return name;
 }

 public void setName(String name) {
  this.name = name;
 }

 public String getEngine() {
  return engine;
 }

 public void setEngine(String engine) {
  this.engine = engine;
 }

 public String getTyre() {
  return tyre;
 }

 public void setTyre(String tyre) {
  this.tyre = tyre;
 }

 @Override
 public String toString() {
  return "name:" + name + ",engine:" + engine + ",tyre:" + tyre;
 }
}

/**
 * データ倉庫クラス.
 */
public class DataStorage {

 public void store(Car car) throws IOException {

  try (final OutputStreamWriter outputStreamWriter = new FileWriter(new File("c:\\car.txt"))) {
   outputStreamWriter.write(car.toString());
  }
 }
}
```

データ倉庫(DataStorage)クラスを用意し、車クラスからビジネスロジックである保存機能を分離して移動させます。
これにより、車クラスは属性の値を表現するValueObjectの役割だけとなります。

つまりデータの保存方法が変更になっても影響をうけなくなった。

ビジネスロジックだけの役割となったデータ倉庫クラスも影響範囲は然り。

### さらに
属性の値を保存するビジネスロジックの機能を分離したことにより、インターフェースを設けて保存方法を動的に変えることができるようになる。

```
public interface DataStorage {

  void store(Car car) throws Exception;
}

public class TextFile implements DataStorage {

  @Override
  public void store(Car car) throws Exception {
    // テキストファイルで保存
  }
}

public class TsvFile implements DataStorage {

  @Override
  public void store(Car car) throws Exception {
    // TSVファイル形式で保存
  }
}

public class Database implements DataStorage {

  @Override
  public void store(Car car) throws Exception {
    // データベースに保存
  }
}
```
![イメージ](https://thinkit.co.jp/sites/default/files/article_node/object_oriented05_01.png)

とにかく
役割は一つずつに分けた方が絶対にいい