## 値オブジェクトは「不変」にする

変数の値の上書きは危険です、
コードが複雑になり思わぬ副作用の原因になります。

* 変数の値を書き換える（悪い例）
```
Money price = new Money(3000);

price.setValue(2000); // NG 値を書き換えている
price = new Money(1000); // NG 一つの変数に別の値を代入している
```

ある値を持ったオブジェクトの内部の変数を別の値に書き換えるべきではありません。

「別の値」が必要になったら「別のオブジェクト」を作成します

* 値が異なれば別のオブジェクトにする（良い例）
```
Money basePrice = new Money(3000);
Money discounted = basePrice.minus(1000); // minus()メソッドは別のMoneyオブジェクトを作成して返す
Money option = new Money(1000); // 新しくMoneyオブジェクトを作る
```

値（内部の状態）を変更できるオブジェクトは、変更と参照のタイミングによって、思わぬ副作用の原因になります。

それを防ぐために、別の値が必要になったら別のオブジェクトを作成します。

値ごとに別のオブジェクトを用意することで、一つひとつのオブジェクトの用途が限定され、プログラムが安定します。

プログラムの途中で内部の値が変化する時に起きがちな副作用を防ぐことができます。

1つのオブジェクトを使いまわした方が便利で効率的に思えるかもしれません

しかし、そうではありません。オブジェクトの値が変わることを前提にすると、

そのオブジェクトが、ある時点でどのような値を持っているのか、

いつも心配することになります。

処理の途中で値が変わると、プログラムは不安定になります。

変更した時に思わぬ副作用が起きがちです。

値ごとに別々のオブジェクトを作っておけば、このような心配事やトラブルから解放されます。

値オブジェクトは、扱えるデータの種類や範囲を限定した独自のデータ型です。

そして、値オブジェクトを不変にすることで、それぞれのオブジェクトは一つの値だけを持った、用途を限定したオブジェクトになります。

このようにオブジェクトの用途を狭く限定することが、変更の対象箇所を限定し、

プログラムの変更の副作用を防止します。

それがオブジェクト指向の良さを活かす設計です。

値オブジェクトを「不変」にするやり方は次の通りです。

* インスタンス変数はコンストラクタでオブジェクトの生成時に設定する
* インスタンス変数を変更するメソッド(setterメソッド)を作らない
* 別の値が必要であれば、別のインスタンス(オブジェクト)を作る

内部のインスタンス変数が変化しない不変な値オブジェクトは、ソフトウェア変更の副作用を減らし、バグを混入しにくくします。

このような設計のやり方を「完全コンストラクタ」と呼びます。

オブジェクトの生成時に、オブジェクトの状態を完全に設定してしまうやり方です。

Javaでは、String/BigDecimal/LocalDataなど基本データ型は、業務アプリケーションプログラムの部品として、独自の「型」を設計する場合もできる限り「完全コンストラクタ」で設計します。

### 型を使ってコードをわかりやすく安全にする
intやStringなど基本データ型だけで書いたプログラムは、思わぬバグを生みやすくなります。

例えば、金額計算のメソッドに渡す引数の「金額」と「数量」を、両方ともintで扱うことを考えてみます。

* int型の引数を受け取るメソッド
```
int amount(int unitPrice, int quantity)
{
  return unitPrice * quantity ;
}
```

単価と数量の違いは変数名で区別していますが、このコードは危険です。

引数の順番を間違えて、unitPriceに「数量」を、quantityに「単価」を渡しても、

同じint型なのでコンパイラは文句を言わず、プログラムも動作します。

この例であれば結果が同じなので、おそらく問題は発覚しません。

しかし「金額」と「数量」の取り違えは、業務的には致命的な障害です。

例えば数量割引を導入するために、メソッドの中に、quantityが一定量より多いかどうか判断するロジックを追加します。

* 数量割引
```
int amount(int unitPrice, int quantity)
{
  if(quantity >= discountCriteria)
    return discountAmount(unitPrice, quantity)
  
  return unitPrice * quantity;
}
```

このプログラムも動きます。

しかし、計算結果は意図通りにならないかもしれません。

このコードだと、引数としてquantityの場所に間違えてuintPriceを渡した場合、正しい結果を返しません。

こういう同じint型のパラメータの渡し間違いのバグを発見するのは容易ではありません。

こういうことを防ぐために、用途を限定した独自の「型」を積極的に使うようにします。

独自の型を使えば、コードの意図をわかりやすく表現できます。

* 独自の型を使って意図を明らかにする
```
Money amount(Money unitPrice, Quantity quantity)
{
  if(quantity.isDiscountable())
    return discount(unitPrice, quantity)

  return unitPrice.multiply(quantity.value());
}
```
int型の代わりにMoney型とQuantity型を使います。

そうすることで、コードの意図が具体的になります。

引数の渡し間違えを防ぐ安全なプログラムになります。

もちろん、Money型やQuantity型は値オブジェクトです。

正しい範囲の値だけを扱い、かつ、不変な値オブジェクトとして安心して使うことができます。

intは、業務の関心事ではありません。

プログラミング言語とコンピュータの仕組みに関係する関心事です。

それにたいし、QuantityやMoneyは、業務の関心事そのものです。

妥当な数量とはどのようなもので、数量に対してどのような判断/加工/計算が必要になるかの業務知識を表現した値オブジェクトです。

このように値オブジェクトは業務の関心事を直接表現します。

わかりやすく役に立つ値オブジェクトを設計する良い方法は、実際の業務で使っている具体的なデータを考えてみる事です。

数値であれば、上限や下限など妥当な範囲が決まっているものです。

日付であれば、日付の前後関係や、一定の適切な期間に収まっていることなどの決め事があるはずです。

そういう決め事を理解し、妥当な範囲だけを扱う値オブジェクトを設計します。

このように業務の理解とプログラムの設計を直接的に関連づけることで、プログラムがわかりやすく整理され、変更が楽で安全になるのです。

