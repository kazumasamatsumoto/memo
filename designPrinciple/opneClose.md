## オープン・クローズドの原則

「拡張に対して開いていて、修正に対して閉じていなければならない」
という原則

つまり「拡張がしやすく、拡張しても修正箇所はできるだけ少なくなる様な設計にするべき」という指針


サンプルソース
```
public class Sample {

    public void write() {
        new TextFile().write("test");
    }
}
```

このサンプルはSampleクラスがTextFileクラスのwriteメソッドを呼び出して、テキストファイルに文字を書き込むプログラムですが、このプログラムには欠点がある。

SampleクラスがTextFileクラスに依存した作りになっている

例えば、仕様変更や何かでテキストファイルではなくCSVファイルに書き込みたいと思っても、プログラムの中にTextFileという具体的なクラスが登場しているため、プログラムを修正せざるおえない。

テキストファイルだけでなく、CSVファイルにも書き込めるプログラムに拡張したくてもできない作りになっている

そこでサンプルプログラムをオープン・クローズドの原則に当てはめて拡張しやすい作りに変更してみます。

### Fileというインターフェースを用意する

```
public interface File {
    void write(String str);
}
```

### 次に、Fileインターフェースを実装したTextFileクラスとCsvFileクラスを用意する

```
public class TextFile implements File {
    public void write(String str) {
        // テキストファイルに書き込む
    }
}

public class CsvFile implements File {
    public void write(String str) {
        // CSVファイルに書き込む
    }
}
```

### SampleクラスはTextFileという具体的なクラスを呼ぶのではなく、Fileインターフェースを受け取り、そのインターフェースのwriteメソッドを呼ぶように変更します

```
public class Sample {
    public void write(File file) {
        file.write("test");
    }
}
```

## まとめ
これにより、テキストファイルでもCSVファイルでも、Fileインターフェースを実装したTextFileクラスとCsv Fileクラスのインスタンスにより、異なる動きができるようになりました。

このように、モジュールの振る舞いを拡張でき(Open),モジュールの振る舞いを変更しても既存のプログラムには影響を与えないこと(Closed)をオープン・クローズドの原則といいます。