## Angularの概要
複数のプラットフォームを利用できるアプリをWeb技術で作るためには、「SPA」という単一ページで構成する手法で開発します。

SPAでは、`example.com/user`や`example.com/detail`といったURLへの遷移を行いますが、

ブラウザが読み込むHTMLファイルは`index.html`の一つです。

手法としては、コンテンツの中身をJavaScriptで書き換えて、まるでページ遷移したように表示する。

コンテンツだけではなくURLもJavaScriptで書き換えます。

これを自分で一から実装するのはとても難しいため、Ionicと合わせてSPAをサポートしているJavaScriptフレームワークを採用することが一般的です。今回はGoogleと有志のコミュニティによって開発されている「Angular」というJavaScriptフレームワークを採用している

## HTML/CSS/TypeScriptを分けて書く
Angularの特徴として、HTMLとTypeScript(JavaScriptの飼う超言語)をそれぞれ別々のファイルに書くということがあります。他のフレームワークでは、一つのファイルの中に全てまとめて書いたりします。

ここでは、Angularと他に有名なフレームワークとして「Vue.js」「React」のコードを比較します。

angular.component.ts
```
@Component({
    templateUrl: './angular.component.html', // ここでHTMLを呼び出し
})
export class WelcomeComponent {
    message: string = 'Hello World'
}
```

angular.component.html
```
<div>{{message}}</div>
```

それに対してVue.jsでは、HTMLの中にScriptを書きます

vue.html
```
<div id="app">
    {{ message }}
</div>
<script>
const app = new Vue({
    el: '#app',
    data: {
        message: 'Hello World'
    }
})
</script>
```

また、Reactでは、JSXと呼ばれる拡張記法を使って、JavaScriptでHTMLの構造を書きます。

react.jsx
```
ReactDOM.render(
    <h1>Hello, world!</h1>,
    document.getElementById('root')
);
```

HTML/TypeScriptを分けて書くのは、Angularフレームワークの特徴の一つです

### All in Oneパッケージ
Angularはエコシステムが充実しています。コマンドライン、HTTP通信、多言語化（i18n)、アニメーション、フォーム、テストをはじめとした多くの公式ライブラリが用意されています。

他のJavaScriptフレームワークは、時々に合わせて最もニーズにあったものを選定する必要がありますが、Angularは公式が適用しているためライブラリに悩むことが少なく、また、本体とバージョンが合わないということがないので安心して利用することができます。

### セマンティックバージョニングとアップデート
Ionic同様、Angularもスケジュールされたセマンティックバージョニングを採用しています。
また、AngularはCLIにアップデート機構(ng update)を搭載しており、メジャーバージョンリリースでAPIの破壊的変更があった場合、そのアップデート機構がAPIの破壊的変更に追随したコードの変更を自動的に行ってくれます。

