## リンクの作成

Cake\View\Helper\HtmlHelper::link(string $title, mixed $url = null, array $options = [])

HTML リンクを作成するための多目的なメソッドです。 要素の属性や $title をエスケープするかどうかを指定するには $options を使用してください。

```
echo $this->Html->link(
    'Enter',
    '/pages/home',
    ['class' => 'button', 'target' => '_blank']
);
```

出力結果：

```
<a href="/pages/home" class="button" target="_blank">Enter</a>
```

絶対URLには`'_full'=>true`オプションを使用してください。

```
echo $this->Html->link(
    'Dashboard',
    ['controller' => 'Dashboards', 'action' => 'index', '_full' => true]
);
```

出力結果：
```
<a href="http://www.yourdomain.com/dashboards/index">Dashboard</a>
```

オプションで confirm キーを指定すると、JavaScript の confirm() ダイアログを表示できます。

```
echo $this->Html->link(
    '削除',
    ['controller' => 'Recipes', 'action' => 'delete', 6],
    ['confirm' => 'このレシピを削除してよろしいですか?']
);
```

出力結果：
```
<a href="/recipes/delete/6"
    onclick="return confirm(
        'このレシピを削除してよろしいですか?'
    );">
    削除
</a>
```

`link()`でクエリー文字列を作成することもできます
```
echo $this->Html->link('View image', [
    'controller' => 'Images',
    'action' => 'view',
    1,
    '?' => ['height' => 400, 'width' => 500]
]);
```

出力結果：
```
<a href="/images/view/1?height=400&width=500">View image</a>
```

$title の HTML 特殊文字は HTML エンティティーに変換されます。 この変換を無効にするには、 $options 配列の escape オプションを false に設定します。

```
echo $this->Html->link(
    $this->Html->image("recipes/6.jpg", ["alt" => "Brownies"]),
    "recipes/view/6",
    ['escape' => false]
);
```

出力結果：
```
<a href="/recipes/view/6">
    <img src="/img/recipes/6.jpg" alt="Brownies" />
</a>
```

escape を false に設定すると、リンクの属性のエスケープも無効になります。 escapeTitle オプションを使うと、属性ではなくタイトルのエスケープだけを無効にすることができます。

```
echo $this->Html->link(
    $this->Html->image('recipes/6.jpg', ['alt' => 'Brownies']),
    'recipes/view/6',
    ['escapeTitle' => false, 'title' => 'hi "howdy"']
);
```

出力結果：
```
<a href="/recipes/view/6" title="hi &quot;howdy&quot;">
    <img src="/img/recipes/6.jpg" alt="Brownies" />
</a>
```

また、さまざまな種類の URL の例については、 Cake\View\Helper\UrlHelper::build() メソッドをチェックしてください。

## 動画と音声ファイルのリンク

Cake\View\Helper\HtmlHelper::media(string|array $path, array $options)
オプション:

・type 生成するメディア要素のタイプ。有効な値は "audio" または "video" です。 type が指定されていない場合、メディアの種類はファイルの MIME タイプに基づいて推測されます。

・text video タグ内に含めるテキスト。

・pathPrefix 相対 URL に使用するパスのプレフィックス。デフォルトは 'files/' です。

・fullBase 指定されている場合、src 属性はドメイン名を含む完全なアドレスを取得します。
整形された audio/video タグを返します。

```
<?= $this->Html->media('audio.mp3') ?>

 // 出力結果
 <audio src="/files/audio.mp3"></audio>

 <?= $this->Html->media('video.mp4', [
     'fullBase' => true,
     'text' => 'Fallback text'
 ]) ?>

 // 出力結果
 <video src="http://www.somehost.com/files/video.mp4">Fallback text</video>

<?= $this->Html->media(
     ['video.mp4', ['src' => 'video.ogg', 'type' => "video/ogg; codecs='theora, vorbis'"]],
     ['autoplay']
 ) ?>

 // 出力結果
 <video autoplay="autoplay">
     <source src="/files/video.mp4" type="video/mp4"/>
     <source src="/files/video.ogg" type="video/ogg;
         codecs='theora, vorbis'"/>
 </video>
```

