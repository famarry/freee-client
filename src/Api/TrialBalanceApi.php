<?php

/**
 * TrialBalanceApi
 * PHP version 7.3.
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
namespace OpenAPI\Client\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\RequestOptions;
use OpenAPI\Client\ApiException;
use OpenAPI\Client\Configuration;
use OpenAPI\Client\HeaderSelector;
use OpenAPI\Client\ObjectSerializer;

/**
 * TrialBalanceApi Class Doc Comment.
 *
 * @category Class
 *
 * @author   OpenAPI Generator team
 *
 * @link     https://openapi-generator.tech
 */
class TrialBalanceApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @var HeaderSelector
     */
    protected $headerSelector;

    /**
     * @var int Host index
     */
    protected $hostIndex;

    /**
     * @param ClientInterface $client
     * @param Configuration   $config
     * @param HeaderSelector  $selector
     * @param int             $hostIndex (Optional) host index to select the list of hosts if defined in the OpenAPI spec
     */
    public function __construct(
        ClientInterface $client = null,
        Configuration $config = null,
        HeaderSelector $selector = null,
        $hostIndex = 0
    ) {
        $this->client         = $client ?: new Client();
        $this->config         = $config ?: new Configuration();
        $this->headerSelector = $selector ?: new HeaderSelector();
        $this->hostIndex      = $hostIndex;
    }

    /**
     * Set the host index.
     *
     * @param int $hostIndex Host index (required)
     */
    public function setHostIndex($hostIndex): void
    {
        $this->hostIndex = $hostIndex;
    }

    /**
     * Get the host index.
     *
     * @return int Host index
     */
    public function getHostIndex()
    {
        return $this->hostIndex;
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation getTrialBs.
     *
     * 貸借対照表の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialBsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialBs($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialBsWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialBsWithHttpInfo.
     *
     * 貸借対照表の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialBsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialBsWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        $request = $this->getTrialBsRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialBsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialBsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialBsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialBsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialBsAsync.
     *
     * 貸借対照表の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialBsAsync($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        return $this->getTrialBsAsyncWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialBsAsyncWithHttpInfo.
     *
     * 貸借対照表の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialBsAsyncWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialBsResponse';
        $request    = $this->getTrialBsRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialBs'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialBsRequest($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialBs'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialBs, must be bigger than or equal to 1.');
        }

        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialBs, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialBs, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialBs, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialBs, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialBs, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialBs, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialBs, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_bs';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialBsThreeYears.
     *
     * 貸借対照表(３期間比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialBsThreeYearsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialBsThreeYears($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialBsThreeYearsWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialBsThreeYearsWithHttpInfo.
     *
     * 貸借対照表(３期間比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialBsThreeYearsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialBsThreeYearsWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        $request = $this->getTrialBsThreeYearsRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialBsThreeYearsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialBsThreeYearsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialBsThreeYearsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialBsThreeYearsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialBsThreeYearsAsync.
     *
     * 貸借対照表(３期間比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialBsThreeYearsAsync($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        return $this->getTrialBsThreeYearsAsyncWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialBsThreeYearsAsyncWithHttpInfo.
     *
     * 貸借対照表(３期間比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialBsThreeYearsAsyncWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialBsThreeYearsResponse';
        $request    = $this->getTrialBsThreeYearsRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialBsThreeYears'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialBsThreeYearsRequest($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialBsThreeYears'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialBsThreeYears, must be bigger than or equal to 1.');
        }

        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialBsThreeYears, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialBsThreeYears, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialBsThreeYears, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialBsThreeYears, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialBsThreeYears, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialBsThreeYears, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialBsThreeYears, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_bs_three_years';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialBsTwoYears.
     *
     * 貸借対照表(前年比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialBsTwoYearsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialBsTwoYears($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialBsTwoYearsWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialBsTwoYearsWithHttpInfo.
     *
     * 貸借対照表(前年比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialBsTwoYearsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialBsTwoYearsWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        $request = $this->getTrialBsTwoYearsRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialBsTwoYearsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialBsTwoYearsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialBsTwoYearsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialBsTwoYearsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialBsTwoYearsAsync.
     *
     * 貸借対照表(前年比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialBsTwoYearsAsync($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        return $this->getTrialBsTwoYearsAsyncWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialBsTwoYearsAsyncWithHttpInfo.
     *
     * 貸借対照表(前年比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialBsTwoYearsAsyncWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialBsTwoYearsResponse';
        $request    = $this->getTrialBsTwoYearsRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialBsTwoYears'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialBsTwoYearsRequest($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialBsTwoYears'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialBsTwoYears, must be bigger than or equal to 1.');
        }

        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialBsTwoYears, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialBsTwoYears, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialBsTwoYears, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialBsTwoYears, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialBsTwoYears, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialBsTwoYears, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialBsTwoYears, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_bs_two_years';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialCr.
     *
     * 製造原価報告書の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialCrResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialCr($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialCrWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialCrWithHttpInfo.
     *
     * 製造原価報告書の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialCrResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialCrWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $request = $this->getTrialCrRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialCrResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialCrResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialCrResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialCrResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialCrAsync.
     *
     * 製造原価報告書の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrAsync($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        return $this->getTrialCrAsyncWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialCrAsyncWithHttpInfo.
     *
     * 製造原価報告書の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrAsyncWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialCrResponse';
        $request    = $this->getTrialCrRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialCr'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrRequest($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialCr'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialCr, must be bigger than or equal to 1.');
        }

        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialCr, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialCr, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialCr, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialCr, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialCr, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialCr, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialCr, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_cr';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialCrSections.
     *
     * 製造原価報告書(部門比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $section_ids               出力する部門の指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択の部門で比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialCrSectionsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSections($company_id, $section_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialCrSectionsWithHttpInfo($company_id, $section_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialCrSectionsWithHttpInfo.
     *
     * 製造原価報告書(部門比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $section_ids               出力する部門の指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択の部門で比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialCrSectionsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSectionsWithHttpInfo($company_id, $section_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $request = $this->getTrialCrSectionsRequest($company_id, $section_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $adjustment, $cost_allocation, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialCrSectionsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialCrSectionsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialCrSectionsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialCrSectionsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialCrSectionsAsync.
     *
     * 製造原価報告書(部門比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $section_ids               出力する部門の指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択の部門で比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSectionsAsync($company_id, $section_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        return $this->getTrialCrSectionsAsyncWithHttpInfo($company_id, $section_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $adjustment, $cost_allocation, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialCrSectionsAsyncWithHttpInfo.
     *
     * 製造原価報告書(部門比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $section_ids               出力する部門の指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択の部門で比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSectionsAsyncWithHttpInfo($company_id, $section_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialCrSectionsResponse';
        $request    = $this->getTrialCrSectionsRequest($company_id, $section_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialCrSections'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $section_ids               出力する部門の指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択の部門で比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSectionsRequest($company_id, $section_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialCrSections'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialCrSections, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'section_ids' is set
        if ($section_ids === null || (is_array($section_ids) && count($section_ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $section_ids when calling getTrialCrSections'
            );
        }
        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialCrSections, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialCrSections, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialCrSections, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialCrSections, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialCrSections, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialCrSections, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_cr_sections';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($section_ids !== null) {
            if ('form' === 'form' && is_array($section_ids)) {
                foreach ($section_ids as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_ids'] = $section_ids;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialCrSegment1Tags.
     *
     * 製造原価報告書(セグメント１比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_1_tag_ids         出力するセグメント１タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialCrSegment1TagsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment1Tags($company_id, $segment_1_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialCrSegment1TagsWithHttpInfo($company_id, $segment_1_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialCrSegment1TagsWithHttpInfo.
     *
     * 製造原価報告書(セグメント１比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_1_tag_ids         出力するセグメント１タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialCrSegment1TagsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment1TagsWithHttpInfo($company_id, $segment_1_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $request = $this->getTrialCrSegment1TagsRequest($company_id, $segment_1_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialCrSegment1TagsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialCrSegment1TagsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialCrSegment1TagsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialCrSegment1TagsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialCrSegment1TagsAsync.
     *
     * 製造原価報告書(セグメント１比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_1_tag_ids         出力するセグメント１タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment1TagsAsync($company_id, $segment_1_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        return $this->getTrialCrSegment1TagsAsyncWithHttpInfo($company_id, $segment_1_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialCrSegment1TagsAsyncWithHttpInfo.
     *
     * 製造原価報告書(セグメント１比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_1_tag_ids         出力するセグメント１タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment1TagsAsyncWithHttpInfo($company_id, $segment_1_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialCrSegment1TagsResponse';
        $request    = $this->getTrialCrSegment1TagsRequest($company_id, $segment_1_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialCrSegment1Tags'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_1_tag_ids         出力するセグメント１タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment1TagsRequest($company_id, $segment_1_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialCrSegment1Tags'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialCrSegment1Tags, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'segment_1_tag_ids' is set
        if ($segment_1_tag_ids === null || (is_array($segment_1_tag_ids) && count($segment_1_tag_ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $segment_1_tag_ids when calling getTrialCrSegment1Tags'
            );
        }
        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialCrSegment1Tags, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialCrSegment1Tags, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialCrSegment1Tags, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialCrSegment1Tags, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialCrSegment1Tags, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialCrSegment1Tags, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialCrSegment1Tags, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_cr_segment_1_tags';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($segment_1_tag_ids !== null) {
            if ('form' === 'form' && is_array($segment_1_tag_ids)) {
                foreach ($segment_1_tag_ids as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['segment_1_tag_ids'] = $segment_1_tag_ids;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialCrSegment2Tags.
     *
     * 製造原価報告書(セグメント２比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_2_tag_ids         出力するセグメント２タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialCrSegment2TagsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment2Tags($company_id, $segment_2_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialCrSegment2TagsWithHttpInfo($company_id, $segment_2_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialCrSegment2TagsWithHttpInfo.
     *
     * 製造原価報告書(セグメント２比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_2_tag_ids         出力するセグメント２タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialCrSegment2TagsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment2TagsWithHttpInfo($company_id, $segment_2_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $request = $this->getTrialCrSegment2TagsRequest($company_id, $segment_2_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialCrSegment2TagsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialCrSegment2TagsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialCrSegment2TagsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialCrSegment2TagsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialCrSegment2TagsAsync.
     *
     * 製造原価報告書(セグメント２比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_2_tag_ids         出力するセグメント２タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment2TagsAsync($company_id, $segment_2_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        return $this->getTrialCrSegment2TagsAsyncWithHttpInfo($company_id, $segment_2_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialCrSegment2TagsAsyncWithHttpInfo.
     *
     * 製造原価報告書(セグメント２比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_2_tag_ids         出力するセグメント２タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment2TagsAsyncWithHttpInfo($company_id, $segment_2_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialCrSegment2TagsResponse';
        $request    = $this->getTrialCrSegment2TagsRequest($company_id, $segment_2_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialCrSegment2Tags'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_2_tag_ids         出力するセグメント２タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment2TagsRequest($company_id, $segment_2_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialCrSegment2Tags'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialCrSegment2Tags, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'segment_2_tag_ids' is set
        if ($segment_2_tag_ids === null || (is_array($segment_2_tag_ids) && count($segment_2_tag_ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $segment_2_tag_ids when calling getTrialCrSegment2Tags'
            );
        }
        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialCrSegment2Tags, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialCrSegment2Tags, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialCrSegment2Tags, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialCrSegment2Tags, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialCrSegment2Tags, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialCrSegment2Tags, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialCrSegment2Tags, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_cr_segment_2_tags';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($segment_2_tag_ids !== null) {
            if ('form' === 'form' && is_array($segment_2_tag_ids)) {
                foreach ($segment_2_tag_ids as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['segment_2_tag_ids'] = $segment_2_tag_ids;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialCrSegment3Tags.
     *
     * 製造原価報告書(セグメント３比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_3_tag_ids         出力するセグメント３タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialCrSegment3TagsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment3Tags($company_id, $segment_3_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialCrSegment3TagsWithHttpInfo($company_id, $segment_3_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialCrSegment3TagsWithHttpInfo.
     *
     * 製造原価報告書(セグメント３比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_3_tag_ids         出力するセグメント３タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialCrSegment3TagsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment3TagsWithHttpInfo($company_id, $segment_3_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $request = $this->getTrialCrSegment3TagsRequest($company_id, $segment_3_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialCrSegment3TagsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialCrSegment3TagsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialCrSegment3TagsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialCrSegment3TagsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialCrSegment3TagsAsync.
     *
     * 製造原価報告書(セグメント３比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_3_tag_ids         出力するセグメント３タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment3TagsAsync($company_id, $segment_3_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        return $this->getTrialCrSegment3TagsAsyncWithHttpInfo($company_id, $segment_3_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialCrSegment3TagsAsyncWithHttpInfo.
     *
     * 製造原価報告書(セグメント３比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_3_tag_ids         出力するセグメント３タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment3TagsAsyncWithHttpInfo($company_id, $segment_3_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialCrSegment3TagsResponse';
        $request    = $this->getTrialCrSegment3TagsRequest($company_id, $segment_3_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialCrSegment3Tags'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_3_tag_ids         出力するセグメント３タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrSegment3TagsRequest($company_id, $segment_3_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialCrSegment3Tags'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialCrSegment3Tags, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'segment_3_tag_ids' is set
        if ($segment_3_tag_ids === null || (is_array($segment_3_tag_ids) && count($segment_3_tag_ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $segment_3_tag_ids when calling getTrialCrSegment3Tags'
            );
        }
        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialCrSegment3Tags, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialCrSegment3Tags, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialCrSegment3Tags, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialCrSegment3Tags, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialCrSegment3Tags, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialCrSegment3Tags, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialCrSegment3Tags, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_cr_segment_3_tags';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($segment_3_tag_ids !== null) {
            if ('form' === 'form' && is_array($segment_3_tag_ids)) {
                foreach ($segment_3_tag_ids as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['segment_3_tag_ids'] = $segment_3_tag_ids;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialCrThreeYears.
     *
     * 製造原価報告書(３期間比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialCrThreeYearsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialCrThreeYears($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialCrThreeYearsWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialCrThreeYearsWithHttpInfo.
     *
     * 製造原価報告書(３期間比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialCrThreeYearsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialCrThreeYearsWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $request = $this->getTrialCrThreeYearsRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialCrThreeYearsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialCrThreeYearsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialCrThreeYearsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialCrThreeYearsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialCrThreeYearsAsync.
     *
     * 製造原価報告書(３期間比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrThreeYearsAsync($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        return $this->getTrialCrThreeYearsAsyncWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialCrThreeYearsAsyncWithHttpInfo.
     *
     * 製造原価報告書(３期間比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrThreeYearsAsyncWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialCrThreeYearsResponse';
        $request    = $this->getTrialCrThreeYearsRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialCrThreeYears'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrThreeYearsRequest($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialCrThreeYears'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialCrThreeYears, must be bigger than or equal to 1.');
        }

        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialCrThreeYears, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialCrThreeYears, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialCrThreeYears, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialCrThreeYears, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialCrThreeYears, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialCrThreeYears, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialCrThreeYears, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_cr_three_years';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialCrTwoYears.
     *
     * 製造原価報告書(前年比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialCrTwoYearsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialCrTwoYears($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialCrTwoYearsWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialCrTwoYearsWithHttpInfo.
     *
     * 製造原価報告書(前年比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialCrTwoYearsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialCrTwoYearsWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $request = $this->getTrialCrTwoYearsRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialCrTwoYearsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialCrTwoYearsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialCrTwoYearsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialCrTwoYearsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialCrTwoYearsAsync.
     *
     * 製造原価報告書(前年比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrTwoYearsAsync($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        return $this->getTrialCrTwoYearsAsyncWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialCrTwoYearsAsyncWithHttpInfo.
     *
     * 製造原価報告書(前年比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrTwoYearsAsyncWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialCrTwoYearsResponse';
        $request    = $this->getTrialCrTwoYearsRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialCrTwoYears'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト), 全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialCrTwoYearsRequest($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialCrTwoYears'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialCrTwoYears, must be bigger than or equal to 1.');
        }

        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialCrTwoYears, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialCrTwoYears, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialCrTwoYears, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialCrTwoYears, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialCrTwoYears, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialCrTwoYears, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialCrTwoYears, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_cr_two_years';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialPl.
     *
     * 損益計算書の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialPlResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialPl($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialPlWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialPlWithHttpInfo.
     *
     * 損益計算書の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialPlResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialPlWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $request = $this->getTrialPlRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialPlResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialPlResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialPlResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialPlResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialPlAsync.
     *
     * 損益計算書の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlAsync($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        return $this->getTrialPlAsyncWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialPlAsyncWithHttpInfo.
     *
     * 損益計算書の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlAsyncWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialPlResponse';
        $request    = $this->getTrialPlRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialPl'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlRequest($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialPl'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialPl, must be bigger than or equal to 1.');
        }

        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialPl, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialPl, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialPl, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialPl, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialPl, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialPl, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialPl, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_pl';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialPlSections.
     *
     * 損益計算書(部門比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $section_ids               出力する部門の指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択の部門で比較できます。） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialPlSectionsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSections($company_id, $section_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialPlSectionsWithHttpInfo($company_id, $section_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialPlSectionsWithHttpInfo.
     *
     * 損益計算書(部門比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $section_ids               出力する部門の指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択の部門で比較できます。） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialPlSectionsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSectionsWithHttpInfo($company_id, $section_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $request = $this->getTrialPlSectionsRequest($company_id, $section_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $adjustment, $cost_allocation, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialPlSectionsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialPlSectionsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialPlSectionsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialPlSectionsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialPlSectionsAsync.
     *
     * 損益計算書(部門比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $section_ids               出力する部門の指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択の部門で比較できます。） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSectionsAsync($company_id, $section_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        return $this->getTrialPlSectionsAsyncWithHttpInfo($company_id, $section_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $adjustment, $cost_allocation, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialPlSectionsAsyncWithHttpInfo.
     *
     * 損益計算書(部門比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $section_ids               出力する部門の指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択の部門で比較できます。） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSectionsAsyncWithHttpInfo($company_id, $section_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialPlSectionsResponse';
        $request    = $this->getTrialPlSectionsRequest($company_id, $section_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialPlSections'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $section_ids               出力する部門の指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択の部門で比較できます。） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSectionsRequest($company_id, $section_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialPlSections'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialPlSections, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'section_ids' is set
        if ($section_ids === null || (is_array($section_ids) && count($section_ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $section_ids when calling getTrialPlSections'
            );
        }
        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialPlSections, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialPlSections, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialPlSections, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialPlSections, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialPlSections, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialPlSections, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_pl_sections';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($section_ids !== null) {
            if ('form' === 'form' && is_array($section_ids)) {
                foreach ($section_ids as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_ids'] = $section_ids;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialPlSegment1Tags.
     *
     * 損益計算書(セグメント１比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_1_tag_ids         出力するセグメント１タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialPlSegment1TagsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment1Tags($company_id, $segment_1_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialPlSegment1TagsWithHttpInfo($company_id, $segment_1_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialPlSegment1TagsWithHttpInfo.
     *
     * 損益計算書(セグメント１比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_1_tag_ids         出力するセグメント１タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialPlSegment1TagsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment1TagsWithHttpInfo($company_id, $segment_1_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $request = $this->getTrialPlSegment1TagsRequest($company_id, $segment_1_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialPlSegment1TagsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialPlSegment1TagsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialPlSegment1TagsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialPlSegment1TagsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialPlSegment1TagsAsync.
     *
     * 損益計算書(セグメント１比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_1_tag_ids         出力するセグメント１タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment1TagsAsync($company_id, $segment_1_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        return $this->getTrialPlSegment1TagsAsyncWithHttpInfo($company_id, $segment_1_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialPlSegment1TagsAsyncWithHttpInfo.
     *
     * 損益計算書(セグメント１比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_1_tag_ids         出力するセグメント１タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment1TagsAsyncWithHttpInfo($company_id, $segment_1_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialPlSegment1TagsResponse';
        $request    = $this->getTrialPlSegment1TagsRequest($company_id, $segment_1_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialPlSegment1Tags'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_1_tag_ids         出力するセグメント１タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment1TagsRequest($company_id, $segment_1_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialPlSegment1Tags'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialPlSegment1Tags, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'segment_1_tag_ids' is set
        if ($segment_1_tag_ids === null || (is_array($segment_1_tag_ids) && count($segment_1_tag_ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $segment_1_tag_ids when calling getTrialPlSegment1Tags'
            );
        }
        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialPlSegment1Tags, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialPlSegment1Tags, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialPlSegment1Tags, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialPlSegment1Tags, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialPlSegment1Tags, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialPlSegment1Tags, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialPlSegment1Tags, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_pl_segment_1_tags';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($segment_1_tag_ids !== null) {
            if ('form' === 'form' && is_array($segment_1_tag_ids)) {
                foreach ($segment_1_tag_ids as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['segment_1_tag_ids'] = $segment_1_tag_ids;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialPlSegment2Tags.
     *
     * 損益計算書(セグメント２比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_2_tag_ids         出力するセグメント２タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialPlSegment2TagsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment2Tags($company_id, $segment_2_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialPlSegment2TagsWithHttpInfo($company_id, $segment_2_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialPlSegment2TagsWithHttpInfo.
     *
     * 損益計算書(セグメント２比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_2_tag_ids         出力するセグメント２タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialPlSegment2TagsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment2TagsWithHttpInfo($company_id, $segment_2_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $request = $this->getTrialPlSegment2TagsRequest($company_id, $segment_2_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialPlSegment2TagsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialPlSegment2TagsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialPlSegment2TagsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialPlSegment2TagsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialPlSegment2TagsAsync.
     *
     * 損益計算書(セグメント２比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_2_tag_ids         出力するセグメント２タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment2TagsAsync($company_id, $segment_2_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        return $this->getTrialPlSegment2TagsAsyncWithHttpInfo($company_id, $segment_2_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialPlSegment2TagsAsyncWithHttpInfo.
     *
     * 損益計算書(セグメント２比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_2_tag_ids         出力するセグメント２タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment2TagsAsyncWithHttpInfo($company_id, $segment_2_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialPlSegment2TagsResponse';
        $request    = $this->getTrialPlSegment2TagsRequest($company_id, $segment_2_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialPlSegment2Tags'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_2_tag_ids         出力するセグメント２タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment2TagsRequest($company_id, $segment_2_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialPlSegment2Tags'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialPlSegment2Tags, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'segment_2_tag_ids' is set
        if ($segment_2_tag_ids === null || (is_array($segment_2_tag_ids) && count($segment_2_tag_ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $segment_2_tag_ids when calling getTrialPlSegment2Tags'
            );
        }
        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialPlSegment2Tags, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialPlSegment2Tags, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialPlSegment2Tags, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialPlSegment2Tags, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialPlSegment2Tags, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialPlSegment2Tags, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialPlSegment2Tags, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_pl_segment_2_tags';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($segment_2_tag_ids !== null) {
            if ('form' === 'form' && is_array($segment_2_tag_ids)) {
                foreach ($segment_2_tag_ids as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['segment_2_tag_ids'] = $segment_2_tag_ids;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialPlSegment3Tags.
     *
     * 損益計算書(セグメント３比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_3_tag_ids         出力するセグメント３タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialPlSegment3TagsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment3Tags($company_id, $segment_3_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialPlSegment3TagsWithHttpInfo($company_id, $segment_3_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialPlSegment3TagsWithHttpInfo.
     *
     * 損益計算書(セグメント３比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_3_tag_ids         出力するセグメント３タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialPlSegment3TagsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment3TagsWithHttpInfo($company_id, $segment_3_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $request = $this->getTrialPlSegment3TagsRequest($company_id, $segment_3_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialPlSegment3TagsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialPlSegment3TagsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialPlSegment3TagsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialPlSegment3TagsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialPlSegment3TagsAsync.
     *
     * 損益計算書(セグメント３比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_3_tag_ids         出力するセグメント３タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment3TagsAsync($company_id, $segment_3_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        return $this->getTrialPlSegment3TagsAsyncWithHttpInfo($company_id, $segment_3_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialPlSegment3TagsAsyncWithHttpInfo.
     *
     * 損益計算書(セグメント３比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_3_tag_ids         出力するセグメント３タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment3TagsAsyncWithHttpInfo($company_id, $segment_3_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialPlSegment3TagsResponse';
        $request    = $this->getTrialPlSegment3TagsRequest($company_id, $segment_3_tag_ids, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialPlSegment3Tags'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param string $segment_3_tag_ids         出力するセグメント３タグIDの指定（半角数字のidを半角カンマ区切りスペースなしで指定してください。0を指定すると、未選択のセグメントで比較できます） (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門 の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlSegment3TagsRequest($company_id, $segment_3_tag_ids, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialPlSegment3Tags'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialPlSegment3Tags, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'segment_3_tag_ids' is set
        if ($segment_3_tag_ids === null || (is_array($segment_3_tag_ids) && count($segment_3_tag_ids) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $segment_3_tag_ids when calling getTrialPlSegment3Tags'
            );
        }
        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialPlSegment3Tags, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialPlSegment3Tags, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialPlSegment3Tags, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialPlSegment3Tags, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialPlSegment3Tags, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialPlSegment3Tags, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialPlSegment3Tags, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_pl_segment_3_tags';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($segment_3_tag_ids !== null) {
            if ('form' === 'form' && is_array($segment_3_tag_ids)) {
                foreach ($segment_3_tag_ids as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['segment_3_tag_ids'] = $segment_3_tag_ids;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialPlThreeYears.
     *
     * 損益計算書(３期間比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialPlThreeYearsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialPlThreeYears($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialPlThreeYearsWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialPlThreeYearsWithHttpInfo.
     *
     * 損益計算書(３期間比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialPlThreeYearsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialPlThreeYearsWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $request = $this->getTrialPlThreeYearsRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialPlThreeYearsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialPlThreeYearsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialPlThreeYearsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialPlThreeYearsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialPlThreeYearsAsync.
     *
     * 損益計算書(３期間比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlThreeYearsAsync($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        return $this->getTrialPlThreeYearsAsyncWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialPlThreeYearsAsyncWithHttpInfo.
     *
     * 損益計算書(３期間比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlThreeYearsAsyncWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialPlThreeYearsResponse';
        $request    = $this->getTrialPlThreeYearsRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialPlThreeYears'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlThreeYearsRequest($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialPlThreeYears'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialPlThreeYears, must be bigger than or equal to 1.');
        }

        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialPlThreeYears, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialPlThreeYears, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialPlThreeYears, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialPlThreeYears, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialPlThreeYears, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialPlThreeYears, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialPlThreeYears, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_pl_three_years';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation getTrialPlTwoYears.
     *
     * 損益計算書(前年比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \OpenAPI\Client\Model\TrialPlTwoYearsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialPlTwoYears($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        [$response] = $this->getTrialPlTwoYearsWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $response;
    }

    /**
     * Operation getTrialPlTwoYearsWithHttpInfo.
     *
     * 損益計算書(前年比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return array of \OpenAPI\Client\Model\TrialPlTwoYearsResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\TooManyRequestsError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getTrialPlTwoYearsWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $request = $this->getTrialPlTwoYearsRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        try {
            $options = $this->createHttpClientOption();
            try {
                $response = $this->client->send($request, $options);
            } catch (RequestException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null,
                    $e->getResponse() ? (string) $e->getResponse()->getBody() : null
                );
            } catch (ConnectException $e) {
                throw new ApiException(
                    "[{$e->getCode()}] {$e->getMessage()}",
                    (int) $e->getCode(),
                    null,
                    null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    sprintf(
                        '[%d] Error connecting to the API (%s)',
                        $statusCode,
                        (string) $request->getUri()
                    ),
                    $statusCode,
                    $response->getHeaders(),
                    (string) $response->getBody()
                );
            }

            switch ($statusCode) {
                case 200:
                    if ('\OpenAPI\Client\Model\TrialPlTwoYearsResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TrialPlTwoYearsResponse', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 400:
                    if ('\OpenAPI\Client\Model\BadRequestError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 401:
                    if ('\OpenAPI\Client\Model\UnauthorizedError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\UnauthorizedError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 403:
                    if ('\OpenAPI\Client\Model\ForbiddenError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ForbiddenError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 429:
                    if ('\OpenAPI\Client\Model\TooManyRequestsError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\TooManyRequestsError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                case 500:
                    if ('\OpenAPI\Client\Model\InternalServerError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InternalServerError', []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
            }

            $returnType = '\OpenAPI\Client\Model\TrialPlTwoYearsResponse';
            if ($returnType === '\SplFileObject') {
                $content = $response->getBody(); //stream goes to serializer
            } else {
                $content = (string) $response->getBody();
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders(),
            ];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TrialPlTwoYearsResponse',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 400:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 401:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\UnauthorizedError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 403:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ForbiddenError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 429:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\TooManyRequestsError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
                case 500:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\InternalServerError',
                        $e->getResponseHeaders()
                    );
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation getTrialPlTwoYearsAsync.
     *
     * 損益計算書(前年比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlTwoYearsAsync($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        return $this->getTrialPlTwoYearsAsyncWithHttpInfo($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getTrialPlTwoYearsAsyncWithHttpInfo.
     *
     * 損益計算書(前年比較)の取得
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlTwoYearsAsyncWithHttpInfo($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        $returnType = '\OpenAPI\Client\Model\TrialPlTwoYearsResponse';
        $request    = $this->getTrialPlTwoYearsRequest($company_id, $fiscal_year, $start_month, $end_month, $start_date, $end_date, $account_item_display_type, $breakdown_display_type, $partner_id, $partner_code, $item_id, $section_id, $adjustment, $cost_allocation, $approval_flow_status);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    if ($returnType === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, $returnType, []),
                        $response->getStatusCode(),
                        $response->getHeaders(),
                    ];
                },
                function ($exception) {
                    $response   = $exception->getResponse();
                    $statusCode = $response->getStatusCode();
                    throw new ApiException(
                        sprintf(
                            '[%d] Error connecting to the API (%s)',
                            $statusCode,
                            $exception->getRequest()->getUri()
                        ),
                        $statusCode,
                        $response->getHeaders(),
                        (string) $response->getBody()
                    );
                }
            );
    }

    /**
     * Create request for operation 'getTrialPlTwoYears'.
     *
     * @param int    $company_id                事業所ID (required)
     * @param int    $fiscal_year               会計年度 (optional)
     * @param int    $start_month               発生月で絞込：開始会計月(1-12)。指定されない場合、現在の会計年度の期首月が指定されます。 (optional)
     * @param int    $end_month                 発生月で絞込：終了会計月(1-12)(会計年度が10月始まりでstart_monthが11なら11, 12, 1, ... 9のいずれかを指定する)。指定されない場合、現在の会計年度の期末月が指定されます。 (optional)
     * @param string $start_date                発生日で絞込：開始日(yyyy-mm-dd) (optional)
     * @param string $end_date                  発生日で絞込：終了日(yyyy-mm-dd) (optional)
     * @param string $account_item_display_type 勘定科目の表示（勘定科目: account_item, 決算書表示:group）。指定されない場合、勘定科目: account_itemが指定されます。 (optional)
     * @param string $breakdown_display_type    内訳の表示（取引先: partner, 品目: item, 部門: section, 勘定科目: account_item, セグメント１タグ: segment_1_tag, セグメント２タグ: segment_2_tag, セグメント３タグ: segment_3_tag） ※勘定科目はaccount_item_display_typeが「group」の時のみ指定できます。  取引先、品目、部門、セグメント の各項目が単独で1,000以上登録されている場合は、breakdown_display_type で該当項目を指定するとエラーになります。  例）取引先の登録数が1,000以上、品目の登録数が999以下の場合 * breakdown_display_type: 取引先を指定 → エラーになる * breakdown_display_type: 品目を指定 → エラーにならない (optional)
     * @param int    $partner_id                取引先IDで絞込（0を指定すると、取引先が未選択で絞り込めます） (optional)
     * @param string $partner_code              取引先コードで絞込（事業所設定で取引先コードの利用を有効にしている場合のみ利用可能です） (optional)
     * @param int    $item_id                   品目IDで絞込（0を指定すると、品目が未選択で絞り込めます） (optional)
     * @param int    $section_id                部門IDで絞込（0を指定すると、部門が未選択で絞り込めます） (optional)
     * @param string $adjustment                決算整理仕訳で絞込（決算整理仕訳のみ: only, 決算整理仕訳以外: without）。指定されない場合、決算整理仕訳を含む金額が返却されます。 (optional)
     * @param string $cost_allocation           配賦仕訳で絞込（配賦仕訳のみ：only,配賦仕訳以外：without）。指定されない場合、配賦仕訳を含む金額が返却されます。 (optional)
     * @param string $approval_flow_status      承認ステータスで絞込 (未承認を除く: without_in_progress (デフォルト)、全てのステータス: all)&lt;br&gt; プレミアムプラン、法人アドバンスプラン（および旧法人プロフェッショナルプラン）以上で指定可能です。&lt;br&gt; 事業所の設定から仕訳承認フローの利用を有効にした場合に指定可能です。 (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getTrialPlTwoYearsRequest($company_id, $fiscal_year = null, $start_month = null, $end_month = null, $start_date = null, $end_date = null, $account_item_display_type = null, $breakdown_display_type = null, $partner_id = null, $partner_code = null, $item_id = null, $section_id = null, $adjustment = null, $cost_allocation = null, $approval_flow_status = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getTrialPlTwoYears'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling TrialBalanceApi.getTrialPlTwoYears, must be bigger than or equal to 1.');
        }

        if ($start_month !== null && $start_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialPlTwoYears, must be smaller than or equal to 12.');
        }
        if ($start_month !== null && $start_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$start_month" when calling TrialBalanceApi.getTrialPlTwoYears, must be bigger than or equal to 1.');
        }

        if ($end_month !== null && $end_month > 12) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialPlTwoYears, must be smaller than or equal to 12.');
        }
        if ($end_month !== null && $end_month < 1) {
            throw new \InvalidArgumentException('invalid value for "$end_month" when calling TrialBalanceApi.getTrialPlTwoYears, must be bigger than or equal to 1.');
        }

        if ($partner_id !== null && $partner_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$partner_id" when calling TrialBalanceApi.getTrialPlTwoYears, must be bigger than or equal to 0.');
        }

        if ($item_id !== null && $item_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$item_id" when calling TrialBalanceApi.getTrialPlTwoYears, must be bigger than or equal to 0.');
        }

        if ($section_id !== null && $section_id < 0) {
            throw new \InvalidArgumentException('invalid value for "$section_id" when calling TrialBalanceApi.getTrialPlTwoYears, must be bigger than or equal to 0.');
        }


        $resourcePath = '/api/1/reports/trial_pl_two_years';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;

        // query params
        if ($company_id !== null) {
            if ('form' === 'form' && is_array($company_id)) {
                foreach ($company_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['company_id'] = $company_id;
            }
        }
        // query params
        if ($fiscal_year !== null) {
            if ('form' === 'form' && is_array($fiscal_year)) {
                foreach ($fiscal_year as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['fiscal_year'] = $fiscal_year;
            }
        }
        // query params
        if ($start_month !== null) {
            if ('form' === 'form' && is_array($start_month)) {
                foreach ($start_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_month'] = $start_month;
            }
        }
        // query params
        if ($end_month !== null) {
            if ('form' === 'form' && is_array($end_month)) {
                foreach ($end_month as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_month'] = $end_month;
            }
        }
        // query params
        if ($start_date !== null) {
            if ('form' === 'form' && is_array($start_date)) {
                foreach ($start_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['start_date'] = $start_date;
            }
        }
        // query params
        if ($end_date !== null) {
            if ('form' === 'form' && is_array($end_date)) {
                foreach ($end_date as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['end_date'] = $end_date;
            }
        }
        // query params
        if ($account_item_display_type !== null) {
            if ('form' === 'form' && is_array($account_item_display_type)) {
                foreach ($account_item_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['account_item_display_type'] = $account_item_display_type;
            }
        }
        // query params
        if ($breakdown_display_type !== null) {
            if ('form' === 'form' && is_array($breakdown_display_type)) {
                foreach ($breakdown_display_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['breakdown_display_type'] = $breakdown_display_type;
            }
        }
        // query params
        if ($partner_id !== null) {
            if ('form' === 'form' && is_array($partner_id)) {
                foreach ($partner_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_id'] = $partner_id;
            }
        }
        // query params
        if ($partner_code !== null) {
            if ('form' === 'form' && is_array($partner_code)) {
                foreach ($partner_code as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['partner_code'] = $partner_code;
            }
        }
        // query params
        if ($item_id !== null) {
            if ('form' === 'form' && is_array($item_id)) {
                foreach ($item_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['item_id'] = $item_id;
            }
        }
        // query params
        if ($section_id !== null) {
            if ('form' === 'form' && is_array($section_id)) {
                foreach ($section_id as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['section_id'] = $section_id;
            }
        }
        // query params
        if ($adjustment !== null) {
            if ('form' === 'form' && is_array($adjustment)) {
                foreach ($adjustment as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['adjustment'] = $adjustment;
            }
        }
        // query params
        if ($cost_allocation !== null) {
            if ('form' === 'form' && is_array($cost_allocation)) {
                foreach ($cost_allocation as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['cost_allocation'] = $cost_allocation;
            }
        }
        // query params
        if ($approval_flow_status !== null) {
            if ('form' === 'form' && is_array($approval_flow_status)) {
                foreach ($approval_flow_status as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['approval_flow_status'] = $approval_flow_status;
            }
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                []
            );
        }

        // for model (json/xml)
        if (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $formParamValueItems = is_array($formParamValue) ? $formParamValue : [$formParamValue];
                    foreach ($formParamValueItems as $formParamValueItem) {
                        $multipartContents[] = [
                            'name'     => $formParamName,
                            'contents' => $formParamValueItem,
                        ];
                    }
                }
                // for HTTP post (form)
                $httpBody = new MultipartStream($multipartContents);
            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);
            } else {
                // for HTTP post (form)
                $httpBody = \GuzzleHttp\Psr7\Query::build($formParams);
            }
        }

        // this endpoint requires OAuth (access token)
        if ($this->config->getAccessToken() !== null) {
            $headers['Authorization'] = 'Bearer '.$this->config->getAccessToken();
        }

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }

        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        $query = \GuzzleHttp\Psr7\Query::build($queryParams);

        return new Request(
            'GET',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Create http client option.
     *
     * @return array of http client options
     *
     * @throws \RuntimeException on file opening failure
     */
    protected function createHttpClientOption()
    {
        $options = [];
        if ($this->config->getDebug()) {
            $options[RequestOptions::DEBUG] = fopen($this->config->getDebugFile(), 'a');
            if (!$options[RequestOptions::DEBUG]) {
                throw new \RuntimeException('Failed to open the debug file: '.$this->config->getDebugFile());
            }
        }

        return $options;
    }
}
