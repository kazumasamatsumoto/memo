## 当たり判定の実装

・Playerが敵を攻撃した時にダメージを与える
・武器に当たり判定を持たせる
・敵自身に当たり判定を持たせる


Playerのrootのweaponにcolliderをつける

敵側にもcolliderをつける

ColliderをつけてisTrigger

```
EnemyManagerで

private void OnTriggerEnter(Collider other)
    {
        Debug.Log("ぶつかった");
    }
```

てきの武器にbox colliderをつける

## Damagerの実装

武器にダメージコードをつける

条件分岐によりDamagerが実装されているcollider以外のconsole表示がなくなる

## animationの実装

攻撃時のアニメーション

非ダメの時のアニメーションの追加
アニメーションの切り替え

どの状態からでもダメージは受けるのでany stateからMake Transitionを実装する

## 武器が当たった時に実装する

