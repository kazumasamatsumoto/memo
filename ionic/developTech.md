## リファクタリングをするとき
現在page.tsで持っている機能をservice化したいときには
単一責任の原則

で今回の場合は
ログインに関する共通処理
login.service

QRコードに関する共通処理
qr.service

html側と連携して持たせたい場合は
login.ts
など現在の機能をどのグループに分ければいいのかを考えると開発しやすくなる

### アイコン
https://ionicons.com/

### ion-xxxxで開発するときのカラー管理
https://ionicframework.com/docs/theming/colors

### アトミックデザイン

https://goworkship.com/magazine/atomic_design/

コンポーネントをたくさん作成してそれをパズルのように組み合わせていくスタイル

https://design.dena.com/design/atomic-design-%E3%82%92%E5%88%86%E3%81%8B%E3%81%A3%E3%81%9F%E3%81%A4%E3%82%82%E3%82%8A%E3%81%AB%E3%81%AA%E3%82%8B/

詳細は今日のイベント終了後

