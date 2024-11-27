<?php

/**
 * CompanyResponseCompany.
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
 * CompanyResponseCompany Class Doc Comment.
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
class CompanyResponseCompany implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'companyResponse_company';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'id'                        => 'int',
        'name'                      => 'string',
        'name_kana'                 => 'string',
        'display_name'              => 'string',
        'tax_at_source_calc_type'   => 'int',
        'contact_name'              => 'string',
        'head_count'                => 'int',
        'corporate_number'          => 'string',
        'txn_number_format'         => 'string',
        'default_wallet_account_id' => 'int',
        'private_settlement'        => 'bool',
        'minus_format'              => 'int',
        'org_code'                  => 'int',
        'company_number'            => 'string',
        'role'                      => 'string',
        'phone1'                    => 'string',
        'phone2'                    => 'string',
        'fax'                       => 'string',
        'zipcode'                   => 'string',
        'prefecture_code'           => 'int',
        'street_name1'              => 'string',
        'street_name2'              => 'string',
        'invoice_layout'            => 'string',
        'amount_fraction'           => 'int',
        'use_partner_code'          => 'bool',
        'industry_class'            => 'string',
        'industry_code'             => 'string',
        'workflow_setting'          => 'string',
        'fiscal_years'              => '\OpenAPI\Client\Model\FiscalYears[]',
        'account_items'             => '\OpenAPI\Client\Model\CompanyResponseCompanyAccountItems[]',
        'tax_codes'                 => '\OpenAPI\Client\Model\CompanyResponseCompanyTaxCodes[]',
        'items'                     => '\OpenAPI\Client\Model\CompanyResponseCompanyItems[]',
        'partners'                  => '\OpenAPI\Client\Model\CompanyResponseCompanyPartners[]',
        'sections'                  => '\OpenAPI\Client\Model\CompanyResponseCompanySections[]',
        'tags'                      => '\OpenAPI\Client\Model\CompanyResponseCompanyTags[]',
        'walletables'               => '\OpenAPI\Client\Model\CompanyResponseCompanyWalletables[]',
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
        'id'                        => 'int64',
        'name'                      => null,
        'name_kana'                 => null,
        'display_name'              => null,
        'tax_at_source_calc_type'   => 'int64',
        'contact_name'              => null,
        'head_count'                => 'int64',
        'corporate_number'          => null,
        'txn_number_format'         => null,
        'default_wallet_account_id' => 'int64',
        'private_settlement'        => null,
        'minus_format'              => 'int64',
        'org_code'                  => null,
        'company_number'            => null,
        'role'                      => null,
        'phone1'                    => null,
        'phone2'                    => null,
        'fax'                       => null,
        'zipcode'                   => null,
        'prefecture_code'           => 'int64',
        'street_name1'              => null,
        'street_name2'              => null,
        'invoice_layout'            => null,
        'amount_fraction'           => 'int64',
        'use_partner_code'          => null,
        'industry_class'            => null,
        'industry_code'             => null,
        'workflow_setting'          => null,
        'fiscal_years'              => null,
        'account_items'             => null,
        'tax_codes'                 => null,
        'items'                     => null,
        'partners'                  => null,
        'sections'                  => null,
        'tags'                      => null,
        'walletables'               => null,
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
        'id'                        => 'id',
        'name'                      => 'name',
        'name_kana'                 => 'name_kana',
        'display_name'              => 'display_name',
        'tax_at_source_calc_type'   => 'tax_at_source_calc_type',
        'contact_name'              => 'contact_name',
        'head_count'                => 'head_count',
        'corporate_number'          => 'corporate_number',
        'txn_number_format'         => 'txn_number_format',
        'default_wallet_account_id' => 'default_wallet_account_id',
        'private_settlement'        => 'private_settlement',
        'minus_format'              => 'minus_format',
        'org_code'                  => 'org_code',
        'company_number'            => 'company_number',
        'role'                      => 'role',
        'phone1'                    => 'phone1',
        'phone2'                    => 'phone2',
        'fax'                       => 'fax',
        'zipcode'                   => 'zipcode',
        'prefecture_code'           => 'prefecture_code',
        'street_name1'              => 'street_name1',
        'street_name2'              => 'street_name2',
        'invoice_layout'            => 'invoice_layout',
        'amount_fraction'           => 'amount_fraction',
        'use_partner_code'          => 'use_partner_code',
        'industry_class'            => 'industry_class',
        'industry_code'             => 'industry_code',
        'workflow_setting'          => 'workflow_setting',
        'fiscal_years'              => 'fiscal_years',
        'account_items'             => 'account_items',
        'tax_codes'                 => 'tax_codes',
        'items'                     => 'items',
        'partners'                  => 'partners',
        'sections'                  => 'sections',
        'tags'                      => 'tags',
        'walletables'               => 'walletables',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'id'                        => 'setId',
        'name'                      => 'setName',
        'name_kana'                 => 'setNameKana',
        'display_name'              => 'setDisplayName',
        'tax_at_source_calc_type'   => 'setTaxAtSourceCalcType',
        'contact_name'              => 'setContactName',
        'head_count'                => 'setHeadCount',
        'corporate_number'          => 'setCorporateNumber',
        'txn_number_format'         => 'setTxnNumberFormat',
        'default_wallet_account_id' => 'setDefaultWalletAccountId',
        'private_settlement'        => 'setPrivateSettlement',
        'minus_format'              => 'setMinusFormat',
        'org_code'                  => 'setOrgCode',
        'company_number'            => 'setCompanyNumber',
        'role'                      => 'setRole',
        'phone1'                    => 'setPhone1',
        'phone2'                    => 'setPhone2',
        'fax'                       => 'setFax',
        'zipcode'                   => 'setZipcode',
        'prefecture_code'           => 'setPrefectureCode',
        'street_name1'              => 'setStreetName1',
        'street_name2'              => 'setStreetName2',
        'invoice_layout'            => 'setInvoiceLayout',
        'amount_fraction'           => 'setAmountFraction',
        'use_partner_code'          => 'setUsePartnerCode',
        'industry_class'            => 'setIndustryClass',
        'industry_code'             => 'setIndustryCode',
        'workflow_setting'          => 'setWorkflowSetting',
        'fiscal_years'              => 'setFiscalYears',
        'account_items'             => 'setAccountItems',
        'tax_codes'                 => 'setTaxCodes',
        'items'                     => 'setItems',
        'partners'                  => 'setPartners',
        'sections'                  => 'setSections',
        'tags'                      => 'setTags',
        'walletables'               => 'setWalletables',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'id'                        => 'getId',
        'name'                      => 'getName',
        'name_kana'                 => 'getNameKana',
        'display_name'              => 'getDisplayName',
        'tax_at_source_calc_type'   => 'getTaxAtSourceCalcType',
        'contact_name'              => 'getContactName',
        'head_count'                => 'getHeadCount',
        'corporate_number'          => 'getCorporateNumber',
        'txn_number_format'         => 'getTxnNumberFormat',
        'default_wallet_account_id' => 'getDefaultWalletAccountId',
        'private_settlement'        => 'getPrivateSettlement',
        'minus_format'              => 'getMinusFormat',
        'org_code'                  => 'getOrgCode',
        'company_number'            => 'getCompanyNumber',
        'role'                      => 'getRole',
        'phone1'                    => 'getPhone1',
        'phone2'                    => 'getPhone2',
        'fax'                       => 'getFax',
        'zipcode'                   => 'getZipcode',
        'prefecture_code'           => 'getPrefectureCode',
        'street_name1'              => 'getStreetName1',
        'street_name2'              => 'getStreetName2',
        'invoice_layout'            => 'getInvoiceLayout',
        'amount_fraction'           => 'getAmountFraction',
        'use_partner_code'          => 'getUsePartnerCode',
        'industry_class'            => 'getIndustryClass',
        'industry_code'             => 'getIndustryCode',
        'workflow_setting'          => 'getWorkflowSetting',
        'fiscal_years'              => 'getFiscalYears',
        'account_items'             => 'getAccountItems',
        'tax_codes'                 => 'getTaxCodes',
        'items'                     => 'getItems',
        'partners'                  => 'getPartners',
        'sections'                  => 'getSections',
        'tags'                      => 'getTags',
        'walletables'               => 'getWalletables',
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

    const TXN_NUMBER_FORMAT_NOT_USED                                = 'not_used';
    const TXN_NUMBER_FORMAT_DIGITS                                  = 'digits';
    const TXN_NUMBER_FORMAT_ALNUM                                   = 'alnum';
    const ROLE_ADMIN                                                = 'admin';
    const ROLE_SIMPLE_ACCOUNTING                                    = 'simple_accounting';
    const ROLE_SELF_ONLY                                            = 'self_only';
    const ROLE_READ_ONLY                                            = 'read_only';
    const ROLE_WORKFLOW                                             = 'workflow';
    const INVOICE_LAYOUT_DEFAULT_CLASSIC                            = 'default_classic';
    const INVOICE_LAYOUT_STANDARD_CLASSIC                           = 'standard_classic';
    const INVOICE_LAYOUT_ENVELOPE_CLASSIC                           = 'envelope_classic';
    const INVOICE_LAYOUT_CARRIED_FORWARD_STANDARD_CLASSIC           = 'carried_forward_standard_classic';
    const INVOICE_LAYOUT_CARRIED_FORWARD_ENVELOPE_CLASSIC           = 'carried_forward_envelope_classic';
    const INVOICE_LAYOUT_DEFAULT_MODERN                             = 'default_modern';
    const INVOICE_LAYOUT_STANDARD_MODERN                            = 'standard_modern';
    const INVOICE_LAYOUT_ENVELOPE_MODERN                            = 'envelope_modern';
    const INDUSTRY_CLASS_AGRICULTURE_FORESTRY_FISHERIES_ORE         = 'agriculture_forestry_fisheries_ore';
    const INDUSTRY_CLASS_CONSTRUCTION                               = 'construction';
    const INDUSTRY_CLASS_MANUFACTURING_PROCESSING                   = 'manufacturing_processing';
    const INDUSTRY_CLASS_IT                                         = 'it';
    const INDUSTRY_CLASS_TRANSPORTATION_LOGISTICS                   = 'transportation_logistics';
    const INDUSTRY_CLASS_RETAIL_WHOLESALE                           = 'retail_wholesale';
    const INDUSTRY_CLASS_FINANCE_INSURANCE                          = 'finance_insurance';
    const INDUSTRY_CLASS_REAL_ESTATE_RENTAL                         = 'real_estate_rental';
    const INDUSTRY_CLASS_PROFESSION                                 = 'profession';
    const INDUSTRY_CLASS_DESIGN_PRODUCTION                          = 'design_production';
    const INDUSTRY_CLASS_FOOD                                       = 'food';
    const INDUSTRY_CLASS_LEISURE_ENTERTAINMENT                      = 'leisure_entertainment';
    const INDUSTRY_CLASS_LIFESTYLE                                  = 'lifestyle';
    const INDUSTRY_CLASS_EDUCATION                                  = 'education';
    const INDUSTRY_CLASS_MEDICAL_WELFARE                            = 'medical_welfare';
    const INDUSTRY_CLASS_OTHER_SERVICES                             = 'other_services';
    const INDUSTRY_CLASS_OTHER_ASSOCIATION                          = 'other_association';
    const INDUSTRY_CLASS_OTHER                                      = 'other';
    const INDUSTRY_CLASS_EMPTY                                      = '';
    const INDUSTRY_CODE_EMPTY                                       = '';
    const INDUSTRY_CODE_AGRICULTURE                                 = 'agriculture';
    const INDUSTRY_CODE_FORESTRY                                    = 'forestry';
    const INDUSTRY_CODE_FISHING_INDUSTRY                            = 'fishing_industry';
    const INDUSTRY_CODE_MINING                                      = 'mining';
    const INDUSTRY_CODE_CIVIL_CONTRACTORS                           = 'civil_contractors';
    const INDUSTRY_CODE_PAVEMENT                                    = 'pavement';
    const INDUSTRY_CODE_CARPENTER                                   = 'carpenter';
    const INDUSTRY_CODE_RENOVATION                                  = 'renovation';
    const INDUSTRY_CODE_ELECTRICAL_PLUMBING                         = 'electrical_plumbing';
    const INDUSTRY_CODE_GROCERY                                     = 'grocery';
    const INDUSTRY_CODE_MACHINERY_MANUFACTURING                     = 'machinery_manufacturing';
    const INDUSTRY_CODE_PRINTING                                    = 'printing';
    const INDUSTRY_CODE_OTHER_MANUFACTURING                         = 'other_manufacturing';
    const INDUSTRY_CODE_SOFTWARE_DEVELOPMENT                        = 'software_development';
    const INDUSTRY_CODE_SYSTEM_DEVELOPMENT                          = 'system_development';
    const INDUSTRY_CODE_SURVEY_ANALYSIS                             = 'survey_analysis';
    const INDUSTRY_CODE_SERVER_MANAGEMENT                           = 'server_management';
    const INDUSTRY_CODE_WEBSITE_PRODUCTION                          = 'website_production';
    const INDUSTRY_CODE_ONLINE_SERVICE_MANAGEMENT                   = 'online_service_management';
    const INDUSTRY_CODE_ONLINE_ADVERTISING_AGENCY                   = 'online_advertising_agency';
    const INDUSTRY_CODE_ONLINE_ADVERTISING_PLANNING_PRODUCTION      = 'online_advertising_planning_production';
    const INDUSTRY_CODE_ONLINE_MEDIA_MANAGEMENT                     = 'online_media_management';
    const INDUSTRY_CODE_PORTAL_SITE_MANAGEMENT                      = 'portal_site_management';
    const INDUSTRY_CODE_OTHER_IT_SERVICES                           = 'other_it_services';
    const INDUSTRY_CODE_TRANSPORT_DELIVERY                          = 'transport_delivery';
    const INDUSTRY_CODE_DELIVERY                                    = 'delivery';
    const INDUSTRY_CODE_OTHER_TRANSPORTATION_LOGISTICS              = 'other_transportation_logistics';
    const INDUSTRY_CODE_OTHER_WHOLESALE                             = 'other_wholesale';
    const INDUSTRY_CODE_CLOTHING_WHOLESALE_FIBER                    = 'clothing_wholesale_fiber';
    const INDUSTRY_CODE_FOOD_WHOLESALE                              = 'food_wholesale';
    const INDUSTRY_CODE_ENTRUSTED_DEVELOPMENT_WHOLESALE             = 'entrusted_development_wholesale';
    const INDUSTRY_CODE_ONLINE_SHOP                                 = 'online_shop';
    const INDUSTRY_CODE_FASHION_GROCERY_STORE                       = 'fashion_grocery_store';
    const INDUSTRY_CODE_FOOD_STORE                                  = 'food_store';
    const INDUSTRY_CODE_ENTRUSTED_STORE                             = 'entrusted_store';
    const INDUSTRY_CODE_OTHER_STORE                                 = 'other_store';
    const INDUSTRY_CODE_FINANCIAL_INSTRUMENTS_EXCHANGE              = 'financial_instruments_exchange';
    const INDUSTRY_CODE_COMMODITY_FUTURES_INVESTMENT_ADVISOR        = 'commodity_futures_investment_advisor';
    const INDUSTRY_CODE_OTHER_FINANCIAL                             = 'other_financial';
    const INDUSTRY_CODE_BROKERAGE_INSURANCE                         = 'brokerage_insurance';
    const INDUSTRY_CODE_OTHER_INSURANCE                             = 'other_insurance';
    const INDUSTRY_CODE_REAL_ESTATE_DEVELOPER                       = 'real_estate_developer';
    const INDUSTRY_CODE_REAL_ESTATE_BROKERAGE                       = 'real_estate_brokerage';
    const INDUSTRY_CODE_RENT_COIN_PARKING_MANAGEMENT                = 'rent_coin_parking_management';
    const INDUSTRY_CODE_RENTAL_OFFICE_CO_WORKING_SPACE              = 'rental_office_co_working_space';
    const INDUSTRY_CODE_RENTAL_LEASE                                = 'rental_lease';
    const INDUSTRY_CODE_CPA_TAX_ACCOUNTANT                          = 'cpa_tax_accountant';
    const INDUSTRY_CODE_LAW_OFFICE                                  = 'law_office';
    const INDUSTRY_CODE_JUDICIAL_AND_ADMINISTRATIVE_SCRIVENER       = 'judicial_and_administrative_scrivener';
    const INDUSTRY_CODE_LABOR_CONSULTANT                            = 'labor_consultant';
    const INDUSTRY_CODE_OTHER_PROFESSION                            = 'other_profession';
    const INDUSTRY_CODE_BUSINESS_CONSULTANT                         = 'business_consultant';
    const INDUSTRY_CODE_ACADEMIC_RESEARCH_DEVELOPMENT               = 'academic_research_development';
    const INDUSTRY_CODE_ADVERTISING_AGENCY                          = 'advertising_agency';
    const INDUSTRY_CODE_ADVERTISING_PLANNING_PRODUCTION             = 'advertising_planning_production';
    const INDUSTRY_CODE_DESIGN_DEVELOPMENT                          = 'design_development';
    const INDUSTRY_CODE_APPAREL_INDUSTRY_DESIGN                     = 'apparel_industry_design';
    const INDUSTRY_CODE_WEBSITE_DESIGN                              = 'website_design';
    const INDUSTRY_CODE_ADVERTISING_PLANNING_DESIGN                 = 'advertising_planning_design';
    const INDUSTRY_CODE_OTHER_DESIGN                                = 'other_design';
    const INDUSTRY_CODE_RESTAURANTS_COFFEE_SHOPS                    = 'restaurants_coffee_shops';
    const INDUSTRY_CODE_SALE_OF_LUNCH                               = 'sale_of_lunch';
    const INDUSTRY_CODE_BREAD_CONFECTIONERY_MANUFACTURE_SALE        = 'bread_confectionery_manufacture_sale';
    const INDUSTRY_CODE_DELIVERY_CATERING_MOBILE_CATERING           = 'delivery_catering_mobile_catering';
    const INDUSTRY_CODE_HOTEL_INN                                   = 'hotel_inn';
    const INDUSTRY_CODE_HOMESTAY                                    = 'homestay';
    const INDUSTRY_CODE_TRAVEL_AGENCY                               = 'travel_agency';
    const INDUSTRY_CODE_LEISURE_SPORTS_FACILITY_MANAGEMENT          = 'leisure_sports_facility_management';
    const INDUSTRY_CODE_SHOW_EVENT_MANAGEMENT                       = 'show_event_management';
    const INDUSTRY_CODE_BARBER                                      = 'barber';
    const INDUSTRY_CODE_BEAUTY_SALON                                = 'beauty_salon';
    const INDUSTRY_CODE_SPA_SAND_BATH_SAUNA                         = 'spa_sand_bath_sauna';
    const INDUSTRY_CODE_ESTE_AIL_SALON                              = 'este_ail_salon';
    const INDUSTRY_CODE_BRIDAL_PLANNING_INTRODUCE_WEDDING           = 'bridal_planning_introduce_wedding';
    const INDUSTRY_CODE_MEMORIAL_CEREMONY_FUNERAL                   = 'memorial_ceremony_funeral';
    const INDUSTRY_CODE_MOVING                                      = 'moving';
    const INDUSTRY_CODE_COURIER_INDUSTRY                            = 'courier_industry';
    const INDUSTRY_CODE_HOUSE_MAID_CLEANING_AGENCY                  = 'house_maid_cleaning_agency';
    const INDUSTRY_CODE_RE_TAILORING_CLOTHES                        = 're_tailoring_clothes';
    const INDUSTRY_CODE_TRAINING_INSTITUTE_MANAGEMENT               = 'training_institute_management';
    const INDUSTRY_CODE_TUTORING_SCHOOL                             = 'tutoring_school';
    const INDUSTRY_CODE_MUSIC_CALLIGRAPHY_ABACUS_CLASSROOM          = 'music_calligraphy_abacus_classroom';
    const INDUSTRY_CODE_ENGLISH_SCHOOL                              = 'english_school';
    const INDUSTRY_CODE_TENNIS_YOGA_JUDO_SCHOOL                     = 'tennis_yoga_judo_school';
    const INDUSTRY_CODE_CULTURE_SCHOOL                              = 'culture_school';
    const INDUSTRY_CODE_SEMINAR_PLANNING_MANAGEMENT                 = 'seminar_planning_management';
    const INDUSTRY_CODE_HOSPITAL_CLINIC                             = 'hospital_clinic';
    const INDUSTRY_CODE_DENTAL_CLINIC                               = 'dental_clinic';
    const INDUSTRY_CODE_OTHER_MEDICAL_SERVICES                      = 'other_medical_services';
    const INDUSTRY_CODE_NURSERY                                     = 'nursery';
    const INDUSTRY_CODE_NURSING_HOME                                = 'nursing_home';
    const INDUSTRY_CODE_REHABILITATION_SUPPORT_SERVICES             = 'rehabilitation_support_services';
    const INDUSTRY_CODE_OTHER_WELFARE                               = 'other_welfare';
    const INDUSTRY_CODE_VISIT_WELFARE_SERVICE                       = 'visit_welfare_service';
    const INDUSTRY_CODE_RECRUITMENT_TEMPORARY_STAFFING              = 'recruitment_temporary_staffing';
    const INDUSTRY_CODE_LIFE_RELATED_RECRUITMENT_TEMPORARY_STAFFING = 'life_related_recruitment_temporary_staffing';
    const INDUSTRY_CODE_CAR_MAINTENANCE_CAR_REPAIR                  = 'car_maintenance_car_repair';
    const INDUSTRY_CODE_MACHINERY_EQUIPMENT_MAINTENANCE_REPAIR      = 'machinery_equipment_maintenance_repair';
    const INDUSTRY_CODE_CLEANING_MAINTENANCE_BUILDING_MANAGEMENT    = 'cleaning_maintenance_building_management';
    const INDUSTRY_CODE_SECURITY                                    = 'security';
    const INDUSTRY_CODE_OTHER_SERVICES                              = 'other_services';
    const INDUSTRY_CODE_NPO                                         = 'npo';
    const INDUSTRY_CODE_GENERAL_INCORPORATED_ASSOCIATION            = 'general_incorporated_association';
    const INDUSTRY_CODE_GENERAL_INCORPORATED_FOUNDATION             = 'general_incorporated_foundation';
    const INDUSTRY_CODE_OTHER_ASSOCIATION                           = 'other_association';
    const INDUSTRY_CODE_MANUFACTURING                               = 'manufacturing';
    const INDUSTRY_CODE_EDUCATION                                   = 'education';
    const INDUSTRY_CODE_MEDICAL                                     = 'medical';
    const INDUSTRY_CODE_ICT                                         = 'ict';
    const INDUSTRY_CODE_FOOD                                        = 'food';
    const INDUSTRY_CODE_CONSTRUCTION                                = 'construction';
    const INDUSTRY_CODE_TRANSPORTATION                              = 'transportation';
    const INDUSTRY_CODE_TRADING                                     = 'trading';
    const INDUSTRY_CODE_RETAIL                                      = 'retail';
    const INDUSTRY_CODE_FINANCE                                     = 'finance';
    const INDUSTRY_CODE_REAL_ESTATE                                 = 'real_estate';
    const INDUSTRY_CODE_TRAVEL                                      = 'travel';
    const INDUSTRY_CODE_ACCOUNTANT                                  = 'accountant';
    const INDUSTRY_CODE_LAWER                                       = 'lawer';
    const INDUSTRY_CODE_CONSULTANT                                  = 'consultant';
    const INDUSTRY_CODE_RECRUIT                                     = 'recruit';
    const INDUSTRY_CODE_PUBLICATION                                 = 'publication';
    const INDUSTRY_CODE_DESIGN                                      = 'design';
    const INDUSTRY_CODE_OTHERS                                      = 'others';
    const INDUSTRY_CODE_COMPANY_EMPLOYEE                            = 'company_employee';
    const INDUSTRY_CODE_OTHERS_SIDE_BUSINESS                        = 'others_side_business';
    const INDUSTRY_CODE_OTHERS_DEDUCTION                            = 'others_deduction';
    const INDUSTRY_CODE__DEFAULT                                    = 'default';
    const WORKFLOW_SETTING_ENABLE                                   = 'enable';
    const WORKFLOW_SETTING_DISABLE                                  = 'disable';

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getTxnNumberFormatAllowableValues()
    {
        return [
            self::TXN_NUMBER_FORMAT_NOT_USED,
            self::TXN_NUMBER_FORMAT_DIGITS,
            self::TXN_NUMBER_FORMAT_ALNUM,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getRoleAllowableValues()
    {
        return [
            self::ROLE_ADMIN,
            self::ROLE_SIMPLE_ACCOUNTING,
            self::ROLE_SELF_ONLY,
            self::ROLE_READ_ONLY,
            self::ROLE_WORKFLOW,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getInvoiceLayoutAllowableValues()
    {
        return [
            self::INVOICE_LAYOUT_DEFAULT_CLASSIC,
            self::INVOICE_LAYOUT_STANDARD_CLASSIC,
            self::INVOICE_LAYOUT_ENVELOPE_CLASSIC,
            self::INVOICE_LAYOUT_CARRIED_FORWARD_STANDARD_CLASSIC,
            self::INVOICE_LAYOUT_CARRIED_FORWARD_ENVELOPE_CLASSIC,
            self::INVOICE_LAYOUT_DEFAULT_MODERN,
            self::INVOICE_LAYOUT_STANDARD_MODERN,
            self::INVOICE_LAYOUT_ENVELOPE_MODERN,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getIndustryClassAllowableValues()
    {
        return [
            self::INDUSTRY_CLASS_AGRICULTURE_FORESTRY_FISHERIES_ORE,
            self::INDUSTRY_CLASS_CONSTRUCTION,
            self::INDUSTRY_CLASS_MANUFACTURING_PROCESSING,
            self::INDUSTRY_CLASS_IT,
            self::INDUSTRY_CLASS_TRANSPORTATION_LOGISTICS,
            self::INDUSTRY_CLASS_RETAIL_WHOLESALE,
            self::INDUSTRY_CLASS_FINANCE_INSURANCE,
            self::INDUSTRY_CLASS_REAL_ESTATE_RENTAL,
            self::INDUSTRY_CLASS_PROFESSION,
            self::INDUSTRY_CLASS_DESIGN_PRODUCTION,
            self::INDUSTRY_CLASS_FOOD,
            self::INDUSTRY_CLASS_LEISURE_ENTERTAINMENT,
            self::INDUSTRY_CLASS_LIFESTYLE,
            self::INDUSTRY_CLASS_EDUCATION,
            self::INDUSTRY_CLASS_MEDICAL_WELFARE,
            self::INDUSTRY_CLASS_OTHER_SERVICES,
            self::INDUSTRY_CLASS_OTHER_ASSOCIATION,
            self::INDUSTRY_CLASS_OTHER,
            self::INDUSTRY_CLASS_EMPTY,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getIndustryCodeAllowableValues()
    {
        return [
            self::INDUSTRY_CODE_EMPTY,
            self::INDUSTRY_CODE_AGRICULTURE,
            self::INDUSTRY_CODE_FORESTRY,
            self::INDUSTRY_CODE_FISHING_INDUSTRY,
            self::INDUSTRY_CODE_MINING,
            self::INDUSTRY_CODE_CIVIL_CONTRACTORS,
            self::INDUSTRY_CODE_PAVEMENT,
            self::INDUSTRY_CODE_CARPENTER,
            self::INDUSTRY_CODE_RENOVATION,
            self::INDUSTRY_CODE_ELECTRICAL_PLUMBING,
            self::INDUSTRY_CODE_GROCERY,
            self::INDUSTRY_CODE_MACHINERY_MANUFACTURING,
            self::INDUSTRY_CODE_PRINTING,
            self::INDUSTRY_CODE_OTHER_MANUFACTURING,
            self::INDUSTRY_CODE_SOFTWARE_DEVELOPMENT,
            self::INDUSTRY_CODE_SYSTEM_DEVELOPMENT,
            self::INDUSTRY_CODE_SURVEY_ANALYSIS,
            self::INDUSTRY_CODE_SERVER_MANAGEMENT,
            self::INDUSTRY_CODE_WEBSITE_PRODUCTION,
            self::INDUSTRY_CODE_ONLINE_SERVICE_MANAGEMENT,
            self::INDUSTRY_CODE_ONLINE_ADVERTISING_AGENCY,
            self::INDUSTRY_CODE_ONLINE_ADVERTISING_PLANNING_PRODUCTION,
            self::INDUSTRY_CODE_ONLINE_MEDIA_MANAGEMENT,
            self::INDUSTRY_CODE_PORTAL_SITE_MANAGEMENT,
            self::INDUSTRY_CODE_OTHER_IT_SERVICES,
            self::INDUSTRY_CODE_TRANSPORT_DELIVERY,
            self::INDUSTRY_CODE_DELIVERY,
            self::INDUSTRY_CODE_OTHER_TRANSPORTATION_LOGISTICS,
            self::INDUSTRY_CODE_OTHER_WHOLESALE,
            self::INDUSTRY_CODE_CLOTHING_WHOLESALE_FIBER,
            self::INDUSTRY_CODE_FOOD_WHOLESALE,
            self::INDUSTRY_CODE_ENTRUSTED_DEVELOPMENT_WHOLESALE,
            self::INDUSTRY_CODE_ONLINE_SHOP,
            self::INDUSTRY_CODE_FASHION_GROCERY_STORE,
            self::INDUSTRY_CODE_FOOD_STORE,
            self::INDUSTRY_CODE_ENTRUSTED_STORE,
            self::INDUSTRY_CODE_OTHER_STORE,
            self::INDUSTRY_CODE_FINANCIAL_INSTRUMENTS_EXCHANGE,
            self::INDUSTRY_CODE_COMMODITY_FUTURES_INVESTMENT_ADVISOR,
            self::INDUSTRY_CODE_OTHER_FINANCIAL,
            self::INDUSTRY_CODE_BROKERAGE_INSURANCE,
            self::INDUSTRY_CODE_OTHER_INSURANCE,
            self::INDUSTRY_CODE_REAL_ESTATE_DEVELOPER,
            self::INDUSTRY_CODE_REAL_ESTATE_BROKERAGE,
            self::INDUSTRY_CODE_RENT_COIN_PARKING_MANAGEMENT,
            self::INDUSTRY_CODE_RENTAL_OFFICE_CO_WORKING_SPACE,
            self::INDUSTRY_CODE_RENTAL_LEASE,
            self::INDUSTRY_CODE_CPA_TAX_ACCOUNTANT,
            self::INDUSTRY_CODE_LAW_OFFICE,
            self::INDUSTRY_CODE_JUDICIAL_AND_ADMINISTRATIVE_SCRIVENER,
            self::INDUSTRY_CODE_LABOR_CONSULTANT,
            self::INDUSTRY_CODE_OTHER_PROFESSION,
            self::INDUSTRY_CODE_BUSINESS_CONSULTANT,
            self::INDUSTRY_CODE_ACADEMIC_RESEARCH_DEVELOPMENT,
            self::INDUSTRY_CODE_ADVERTISING_AGENCY,
            self::INDUSTRY_CODE_ADVERTISING_PLANNING_PRODUCTION,
            self::INDUSTRY_CODE_DESIGN_DEVELOPMENT,
            self::INDUSTRY_CODE_APPAREL_INDUSTRY_DESIGN,
            self::INDUSTRY_CODE_WEBSITE_DESIGN,
            self::INDUSTRY_CODE_ADVERTISING_PLANNING_DESIGN,
            self::INDUSTRY_CODE_OTHER_DESIGN,
            self::INDUSTRY_CODE_RESTAURANTS_COFFEE_SHOPS,
            self::INDUSTRY_CODE_SALE_OF_LUNCH,
            self::INDUSTRY_CODE_BREAD_CONFECTIONERY_MANUFACTURE_SALE,
            self::INDUSTRY_CODE_DELIVERY_CATERING_MOBILE_CATERING,
            self::INDUSTRY_CODE_HOTEL_INN,
            self::INDUSTRY_CODE_HOMESTAY,
            self::INDUSTRY_CODE_TRAVEL_AGENCY,
            self::INDUSTRY_CODE_LEISURE_SPORTS_FACILITY_MANAGEMENT,
            self::INDUSTRY_CODE_SHOW_EVENT_MANAGEMENT,
            self::INDUSTRY_CODE_BARBER,
            self::INDUSTRY_CODE_BEAUTY_SALON,
            self::INDUSTRY_CODE_SPA_SAND_BATH_SAUNA,
            self::INDUSTRY_CODE_ESTE_AIL_SALON,
            self::INDUSTRY_CODE_BRIDAL_PLANNING_INTRODUCE_WEDDING,
            self::INDUSTRY_CODE_MEMORIAL_CEREMONY_FUNERAL,
            self::INDUSTRY_CODE_MOVING,
            self::INDUSTRY_CODE_COURIER_INDUSTRY,
            self::INDUSTRY_CODE_HOUSE_MAID_CLEANING_AGENCY,
            self::INDUSTRY_CODE_RE_TAILORING_CLOTHES,
            self::INDUSTRY_CODE_TRAINING_INSTITUTE_MANAGEMENT,
            self::INDUSTRY_CODE_TUTORING_SCHOOL,
            self::INDUSTRY_CODE_MUSIC_CALLIGRAPHY_ABACUS_CLASSROOM,
            self::INDUSTRY_CODE_ENGLISH_SCHOOL,
            self::INDUSTRY_CODE_TENNIS_YOGA_JUDO_SCHOOL,
            self::INDUSTRY_CODE_CULTURE_SCHOOL,
            self::INDUSTRY_CODE_SEMINAR_PLANNING_MANAGEMENT,
            self::INDUSTRY_CODE_HOSPITAL_CLINIC,
            self::INDUSTRY_CODE_DENTAL_CLINIC,
            self::INDUSTRY_CODE_OTHER_MEDICAL_SERVICES,
            self::INDUSTRY_CODE_NURSERY,
            self::INDUSTRY_CODE_NURSING_HOME,
            self::INDUSTRY_CODE_REHABILITATION_SUPPORT_SERVICES,
            self::INDUSTRY_CODE_OTHER_WELFARE,
            self::INDUSTRY_CODE_VISIT_WELFARE_SERVICE,
            self::INDUSTRY_CODE_RECRUITMENT_TEMPORARY_STAFFING,
            self::INDUSTRY_CODE_LIFE_RELATED_RECRUITMENT_TEMPORARY_STAFFING,
            self::INDUSTRY_CODE_CAR_MAINTENANCE_CAR_REPAIR,
            self::INDUSTRY_CODE_MACHINERY_EQUIPMENT_MAINTENANCE_REPAIR,
            self::INDUSTRY_CODE_CLEANING_MAINTENANCE_BUILDING_MANAGEMENT,
            self::INDUSTRY_CODE_SECURITY,
            self::INDUSTRY_CODE_OTHER_SERVICES,
            self::INDUSTRY_CODE_NPO,
            self::INDUSTRY_CODE_GENERAL_INCORPORATED_ASSOCIATION,
            self::INDUSTRY_CODE_GENERAL_INCORPORATED_FOUNDATION,
            self::INDUSTRY_CODE_OTHER_ASSOCIATION,
            self::INDUSTRY_CODE_MANUFACTURING,
            self::INDUSTRY_CODE_EDUCATION,
            self::INDUSTRY_CODE_MEDICAL,
            self::INDUSTRY_CODE_ICT,
            self::INDUSTRY_CODE_FOOD,
            self::INDUSTRY_CODE_CONSTRUCTION,
            self::INDUSTRY_CODE_TRANSPORTATION,
            self::INDUSTRY_CODE_TRADING,
            self::INDUSTRY_CODE_RETAIL,
            self::INDUSTRY_CODE_FINANCE,
            self::INDUSTRY_CODE_REAL_ESTATE,
            self::INDUSTRY_CODE_TRAVEL,
            self::INDUSTRY_CODE_ACCOUNTANT,
            self::INDUSTRY_CODE_LAWER,
            self::INDUSTRY_CODE_CONSULTANT,
            self::INDUSTRY_CODE_RECRUIT,
            self::INDUSTRY_CODE_PUBLICATION,
            self::INDUSTRY_CODE_DESIGN,
            self::INDUSTRY_CODE_OTHERS,
            self::INDUSTRY_CODE_COMPANY_EMPLOYEE,
            self::INDUSTRY_CODE_OTHERS_SIDE_BUSINESS,
            self::INDUSTRY_CODE_OTHERS_DEDUCTION,
            self::INDUSTRY_CODE__DEFAULT,
        ];
    }

    /**
     * Gets allowable values of the enum.
     *
     * @return string[]
     */
    public function getWorkflowSettingAllowableValues()
    {
        return [
            self::WORKFLOW_SETTING_ENABLE,
            self::WORKFLOW_SETTING_DISABLE,
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
        $this->container['id']                        = $data['id'] ?? null;
        $this->container['name']                      = $data['name'] ?? null;
        $this->container['name_kana']                 = $data['name_kana'] ?? null;
        $this->container['display_name']              = $data['display_name'] ?? null;
        $this->container['tax_at_source_calc_type']   = $data['tax_at_source_calc_type'] ?? null;
        $this->container['contact_name']              = $data['contact_name'] ?? null;
        $this->container['head_count']                = $data['head_count'] ?? null;
        $this->container['corporate_number']          = $data['corporate_number'] ?? null;
        $this->container['txn_number_format']         = $data['txn_number_format'] ?? null;
        $this->container['default_wallet_account_id'] = $data['default_wallet_account_id'] ?? null;
        $this->container['private_settlement']        = $data['private_settlement'] ?? null;
        $this->container['minus_format']              = $data['minus_format'] ?? null;
        $this->container['org_code']                  = $data['org_code'] ?? null;
        $this->container['company_number']            = $data['company_number'] ?? null;
        $this->container['role']                      = $data['role'] ?? null;
        $this->container['phone1']                    = $data['phone1'] ?? null;
        $this->container['phone2']                    = $data['phone2'] ?? null;
        $this->container['fax']                       = $data['fax'] ?? null;
        $this->container['zipcode']                   = $data['zipcode'] ?? null;
        $this->container['prefecture_code']           = $data['prefecture_code'] ?? null;
        $this->container['street_name1']              = $data['street_name1'] ?? null;
        $this->container['street_name2']              = $data['street_name2'] ?? null;
        $this->container['invoice_layout']            = $data['invoice_layout'] ?? null;
        $this->container['amount_fraction']           = $data['amount_fraction'] ?? null;
        $this->container['use_partner_code']          = $data['use_partner_code'] ?? null;
        $this->container['industry_class']            = $data['industry_class'] ?? null;
        $this->container['industry_code']             = $data['industry_code'] ?? null;
        $this->container['workflow_setting']          = $data['workflow_setting'] ?? null;
        $this->container['fiscal_years']              = $data['fiscal_years'] ?? null;
        $this->container['account_items']             = $data['account_items'] ?? null;
        $this->container['tax_codes']                 = $data['tax_codes'] ?? null;
        $this->container['items']                     = $data['items'] ?? null;
        $this->container['partners']                  = $data['partners'] ?? null;
        $this->container['sections']                  = $data['sections'] ?? null;
        $this->container['tags']                      = $data['tags'] ?? null;
        $this->container['walletables']               = $data['walletables'] ?? null;
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

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ((mb_strlen($this->container['name']) > 100)) {
            $invalidProperties[] = "invalid value for 'name', the character length must be smaller than or equal to 100.";
        }

        if ($this->container['name_kana'] === null) {
            $invalidProperties[] = "'name_kana' can't be null";
        }
        if ((mb_strlen($this->container['name_kana']) > 100)) {
            $invalidProperties[] = "invalid value for 'name_kana', the character length must be smaller than or equal to 100.";
        }

        if ($this->container['display_name'] === null) {
            $invalidProperties[] = "'display_name' can't be null";
        }
        if ($this->container['tax_at_source_calc_type'] === null) {
            $invalidProperties[] = "'tax_at_source_calc_type' can't be null";
        }
        if (($this->container['tax_at_source_calc_type'] > 1)) {
            $invalidProperties[] = "invalid value for 'tax_at_source_calc_type', must be smaller than or equal to 1.";
        }

        if (($this->container['tax_at_source_calc_type'] < 0)) {
            $invalidProperties[] = "invalid value for 'tax_at_source_calc_type', must be bigger than or equal to 0.";
        }

        if ($this->container['contact_name'] === null) {
            $invalidProperties[] = "'contact_name' can't be null";
        }
        if ((mb_strlen($this->container['contact_name']) > 50)) {
            $invalidProperties[] = "invalid value for 'contact_name', the character length must be smaller than or equal to 50.";
        }

        if ($this->container['head_count'] === null) {
            $invalidProperties[] = "'head_count' can't be null";
        }
        if (($this->container['head_count'] > 99)) {
            $invalidProperties[] = "invalid value for 'head_count', must be smaller than or equal to 99.";
        }

        if (($this->container['head_count'] < 0)) {
            $invalidProperties[] = "invalid value for 'head_count', must be bigger than or equal to 0.";
        }

        if ($this->container['corporate_number'] === null) {
            $invalidProperties[] = "'corporate_number' can't be null";
        }
        if ($this->container['txn_number_format'] === null) {
            $invalidProperties[] = "'txn_number_format' can't be null";
        }
        $allowedValues = $this->getTxnNumberFormatAllowableValues();
        if (!is_null($this->container['txn_number_format']) && !in_array($this->container['txn_number_format'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'txn_number_format', must be one of '%s'",
                $this->container['txn_number_format'],
                implode("', '", $allowedValues)
            );
        }

        if (!is_null($this->container['default_wallet_account_id']) && ($this->container['default_wallet_account_id'] < 1)) {
            $invalidProperties[] = "invalid value for 'default_wallet_account_id', must be bigger than or equal to 1.";
        }

        if ($this->container['private_settlement'] === null) {
            $invalidProperties[] = "'private_settlement' can't be null";
        }
        if ($this->container['minus_format'] === null) {
            $invalidProperties[] = "'minus_format' can't be null";
        }
        if (($this->container['minus_format'] > 1)) {
            $invalidProperties[] = "invalid value for 'minus_format', must be smaller than or equal to 1.";
        }

        if (($this->container['minus_format'] < 0)) {
            $invalidProperties[] = "invalid value for 'minus_format', must be bigger than or equal to 0.";
        }

        if ($this->container['org_code'] === null) {
            $invalidProperties[] = "'org_code' can't be null";
        }
        if (($this->container['org_code'] > 2)) {
            $invalidProperties[] = "invalid value for 'org_code', must be smaller than or equal to 2.";
        }

        if (($this->container['org_code'] < 1)) {
            $invalidProperties[] = "invalid value for 'org_code', must be bigger than or equal to 1.";
        }

        if ($this->container['company_number'] === null) {
            $invalidProperties[] = "'company_number' can't be null";
        }
        if ($this->container['role'] === null) {
            $invalidProperties[] = "'role' can't be null";
        }
        $allowedValues = $this->getRoleAllowableValues();
        if (!is_null($this->container['role']) && !in_array($this->container['role'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'role', must be one of '%s'",
                $this->container['role'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['phone1'] === null) {
            $invalidProperties[] = "'phone1' can't be null";
        }
        if ($this->container['phone2'] === null) {
            $invalidProperties[] = "'phone2' can't be null";
        }
        if ($this->container['fax'] === null) {
            $invalidProperties[] = "'fax' can't be null";
        }
        if ($this->container['zipcode'] === null) {
            $invalidProperties[] = "'zipcode' can't be null";
        }
        if ($this->container['prefecture_code'] === null) {
            $invalidProperties[] = "'prefecture_code' can't be null";
        }
        if (($this->container['prefecture_code'] > 46)) {
            $invalidProperties[] = "invalid value for 'prefecture_code', must be smaller than or equal to 46.";
        }

        if (($this->container['prefecture_code'] < -1)) {
            $invalidProperties[] = "invalid value for 'prefecture_code', must be bigger than or equal to -1.";
        }

        if ($this->container['street_name1'] === null) {
            $invalidProperties[] = "'street_name1' can't be null";
        }
        if ($this->container['street_name2'] === null) {
            $invalidProperties[] = "'street_name2' can't be null";
        }
        if ($this->container['invoice_layout'] === null) {
            $invalidProperties[] = "'invoice_layout' can't be null";
        }
        $allowedValues = $this->getInvoiceLayoutAllowableValues();
        if (!is_null($this->container['invoice_layout']) && !in_array($this->container['invoice_layout'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'invoice_layout', must be one of '%s'",
                $this->container['invoice_layout'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['amount_fraction'] === null) {
            $invalidProperties[] = "'amount_fraction' can't be null";
        }
        if (($this->container['amount_fraction'] > 2)) {
            $invalidProperties[] = "invalid value for 'amount_fraction', must be smaller than or equal to 2.";
        }

        if (($this->container['amount_fraction'] < 0)) {
            $invalidProperties[] = "invalid value for 'amount_fraction', must be bigger than or equal to 0.";
        }

        if ($this->container['use_partner_code'] === null) {
            $invalidProperties[] = "'use_partner_code' can't be null";
        }
        if ($this->container['industry_class'] === null) {
            $invalidProperties[] = "'industry_class' can't be null";
        }
        $allowedValues = $this->getIndustryClassAllowableValues();
        if (!is_null($this->container['industry_class']) && !in_array($this->container['industry_class'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'industry_class', must be one of '%s'",
                $this->container['industry_class'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['industry_code'] === null) {
            $invalidProperties[] = "'industry_code' can't be null";
        }
        $allowedValues = $this->getIndustryCodeAllowableValues();
        if (!is_null($this->container['industry_code']) && !in_array($this->container['industry_code'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'industry_code', must be one of '%s'",
                $this->container['industry_code'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['workflow_setting'] === null) {
            $invalidProperties[] = "'workflow_setting' can't be null";
        }
        $allowedValues = $this->getWorkflowSettingAllowableValues();
        if (!is_null($this->container['workflow_setting']) && !in_array($this->container['workflow_setting'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value '%s' for 'workflow_setting', must be one of '%s'",
                $this->container['workflow_setting'],
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['fiscal_years'] === null) {
            $invalidProperties[] = "'fiscal_years' can't be null";
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
     * @param int $id 事業所ID
     *
     * @return self
     */
    public function setId($id)
    {
        if (($id < 1)) {
            throw new \InvalidArgumentException('invalid value for $id when calling CompanyResponseCompany., must be bigger than or equal to 1.');
        }

        $this->container['id'] = $id;

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
     * @param string $name 事業所の正式名称 (100文字以内)
     *
     * @return self
     */
    public function setName($name)
    {
        if ((mb_strlen($name) > 100)) {
            throw new \InvalidArgumentException('invalid length for $name when calling CompanyResponseCompany., must be smaller than or equal to 100.');
        }

        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets name_kana.
     *
     * @return string
     */
    public function getNameKana()
    {
        return $this->container['name_kana'];
    }

    /**
     * Sets name_kana.
     *
     * @param string $name_kana 正式名称フリガナ (100文字以内)
     *
     * @return self
     */
    public function setNameKana($name_kana)
    {
        if ((mb_strlen($name_kana) > 100)) {
            throw new \InvalidArgumentException('invalid length for $name_kana when calling CompanyResponseCompany., must be smaller than or equal to 100.');
        }

        $this->container['name_kana'] = $name_kana;

        return $this;
    }

    /**
     * Gets display_name.
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name.
     *
     * @param string $display_name 事業所名
     *
     * @return self
     */
    public function setDisplayName($display_name)
    {
        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets tax_at_source_calc_type.
     *
     * @return int
     */
    public function getTaxAtSourceCalcType()
    {
        return $this->container['tax_at_source_calc_type'];
    }

    /**
     * Sets tax_at_source_calc_type.
     *
     * @param int $tax_at_source_calc_type 源泉徴収税計算（0: 消費税を含める、1: 消費税を含めない）
     *
     * @return self
     */
    public function setTaxAtSourceCalcType($tax_at_source_calc_type)
    {
        if (($tax_at_source_calc_type > 1)) {
            throw new \InvalidArgumentException('invalid value for $tax_at_source_calc_type when calling CompanyResponseCompany., must be smaller than or equal to 1.');
        }
        if (($tax_at_source_calc_type < 0)) {
            throw new \InvalidArgumentException('invalid value for $tax_at_source_calc_type when calling CompanyResponseCompany., must be bigger than or equal to 0.');
        }

        $this->container['tax_at_source_calc_type'] = $tax_at_source_calc_type;

        return $this;
    }

    /**
     * Gets contact_name.
     *
     * @return string
     */
    public function getContactName()
    {
        return $this->container['contact_name'];
    }

    /**
     * Sets contact_name.
     *
     * @param string $contact_name 担当者名 (50文字以内)
     *
     * @return self
     */
    public function setContactName($contact_name)
    {
        if ((mb_strlen($contact_name) > 50)) {
            throw new \InvalidArgumentException('invalid length for $contact_name when calling CompanyResponseCompany., must be smaller than or equal to 50.');
        }

        $this->container['contact_name'] = $contact_name;

        return $this;
    }

    /**
     * Gets head_count.
     *
     * @return int
     */
    public function getHeadCount()
    {
        return $this->container['head_count'];
    }

    /**
     * Sets head_count.
     *
     * @param int $head_count 従業員数（0: 経営者のみ、1: 2〜5人、2: 6〜10人、3: 11〜20人、4: 21〜30人、5: 31〜40人、6: 41〜100人、7: 100人以上、13: 21〜50人、14: 51〜100人、15: 101〜300人、16: 501〜1000人、17: 1001人以上、18: 301〜500人
     *
     * @return self
     */
    public function setHeadCount($head_count)
    {
        if (($head_count > 99)) {
            throw new \InvalidArgumentException('invalid value for $head_count when calling CompanyResponseCompany., must be smaller than or equal to 99.');
        }
        if (($head_count < 0)) {
            throw new \InvalidArgumentException('invalid value for $head_count when calling CompanyResponseCompany., must be bigger than or equal to 0.');
        }

        $this->container['head_count'] = $head_count;

        return $this;
    }

    /**
     * Gets corporate_number.
     *
     * @return string
     */
    public function getCorporateNumber()
    {
        return $this->container['corporate_number'];
    }

    /**
     * Sets corporate_number.
     *
     * @param string $corporate_number 法人番号 (半角数字13桁、法人のみ)
     *
     * @return self
     */
    public function setCorporateNumber($corporate_number)
    {
        $this->container['corporate_number'] = $corporate_number;

        return $this;
    }

    /**
     * Gets txn_number_format.
     *
     * @return string
     */
    public function getTxnNumberFormat()
    {
        return $this->container['txn_number_format'];
    }

    /**
     * Sets txn_number_format.
     *
     * @param string $txn_number_format 仕訳番号形式（not_used: 使用しない、digits: 数字（例：5091824）、alnum: 英数字（例：59J0P））
     *
     * @return self
     */
    public function setTxnNumberFormat($txn_number_format)
    {
        $allowedValues = $this->getTxnNumberFormatAllowableValues();
        if (!in_array($txn_number_format, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'txn_number_format', must be one of '%s'",
                    $txn_number_format,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['txn_number_format'] = $txn_number_format;

        return $this;
    }

    /**
     * Gets default_wallet_account_id.
     *
     * @return int|null
     */
    public function getDefaultWalletAccountId()
    {
        return $this->container['default_wallet_account_id'];
    }

    /**
     * Sets default_wallet_account_id.
     *
     * @param int|null $default_wallet_account_id デフォルトの決済口座が紐づく勘定科目ID
     *
     * @return self
     */
    public function setDefaultWalletAccountId($default_wallet_account_id)
    {
        if (!is_null($default_wallet_account_id) && ($default_wallet_account_id < 1)) {
            throw new \InvalidArgumentException('invalid value for $default_wallet_account_id when calling CompanyResponseCompany., must be bigger than or equal to 1.');
        }

        $this->container['default_wallet_account_id'] = $default_wallet_account_id;

        return $this;
    }

    /**
     * Gets private_settlement.
     *
     * @return bool
     */
    public function getPrivateSettlement()
    {
        return $this->container['private_settlement'];
    }

    /**
     * Sets private_settlement.
     *
     * @param bool $private_settlement プライベート資金/役員資金（false: 使用しない、true: 使用する）
     *
     * @return self
     */
    public function setPrivateSettlement($private_settlement)
    {
        $this->container['private_settlement'] = $private_settlement;

        return $this;
    }

    /**
     * Gets minus_format.
     *
     * @return int
     */
    public function getMinusFormat()
    {
        return $this->container['minus_format'];
    }

    /**
     * Sets minus_format.
     *
     * @param int $minus_format マイナスの表示方法（0: -、 1: △）
     *
     * @return self
     */
    public function setMinusFormat($minus_format)
    {
        if (($minus_format > 1)) {
            throw new \InvalidArgumentException('invalid value for $minus_format when calling CompanyResponseCompany., must be smaller than or equal to 1.');
        }
        if (($minus_format < 0)) {
            throw new \InvalidArgumentException('invalid value for $minus_format when calling CompanyResponseCompany., must be bigger than or equal to 0.');
        }

        $this->container['minus_format'] = $minus_format;

        return $this;
    }

    /**
     * Gets org_code.
     *
     * @return int
     */
    public function getOrgCode()
    {
        return $this->container['org_code'];
    }

    /**
     * Sets org_code.
     *
     * @param int $org_code 事業所種別コード（1: 法人、 2: 個人事業主）
     *
     * @return self
     */
    public function setOrgCode($org_code)
    {
        if (($org_code > 2)) {
            throw new \InvalidArgumentException('invalid value for $org_code when calling CompanyResponseCompany., must be smaller than or equal to 2.');
        }
        if (($org_code < 1)) {
            throw new \InvalidArgumentException('invalid value for $org_code when calling CompanyResponseCompany., must be bigger than or equal to 1.');
        }

        $this->container['org_code'] = $org_code;

        return $this;
    }

    /**
     * Gets company_number.
     *
     * @return string
     */
    public function getCompanyNumber()
    {
        return $this->container['company_number'];
    }

    /**
     * Sets company_number.
     *
     * @param string $company_number 事業所番号（ハイフン無し）
     *
     * @return self
     */
    public function setCompanyNumber($company_number)
    {
        $this->container['company_number'] = $company_number;

        return $this;
    }

    /**
     * Gets role.
     *
     * @return string
     */
    public function getRole()
    {
        return $this->container['role'];
    }

    /**
     * Sets role.
     *
     * @param string $role ユーザーの権限  * admin - 管理者 * simple_accounting - 一般（経理） * read_only - 取引登録のみ * self_only - 閲覧のみ * workflow - 申請・承認
     *
     * @return self
     */
    public function setRole($role)
    {
        $allowedValues = $this->getRoleAllowableValues();
        if (!in_array($role, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'role', must be one of '%s'",
                    $role,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['role'] = $role;

        return $this;
    }

    /**
     * Gets phone1.
     *
     * @return string
     */
    public function getPhone1()
    {
        return $this->container['phone1'];
    }

    /**
     * Sets phone1.
     *
     * @param string $phone1 電話番号１
     *
     * @return self
     */
    public function setPhone1($phone1)
    {
        $this->container['phone1'] = $phone1;

        return $this;
    }

    /**
     * Gets phone2.
     *
     * @return string
     */
    public function getPhone2()
    {
        return $this->container['phone2'];
    }

    /**
     * Sets phone2.
     *
     * @param string $phone2 電話番号２
     *
     * @return self
     */
    public function setPhone2($phone2)
    {
        $this->container['phone2'] = $phone2;

        return $this;
    }

    /**
     * Gets fax.
     *
     * @return string
     */
    public function getFax()
    {
        return $this->container['fax'];
    }

    /**
     * Sets fax.
     *
     * @param string $fax FAX
     *
     * @return self
     */
    public function setFax($fax)
    {
        $this->container['fax'] = $fax;

        return $this;
    }

    /**
     * Gets zipcode.
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->container['zipcode'];
    }

    /**
     * Sets zipcode.
     *
     * @param string $zipcode 郵便番号
     *
     * @return self
     */
    public function setZipcode($zipcode)
    {
        $this->container['zipcode'] = $zipcode;

        return $this;
    }

    /**
     * Gets prefecture_code.
     *
     * @return int
     */
    public function getPrefectureCode()
    {
        return $this->container['prefecture_code'];
    }

    /**
     * Sets prefecture_code.
     *
     * @param int $prefecture_code 都道府県コード（-1: 設定しない、0: 北海道、1:青森、2:岩手、3:宮城、4:秋田、5:山形、6:福島、7:茨城、8:栃木、9:群馬、10:埼玉、11:千葉、12:東京、13:神奈川、14:新潟、15:富山、16:石川、17:福井、18:山梨、19:長野、20:岐阜、21:静岡、22:愛知、23:三重、24:滋賀、25:京都、26:大阪、27:兵庫、28:奈良、29:和歌山、30:鳥取、31:島根、32:岡山、33:広島、34:山口、35:徳島、36:香川、37:愛媛、38:高知、39:福岡、40:佐賀、41:長崎、42:熊本、43:大分、44:宮崎、45:鹿児島、46:沖縄
     *
     * @return self
     */
    public function setPrefectureCode($prefecture_code)
    {
        if (($prefecture_code > 46)) {
            throw new \InvalidArgumentException('invalid value for $prefecture_code when calling CompanyResponseCompany., must be smaller than or equal to 46.');
        }
        if (($prefecture_code < -1)) {
            throw new \InvalidArgumentException('invalid value for $prefecture_code when calling CompanyResponseCompany., must be bigger than or equal to -1.');
        }

        $this->container['prefecture_code'] = $prefecture_code;

        return $this;
    }

    /**
     * Gets street_name1.
     *
     * @return string
     */
    public function getStreetName1()
    {
        return $this->container['street_name1'];
    }

    /**
     * Sets street_name1.
     *
     * @param string $street_name1 市区町村・番地
     *
     * @return self
     */
    public function setStreetName1($street_name1)
    {
        $this->container['street_name1'] = $street_name1;

        return $this;
    }

    /**
     * Gets street_name2.
     *
     * @return string
     */
    public function getStreetName2()
    {
        return $this->container['street_name2'];
    }

    /**
     * Sets street_name2.
     *
     * @param string $street_name2 建物名・部屋番号など
     *
     * @return self
     */
    public function setStreetName2($street_name2)
    {
        $this->container['street_name2'] = $street_name2;

        return $this;
    }

    /**
     * Gets invoice_layout.
     *
     * @return string
     */
    public function getInvoiceLayout()
    {
        return $this->container['invoice_layout'];
    }

    /**
     * Sets invoice_layout.
     *
     * @param string $invoice_layout 請求書レイアウト * `default_classic` - レイアウト１/クラシック (デフォルト)  * `standard_classic` - レイアウト２/クラシック  * `envelope_classic` - 封筒１/クラシック  * `carried_forward_standard_classic` - レイアウト３（繰越金額欄あり）/クラシック  * `carried_forward_envelope_classic` - 封筒２（繰越金額欄あり）/クラシック  * `default_modern` - レイアウト１/モダン  * `standard_modern` - レイアウト２/モダン  * `envelope_modern` - 封筒/モダン
     *
     * @return self
     */
    public function setInvoiceLayout($invoice_layout)
    {
        $allowedValues = $this->getInvoiceLayoutAllowableValues();
        if (!in_array($invoice_layout, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'invoice_layout', must be one of '%s'",
                    $invoice_layout,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['invoice_layout'] = $invoice_layout;

        return $this;
    }

    /**
     * Gets amount_fraction.
     *
     * @return int
     */
    public function getAmountFraction()
    {
        return $this->container['amount_fraction'];
    }

    /**
     * Sets amount_fraction.
     *
     * @param int $amount_fraction 金額端数処理方法（0: 切り捨て、1: 切り上げ、2: 四捨五入）
     *
     * @return self
     */
    public function setAmountFraction($amount_fraction)
    {
        if (($amount_fraction > 2)) {
            throw new \InvalidArgumentException('invalid value for $amount_fraction when calling CompanyResponseCompany., must be smaller than or equal to 2.');
        }
        if (($amount_fraction < 0)) {
            throw new \InvalidArgumentException('invalid value for $amount_fraction when calling CompanyResponseCompany., must be bigger than or equal to 0.');
        }

        $this->container['amount_fraction'] = $amount_fraction;

        return $this;
    }

    /**
     * Gets use_partner_code.
     *
     * @return bool
     */
    public function getUsePartnerCode()
    {
        return $this->container['use_partner_code'];
    }

    /**
     * Sets use_partner_code.
     *
     * @param bool $use_partner_code 取引先コードの利用設定（true: 有効、 false: 無効）
     *
     * @return self
     */
    public function setUsePartnerCode($use_partner_code)
    {
        $this->container['use_partner_code'] = $use_partner_code;

        return $this;
    }

    /**
     * Gets industry_class.
     *
     * @return string
     */
    public function getIndustryClass()
    {
        return $this->container['industry_class'];
    }

    /**
     * Sets industry_class.
     *
     * @param string $industry_class 種別（agriculture_forestry_fisheries_ore: 農林水産業/鉱業,construction: 建設,manufacturing_processing: 製造/加工,it: IT,transportation_logistics: 運輸/物流,retail_wholesale: 小売/卸売,finance_insurance: 金融/保険,real_estate_rental: 不動産/レンタル,profession: 士業/学術/専門技術サービス,design_production: デザイン/制作,food: 飲食,leisure_entertainment: レジャー/娯楽,lifestyle: 生活関連サービス,education: 教育/学習支援,medical_welfare: 医療/福祉,other_services: その他サービス,other_association: NPO、一般社団法人等,other: その他, \"\": 未選択）
     *
     * @return self
     */
    public function setIndustryClass($industry_class)
    {
        $allowedValues = $this->getIndustryClassAllowableValues();
        if (!in_array($industry_class, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'industry_class', must be one of '%s'",
                    $industry_class,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['industry_class'] = $industry_class;

        return $this;
    }

    /**
     * Gets industry_code.
     *
     * @return string
     */
    public function getIndustryCode()
    {
        return $this->container['industry_code'];
    }

    /**
     * Sets industry_code.
     *
     * @param string $industry_code ### 業種 法人<br>   - '': 未選択   - agriculture: 農業   - forestry: 林業   - fishing_industry: 漁業、水産養殖業   - mining: 鉱業、採石業、砂利採取業   - civil_contractors: 土木工事業   - pavement: 舗装工事業   - carpenter: とび、大工、左官等の建設工事業   - renovation: リフォーム工事業   - electrical_plumbing: 電気、管工事等の設備工事業   - grocery: 食料品の製造加工業   - machinery_manufacturing: 機械器具の製造加工業   - printing: 印刷業   - other_manufacturing: その他の製造加工業   - software_development: 受託：ソフトウェア、アプリ開発業   - system_development: 受託：システム開発業   - survey_analysis: 受託：調査、分析等の情報処理業   - server_management: 受託：サーバー運営管理   - website_production: 受託：ウェブサイト制作   - online_service_management: オンラインサービス運営業   - online_advertising_agency: オンライン広告代理店業   - online_advertising_planning_production: オンライン広告企画・制作業   - online_media_management: オンラインメディア運営業   - portal_site_management: ポータルサイト運営業   - other_it_services: その他、IT サービス業   - transport_delivery: 輸送業、配送業   - delivery: バイク便等の配達業   - other_transportation_logistics: その他の運輸業、物流業   - other_wholesale: 卸売業：その他   - clothing_wholesale_fiber: 卸売業：衣類卸売／繊維   - food_wholesale: 卸売業：飲食料品   - entrusted_development_wholesale: 卸売業：機械器具   - online_shop: 小売業：無店舗　オンラインショップ   - fashion_grocery_store: 小売業：店舗あり　ファッション、雑貨   - food_store: 小売業：店舗あり　生鮮食品、飲食料品   - entrusted_store: 小売業：店舗あり　機械、器具   - other_store: 小売業：店舗あり　その他   - financial_instruments_exchange: 金融業：金融商品取引   - commodity_futures_investment_advisor: 金融業：商品先物取引、商品投資顧問   - other_financial: 金融業：その他   - brokerage_insurance: 保険業：仲介、代理   - other_insurance: 保険業：その他   - real_estate_developer: 不動産業：ディベロッパー   - real_estate_brokerage: 不動産業：売買、仲介   - rent_coin_parking_management: 不動産業：賃貸、コインパーキング、管理   - rental_office_co_working_space: 不動産業：レンタルオフィス、コワーキングスペース   - rental_lease: レンタル業、リース業   - cpa_tax_accountant: 士業：公認会計士事務所、税理士事務所   - law_office: 士業：法律事務所   - judicial_and_administrative_scrivener: 士業：司法書士事務所／行政書士事務所   - labor_consultant: 士業：社会保険労務士事務所   - other_profession: 士業：その他   - business_consultant: 経営コンサルタント   - academic_research_development: 学術・開発研究機関   - advertising_agency: 広告代理店   - advertising_planning_production: 広告企画／制作   - design_development: ソフトウェア、アプリ開発業（受託）   - apparel_industry_design: 服飾デザイン業、工業デザイン業   - website_design: ウェブサイト制作（受託）   - advertising_planning_design: 広告企画／制作業   - other_design: その他、デザイン／制作   - restaurants_coffee_shops: レストラン、喫茶店等の飲食店業   - sale_of_lunch: 弁当の販売業   - bread_confectionery_manufacture_sale: パン、菓子等の製造販売業   - delivery_catering_mobile_catering: デリバリー業、ケータリング業、移動販売業   - hotel_inn: 宿泊業：ホテル、旅館   - homestay: 宿泊業：民泊   - travel_agency: 旅行代理店業   - leisure_sports_facility_management: レジャー、スポーツ等の施設運営業   - show_event_management: ショー、イベント等の興行、イベント運営業   - barber: ビューティ、ヘルスケア業：床屋、理容室   - beauty_salon: ビューティ、ヘルスケア業：美容室   - spa_sand_bath_sauna: ビューティ、ヘルスケア業：スパ、砂風呂、サウナ等   - este_ail_salon: ビューティ、ヘルスケア業：その他、エステサロン、ネイルサロン等   - bridal_planning_introduce_wedding: 冠婚葬祭業：ブライダルプランニング、結婚式場紹介等   - memorial_ceremony_funeral: 冠婚葬祭業：メモリアルセレモニー、葬儀等   - moving: 引っ越し業   - courier_industry: 宅配業   - house_maid_cleaning_agency: 家事代行サービス業：無店舗　ハウスメイド、掃除代行等   - re_tailoring_clothes: 家事代行サービス業：店舗あり　衣類修理、衣類仕立て直し等   - training_institute_management: 研修所等の施設運営業   - tutoring_school: 学習塾、進学塾等の教育・学習支援業   - music_calligraphy_abacus_classroom: 音楽教室、書道教室、そろばん教室等の教育・学習支援業   - english_school: 英会話スクール等の語学学習支援業   - tennis_yoga_judo_school: テニススクール、ヨガ教室、柔道場等のスポーツ指導、支援業   - culture_school: その他、カルチャースクール等の教育・学習支援業   - seminar_planning_management: セミナー等の企画、運営業   - hospital_clinic: 医療業：病院、一般診療所、クリニック等   - dental_clinic: 医療業：歯科診療所   - other_medical_services: 医療業：その他、医療サービス等   - nursery: 福祉業：保育所等、児童向け施設型サービス   - nursing_home: 福祉業：老人ホーム等、老人向け施設型サービス   - rehabilitation_support_services: 福祉業：療育支援サービス等、障害者等向け施設型サービス   - other_welfare: 福祉業：その他、施設型福祉サービス   - visit_welfare_service: 福祉業：訪問型福祉サービス   - recruitment_temporary_staffing: 人材紹介業、人材派遣業   - life_related_recruitment_temporary_staffing: 生活関連サービスの人材紹介業、人材派遣業   - car_maintenance_car_repair: 自動車整備業、自動車修理業   - machinery_equipment_maintenance_repair: 機械機器類の整備業、修理業   - cleaning_maintenance_building_management: 清掃業、メンテナンス業、建物管理業   - security: 警備業   - other_services: その他のサービス業   - npo: 'NPO'   - general_incorporated_association: '一般社団法人'   - general_incorporated_foundation: '一般財団法人'   - other_association: 'その他組織' <br> <br> ### 業種 個人<br>   - '': 未選択   - manufacturing: 製造業   - education: 教育   - medical: 医療/福祉   - ict: ソフトウェア・情報サービス業   - food: 飲食業   - construction: 建設業   - transportation: 運送業   - trading: 卸売業   - retail: 小売業   - finance: 金融/保険業   - real_estate: 不動産業   - agriculture: 農業   - travel: 旅行・宿泊業   - accountant: 専門業（税理士・会計士）   - lawer: その他専門業（法律など）   - consultant: サービス業（コンサルティング）   - recruit: サービス業（人材）   - publication: サービス業（出版）   - design: サービス業（デザイン）   - barber: サービス業（理容・美容）   - others: その他サービス業   - company_employee: 会社員   - others_side_business: その他(副業や株取引のみなど)   - others_deduction: その他(医療費などの控除のみ)   - default: 未定
     *
     * @return self
     */
    public function setIndustryCode($industry_code)
    {
        $allowedValues = $this->getIndustryCodeAllowableValues();
        if (!in_array($industry_code, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'industry_code', must be one of '%s'",
                    $industry_code,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['industry_code'] = $industry_code;

        return $this;
    }

    /**
     * Gets workflow_setting.
     *
     * @return string
     */
    public function getWorkflowSetting()
    {
        return $this->container['workflow_setting'];
    }

    /**
     * Sets workflow_setting.
     *
     * @param string $workflow_setting 仕訳承認フロー（enable: 有効、 disable: 無効）
     *
     * @return self
     */
    public function setWorkflowSetting($workflow_setting)
    {
        $allowedValues = $this->getWorkflowSettingAllowableValues();
        if (!in_array($workflow_setting, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value '%s' for 'workflow_setting', must be one of '%s'",
                    $workflow_setting,
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['workflow_setting'] = $workflow_setting;

        return $this;
    }

    /**
     * Gets fiscal_years.
     *
     * @return \OpenAPI\Client\Model\FiscalYears[]
     */
    public function getFiscalYears()
    {
        return $this->container['fiscal_years'];
    }

    /**
     * Sets fiscal_years.
     *
     * @param \OpenAPI\Client\Model\FiscalYears[] $fiscal_years fiscal_years
     *
     * @return self
     */
    public function setFiscalYears($fiscal_years)
    {
        $this->container['fiscal_years'] = $fiscal_years;

        return $this;
    }

    /**
     * Gets account_items.
     *
     * @return \OpenAPI\Client\Model\CompanyResponseCompanyAccountItems[]|null
     */
    public function getAccountItems()
    {
        return $this->container['account_items'];
    }

    /**
     * Sets account_items.
     *
     * @param \OpenAPI\Client\Model\CompanyResponseCompanyAccountItems[]|null $account_items account_items
     *
     * @return self
     */
    public function setAccountItems($account_items)
    {
        $this->container['account_items'] = $account_items;

        return $this;
    }

    /**
     * Gets tax_codes.
     *
     * @return \OpenAPI\Client\Model\CompanyResponseCompanyTaxCodes[]|null
     */
    public function getTaxCodes()
    {
        return $this->container['tax_codes'];
    }

    /**
     * Sets tax_codes.
     *
     * @param \OpenAPI\Client\Model\CompanyResponseCompanyTaxCodes[]|null $tax_codes tax_codes
     *
     * @return self
     */
    public function setTaxCodes($tax_codes)
    {
        $this->container['tax_codes'] = $tax_codes;

        return $this;
    }

    /**
     * Gets items.
     *
     * @return \OpenAPI\Client\Model\CompanyResponseCompanyItems[]|null
     */
    public function getItems()
    {
        return $this->container['items'];
    }

    /**
     * Sets items.
     *
     * @param \OpenAPI\Client\Model\CompanyResponseCompanyItems[]|null $items items
     *
     * @return self
     */
    public function setItems($items)
    {
        $this->container['items'] = $items;

        return $this;
    }

    /**
     * Gets partners.
     *
     * @return \OpenAPI\Client\Model\CompanyResponseCompanyPartners[]|null
     */
    public function getPartners()
    {
        return $this->container['partners'];
    }

    /**
     * Sets partners.
     *
     * @param \OpenAPI\Client\Model\CompanyResponseCompanyPartners[]|null $partners partners
     *
     * @return self
     */
    public function setPartners($partners)
    {
        $this->container['partners'] = $partners;

        return $this;
    }

    /**
     * Gets sections.
     *
     * @return \OpenAPI\Client\Model\CompanyResponseCompanySections[]|null
     */
    public function getSections()
    {
        return $this->container['sections'];
    }

    /**
     * Sets sections.
     *
     * @param \OpenAPI\Client\Model\CompanyResponseCompanySections[]|null $sections sections
     *
     * @return self
     */
    public function setSections($sections)
    {
        $this->container['sections'] = $sections;

        return $this;
    }

    /**
     * Gets tags.
     *
     * @return \OpenAPI\Client\Model\CompanyResponseCompanyTags[]|null
     */
    public function getTags()
    {
        return $this->container['tags'];
    }

    /**
     * Sets tags.
     *
     * @param \OpenAPI\Client\Model\CompanyResponseCompanyTags[]|null $tags tags
     *
     * @return self
     */
    public function setTags($tags)
    {
        $this->container['tags'] = $tags;

        return $this;
    }

    /**
     * Gets walletables.
     *
     * @return \OpenAPI\Client\Model\CompanyResponseCompanyWalletables[]|null
     */
    public function getWalletables()
    {
        return $this->container['walletables'];
    }

    /**
     * Sets walletables.
     *
     * @param \OpenAPI\Client\Model\CompanyResponseCompanyWalletables[]|null $walletables walletables
     *
     * @return self
     */
    public function setWalletables($walletables)
    {
        $this->container['walletables'] = $walletables;

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
