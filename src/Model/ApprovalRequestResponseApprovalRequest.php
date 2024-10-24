<?php
/**
 * ApprovalRequestResponseApprovalRequest.
 *
 * PHP version 7.3
 *
 * @category Class
 *
 * @author   OpenAPI Generator team
 *
 * @link     https://openapi-generator.tech
 */

/**
 * freee会計 API.
 *
 * <hr /> <h2 id=\"start_guide\">スタートガイド</h2>  <p>freee API開発がはじめての方は<a href=\"https://developer.freee.co.jp/getting-started\">freee API スタートガイド</a>を参照してください。</p>  <hr /> <h2 id=\"specification\">お知らせ</h2>  <p> <b>インボイス制度に伴い、freee会計の帳票機能がfreee請求書に移行します。これに伴い、2023年10月にfreee会計の「請求書の作成、見積書の作成」エンドポイントは廃止、freee請求書APIに移行する予定です。詳細は<a href=\"https://developer.freee.co.jp/news/6369\" target=\"_blank\"> freee会計 APIの仕様変更（インボイス制度対応）について</a>をご確認ください。</b> </p>  <h2 id=\"specification\">仕様</h2>  <h3 id=\"api_endpoint\">APIエンドポイント</h3>  <p>https://api.freee.co.jp/ (httpsのみ)</p>  <h3 id=\"about_authorize\">認証について</h3> <p>OAuth2.0を利用します。<a href=\"https://developer.freee.co.jp/reference/#%e8%aa%8d%e8%a8%bc\" target=\"_blank\">詳細はリファレンスの認証に関する記載を参照してください。</a></p>  <h3 id=\"data_format\">データフォーマット</h3>  <p>リクエスト、レスポンスともにJSON形式をサポートしていますが、詳細は、API毎の説明欄（application/jsonなど）を確認してください。</p>  <h3 id=\"compatibility\">後方互換性ありの変更</h3>  <p>freeeでは、APIを改善していくために以下のような変更は後方互換性ありとして通知なく変更を入れることがあります。アプリケーション実装者は以下を踏まえて開発を行ってください。</p>  <ul> <li>新しいAPIリソース・エンドポイントの追加</li> <li>既存のAPIに対して必須ではない新しいリクエストパラメータの追加</li> <li>既存のAPIレスポンスに対する新しいプロパティの追加</li> <li>既存のAPIレスポンスに対するプロパティの順番の入れ変え</li> <li>keyとなっているidやcodeの長さの変更（長くする）</li> <li>エラーメッセージの変更</li> </ul>  <h3 id=\"common_response_header\">共通レスポンスヘッダー</h3>  <p>すべてのAPIのレスポンスには以下のHTTPヘッダーが含まれます。</p>  <ul> <li> <p>X-Freee-Request-ID</p> <ul> <li>各リクエスト毎に発行されるID</li> </ul> </li> </ul>  <h3 id=\"common_error_response\">共通エラーレスポンス</h3>  <ul> <li> <p>ステータスコードはレスポンス内のJSONに含まれる他、HTTPヘッダにも含まれる</p> </li> <li> <p>一部のエラーレスポンスにはエラーコードが含まれます。<br>詳細は、<a href=\"https://developer.freee.co.jp/tips/faq/40x-checkpoint\">HTTPステータスコード400台エラー時のチェックポイント</a>を参照してください</p> </li> <p>type</p>  <ul> <li>status : HTTPステータスコードの説明</li>  <li>validation : エラーの詳細の説明（開発者向け）</li> </ul> </li> </ul>  <p>レスポンスの例</p>  <pre><code>  {     &quot;status_code&quot; : 400,     &quot;errors&quot; : [       {         &quot;type&quot; : &quot;status&quot;,         &quot;messages&quot; : [&quot;不正なリクエストです。&quot;]       },       {         &quot;type&quot; : &quot;validation&quot;,         &quot;messages&quot; : [&quot;Date は不正な日付フォーマットです。入力例：2019-12-17&quot;]       }     ]   }</code></pre>  </br>  <h3 id=\"api_rate_limit\">API 使用制限</h3>    <p>freeeは一定期間に過度のアクセスを検知した場合、APIアクセスをコントロールする場合があります。</p>   <p>その際のhttp status codeは403となります。制限がかかってから10分程度が過ぎると再度使用することができるようになります。</p>  <h4 id=\"reports_api_endpoint\">/reportsと/receipts/{id}/downloadエンドポイント</h4>  <p>freeeはエンドポイント毎に一定頻度以上のアクセスを検知した場合、APIアクセスをコントロールする場合があります。その際のhttp status codeは429（too many requests）となります。</p> <ul>   <li>/reports:1秒に10回まで</li>   <li>/receipts/{id}/download:1秒に3回まで</li> </ul>  <p>http status codeが429となった場合、API使用ステータスはレスポンスヘッダに付与されます。</p> <pre><code>x-ratelimit-limit:10 x-ratelimit-remaining:1 x-ratelimit-reset:2023-01-13T10:22:29+09:00 </code></pre>  <br> 各ヘッダの意味は次のとおりです。</p>  <table border=\"1\">   <tbody>     <tr>       <th style=\"padding: 10px\"><strong>ヘッダ名</strong></th>       <th style=\"padding: 10px\"><strong>説明</strong></th>     </tr>     <tr><td style=\"padding: 10px\">x-ratelimit-limit</td><td style=\"padding: 10px\">使用回数の上限</td></tr>     <tr><td style=\"padding: 10px\">x-ratelimit-remaining</td><td style=\"padding: 10px\">残り使用回数</td></tr>     <tr><td style=\"padding: 10px\">x-ratelimit-reset</td><td style=\"padding: 10px\">使用回数がリセットされる時刻</td></tr>   </tbody> </table>  </br>  <h3 id=\"plan_api_rate_limit\">プランごとの API 使用制限</h3>   <table border=\"1\">     <tbody>       <tr>         <th style=\"padding: 10px\"><strong>freee会計プラン名</strong></th>         <th style=\"padding: 10px\"><strong>事業所とアプリケーション毎に、1日のAPIコール数の上限</strong></th>       </tr>       <tr>         <td style=\"padding: 10px\">法人エンタープライズプラン</td>         <td style=\"padding: 10px\">10,000</td>       </tr>       <tr>         <td style=\"padding: 10px\">法人アドバンスプラン（および旧法人プロフェッショナルプラン）</td>         <td style=\"padding: 10px\">5,000</td>       </tr>       <tr>         <td style=\"padding: 10px\">上記以外</td>         <td style=\"padding: 10px\">3,000</td>       </tr>     </tbody>   </table>  <h3 id=\"available_apis_by_plan\">プランごとの利用可能 API</h3> <p>契約プランごとにご利用可能な freee 会計 API は異なります。 freee 会計の Web 版でご利用いただける機能について、 freee 会計 API でもご利用いただけます。</p> <p>例えば法人スタータープラン、旧法人ベーシックプランをご契約いただいている場合、 Web 版では経費精算機能をご利用いただけますので、 API でも経費精算 API をご利用可能です。</p> <p>ただし以下の API は例外です。</p> <ul>   <li>総勘定元帳API：旧法人プロフェッショナルプラン、旧法人エンタープライズプラン、法人アドバンスプラン、新法人エンタープライズプランに加入している事業所のみがご利用可能です。</li>   <li>固定資産台帳API：旧法人エンタープライズプラン、新法人エンタープライズプランに加入している事業所のみがご利用可能です。</li> </ul> <p>詳しくは、<a href=\"https://support.freee.co.jp/hc/ja/articles/213726523--個人-freee会計のプランについて\" target=\"_blank\">【個人】freee会計のプランについて</a> 並びに <a href=\"https://support.freee.co.jp/hc/ja/articles/202849000--法人-freee会計のプランについて\" target=\"_blank\">【法人】freee会計のプランについて</a>をご確認ください。</p>  <h3 id=\"available_parameters_by_plan\">プランごとの利用可能パラメータ</h3> <p>ご利用可能な freee 会計 API であっても、契約プランごとに利用可能なパラメータは異なります。</p> <table border=\"1\">   <thead>     <tr>       <th>パラメータ</th>       <th>説明</th>       <th>利用可能プラン</th>     </tr>   </thead>   <tbody>     <tr>       <td>segment_1_tag</td>       <td>セグメント１タグ</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン<br />旧法人プロフェッショナルプラン</td>     </tr>     <tr>       <td>segment_2_tag</td>       <td>セグメント２タグ</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン</td>     </tr>     <tr>       <td>segment_3_tag</td>       <td>セグメント３タグ</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン</td>     </tr>     <tr>       <td>segment_1_tag_id</td>       <td>セグメント１タグID</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン<br />旧法人プロフェッショナルプラン</td>     </tr>     <tr>       <td>segment_2_tag_id</td>       <td>セグメント２タグID</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン</td>     </tr>     <tr>       <td>segment_3_tag_id</td>       <td>セグメント３タグID</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン</td>     </tr>     <tr>       <td>segment_1_tag_name</td>       <td>セグメント１タグ名</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン<br />旧法人プロフェッショナルプラン</td>     </tr>     <tr>       <td>segment_2_tag_name</td>       <td>セグメント２タグ名</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン</td>     </tr>     <tr>       <td>segment_3_tag_name</td>       <td>セグメント３タグ名</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン</td>     </tr>     <tr>       <td>segment_id</td>       <td>セグメントID（1, 2, 3 のいずれか）</td>       <td>法人アドバンスプラン<br />法人エンタープライズプラン<br />旧法人プロフェッショナルプラン<br />旧法人プロフェッショナルプランにつきましては、 1 のみ指定可能です。</td>     </tr>   </tbody> </table>  <h3 id=\"webhook\">Webhookについて</h3>  <p>詳細は<a href=\"https://developer.freee.co.jp/docs/accounting/webhook\" target=\"_blank\">会計Webhook概要</a>を参照してください。</p>  <hr /> <h2 id=\"contact\">連絡先</h2>  <p>ご不明点、ご要望等は <a href=\"https://freee.my.site.com/HelpCenter/s\">freee サポートデスクへのお問い合わせフォーム</a> からご連絡ください。</p> <hr />&copy; Since 2013 freee K.K.
 *
 * The version of the OpenAPI document: v1.0
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 5.4.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */
namespace OpenAPI\Client\Model;

