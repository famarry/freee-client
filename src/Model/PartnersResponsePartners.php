<?php
/**
 * PartnersResponsePartners.
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
 * PartnersResponsePartners Class Doc Comment.
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
class PartnersResponsePartners implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'partnersResponse_partners';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id'                              => 'int',
        'code'                            => 'string',
        'company_id'                      => 'int',
        'name'                            => 'string',
        'update_date'                     => 'string',
        'available'                       => 'bool',
        'shortcut1'                       => 'string',
        'shortcut2'                       => 'string',
        'org_code'                        => 'int',
        'country_code'                    => 'string',
        'long_name'                       => 'string',
        'name_kana'                       => 'string',
        'default_title'                   => 'string',
        'phone'                           => 'string',
        'contact_name'                    => 'string',
        'email'                           => 'string',
        'payer_walletable_id'             => 'int',
        'transfer_fee_handling_side'      => 'string',
        'qualified_invoice_issuer'        => 'bool',
        'invoice_registration_number'     => 'string',
        'address_attributes'              => '\OpenAPI\Client\Model\PartnersResponseAddressAttributes',
        'partner_doc_setting_attributes'  => '\OpenAPI\Client\Model\PartnerCreateParamsPartnerDocSettingAttributes',
        'partner_bank_account_attributes' => '\OpenAPI\Client\Model\PartnersResponsePartnerBankAccountAttributes',
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
        'id'                              => 'int64',
        'code'                            => null,
        'company_id'                      => 'int64',
        'name'                            => null,
        'update_date'                     => null,
        'available'                       => null,
        'shortcut1'                       => null,
        'shortcut2'                       => null,
        'org_code'                        => 'int64',
        'country_code'                    => null,
        'long_name'                       => null,
        'name_kana'                       => null,
        'default_title'                   => null,
        'phone'                           => null,
        'contact_name'                    => null,
        'email'                           => null,
        'payer_walletable_id'             => 'int64',
        'transfer_fee_handling_side'      => null,
        'qualified_invoice_issuer'        => null,
        'invoice_registration_number'     => null,
        'address_attributes'              => null,
        'partner_doc_setting_attributes'  => null,
        'partner_bank_account_attributes' => null,
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
        'id'                              => 'id',
        'code'                            => 'code',
        'company_id'                      => 'company_id',
        'name'                            => 'name',
        'update_date'                     => 'update_date',
        'available'                       => 'available',
        'shortcut1'                       => 'shortcut1',
        'shortcut2'                       => 'shortcut2',
        'org_code'                        => 'org_code',
        'country_code'                    => 'country_code',
        'long_name'                       => 'long_name',
        'name_kana'                       => 'name_kana',
        'default_title'                   => 'default_title',
        'phone'                           => 'phone',
        'contact_name'                    => 'contact_name',
        'email'                           => 'email',
        'payer_walletable_id'             => 'payer_walletable_id',
        'transfer_fee_handling_side'      => 'transfer_fee_handling_side',
        'qualified_invoice_issuer'        => 'qualified_invoice_issuer',
        'invoice_registration_number'     => 'invoice_registration_number',
        'address_attributes'              => 'address_attributes',
        'partner_doc_setting_attributes'  => 'partner_doc_setting_attributes',
        'partner_bank_account_attributes' => 'partner_bank_account_attributes',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'id'                              => 'setId',
        'code'                            => 'setCode',
        'company_id'                      => 'setCompanyId',
        'name'                            => 'setName',
        'update_date'                     => 'setUpdateDate',
        'available'                       => 'setAvailable',
        'shortcut1'                       => 'setShortcut1',
        'shortcut2'                       => 'setShortcut2',
        'org_code'                        => 'setOrgCode',
        'country_code'                    => 'setCountryCode',
        'long_name'                       => 'setLongName',
        'name_kana'                       => 'setNameKana',
        'default_title'                   => 'setDefaultTitle',
        'phone'                           => 'setPhone',
        'contact_name'                    => 'setContactName',
        'email'                           => 'setEmail',
        'payer_walletable_id'             => 'setPayerWalletableId',
        'transfer_fee_handling_side'      => 'setTransferFeeHandlingSide',
        'qualified_invoice_issuer'        => 'setQualifiedInvoiceIssuer',
        'invoice_registration_number'     => 'setInvoiceRegistrationNumber',
        'address_attributes'              => 'setAddressAttributes',
        'partner_doc_setting_attributes'  => 'setPartnerDocSettingAttributes',
        'partner_bank_account_attributes' => 'setPartnerBankAccountAttributes',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'id'                              => 'getId',
        'code'                            => 'getCode',
        'company_id'                      => 'getCompanyId',
        'name'                            => 'getName',
        'update_date'                     => 'getUpdateDate',
        'available'                       => 'getAvailable',
        'shortcut1'                       => 'getShortcut1',
        'shortcut2'                       => 'getShortcut2',
        'org_code'                        => 'getOrgCode',
        'country_code'                    => 'getCountryCode',
        'long_name'                       => 'getLongName',
        'name_kana'                       => 'getNameKana',
        'default_title'                   => 'getDefaultTitle',
        'phone'                           => 'getPhone',
        'contact_name'                    => 'getContactName',
        'email'                           => 'getEmail',
        'payer_walletable_id'             => 'getPayerWalletableId',
        'transfer_fee_handling_side'      => 'getTransferFeeHandlingSide',
        'qualified_invoice_issuer'        => 'getQualifiedInvoiceIssuer',
        'invoice_registration_number'     => 'getInvoiceRegistrationNumber',
        'address_attributes'              => 'getAddressAttributes',
        'partner_doc_setting_attributes'  => 'getPartnerDocSettingAttributes',
        'partner_bank_account_attributes' => 'getPartnerBankAccountAttributes',
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

    const TRANSFER_FEE_HANDLING_SIDE_PAYER = 'payer';
    const TRANSFER_FEE_HANDLING_SIDE_PAYEE = 'payee';

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getTransferFeeHandlingSideAllowableValues()
    {
        return [
            self::TRANSFER_FEE_HANDLING_SIDE_PAYER,
            self::TRANSFER_FEE_HANDLING_SIDE_PAYEE,
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
        $this->container['id']                              = $data['id'] ?? null;
        $this->container['code']                            = $data['code'] ?? null;
        $this->container['company_id']                      = $data['company_id'] ?? null;
        $this->container['name']                            = $data['name'] ?? null;
        $this->container['update_date']                     = $data['update_date'] ?? null;
        $this->container['available']                       = $data['available'] ?? null;
        $this->container['shortcut1']                       = $data['shortcut1'] ?? null;
        $this->container['shortcut2']                       = $data['shortcut2'] ?? null;
        $this->container['org_code']                        = $data['org_code'] ?? null;
        $this->container['country_code']                    = $data['country_code'] ?? null;
        $this->container['long_name']                       = $data['long_name'] ?? null;
        $this->container['name_kana']                       = $data['name_kana'] ?? null;
        $this->container['default_title']                   = $data['default_title'] ?? null;
        $this->container['phone']                           = $data['phone'] ?? null;
        $this->container['contact_name']                    = $data['contact_name'] ?? null;
        $this->container['email']                           = $data['email'] ?? null;
        $this->container['payer_walletable_id']             = $data['payer_walletable_id'] ?? null;
        $this->container['transfer_fee_handling_side']      = $data['transfer_fee_handling_side'] ?? null;
        $this->container['qualified_invoice_issuer']        = $data['qualified_invoice_issuer'] ?? null;
        $this->container['invoice_registration_number']     = $data['invoice_registration_number'] ?? null;
        $this->container['address_attributes']              = $data['address_attributes'] ?? null;
        $this->container['partner_doc_setting_attributes']  = $data['partner_doc_setting_attributes'] ?? null;
        $this->container['partner_bank_account_attributes'] = $data['partner_bank_account_attributes'] ?? null;
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

        if ($this->container['code'] === null) {
            $invalidProperties[] = "'code' can't be null";
        }
        if ($this->container['company_id'] === null) {
            $invalidProperties[] = "'company_id' can't be null";
        }
        if (($this->container['company_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'company_id', must be bigger than or equal to 1.";
        }

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['update_date'] === null) {
            $invalidProperties[] = "'update_date' can't be null";
        }
        if ($this->container['available'] === null) {
            $invalidProperties[] = "'available' can't be null";
        }
        if (!is_null($this->container['shortcut1']) && (mb_strlen($this->container['shortcut1']) > 255)) {
            $invalidProperties[] = "invalid value for 'shortcut1', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['shortcut2']) && (mb_strlen($this->container['shortcut2']) > 255)) {
            $invalidProperties[] = "invalid value for 'shortcut2', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['org_code']) && ($this->container['org_code'] > 2)) {
            $invalidProperties[] = "invalid value for 'org_code', must be smaller than or equal to 2.";
        }

        if (!is_null($this->container['org_code']) && ($this->container['org_code'] < 1)) {
            $invalidProperties[] = "invalid value for 'org_code', must be bigger than or equal to 1.";
        }

        if (!is_null($this->container['long_name']) && (mb_strlen($this->container['long_name']) > 255)) {
            $invalidProperties[] = "invalid value for 'long_name', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['name_kana']) && (mb_strlen($this->container['name_kana']) > 255)) {
            $invalidProperties[] = "invalid value for 'name_kana', the character length must be smaller than or equal to 255.";
        }

        if (!is_null($this->container['payer_walletable_id']) && ($this->container['payer_walletable_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'payer_walletable_id', must be bigger than or equal to 1.";
        }

        $allowedValues = $this->getTransferFeeHandlingSideAllowableValues();
        if (!is_null($this->container['transfer_fee_handling_side']) && !in_array($this->container['transfer_fee_handling_side'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'transfer_fee_handling_side', must be one of '%s'",
                $this->container['transfer_fee_handling_side'],
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
     * @param int $id 取引先ID
     *
     * @return self
     */
    public function setId($id)
    {
        if (($id < 1)) {
            throw new \InvalidArgumentException('invalid value for $id when calling PartnersResponsePartners., must be bigger than or equal to 1.');
        }

        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->container['code'];
    }

    /**
     * Sets code.
     *
     * @param string $code 取引先コード
     *
     * @return self
     */
    public function setCode($code)
    {
        $this->container['code'] = $code;

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
            throw new \InvalidArgumentException('invalid value for $company_id when calling PartnersResponsePartners., must be bigger than or equal to 1.');
        }

        $this->container['company_id'] = $company_id;

        return $this;
    }

    /**
     * Gets name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name.
     *
     * @param string $name 取引先名
     *
     * @return self
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets update_date.
     *
     * @return string
     */
    public function getUpdateDate()
    {
        return $this->container['update_date'];
    }

    /**
     * Sets update_date.
     *
     * @param string $update_date 更新日 (yyyy-mm-dd)
     *
     * @return self
     */
    public function setUpdateDate($update_date)
    {
        $this->container['update_date'] = $update_date;

        return $this;
    }

    /**
     * Gets available.
     *
     * @return bool
     */
    public function getAvailable()
    {
        return $this->container['available'];
    }

    /**
     * Sets available.
     *
     * @param bool $available true: 使用可能、false: 使用停止 <br> <ul>   <li>     本APIでpartnerを作成した場合はtrueになります。   </li>   <li>     trueの場合、Web画面での取引登録時などに入力候補として表示されます。   </li>   <li>     falseの場合、取引先自体は削除せず、Web画面での取引登録時などに入力候補として表示されません。ただし取引（収入・支出）の作成APIなどでfalseの取引先をパラメータに指定すれば、取引などにfalseの取引先を設定できます。   </li> </ul>
     *
     * @return self
     */
    public function setAvailable($available)
    {
        $this->container['available'] = $available;

        return $this;
    }

    /**
     * Gets shortcut1.
     *
     * @return string|null
     */
    public function getShortcut1()
    {
        return $this->container['shortcut1'];
    }

    /**
     * Sets shortcut1.
     *
     * @param string|null $shortcut1 ショートカット1 (255文字以内)
     *
     * @return self
     */
    public function setShortcut1($shortcut1)
    {
        if (!is_null($shortcut1) && (mb_strlen($shortcut1) > 255)) {
            throw new \InvalidArgumentException('invalid length for $shortcut1 when calling PartnersResponsePartners., must be smaller than or equal to 255.');
        }

        $this->container['shortcut1'] = $shortcut1;

        return $this;
    }

    /**
     * Gets shortcut2.
     *
     * @return string|null
     */
    public function getShortcut2()
    {
        return $this->container['shortcut2'];
    }

    /**
     * Sets shortcut2.
     *
     * @param string|null $shortcut2 ショートカット2 (255文字以内)
     *
     * @return self
     */
    public function setShortcut2($shortcut2)
    {
        if (!is_null($shortcut2) && (mb_strlen($shortcut2) > 255)) {
            throw new \InvalidArgumentException('invalid length for $shortcut2 when calling PartnersResponsePartners., must be smaller than or equal to 255.');
        }

        $this->container['shortcut2'] = $shortcut2;

        return $this;
    }

    /**
     * Gets org_code.
     *
     * @return int|null
     */
    public function getOrgCode()
    {
        return $this->container['org_code'];
    }

    /**
     * Sets org_code.
     *
     * @param int|null $org_code 事業所種別（null: 未設定、1: 法人、2: 個人）
     *
     * @return self
     */
    public function setOrgCode($org_code)
    {
        if (!is_null($org_code) && ($org_code > 2)) {
            throw new \InvalidArgumentException('invalid value for $org_code when calling PartnersResponsePartners., must be smaller than or equal to 2.');
        }
        if (!is_null($org_code) && ($org_code < 1)) {
            throw new \InvalidArgumentException('invalid value for $org_code when calling PartnersResponsePartners., must be bigger than or equal to 1.');
        }

        $this->container['org_code'] = $org_code;

        return $this;
    }

    /**
     * Gets country_code.
     *
     * @return string|null
     */
    public function getCountryCode()
    {
        return $this->container['country_code'];
    }

    /**
     * Sets country_code.
     *
     * @param string|null $country_code 地域（JP: 国内、ZZ:国外）
     *
     * @return self
     */
    public function setCountryCode($country_code)
    {
        $this->container['country_code'] = $country_code;

        return $this;
    }

    /**
     * Gets long_name.
     *
     * @return string|null
     */
    public function getLongName()
    {
        return $this->container['long_name'];
    }

    /**
     * Sets long_name.
     *
     * @param string|null $long_name 正式名称（255文字以内）
     *
     * @return self
     */
    public function setLongName($long_name)
    {
        if (!is_null($long_name) && (mb_strlen($long_name) > 255)) {
            throw new \InvalidArgumentException('invalid length for $long_name when calling PartnersResponsePartners., must be smaller than or equal to 255.');
        }

        $this->container['long_name'] = $long_name;

        return $this;
    }

    /**
     * Gets name_kana.
     *
     * @return string|null
     */
    public function getNameKana()
    {
        return $this->container['name_kana'];
    }

    /**
     * Sets name_kana.
     *
     * @param string|null $name_kana カナ名称（255文字以内）
     *
     * @return self
     */
    public function setNameKana($name_kana)
    {
        if (!is_null($name_kana) && (mb_strlen($name_kana) > 255)) {
            throw new \InvalidArgumentException('invalid length for $name_kana when calling PartnersResponsePartners., must be smaller than or equal to 255.');
        }

        $this->container['name_kana'] = $name_kana;

        return $this;
    }

    /**
     * Gets default_title.
     *
     * @return string|null
     */
    public function getDefaultTitle()
    {
        return $this->container['default_title'];
    }

    /**
     * Sets default_title.
     *
     * @param string|null $default_title 敬称（御中、様、(空白)の3つから選択）
     *
     * @return self
     */
    public function setDefaultTitle($default_title)
    {
        $this->container['default_title'] = $default_title;

        return $this;
    }

    /**
     * Gets phone.
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->container['phone'];
    }

    /**
     * Sets phone.
     *
     * @param string|null $phone 電話番号
     *
     * @return self
     */
    public function setPhone($phone)
    {
        $this->container['phone'] = $phone;

        return $this;
    }

    /**
     * Gets contact_name.
     *
     * @return string|null
     */
    public function getContactName()
    {
        return $this->container['contact_name'];
    }

    /**
     * Sets contact_name.
     *
     * @param string|null $contact_name 担当者 氏名
     *
     * @return self
     */
    public function setContactName($contact_name)
    {
        $this->container['contact_name'] = $contact_name;

        return $this;
    }

    /**
     * Gets email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email.
     *
     * @param string|null $email 担当者 メールアドレス
     *
     * @return self
     */
    public function setEmail($email)
    {
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets payer_walletable_id.
     *
     * @return int|null
     */
    public function getPayerWalletableId()
    {
        return $this->container['payer_walletable_id'];
    }

    /**
     * Sets payer_walletable_id.
     *
     * @param int|null $payer_walletable_id 振込元口座ID（一括振込ファイル用）:（未設定の場合は、nullです。）
     *
     * @return self
     */
    public function setPayerWalletableId($payer_walletable_id)
    {
        if (!is_null($payer_walletable_id) && ($payer_walletable_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $payer_walletable_id when calling PartnersResponsePartners., must be bigger than or equal to 1.');
        }

        $this->container['payer_walletable_id'] = $payer_walletable_id;

        return $this;
    }

    /**
     * Gets transfer_fee_handling_side.
     *
     * @return string|null
     */
    public function getTransferFeeHandlingSide()
    {
        return $this->container['transfer_fee_handling_side'];
    }

    /**
     * Sets transfer_fee_handling_side.
     *
     * @param string|null $transfer_fee_handling_side 振込手数料負担（一括振込ファイル用）: (振込元(当方): payer, 振込先(先方): payee)
     *
     * @return self
     */
    public function setTransferFeeHandlingSide($transfer_fee_handling_side)
    {
        $allowedValues = $this->getTransferFeeHandlingSideAllowableValues();
        if (!is_null($transfer_fee_handling_side) && !in_array($transfer_fee_handling_side, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'transfer_fee_handling_side', must be one of '%s'",
                    $transfer_fee_handling_side,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['transfer_fee_handling_side'] = $transfer_fee_handling_side;

        return $this;
    }

    /**
     * Gets qualified_invoice_issuer.
     *
     * @return bool|null
     */
    public function getQualifiedInvoiceIssuer()
    {
        return $this->container['qualified_invoice_issuer'];
    }

    /**
     * Sets qualified_invoice_issuer.
     *
     * @param bool|null $qualified_invoice_issuer インボイス制度適格請求書発行事業者（true: 対象事業者、false: 非対象事業者） <a target=\"_blank\" href=\"https://www.invoice-kohyo.nta.go.jp/index.html\">国税庁インボイス制度適格請求書発行事業者公表サイト</a>
     *
     * @return self
     */
    public function setQualifiedInvoiceIssuer($qualified_invoice_issuer)
    {
        $this->container['qualified_invoice_issuer'] = $qualified_invoice_issuer;

        return $this;
    }

    /**
     * Gets invoice_registration_number.
     *
     * @return string|null
     */
    public function getInvoiceRegistrationNumber()
    {
        return $this->container['invoice_registration_number'];
    }

    /**
     * Sets invoice_registration_number.
     *
     * @param string|null $invoice_registration_number インボイス制度適格請求書発行事業者登録番号 - 先頭T数字13桁の固定14桁の文字列 <a target=\"_blank\" href=\"https://www.invoice-kohyo.nta.go.jp/index.html\">国税庁インボイス制度適格請求書発行事業者公表サイト</a>
     *
     * @return self
     */
    public function setInvoiceRegistrationNumber($invoice_registration_number)
    {
        $this->container['invoice_registration_number'] = $invoice_registration_number;

        return $this;
    }

    /**
     * Gets address_attributes.
     *
     * @return \OpenAPI\Client\Model\PartnersResponseAddressAttributes|null
     */
    public function getAddressAttributes()
    {
        return $this->container['address_attributes'];
    }

    /**
     * Sets address_attributes.
     *
     * @param \OpenAPI\Client\Model\PartnersResponseAddressAttributes|null $address_attributes address_attributes
     *
     * @return self
     */
    public function setAddressAttributes($address_attributes)
    {
        $this->container['address_attributes'] = $address_attributes;

        return $this;
    }

    /**
     * Gets partner_doc_setting_attributes.
     *
     * @return \OpenAPI\Client\Model\PartnerCreateParamsPartnerDocSettingAttributes|null
     */
    public function getPartnerDocSettingAttributes()
    {
        return $this->container['partner_doc_setting_attributes'];
    }

    /**
     * Sets partner_doc_setting_attributes.
     *
     * @param \OpenAPI\Client\Model\PartnerCreateParamsPartnerDocSettingAttributes|null $partner_doc_setting_attributes partner_doc_setting_attributes
     *
     * @return self
     */
    public function setPartnerDocSettingAttributes($partner_doc_setting_attributes)
    {
        $this->container['partner_doc_setting_attributes'] = $partner_doc_setting_attributes;

        return $this;
    }

    /**
     * Gets partner_bank_account_attributes.
     *
     * @return \OpenAPI\Client\Model\PartnersResponsePartnerBankAccountAttributes|null
     */
    public function getPartnerBankAccountAttributes()
    {
        return $this->container['partner_bank_account_attributes'];
    }

    /**
     * Sets partner_bank_account_attributes.
     *
     * @param \OpenAPI\Client\Model\PartnersResponsePartnerBankAccountAttributes|null $partner_bank_account_attributes partner_bank_account_attributes
     *
     * @return self
     */
    public function setPartnerBankAccountAttributes($partner_bank_account_attributes)
    {
        $this->container['partner_bank_account_attributes'] = $partner_bank_account_attributes;

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