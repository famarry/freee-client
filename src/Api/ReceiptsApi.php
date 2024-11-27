<?php

/**
 * ReceiptsApi
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
 * ReceiptsApi Class Doc Comment.
 *
 * @category Class
 *
 * @author   OpenAPI Generator team
 *
 * @link     https://openapi-generator.tech
 */
class ReceiptsApi
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
     * Operation createReceipt.
     *
     * ファイルボックス（証憑ファイル）のアップロード
     *
     * @param int            $company_id                     事業所ID (required)
     * @param \SplFileObject $receipt                        証憑ファイル (required)
     * @param string         $description                    メモ (255文字以内) (optional)
     * @param string         $receipt_metadatum_partner_name 発行元 (optional)
     * @param string         $receipt_metadatum_issue_date   発行日 (yyyy-mm-dd) (optional)
     * @param int            $receipt_metadatum_amount       金額 (optional)
     * @param string         $qualified_invoice              適格請求書等（qualified: 該当する、not_qualified: 該当しない、unselected: 未選択） (optional)
     * @param string         $document_type                  書類の種類（receipt: 領収書、invoice: 請求書、other: その他） (optional)
     *
     * @return \OpenAPI\Client\Model\ReceiptResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function createReceipt($company_id, $receipt, $description = null, $receipt_metadatum_partner_name = null, $receipt_metadatum_issue_date = null, $receipt_metadatum_amount = null, $qualified_invoice = null, $document_type = null)
    {
        [$response] = $this->createReceiptWithHttpInfo($company_id, $receipt, $description, $receipt_metadatum_partner_name, $receipt_metadatum_issue_date, $receipt_metadatum_amount, $qualified_invoice, $document_type);

        return $response;
    }

    /**
     * Operation createReceiptWithHttpInfo.
     *
     * ファイルボックス（証憑ファイル）のアップロード
     *
     * @param int            $company_id                     事業所ID (required)
     * @param \SplFileObject $receipt                        証憑ファイル (required)
     * @param string         $description                    メモ (255文字以内) (optional)
     * @param string         $receipt_metadatum_partner_name 発行元 (optional)
     * @param string         $receipt_metadatum_issue_date   発行日 (yyyy-mm-dd) (optional)
     * @param int            $receipt_metadatum_amount       金額 (optional)
     * @param string         $qualified_invoice              適格請求書等（qualified: 該当する、not_qualified: 該当しない、unselected: 未選択） (optional)
     * @param string         $document_type                  書類の種類（receipt: 領収書、invoice: 請求書、other: その他） (optional)
     *
     * @return array of \OpenAPI\Client\Model\ReceiptResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function createReceiptWithHttpInfo($company_id, $receipt, $description = null, $receipt_metadatum_partner_name = null, $receipt_metadatum_issue_date = null, $receipt_metadatum_amount = null, $qualified_invoice = null, $document_type = null)
    {
        $request = $this->createReceiptRequest($company_id, $receipt, $description, $receipt_metadatum_partner_name, $receipt_metadatum_issue_date, $receipt_metadatum_amount, $qualified_invoice, $document_type);

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
                case 201:
                    if ('\OpenAPI\Client\Model\ReceiptResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ReceiptResponse', []),
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

            $returnType = '\OpenAPI\Client\Model\ReceiptResponse';
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
                case 201:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\ReceiptResponse',
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
     * Operation createReceiptAsync.
     *
     * ファイルボックス（証憑ファイル）のアップロード
     *
     * @param int            $company_id                     事業所ID (required)
     * @param \SplFileObject $receipt                        証憑ファイル (required)
     * @param string         $description                    メモ (255文字以内) (optional)
     * @param string         $receipt_metadatum_partner_name 発行元 (optional)
     * @param string         $receipt_metadatum_issue_date   発行日 (yyyy-mm-dd) (optional)
     * @param int            $receipt_metadatum_amount       金額 (optional)
     * @param string         $qualified_invoice              適格請求書等（qualified: 該当する、not_qualified: 該当しない、unselected: 未選択） (optional)
     * @param string         $document_type                  書類の種類（receipt: 領収書、invoice: 請求書、other: その他） (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function createReceiptAsync($company_id, $receipt, $description = null, $receipt_metadatum_partner_name = null, $receipt_metadatum_issue_date = null, $receipt_metadatum_amount = null, $qualified_invoice = null, $document_type = null)
    {
        return $this->createReceiptAsyncWithHttpInfo($company_id, $receipt, $description, $receipt_metadatum_partner_name, $receipt_metadatum_issue_date, $receipt_metadatum_amount, $qualified_invoice, $document_type)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation createReceiptAsyncWithHttpInfo.
     *
     * ファイルボックス（証憑ファイル）のアップロード
     *
     * @param int            $company_id                     事業所ID (required)
     * @param \SplFileObject $receipt                        証憑ファイル (required)
     * @param string         $description                    メモ (255文字以内) (optional)
     * @param string         $receipt_metadatum_partner_name 発行元 (optional)
     * @param string         $receipt_metadatum_issue_date   発行日 (yyyy-mm-dd) (optional)
     * @param int            $receipt_metadatum_amount       金額 (optional)
     * @param string         $qualified_invoice              適格請求書等（qualified: 該当する、not_qualified: 該当しない、unselected: 未選択） (optional)
     * @param string         $document_type                  書類の種類（receipt: 領収書、invoice: 請求書、other: その他） (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function createReceiptAsyncWithHttpInfo($company_id, $receipt, $description = null, $receipt_metadatum_partner_name = null, $receipt_metadatum_issue_date = null, $receipt_metadatum_amount = null, $qualified_invoice = null, $document_type = null)
    {
        $returnType = '\OpenAPI\Client\Model\ReceiptResponse';
        $request    = $this->createReceiptRequest($company_id, $receipt, $description, $receipt_metadatum_partner_name, $receipt_metadatum_issue_date, $receipt_metadatum_amount, $qualified_invoice, $document_type);

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
     * Create request for operation 'createReceipt'.
     *
     * @param int            $company_id                     事業所ID (required)
     * @param \SplFileObject $receipt                        証憑ファイル (required)
     * @param string         $description                    メモ (255文字以内) (optional)
     * @param string         $receipt_metadatum_partner_name 発行元 (optional)
     * @param string         $receipt_metadatum_issue_date   発行日 (yyyy-mm-dd) (optional)
     * @param int            $receipt_metadatum_amount       金額 (optional)
     * @param string         $qualified_invoice              適格請求書等（qualified: 該当する、not_qualified: 該当しない、unselected: 未選択） (optional)
     * @param string         $document_type                  書類の種類（receipt: 領収書、invoice: 請求書、other: その他） (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function createReceiptRequest($company_id, $receipt, $description = null, $receipt_metadatum_partner_name = null, $receipt_metadatum_issue_date = null, $receipt_metadatum_amount = null, $qualified_invoice = null, $document_type = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling createReceipt'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling ReceiptsApi.createReceipt, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'receipt' is set
        if ($receipt === null || (is_array($receipt) && count($receipt) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $receipt when calling createReceipt'
            );
        }
        if ($description !== null && strlen($description) > 255) {
            throw new \InvalidArgumentException('invalid length for "$description" when calling ReceiptsApi.createReceipt, must be smaller than or equal to 255.');
        }

        if ($receipt_metadatum_partner_name !== null && strlen($receipt_metadatum_partner_name) > 255) {
            throw new \InvalidArgumentException('invalid length for "$receipt_metadatum_partner_name" when calling ReceiptsApi.createReceipt, must be smaller than or equal to 255.');
        }

        if ($receipt_metadatum_amount !== null && $receipt_metadatum_amount > 9223372036854775807) {
            throw new \InvalidArgumentException('invalid value for "$receipt_metadatum_amount" when calling ReceiptsApi.createReceipt, must be smaller than or equal to 9223372036854775807.');
        }
        if ($receipt_metadatum_amount !== null && $receipt_metadatum_amount < -9223372036854775808) {
            throw new \InvalidArgumentException('invalid value for "$receipt_metadatum_amount" when calling ReceiptsApi.createReceipt, must be bigger than or equal to -9223372036854775808.');
        }


        $resourcePath = '/api/1/receipts';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;


        // form params
        if ($company_id !== null) {
            $formParams['company_id'] = ObjectSerializer::toFormValue($company_id);
        }
        // form params
        if ($description !== null) {
            $formParams['description'] = ObjectSerializer::toFormValue($description);
        }
        // form params
        if ($receipt !== null) {
            $multipart             = true;
            $formParams['receipt'] = [];
            $paramFiles            = is_array($receipt) ? $receipt : [$receipt];
            foreach ($paramFiles as $paramFile) {
                $formParams['receipt'][] = \GuzzleHttp\Psr7\Utils::tryFopen(
                    ObjectSerializer::toFormValue($paramFile),
                    'rb'
                );
            }
        }
        // form params
        if ($receipt_metadatum_partner_name !== null) {
            $formParams['receipt_metadatum_partner_name'] = ObjectSerializer::toFormValue($receipt_metadatum_partner_name);
        }
        // form params
        if ($receipt_metadatum_issue_date !== null) {
            $formParams['receipt_metadatum_issue_date'] = ObjectSerializer::toFormValue($receipt_metadatum_issue_date);
        }
        // form params
        if ($receipt_metadatum_amount !== null) {
            $formParams['receipt_metadatum_amount'] = ObjectSerializer::toFormValue($receipt_metadatum_amount);
        }
        // form params
        if ($qualified_invoice !== null) {
            $formParams['qualified_invoice'] = ObjectSerializer::toFormValue($qualified_invoice);
        }
        // form params
        if ($document_type !== null) {
            $formParams['document_type'] = ObjectSerializer::toFormValue($document_type);
        }

        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['multipart/form-data']
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
            'POST',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation destroyReceipt.
     *
     * ファイルボックス（証憑ファイル）の削除
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return void
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function destroyReceipt($id, $company_id)
    {
        $this->destroyReceiptWithHttpInfo($id, $company_id);
    }

    /**
     * Operation destroyReceiptWithHttpInfo.
     *
     * ファイルボックス（証憑ファイル）の削除
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return array of null, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function destroyReceiptWithHttpInfo($id, $company_id)
    {
        $request = $this->destroyReceiptRequest($id, $company_id);

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

            return [null, $statusCode, $response->getHeaders()];
        } catch (ApiException $e) {
            switch ($e->getCode()) {
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
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestNotFoundError',
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
     * Operation destroyReceiptAsync.
     *
     * ファイルボックス（証憑ファイル）の削除
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function destroyReceiptAsync($id, $company_id)
    {
        return $this->destroyReceiptAsyncWithHttpInfo($id, $company_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation destroyReceiptAsyncWithHttpInfo.
     *
     * ファイルボックス（証憑ファイル）の削除
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function destroyReceiptAsyncWithHttpInfo($id, $company_id)
    {
        $returnType = '';
        $request    = $this->destroyReceiptRequest($id, $company_id);

        return $this->client
            ->sendAsync($request, $this->createHttpClientOption())
            ->then(
                function ($response) use ($returnType) {
                    return [null, $response->getStatusCode(), $response->getHeaders()];
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
     * Create request for operation 'destroyReceipt'.
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function destroyReceiptRequest($id, $company_id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling destroyReceipt'
            );
        }
        if ($id < 1) {
            throw new \InvalidArgumentException('invalid value for "$id" when calling ReceiptsApi.destroyReceipt, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling destroyReceipt'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling ReceiptsApi.destroyReceipt, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/1/receipts/{id}';
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


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{'.'id'.'}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
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
            'DELETE',
            $this->config->getHost().$resourcePath.($query ? "?{$query}" : ''),
            $headers,
            $httpBody
        );
    }

    /**
     * Operation downloadReceipt.
     *
     * ファイルボックス（証憑ファイル）のダウンロード
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return string|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function downloadReceipt($id, $company_id)
    {
        [$response] = $this->downloadReceiptWithHttpInfo($id, $company_id);

        return $response;
    }

    /**
     * Operation downloadReceiptWithHttpInfo.
     *
     * ファイルボックス（証憑ファイル）のダウンロード
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return array of string|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function downloadReceiptWithHttpInfo($id, $company_id)
    {
        $request = $this->downloadReceiptRequest($id, $company_id);

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
                    if ('string' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, 'string', []),
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
                case 404:
                    if ('\OpenAPI\Client\Model\BadRequestNotFoundError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestNotFoundError', []),
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

            $returnType = 'string';
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
                        'string',
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
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestNotFoundError',
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
     * Operation downloadReceiptAsync.
     *
     * ファイルボックス（証憑ファイル）のダウンロード
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function downloadReceiptAsync($id, $company_id)
    {
        return $this->downloadReceiptAsyncWithHttpInfo($id, $company_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation downloadReceiptAsyncWithHttpInfo.
     *
     * ファイルボックス（証憑ファイル）のダウンロード
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function downloadReceiptAsyncWithHttpInfo($id, $company_id)
    {
        $returnType = 'string';
        $request    = $this->downloadReceiptRequest($id, $company_id);

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
     * Create request for operation 'downloadReceipt'.
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function downloadReceiptRequest($id, $company_id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling downloadReceipt'
            );
        }
        if ($id < 1) {
            throw new \InvalidArgumentException('invalid value for "$id" when calling ReceiptsApi.downloadReceipt, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling downloadReceipt'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling ReceiptsApi.downloadReceipt, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/1/receipts/{id}/download';
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


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{'.'id'.'}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['text/csv', 'application/pdf', 'image/_*', 'application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['text/csv', 'application/pdf', 'image/_*', 'application/json'],
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
     * Operation getReceipt.
     *
     * ファイルボックス（証憑ファイル）の取得
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \OpenAPI\Client\Model\ReceiptResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function getReceipt($id, $company_id)
    {
        [$response] = $this->getReceiptWithHttpInfo($id, $company_id);

        return $response;
    }

    /**
     * Operation getReceiptWithHttpInfo.
     *
     * ファイルボックス（証憑ファイル）の取得
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return array of \OpenAPI\Client\Model\ReceiptResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function getReceiptWithHttpInfo($id, $company_id)
    {
        $request = $this->getReceiptRequest($id, $company_id);

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
                    if ('\OpenAPI\Client\Model\ReceiptResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ReceiptResponse', []),
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
                case 404:
                    if ('\OpenAPI\Client\Model\BadRequestNotFoundError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestNotFoundError', []),
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

            $returnType = '\OpenAPI\Client\Model\ReceiptResponse';
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
                        '\OpenAPI\Client\Model\ReceiptResponse',
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
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestNotFoundError',
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
     * Operation getReceiptAsync.
     *
     * ファイルボックス（証憑ファイル）の取得
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getReceiptAsync($id, $company_id)
    {
        return $this->getReceiptAsyncWithHttpInfo($id, $company_id)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getReceiptAsyncWithHttpInfo.
     *
     * ファイルボックス（証憑ファイル）の取得
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getReceiptAsyncWithHttpInfo($id, $company_id)
    {
        $returnType = '\OpenAPI\Client\Model\ReceiptResponse';
        $request    = $this->getReceiptRequest($id, $company_id);

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
     * Create request for operation 'getReceipt'.
     *
     * @param int $id         ファイルボックス（証憑ファイル）ID (required)
     * @param int $company_id 事業所ID (required)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getReceiptRequest($id, $company_id)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling getReceipt'
            );
        }
        if ($id < 1) {
            throw new \InvalidArgumentException('invalid value for "$id" when calling ReceiptsApi.getReceipt, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getReceipt'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling ReceiptsApi.getReceipt, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/1/receipts/{id}';
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


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{'.'id'.'}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
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
     * Operation getReceipts.
     *
     * ファイルボックス（証憑ファイル）一覧の取得
     *
     * @param int    $company_id        事業所ID (required)
     * @param string $start_date        アップロード日 (yyyy-mm-dd) (required)
     * @param string $end_date          アップロード日 (yyyy-mm-dd) (required)
     * @param string $user_name         アップロードしたユーザー名、メールアドレス (optional)
     * @param int    $number            アップロードファイルNo (optional)
     * @param string $comment_type      posted:コメントあり, raised:未解決, resolved:解決済 (optional)
     * @param bool   $comment_important trueの時、重要コメント付きが対象 (optional)
     * @param string $category          all:すべて、without_deal:未登録、with_expense_application_line:経費申請中, with_deal:登録済み、ignored:無視 (optional)
     * @param int    $offset            取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit             取得レコードの件数 (デフォルト: 50, 最小: 1, 最大: 3000) (optional)
     *
     * @return \OpenAPI\Client\Model\InlineResponse20015|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getReceipts($company_id, $start_date, $end_date, $user_name = null, $number = null, $comment_type = null, $comment_important = null, $category = null, $offset = null, $limit = null)
    {
        [$response] = $this->getReceiptsWithHttpInfo($company_id, $start_date, $end_date, $user_name, $number, $comment_type, $comment_important, $category, $offset, $limit);

        return $response;
    }

    /**
     * Operation getReceiptsWithHttpInfo.
     *
     * ファイルボックス（証憑ファイル）一覧の取得
     *
     * @param int    $company_id        事業所ID (required)
     * @param string $start_date        アップロード日 (yyyy-mm-dd) (required)
     * @param string $end_date          アップロード日 (yyyy-mm-dd) (required)
     * @param string $user_name         アップロードしたユーザー名、メールアドレス (optional)
     * @param int    $number            アップロードファイルNo (optional)
     * @param string $comment_type      posted:コメントあり, raised:未解決, resolved:解決済 (optional)
     * @param bool   $comment_important trueの時、重要コメント付きが対象 (optional)
     * @param string $category          all:すべて、without_deal:未登録、with_expense_application_line:経費申請中, with_deal:登録済み、ignored:無視 (optional)
     * @param int    $offset            取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit             取得レコードの件数 (デフォルト: 50, 最小: 1, 最大: 3000) (optional)
     *
     * @return array of \OpenAPI\Client\Model\InlineResponse20015|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     */
    public function getReceiptsWithHttpInfo($company_id, $start_date, $end_date, $user_name = null, $number = null, $comment_type = null, $comment_important = null, $category = null, $offset = null, $limit = null)
    {
        $request = $this->getReceiptsRequest($company_id, $start_date, $end_date, $user_name, $number, $comment_type, $comment_important, $category, $offset, $limit);

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
                    if ('\OpenAPI\Client\Model\InlineResponse20015' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\InlineResponse20015', []),
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

            $returnType = '\OpenAPI\Client\Model\InlineResponse20015';
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
                        '\OpenAPI\Client\Model\InlineResponse20015',
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
     * Operation getReceiptsAsync.
     *
     * ファイルボックス（証憑ファイル）一覧の取得
     *
     * @param int    $company_id        事業所ID (required)
     * @param string $start_date        アップロード日 (yyyy-mm-dd) (required)
     * @param string $end_date          アップロード日 (yyyy-mm-dd) (required)
     * @param string $user_name         アップロードしたユーザー名、メールアドレス (optional)
     * @param int    $number            アップロードファイルNo (optional)
     * @param string $comment_type      posted:コメントあり, raised:未解決, resolved:解決済 (optional)
     * @param bool   $comment_important trueの時、重要コメント付きが対象 (optional)
     * @param string $category          all:すべて、without_deal:未登録、with_expense_application_line:経費申請中, with_deal:登録済み、ignored:無視 (optional)
     * @param int    $offset            取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit             取得レコードの件数 (デフォルト: 50, 最小: 1, 最大: 3000) (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getReceiptsAsync($company_id, $start_date, $end_date, $user_name = null, $number = null, $comment_type = null, $comment_important = null, $category = null, $offset = null, $limit = null)
    {
        return $this->getReceiptsAsyncWithHttpInfo($company_id, $start_date, $end_date, $user_name, $number, $comment_type, $comment_important, $category, $offset, $limit)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation getReceiptsAsyncWithHttpInfo.
     *
     * ファイルボックス（証憑ファイル）一覧の取得
     *
     * @param int    $company_id        事業所ID (required)
     * @param string $start_date        アップロード日 (yyyy-mm-dd) (required)
     * @param string $end_date          アップロード日 (yyyy-mm-dd) (required)
     * @param string $user_name         アップロードしたユーザー名、メールアドレス (optional)
     * @param int    $number            アップロードファイルNo (optional)
     * @param string $comment_type      posted:コメントあり, raised:未解決, resolved:解決済 (optional)
     * @param bool   $comment_important trueの時、重要コメント付きが対象 (optional)
     * @param string $category          all:すべて、without_deal:未登録、with_expense_application_line:経費申請中, with_deal:登録済み、ignored:無視 (optional)
     * @param int    $offset            取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit             取得レコードの件数 (デフォルト: 50, 最小: 1, 最大: 3000) (optional)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function getReceiptsAsyncWithHttpInfo($company_id, $start_date, $end_date, $user_name = null, $number = null, $comment_type = null, $comment_important = null, $category = null, $offset = null, $limit = null)
    {
        $returnType = '\OpenAPI\Client\Model\InlineResponse20015';
        $request    = $this->getReceiptsRequest($company_id, $start_date, $end_date, $user_name, $number, $comment_type, $comment_important, $category, $offset, $limit);

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
     * Create request for operation 'getReceipts'.
     *
     * @param int    $company_id        事業所ID (required)
     * @param string $start_date        アップロード日 (yyyy-mm-dd) (required)
     * @param string $end_date          アップロード日 (yyyy-mm-dd) (required)
     * @param string $user_name         アップロードしたユーザー名、メールアドレス (optional)
     * @param int    $number            アップロードファイルNo (optional)
     * @param string $comment_type      posted:コメントあり, raised:未解決, resolved:解決済 (optional)
     * @param bool   $comment_important trueの時、重要コメント付きが対象 (optional)
     * @param string $category          all:すべて、without_deal:未登録、with_expense_application_line:経費申請中, with_deal:登録済み、ignored:無視 (optional)
     * @param int    $offset            取得レコードのオフセット (デフォルト: 0) (optional)
     * @param int    $limit             取得レコードの件数 (デフォルト: 50, 最小: 1, 最大: 3000) (optional)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function getReceiptsRequest($company_id, $start_date, $end_date, $user_name = null, $number = null, $comment_type = null, $comment_important = null, $category = null, $offset = null, $limit = null)
    {
        // verify the required parameter 'company_id' is set
        if ($company_id === null || (is_array($company_id) && count($company_id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $company_id when calling getReceipts'
            );
        }
        if ($company_id < 1) {
            throw new \InvalidArgumentException('invalid value for "$company_id" when calling ReceiptsApi.getReceipts, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'start_date' is set
        if ($start_date === null || (is_array($start_date) && count($start_date) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $start_date when calling getReceipts'
            );
        }
        // verify the required parameter 'end_date' is set
        if ($end_date === null || (is_array($end_date) && count($end_date) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $end_date when calling getReceipts'
            );
        }
        if ($number !== null && $number < 1) {
            throw new \InvalidArgumentException('invalid value for "$number" when calling ReceiptsApi.getReceipts, must be bigger than or equal to 1.');
        }

        if ($offset !== null && $offset > 9223372036854775807) {
            throw new \InvalidArgumentException('invalid value for "$offset" when calling ReceiptsApi.getReceipts, must be smaller than or equal to 9223372036854775807.');
        }
        if ($offset !== null && $offset < 0) {
            throw new \InvalidArgumentException('invalid value for "$offset" when calling ReceiptsApi.getReceipts, must be bigger than or equal to 0.');
        }

        if ($limit !== null && $limit > 3000) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling ReceiptsApi.getReceipts, must be smaller than or equal to 3000.');
        }
        if ($limit !== null && $limit < 1) {
            throw new \InvalidArgumentException('invalid value for "$limit" when calling ReceiptsApi.getReceipts, must be bigger than or equal to 1.');
        }


        $resourcePath = '/api/1/receipts';
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
        if ($user_name !== null) {
            if ('form' === 'form' && is_array($user_name)) {
                foreach ($user_name as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['user_name'] = $user_name;
            }
        }
        // query params
        if ($number !== null) {
            if ('form' === 'form' && is_array($number)) {
                foreach ($number as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['number'] = $number;
            }
        }
        // query params
        if ($comment_type !== null) {
            if ('form' === 'form' && is_array($comment_type)) {
                foreach ($comment_type as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['comment_type'] = $comment_type;
            }
        }
        // query params
        if ($comment_important !== null) {
            if ('form' === 'form' && is_array($comment_important)) {
                foreach ($comment_important as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['comment_important'] = $comment_important;
            }
        }
        // query params
        if ($category !== null) {
            if ('form' === 'form' && is_array($category)) {
                foreach ($category as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['category'] = $category;
            }
        }
        // query params
        if ($offset !== null) {
            if ('form' === 'form' && is_array($offset)) {
                foreach ($offset as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['offset'] = $offset;
            }
        }
        // query params
        if ($limit !== null) {
            if ('form' === 'form' && is_array($limit)) {
                foreach ($limit as $key => $value) {
                    $queryParams[$key] = $value;
                }
            } else {
                $queryParams['limit'] = $limit;
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
     * Operation updateReceipt.
     *
     * ファイルボックス（証憑ファイル）の更新
     *
     * @param int                                       $id                    ファイルボックス（証憑ファイル）ID (required)
     * @param \OpenAPI\Client\Model\ReceiptUpdateParams $receipt_update_params receipt_update_params (required)
     *
     * @return \OpenAPI\Client\Model\ReceiptResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function updateReceipt($id, $receipt_update_params)
    {
        [$response] = $this->updateReceiptWithHttpInfo($id, $receipt_update_params);

        return $response;
    }

    /**
     * Operation updateReceiptWithHttpInfo.
     *
     * ファイルボックス（証憑ファイル）の更新
     *
     * @param int                                       $id                    ファイルボックス（証憑ファイル）ID (required)
     * @param \OpenAPI\Client\Model\ReceiptUpdateParams $receipt_update_params (required)
     *
     * @return array of \OpenAPI\Client\Model\ReceiptResponse|\OpenAPI\Client\Model\BadRequestError|\OpenAPI\Client\Model\UnauthorizedError|\OpenAPI\Client\Model\ForbiddenError|\OpenAPI\Client\Model\BadRequestNotFoundError|\OpenAPI\Client\Model\InternalServerError, HTTP status code, HTTP response headers (array of strings)
     *
     * @throws \InvalidArgumentException
     * @throws \OpenAPI\Client\ApiException on non-2xx response
     */
    public function updateReceiptWithHttpInfo($id, $receipt_update_params)
    {
        $request = $this->updateReceiptRequest($id, $receipt_update_params);

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
                    if ('\OpenAPI\Client\Model\ReceiptResponse' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\ReceiptResponse', []),
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
                case 404:
                    if ('\OpenAPI\Client\Model\BadRequestNotFoundError' === '\SplFileObject') {
                        $content = $response->getBody(); //stream goes to serializer
                    } else {
                        $content = (string) $response->getBody();
                    }

                    return [
                        ObjectSerializer::deserialize($content, '\OpenAPI\Client\Model\BadRequestNotFoundError', []),
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

            $returnType = '\OpenAPI\Client\Model\ReceiptResponse';
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
                        '\OpenAPI\Client\Model\ReceiptResponse',
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
                case 404:
                    $data = ObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\OpenAPI\Client\Model\BadRequestNotFoundError',
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
     * Operation updateReceiptAsync.
     *
     * ファイルボックス（証憑ファイル）の更新
     *
     * @param int                                       $id                    ファイルボックス（証憑ファイル）ID (required)
     * @param \OpenAPI\Client\Model\ReceiptUpdateParams $receipt_update_params (required)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function updateReceiptAsync($id, $receipt_update_params)
    {
        return $this->updateReceiptAsyncWithHttpInfo($id, $receipt_update_params)
            ->then(
                function ($response) {
                    return $response[0];
                }
            );
    }

    /**
     * Operation updateReceiptAsyncWithHttpInfo.
     *
     * ファイルボックス（証憑ファイル）の更新
     *
     * @param int                                       $id                    ファイルボックス（証憑ファイル）ID (required)
     * @param \OpenAPI\Client\Model\ReceiptUpdateParams $receipt_update_params (required)
     *
     * @return \GuzzleHttp\Promise\PromiseInterface
     *
     * @throws \InvalidArgumentException
     */
    public function updateReceiptAsyncWithHttpInfo($id, $receipt_update_params)
    {
        $returnType = '\OpenAPI\Client\Model\ReceiptResponse';
        $request    = $this->updateReceiptRequest($id, $receipt_update_params);

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
     * Create request for operation 'updateReceipt'.
     *
     * @param int                                       $id                    ファイルボックス（証憑ファイル）ID (required)
     * @param \OpenAPI\Client\Model\ReceiptUpdateParams $receipt_update_params (required)
     *
     * @return \GuzzleHttp\Psr7\Request
     *
     * @throws \InvalidArgumentException
     */
    public function updateReceiptRequest($id, $receipt_update_params)
    {
        // verify the required parameter 'id' is set
        if ($id === null || (is_array($id) && count($id) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $id when calling updateReceipt'
            );
        }
        if ($id < 1) {
            throw new \InvalidArgumentException('invalid value for "$id" when calling ReceiptsApi.updateReceipt, must be bigger than or equal to 1.');
        }

        // verify the required parameter 'receipt_update_params' is set
        if ($receipt_update_params === null || (is_array($receipt_update_params) && count($receipt_update_params) === 0)) {
            throw new \InvalidArgumentException(
                'Missing the required parameter $receipt_update_params when calling updateReceipt'
            );
        }

        $resourcePath = '/api/1/receipts/{id}';
        $formParams   = [];
        $queryParams  = [];
        $headerParams = [];
        $httpBody     = '';
        $multipart    = false;


        // path params
        if ($id !== null) {
            $resourcePath = str_replace(
                '{'.'id'.'}',
                ObjectSerializer::toPathValue($id),
                $resourcePath
            );
        }


        if ($multipart) {
            $headers = $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json', 'application/x-www-form-urlencoded']
            );
        }

        // for model (json/xml)
        if (isset($receipt_update_params)) {
            if ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode(ObjectSerializer::sanitizeForSerialization($receipt_update_params));
            } else {
                $httpBody = $receipt_update_params;
            }
        } elseif (count($formParams) > 0) {
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
            'PUT',
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