use ArrayAccess;
use OpenAPI\Client\ObjectSerializer;

/**
 * ApprovalRequestResponseApprovalRequest Class Doc Comment.
 *
 * @category Class
 *
 * @author   OpenAPI Generator team
 *
 * @link     https://openapi-generator.tech
 *
 * @implements \ArrayAccess<TKey, TValue>
 *
 * @template TKey int|null
 * @template TValue mixed|null
 */
class ApprovalRequestResponseApprovalRequest implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'approvalRequestResponse_approval_request';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id'                     => 'int',
        'company_id'             => 'int',
        'application_date'       => 'string',
        'title'                  => 'string',
        'applicant_id'           => 'int',
        'approvers'              => '\OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationApprovers[]',
        'application_number'     => 'string',
        'status'                 => 'string',
        'request_items'          => '\OpenAPI\Client\Model\ApprovalRequestsIndexResponseRequestItems[]',
        'form_id'                => 'int',
        'approval_flow_route_id' => 'int',
        'comments'               => '\OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationComments[]',
        'approval_flow_logs'     => '\OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationApprovalFlowLogs[]',
        'current_step_id'        => 'int',
        'current_round'          => 'int',
        'approval_request_form'  => '\OpenAPI\Client\Model\ApprovalRequestResponseApprovalRequestApprovalRequestForm',
        'deal_id'                => 'int',
        'manual_journal_id'      => 'int',
        'deal_status'            => 'string',
    ];

    /**
     * Array of property to format mappings. Used for (de)serialization.
     *
     * @var string[]
     *
     * @phpstan-var array<string, string|null>
     *
     * @psalm-var array<string, string|null>
     */
    protected static $openAPIFormats = [
        'id'                     => 'int64',
        'company_id'             => 'int64',
        'application_date'       => null,
        'title'                  => null,
        'applicant_id'           => 'int64',
        'approvers'              => null,
        'application_number'     => null,
        'status'                 => null,
        'request_items'          => null,
        'form_id'                => 'int64',
        'approval_flow_route_id' => 'int64',
        'comments'               => null,
        'approval_flow_logs'     => null,
        'current_step_id'        => 'int64',
        'current_round'          => 'int64',
        'approval_request_form'  => null,
        'deal_id'                => 'int64',
        'manual_journal_id'      => 'int64',
        'deal_status'            => null,
    ];

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @return array
     */
    public static function openAPITypes()
    {
        return self::$openAPITypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization.
     *
     * @return array
     */
    public static function openAPIFormats()
    {
        return self::$openAPIFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'id'                     => 'id',
        'company_id'             => 'company_id',
        'application_date'       => 'application_date',
        'title'                  => 'title',
        'applicant_id'           => 'applicant_id',
        'approvers'              => 'approvers',
        'application_number'     => 'application_number',
        'status'                 => 'status',
        'request_items'          => 'request_items',
        'form_id'                => 'form_id',
        'approval_flow_route_id' => 'approval_flow_route_id',
        'comments'               => 'comments',
        'approval_flow_logs'     => 'approval_flow_logs',
        'current_step_id'        => 'current_step_id',
        'current_round'          => 'current_round',
        'approval_request_form'  => 'approval_request_form',
        'deal_id'                => 'deal_id',
        'manual_journal_id'      => 'manual_journal_id',
        'deal_status'            => 'deal_status',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'id'                     => 'setId',
        'company_id'             => 'setCompanyId',
        'application_date'       => 'setApplicationDate',
        'title'                  => 'setTitle',
        'applicant_id'           => 'setApplicantId',
        'approvers'              => 'setApprovers',
        'application_number'     => 'setApplicationNumber',
        'status'                 => 'setStatus',
        'request_items'          => 'setRequestItems',
        'form_id'                => 'setFormId',
        'approval_flow_route_id' => 'setApprovalFlowRouteId',
        'comments'               => 'setComments',
        'approval_flow_logs'     => 'setApprovalFlowLogs',
        'current_step_id'        => 'setCurrentStepId',
        'current_round'          => 'setCurrentRound',
        'approval_request_form'  => 'setApprovalRequestForm',
        'deal_id'                => 'setDealId',
        'manual_journal_id'      => 'setManualJournalId',
        'deal_status'            => 'setDealStatus',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'id'                     => 'getId',
        'company_id'             => 'getCompanyId',
        'application_date'       => 'getApplicationDate',
        'title'                  => 'getTitle',
        'applicant_id'           => 'getApplicantId',
        'approvers'              => 'getApprovers',
        'application_number'     => 'getApplicationNumber',
        'status'                 => 'getStatus',
        'request_items'          => 'getRequestItems',
        'form_id'                => 'getFormId',
        'approval_flow_route_id' => 'getApprovalFlowRouteId',
        'comments'               => 'getComments',
        'approval_flow_logs'     => 'getApprovalFlowLogs',
        'current_step_id'        => 'getCurrentStepId',
        'current_round'          => 'getCurrentRound',
        'approval_request_form'  => 'getApprovalRequestForm',
        'deal_id'                => 'getDealId',
        'manual_journal_id'      => 'getManualJournalId',
        'deal_status'            => 'getDealStatus',
    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name.
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$openAPIModelName;
    }

    const STATUS_DRAFT          = 'draft';
    const STATUS_IN_PROGRESS    = 'in_progress';
    const STATUS_APPROVED       = 'approved';
    const STATUS_REJECTED       = 'rejected';
    const STATUS_FEEDBACK       = 'feedback';
    const DEAL_STATUS_SETTLED   = 'settled';
    const DEAL_STATUS_UNSETTLED = 'unsettled';

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_DRAFT,
            self::STATUS_IN_PROGRESS,
            self::STATUS_APPROVED,
            self::STATUS_REJECTED,
            self::STATUS_FEEDBACK,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getDealStatusAllowableValues()
    {
        return [
            self::DEAL_STATUS_SETTLED,
            self::DEAL_STATUS_UNSETTLED,
        ];
    }

    /**
     * Associative array for storing property values.
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor.
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['id']                     = $data['id'] ?? null;
        $this->container['company_id']             = $data['company_id'] ?? null;
        $this->container['application_date']       = $data['application_date'] ?? null;
        $this->container['title']                  = $data['title'] ?? null;
        $this->container['applicant_id']           = $data['applicant_id'] ?? null;
        $this->container['approvers']              = $data['approvers'] ?? null;
        $this->container['application_number']     = $data['application_number'] ?? null;
        $this->container['status']                 = $data['status'] ?? null;
        $this->container['request_items']          = $data['request_items'] ?? null;
        $this->container['form_id']                = $data['form_id'] ?? null;
        $this->container['approval_flow_route_id'] = $data['approval_flow_route_id'] ?? null;
        $this->container['comments']               = $data['comments'] ?? null;
        $this->container['approval_flow_logs']     = $data['approval_flow_logs'] ?? null;
        $this->container['current_step_id']        = $data['current_step_id'] ?? null;
        $this->container['current_round']          = $data['current_round'] ?? null;
        $this->container['approval_request_form']  = $data['approval_request_form'] ?? null;
        $this->container['deal_id']                = $data['deal_id'] ?? null;
        $this->container['manual_journal_id']      = $data['manual_journal_id'] ?? null;
        $this->container['deal_status']            = $data['deal_status'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['id'] === null) {
            $invalidProperties[] = "'id' can't be null";
        }
        if (($this->container['id'] < 1)) {
            $invalidProperties[] = "invalid value for 'id', must be bigger than or equal to 1.";
        }

        if ($this->container['company_id'] === null) {
            $invalidProperties[] = "'company_id' can't be null";
        }
        if (($this->container['company_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'company_id', must be bigger than or equal to 1.";
        }

        if ($this->container['application_date'] === null) {
            $invalidProperties[] = "'application_date' can't be null";
        }
        if ($this->container['title'] === null) {
            $invalidProperties[] = "'title' can't be null";
        }
        if ($this->container['applicant_id'] === null) {
            $invalidProperties[] = "'applicant_id' can't be null";
        }
        if (($this->container['applicant_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'applicant_id', must be bigger than or equal to 1.";
        }

        if ($this->container['approvers'] === null) {
            $invalidProperties[] = "'approvers' can't be null";
        }
        if ($this->container['application_number'] === null) {
            $invalidProperties[] = "'application_number' can't be null";
        }
        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'status', must be one of '%s'",
                $this->container['status'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['request_items'] === null) {
            $invalidProperties[] = "'request_items' can't be null";
        }
        if ($this->container['form_id'] === null) {
            $invalidProperties[] = "'form_id' can't be null";
        }
        if (($this->container['form_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'form_id', must be bigger than or equal to 1.";
        }

        if ($this->container['approval_flow_route_id'] === null) {
            $invalidProperties[] = "'approval_flow_route_id' can't be null";
        }
        if (($this->container['approval_flow_route_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'approval_flow_route_id', must be bigger than or equal to 1.";
        }

        if ($this->container['comments'] === null) {
            $invalidProperties[] = "'comments' can't be null";
        }
        if ($this->container['approval_flow_logs'] === null) {
            $invalidProperties[] = "'approval_flow_logs' can't be null";
        }
        if ($this->container['current_step_id'] === null) {
            $invalidProperties[] = "'current_step_id' can't be null";
        }
        if (($this->container['current_step_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'current_step_id', must be bigger than or equal to 1.";
        }

        if ($this->container['current_round'] === null) {
            $invalidProperties[] = "'current_round' can't be null";
        }
        if (($this->container['current_round'] > 2147483647)) {
            $invalidProperties[] = "invalid value for 'current_round', must be smaller than or equal to 2147483647.";
        }

        if (($this->container['current_round'] < 0)) {
            $invalidProperties[] = "invalid value for 'current_round', must be bigger than or equal to 0.";
        }

        if ($this->container['approval_request_form'] === null) {
            $invalidProperties[] = "'approval_request_form' can't be null";
        }
        if ($this->container['deal_id'] === null) {
            $invalidProperties[] = "'deal_id' can't be null";
        }
        if (($this->container['deal_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'deal_id', must be bigger than or equal to 1.";
        }

        if ($this->container['manual_journal_id'] === null) {
            $invalidProperties[] = "'manual_journal_id' can't be null";
        }
        if (($this->container['manual_journal_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'manual_journal_id', must be bigger than or equal to 1.";
        }

        if ($this->container['deal_status'] === null) {
            $invalidProperties[] = "'deal_status' can't be null";
        }
        $allowedValues = $this->getDealStatusAllowableValues();
        if (!is_null($this->container['deal_status']) && !in_array($this->container['deal_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'deal_status', must be one of '%s'",
                $this->container['deal_status'],
                implode("', '", $allowedValues)
            );
        }

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed.
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id.
     *
     * @param int $id 各種申請ID
     *
     * @return self
     */
    public function setId($id)
    {
        if (($id < 1)) {
            throw new \InvalidArgumentException('invalid value for $id when calling ApprovalRequestResponseApprovalRequest., must be bigger than or equal to 1.');
        }

        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets company_id.
     *
     * @return int
     */
    public function getCompanyId()
    {
        return $this->container['company_id'];
    }

    /**
     * Sets company_id.
     *
     * @param int $company_id 事業所ID
     *
     * @return self
     */
    public function setCompanyId($company_id)
    {
        if (($company_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $company_id when calling ApprovalRequestResponseApprovalRequest., must be bigger than or equal to 1.');
        }

        $this->container['company_id'] = $company_id;

        return $this;
    }

    /**
     * Gets application_date.
     *
     * @return string
     */
    public function getApplicationDate()
    {
        return $this->container['application_date'];
    }

    /**
     * Sets application_date.
     *
     * @param string $application_date 申請日 (yyyy-mm-dd)
     *
     * @return self
     */
    public function setApplicationDate($application_date)
    {
        $this->container['application_date'] = $application_date;

        return $this;
    }

    /**
     * Gets title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title.
     *
     * @param string $title 申請タイトル
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets applicant_id.
     *
     * @return int
     */
    public function getApplicantId()
    {
        return $this->container['applicant_id'];
    }

    /**
     * Sets applicant_id.
     *
     * @param int $applicant_id 申請者のユーザーID
     *
     * @return self
     */
    public function setApplicantId($applicant_id)
    {
        if (($applicant_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $applicant_id when calling ApprovalRequestResponseApprovalRequest., must be bigger than or equal to 1.');
        }

        $this->container['applicant_id'] = $applicant_id;

        return $this;
    }

    /**
     * Gets approvers.
     *
     * @return \OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationApprovers[]
     */
    public function getApprovers()
    {
        return $this->container['approvers'];
    }

    /**
     * Sets approvers.
     *
     * @param \OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationApprovers[] $approvers 承認者（配列）   承認ステップのresource_typeがunspecified (指定なし)の場合はapproversはレスポンスに含まれません。   しかし、resource_typeがunspecifiedの承認ステップにおいて誰かが承認・却下・差し戻しのいずれかのアクションを取った後は、   approversはレスポンスに含まれるようになります。   その場合approversにはアクションを行ったステップのIDとアクションを行ったユーザーのIDが含まれます。
     *
     * @return self
     */
    public function setApprovers($approvers)
    {
        $this->container['approvers'] = $approvers;

        return $this;
    }

    /**
     * Gets application_number.
     *
     * @return string
     */
    public function getApplicationNumber()
    {
        return $this->container['application_number'];
    }

    /**
     * Sets application_number.
     *
     * @param string $application_number 申請No.
     *
     * @return self
     */
    public function setApplicationNumber($application_number)
    {
        $this->container['application_number'] = $application_number;

        return $this;
    }

    /**
     * Gets status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status.
     *
     * @param string $status 申請ステータス(draft:下書き, in_progress:申請中, approved:承認済, rejected:却下, feedback:差戻し)
     *
     * @return self
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'status', must be one of '%s'",
                    $status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets request_items.
     *
     * @return \OpenAPI\Client\Model\ApprovalRequestsIndexResponseRequestItems[]
     */
    public function getRequestItems()
    {
        return $this->container['request_items'];
    }

    /**
     * Sets request_items.
     *
     * @param \OpenAPI\Client\Model\ApprovalRequestsIndexResponseRequestItems[] $request_items 各種申請の項目一覧（配列）
     *
     * @return self
     */
    public function setRequestItems($request_items)
    {
        $this->container['request_items'] = $request_items;

        return $this;
    }

    /**
     * Gets form_id.
     *
     * @return int
     */
    public function getFormId()
    {
        return $this->container['form_id'];
    }

    /**
     * Sets form_id.
     *
     * @param int $form_id 申請フォームID
     *
     * @return self
     */
    public function setFormId($form_id)
    {
        if (($form_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $form_id when calling ApprovalRequestResponseApprovalRequest., must be bigger than or equal to 1.');
        }

        $this->container['form_id'] = $form_id;

        return $this;
    }

    /**
     * Gets approval_flow_route_id.
     *
     * @return int
     */
    public function getApprovalFlowRouteId()
    {
        return $this->container['approval_flow_route_id'];
    }

    /**
     * Sets approval_flow_route_id.
     *
     * @param int $approval_flow_route_id 申請経路ID
     *
     * @return self
     */
    public function setApprovalFlowRouteId($approval_flow_route_id)
    {
        if (($approval_flow_route_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $approval_flow_route_id when calling ApprovalRequestResponseApprovalRequest., must be bigger than or equal to 1.');
        }

        $this->container['approval_flow_route_id'] = $approval_flow_route_id;

        return $this;
    }

    /**
     * Gets comments.
     *
     * @return \OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationComments[]
     */
    public function getComments()
    {
        return $this->container['comments'];
    }

    /**
     * Sets comments.
     *
     * @param \OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationComments[] $comments 各種申請のコメント一覧（配列）
     *
     * @return self
     */
    public function setComments($comments)
    {
        $this->container['comments'] = $comments;

        return $this;
    }

    /**
     * Gets approval_flow_logs.
     *
     * @return \OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationApprovalFlowLogs[]
     */
    public function getApprovalFlowLogs()
    {
        return $this->container['approval_flow_logs'];
    }

    /**
     * Sets approval_flow_logs.
     *
     * @param \OpenAPI\Client\Model\ExpenseApplicationResponseExpenseApplicationApprovalFlowLogs[] $approval_flow_logs 各種申請の承認履歴（配列）
     *
     * @return self
     */
    public function setApprovalFlowLogs($approval_flow_logs)
    {
        $this->container['approval_flow_logs'] = $approval_flow_logs;

        return $this;
    }

    /**
     * Gets current_step_id.
     *
     * @return int
     */
    public function getCurrentStepId()
    {
        return $this->container['current_step_id'];
    }

    /**
     * Sets current_step_id.
     *
     * @param int $current_step_id 現在承認ステップID
     *
     * @return self
     */
    public function setCurrentStepId($current_step_id)
    {
        if (($current_step_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $current_step_id when calling ApprovalRequestResponseApprovalRequest., must be bigger than or equal to 1.');
        }

        $this->container['current_step_id'] = $current_step_id;

        return $this;
    }

    /**
     * Gets current_round.
     *
     * @return int
     */
    public function getCurrentRound()
    {
        return $this->container['current_round'];
    }

    /**
     * Sets current_round.
     *
     * @param int $current_round 現在のround。差し戻し等により申請がstepの最初からやり直しになるとroundの値が増えます。
     *
     * @return self
     */
    public function setCurrentRound($current_round)
    {
        if (($current_round > 2147483647)) {
            throw new \InvalidArgumentException('invalid value for $current_round when calling ApprovalRequestResponseApprovalRequest., must be smaller than or equal to 2147483647.');
        }
        if (($current_round < 0)) {
            throw new \InvalidArgumentException('invalid value for $current_round when calling ApprovalRequestResponseApprovalRequest., must be bigger than or equal to 0.');
        }

        $this->container['current_round'] = $current_round;

        return $this;
    }

    /**
     * Gets approval_request_form.
     *
     * @return \OpenAPI\Client\Model\ApprovalRequestResponseApprovalRequestApprovalRequestForm
     */
    public function getApprovalRequestForm()
    {
        return $this->container['approval_request_form'];
    }

    /**
     * Sets approval_request_form.
     *
     * @param \OpenAPI\Client\Model\ApprovalRequestResponseApprovalRequestApprovalRequestForm $approval_request_form approval_request_form
     *
     * @return self
     */
    public function setApprovalRequestForm($approval_request_form)
    {
        $this->container['approval_request_form'] = $approval_request_form;

        return $this;
    }

    /**
     * Gets deal_id.
     *
     * @return int
     */
    public function getDealId()
    {
        return $this->container['deal_id'];
    }

    /**
     * Sets deal_id.
     *
     * @param int $deal_id 取引ID (申請ステータス:statusがapprovedで、取引が存在する時のみdeal_idが表示されます)
     *
     * @return self
     */
    public function setDealId($deal_id)
    {
        if (($deal_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $deal_id when calling ApprovalRequestResponseApprovalRequest., must be bigger than or equal to 1.');
        }

        $this->container['deal_id'] = $deal_id;

        return $this;
    }

    /**
     * Gets manual_journal_id.
     *
     * @return int
     */
    public function getManualJournalId()
    {
        return $this->container['manual_journal_id'];
    }

    /**
     * Sets manual_journal_id.
     *
     * @param int $manual_journal_id 振替伝票のID (申請ステータス:statusがapprovedで、関連する振替伝票が存在する時のみmanual_journal_idが表示されます)  <a href=\"https://support.freee.co.jp/hc/ja/articles/115003827683-#5\" target=\"_blank\">承認された各種申請から支払依頼等を作成する</a>
     *
     * @return self
     */
    public function setManualJournalId($manual_journal_id)
    {
        if (($manual_journal_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $manual_journal_id when calling ApprovalRequestResponseApprovalRequest., must be bigger than or equal to 1.');
        }

        $this->container['manual_journal_id'] = $manual_journal_id;

        return $this;
    }

    /**
     * Gets deal_status.
     *
     * @return string
     */
    public function getDealStatus()
    {
        return $this->container['deal_status'];
    }

    /**
     * Sets deal_status.
     *
     * @param string $deal_status 取引ステータス (申請ステータス:statusがapprovedで、取引が存在する時のみdeal_statusが表示されます settled:決済済み, unsettled:未決済)
     *
     * @return self
     */
    public function setDealStatus($deal_status)
    {
        $allowedValues = $this->getDealStatusAllowableValues();
        if (!in_array($deal_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'deal_status', must be one of '%s'",
                    $deal_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['deal_status'] = $deal_status;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param int $offset Offset
     *
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param int $offset Offset
     *
     * @return mixed|null
     */
    public function offsetGet($offset)
    {
        return $this->container[$offset] ?? null;
    }

    /**
     * Sets value based on offset.
     *
     * @param int|null $offset Offset
     * @param mixed    $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param int $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Serializes the object to a value that can be serialized natively by json_encode().
     *
     * @link https://www.php.net/manual/en/jsonserializable.jsonserialize.php
     *
     * @return mixed Returns data which can be serialized by json_encode(), which is a value
     *               of any type other than a resource.
     */
    public function jsonSerialize()
    {
        return ObjectSerializer::sanitizeForSerialization($this);
    }

    /**
     * Gets the string presentation of the object.
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode(
            ObjectSerializer::sanitizeForSerialization($this),
            JSON_PRETTY_PRINT
        );
    }

    /**
     * Gets a header-safe presentation of the object.
     *
     * @return string
     */
    public function toHeaderValue()
    {
        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}