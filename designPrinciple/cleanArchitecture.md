## クリーンアーキテクチャ
システムテストにDBとAPIを作成してからフロントエンド側でコーディングするのが理想

諸々の事情により理想通りにならないことはある。

想像だけで最終形にたどり着くのは難しい

### デザインに必要なもの
試行錯誤
フロントのプロトタイプを早く作る

とりあえずプロトタイプを作成してAPIをつなげるパターン

[!クリーンアーキテクチャ](https://www.google.com/imgres?imgurl=https%3A%2F%2Fcamo.githubusercontent.com%2F466e05c456651fbb55b64f59bf32f82bf99ee90d%2F68747470733a2f2f71696974612d696d6167652d73746f72652e73332e61702d6e6f727468656173742d312e616d617a6f6e6177732e636f6d2f302f32383436342f31316431383638392d396139392d356263302d333964632d6534383632336631643131632e6a706567&imgrefurl=https%3A%2F%2Fgist.github.com%2Fmpppk%2F609d592f25cab9312654b39f1b357c60&tbnid=nPr36GbgH40TfM&vet=12ahUKEwi98pbigZXpAhX7x4sBHR1gBvkQMygAegUIARCHAg..i&docid=A-4hPSPpBgIGOM&w=772&h=567&q=%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%A2%E3%83%BC%E3%82%AD%E3%83%86%E3%82%AF%E3%83%81%E3%83%A3&ved=2ahUKEwi98pbigZXpAhX7x4sBHR1gBvkQMygAegUIARCHAg)


取捨選択ができるようになる。

### クリーンアーキテクチャの概要

ヘキサゴナルアーキテクチャ
[!ヘキサゴナルアーキテクチャ](https://qiita-user-contents.imgix.net/https%3A%2F%2Fqiita-image-store.s3.amazonaws.com%2F0%2F30489%2Ff5c66a12-a500-a536-5805-eafcebab84ce.png?ixlib=rb-1.2.2&auto=format&gif-q=60&q=75&s=a1ad317de58839f3cd9a9c97d7cb33f5)

アーキテクチャ
https://qiita.com/little_hand_s/items/ebb4284afeea0e8cc752

ビジネスロジックを中心に見据える

ヘキサゴナルアーキテクチャと同じ

ヘキサゴナルの外側の具体的な実装について詳細に記載されrているのがクリーンアーキテクチャ

### Entities
Enterprise Business Rules

ビジネスロジックをカプセル化
ドメインオブジェクト
->ビジネスの概念をロジック化する

### Use Cases
Application Business Rules
アプリケーションレイヤー

アプリケーションの目的である
ドメインにおける問題を解決するため
ドメインオブジェクトを束揚げ
ユースケースを実現する

### Interface Adapters
Controllers: ゲームのコントローラ
Presenters: ディスプレイ
Gateways: 保存先（クラウド）

右下の実装例が重要

### Frameworks & Drivers
詳細なコード
ギークなコード

ビジネスロジックが
これに依存しないようにする

専門用語だらけでビジネスロジックを構築しない

依存の方向は内向きにする
ドメインロジックでWebとかDBとかUIを扱わない

## 実装例

ソリッド原則
https://postd.cc/solid-principles-every-developer-should-know/

https://note.com/erukiti/n/n67b323d1f7c5

https://medium.com/@takasek/iosdc-2019-solid%E5%8E%9F%E5%89%87%E3%82%92%E7%94%9F%E6%B4%BB%E3%81%AB%E9%81%A9%E7%94%A8%E3%81%99%E3%82%8B-%E5%85%A8%E6%96%87%E4%BB%A5%E4%B8%8A%E6%9B%B8%E3%81%8D%E8%B5%B7%E3%81%93%E3%81%97-ac34809e464d



サンプル
ユーザ作成機能

何がどこに書いてあるのかわかっているのか？
フォルダをたくさん作って切り分けていく

よくわかならい。
