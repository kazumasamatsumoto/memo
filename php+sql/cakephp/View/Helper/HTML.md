## HTML

class: Cake\View\Helper\HtmlHelper(view $view,array $config = [])

CakePHPにおけるHtmlHelperの役割は、HTMLに関連するオプションをより簡単に、高速に作成し、より弾力的なものに変えることです。このヘルパーを使うことで、アプリケーションの足取りはより軽くなり、そしてドメインのルートが置かれている場所に関して、よりフリキシブルなものになるでしょう。

HtmlHelperにある多くのメソッドは```$attributes```という引数を持っています。これにより、いかなる追加属性もタグに付け加えることができます。ここでは、```$attributes```という引数を持っています。
これにより、いかなる追加属性もタグに付け加えることもできます。ここでは、```$attributes```パラメータを使用する方法の例をいくつか紹介します。

```
欲しい属性：<tag class="someClass" />
配列パラメータ： ['class' => 'someClass']

欲しい属性： <tag name="foo" value="bar" />
配列パラメータ： ['name' => 'foo', 'value' => 'bar']
```

## 整形式の要素を挿入
HtmlHelperの果たす最も重要なタスクは、適切に整形されたマークアップの生成です。
このセクションでは、いくつかのHtmlHelperのメソッドと、その使用方法について説明します。

## 文字セットのタグを作成

Cake\View\Helper\HtmlHelper::charset($charset=null)

文書の文字セットを指定するmetaタグを作成するために使います。デフォルト値はUTF-8です。使用例:

```
echo $this->Html->charset();
```

出力結果：
```
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
```

または
```
echo $this->Html->charset('ISO-8859-1');
```

出力結果：
```
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
```

## CSSファイルへのリンク
Cake\View\Helper\HtmlHelper::css(mixed $path, array $options = [])

CSSスタイルシートへのリンク（複数可能）を作成します。```block```オプションが```true```に設定されている場合、linkタグは```css```ブロックに追加されます。このブロックはドキュメントのheadタグの中に出力することができます。

```block```オプションを使うと、link要素をどのブロックに追加するかを制御することができます。デフォルトでは、```css```ブロックに追加されます。

```$options```配列のキーが`rel`が`import`に設定されていると、スタイルシートがインポートされます。

パスが'/'で始まらない場合、CSSをインクルードするこのメソッドは、指定されたCSSファイルがwebroot/cssディレクトリ内にあることを前提としています。

```
echo $this->Html->css('forms');
```

出力結果

```
<link rel="stylesheet" href="/css/forms.css" />
```

最初のパラメーターは、複数のファイルを含むように配列することができます。
```
echo $this->Html->css(['forms', 'tables', 'menu']);
```

出力結果：
```
<link rel="stylesheet" href="/css/forms.css" />
<link rel="stylesheet" href="/css/tables.css" />
<link rel="stylesheet" href="/css/menu.css" />
```

プラグイン記法を使用して、すべての読み込まれたプラグインの CSS ファイルをインクルードすることができます。 plugins/DebugKit/webroot/css/toolbar.css を含めるために、以下を使用することができます。

```
echo $this->Html->css('DebugKit.toolbar.css');
```

読み込まれたプラグインと名前を共有する CSS ファイルをインクルードするには、次の操作を実行します。 例えば、 Blog プラグインを持っていて、 webroot/css/Blog.common.css をインクルードしたければ、

```
echo $this->Html->css('Blog.common.css', ['plugin' => false]);
```

## プログラムによるCSSの作成

Cake\View\Helper\HtmlHelper::style(array $data, boolean $oneline = true)

メソッドに渡した配列のキーと値から CSS のスタイル定義を作成します。 特に動的な CSS の作成に便利です。

```
echo $this->Html->style([
    'background' => '#633',
    'border-bottom' => '1px solid #000',
    'padding' => '10px'
]);
```
直接渡すことができる

出力結果：
```
background:#633; border-bottom:1px solid #000; padding:10px;
```

