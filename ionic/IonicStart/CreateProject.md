## プロジェクトを作ろう

それでは早速Ionicプロジェクトを作成します。
インストールしたCLIで簡単に作成できるので、すぐに開発を始めることができます。

### 開発用フォルダの準備とカレントディレクトリの変更

Ionicのプロジェクトを作成します。最初にプロジェクトを作るフォルダを決めます。
普段使っているフォルダがなければ、デスクトップにdev/フォルダを作成しましょう。

次にターミナル(Windowsの場合はコマンドプロンプト)を起動して、先頭に`cd`（末尾は半角空白）を入力した上で、フォルダをドラッグ&ドロップして、実行しましょう。

### コマンド一つで自動生成
ターミナルの現在地が、Ionicのプロジェクトを作るフォルダになっているのを確認したら、次のコマンドを実行してください。Ionicのプロジェクト作成が始まります。

```
% ionic start --type=angular
```
`--type=angular`はJavaScriptフレームワークにAngularを指定するためのオプションです。
コマンドを実行すると、`Every great app needs a name!`と、プロジェクト名を聞かれます。Ionicのプロジェクトフォルダ名なので、任意の文字列を入力します。今回はこの後のチュートリアルでも利用するので「tasklist-tutorial」というプロジェクト名にしましょう。

## Ionicの便利な機能

Ionic CLIの便利なコマンド

#### 開発のための処理が走る「serve」
`ionic serve`を実行するとAngular CLIのコマンドを自動的に呼び出して、次の処理を自動的に実行します。

1 ローカル開発サーバを起動する
2 プロジェクトで使われているSCSS(CSSの拡張メタ言語)とTypeScript(JavaScriptの拡張言語)をブラウザで表示できるようにするため、それぞれCSSとJavaScriptにトランスパイル（変換）する。
3 自動的にブラウザでローカル開発サーバ（デフォルトは「localhost:8100」）にアクセスする
4 ローカルファイルの変更を監視して、変更があれば再ビルドして自動リロードを行う。

`ionic serve`の１行で、これだけの処理が行われます。

#### 公式ドキュメントを立ち上げる「docs」
開発中、「こういったコンポーネントがあったはず」や「このAPIの使い方をコピペしたい」など、Web上の公式ドキュメントをミルキかきが多くあります。
けれど、わざわざURLをブックマークしておくのも面倒、という方に向けて、Web上のドキュメントを立ち上げるコマンドが用意されています。

`ionic docs`コマンドを実行します
自動的にブラウザが起動して
https://ionicframework.com/docs/

へアクセスし、ドキュメントを見ることができます。

なお、日本語ドキュメンテーションは、ドメインの`.com`を`jp`に書き換えることでアクセスすることができます。

### 開発環境を表示する「info」
「コードを共有したいけど、なぜか他の人の環境では動かない」ということはよくあります。
多くの場合は、コード自体ではなく、開発環境や設定に問題があります。

そこでIonic CLIでは、`ionic info`コマンドを実行すると、開発されている環境・設定を出力する機能があります。

社内やコミュニティで質問するときは、出力した自分の環境も一緒に共有すると適切な助言をもらえる可能性が高くなります。

### サードパーティライブラリを追加する「integrations」
`integrations`コマンドを使うと、サードパーティライブラリとの統合を自動的に行うことができます。
モバイルアプリをビルドするための`cordova`と`capacitor`、Ionicのエンタープライズプランである`enterprise`の3つを利用することができます。

```
% ionic integrations list
% ionic integrations enable capacitor
```

### CLIの設定値を登録する「config set」
`config set`を使うと、CLIの設定値が登録できます。例えば、デフォルトのパッケージ管理ツール`npm`の代わりに`yarn`を使いたいということがあれば、次のコマンドを実行します

```
% ionic config set --global npmClient yarn
```

これにより、パッケージインストールは全て`yarn`経由で行われることになります。

### iOS/Android別のデザインプレビュー
IonicのUIコンポーネントはデフォルトでiOSデザイン、マテリアルデザインを持っていて、デバイスごとに表示が切り替わります。しかし、別々に確認するのは手間ですので、Ionicにはそれらを１画面で比較しながら確認する機能が付いています。

