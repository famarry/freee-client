<?php
/**
 * TrialPlResponseTrialPl.
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
 * TrialPlResponseTrialPl Class Doc Comment.
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
class TrialPlResponseTrialPl implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'trialPlResponse_trial_pl';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'company_id'                => 'int',
        'fiscal_year'               => 'int',
        'start_month'               => 'int',
        'end_month'                 => 'int',
        'start_date'                => 'string',
        'end_date'                  => 'string',
        'account_item_display_type' => 'string',
        'breakdown_display_type'    => 'string',
        'partner_id'                => 'int',
        'partner_code'              => 'string',
        'item_id'                   => 'int',
        'section_id'                => 'int',
        'adjustment'                => 'string',
        'cost_allocation'           => 'string',
        'approval_flow_status'      => 'string',
        'created_at'                => 'string',
        'balances'                  => '\OpenAPI\Client\Model\TrialBsResponseTrialBsBalances[]',
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
        'company_id'                => 'int64',
        'fiscal_year'               => 'int64',
        'start_month'               => 'int64',
        'end_month'                 => 'int64',
        'start_date'                => null,
        'end_date'                  => null,
        'account_item_display_type' => null,
        'breakdown_display_type'    => null,
        'partner_id'                => 'int64',
        'partner_code'              => null,
        'item_id'                   => 'int64',
        'section_id'                => 'int64',
        'adjustment'                => null,
        'cost_allocation'           => null,
        'approval_flow_status'      => null,
        'created_at'                => null,
        'balances'                  => null,
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
        'company_id'                => 'company_id',
        'fiscal_year'               => 'fiscal_year',
        'start_month'               => 'start_month',
        'end_month'                 => 'end_month',
        'start_date'                => 'start_date',
        'end_date'                  => 'end_date',
        'account_item_display_type' => 'account_item_display_type',
        'breakdown_display_type'    => 'breakdown_display_type',
        'partner_id'                => 'partner_id',
        'partner_code'              => 'partner_code',
        'item_id'                   => 'item_id',
        'section_id'                => 'section_id',
        'adjustment'                => 'adjustment',
        'cost_allocation'           => 'cost_allocation',
        'approval_flow_status'      => 'approval_flow_status',
        'created_at'                => 'created_at',
        'balances'                  => 'balances',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'company_id'                => 'setCompanyId',
        'fiscal_year'               => 'setFiscalYear',
        'start_month'               => 'setStartMonth',
        'end_month'                 => 'setEndMonth',
        'start_date'                => 'setStartDate',
        'end_date'                  => 'setEndDate',
        'account_item_display_type' => 'setAccountItemDisplayType',
        'breakdown_display_type'    => 'setBreakdownDisplayType',
        'partner_id'                => 'setPartnerId',
        'partner_code'              => 'setPartnerCode',
        'item_id'                   => 'setItemId',
        'section_id'                => 'setSectionId',
        'adjustment'                => 'setAdjustment',
        'cost_allocation'           => 'setCostAllocation',
        'approval_flow_status'      => 'setApprovalFlowStatus',
        'created_at'                => 'setCreatedAt',
        'balances'                  => 'setBalances',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'company_id'                => 'getCompanyId',
        'fiscal_year'               => 'getFiscalYear',
        'start_month'               => 'getStartMonth',
        'end_month'                 => 'getEndMonth',
        'start_date'                => 'getStartDate',
        'end_date'                  => 'getEndDate',
        'account_item_display_type' => 'getAccountItemDisplayType',
        'breakdown_display_type'    => 'getBreakdownDisplayType',
        'partner_id'                => 'getPartnerId',
        'partner_code'              => 'getPartnerCode',
        'item_id'                   => 'getItemId',
        'section_id'                => 'getSectionId',
        'adjustment'                => 'getAdjustment',
        'cost_allocation'           => 'getCostAllocation',
        'approval_flow_status'      => 'getApprovalFlowStatus',
        'created_at'                => 'getCreatedAt',
        'balances'                  => 'getBalances',
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

    const ACCOUNT_ITEM_DISPLAY_TYPE_ACCOUNT_ITEM   = 'account_item';
    const ACCOUNT_ITEM_DISPLAY_TYPE_GROUP          = 'group';
    const BREAKDOWN_DISPLAY_TYPE_PARTNER           = 'partner';
    const BREAKDOWN_DISPLAY_TYPE_ITEM              = 'item';
    const BREAKDOWN_DISPLAY_TYPE_SECTION           = 'section';
    const BREAKDOWN_DISPLAY_TYPE_ACCOUNT_ITEM      = 'account_item';
    const BREAKDOWN_DISPLAY_TYPE_SEGMENT_1_TAG     = 'segment_1_tag';
    const BREAKDOWN_DISPLAY_TYPE_SEGMENT_2_TAG     = 'segment_2_tag';
    const BREAKDOWN_DISPLAY_TYPE_SEGMENT_3_TAG     = 'segment_3_tag';
    const ADJUSTMENT_ONLY                          = 'only';
    const ADJUSTMENT_WITHOUT                       = 'without';
    const COST_ALLOCATION_ONLY                     = 'only';
    const COST_ALLOCATION_WITHOUT                  = 'without';
    const APPROVAL_FLOW_STATUS_WITHOUT_IN_PROGRESS = 'without_in_progress';
    const APPROVAL_FLOW_STATUS_ALL                 = 'all';

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getAccountItemDisplayTypeAllowableValues()
    {
        return [
            self::ACCOUNT_ITEM_DISPLAY_TYPE_ACCOUNT_ITEM,
            self::ACCOUNT_ITEM_DISPLAY_TYPE_GROUP,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getBreakdownDisplayTypeAllowableValues()
    {
        return [
            self::BREAKDOWN_DISPLAY_TYPE_PARTNER,
            self::BREAKDOWN_DISPLAY_TYPE_ITEM,
            self::BREAKDOWN_DISPLAY_TYPE_SECTION,
            self::BREAKDOWN_DISPLAY_TYPE_ACCOUNT_ITEM,
            self::BREAKDOWN_DISPLAY_TYPE_SEGMENT_1_TAG,
            self::BREAKDOWN_DISPLAY_TYPE_SEGMENT_2_TAG,
            self::BREAKDOWN_DISPLAY_TYPE_SEGMENT_3_TAG,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getAdjustmentAllowableValues()
    {
        return [
            self::ADJUSTMENT_ONLY,
            self::ADJUSTMENT_WITHOUT,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getCostAllocationAllowableValues()
    {
        return [
            self::COST_ALLOCATION_ONLY,
            self::COST_ALLOCATION_WITHOUT,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getApprovalFlowStatusAllowableValues()
    {
        return [
            self::APPROVAL_FLOW_STATUS_WITHOUT_IN_PROGRESS,
            self::APPROVAL_FLOW_STATUS_ALL,
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
        $this->container['company_id']                = $data['company_id'] ?? null;
        $this->container['fiscal_year']               = $data['fiscal_year'] ?? null;
        $this->container['start_month']               = $data['start_month'] ?? null;
        $this->container['end_month']                 = $data['end_month'] ?? null;
        $this->container['start_date']                = $data['start_date'] ?? null;
        $this->container['end_date']                  = $data['end_date'] ?? null;
        $this->container['account_item_display_type'] = $data['account_item_display_type'] ?? null;
        $this->container['breakdown_display_type']    = $data['breakdown_display_type'] ?? null;
        $this->container['partner_id']                = $data['partner_id'] ?? null;
        $this->container['partner_code']              = $data['partner_code'] ?? null;
        $this->container['item_id']                   = $data['item_id'] ?? null;
        $this->container['section_id']                = $data['section_id'] ?? null;
        $this->container['adjustment']                = $data['adjustment'] ?? null;
        $this->container['cost_allocation']           = $data['cost_allocation'] ?? null;
        $this->container['approval_flow_status']      = $data['approval_flow_status'] ?? null;
        $this->container['created_at']                = $data['created_at'] ?? null;
        $this->container['balances']                  = $data['balances'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['company_id'] === null) {
            $invalidProperties[] = "'company_id' can't be null";
        }
        if (($this->container['company_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'company_id', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['start_month']) && ($this->container['start_month'] > 12)) {
            $invalidProperties[] = "invalid value for 'start_month', must be smaller than or equal to 12.";
        }

        if (!is_null($this->container['start_month']) && ($this->container['start_month'] < 1)) {
            $invalidProperties[] = "invalid value for 'start_month', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['end_month']) && ($this->container['end_month'] > 12)) {
            $invalidProperties[] = "invalid value for 'end_month', must be smaller than or equal to 12.";
        }

        if (!is_null($this->container['end_month']) && ($this->container['end_month'] < 1)) {
            $invalidProperties[] = "invalid value for 'end_month', must be bigger than or equal to 1.";
        }

        $allowedValues = $this->getAccountItemDisplayTypeAllowableValues();
        if (!is_null($this->container['account_item_display_type']) && !in_array($this->container['account_item_display_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'account_item_display_type', must be one of '%s'",
                $this->container['account_item_display_type'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getBreakdownDisplayTypeAllowableValues();
        if (!is_null($this->container['breakdown_display_type']) && !in_array($this->container['breakdown_display_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'breakdown_display_type', must be one of '%s'",
                $this->container['breakdown_display_type'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['partner_id']) && ($this->container['partner_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'partner_id', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['item_id']) && ($this->container['item_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'item_id', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['section_id']) && ($this->container['section_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'section_id', must be bigger than or equal to 1.";
        }

        $allowedValues = $this->getAdjustmentAllowableValues();
        if (!is_null($this->container['adjustment']) && !in_array($this->container['adjustment'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'adjustment', must be one of '%s'",
                $this->container['adjustment'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getCostAllocationAllowableValues();
        if (!is_null($this->container['cost_allocation']) && !in_array($this->container['cost_allocation'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'cost_allocation', must be one of '%s'",
                $this->container['cost_allocation'],
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getApprovalFlowStatusAllowableValues();
        if (!is_null($this->container['approval_flow_status']) && !in_array($this->container['approval_flow_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'approval_flow_status', must be one of '%s'",
                $this->container['approval_flow_status'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['balances'] === null) {
            $invalidProperties[] = "'balances' can't be null";
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
            throw new \InvalidArgumentException('invalid value for $company_id when calling TrialPlResponseTrialPl., must be bigger than or equal to 1.');
        }

        $this->container['company_id'] = $company_id;

        return $this;
    }

    /**
     * Gets fiscal_year.
     *
     * @return int|null
     */
    public function getFiscalYear()
    {
        return $this->container['fiscal_year'];
    }

    /**
     * Sets fiscal_year.
     *
     * @param int|null $fiscal_year 会計年度(条件に指定した時、または条件に月、日条件がない時のみ含まれる）
     *
     * @return self
     */
    public function setFiscalYear($fiscal_year)
    {
        $this->container['fiscal_year'] = $fiscal_year;

        return $this;
    }

    /**
     * Gets start_month.
     *
     * @return int|null
     */
    public function getStartMonth()
    {
        return $this->container['start_month'];
    }

    /**
     * Sets start_month.
     *
     * @param int|null $start_month 発生月で絞込：開始会計月(1-12)(条件に指定した時のみ含まれる）
     *
     * @return self
     */
    public function setStartMonth($start_month)
    {
        if (!is_null($start_month) && ($start_month > 12)) {
            throw new \InvalidArgumentException('invalid value for $start_month when calling TrialPlResponseTrialPl., must be smaller than or equal to 12.');
        }
        if (!is_null($start_month) && ($start_month < 1)) {
            throw new \InvalidArgumentException('invalid value for $start_month when calling TrialPlResponseTrialPl., must be bigger than or equal to 1.');
        }

        $this->container['start_month'] = $start_month;

        return $this;
    }

    /**
     * Gets end_month.
     *
     * @return int|null
     */
    public function getEndMonth()
    {
        return $this->container['end_month'];
    }

    /**
     * Sets end_month.
     *
     * @param int|null $end_month 発生月で絞込：終了会計月(1-12)(条件に指定した時のみ含まれる）
     *
     * @return self
     */
    public function setEndMonth($end_month)
    {
        if (!is_null($end_month) && ($end_month > 12)) {
            throw new \InvalidArgumentException('invalid value for $end_month when calling TrialPlResponseTrialPl., must be smaller than or equal to 12.');
        }
        if (!is_null($end_month) && ($end_month < 1)) {
            throw new \InvalidArgumentException('invalid value for $end_month when calling TrialPlResponseTrialPl., must be bigger than or equal to 1.');
        }

        $this->container['end_month'] = $end_month;

        return $this;
    }

    /**
     * Gets start_date.
     *
     * @return string|null
     */
    public function getStartDate()
    {
        return $this->container['start_date'];
    }

    /**
     * Sets start_date.
     *
     * @param string|null $start_date 発生日で絞込：開始日(yyyy-mm-dd)(条件に指定した時のみ含まれる）
     *
     * @return self
     */
    public function setStartDate($start_date)
    {
        $this->container['start_date'] = $start_date;

        return $this;
    }

    /**
     * Gets end_date.
     *
     * @return string|null
     */
    public function getEndDate()
    {
        return $this->container['end_date'];
    }

    /**
     * Sets end_date.
     *
     * @param string|null $end_date 発生日で絞込：終了日(yyyy-mm-dd)(条件に指定した時のみ含まれる）
     *
     * @return self
     */
    public function setEndDate($end_date)
    {
        $this->container['end_date'] = $end_date;

        return $this;
    }

    /**
     * Gets account_item_display_type.
     *
     * @return string|null
     */
    public function getAccountItemDisplayType()
    {
        return $this->container['account_item_display_type'];
    }

    /**
     * Sets account_item_display_type.
     *
     * @param string|null $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）(条件に指定した時のみ含まれる）
     *
     * @return self
     */
    public function setAccountItemDisplayType($account_item_display_type)
    {
        $allowedValues = $this->getAccountItemDisplayTypeAllowableValues();
        if (!is_null($account_item_display_type) && !in_array($account_item_display_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'account_item_display_type', must be one of '%s'",
                    $account_item_display_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['account_item_display_type'] = $account_item_display_type;

        return $this;
    }

    /**
     * Gets breakdown_display_type.
     *
     * @return string|null
     */
    public function getBreakdownDisplayType()
    {
        return $this->container['breakdown_display_type'];
    }

    /**
     * Sets breakdown_display_type.
     *
     * @param string|null $breakdown_display_type 内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag）(条件に指定した時のみ含まれる）
     *
     * @return self
     */
    public function setBreakdownDisplayType($breakdown_display_type)
    {
        $allowedValues = $this->getBreakdownDisplayTypeAllowableValues();
        if (!is_null($breakdown_display_type) && !in_array($breakdown_display_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'breakdown_display_type', must be one of '%s'",
                    $breakdown_display_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['breakdown_display_type'] = $breakdown_display_type;

        return $this;
    }

    /**
     * Gets partner_id.
     *
     * @return int|null
     */
    public function getPartnerId()
    {
        return $this->container['partner_id'];
    }

    /**
     * Sets partner_id.
     *
     * @param int|null $partner_id 取引先ID(条件に指定した時のみ含まれる）
     *
     * @return self
     */
    public function setPartnerId($partner_id)
    {
        if (!is_null($partner_id) && ($partner_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $partner_id when calling TrialPlResponseTrialPl., must be bigger than or equal to 1.');
        }

        $this->container['partner_id'] = $partner_id;

        return $this;
    }

    /**
     * Gets partner_code.
     *
     * @return string|null
     */
    public function getPartnerCode()
    {
        return $this->container['partner_code'];
    }

    /**
     * Sets partner_code.
     *
     * @param string|null $partner_code 取引先コード(条件に指定した時のみ含まれる）
     *
     * @return self
     */
    public function setPartnerCode($partner_code)
    {
        $this->container['partner_code'] = $partner_code;

        return $this;
    }

    /**
     * Gets item_id.
     *
     * @return int|null
     */
    public function getItemId()
    {
        return $this->container['item_id'];
    }

    /**
     * Sets item_id.
     *
     * @param int|null $item_id 品目ID(条件に指定した時のみ含まれる）
     *
     * @return self
     */
    public function setItemId($item_id)
    {
        if (!is_null($item_id) && ($item_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $item_id when calling TrialPlResponseTrialPl., must be bigger than or equal to 1.');
        }

        $this->container['item_id'] = $item_id;

        return $this;
    }

    /**
     * Gets section_id.
     *
     * @return int|null
     */
    public function getSectionId()
    {
        return $this->container['section_id'];
    }

    /**
     * Sets section_id.
     *
     * @param int|null $section_id 部門ID(条件に指定した時のみ含まれる）
     *
     * @return self
     */
    public function setSectionId($section_id)
    {
        if (!is_null($section_id) && ($section_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $section_id when calling TrialPlResponseTrialPl., must be bigger than or equal to 1.');
        }

        $this->container['section_id'] = $section_id;

        return $this;
    }

    /**
     * Gets adjustment.
     *
     * @return string|null
     */
    public function getAdjustment()
    {
        return $this->container['adjustment'];
    }

    /**
     * Sets adjustment.
     *
     * @param string|null $adjustment 決算整理仕訳のみ: only, 決算整理仕訳以外: without(条件に指定した時のみ含まれる）
     *
     * @return self
     */
    public function setAdjustment($adjustment)
    {
        $allowedValues = $this->getAdjustmentAllowableValues();
        if (!is_null($adjustment) && !in_array($adjustment, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'adjustment', must be one of '%s'",
                    $adjustment,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['adjustment'] = $adjustment;

        return $this;
    }

    /**
     * Gets cost_allocation.
     *
     * @return string|null
     */
    public function getCostAllocation()
    {
        return $this->container['cost_allocation'];
    }

    /**
     * Sets cost_allocation.
     *
     * @param string|null $cost_allocation 配賦仕訳のみ：only,配賦仕訳以外：without(条件に指定した時のみ含まれる）
     *
     * @return self
     */
    public function setCostAllocation($cost_allocation)
    {
        $allowedValues = $this->getCostAllocationAllowableValues();
        if (!is_null($cost_allocation) && !in_array($cost_allocation, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'cost_allocation', must be one of '%s'",
                    $cost_allocation,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['cost_allocation'] = $cost_allocation;

        return $this;
    }

    /**
     * Gets approval_flow_status.
     *
     * @return string|null
     */
    public function getApprovalFlowStatus()
    {
        return $this->container['approval_flow_status'];
    }

    /**
     * Sets approval_flow_status.
     *
     * @param string|null $approval_flow_status 未承認を除く: without_in_progress (デフォルト), 全てのステータス: all(条件に指定した時のみ含まれる）
     *
     * @return self
     */
    public function setApprovalFlowStatus($approval_flow_status)
    {
        $allowedValues = $this->getApprovalFlowStatusAllowableValues();
        if (!is_null($approval_flow_status) && !in_array($approval_flow_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'approval_flow_status', must be one of '%s'",
                    $approval_flow_status,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['approval_flow_status'] = $approval_flow_status;

        return $this;
    }

    /**
     * Gets created_at.
     *
     * @return string|null
     */
    public function getCreatedAt()
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at.
     *
     * @param string|null $created_at 作成日時
     *
     * @return self
     */
    public function setCreatedAt($created_at)
    {
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets balances.
     *
     * @return \OpenAPI\Client\Model\TrialBsResponseTrialBsBalances[]
     */
    public function getBalances()
    {
        return $this->container['balances'];
    }

    /**
     * Sets balances.
     *
     * @param \OpenAPI\Client\Model\TrialBsResponseTrialBsBalances[] $balances balances
     *
     * @return self
     */
    public function setBalances($balances)
    {
        $this->container['balances'] = $balances;

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
