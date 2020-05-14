    
    /**
     * 
     */
    public function beforeFilter(Event $event){
        $this->fncstartlog();
        try{
            parent::beforeFilter($event);
            // 作物のIDと名前の表示対応
            $satellitesAll = array();
            foreach ($this->Satellites->find()->all() as $tmp){
                $satellitesAll += array ($tmp->id => $tmp->name);
            }
            $this->set(compact("satellitesAll"));
            // 注文種別
            $ordertypesAll = array();
            foreach ($this->Ordertypes->find()->all() as $tmp){
                $ordertypesAll += array ($tmp->id => $tmp->name);
            }
            $this->set(compact("ordertypesAll"));
            // 出力形式
            $outputTypeAll = [0=>"全体図のみ", 1=>"全体図＋複数図面", 2=>"全体図＋生産者毎 "];
            $this->set(compact("outputTypeAll"));
            // 作物
            $cropsAll = array();
            foreach ($this->Crops->find()->all() as $tmp){
                $cropsAll += array ($tmp->id => $tmp->name);
            }
            $this->set(compact("cropsAll"));
            // 解析
            $analysesAll = array();
            foreach ($this->Analyses->find()->all() as $tmp){
                $analysesAll += array ($tmp->id => $tmp->name);
            }
            $this->set(compact("analysesAll"));
            // 20190418 add
            // APIシステム
            $ApisystemsAll = array();
            foreach ($this->Apisystems->find()->all() as $tmp){
                $ApisystemsAll += [$tmp->id => $tmp->systemname];
            }
            // ユーザ
            $users = $this->Users
                ->find()
                ->contain(['Apiusers' => function ($q) {
                    return $q->find('all', ['withDeleted']);
                }])
                ->toArray();
            foreach ($users as $user){
                if( !empty($user->apiuser->id) ){
                    $user->dispname = '（API）';
                    $user->apisystemname = $ApisystemsAll[$user->apiuser->systemsid];
                    $user->isApi = true;
                }
                else{
                    $user->dispname = $user->organization.':'.$user->lastname.$user->firstname;
                    $user->apisystemname = NULL;
                    $user->isApi = false;
                }
                $this->usersAll[$user->id] = $user;
            }
            // 20200414 add YSAP対応
            // 解析不可理由
            $ysapimpossibleanalyzesAll = array();
            foreach ($this->Ysapimpossibleanalyzes->find()->all() as $tmp){
                $ysapimpossibleanalyzesAll += [$tmp->codeid  => $tmp->reason];
            }
            $this->set(compact("ysapimpossibleanalyzesAll"));
            // YSAP注文ステータス
            $ysaporderstatusesAll = array();
            $ysaporderstatusesImgSend = [];
            foreach ($this->Ysaporderstatuses->find()->all() as $tmp){
                $ysaporderstatusesAll += [$tmp->codeid  => $tmp->status];
                if(20<=$tmp->codeid && $tmp->codeid<=22) {
                    $ysaporderstatusesImgSend += [$tmp->codeid  => $tmp->status];
                }
            }
            $this->set(compact("ysaporderstatusesAll"));
            $this->set(compact("ysaporderstatusesImgSend"));
            // 差し戻し理由
            $ysapremandsAll = array();
            foreach ($this->Ysapremands->find()->all() as $tmp){
                $ysapremandsAll += [$tmp->codeid  => $tmp->reason];
            }
            $this->set(compact("ysapremandsAll"));
        }catch(Exception $e){
            $this->applog($e->getMessage());
        }catch(Error $e){
            $this->applog($e->getMessage());
        }finally{
            $this->fncendlog();
        }
    }
    
    
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->fncstartlog();
        try{
            //
            $orderOptions = [];
            // 注文情報取得
            $query = $this->Orders
                ->find('all', ['withDeleted'])
                ->where(['Orders.analysisfrom' => '2020-03-05'])
                ->order(['Orders.id' => 'DESC']);
            $orders = $this->paginate($query);
            foreach($orders as $order){
                $orderOption = $this->getSelectedOption($order->id);
                array_push($orderOptions, $orderOption);
            }
            // アグリノート情報追加
            $orders = $this->addAgrinoteListData($orders);
            // API連携システムであるか確認
            $orders = $this->addAppareapiusesystems($orders);
            //
            foreach($orders as $order) {
                $user = $this->usersAll[$order->userid];
                $order->dispname = $user->dispname;
                if($user->isApi){
                    $order->webapi = $user->apisystemname;
                }else{
                    $order->webapi = '天晴れWeb';
                }
            }
            //
            $this->set(compact('orders'));
            $this->set('orderOptions', $orderOptions);
            $this->set('_serialize', ['orders']);
        }catch(Exception $e){
            $this->applog($e->getMessage());
        }catch(Error $e){
            $this->applog($e->getMessage());
        }finally{
            $this->fncendlog();
        }
    }