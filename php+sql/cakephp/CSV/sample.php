<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class SampleController extends AppController
{
    public function index()
    {
        $this->fncstartlog();
        try{
            if (!empty($_GET['csvdownload']) || !empty($_GET['apply_csvdown'])) {
                $err_flg = false;
                if (!empty($_GET['csvdownload'])) {
                    if (empty($_GET['sel_checkbox'])) {
                        $this->Flash->error('CSVダウンロード対象のデータをチェックしてください');
                        $err_flg = true;
                    } else {
                        $ids = array();
                        foreach ($_GET['sel_checkbox'] as $v) {
                            $ids[] = intval($v);
                        }
                        $query = $this->RegUsers->find('all')
                            ->where(['RegUsers.id IN' => $ids])
                            ->contain(['Users'])
                            ->order(['RegUsers.id' => 'DESC']);
                    }
                } else {
                    $query = $this->RegUsers->find('all')
                        ->where(['RegUsers.status' => 'apply'])
                        ->contain(['Users'])
                        ->order(['RegUsers.id' => 'DESC']);
                }

                if (!$err_flg) {
                    $this->Users = TableRegistry::get('users');
                    $wherekonws = $this->Users->Whereknowns->find('list', ['limit' => 200])->toArray();
                    // 申込状態のリスト
                    $statuses = array(
                        'apply' => '申込中',
                        'registered' => '登録済み',
                        'deny' => '拒否',
                    );
                    $this->autoRender = false;
                    $fp = fopen('php://temp/mazmemory:'.(5*1024*1024), 'a');
                    fwrite($fp, '"利用申込ID","サービス利用区分","ドローンスクール修了証番号","名前","ふりがな","メールアドレス1","メールアドレス2","会社名","部署名","役職","電話番号","郵便番号","住所","どこでサービスを知ったか","「その他」を選んだ場合","請求先区分","請求先情報","クーポンコード","備考","登録日","状態","ユーザID","アカウントID","アカウントステータス","ユーザタイプ","サービス利用区分","名前","ふりがな","メールアドレス1","メールアドレス2","メールアドレス3","会社名","部署名","役職","電話番号","郵便番号","住所","どこでサービスを知ったか","「その他」を選んだ場合","クーポンコード","割引条件等","保守料","単価","請求先情報","メモ"' . "\n");
                    foreach ($query as $rec) {
                        $csv = array();
                        $csv[] = $rec['id'];
                        $csv[] = $rec['service_division'];
                        $csv[] = $rec['school_completion_no'];
                        $csv[] = $rec['name'];
                        $csv[] = $rec['kname'];
                        $csv[] = $rec['email'];
                        $csv[] = $rec['email_sub1'];
                        $csv[] = $rec['company'];
                        $csv[] = $rec['division'];
                        $csv[] = $rec['title'];
                        $csv[] = $rec['tel'];
                        $csv[] = $rec['zipcode'];
                        $csv[] = $rec['address'];
                        $csv[] = isset($whereknowns[$rec['whereknown_id']])? $whereknowns[$rec['whereknown_id']]: '';
                        $csv[] = $rec['whereknown_other'];
                        $csv[] = !empty($rec['billing_is_other'])? '※請求先は上記の会社名・住所とは異なる。': '※請求先は上記の会社名・住所と同一。';
                        $csv[] = $rec['billing_info'];
                        $csv[] = $rec['coupon_code'];
                        $csv[] = $rec['memo'];

                        $csv[] = $rec['created'];
                        $csv[] = $statuses[$rec['status']];

                        if (isset($rec['user'])):
                            $csv[] = $rec['user']['id'];
                            $csv[] = $rec['user']['accountid'];
                            $csv[] = !empty($rec['user']['status'])? '有効': '無効';
                            $csv[] = !empty($rec['user']['demo_user'])? 'お試しユーザ': '通常ユーザ';
                            $csv[] = $rec['user']['service_division'];
                            $csv[] = $rec['user']['name'];
                            $csv[] = $rec['user']['kname'];
                            $csv[] = $rec['user']['email'];
                            $csv[] = $rec['user']['email_sub1'];
                            $csv[] = $rec['user']['email_sub2'];
                            $csv[] = $rec['user']['company'];
                            $csv[] = $rec['user']['division'];
                            $csv[] = $rec['user']['title'];
                            $csv[] = $rec['user']['tel'];
                            $csv[] = $rec['user']['zipcode'];
                            $csv[] = $rec['user']['address'];
                            $csv[] = isset($whereknowns[$rec['user']['whereknown_id']])? $whereknowns[$rec['user']['whereknown_id']]: '';
                            $csv[] = $rec['user']['whereknown_other'];
                            $csv[] = $rec['user']['coupon_code'];
                            $csv[] = $rec['user']['billing-condition'];
                            $csv[] = $rec['user']['maintenance_fee'];
                            $csv[] = $rec['user']['unit_price'];
                            $csv[] = $rec['user']['billing_info'];
                            $csv[] = $rec['user']['memo'];
                        else:
                            $csv[] = '(ユーザデータはありません)';
                        endif;

                        fputcsv($fp, $csv);
                    }
                    $this->response->download("regusers". date("Ymdhis") .".csv");
                    rewind($fp);
                    $csv = stream_get_contents($fp);
                    $this->response->type('csv');
                    $csv = mb_convert_encoding($csv,'SJIS-win','utf8');
                    $this->response->body($csv);
                    fclose($fp);
                }
            }
            // 複数キーワードOR検索
            $query = $this->RegUsers
                ->find('keyword', $this->RegUsers->filterParams($this->request->query))
                ->contain([])
                ->where([])
                ->order([]);
            $this->set('regUsers', $this->paginate($query));
        }catch(Exception $e){
            $this->applog($e->getMessage());
        }catch(Error $e){
            $this->applog($e->getMessage());
        }finally{
            $this->fncendlog();
        }
    }
}