`serve`コマンドに`--lab`オプションを付けて実行します。

```
% ionic serve --lab
```

右上の「platforms」をクリックすると、どのデバイスを表示するか（もしくは複数表示するか）を選択することができます。なお、デスクトップで表示した場合はデフォルトではAndroid向けのマテリアルデザインが表示されます。

### 圧倒的に書くコードを減らしてくれる技術
ionicでは、さまざまな最新の技術が多く導入されています。

初めて使う人は、一見すると「覚えないといけないことがたくさんある」と思いがちですが、使っていると開発が楽になることを実感できます。

#### Web Componentsを使ったカスタム要素
Ionicは「Web Components」というWeb標準の仕様を使って、オリジナルのタグを使えるようになるカスタム要素でコンポーネントを作成しています。

`src/app/home/home.page.html`を開くと
`<ion-header>`や`<ion-toolbar>`などの見慣れないタグが使われています。

これをブラウザが読み込むことにより、オリジナルのコンポーネントデザインを展開します。
例えば、`<ion-menu-button></ion-menu-button>`というカスタム要素は、ユーザがiOSデバイスで表示するときは自動的に次のように展開されます。

```
<ion-menu-button _ngcontent-gqp-c1="" class="hydrated ios button ion-activatable ion-focusable">
  <button type="button" class="button-native">
    <slot>
      <ion-icon mode="ios" role="img" class="ios hydrated" aria-label="menu"></ion-icon>
    </slot>
  </button>
</ion-menu-button>
```

ionicがカスタム要素を使わず、自分でユーザのデバイス判定を行い、class名を適切に指定して、入れ子でHTMLを書くことを考えるとうんざりします。

さらに、UIコンポーネントによってはアニメーションも自動的に追加されます。
マテリアルデザインのボタンの場合、クリックしたらクリックした場所を機転にキラッと光るようなエフェクトが光るために`<ion-ripple-effect>`というコンポーネントも自動的に展開されます。

```
<ion-menu-button _ngcontent-uqq-c1="" class="hydrated md button ion-activatable ion-focusable">
  <button type="button" class="button-native">
    <slot>
      <ion-icon mode="md" role="img" class="md hydrated" aria-label="menu"></ion-icon>
    </slot>
    <ion-ripple-effect role="presentation" class="md unbounded hydrated"></ion-ripple-effect>
  </button>
</ion-menu-button>
```

開発を始めたばかりの時は、カスタム要素が多く、Webで開発をしている気持ちにならないかもしれませんが、カスタム要素は確実にあなたの開発を手助けします。

### TypeScriptで型のある世界
TypeScriptは、JavaScriptに静的型システムを追加して拡張したコンパイル言語です。TypeScriptの最大の特徴は静的型付けです。

例えば、変数（値をいれる箱）を宣言するときに「ここに入るのは数字です」と書いておけば、その変数に文字列が入った場合にエラーが出る機能です。
また、事前にコンパイルを行うので、Webブラウザ上ではまだ直接実行できないJavaScriptの新しい仕様の一部もTypeScriptで先取りして利用できるようになることもメリットの1つです。

次のように使います

```
let x: number; // number型（数字が入る）宣言
x = 1; // 数字なのでOK
x = 'パターン1'; // 文字列なのでエラーが出る
```

`let`は`var`と同じ役割を持ちます。
JavaScriptの2015年の仕様であるECMAScript6から、`var`ではなく、変数は、代入と再宣言可能な`let`と、代入と再宣言ができない`const`を使い分けるようになりました。

```
const x: number = 1;
x = 2; // 再宣言のためエラーが出る
```

型の宣言でよく使うのは以下の通りです

| よく使う型 | 概要  |
|:-----------|:------------|
| number     |数値|
| boolean    |「true」もしくは「false」が入る|
| string     |文字列|
| any        |何が入ってもエラーを返さない|
| Function   |関数が入る|
| []    　　　|配列が入る|
| {}   　　　 |オブジェクトが入る。[{name: string}]のように書く|

予期しないエラーを事前に確認し、また変数名の間違いなどを予防するので、開発がとても楽になります.TypeScriptはMicrosoftが開発したのですが、今ではGoogleの標準言語に採用されるなど広く使われているとても便利な言語です。