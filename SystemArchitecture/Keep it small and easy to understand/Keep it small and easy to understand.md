# 小さくまとめてわかりやすくする

ソースコードを整理整頓して、どこに何が書いてあるか
わかりやすくすることが設計の基本です。

この章ではまず、その基本から押さえていきましょう。

## なぜソフトウェアの変更は大変なのか

### ソフトウェアの変更に立ち向かう

ソフトウェアに修正や拡張はつきものです。
そして、動いているプログラムの変更は、いつでも、厄介で危険な作業です。

どこに何が書いてあるのかを理解するまでにコードをじっくり調べる必要があります。

ちょっとした修正なのに、変更すべき箇所があちこちに散らばっています。
修正箇所が多ければ、広い範囲のテストが必要になります。

そうやって慎重に修正したはずなのに、思わぬ副作用に苦しむことになります。

なぜ？このようなことになるのでしょうか？
それは「設計」に問題があるからです。設計とは、ソフトウェア全体をすっきりした形に整えることです。どこに何が書いてあるかわかりやすくして、修正や拡張が楽で安全になるコードを生み出すのが設計です。

そういう設計をするために必要なのは、綺麗なクラス図や詳細なプログラム仕様書ではありません。クラス図や詳細なプログラム仕様書ではありません。クラス図や仕様書も役には立ちます。

しかし、設計の最終アウトプットは、なんと言ってもソースコードです。数千行、数万行のsーすコードをどういう視点から整理し、どういう方針で組み立てるか。

ソースコードを整理整頓して、どこに何が書いてあるかわかりやすくする。それがソフトウェアの設計です。

<b>どこに何が書いてあるのかわかりやすくするのがソフトウェアの設計</b>

設計の良し悪しは、ソフトウェアを変更するときにはっきりします。

構造が入り組んだわかりづらいプログラムは内容の理解に時間がかかります。
重複したコードをあちこちで修正する作業が増え、変更の副作用に悩まされます。

一方、うまく設計されたプログラムは変更が楽で安全です。変更すべき箇所が簡単にわかり、変更するコード量が少なく、変更の影響を狭い範囲に限定できます。

プログラムの修正に3日かかるか、それとも半日で済むか。

その違いを産むのが「設計」なのです。

<b>日頃の整理整頓ができるかどうか

片付けが得意かどうかによる</b>

### 変更が大変なプログラムの特徴
設計ドキュメントを整備し、コーディング規約に従っていても、変更が大変なプログラムがたくさんあります。

ソースコードの見た目が綺麗でも、いざ変更しようとすると、意図が読み取りにくく、変更箇所があちこちに散らばり、ちょっとした変更が予想外の副作用を引き起こすプログラムです。

変更が大変なプログラムの特徴は次の3つです。

* メソッドが長い
* クラスが大きい
* 引数が多い

長いメソッドを理解するのは大変です。特にif-else文が入り組んだメソッドは、正しく理解するのに骨がおれます。

また、ちょっとした変更によって深刻なバグが混入しかねません。

大きなクラスは関心ごとを詰め込みすぎです。変更の必要な箇所が、クラスのどの部分に関係し、どの部分が関係しないかを読み取るのに苦労します。

引数が多いメソッドも関心ごとを詰め込みすぎです。変更をするときに、どの引数が関係し、どの引数は関係しないかの見極めに時間がかかります。

引数が多ければメソッドが長くなり、if文も増えます。

長いメソッドが増えれば、クラスは肥大化し扱いにくくなります。

### 変更するたびに変更が大変になる
クラスは最初から大きかったわけではありません。メソッドの数は少なく、一つ一つのメソッドも短く、単純で読みやすいプログラムだったはずです。

わかりやすかったプログラムに、ちょっとした修正が必要になります。if文を1つ追加すれば、何かとなりそうなことを発見します。短かったメソッドにif文と数行のコードを追加します。

ちょっとした機能の追加が必要になったとします。
インスタンス変数を1つとメソッドを一つ追加すれば、その追加機能を実現できそうです。クラスにインスタンス変数と小さなメソッドを追加します。

あるメソッドのちょっとしたバリエーションが欲しくなります。
既存のロジックをそのまま利用できそうです。特別なケースを判断するためのフラグを引数として追加して、if文で特別な場合のロジックを追加します。

ソフトウェア開発は、このような「ちょっとした」コードの追加の繰り返しです。
最初は見通しがよかったプログラムが、開発が進むにつれ、コードがじわじわと増え、構造が入り組んできます。

アプリケーションを無事にリリースできて、利用者が使い始めれば、様々な改善要望が出てきます。発見された不具合の修正も必要です。
その度にメソッドが数行だけ長くなり、クラスが少し膨らみ、引数がじわじわと増えます。

その結果、どこに何が書いてあるか、時間と共にわかりづらくなっていきます。

変更が大変になるのは、決まって、こういうちょっとしたコードの修正や機能を繰り返したプログラムです。
最初はすっきりしていた構造が、わずかなコードの変更を繰り返した結果、構造が入り組み、全体のバランスが崩れていきます。

変更するたびに変更が大変になっていく、このソフトウェア変更の負のスパイラルから抜け出すにはどうすればいいのでしょうか？


