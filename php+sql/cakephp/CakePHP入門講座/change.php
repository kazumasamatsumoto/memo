<!-- いろいろと変更点がありました -->

<?php
  // レイアウトの有無
  // cake3までの書き方
  $this->viewBuilder()->autoLayout(true); // レイアウト適応
  $this->viewBuilder()->autoLayout(false); // レイアウト無効

  //cake4からの書き方
  $this->viewBuilder()->enableAutoLayout(); // レイアウト適応
  $this->viewBuilder()->disableAutoLayout(); // レイアウト無効

  // レイアウトの選択
  // cake3までの書き方
  $this->viewBuilder()->layout('test'); // レイアウトの選択
  
  // cake4からの書き方
  $this->viewBuilder()->setLayout('test'); // レイアウトの選択

?>