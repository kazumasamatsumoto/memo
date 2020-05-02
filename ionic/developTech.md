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

