## 画像のリンク
Cake\View\Helper\HtmlHelper::image(string $path, array $options = [])

整形された画像タグを作成します。 指定されたパスは webroot/img/ と相対的でなければなりません。

```
echo $this->Html->image('cake_logo.png', ['alt' => 'CakePHP']);
```

出力結果：
```
<img src="/img/cake_logo.png" alt="CakePHP" />
```

画像リンクを作成するには、`$attributes`の`url`オプションを使ってリンク先を指定します。

```
echo $this->Html->image("recipes/6.jpg", [
    "alt" => "Brownies",
    'url' => ['controller' => 'Recipes', 'action' => 'view', 6]
]);
```

出力結果：
```
<a href="/recipes/view/6">
    <img src="/img/recipes/6.jpg" alt="Brownies" />
</a>
```

電子メールの中で画像を作成したり、画像への絶対パスが必要な場合は、`fullBase`オプションを使用することができます。

```
echo $this->Html->image("logo.png", ['fullBase' => true]);
```

出力結果：
```
<img src="http://example.com/img/logo.jpg" alt="" />
```

読み込まれたプラグインからの画像ファイルを プラグイン記法 を使って組み込むことができます。 plugins/DebugKit/webroot/img/icon.png を組み込むために、次のように使用することができます。

```
echo $this->Html->image('DebugKit.icon.png');
```

読み込まれたプラグインと名前を共有する画像ファイルを組み込むには、次のようにしてできます。 例えば、 Blog プラグインを持っていて、webroot/img/Blog.icon.png を組み込みたければ、

```
echo $this->Html->image('Blog.icon.png', ['plugin' => false]);
```


