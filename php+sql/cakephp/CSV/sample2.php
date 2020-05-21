<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Cake\Network\Email\Email;
use Aws\S3\S3Client;
use Aws\Sqs\SqsClient;
use App\Utils\AwsCredencialUtil;

/**
 * Jobs Controller
 * 
 * @property \App\Model\Table\JobsTable $Jobs
 */

 class JobsController extends AppController
 {
     public function initialize(){
         $this->fncstartlog();
         try{
             parent::initialize();
             $this->loadComponent('Search.Prg', [
                 'actions' => ['index', 'lookup']
             ]);
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
            $PlanabcsTable = TableRegistry::get('Planabcs');
            $planabcs = $PlanabcsTable->find('list', ['limit' => 200]);
            $planabcs = $planabcs->toArray();

            $OptionabcsTable = TableRegistry::get('Optionabcs');
            $optionabcs = $OptionabcsTable->find('list', ['limit' => 200]);
            $optionabcs = $optionabcs->toArray();

            $this->set('color_freekeyword', 'btn-info');
            $this->set('color_userterm', 'btn-info');

            if (isset($_GET['freekeyword'])) {
                // 複数キーワードOR検索
                $se = $this->Jobs->filterParams($this->request->query);
                $se['withDeleted'] = 'withDeleted';
                $query = $this->Jobs
                    ->find('keyword', $se)
                    ->contain(['Users', 'Templates', 'CoordinatesystemsOut', 'CoordinatesystemsIn'])
                    ->order(['Jobs.id' => 'DESC']);

                $this->set('color_freekeyword', 'btn-primary');
            }

            if (isset($_GET['userterm']) || isset($_GET['dlcsv'])) {
                $accountid = @$this->request->query['accountid'];
                $UsersTable = TableRegistry::get('Users');
                $res = $UsersTable->find()
                                  ->where(['accountid' => $accountid])
                                  ->first();
                $user_id = $res['id'];

                $from = $this->request->data['from_y'] . '-'. $this->request->data['from_m'] . "-01";
                $from_name = $this->request->data['from_y'] . $this->request->data['from_m'];
                $to = $this->request->data['to_y'] . '-'. $this->request->data['to_m'] . "-32";
                $to_name = $this->request->data['to_y'] . $this->request->data['to_m'];

                $query = $this->Jobs->find('all', ['withDeleted'])
                    ->where(['Jobs.user_id' => $user_id])
                    ->where(['Jobs.created >=' => $from])
                    ->where(['Jobs.created <=' => $to])
                    ->contain(['Users', 'Templates', 'CoordinatesystemsOut', 'CoordinatesystemsIn'])
                    ->order(['Jobs.id' => 'DESC']);

                $this->set('color_userterm', 'btn-primary');

                $username = "";
                if (isset($_GET['dlcsv'])) {
                    $this->autoRender = false;
                    $fp = fopen('php://temp/maxmemory:'.(5*1024*1024), 'a');
                    fwrite($fp, '"No","お客様名","ジョブ名","登録枚数","基本サービス","オプションサービス","登録日","完了日","ステータス","削除日"' . "\n");

                    foreach($query as $rec) {
                        $username = $rec['user']['name'];
                        $csv = array();
                        $csv[] = $rec['id'];
                        $csv[] = $rec['user']['name'];
                        $csv[] = $rec['title'];
                        $csv[] = $rec['num_photo'];
                        $csv[] = $planabcs[$rec['planabcs_id']];
                    }
                }
            }
        }
    }
}