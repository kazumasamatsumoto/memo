## metaタグの作成

Cake\View\Helper\HtmlHelper::meta(string|array $type, string $url = null, array $options = [])

このメソッドは、 RSS または Atom フィードや、 favicon といった外部リソースとリンクする際に便利です。 css() と同様に、`['block' => true]`のように $attributes パラメーターの 'block' キーを `true` に設定することで、このタグをインラインで表示するか `meta` ブロックに追加するかどうかを指定することができます。

$attributes のパラメーターを使って "type" 属性を設定するとき、 CakePHP では、 いくつかのショートカットを用意しています。

type:	変換後の値

html:	text/html

rss:	application/rss+xml

atom:	application/atom+xml

icon:	image/x-icon

```
<?= $this->Html->meta(
    'favicon.ico',
    '/favicon.ico',
    ['type' => 'icon']
);
?>
// 出力結果 (改行を追加しています)
// 注意: このヘルパーのコードは、異なる rel 属性値を必要とする
// 新旧両方のブラウザーでアイコンをダウンロードさせるための
// ２つのタグを作成します。
<link
    href="/subdir/favicon.ico"
    type="image/x-icon"
    rel="icon"
/>
<link
    href="/subdir/favicon.ico"
    type="image/x-icon"
    rel="shortcut icon"
/>

<?= $this->Html->meta(
    'Comments',
    '/comments/index.rss',
    ['type' => 'rss']
);
?>
// 出力結果 (改行を追加しています)
<link
    href="http://example.com/comments/index.rss"
    title="Comments"
    type="application/rss+xml"
    rel="alternate"
/>
```

ここのメソッドを使用して、meta keywords と description を追加することもできます。 例:
```
<?= $this->Html->meta(
    'keywords',
    'ここに meta キーワードを書き込む'
);
?>
// 出力結果
<meta name="keywords" content="ここに meta キーワードを書き込む" />

<?= $this->Html->meta(
    'description',
    'ここに何か説明を書き込む'
);
?>
// 出力結果
<meta name="description" content="ここに何か説明を書き込む" />
```

定義ずみのmetaタグを作成するだけでなく、link要素も作成することができます

```
<?= $this->Html->meta([
    'link' => 'http://example.com/manifest',
    'rel' => 'manifest'
]);
?>
// 出力結果
<link href="http://example.com/manifest" rel="manifest"/>
```

このように呼び出されたときに meta() に提供された属性は、生成された link タグに追加されます。

## DOCTYPE の作成

Cake\View\Helper\HtmlHelper::docType(string $type = 'html5')
(X)HTML の DOCTYPE (文書型宣言) を返します。 次の表に従って文書型を指定してください。

type:	変換された値

html4-strict:	HTML 4.01 Strict

html4-trans:	HTML 4.01 Transitional

html4-frame:	HTML 4.01 Frameset

html5 (default):	HTML5

xhtml-strict:	XHTML 1.0 Strict

xhtml-trans:	XHTML 1.0 Transitional

xhtml-frame:	XHTML 1.0 Frameset

xhtml11	XHTML: 1.1

```
echo $this->Html->docType();
// 出力結果: <!DOCTYPE html>

echo $this->Html->docType('html4-trans');
// 出力結果:
// <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
//    "http://www.w3.org/TR/html4/loose.dtd">
```

