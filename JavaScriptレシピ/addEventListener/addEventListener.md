## addEventListenerの処理
```
.addEventListener('DOMContentLoaded', () => {
  // DOMにアクセスできるタイミングで処理を実行する
})

.addEventListener('click', () => {
  // クリックされた時のイベントリスナー
})

.addEventListener('mouseup', () => {
  // マウスボタンを離した
})

.addEventListener('mousedown', () => {
  // マウスボタンを押した
})

.addEventListener('mousemove', () => {
  // マウスを移動した
})

.addEventListener('mouseenter', () => {
  // .box要素にマウスが乗った
})

.addEventListener('mouseenter', () => {
  // .inner要素にマウスが乗った
})

.addEventListener('mouseover', () => {
  // .box要素がマウスに乗った
})

.addEventListener('scroll', () => {
  // ウィンドウ上でスクロールする度に
})

.addEventListener('touchstart', () => {
  // 画面上タッチの動作
})

.addEventListener('touchmove', () => {
  // タッチ位置移動
})

.addEventListener('touchend', () => {
  // タッチ終了
})

.addEventListener('keydown', () => {
  // キーが押された
})

.addEventListener('keypress', () => {
  // もじが入力された
});

.addEventListener('keyup', () => {
  // キーが離された
})

.addEventListener('visibilitychange', () => {
  if (document.visibilityState === 'visible') {
    // 表示された時
  }

  if (document.visibilityState === 'hidden') {
    // バックグランドになったとき
  }
})

.addEventListener(関数)
// 関数で処理ができる

.addEventListener('dragstart', () => {
  // ドラッグ開始
})

.addEventListener('drag', () => {
  // ドラッグ中
})

.addEventListener('dragend', () => {
  // ドラッグが終了した時のイベント
})


```