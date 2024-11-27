<?php

/**
 * BadRequest.
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
 * freee請求書 API.
 *
 * <p>freee請求書のAPI仕様です。</p>  <b>freee請求書APIを利用するには、freee請求書への登録が必要です。  登録は<a href=\"https://www.freee.co.jp/invoice/\" target=\"_blank\">freee請求書</a>より行ってください。</b>  </br>  <h3 id=\"about_authorize\">認証について</h3>  <p>OAuth2.0を利用します。<a href=\"https://developer.freee.co.jp/reference/#%e8%aa%8d%e8%a8%bc\" target=\"_blank\">詳細はリファレンスの認証に関する記載を参照してください。</a></p>  <h3 id=\"api_endpoint\">エンドポイント</h3>  <p>https://api.freee.co.jp/iv</p>   <h3 id=\"compatibility\">後方互換性ありの変更</h3>  <p>freeeでは、APIを改善していくために以下のような変更は後方互換性ありとして通知なく変更を入れることがあります。アプリケーション実装者は以下を踏まえて開発を行ってください。</p>  <ul> <li>新しいAPIリソース・エンドポイントの追加</li> <li>既存のAPIに対して必須ではない新しいリクエストパラメータの追加</li> <li>既存のAPIレスポンスに対する新しいプロパティの追加</li> <li>既存のAPIレスポンスに対するプロパティの順番の入れ変え</li> <li>keyとなっているidやcodeの長さの変更（長くする）</li> </ul>  <h3 id=\"error_response\">エラーレスポンス</h3>  <p>APIリクエストでエラーが発生した場合は、エラー原因に応じたステータスコードおよびメッセージを返します。</p>    <table border=\"1\">   <tbody>     <tr>       <th style=\"padding: 10px\"><strong>ステータスコード</strong></th>       <th style=\"padding: 10px\"><strong>原因</strong></th>     </tr>     <tr><td style=\"padding: 10px\">400</td><td style=\"padding: 10px\">リクエストパラメータが不正</td></tr>     <tr><td style=\"padding: 10px\">401</td><td style=\"padding: 10px\">アクセストークンが無効</td></tr>     <tr><td style=\"padding: 10px\">403</td><td style=\"padding: 10px\">アクセス権限がない</td></tr>     <tr><td style=\"padding: 10px\">404</td><td style=\"padding: 10px\">リソースが存在しない</td></tr>     <tr><td style=\"padding: 10px\">429</td><td style=\"padding: 10px\">リクエスト回数制限を超えた</td></tr>     <tr><td style=\"padding: 10px\">503</td><td style=\"padding: 10px\">システム内で予期しないエラーが発生</td></tr>   </tbody> </table>  <p>メッセージボディ内の <code>messages</code> にはエラー内容を説明する文字列が入ります。</p> <pre><code>  {     &quot;status_code&quot; : 400,     &quot;errors&quot; : [       {         &quot;type&quot; : &quot;bad_request&quot;,         &quot;messages&quot; : [           &quot;リクエストの形式が不正です。&quot;         ]       }     ]   }  </code></pre>  </br>  <h3 id=\"api_rate_limit\">API使用制限</h3> <p>APIリクエストは1時間で5000回を上限としています。API使用ステータスはレスポンスヘッダに付与されます。</p> <pre><code>X-Ratelimit-Limit:5000 X-Ratelimit-Remaining:4998 X-Ratelimit-Reset:2018-01-01T12:00:00.000000Z </code></pre>  <br> 各ヘッダの意味は次のとおりです。</p>   <table border=\"1\">   <tbody>     <tr>       <th style=\"padding: 10px\"><strong>ヘッダ名</strong></th>       <th style=\"padding: 10px\"><strong>説明</strong></th>     </tr>     <tr><td style=\"padding: 10px\">X-RateLimit-Limit</td><td style=\"padding: 10px\">使用回数の上限</td></tr>     <tr><td style=\"padding: 10px\">X-RateLimit-Remaining</td><td style=\"padding: 10px\">残り使用回数</td></tr>     <tr><td style=\"padding: 10px\">X-RateLimit-Reset</td><td style=\"padding: 10px\">使用回数がリセットされる時刻</td></tr>   </tbody> </table>  <p>上記に加え、freeeは一定期間に過度のアクセスを検知した場合、APIアクセスをコントロールする場合があります。<br> その際のhttp status codeは403となります。制限がかかってから10分程度が過ぎると再度使用することができるようになります。</p>  </br>  <h3 id=\"accounting_master_items\">会計マスタ項目</h3>  <p>freee請求書APIのリクエストパラメータに、会計マスタ項目（例：<a href=\"https://developer.freee.co.jp/reference/iv/reference#operations-tag-Invoices\">POST/invoices請求書の作成</a> 取引先ID）があります。会計マスタ項目の詳細は<a href=\"https://developer.freee.co.jp/guideline/master-guideline\">会計マスタガイドラインを参照ください</a>。</p>  <p>会計のマスタ項目はfreee会計APIのエンドポイントにて取得可能です（例：<a href=\"https://developer.freee.co.jp/reference/accounting/reference#operations-tag-Partners\">Partners 取引先</a>）。freee会計APIのエンドポイントの詳細は<a href=\"https://developer.freee.co.jp/reference/accounting/reference\">会計APIリファレンスを参照ください</a>。</p>  </br>
 *
 * The version of the OpenAPI document: v1
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
 * BadRequest Class Doc Comment.
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
class BadRequest implements ModelInterface, ArrayAccess, \JsonSerializable
{
    public const DISCRIMINATOR = null;

    /**
     * The original name of the model.
     *
     * @var string
     */
    protected static $openAPIModelName = 'badRequest';

    /**
     * Array of property to type mappings. Used for (de)serialization.
     *
     * @var string[]
     */
    protected static $openAPITypes = [
        'status_code' => 'int',
        'errors'      => '\OpenAPI\Client\Model\BadRequestErrors[]',
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
        'status_code' => null,
        'errors'      => null,
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
        'status_code' => 'status_code',
        'errors'      => 'errors',
    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses).
     *
     * @var string[]
     */
    protected static $setters = [
        'status_code' => 'setStatusCode',
        'errors'      => 'setErrors',
    ];

    /**
     * Array of attributes to getter functions (for serialization of requests).
     *
     * @var string[]
     */
    protected static $getters = [
        'status_code' => 'getStatusCode',
        'errors'      => 'getErrors',
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
        $this->container['status_code'] = $data['status_code'] ?? null;
        $this->container['errors']      = $data['errors'] ?? null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

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
     * Gets status_code.
     *
     * @return int|null
     */
    public function getStatusCode()
    {
        return $this->container['status_code'];
    }

    /**
     * Sets status_code.
     *
     * @param int|null $status_code status_code
     *
     * @return self
     */
    public function setStatusCode($status_code)
    {
        $this->container['status_code'] = $status_code;

        return $this;
    }

    /**
     * Gets errors.
     *
     * @return \OpenAPI\Client\Model\BadRequestErrors[]|null
     */
    public function getErrors()
    {
        return $this->container['errors'];
    }

    /**
     * Sets errors.
     *
     * @param \OpenAPI\Client\Model\BadRequestErrors[]|null $errors errors
     *
     * @return self
     */
    public function setErrors($errors)
    {
        $this->container['errors'] = $errors;

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
