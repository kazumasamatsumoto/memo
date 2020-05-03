## 物理演算の付与

RigidBodyのコンポーネントを追加する

Playerのスクリプトを作成して
PlayerManager.csを作成する

```
// Update関数の前に実行される：設定
    void Start()
    {
        rb = GetComponent<Rigidbody>();
    }

    // 約0.02秒に１回実行される：実行
    void Update()
    {
        
    }
```


ソースコードを外部のUnityエディタで動かすためには
publicをつける

