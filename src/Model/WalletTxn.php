<?php

/**
 * WalletTxn.
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
 * WalletTxn Class Doc Comment.
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
class WalletTxn implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'wallet_txn';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id'              => 'int',
        'company_id'      => 'int',
        'date'            => 'string',
        'amount'          => 'int',
        'due_amount'      => 'int',
        'balance'         => 'int',
        'entry_side'      => 'string',
        'walletable_type' => 'string',
        'walletable_id'   => 'int',
        'description'     => 'string',
        'status'          => 'int',
        'rule_matched'    => 'bool',
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
        'id'              => 'int64',
        'company_id'      => 'int64',
        'date'            => null,
        'amount'          => 'int64',
        'due_amount'      => 'int64',
        'balance'         => 'int64',
        'entry_side'      => null,
        'walletable_type' => null,
        'walletable_id'   => 'int64',
        'description'     => null,
        'status'          => 'int64',
        'rule_matched'    => null,
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
        'id'              => 'id',
        'company_id'      => 'company_id',
        'date'            => 'date',
        'amount'          => 'amount',
        'due_amount'      => 'due_amount',
        'balance'         => 'balance',
        'entry_side'      => 'entry_side',
        'walletable_type' => 'walletable_type',
        'walletable_id'   => 'walletable_id',
        'description'     => 'description',
        'status'          => 'status',
        'rule_matched'    => 'rule_matched',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'id'              => 'setId',
        'company_id'      => 'setCompanyId',
        'date'            => 'setDate',
        'amount'          => 'setAmount',
        'due_amount'      => 'setDueAmount',
        'balance'         => 'setBalance',
        'entry_side'      => 'setEntrySide',
        'walletable_type' => 'setWalletableType',
        'walletable_id'   => 'setWalletableId',
        'description'     => 'setDescription',
        'status'          => 'setStatus',
        'rule_matched'    => 'setRuleMatched',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'id'              => 'getId',
        'company_id'      => 'getCompanyId',
        'date'            => 'getDate',
        'amount'          => 'getAmount',
        'due_amount'      => 'getDueAmount',
        'balance'         => 'getBalance',
        'entry_side'      => 'getEntrySide',
        'walletable_type' => 'getWalletableType',
        'walletable_id'   => 'getWalletableId',
        'description'     => 'getDescription',
        'status'          => 'getStatus',
        'rule_matched'    => 'getRuleMatched',
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

    const ENTRY_SIDE_INCOME            = 'income';
    const ENTRY_SIDE_EXPENSE           = 'expense';
    const WALLETABLE_TYPE_BANK_ACCOUNT = 'bank_account';
    const WALLETABLE_TYPE_CREDIT_CARD  = 'credit_card';
    const WALLETABLE_TYPE_WALLET       = 'wallet';

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getEntrySideAllowableValues()
    {
        return [
            self::ENTRY_SIDE_INCOME,
            self::ENTRY_SIDE_EXPENSE,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getWalletableTypeAllowableValues()
    {
        return [
            self::WALLETABLE_TYPE_BANK_ACCOUNT,
            self::WALLETABLE_TYPE_CREDIT_CARD,
            self::WALLETABLE_TYPE_WALLET,
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
        $this->container['id']              = $data['id'] ?? null;
        $this->container['company_id']      = $data['company_id'] ?? null;
        $this->container['date']            = $data['date'] ?? null;
        $this->container['amount']          = $data['amount'] ?? null;
        $this->container['due_amount']      = $data['due_amount'] ?? null;
        $this->container['balance']         = $data['balance'] ?? null;
        $this->container['entry_side']      = $data['entry_side'] ?? null;
        $this->container['walletable_type'] = $data['walletable_type'] ?? null;
        $this->container['walletable_id']   = $data['walletable_id'] ?? null;
        $this->container['description']     = $data['description'] ?? null;
        $this->container['status']          = $data['status'] ?? null;
        $this->container['rule_matched']    = $data['rule_matched'] ?? null;
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

        if ($this->container['date'] === null) {
            $invalidProperties[] = "'date' can't be null";
        }
        if ($this->container['amount'] === null) {
            $invalidProperties[] = "'amount' can't be null";
        }
        if (($this->container['amount'] > 9223372036854775807)) {
            $invalidProperties[] = "invalid value for 'amount', must be smaller than or equal to 9223372036854775807.";
        }

        if (($this->container['amount'] < -9223372036854775808)) {
            $invalidProperties[] = "invalid value for 'amount', must be bigger than or equal to -9223372036854775808.";
        }

        if ($this->container['due_amount'] === null) {
            $invalidProperties[] = "'due_amount' can't be null";
        }
        if ($this->container['balance'] === null) {
            $invalidProperties[] = "'balance' can't be null";
        }
        if ($this->container['entry_side'] === null) {
            $invalidProperties[] = "'entry_side' can't be null";
        }
        $allowedValues = $this->getEntrySideAllowableValues();
        if (!is_null($this->container['entry_side']) && !in_array($this->container['entry_side'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'entry_side', must be one of '%s'",
                $this->container['entry_side'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['walletable_type'] === null) {
            $invalidProperties[] = "'walletable_type' can't be null";
        }
        $allowedValues = $this->getWalletableTypeAllowableValues();
        if (!is_null($this->container['walletable_type']) && !in_array($this->container['walletable_type'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'walletable_type', must be one of '%s'",
                $this->container['walletable_type'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['walletable_id'] === null) {
            $invalidProperties[] = "'walletable_id' can't be null";
        }
        if (($this->container['walletable_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'walletable_id', must be bigger than or equal to 1.";
        }

        if ($this->container['description'] === null) {
            $invalidProperties[] = "'description' can't be null";
        }
        if ($this->container['status'] === null) {
            $invalidProperties[] = "'status' can't be null";
        }
        if (($this->container['status'] > 6)) {
            $invalidProperties[] = "invalid value for 'status', must be smaller than or equal to 6.";
        }

        if (($this->container['status'] < 1)) {
            $invalidProperties[] = "invalid value for 'status', must be bigger than or equal to 1.";
        }

        if ($this->container['rule_matched'] === null) {
            $invalidProperties[] = "'rule_matched' can't be null";
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
     * @param int $id 明細ID
     *
     * @return self
     */
    public function setId($id)
    {
        if (($id < 1)) {
            throw new \InvalidArgumentException('invalid value for $id when calling WalletTxn., must be bigger than or equal to 1.');
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
            throw new \InvalidArgumentException('invalid value for $company_id when calling WalletTxn., must be bigger than or equal to 1.');
        }

        $this->container['company_id'] = $company_id;

        return $this;
    }

    /**
     * Gets date.
     *
     * @return string
     */
    public function getDate()
    {
        return $this->container['date'];
    }

    /**
     * Sets date.
     *
     * @param string $date 取引日(yyyy-mm-dd)
     *
     * @return self
     */
    public function setDate($date)
    {
        $this->container['date'] = $date;

        return $this;
    }

    /**
     * Gets amount.
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->container['amount'];
    }

    /**
     * Sets amount.
     *
     * @param int $amount 取引金額
     *
     * @return self
     */
    public function setAmount($amount)
    {
        if (($amount > 9223372036854775807)) {
            throw new \InvalidArgumentException('invalid value for $amount when calling WalletTxn., must be smaller than or equal to 9223372036854775807.');
        }
        if (($amount < -9223372036854775808)) {
            throw new \InvalidArgumentException('invalid value for $amount when calling WalletTxn., must be bigger than or equal to -9223372036854775808.');
        }

        $this->container['amount'] = $amount;

        return $this;
    }

    /**
     * Gets due_amount.
     *
     * @return int
     */
    public function getDueAmount()
    {
        return $this->container['due_amount'];
    }

    /**
     * Sets due_amount.
     *
     * @param int $due_amount 未決済金額
     *
     * @return self
     */
    public function setDueAmount($due_amount)
    {
        $this->container['due_amount'] = $due_amount;

        return $this;
    }

    /**
     * Gets balance.
     *
     * @return int
     */
    public function getBalance()
    {
        return $this->container['balance'];
    }

    /**
     * Sets balance.
     *
     * @param int $balance 残高(銀行口座等)(Webで残高未設定で登録した場合や口座明細の作成APIでキーを指定しないで登録した場合などはnullとなります)
     *
     * @return self
     */
    public function setBalance($balance)
    {
        $this->container['balance'] = $balance;

        return $this;
    }

    /**
     * Gets entry_side.
     *
     * @return string
     */
    public function getEntrySide()
    {
        return $this->container['entry_side'];
    }

    /**
     * Sets entry_side.
     *
     * @param string $entry_side 入金／出金 (入金: income, 出金: expense)
     *
     * @return self
     */
    public function setEntrySide($entry_side)
    {
        $allowedValues = $this->getEntrySideAllowableValues();
        if (!in_array($entry_side, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'entry_side', must be one of '%s'",
                    $entry_side,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['entry_side'] = $entry_side;

        return $this;
    }

    /**
     * Gets walletable_type.
     *
     * @return string
     */
    public function getWalletableType()
    {
        return $this->container['walletable_type'];
    }

    /**
     * Sets walletable_type.
     *
     * @param string $walletable_type 口座区分 (銀行口座: bank_account, クレジットカード: credit_card, 現金: wallet)
     *
     * @return self
     */
    public function setWalletableType($walletable_type)
    {
        $allowedValues = $this->getWalletableTypeAllowableValues();
        if (!in_array($walletable_type, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'walletable_type', must be one of '%s'",
                    $walletable_type,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['walletable_type'] = $walletable_type;

        return $this;
    }

    /**
     * Gets walletable_id.
     *
     * @return int
     */
    public function getWalletableId()
    {
        return $this->container['walletable_id'];
    }

    /**
     * Sets walletable_id.
     *
     * @param int $walletable_id 口座ID
     *
     * @return self
     */
    public function setWalletableId($walletable_id)
    {
        if (($walletable_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $walletable_id when calling WalletTxn., must be bigger than or equal to 1.');
        }

        $this->container['walletable_id'] = $walletable_id;

        return $this;
    }

    /**
     * Gets description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description.
     *
     * @param string $description 取引内容
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets status.
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status.
     *
     * @param int $status 明細のステータス（消込待ち: 1, 消込済み: 2, 無視: 3, 消込中: 4, 対象外: 6）
     *
     * @return self
     */
    public function setStatus($status)
    {
        if (($status > 6)) {
            throw new \InvalidArgumentException('invalid value for $status when calling WalletTxn., must be smaller than or equal to 6.');
        }
        if (($status < 1)) {
            throw new \InvalidArgumentException('invalid value for $status when calling WalletTxn., must be bigger than or equal to 1.');
        }

        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets rule_matched.
     *
     * @return bool
     */
    public function getRuleMatched()
    {
        return $this->container['rule_matched'];
    }

    /**
     * Sets rule_matched.
     *
     * @param bool $rule_matched 登録時に<a href=\"https://support.freee.co.jp/hc/ja/articles/202848350-明細の自動登録ルールを設定する\" target=\"_blank\">自動登録ルールの設定</a>が適用され、登録処理が実行された場合、 trueになります。〜を推測する、〜の消込をするの条件の場合は一致してもfalseになります。
     *
     * @return self
     */
    public function setRuleMatched($rule_matched)
    {
        $this->container['rule_matched'] = $rule_matched;

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
