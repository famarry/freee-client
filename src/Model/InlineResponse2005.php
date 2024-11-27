<?php

/**
 * InlineResponse2005.
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
 * InlineResponse2005 Class Doc Comment.
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
class InlineResponse2005 implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'inline_response_200_5';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'wallet_txns'                      => '\OpenAPI\Client\Model\UserCapabilityWithConfirm',
        'deals'                            => '\OpenAPI\Client\Model\UserCapabilityWithSelfOnly',
        'transfers'                        => '\OpenAPI\Client\Model\UserCapabilityWithSelfOnly',
        'docs'                             => '\OpenAPI\Client\Model\UserCapabilityWithSelfOnly',
        'doc_postings'                     => '\OpenAPI\Client\Model\UserCapabilityJustCreate',
        'receipts'                         => '\OpenAPI\Client\Model\UserCapabilityWithSelfOnly',
        'receipt_stream_editor'            => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'spreadsheets'                     => '\OpenAPI\Client\Model\UserCapabilityJustCreateRead',
        'expense_applications'             => '\OpenAPI\Client\Model\UserCapabilityWithSelfOnly',
        'expense_application_sync_payroll' => '\OpenAPI\Client\Model\UserCapabilityJustCreate',
        'payment_requests'                 => '\OpenAPI\Client\Model\UserCapabilityWithSelfOnly',
        'approval_requests'                => '\OpenAPI\Client\Model\UserCapabilityWithSelfOnly',
        'reports'                          => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'reports_income_expense'           => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'reports_receivables'              => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'reports_payables'                 => '\OpenAPI\Client\Model\UserCapabilityJustReadWrite',
        'reports_cash_balance'             => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'reports_managements_planning'     => '\OpenAPI\Client\Model\UserCapabilityJustReadWrite',
        'reports_managements_navigation'   => '\OpenAPI\Client\Model\UserCapabilityJustReadWrite',
        'reports_custom_reports_aggregate' => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'reports_pl'                       => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'reports_bs'                       => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'reports_general_ledgers'          => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'reports_journals'                 => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'manual_journals'                  => '\OpenAPI\Client\Model\UserCapabilityWithSelfOnly',
        'fixed_assets'                     => '\OpenAPI\Client\Model\UserCapability',
        'inventory_refreshes'              => '\OpenAPI\Client\Model\UserCapability',
        'biz_allocations'                  => '\OpenAPI\Client\Model\UserCapability',
        'payment_records'                  => '\OpenAPI\Client\Model\UserCapability',
        'annual_reports'                   => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'tax_reports'                      => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'consumption_entries'              => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'tax_return'                       => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'account_item_statements'          => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'month_end'                        => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'year_end'                         => '\OpenAPI\Client\Model\UserCapabilityJustReadUpdate',
        'walletables'                      => '\OpenAPI\Client\Model\UserCapabilityWithSync',
        'companies'                        => '\OpenAPI\Client\Model\UserCapabilityJustReadUpdate',
        'invitations'                      => '\OpenAPI\Client\Model\UserCapability',
        'access_controls'                  => '\OpenAPI\Client\Model\UserCapabilityWithWrite',
        'sign_in_logs'                     => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'user_attribute_logs'              => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'app_role_logs'                    => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'txn_relationship_logs'            => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'backups'                          => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'opening_balances'                 => '\OpenAPI\Client\Model\UserCapabilityJustReadUpdate',
        'system_conversion'                => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'resets'                           => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'partners'                         => '\OpenAPI\Client\Model\UserCapability',
        'items'                            => '\OpenAPI\Client\Model\UserCapability',
        'sections'                         => '\OpenAPI\Client\Model\UserCapability',
        'tags'                             => '\OpenAPI\Client\Model\UserCapability',
        'account_items'                    => '\OpenAPI\Client\Model\UserCapability',
        'taxes'                            => '\OpenAPI\Client\Model\UserCapabilityJustReadUpdate',
        'payroll_item_sets'                => '\OpenAPI\Client\Model\UserCapability',
        'user_matchers'                    => '\OpenAPI\Client\Model\UserCapability',
        'deal_templates'                   => '\OpenAPI\Client\Model\UserCapability',
        'manual_journal_templates'         => '\OpenAPI\Client\Model\UserCapability',
        'cost_allocations'                 => '\OpenAPI\Client\Model\UserCapabilityJustReadUpdate',
        'approval_flow_routes'             => '\OpenAPI\Client\Model\UserCapability',
        'expense_application_templates'    => '\OpenAPI\Client\Model\UserCapability',
        'request_forms'                    => '\OpenAPI\Client\Model\UserCapability',
        'system_messages_for_admin'        => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'company_internal_announcements'   => '\OpenAPI\Client\Model\UserCapabilityJustUpdate',
        'doc_change_logs'                  => '\OpenAPI\Client\Model\UserCapabilityJustRead',
        'workflows'                        => '\OpenAPI\Client\Model\UserCapabilityJustReadUpdateDestroy',
        'oauth_applications'               => '\OpenAPI\Client\Model\UserCapability',
        'oauth_authorizations'             => '\OpenAPI\Client\Model\UserCapability',
        'bank_accountant_staff_users'      => '\OpenAPI\Client\Model\UserCapability',
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
        'wallet_txns'                      => null,
        'deals'                            => null,
        'transfers'                        => null,
        'docs'                             => null,
        'doc_postings'                     => null,
        'receipts'                         => null,
        'receipt_stream_editor'            => null,
        'spreadsheets'                     => null,
        'expense_applications'             => null,
        'expense_application_sync_payroll' => null,
        'payment_requests'                 => null,
        'approval_requests'                => null,
        'reports'                          => null,
        'reports_income_expense'           => null,
        'reports_receivables'              => null,
        'reports_payables'                 => null,
        'reports_cash_balance'             => null,
        'reports_managements_planning'     => null,
        'reports_managements_navigation'   => null,
        'reports_custom_reports_aggregate' => null,
        'reports_pl'                       => null,
        'reports_bs'                       => null,
        'reports_general_ledgers'          => null,
        'reports_journals'                 => null,
        'manual_journals'                  => null,
        'fixed_assets'                     => null,
        'inventory_refreshes'              => null,
        'biz_allocations'                  => null,
        'payment_records'                  => null,
        'annual_reports'                   => null,
        'tax_reports'                      => null,
        'consumption_entries'              => null,
        'tax_return'                       => null,
        'account_item_statements'          => null,
        'month_end'                        => null,
        'year_end'                         => null,
        'walletables'                      => null,
        'companies'                        => null,
        'invitations'                      => null,
        'access_controls'                  => null,
        'sign_in_logs'                     => null,
        'user_attribute_logs'              => null,
        'app_role_logs'                    => null,
        'txn_relationship_logs'            => null,
        'backups'                          => null,
        'opening_balances'                 => null,
        'system_conversion'                => null,
        'resets'                           => null,
        'partners'                         => null,
        'items'                            => null,
        'sections'                         => null,
        'tags'                             => null,
        'account_items'                    => null,
        'taxes'                            => null,
        'payroll_item_sets'                => null,
        'user_matchers'                    => null,
        'deal_templates'                   => null,
        'manual_journal_templates'         => null,
        'cost_allocations'                 => null,
        'approval_flow_routes'             => null,
        'expense_application_templates'    => null,
        'request_forms'                    => null,
        'system_messages_for_admin'        => null,
        'company_internal_announcements'   => null,
        'doc_change_logs'                  => null,
        'workflows'                        => null,
        'oauth_applications'               => null,
        'oauth_authorizations'             => null,
        'bank_accountant_staff_users'      => null,
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
        'wallet_txns'                      => 'wallet_txns',
        'deals'                            => 'deals',
        'transfers'                        => 'transfers',
        'docs'                             => 'docs',
        'doc_postings'                     => 'doc_postings',
        'receipts'                         => 'receipts',
        'receipt_stream_editor'            => 'receipt_stream_editor',
        'spreadsheets'                     => 'spreadsheets',
        'expense_applications'             => 'expense_applications',
        'expense_application_sync_payroll' => 'expense_application_sync_payroll',
        'payment_requests'                 => 'payment_requests',
        'approval_requests'                => 'approval_requests',
        'reports'                          => 'reports',
        'reports_income_expense'           => 'reports_income_expense',
        'reports_receivables'              => 'reports_receivables',
        'reports_payables'                 => 'reports_payables',
        'reports_cash_balance'             => 'reports_cash_balance',
        'reports_managements_planning'     => 'reports_managements_planning',
        'reports_managements_navigation'   => 'reports_managements_navigation',
        'reports_custom_reports_aggregate' => 'reports_custom_reports_aggregate',
        'reports_pl'                       => 'reports_pl',
        'reports_bs'                       => 'reports_bs',
        'reports_general_ledgers'          => 'reports_general_ledgers',
        'reports_journals'                 => 'reports_journals',
        'manual_journals'                  => 'manual_journals',
        'fixed_assets'                     => 'fixed_assets',
        'inventory_refreshes'              => 'inventory_refreshes',
        'biz_allocations'                  => 'biz_allocations',
        'payment_records'                  => 'payment_records',
        'annual_reports'                   => 'annual_reports',
        'tax_reports'                      => 'tax_reports',
        'consumption_entries'              => 'consumption_entries',
        'tax_return'                       => 'tax_return',
        'account_item_statements'          => 'account_item_statements',
        'month_end'                        => 'month_end',
        'year_end'                         => 'year_end',
        'walletables'                      => 'walletables',
        'companies'                        => 'companies',
        'invitations'                      => 'invitations',
        'access_controls'                  => 'access_controls',
        'sign_in_logs'                     => 'sign_in_logs',
        'user_attribute_logs'              => 'user_attribute_logs',
        'app_role_logs'                    => 'app_role_logs',
        'txn_relationship_logs'            => 'txn_relationship_logs',
        'backups'                          => 'backups',
        'opening_balances'                 => 'opening_balances',
        'system_conversion'                => 'system_conversion',
        'resets'                           => 'resets',
        'partners'                         => 'partners',
        'items'                            => 'items',
        'sections'                         => 'sections',
        'tags'                             => 'tags',
        'account_items'                    => 'account_items',
        'taxes'                            => 'taxes',
        'payroll_item_sets'                => 'payroll_item_sets',
        'user_matchers'                    => 'user_matchers',
        'deal_templates'                   => 'deal_templates',
        'manual_journal_templates'         => 'manual_journal_templates',
        'cost_allocations'                 => 'cost_allocations',
        'approval_flow_routes'             => 'approval_flow_routes',
        'expense_application_templates'    => 'expense_application_templates',
        'request_forms'                    => 'request_forms',
        'system_messages_for_admin'        => 'system_messages_for_admin',
        'company_internal_announcements'   => 'company_internal_announcements',
        'doc_change_logs'                  => 'doc_change_logs',
        'workflows'                        => 'workflows',
        'oauth_applications'               => 'oauth_applications',
        'oauth_authorizations'             => 'oauth_authorizations',
        'bank_accountant_staff_users'      => 'bank_accountant_staff_users',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'wallet_txns'                      => 'setWalletTxns',
        'deals'                            => 'setDeals',
        'transfers'                        => 'setTransfers',
        'docs'                             => 'setDocs',
        'doc_postings'                     => 'setDocPostings',
        'receipts'                         => 'setReceipts',
        'receipt_stream_editor'            => 'setReceiptStreamEditor',
        'spreadsheets'                     => 'setSpreadsheets',
        'expense_applications'             => 'setExpenseApplications',
        'expense_application_sync_payroll' => 'setExpenseApplicationSyncPayroll',
        'payment_requests'                 => 'setPaymentRequests',
        'approval_requests'                => 'setApprovalRequests',
        'reports'                          => 'setReports',
        'reports_income_expense'           => 'setReportsIncomeExpense',
        'reports_receivables'              => 'setReportsReceivables',
        'reports_payables'                 => 'setReportsPayables',
        'reports_cash_balance'             => 'setReportsCashBalance',
        'reports_managements_planning'     => 'setReportsManagementsPlanning',
        'reports_managements_navigation'   => 'setReportsManagementsNavigation',
        'reports_custom_reports_aggregate' => 'setReportsCustomReportsAggregate',
        'reports_pl'                       => 'setReportsPl',
        'reports_bs'                       => 'setReportsBs',
        'reports_general_ledgers'          => 'setReportsGeneralLedgers',
        'reports_journals'                 => 'setReportsJournals',
        'manual_journals'                  => 'setManualJournals',
        'fixed_assets'                     => 'setFixedAssets',
        'inventory_refreshes'              => 'setInventoryRefreshes',
        'biz_allocations'                  => 'setBizAllocations',
        'payment_records'                  => 'setPaymentRecords',
        'annual_reports'                   => 'setAnnualReports',
        'tax_reports'                      => 'setTaxReports',
        'consumption_entries'              => 'setConsumptionEntries',
        'tax_return'                       => 'setTaxReturn',
        'account_item_statements'          => 'setAccountItemStatements',
        'month_end'                        => 'setMonthEnd',
        'year_end'                         => 'setYearEnd',
        'walletables'                      => 'setWalletables',
        'companies'                        => 'setCompanies',
        'invitations'                      => 'setInvitations',
        'access_controls'                  => 'setAccessControls',
        'sign_in_logs'                     => 'setSignInLogs',
        'user_attribute_logs'              => 'setUserAttributeLogs',
        'app_role_logs'                    => 'setAppRoleLogs',
        'txn_relationship_logs'            => 'setTxnRelationshipLogs',
        'backups'                          => 'setBackups',
        'opening_balances'                 => 'setOpeningBalances',
        'system_conversion'                => 'setSystemConversion',
        'resets'                           => 'setResets',
        'partners'                         => 'setPartners',
        'items'                            => 'setItems',
        'sections'                         => 'setSections',
        'tags'                             => 'setTags',
        'account_items'                    => 'setAccountItems',
        'taxes'                            => 'setTaxes',
        'payroll_item_sets'                => 'setPayrollItemSets',
        'user_matchers'                    => 'setUserMatchers',
        'deal_templates'                   => 'setDealTemplates',
        'manual_journal_templates'         => 'setManualJournalTemplates',
        'cost_allocations'                 => 'setCostAllocations',
        'approval_flow_routes'             => 'setApprovalFlowRoutes',
        'expense_application_templates'    => 'setExpenseApplicationTemplates',
        'request_forms'                    => 'setRequestForms',
        'system_messages_for_admin'        => 'setSystemMessagesForAdmin',
        'company_internal_announcements'   => 'setCompanyInternalAnnouncements',
        'doc_change_logs'                  => 'setDocChangeLogs',
        'workflows'                        => 'setWorkflows',
        'oauth_applications'               => 'setOauthApplications',
        'oauth_authorizations'             => 'setOauthAuthorizations',
        'bank_accountant_staff_users'      => 'setBankAccountantStaffUsers',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'wallet_txns'                      => 'getWalletTxns',
        'deals'                            => 'getDeals',
        'transfers'                        => 'getTransfers',
        'docs'                             => 'getDocs',
        'doc_postings'                     => 'getDocPostings',
        'receipts'                         => 'getReceipts',
        'receipt_stream_editor'            => 'getReceiptStreamEditor',
        'spreadsheets'                     => 'getSpreadsheets',
        'expense_applications'             => 'getExpenseApplications',
        'expense_application_sync_payroll' => 'getExpenseApplicationSyncPayroll',
        'payment_requests'                 => 'getPaymentRequests',
        'approval_requests'                => 'getApprovalRequests',
        'reports'                          => 'getReports',
        'reports_income_expense'           => 'getReportsIncomeExpense',
        'reports_receivables'              => 'getReportsReceivables',
        'reports_payables'                 => 'getReportsPayables',
        'reports_cash_balance'             => 'getReportsCashBalance',
        'reports_managements_planning'     => 'getReportsManagementsPlanning',
        'reports_managements_navigation'   => 'getReportsManagementsNavigation',
        'reports_custom_reports_aggregate' => 'getReportsCustomReportsAggregate',
        'reports_pl'                       => 'getReportsPl',
        'reports_bs'                       => 'getReportsBs',
        'reports_general_ledgers'          => 'getReportsGeneralLedgers',
        'reports_journals'                 => 'getReportsJournals',
        'manual_journals'                  => 'getManualJournals',
        'fixed_assets'                     => 'getFixedAssets',
        'inventory_refreshes'              => 'getInventoryRefreshes',
        'biz_allocations'                  => 'getBizAllocations',
        'payment_records'                  => 'getPaymentRecords',
        'annual_reports'                   => 'getAnnualReports',
        'tax_reports'                      => 'getTaxReports',
        'consumption_entries'              => 'getConsumptionEntries',
        'tax_return'                       => 'getTaxReturn',
        'account_item_statements'          => 'getAccountItemStatements',
        'month_end'                        => 'getMonthEnd',
        'year_end'                         => 'getYearEnd',
        'walletables'                      => 'getWalletables',
        'companies'                        => 'getCompanies',
        'invitations'                      => 'getInvitations',
        'access_controls'                  => 'getAccessControls',
        'sign_in_logs'                     => 'getSignInLogs',
        'user_attribute_logs'              => 'getUserAttributeLogs',
        'app_role_logs'                    => 'getAppRoleLogs',
        'txn_relationship_logs'            => 'getTxnRelationshipLogs',
        'backups'                          => 'getBackups',
        'opening_balances'                 => 'getOpeningBalances',
        'system_conversion'                => 'getSystemConversion',
        'resets'                           => 'getResets',
        'partners'                         => 'getPartners',
        'items'                            => 'getItems',
        'sections'                         => 'getSections',
        'tags'                             => 'getTags',
        'account_items'                    => 'getAccountItems',
        'taxes'                            => 'getTaxes',
        'payroll_item_sets'                => 'getPayrollItemSets',
        'user_matchers'                    => 'getUserMatchers',
        'deal_templates'                   => 'getDealTemplates',
        'manual_journal_templates'         => 'getManualJournalTemplates',
        'cost_allocations'                 => 'getCostAllocations',
        'approval_flow_routes'             => 'getApprovalFlowRoutes',
        'expense_application_templates'    => 'getExpenseApplicationTemplates',
        'request_forms'                    => 'getRequestForms',
        'system_messages_for_admin'        => 'getSystemMessagesForAdmin',
        'company_internal_announcements'   => 'getCompanyInternalAnnouncements',
        'doc_change_logs'                  => 'getDocChangeLogs',
        'workflows'                        => 'getWorkflows',
        'oauth_applications'               => 'getOauthApplications',
        'oauth_authorizations'             => 'getOauthAuthorizations',
        'bank_accountant_staff_users'      => 'getBankAccountantStaffUsers',
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
        $this->container['wallet_txns']                      = $data['wallet_txns'] ?? null;
        $this->container['deals']                            = $data['deals'] ?? null;
        $this->container['transfers']                        = $data['transfers'] ?? null;
        $this->container['docs']                             = $data['docs'] ?? null;
        $this->container['doc_postings']                     = $data['doc_postings'] ?? null;
        $this->container['receipts']                         = $data['receipts'] ?? null;
        $this->container['receipt_stream_editor']            = $data['receipt_stream_editor'] ?? null;
        $this->container['spreadsheets']                     = $data['spreadsheets'] ?? null;
        $this->container['expense_applications']             = $data['expense_applications'] ?? null;
        $this->container['expense_application_sync_payroll'] = $data['expense_application_sync_payroll'] ?? null;
        $this->container['payment_requests']                 = $data['payment_requests'] ?? null;
        $this->container['approval_requests']                = $data['approval_requests'] ?? null;
        $this->container['reports']                          = $data['reports'] ?? null;
        $this->container['reports_income_expense']           = $data['reports_income_expense'] ?? null;
        $this->container['reports_receivables']              = $data['reports_receivables'] ?? null;
        $this->container['reports_payables']                 = $data['reports_payables'] ?? null;
        $this->container['reports_cash_balance']             = $data['reports_cash_balance'] ?? null;
        $this->container['reports_managements_planning']     = $data['reports_managements_planning'] ?? null;
        $this->container['reports_managements_navigation']   = $data['reports_managements_navigation'] ?? null;
        $this->container['reports_custom_reports_aggregate'] = $data['reports_custom_reports_aggregate'] ?? null;
        $this->container['reports_pl']                       = $data['reports_pl'] ?? null;
        $this->container['reports_bs']                       = $data['reports_bs'] ?? null;
        $this->container['reports_general_ledgers']          = $data['reports_general_ledgers'] ?? null;
        $this->container['reports_journals']                 = $data['reports_journals'] ?? null;
        $this->container['manual_journals']                  = $data['manual_journals'] ?? null;
        $this->container['fixed_assets']                     = $data['fixed_assets'] ?? null;
        $this->container['inventory_refreshes']              = $data['inventory_refreshes'] ?? null;
        $this->container['biz_allocations']                  = $data['biz_allocations'] ?? null;
        $this->container['payment_records']                  = $data['payment_records'] ?? null;
        $this->container['annual_reports']                   = $data['annual_reports'] ?? null;
        $this->container['tax_reports']                      = $data['tax_reports'] ?? null;
        $this->container['consumption_entries']              = $data['consumption_entries'] ?? null;
        $this->container['tax_return']                       = $data['tax_return'] ?? null;
        $this->container['account_item_statements']          = $data['account_item_statements'] ?? null;
        $this->container['month_end']                        = $data['month_end'] ?? null;
        $this->container['year_end']                         = $data['year_end'] ?? null;
        $this->container['walletables']                      = $data['walletables'] ?? null;
        $this->container['companies']                        = $data['companies'] ?? null;
        $this->container['invitations']                      = $data['invitations'] ?? null;
        $this->container['access_controls']                  = $data['access_controls'] ?? null;
        $this->container['sign_in_logs']                     = $data['sign_in_logs'] ?? null;
        $this->container['user_attribute_logs']              = $data['user_attribute_logs'] ?? null;
        $this->container['app_role_logs']                    = $data['app_role_logs'] ?? null;
        $this->container['txn_relationship_logs']            = $data['txn_relationship_logs'] ?? null;
        $this->container['backups']                          = $data['backups'] ?? null;
        $this->container['opening_balances']                 = $data['opening_balances'] ?? null;
        $this->container['system_conversion']                = $data['system_conversion'] ?? null;
        $this->container['resets']                           = $data['resets'] ?? null;
        $this->container['partners']                         = $data['partners'] ?? null;
        $this->container['items']                            = $data['items'] ?? null;
        $this->container['sections']                         = $data['sections'] ?? null;
        $this->container['tags']                             = $data['tags'] ?? null;
        $this->container['account_items']                    = $data['account_items'] ?? null;
        $this->container['taxes']                            = $data['taxes'] ?? null;
        $this->container['payroll_item_sets']                = $data['payroll_item_sets'] ?? null;
        $this->container['user_matchers']                    = $data['user_matchers'] ?? null;
        $this->container['deal_templates']                   = $data['deal_templates'] ?? null;
        $this->container['manual_journal_templates']         = $data['manual_journal_templates'] ?? null;
        $this->container['cost_allocations']                 = $data['cost_allocations'] ?? null;
        $this->container['approval_flow_routes']             = $data['approval_flow_routes'] ?? null;
        $this->container['expense_application_templates']    = $data['expense_application_templates'] ?? null;
        $this->container['request_forms']                    = $data['request_forms'] ?? null;
        $this->container['system_messages_for_admin']        = $data['system_messages_for_admin'] ?? null;
        $this->container['company_internal_announcements']   = $data['company_internal_announcements'] ?? null;
        $this->container['doc_change_logs']                  = $data['doc_change_logs'] ?? null;
        $this->container['workflows']                        = $data['workflows'] ?? null;
        $this->container['oauth_applications']               = $data['oauth_applications'] ?? null;
        $this->container['oauth_authorizations']             = $data['oauth_authorizations'] ?? null;
        $this->container['bank_accountant_staff_users']      = $data['bank_accountant_staff_users'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['wallet_txns'] === null) {
            $invalidProperties[] = "'wallet_txns' can't be null";
        }
        if ($this->container['deals'] === null) {
            $invalidProperties[] = "'deals' can't be null";
        }
        if ($this->container['transfers'] === null) {
            $invalidProperties[] = "'transfers' can't be null";
        }
        if ($this->container['docs'] === null) {
            $invalidProperties[] = "'docs' can't be null";
        }
        if ($this->container['doc_postings'] === null) {
            $invalidProperties[] = "'doc_postings' can't be null";
        }
        if ($this->container['receipts'] === null) {
            $invalidProperties[] = "'receipts' can't be null";
        }
        if ($this->container['receipt_stream_editor'] === null) {
            $invalidProperties[] = "'receipt_stream_editor' can't be null";
        }
        if ($this->container['spreadsheets'] === null) {
            $invalidProperties[] = "'spreadsheets' can't be null";
        }
        if ($this->container['expense_applications'] === null) {
            $invalidProperties[] = "'expense_applications' can't be null";
        }
        if ($this->container['expense_application_sync_payroll'] === null) {
            $invalidProperties[] = "'expense_application_sync_payroll' can't be null";
        }
        if ($this->container['payment_requests'] === null) {
            $invalidProperties[] = "'payment_requests' can't be null";
        }
        if ($this->container['approval_requests'] === null) {
            $invalidProperties[] = "'approval_requests' can't be null";
        }
        if ($this->container['reports'] === null) {
            $invalidProperties[] = "'reports' can't be null";
        }
        if ($this->container['reports_income_expense'] === null) {
            $invalidProperties[] = "'reports_income_expense' can't be null";
        }
        if ($this->container['reports_receivables'] === null) {
            $invalidProperties[] = "'reports_receivables' can't be null";
        }
        if ($this->container['reports_payables'] === null) {
            $invalidProperties[] = "'reports_payables' can't be null";
        }
        if ($this->container['reports_cash_balance'] === null) {
            $invalidProperties[] = "'reports_cash_balance' can't be null";
        }
        if ($this->container['reports_managements_planning'] === null) {
            $invalidProperties[] = "'reports_managements_planning' can't be null";
        }
        if ($this->container['reports_managements_navigation'] === null) {
            $invalidProperties[] = "'reports_managements_navigation' can't be null";
        }
        if ($this->container['reports_custom_reports_aggregate'] === null) {
            $invalidProperties[] = "'reports_custom_reports_aggregate' can't be null";
        }
        if ($this->container['reports_pl'] === null) {
            $invalidProperties[] = "'reports_pl' can't be null";
        }
        if ($this->container['reports_bs'] === null) {
            $invalidProperties[] = "'reports_bs' can't be null";
        }
        if ($this->container['reports_general_ledgers'] === null) {
            $invalidProperties[] = "'reports_general_ledgers' can't be null";
        }
        if ($this->container['reports_journals'] === null) {
            $invalidProperties[] = "'reports_journals' can't be null";
        }
        if ($this->container['manual_journals'] === null) {
            $invalidProperties[] = "'manual_journals' can't be null";
        }
        if ($this->container['fixed_assets'] === null) {
            $invalidProperties[] = "'fixed_assets' can't be null";
        }
        if ($this->container['inventory_refreshes'] === null) {
            $invalidProperties[] = "'inventory_refreshes' can't be null";
        }
        if ($this->container['biz_allocations'] === null) {
            $invalidProperties[] = "'biz_allocations' can't be null";
        }
        if ($this->container['payment_records'] === null) {
            $invalidProperties[] = "'payment_records' can't be null";
        }
        if ($this->container['annual_reports'] === null) {
            $invalidProperties[] = "'annual_reports' can't be null";
        }
        if ($this->container['tax_reports'] === null) {
            $invalidProperties[] = "'tax_reports' can't be null";
        }
        if ($this->container['consumption_entries'] === null) {
            $invalidProperties[] = "'consumption_entries' can't be null";
        }
        if ($this->container['tax_return'] === null) {
            $invalidProperties[] = "'tax_return' can't be null";
        }
        if ($this->container['account_item_statements'] === null) {
            $invalidProperties[] = "'account_item_statements' can't be null";
        }
        if ($this->container['month_end'] === null) {
            $invalidProperties[] = "'month_end' can't be null";
        }
        if ($this->container['year_end'] === null) {
            $invalidProperties[] = "'year_end' can't be null";
        }
        if ($this->container['walletables'] === null) {
            $invalidProperties[] = "'walletables' can't be null";
        }
        if ($this->container['companies'] === null) {
            $invalidProperties[] = "'companies' can't be null";
        }
        if ($this->container['invitations'] === null) {
            $invalidProperties[] = "'invitations' can't be null";
        }
        if ($this->container['access_controls'] === null) {
            $invalidProperties[] = "'access_controls' can't be null";
        }
        if ($this->container['sign_in_logs'] === null) {
            $invalidProperties[] = "'sign_in_logs' can't be null";
        }
        if ($this->container['user_attribute_logs'] === null) {
            $invalidProperties[] = "'user_attribute_logs' can't be null";
        }
        if ($this->container['app_role_logs'] === null) {
            $invalidProperties[] = "'app_role_logs' can't be null";
        }
        if ($this->container['txn_relationship_logs'] === null) {
            $invalidProperties[] = "'txn_relationship_logs' can't be null";
        }
        if ($this->container['backups'] === null) {
            $invalidProperties[] = "'backups' can't be null";
        }
        if ($this->container['opening_balances'] === null) {
            $invalidProperties[] = "'opening_balances' can't be null";
        }
        if ($this->container['system_conversion'] === null) {
            $invalidProperties[] = "'system_conversion' can't be null";
        }
        if ($this->container['resets'] === null) {
            $invalidProperties[] = "'resets' can't be null";
        }
        if ($this->container['partners'] === null) {
            $invalidProperties[] = "'partners' can't be null";
        }
        if ($this->container['items'] === null) {
            $invalidProperties[] = "'items' can't be null";
        }
        if ($this->container['sections'] === null) {
            $invalidProperties[] = "'sections' can't be null";
        }
        if ($this->container['tags'] === null) {
            $invalidProperties[] = "'tags' can't be null";
        }
        if ($this->container['account_items'] === null) {
            $invalidProperties[] = "'account_items' can't be null";
        }
        if ($this->container['taxes'] === null) {
            $invalidProperties[] = "'taxes' can't be null";
        }
        if ($this->container['payroll_item_sets'] === null) {
            $invalidProperties[] = "'payroll_item_sets' can't be null";
        }
        if ($this->container['user_matchers'] === null) {
            $invalidProperties[] = "'user_matchers' can't be null";
        }
        if ($this->container['deal_templates'] === null) {
            $invalidProperties[] = "'deal_templates' can't be null";
        }
        if ($this->container['manual_journal_templates'] === null) {
            $invalidProperties[] = "'manual_journal_templates' can't be null";
        }
        if ($this->container['cost_allocations'] === null) {
            $invalidProperties[] = "'cost_allocations' can't be null";
        }
        if ($this->container['approval_flow_routes'] === null) {
            $invalidProperties[] = "'approval_flow_routes' can't be null";
        }
        if ($this->container['expense_application_templates'] === null) {
            $invalidProperties[] = "'expense_application_templates' can't be null";
        }
        if ($this->container['request_forms'] === null) {
            $invalidProperties[] = "'request_forms' can't be null";
        }
        if ($this->container['system_messages_for_admin'] === null) {
            $invalidProperties[] = "'system_messages_for_admin' can't be null";
        }
        if ($this->container['company_internal_announcements'] === null) {
            $invalidProperties[] = "'company_internal_announcements' can't be null";
        }
        if ($this->container['doc_change_logs'] === null) {
            $invalidProperties[] = "'doc_change_logs' can't be null";
        }
        if ($this->container['workflows'] === null) {
            $invalidProperties[] = "'workflows' can't be null";
        }
        if ($this->container['oauth_applications'] === null) {
            $invalidProperties[] = "'oauth_applications' can't be null";
        }
        if ($this->container['oauth_authorizations'] === null) {
            $invalidProperties[] = "'oauth_authorizations' can't be null";
        }
        if ($this->container['bank_accountant_staff_users'] === null) {
            $invalidProperties[] = "'bank_accountant_staff_users' can't be null";
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
     * Gets wallet_txns.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityWithConfirm
     */
    public function getWalletTxns()
    {
        return $this->container['wallet_txns'];
    }

    /**
     * Sets wallet_txns.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityWithConfirm $wallet_txns wallet_txns
     *
     * @return self
     */
    public function setWalletTxns($wallet_txns)
    {
        $this->container['wallet_txns'] = $wallet_txns;

        return $this;
    }

    /**
     * Gets deals.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityWithSelfOnly
     */
    public function getDeals()
    {
        return $this->container['deals'];
    }

    /**
     * Sets deals.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityWithSelfOnly $deals deals
     *
     * @return self
     */
    public function setDeals($deals)
    {
        $this->container['deals'] = $deals;

        return $this;
    }

    /**
     * Gets transfers.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityWithSelfOnly
     */
    public function getTransfers()
    {
        return $this->container['transfers'];
    }

    /**
     * Sets transfers.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityWithSelfOnly $transfers transfers
     *
     * @return self
     */
    public function setTransfers($transfers)
    {
        $this->container['transfers'] = $transfers;

        return $this;
    }

    /**
     * Gets docs.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityWithSelfOnly
     */
    public function getDocs()
    {
        return $this->container['docs'];
    }

    /**
     * Sets docs.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityWithSelfOnly $docs docs
     *
     * @return self
     */
    public function setDocs($docs)
    {
        $this->container['docs'] = $docs;

        return $this;
    }

    /**
     * Gets doc_postings.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustCreate
     */
    public function getDocPostings()
    {
        return $this->container['doc_postings'];
    }

    /**
     * Sets doc_postings.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustCreate $doc_postings doc_postings
     *
     * @return self
     */
    public function setDocPostings($doc_postings)
    {
        $this->container['doc_postings'] = $doc_postings;

        return $this;
    }

    /**
     * Gets receipts.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityWithSelfOnly
     */
    public function getReceipts()
    {
        return $this->container['receipts'];
    }

    /**
     * Sets receipts.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityWithSelfOnly $receipts receipts
     *
     * @return self
     */
    public function setReceipts($receipts)
    {
        $this->container['receipts'] = $receipts;

        return $this;
    }

    /**
     * Gets receipt_stream_editor.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getReceiptStreamEditor()
    {
        return $this->container['receipt_stream_editor'];
    }

    /**
     * Sets receipt_stream_editor.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $receipt_stream_editor receipt_stream_editor
     *
     * @return self
     */
    public function setReceiptStreamEditor($receipt_stream_editor)
    {
        $this->container['receipt_stream_editor'] = $receipt_stream_editor;

        return $this;
    }

    /**
     * Gets spreadsheets.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustCreateRead
     */
    public function getSpreadsheets()
    {
        return $this->container['spreadsheets'];
    }

    /**
     * Sets spreadsheets.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustCreateRead $spreadsheets spreadsheets
     *
     * @return self
     */
    public function setSpreadsheets($spreadsheets)
    {
        $this->container['spreadsheets'] = $spreadsheets;

        return $this;
    }

    /**
     * Gets expense_applications.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityWithSelfOnly
     */
    public function getExpenseApplications()
    {
        return $this->container['expense_applications'];
    }

    /**
     * Sets expense_applications.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityWithSelfOnly $expense_applications expense_applications
     *
     * @return self
     */
    public function setExpenseApplications($expense_applications)
    {
        $this->container['expense_applications'] = $expense_applications;

        return $this;
    }

    /**
     * Gets expense_application_sync_payroll.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustCreate
     */
    public function getExpenseApplicationSyncPayroll()
    {
        return $this->container['expense_application_sync_payroll'];
    }

    /**
     * Sets expense_application_sync_payroll.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustCreate $expense_application_sync_payroll expense_application_sync_payroll
     *
     * @return self
     */
    public function setExpenseApplicationSyncPayroll($expense_application_sync_payroll)
    {
        $this->container['expense_application_sync_payroll'] = $expense_application_sync_payroll;

        return $this;
    }

    /**
     * Gets payment_requests.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityWithSelfOnly
     */
    public function getPaymentRequests()
    {
        return $this->container['payment_requests'];
    }

    /**
     * Sets payment_requests.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityWithSelfOnly $payment_requests payment_requests
     *
     * @return self
     */
    public function setPaymentRequests($payment_requests)
    {
        $this->container['payment_requests'] = $payment_requests;

        return $this;
    }

    /**
     * Gets approval_requests.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityWithSelfOnly
     */
    public function getApprovalRequests()
    {
        return $this->container['approval_requests'];
    }

    /**
     * Sets approval_requests.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityWithSelfOnly $approval_requests approval_requests
     *
     * @return self
     */
    public function setApprovalRequests($approval_requests)
    {
        $this->container['approval_requests'] = $approval_requests;

        return $this;
    }

    /**
     * Gets reports.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getReports()
    {
        return $this->container['reports'];
    }

    /**
     * Sets reports.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $reports reports
     *
     * @return self
     */
    public function setReports($reports)
    {
        $this->container['reports'] = $reports;

        return $this;
    }

    /**
     * Gets reports_income_expense.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getReportsIncomeExpense()
    {
        return $this->container['reports_income_expense'];
    }

    /**
     * Sets reports_income_expense.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $reports_income_expense reports_income_expense
     *
     * @return self
     */
    public function setReportsIncomeExpense($reports_income_expense)
    {
        $this->container['reports_income_expense'] = $reports_income_expense;

        return $this;
    }

    /**
     * Gets reports_receivables.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getReportsReceivables()
    {
        return $this->container['reports_receivables'];
    }

    /**
     * Sets reports_receivables.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $reports_receivables reports_receivables
     *
     * @return self
     */
    public function setReportsReceivables($reports_receivables)
    {
        $this->container['reports_receivables'] = $reports_receivables;

        return $this;
    }

    /**
     * Gets reports_payables.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustReadWrite
     */
    public function getReportsPayables()
    {
        return $this->container['reports_payables'];
    }

    /**
     * Sets reports_payables.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustReadWrite $reports_payables reports_payables
     *
     * @return self
     */
    public function setReportsPayables($reports_payables)
    {
        $this->container['reports_payables'] = $reports_payables;

        return $this;
    }

    /**
     * Gets reports_cash_balance.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getReportsCashBalance()
    {
        return $this->container['reports_cash_balance'];
    }

    /**
     * Sets reports_cash_balance.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $reports_cash_balance reports_cash_balance
     *
     * @return self
     */
    public function setReportsCashBalance($reports_cash_balance)
    {
        $this->container['reports_cash_balance'] = $reports_cash_balance;

        return $this;
    }

    /**
     * Gets reports_managements_planning.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustReadWrite
     */
    public function getReportsManagementsPlanning()
    {
        return $this->container['reports_managements_planning'];
    }

    /**
     * Sets reports_managements_planning.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustReadWrite $reports_managements_planning reports_managements_planning
     *
     * @return self
     */
    public function setReportsManagementsPlanning($reports_managements_planning)
    {
        $this->container['reports_managements_planning'] = $reports_managements_planning;

        return $this;
    }

    /**
     * Gets reports_managements_navigation.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustReadWrite
     */
    public function getReportsManagementsNavigation()
    {
        return $this->container['reports_managements_navigation'];
    }

    /**
     * Sets reports_managements_navigation.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustReadWrite $reports_managements_navigation reports_managements_navigation
     *
     * @return self
     */
    public function setReportsManagementsNavigation($reports_managements_navigation)
    {
        $this->container['reports_managements_navigation'] = $reports_managements_navigation;

        return $this;
    }

    /**
     * Gets reports_custom_reports_aggregate.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getReportsCustomReportsAggregate()
    {
        return $this->container['reports_custom_reports_aggregate'];
    }

    /**
     * Sets reports_custom_reports_aggregate.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $reports_custom_reports_aggregate reports_custom_reports_aggregate
     *
     * @return self
     */
    public function setReportsCustomReportsAggregate($reports_custom_reports_aggregate)
    {
        $this->container['reports_custom_reports_aggregate'] = $reports_custom_reports_aggregate;

        return $this;
    }

    /**
     * Gets reports_pl.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getReportsPl()
    {
        return $this->container['reports_pl'];
    }

    /**
     * Sets reports_pl.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $reports_pl reports_pl
     *
     * @return self
     */
    public function setReportsPl($reports_pl)
    {
        $this->container['reports_pl'] = $reports_pl;

        return $this;
    }

    /**
     * Gets reports_bs.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getReportsBs()
    {
        return $this->container['reports_bs'];
    }

    /**
     * Sets reports_bs.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $reports_bs reports_bs
     *
     * @return self
     */
    public function setReportsBs($reports_bs)
    {
        $this->container['reports_bs'] = $reports_bs;

        return $this;
    }

    /**
     * Gets reports_general_ledgers.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getReportsGeneralLedgers()
    {
        return $this->container['reports_general_ledgers'];
    }

    /**
     * Sets reports_general_ledgers.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $reports_general_ledgers reports_general_ledgers
     *
     * @return self
     */
    public function setReportsGeneralLedgers($reports_general_ledgers)
    {
        $this->container['reports_general_ledgers'] = $reports_general_ledgers;

        return $this;
    }

    /**
     * Gets reports_journals.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getReportsJournals()
    {
        return $this->container['reports_journals'];
    }

    /**
     * Sets reports_journals.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $reports_journals reports_journals
     *
     * @return self
     */
    public function setReportsJournals($reports_journals)
    {
        $this->container['reports_journals'] = $reports_journals;

        return $this;
    }

    /**
     * Gets manual_journals.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityWithSelfOnly
     */
    public function getManualJournals()
    {
        return $this->container['manual_journals'];
    }

    /**
     * Sets manual_journals.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityWithSelfOnly $manual_journals manual_journals
     *
     * @return self
     */
    public function setManualJournals($manual_journals)
    {
        $this->container['manual_journals'] = $manual_journals;

        return $this;
    }

    /**
     * Gets fixed_assets.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getFixedAssets()
    {
        return $this->container['fixed_assets'];
    }

    /**
     * Sets fixed_assets.
     *
     * @param \OpenAPI\Client\Model\UserCapability $fixed_assets fixed_assets
     *
     * @return self
     */
    public function setFixedAssets($fixed_assets)
    {
        $this->container['fixed_assets'] = $fixed_assets;

        return $this;
    }

    /**
     * Gets inventory_refreshes.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getInventoryRefreshes()
    {
        return $this->container['inventory_refreshes'];
    }

    /**
     * Sets inventory_refreshes.
     *
     * @param \OpenAPI\Client\Model\UserCapability $inventory_refreshes inventory_refreshes
     *
     * @return self
     */
    public function setInventoryRefreshes($inventory_refreshes)
    {
        $this->container['inventory_refreshes'] = $inventory_refreshes;

        return $this;
    }

    /**
     * Gets biz_allocations.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getBizAllocations()
    {
        return $this->container['biz_allocations'];
    }

    /**
     * Sets biz_allocations.
     *
     * @param \OpenAPI\Client\Model\UserCapability $biz_allocations biz_allocations
     *
     * @return self
     */
    public function setBizAllocations($biz_allocations)
    {
        $this->container['biz_allocations'] = $biz_allocations;

        return $this;
    }

    /**
     * Gets payment_records.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getPaymentRecords()
    {
        return $this->container['payment_records'];
    }

    /**
     * Sets payment_records.
     *
     * @param \OpenAPI\Client\Model\UserCapability $payment_records payment_records
     *
     * @return self
     */
    public function setPaymentRecords($payment_records)
    {
        $this->container['payment_records'] = $payment_records;

        return $this;
    }

    /**
     * Gets annual_reports.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getAnnualReports()
    {
        return $this->container['annual_reports'];
    }

    /**
     * Sets annual_reports.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $annual_reports annual_reports
     *
     * @return self
     */
    public function setAnnualReports($annual_reports)
    {
        $this->container['annual_reports'] = $annual_reports;

        return $this;
    }

    /**
     * Gets tax_reports.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getTaxReports()
    {
        return $this->container['tax_reports'];
    }

    /**
     * Sets tax_reports.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $tax_reports tax_reports
     *
     * @return self
     */
    public function setTaxReports($tax_reports)
    {
        $this->container['tax_reports'] = $tax_reports;

        return $this;
    }

    /**
     * Gets consumption_entries.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getConsumptionEntries()
    {
        return $this->container['consumption_entries'];
    }

    /**
     * Sets consumption_entries.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $consumption_entries consumption_entries
     *
     * @return self
     */
    public function setConsumptionEntries($consumption_entries)
    {
        $this->container['consumption_entries'] = $consumption_entries;

        return $this;
    }

    /**
     * Gets tax_return.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getTaxReturn()
    {
        return $this->container['tax_return'];
    }

    /**
     * Sets tax_return.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $tax_return tax_return
     *
     * @return self
     */
    public function setTaxReturn($tax_return)
    {
        $this->container['tax_return'] = $tax_return;

        return $this;
    }

    /**
     * Gets account_item_statements.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getAccountItemStatements()
    {
        return $this->container['account_item_statements'];
    }

    /**
     * Sets account_item_statements.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $account_item_statements account_item_statements
     *
     * @return self
     */
    public function setAccountItemStatements($account_item_statements)
    {
        $this->container['account_item_statements'] = $account_item_statements;

        return $this;
    }

    /**
     * Gets month_end.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getMonthEnd()
    {
        return $this->container['month_end'];
    }

    /**
     * Sets month_end.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $month_end month_end
     *
     * @return self
     */
    public function setMonthEnd($month_end)
    {
        $this->container['month_end'] = $month_end;

        return $this;
    }

    /**
     * Gets year_end.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustReadUpdate
     */
    public function getYearEnd()
    {
        return $this->container['year_end'];
    }

    /**
     * Sets year_end.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustReadUpdate $year_end year_end
     *
     * @return self
     */
    public function setYearEnd($year_end)
    {
        $this->container['year_end'] = $year_end;

        return $this;
    }

    /**
     * Gets walletables.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityWithSync
     */
    public function getWalletables()
    {
        return $this->container['walletables'];
    }

    /**
     * Sets walletables.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityWithSync $walletables walletables
     *
     * @return self
     */
    public function setWalletables($walletables)
    {
        $this->container['walletables'] = $walletables;

        return $this;
    }

    /**
     * Gets companies.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustReadUpdate
     */
    public function getCompanies()
    {
        return $this->container['companies'];
    }

    /**
     * Sets companies.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustReadUpdate $companies companies
     *
     * @return self
     */
    public function setCompanies($companies)
    {
        $this->container['companies'] = $companies;

        return $this;
    }

    /**
     * Gets invitations.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getInvitations()
    {
        return $this->container['invitations'];
    }

    /**
     * Sets invitations.
     *
     * @param \OpenAPI\Client\Model\UserCapability $invitations invitations
     *
     * @return self
     */
    public function setInvitations($invitations)
    {
        $this->container['invitations'] = $invitations;

        return $this;
    }

    /**
     * Gets access_controls.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityWithWrite
     */
    public function getAccessControls()
    {
        return $this->container['access_controls'];
    }

    /**
     * Sets access_controls.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityWithWrite $access_controls access_controls
     *
     * @return self
     */
    public function setAccessControls($access_controls)
    {
        $this->container['access_controls'] = $access_controls;

        return $this;
    }

    /**
     * Gets sign_in_logs.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getSignInLogs()
    {
        return $this->container['sign_in_logs'];
    }

    /**
     * Sets sign_in_logs.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $sign_in_logs sign_in_logs
     *
     * @return self
     */
    public function setSignInLogs($sign_in_logs)
    {
        $this->container['sign_in_logs'] = $sign_in_logs;

        return $this;
    }

    /**
     * Gets user_attribute_logs.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getUserAttributeLogs()
    {
        return $this->container['user_attribute_logs'];
    }

    /**
     * Sets user_attribute_logs.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $user_attribute_logs user_attribute_logs
     *
     * @return self
     */
    public function setUserAttributeLogs($user_attribute_logs)
    {
        $this->container['user_attribute_logs'] = $user_attribute_logs;

        return $this;
    }

    /**
     * Gets app_role_logs.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getAppRoleLogs()
    {
        return $this->container['app_role_logs'];
    }

    /**
     * Sets app_role_logs.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $app_role_logs app_role_logs
     *
     * @return self
     */
    public function setAppRoleLogs($app_role_logs)
    {
        $this->container['app_role_logs'] = $app_role_logs;

        return $this;
    }

    /**
     * Gets txn_relationship_logs.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getTxnRelationshipLogs()
    {
        return $this->container['txn_relationship_logs'];
    }

    /**
     * Sets txn_relationship_logs.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $txn_relationship_logs txn_relationship_logs
     *
     * @return self
     */
    public function setTxnRelationshipLogs($txn_relationship_logs)
    {
        $this->container['txn_relationship_logs'] = $txn_relationship_logs;

        return $this;
    }

    /**
     * Gets backups.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getBackups()
    {
        return $this->container['backups'];
    }

    /**
     * Sets backups.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $backups backups
     *
     * @return self
     */
    public function setBackups($backups)
    {
        $this->container['backups'] = $backups;

        return $this;
    }

    /**
     * Gets opening_balances.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustReadUpdate
     */
    public function getOpeningBalances()
    {
        return $this->container['opening_balances'];
    }

    /**
     * Sets opening_balances.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustReadUpdate $opening_balances opening_balances
     *
     * @return self
     */
    public function setOpeningBalances($opening_balances)
    {
        $this->container['opening_balances'] = $opening_balances;

        return $this;
    }

    /**
     * Gets system_conversion.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getSystemConversion()
    {
        return $this->container['system_conversion'];
    }

    /**
     * Sets system_conversion.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $system_conversion system_conversion
     *
     * @return self
     */
    public function setSystemConversion($system_conversion)
    {
        $this->container['system_conversion'] = $system_conversion;

        return $this;
    }

    /**
     * Gets resets.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getResets()
    {
        return $this->container['resets'];
    }

    /**
     * Sets resets.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $resets resets
     *
     * @return self
     */
    public function setResets($resets)
    {
        $this->container['resets'] = $resets;

        return $this;
    }

    /**
     * Gets partners.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getPartners()
    {
        return $this->container['partners'];
    }

    /**
     * Sets partners.
     *
     * @param \OpenAPI\Client\Model\UserCapability $partners partners
     *
     * @return self
     */
    public function setPartners($partners)
    {
        $this->container['partners'] = $partners;

        return $this;
    }

    /**
     * Gets items.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getItems()
    {
        return $this->container['items'];
    }

    /**
     * Sets items.
     *
     * @param \OpenAPI\Client\Model\UserCapability $items items
     *
     * @return self
     */
    public function setItems($items)
    {
        $this->container['items'] = $items;

        return $this;
    }

    /**
     * Gets sections.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getSections()
    {
        return $this->container['sections'];
    }

    /**
     * Sets sections.
     *
     * @param \OpenAPI\Client\Model\UserCapability $sections sections
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
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getTags()
    {
        return $this->container['tags'];
    }

    /**
     * Sets tags.
     *
     * @param \OpenAPI\Client\Model\UserCapability $tags tags
     *
     * @return self
     */
    public function setTags($tags)
    {
        $this->container['tags'] = $tags;

        return $this;
    }

    /**
     * Gets account_items.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getAccountItems()
    {
        return $this->container['account_items'];
    }

    /**
     * Sets account_items.
     *
     * @param \OpenAPI\Client\Model\UserCapability $account_items account_items
     *
     * @return self
     */
    public function setAccountItems($account_items)
    {
        $this->container['account_items'] = $account_items;

        return $this;
    }

    /**
     * Gets taxes.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustReadUpdate
     */
    public function getTaxes()
    {
        return $this->container['taxes'];
    }

    /**
     * Sets taxes.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustReadUpdate $taxes taxes
     *
     * @return self
     */
    public function setTaxes($taxes)
    {
        $this->container['taxes'] = $taxes;

        return $this;
    }

    /**
     * Gets payroll_item_sets.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getPayrollItemSets()
    {
        return $this->container['payroll_item_sets'];
    }

    /**
     * Sets payroll_item_sets.
     *
     * @param \OpenAPI\Client\Model\UserCapability $payroll_item_sets payroll_item_sets
     *
     * @return self
     */
    public function setPayrollItemSets($payroll_item_sets)
    {
        $this->container['payroll_item_sets'] = $payroll_item_sets;

        return $this;
    }

    /**
     * Gets user_matchers.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getUserMatchers()
    {
        return $this->container['user_matchers'];
    }

    /**
     * Sets user_matchers.
     *
     * @param \OpenAPI\Client\Model\UserCapability $user_matchers user_matchers
     *
     * @return self
     */
    public function setUserMatchers($user_matchers)
    {
        $this->container['user_matchers'] = $user_matchers;

        return $this;
    }

    /**
     * Gets deal_templates.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getDealTemplates()
    {
        return $this->container['deal_templates'];
    }

    /**
     * Sets deal_templates.
     *
     * @param \OpenAPI\Client\Model\UserCapability $deal_templates deal_templates
     *
     * @return self
     */
    public function setDealTemplates($deal_templates)
    {
        $this->container['deal_templates'] = $deal_templates;

        return $this;
    }

    /**
     * Gets manual_journal_templates.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getManualJournalTemplates()
    {
        return $this->container['manual_journal_templates'];
    }

    /**
     * Sets manual_journal_templates.
     *
     * @param \OpenAPI\Client\Model\UserCapability $manual_journal_templates manual_journal_templates
     *
     * @return self
     */
    public function setManualJournalTemplates($manual_journal_templates)
    {
        $this->container['manual_journal_templates'] = $manual_journal_templates;

        return $this;
    }

    /**
     * Gets cost_allocations.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustReadUpdate
     */
    public function getCostAllocations()
    {
        return $this->container['cost_allocations'];
    }

    /**
     * Sets cost_allocations.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustReadUpdate $cost_allocations cost_allocations
     *
     * @return self
     */
    public function setCostAllocations($cost_allocations)
    {
        $this->container['cost_allocations'] = $cost_allocations;

        return $this;
    }

    /**
     * Gets approval_flow_routes.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getApprovalFlowRoutes()
    {
        return $this->container['approval_flow_routes'];
    }

    /**
     * Sets approval_flow_routes.
     *
     * @param \OpenAPI\Client\Model\UserCapability $approval_flow_routes approval_flow_routes
     *
     * @return self
     */
    public function setApprovalFlowRoutes($approval_flow_routes)
    {
        $this->container['approval_flow_routes'] = $approval_flow_routes;

        return $this;
    }

    /**
     * Gets expense_application_templates.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getExpenseApplicationTemplates()
    {
        return $this->container['expense_application_templates'];
    }

    /**
     * Sets expense_application_templates.
     *
     * @param \OpenAPI\Client\Model\UserCapability $expense_application_templates expense_application_templates
     *
     * @return self
     */
    public function setExpenseApplicationTemplates($expense_application_templates)
    {
        $this->container['expense_application_templates'] = $expense_application_templates;

        return $this;
    }

    /**
     * Gets request_forms.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getRequestForms()
    {
        return $this->container['request_forms'];
    }

    /**
     * Sets request_forms.
     *
     * @param \OpenAPI\Client\Model\UserCapability $request_forms request_forms
     *
     * @return self
     */
    public function setRequestForms($request_forms)
    {
        $this->container['request_forms'] = $request_forms;

        return $this;
    }

    /**
     * Gets system_messages_for_admin.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getSystemMessagesForAdmin()
    {
        return $this->container['system_messages_for_admin'];
    }

    /**
     * Sets system_messages_for_admin.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $system_messages_for_admin system_messages_for_admin
     *
     * @return self
     */
    public function setSystemMessagesForAdmin($system_messages_for_admin)
    {
        $this->container['system_messages_for_admin'] = $system_messages_for_admin;

        return $this;
    }

    /**
     * Gets company_internal_announcements.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustUpdate
     */
    public function getCompanyInternalAnnouncements()
    {
        return $this->container['company_internal_announcements'];
    }

    /**
     * Sets company_internal_announcements.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustUpdate $company_internal_announcements company_internal_announcements
     *
     * @return self
     */
    public function setCompanyInternalAnnouncements($company_internal_announcements)
    {
        $this->container['company_internal_announcements'] = $company_internal_announcements;

        return $this;
    }

    /**
     * Gets doc_change_logs.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustRead
     */
    public function getDocChangeLogs()
    {
        return $this->container['doc_change_logs'];
    }

    /**
     * Sets doc_change_logs.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustRead $doc_change_logs doc_change_logs
     *
     * @return self
     */
    public function setDocChangeLogs($doc_change_logs)
    {
        $this->container['doc_change_logs'] = $doc_change_logs;

        return $this;
    }

    /**
     * Gets workflows.
     *
     * @return \OpenAPI\Client\Model\UserCapabilityJustReadUpdateDestroy
     */
    public function getWorkflows()
    {
        return $this->container['workflows'];
    }

    /**
     * Sets workflows.
     *
     * @param \OpenAPI\Client\Model\UserCapabilityJustReadUpdateDestroy $workflows workflows
     *
     * @return self
     */
    public function setWorkflows($workflows)
    {
        $this->container['workflows'] = $workflows;

        return $this;
    }

    /**
     * Gets oauth_applications.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getOauthApplications()
    {
        return $this->container['oauth_applications'];
    }

    /**
     * Sets oauth_applications.
     *
     * @param \OpenAPI\Client\Model\UserCapability $oauth_applications oauth_applications
     *
     * @return self
     */
    public function setOauthApplications($oauth_applications)
    {
        $this->container['oauth_applications'] = $oauth_applications;

        return $this;
    }

    /**
     * Gets oauth_authorizations.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getOauthAuthorizations()
    {
        return $this->container['oauth_authorizations'];
    }

    /**
     * Sets oauth_authorizations.
     *
     * @param \OpenAPI\Client\Model\UserCapability $oauth_authorizations oauth_authorizations
     *
     * @return self
     */
    public function setOauthAuthorizations($oauth_authorizations)
    {
        $this->container['oauth_authorizations'] = $oauth_authorizations;

        return $this;
    }

    /**
     * Gets bank_accountant_staff_users.
     *
     * @return \OpenAPI\Client\Model\UserCapability
     */
    public function getBankAccountantStaffUsers()
    {
        return $this->container['bank_accountant_staff_users'];
    }

    /**
     * Sets bank_accountant_staff_users.
     *
     * @param \OpenAPI\Client\Model\UserCapability $bank_accountant_staff_users bank_accountant_staff_users
     *
     * @return self
     */
    public function setBankAccountantStaffUsers($bank_accountant_staff_users)
    {
        $this->container['bank_accountant_staff_users'] = $bank_accountant_staff_users;

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
